<?php
session_start();
include('loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>About Us</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/generalstylesheet.css">
<link rel="stylesheet" href="css/about.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>

<body>
  <?php include('header.html');?>
  <?php isLoggedIn(); ?>
  <div id='container'>
    <div class='centered'>
      <img src="images/logo1.png" alt="midsommar music logo" height="75" width="75">
    </div>
      <h1>Midsommar Music</h1>
      <h2>About Us</h2>
      <p>We are a concert ticket selling website in Minnesota founded in 1970. We
        love bringing people of all different types of backgrounds together to share
        the common passion for music.
      </p>
      <h2>History</h2>
      <p>In 1970, Bob Bob chased his dreams of opening a music venue and used his
        savings from working at McBob's to open a music venue in his hometown of
        Bobland, Minnesota. At that time it wasn't called Midsommar Music; it was
        called Bob's Music Venue. In the beginning, he just hosted local artists.
        Bob's Music Venue had a breakthrough in 1982 when Michael Jackson
        wanted to have a concert at Bob's Music Venue. After that, Bob's Music Venue
        was put on the map. Famous artists started adding Bobland to their tours.
        Bob decided that he would change his venue to Midsommar Music so as to make
        the venue sound less small town, expanded his original venue, and opened several
        more venues throughout Minnesota over the years. Bob Bob died in 2010, but his
        legacy still lives on through Midsommer Music.
      </p>
  </div>

  <div class='centered'>
    <img src='images/ledzep.jpg' alt='concert photo' width='300px'>
    <img src='images/queen.jpg' alt='concert photo' width='300px'>
    <img src='images/spears.jpg' alt='concert photo' width='300px'>
  </div>

  <?php include('footer.html');?>
</body>
</html>
