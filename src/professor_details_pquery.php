<?php
$pageTitle = 'Professor Details';
include '../include/header.php';
?>

<div class="container">
  <h1>Professor Details Retreival</h1>
  <form action="professor_details.php" method="POST">
    Enter the social security number: <input type="text" name="pd" />
    <input type="submit" />
  </form>
</div>
<?php include '../include/footer.php'; ?>
