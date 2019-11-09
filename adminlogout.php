<?php
  session_start();
  if(isset($_SESSION['valid_admin'])){
      $old_user = $_SESSION['valid_admin'];
  }
  include('adminfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="adminlogout.css">
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

<?php

  header( "refresh:1;url=index.php" );
  if (!empty($old_user))
  {
    logOut();
    echo '<h2>You are now logged out.</h2>';
    echo '<p>Returning to homepage. . .</p>';
  }
  else
  {
    echo '<h2>You were not logged in, and so have not been logged out.</h2>';
    echo '<p>Returning to homepage. . .</p>';
  }
?>

</body>
</html>
