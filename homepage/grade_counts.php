<html>
<body>
<?php
// username and password need to be replaced by your username and password
// dbname is the same as your username
$username='cs332f26';
$password='YLtQPG10';
$dbname='cs332f26';
$link = mysqli_connect('mariadb', $username, $password, $dbname);
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
// echo 'Connected successfully';

$course = $_POST["course"];
$section = $_POST["section"];

$query = "
    SELECT 
        e.grade, 
        COUNT(*) AS student_count
    FROM 
        Enrollment e
    WHERE 
        e.course_number = ? AND 
        e.section_number = ?
    GROUP BY 
        e.grade
    ORDER BY 
        e.grade
";

$stmt = $link->prepare($query);
$stmt->bind_param("ii", $course, $section); // Replace with actual variables
$stmt->execute();
$result = $stmt->get_result();

printf("Course Number: %d, Section Number: %d<br>", $course, $section);

while ($row = $result->fetch_assoc()) {
    printf(
        "Grade: %s, Number of Students: %d<br>\n",
        $row["grade"],
        $row["student_count"]
    );
}

$stmt->close();
$link->close();
?>
</body>
</html>
