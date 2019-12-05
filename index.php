<?php
session_start();
include('loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/generalstylesheet.css">
<link rel="stylesheet" href="css/homepage.css">
<link rel="stylesheet" href="css/displayconcerts.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
  <?php include('header.html');?>
  <?php isLoggedIn(); ?>

  <div class="header centered">
    <img src="images/header.jfif">
    <h1>Midsommar Music</h1>
  </div>

  <h2>Upcoming Concerts</h2>
  <?php
  require_once "config.php";

  $upcomingConcertsQuery = "SELECT Artist, artists.Image, Street, City, State,
  DATE_FORMAT(Date, '%a %b %e %Y') Date, TIME_FORMAT(Time, '%h %i %p') Time
  FROM concerts
  INNER JOIN artists ON artists.Artist_name = concerts.Artist
  WHERE Date BETWEEN CURDATE() AND DATE_ADD(NOW(), INTERVAL 7 DAY) ORDER BY DATE(Date) ASC, Time ASC";

  $upcomingConcerts= mysqli_query($link, $upcomingConcertsQuery);
  mysqli_query($link, $upcomingConcertsQuery) or die('Error querying database.');

  while ($row = mysqli_fetch_array($upcomingConcerts)) {
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
   ?>
   <div class="see-all">
     <a href="all.php">See all concerts ➔</a>
   </div>

   <?php include('footer.html');?>
</body>
</html>
