<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale-1.0">
  <link rel="icon" type="image/x-icon" href="<?php echo rtrim(dirname($_SERVER['PHP_SELF']), '/src'); ?>/public/favicon.ico">
  <link rel="stylesheet" href="<?php echo rtrim(dirname($_SERVER['PHP_SELF']), '/src'); ?>/public/main.css">
  <title><?php echo $pageTitle ?? 'Portal'; ?></title>
</head>

<body>
  <nav class="banner">
    <div class="banner-content">
      <a href="<?php echo rtrim(dirname($_SERVER['PHP_SELF']), '/src'); ?>/index.php" class="home-button">Home</a>
    </div>
  </nav>

  <div class="page-content">
