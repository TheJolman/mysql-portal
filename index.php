<!DOCTYPE html>
<html>

<head>
  <title>DB Access Page</title>
</head>

<body>
<h1>University database portal</h1>

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
</body>

</html>
