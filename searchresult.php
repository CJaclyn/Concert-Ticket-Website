<!DOCTYPE html>
<html lang="en">
<head>
<title>Search Result</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="generalstylesheet.css">
<link rel="stylesheet" type="text/css" href="searchresult.css">
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

  <h2>Search Results</h2>
  <?php
  $searchInput = htmlentities($_POST['userSrch']);
  echo $searchInput;

  $db = mysqli_connect('localhost','root','12345','ticket_web') or die('Error connecting to MySQL server.');
  $concertResultQuery = "SELECT * FROM concerts WHERE artist REGEXP '$searchInput'";

  $concertResult= mysqli_query($db, $concertResultQuery);
  mysqli_query($db, $concertResultQuery) or die('Error querying database.');

  while ($row = mysqli_fetch_array($concertResult)) {
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

   <div class="see-concerts">
     <a href="all.php">See all concerts ➔</a>;
   </div>
</body>
</html>
