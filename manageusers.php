<?php
  session_start();
  include('adminfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Users</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/manageusers.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/adminerror.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>

<body>
<?php include('header.html');?>

<?php
    if (isLoggedIn())
    {
      echo "<h1>Manage Users</h1>";
      echo "<div id='admin-link'><a href='addadmin.php'>Add Admin</a>";
      echo "<a href='removeadmin.php'>Remove Admin</a></div>";
      require_once "config.php";

      $result=$link->query("SELECT Username, Email, created FROM users ORDER BY created ASC");

      echo "<div id='container'>";
      echo "<h2>Users</h2>";
      while($row=$result->fetch_object()){
        echo "<div class='user-row'>";
        echo "<h3>".$row->Username."</h3>";
        echo "<div class='created-date'>User Since ".$row->created."</div>";
        echo "<a href='viewuser.php?username=".$row->Username."'>View</a>";
        echo "</div>";
      }
      echo "</div>";

      $link->close();
    }
    else
    {
      isNotLoggedIn();
    }

      include('footer.html');
  ?>
