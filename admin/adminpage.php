<?php
  session_start();
  include('../loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/adminpage.css">

<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('../header.html');?>

<?php
    if (isLoggedInAdmin())
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
      isNotLoggedInAdmin();
    }
      include('../footer.html');
  ?>
