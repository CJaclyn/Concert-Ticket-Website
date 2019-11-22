<?php
  session_start();
  if(isset($_SESSION['valid_admin'])){
      $old_user = $_SESSION['valid_admin'];
  }
  include('../loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/adminlogout.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('../header.html');?>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="concerts.php">Concerts<i class="down"></i></a>
        <ul>
          <li><a href="pop.php">Pop</a></li>
          <li><a href="rock.php">Rock</a></li>
          <li><a href="edm.php">EDM</a></li>
          <li><a href="metal.php">Metal</a></li>
          <li><a href="all.php">All</a></li>
        </ul>
      </li>
      <li><a href="Purchase.php">Purchase Tickets</a></li>
      <li><a href="News.php">News</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
  </nav>

<?php

  header( "refresh:1;url=../index.php" );
  if (!empty($old_user))
  {
    logOut();
    echo '<h2>You are now logged out.</h2>';
    echo '<p>Returning to homepage. . .</p>';
  }
  else
  {
    header('Location: index.php');
  }
?>

</body>
</html>
