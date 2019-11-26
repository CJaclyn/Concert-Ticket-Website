<?php
session_start();
include('loginfunctions.php');
logout();
header("refresh:1;url=index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Logged Out</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/logout.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
  <?php include('header.html');?>
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
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  <h1>You are now logged out.</h1>
  <p>Returning to homepage. . .</p>
</body>
</html>
