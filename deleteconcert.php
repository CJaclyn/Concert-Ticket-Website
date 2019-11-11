<?php
  session_start();
  include('adminfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Delete Concert</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="deleteconcert.css">
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
      require_once "config.php";
      echo "<h1 id='delete'>Delete Concert</h1>";
      echo "<form method='post'>";
      echo "<label>Confirm Deletion</label>";
      echo "<button type='submit' name='delete' id='deletebut'>Delete</button>";
      echo "</form>";
    }
    else
    {
      isNotLoggedIn();
    }
  ?>

  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_GET['id'];

    $query = "DELETE FROM concerts WHERE concertID='".$id."'";

    if(mysqli_query($link, $query)){
      echo "<script type='text/javascript'>alert('Concert successfully deleted!');</script>";
      header( "refresh:.5;url=manageconcerts.php" );
    }else {
      echo "ERROR: Could not able to execute $query. ".mysqli_error($db);
    }

  }

  include('footer.html');
   ?>
