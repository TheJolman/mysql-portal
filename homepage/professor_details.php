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
	die('Could not connect: ' . mysql_error());
}
// echo 'Connected successfully';

// Use prepared statements for security
$profssn = $_POST["pd"];
$query = "SELECT * FROM Professor WHERE ssn = ?";
$stmt = $link->prepare($query);
$stmt->bind_param("i", $profssn);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {

    echo "<br>Professor Details:<br>";

	printf("Professor SSN: %s<br>", $row["ssn"]);

    // Subquery setup for Enrollment and MeetingDays
    $query2 = "
        SELECT 
            c.title,
            cs.course_number,
            cs.section_number,
            cs.classroom, 
            GROUP_CONCAT(DISTINCT md.meeting_day ORDER BY md.meeting_day SEPARATOR ', ') AS meeting_days,
            cs.begin_time, 
            cs.end_time
        FROM 
            CourseSection cs
		JOIN 
            Course c 
            ON cs.course_number = c.course_number
        LEFT JOIN 
            MeetingDays md 
            ON cs.section_number = md.section_number AND cs.course_number = md.course_number
        WHERE 
            cs.pssn = ?
        GROUP BY
            c.title, cs.course_number, cs.section_number, cs.classroom, cs.begin_time, cs.end_time
    ";

    $stmt2 = $link->prepare($query2);
    $stmt2->bind_param("i", $profssn);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    // Loop through the results and print each course number and grade
    while ($enrollment_row = $result2->fetch_assoc()) {
        printf(
            "Title: %s, Classroom: %s, Meeting Days: %s, Start time: %s, End time: %s<br>\n",
			$enrollment_row["title"],
            $enrollment_row["classroom"],
            $enrollment_row["meeting_days"],
            $enrollment_row["begin_time"],
            $enrollment_row["end_time"],
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
