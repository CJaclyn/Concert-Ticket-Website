<?php
session_start();
include('loginfunctions.php');
header("refresh:2;url=order.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Checking Out</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="checkout.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('header.html');?>
<?php isLoggedIn() ?>
  <h1>Finishing Checkout.</h1>
  <p>Please Wait A Moment. . .</p>
  <?php include('footer.html')?>
</body>
</html>
