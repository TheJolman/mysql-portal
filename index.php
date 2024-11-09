<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="public/css/styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" type="image/x-icon" href="/public/favicon.ico" >
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
  <title>DB Access Page</title>
</head>

<body>

  <h1 class="center">University database portal</h1>

  <div class="center">

    <form action="professor.php" method="post">
      <label for="prof_ssn">Professor ssn lookup:</label>
      <input name="prof_ssn" id="prof_ssn" type="text">
      <button type="submit">Submit</button>
    </form>

    <br>

    <form action="student.php" method="post">
      <label for="course_id">Course id lookup:</label>
      <input name="course_id" id="course_id" type="text">
      <button type="submit">Submit</button>
    </form>
  </div>
</body>

</html>
