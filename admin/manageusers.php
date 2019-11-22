<?php
  session_start();
  include('../loginfunctions.php');
  require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Users</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/manageusers.css">

<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>

<body>
<?php include('../header.html');?>

<?php
    if (isLoggedIn())
    {
      echo "<h1>Manage Users</h1>";
      echo "<div id='admin-link'><a href='addadmin.php'>Add Admin Privileges</a>";
      echo "<a href='removeadmin.php'>Remove Admin Privileges</a></div>";

      $result=$link->query("SELECT Username, Email, created, admin FROM users ORDER BY admin DESC, created DESC");

      echo "<div id='container'>";
      echo "<h2>Users</h2>";
      while($row=$result->fetch_object()){
        echo "<div class='user-row'>";
        echo "<h3>".$row->Username." - ";

        if($row->admin == 1){
          echo "Admin</h3>";
        }else{
          echo "Regular</h3>";
        }

        echo "<div class='created-date'>User Since ".$row->created."</div>";
        echo "<a href='viewuser.php?username=".$row->Username."'>View</a>";
        echo "</div>";
      }
      echo "</div>";

      $link->close();
    }
    else
    {
      isNotLoggedInAdmin();
    }

      include('../footer.html');
  ?>
