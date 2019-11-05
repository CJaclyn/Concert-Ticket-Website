<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="homepage.css">
<link rel="stylesheet" href="displayconcerts.css">
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
      <li><a href="purchase.html">Purchase Tickets</a></li>
      <li><a href="news.html">News</a></li>
      <li><a href="profile.html">Profile</a></li>
    </ul>
  </nav>

  <div class="header centered">
    <img src="/header.jfif">
    <h1>Midsommar Music</h1>
  </div>
  <h2>Upcoming Concerts</h2>
  <?php
  $db = mysqli_connect('localhost','root','12345','ticket_web') or die('Error connecting to MySQL server.');

  $upcomingConcertsQuery = "SELECT Artist, artists.Image, Street, City, State,
  DATE_FORMAT(Date, '%a %b %e %Y') Date, TIME_FORMAT(Time, '%h %i %p') Time
  FROM concerts
  INNER JOIN artists ON artists.Artist_name = concerts.Artist
  WHERE Date BETWEEN CURDATE() AND DATE_ADD(NOW(), INTERVAL 7 DAY) ORDER BY DATE(Date) ASC, Time ASC";

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
    echo "<a href=\"purchase.html\">Purchase Tickets!</a>";
    echo "</div>";
    echo "</div>";
  }
  mysqli_close($db);
   ?>
   <div class="see-all">
     <a href="all.php">See all concerts ➔</a>
   </div>

   <footer>
       <img src="logo1.png" alt="midsommar music logo" height="100" width="100">
   		<ul>
   			<li><h4>Links</h4></li>
   			<li><a href="about.html">About</a></li>
   			<li><a href="#">Sign-Up</a></li>
   			<li><a href="purchase.html">Purchase Tickets</a></li>
        <li><a href="news.html">News</a></li>
        <li><a href="#">Contact Us</a></li>
   		</ul>
   		<ul>
   			<li><h4>Concerts</h4></li>
        <li><a href="concerts.html">Concerts</a></li>
   			<li><a href="pop.php">Pop Concerts</a></li>
   			<li><a href="rock.php">Rock Concerts</a></li>
   			<li><a href="edm.php">EDM Concerts</a></li>
   			<li><a href="metal.php">Metal Concerts</a></li>
   			<li><a href="all.php">All Concerts</a></li>
   		</ul>
      <ul>
        <h4>Sign-Up for the newsletter!</h4>
        <input type="text" name="email" placeholder="Email Address"></input>
        <button type="submit" name="submit">Sign-Up</button>
      </ul>
   </footer>

</body>
</html>
