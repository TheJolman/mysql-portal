<?php
$pageTitle = 'Student Schedule';
include '../include/header.php';
?>

<div class="container">
  <h1>Student Schedule Retrieval</h1>
  <form action="student_schedule.php" method="POST">
    Enter the cwid: <input type="text" name="cwid" />
    <input type="submit" />
  </form>
</div>

<?php include '../include/footer.php'; ?>
