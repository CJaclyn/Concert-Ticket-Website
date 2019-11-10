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
<link rel="stylesheet" href="adminpage.css">
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
      echo "
      <nav>
        <ul>
          <li><a href=\"index.php\">Home</a></li>
          <li><a href=\"concerts.html\">Concerts<i class=\"down\"></i></a>
            <ul>
              <li><a href=\"pop.php\">Pop</a></li>
              <li><a href=\"rock.php\">Rock</a></li>
              <li><a href=\"edm.php\">EDM</a></li>
              <li><a href=\"metal.php\">Metal</a></li>
              <li><a href=\"all.php\">All</a></li>
            </ul>
          </li>
          <li><a href=\"Purchase.php\">Purchase Tickets</a></li>
          <li><a href=\"news.html\">News</a></li>
          <li><a href=\"profile.html\">Profile</a></li>
          <li><a href=\"adminlogout.php\">Logout</a></li>
        </ul>
      </nav>";

      echo "<h1>Admin Dashboard</h1>";
      echo "<div id='links'>";
      echo "<a href='manageUsers.php'>Manage Users</a>";
      echo "<a href='manageConcerts.php'>Manage Concerts</a>";
      echo "<a href='manageArtists.php'>Manage Artists</a>";
      echo "</div>";
    }
    else
    {
      isNotLoggedIn();
    }
  ?>

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
