<?php
$pageTitle = 'Student Schedule';
include '../include/header.php';
?>

<div class="container">
  <h1>Student Schedule Retrieval</h1>
  <form method="POST">
    Enter the cwid: <input type="text" name="cwid" />
    <input type="submit" />
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cwid"])) {
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

    $cwid = $_POST["cwid"]; // Retrieve CWID from POST request
    $query = "SELECT * FROM Student WHERE cwid = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("i", $cwid); // Bind $cwid as an integer parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo "<div class='results'>";
    echo "<h3>Results: </h3>";
    if ($row) {
      printf("CWID: %s<br>\n", $row["cwid"]);
      printf("First NAME: %s<br>\n", $row["first_name"]);
      printf("Last NAME: %s<br>\n", $row["last_name"]);

      echo "<br>Enrolled Courses and Grades:<br>";

      // Second query to fetch enrollment information
      $query2 = "SELECT course_number, grade FROM Enrollment WHERE cwid = ?";
      $stmt2 = $link->prepare($query2);
      $stmt2->bind_param("i", $cwid); // Bind $cwid again as an integer parameter
      $stmt2->execute();
      $result2 = $stmt2->get_result();

      // Loop through the enrollment results and print course and grade information
      while ($enrollment_row = $result2->fetch_assoc()) {
        printf("Course Number: %s, Grade: %s<br>\n", $enrollment_row["course_number"], $enrollment_row["grade"]);
      }

      // Free result sets
      $result->free();
      $result2->free();
    } else {
      echo "No student found with the specified CWID.";
    }
    echo "</div>";

    // Close prepared statements and database connection
    $stmt->close();
    $stmt2->close();
    $link->close();
  }
  ?>
</div>

<?php include '../include/footer.php'; ?>
