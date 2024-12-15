<?php
$pageTitle = 'Section Listings';
include '../include/header.php';
?>

<div class="container">
  <h1>Section Listings Retrieval</h1>
  <form action="section_listings.php" method="POST">
    Enter the course number: <input type="text" name="coursenum" />
    <input type="submit" />
  </form>
</div>

<?php include '../include/footer.php'; ?>
