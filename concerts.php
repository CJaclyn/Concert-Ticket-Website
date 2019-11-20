<?php
session_start();
include('loginfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Concerts</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/concerts.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">

</head>
<body>
<?php include('header.html');?>
<?php isLoggedIn()?>

  <h1>Explore Concerts</h1>

    <form class="searchbar" action="searchresult.php" method="post">
      <input type="text" name="userSrch" placeholder="Artist or band">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>

  <div class="row">
    <div class="column left">
      <a href="pop.php"><video autoplay loop muted>
        <source src="/concertvids/ts.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video></a>
      <div class="centered l"><a href="pop.php">Pop</a></div>
    </div>
    <div class="column right">
      <a href="rock.php"><video autoplay loop muted>
        <source src="/Concert-Ticket-Website/concertvids/rock.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video></a>
      <div class="centered r"><a href="rock.php">Rock</a></div>
    </div>
  </div>
  <div class="row">
    <div class="column left">
      <a href="edm.php"><video autoplay loop muted>
        <source src="/Concert-Ticket-Website/concertvids/edm.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video></a>
      <div class="centered l"><a href="edm.php">EDM</a></div>
    </div>
    <div class="column right">
      <a href="metal.php"><video autoplay loop muted>
        <source src="/Concert-Ticket-Website/concertvids/metal.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video></a>
      <div class="centered r"><a href="metal.php">Metal</a></div>
    </div>
  </div>
  <div class="row">
    <div class="column">
      <a href="all.php"><video autoplay loop muted>
        <source src="/Concert-Ticket-Website/concertvids/all.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video></a>
      <div class="centered mid"><a href="all.php">All Concerts</a></div>
    </div>
  </div>

<?php include('footer.html'); ?>
</body>
</html>
