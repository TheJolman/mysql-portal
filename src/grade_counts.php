<?php
$pageTitle = 'Grade Counts';
include '../include/header.php';
?>

<div class="container">
  <h1>Student Grade Count Retrieval</h1>
  <form action="grade_counts.php" method="POST">
    Enter the course number: <input type="text" name="course" />
    Enter the section number: <input type="text" name="section" />
    <input type="submit" />
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["course"]) && isset($_POST["section"])) {
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

    $course = $_POST["course"];
    $section = $_POST["section"];

    echo "<div class='results'>";
    echo "<h3>Results:</h3>";

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
    $stmt->bind_param("ii", $course, $section);
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
    echo "</div>";

    $stmt->close();
    $link->close();
  }
  ?>
</div>

<?php include '../include/footer.php'; ?>
