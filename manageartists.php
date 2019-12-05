<?php
  session_start();
  include('loginfunctions.php');
  require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Artists</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/generalstylesheet.css">
<link rel="stylesheet" href="css/manageartists.css">

<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('header.html');?>

<?php
    if (isLoggedInAdmin())
    {
      echo "<h1>Manage Artists</h1>";
      echo "<div id='add'><a href='addartist.php'>Add Artists</a></div>";

      $allQuery = "SELECT Artist_name, Genre, artistID FROM artists
      ORDER BY Artist_name ASC";

      $all = mysqli_query($link, $allQuery);
      mysqli_query($link, $allQuery) or die('Error querying database.');
      echo "<div id='container'>";
      while ($row = mysqli_fetch_array($all)) {
        echo "<div class=\"row\">";
        echo "<h3>".$row['Artist_name']." <span id='right'>".$row['Genre']."</span></h3>";
        echo "<a href='deleteartist.php?id=".$row['artistID']."'>Delete</a>";
        echo "</div>";
      }
      echo "</div>";
      mysqli_close($link);
    }
    else
    {
      isNotLoggedInAdmin();
    }

      include('footer.html');
  ?>
