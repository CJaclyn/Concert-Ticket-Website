<!DOCTYPE html>
<html lang="en">
<head>
<title>Search Result</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="searchresult.css">
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
      <li><a href="Purchase.php">Purchase Tickets</a></li>
      <li><a href="News.html">News</a></li>
      <li><a href="profile.html">Profile</a></li>
    </ul>
  </nav>

  <h1>Search Results</h1>
  <?php
  require_once "config.php";
  $searchInput = $_POST['userSrch'];

  if(!empty($searchInput)){
    $stmt = mysqli_prepare($link,"SELECT Artist, artists.Image, Street, City, State, DATE_FORMAT(Date, '%a %b %e %Y') Date, TIME_FORMAT(Time, '%h %i %p') Time
    FROM concerts
    INNER JOIN artists ON artists.Artist_name = concerts.Artist
    WHERE artist REGEXP ?
    ORDER BY date ASC, time ASC");

    mysqli_stmt_bind_param($stmt,"s", $searchInput);

    if($stmt->execute()){
      echo "<h2>Search results for: ".$searchInput."</h2>";
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
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
    }
    else {
      //echo "ERROR: Could not able to execute $stmt. ".mysqli_error($db);
      echo "Database ERROR";
    }
    mysqli_close($link);
  }else {
    header('location:concerts.html');
  }

   ?>

   <div class="see-concerts">
     <a href="all.php">See all concerts ➔</a>
   </div>

   <footer>
       <img src="logo1.png" alt="midsommar music logo" height="100" width="100">
      <ul>
        <li><h4>Join Us</h4></li>
        <li><a href="register.php">Sign-Up</a></li>
        <li><a href="login.php">Log-in</a></li>
        <li><a href="Purchase.php">Purchase Tickets</a></li>
        <li><a href="News.html">News</a></li>
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
        <li><h4>Links</h4></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="adminlogin.php">Admin</a></li>
      </ul>
   </footer>
</body>
</html>
