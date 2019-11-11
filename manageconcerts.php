<?php
  session_start();
  include('adminfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Concerts</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="manage.css">
<link rel="stylesheet" href="adminerror.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
  <header>
  <img src="logo1.png" alt="midsommar music logo" height="55" width="55">
  </header>

<?php
    if (isLoggedIn())
    {
      echo "<h1>Manage Concerts</h1>";
      echo "<div id='add'><a href='addconcert.php'>Add Concert</a></div>";
      require_once "config.php";

      $allQuery = "SELECT * FROM concerts
      ORDER BY date ASC, time ASC";

      $all = mysqli_query($link, $allQuery);
      mysqli_query($link, $allQuery) or die('Error querying database.');
      echo "<div id='container'>";
      while ($row = mysqli_fetch_array($all)) {
        echo "<div class=\"row\">";
        echo "<h3>".$row['Artist']."<br />"."</h3>";
        echo $row['Date']." ".$row['Time']."<br />";
        echo $row['Street'].", ".$row['City'].", ".$row['State']."<br />";
        echo "<a href='updateconcert.php?id=".$row['concertID']."'>Update</a>";
        echo "<a href='deleteconcert.php?id=".$row['concertID']."'>Delete</a>";
        echo "</div>";
      }
      echo "</div>";
      mysqli_close($link);
    }
    else
    {
      isNotLoggedIn();
    }

      include('footer.html');
  ?>
