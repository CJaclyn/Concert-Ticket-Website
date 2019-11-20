<?php
session_start();
include('loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>EDM Concerts</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/genre.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/displayconcerts.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
  <?php include('header.html');?>
  <?php isLoggedIn() ?>

  <h1>EDM Concerts</h1>

  <?php
  require_once "config.php";

  $EDMQuery = "SELECT Artist, artists.Image, Street, City, State, DATE_FORMAT(Date, '%a %b %e %Y') Date, TIME_FORMAT(Time, '%h %i %p') Time
  FROM concerts
  INNER JOIN artists ON artists.Artist_name = concerts.Artist
  WHERE genre='EDM' ORDER BY date ASC, time ASC";

  $EDM = mysqli_query($link, $EDMQuery);

  mysqli_query($link, $EDMQuery) or die('Error querying database.');

  while ($row = mysqli_fetch_array($EDM)) {
    echo "<div class=\"row\">";
    echo "<div class=\"column left\">";
    echo "<img src='". $row['Image']."'width='300'>"."<br />";
    echo "</div>";

    echo "<div class=\"column right\">";
    echo "<h3>".$row['Artist']."<br />"."</h3>";
    echo $row['Date']." - ".$row['Time']."<br />";
    echo $row['Street'].", ".$row['City'].", ".$row['State']."<br />";
    echo "<a href=\"Purchase.php\">Purchase Tickets!</a>";
    echo "</div>";
    echo "</div>";
  }

  mysqli_close($link);
    include('footer.html');
   ?>

</body>
</html>
