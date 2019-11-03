<!DOCTYPE html>
<html lang="en">
<head>
<title>Rock Concerts</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="generalstylesheet.css">
<link rel="stylesheet" type="text/css" href="genre.css">
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

  <h1>Rock Concerts</h1>

  <?php
  $db = mysqli_connect('localhost','root','12345','ticket_web') or die('Error connecting to MySQL server.');

  $rockQuery = "SELECT Artist, artists.Image, Street, City, State, DATE_FORMAT(Date, '%a %b %e %Y') Date, TIME_FORMAT(Time, '%h %i %p') Time
  FROM concerts
  INNER JOIN artists ON artists.Artist_name = concerts.Artist
  WHERE genre='Rock' ORDER BY date ASC, time ASC";

  $rock = mysqli_query($db, $rockQuery);
  mysqli_query($db, $rockQuery) or die('Error querying database.');

  while ($row = mysqli_fetch_array($rock)) {
    echo "<div class=\"row\">";
    echo "<div class=\"column left\">";
    echo "<img src='".$row['Image']."'width='300'>"."<br />";
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

   <footer>
     <h4>Footer</h4>
     <p>Jaclyn C.</p>
   </footer>
</body>
</html>
