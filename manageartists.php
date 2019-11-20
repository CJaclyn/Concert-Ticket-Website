<?php
  session_start();
  include('adminfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Artists</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/manage.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/adminerror.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('header.html');?>

<?php
    if (isLoggedIn())
    {
      echo "<h1>Manage Artists</h1>";
      echo "<div id='add'><a href='addartist.php'>Add Artists</a></div>";
      require_once "config.php";

      $allQuery = "SELECT Artist_name, Genre, artistID FROM artists
      ORDER BY Artist_name ASC";

      $all = mysqli_query($link, $allQuery);
      mysqli_query($link, $allQuery) or die('Error querying database.');
      echo "<div id='container'>";
      while ($row = mysqli_fetch_array($all)) {
        echo "<div class=\"row\">";
        echo "<h3>".$row['Artist_name']."<br />"."</h3>";
        echo "Genre: ".$row['Genre']."<br />";
        echo "<a href='deleteartist.php?id=".$row['artistID']."'>Delete</a>";
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
