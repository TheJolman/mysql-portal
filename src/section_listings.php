<html>
<body>
<?php
// username and password need to be replaced by your username and password
// dbname is the same as your username
$env = parse_ini_file('../.env');
$username = $env["USERNAME"];
$password = $env["PASSWORD"];
$dbname = $env["DBNAME"];

$link = mysqli_connect('mariadb', $username, $password, $dbname);
if (!$link) {
	die('Could not connect: ' . mysqli_connect_error());
}
// echo 'Connected successfully';

// Use prepared statements for security
$coursenum = $_POST["coursenum"];
$query = "SELECT * FROM CourseSection WHERE course_number = ?";
$stmt = $link->prepare($query);
$stmt->bind_param("i", $coursenum);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    echo "<br>Sections:<br>";

    // Subquery setup for Enrollment and MeetingDays
    $query2 = "
        SELECT 
            cs.section_number, 
            cs.classroom, 
            GROUP_CONCAT(DISTINCT md.meeting_day ORDER BY md.meeting_day SEPARATOR ', ') AS meeting_days,
            cs.begin_time, 
            cs.end_time, 
            COUNT(DISTINCT e.cwid) AS student_count
        FROM 
            CourseSection cs
        JOIN 
            Enrollment e 
            ON cs.section_number = e.section_number AND cs.course_number = e.course_number
        LEFT JOIN 
            MeetingDays md 
            ON cs.section_number = md.section_number AND cs.course_number = md.course_number
        WHERE 
            cs.course_number = ?
        GROUP BY 
            cs.section_number, cs.classroom, cs.begin_time, cs.end_time
    ";


    $stmt2 = $link->prepare($query2);
    $stmt2->bind_param("i", $coursenum);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    // Loop through the results and print each course number and grade
    while ($enrollment_row = $result2->fetch_assoc()) {
        printf(
            "Section Number: %s, Classroom: %s, Meeting Days: %s, Start time: %s, End time: %s, Students: %s<br>\n",
            $enrollment_row["section_number"],
            $enrollment_row["classroom"],
            $enrollment_row["meeting_days"],
            $enrollment_row["begin_time"],
            $enrollment_row["end_time"],
            $enrollment_row["student_count"]
        );
    }

    // Free result sets
    $result->free();
    $result2->free();
} else {
    echo "No results found for the specified course number.";
}

$stmt->close();
$stmt2->close();
$link->close();


?>
</body>
</html>
