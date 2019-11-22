<?php
  session_start();
  if(isset($_SESSION['valid_admin'])){
      $old_user = $_SESSION['valid_admin'];
  }
  include('../loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/adminlogout.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('../header.html');?>

<?php

  header( "refresh:1;url=../index.php" );
  if (!empty($old_user))
  {
    logOut();
    echo '<h2>You are now logged out.</h2>';
    echo '<p>Returning to homepage. . .</p>';
  }
  else
  {
    header('Location: index.php');
  }
?>

</body>
</html>
