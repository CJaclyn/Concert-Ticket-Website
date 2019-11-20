<?php
  session_start();
  include('adminfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/adminpage.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/adminerror.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('header.html');?>

<?php
    if (isLoggedIn())
    {
      echo "<h1>Admin Dashboard</h1>";
      echo "<div id='links'>";
      echo "<a href='manageusers.php'>Manage Users</a>";
      echo "<a href='manageconcerts.php'>Manage Concerts</a>";
      echo "<a href='manageartists.php'>Manage Artists</a>";
      echo "</div>";
    }
    else
    {
      isNotLoggedIn();
    }
      include('footer.html');
  ?>
