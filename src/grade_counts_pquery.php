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
</div>

<?php include '../include/footer.php'; ?>
