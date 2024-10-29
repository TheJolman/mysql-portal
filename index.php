<?php
if (isset($_POST['user_name'])) {
  print("Welcome, ");
  print($_POST['user_name']);
}
else {
  print <<<_HTML_
  <form method="post" action="{$_SERVER['PHP_SELF']}">
    Enter your name: <input type="text" name="user_name" required>
    <br/>
    <input type="submit" value="SUBMIT NAME">
  </form>
_HTML_;
}
?>
