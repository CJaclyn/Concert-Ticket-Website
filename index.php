<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="generalstylesheet.css">
<link rel="stylesheet" type="text/css" href="homepage.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
  <header>
  <img src="logo1.png" alt="midsommar music logo" height="55" width="55">
  </header>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="concerts.html">Concerts<i class="down"></i></a>
        <ul>
          <li><a href="pop.php">Pop</a></li>
          <li><a href="rock.php">Rock</a></li>
          <li><a href="edm.php">EDM</a></li>
          <li><a href="metal.php">Metal</a></li>
          <li><a href="all.php">All</a></li>
        </ul>
      </li>
      <li><a href="#">Purchase Tickets</a></li>
      <li><a href="#">News</a></li>
      <li><a href="#">Profile</a></li>
    </ul>
  </nav>

  <div class="header centered">
    <img src="/header.jfif">
    <h1>Midsommar Music</h1>
  </div>
  <h2>Upcoming Concerts</h2>
  <?php
  $db = mysqli_connect('localhost','root','12345','ticket_web') or die('Error connecting to MySQL server.');
  $upcomingConcertsQuery = "SELECT * FROM concerts WHERE date BETWEEN
  CURDATE() AND DATE_ADD(NOW(), INTERVAL 7 DAY) ORDER BY DATE(date) ASC, Time ASC";

  $upcomingConcerts= mysqli_query($db, $upcomingConcertsQuery);
  mysqli_query($db, $upcomingConcertsQuery) or die('Error querying database.');

  while ($row = mysqli_fetch_array($upcomingConcerts)) {
    echo "<div class=\"row\">";
    echo "<div class=\"column left\">";
    echo "<img src='". $row['Image']."'width='300'>"."<br />";
    echo "</div>";

    echo "<div class=\"column right\">";
    echo "<h3>".$row['Artist']."<br />"."</h3>";
    echo $row['Date']." - ".$row['Time']."<br />";
    echo $row['Street'].", ".$row['City'].", ".$row['State']."<br />";
    echo "</div>";
    echo "</div>";
  }

  mysqli_close($db);
   ?>

   <footer>
     <h4>Footer</h4>
     <p>Jaclyn C.</p>
   </footer>
</body>
</html>
