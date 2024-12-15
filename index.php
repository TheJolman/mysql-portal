<?php
$pageTitle = 'Portal Home';
include 'include/header.php';
?>

<div class="container">
  <h1>Welcome! Choose a Page:</h1>
  <div>
    <h2>For the Professors</h2>
    <a href="src/professor_details_pquery.php" class="button">Professor Details</a>
    <a href="src/grade_counts_pquery.php" class="button">Grade Counts</a>
  </div>
  <div>
    <h2>For the Students</h2>
    <a href="src/section_listings_squery.php" class="button">Section Listings</a>
    <a href="src/student_schedule_squery.php" class="button">Student Schedule</a>
  </div>
</div>

<?php include 'include/footer.php'; ?>
