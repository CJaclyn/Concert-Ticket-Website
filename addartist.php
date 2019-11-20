<?php
  session_start();
  include('adminfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Artist</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/add.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/adminerror.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('header.html');?>
<?php
    if (isLoggedIn())
    {
      echo "<h1>Add Artist</h1>";
      require_once "config.php";

      $currDate = date("Y-m-d");

      echo "<div class='centered'>";
      echo "<form method='POST' action=''>";
      echo "<fieldset>";
      echo "<legend>Artist</legend>";
      echo "<label for='artistname'>Artist<label>";
      echo "<input type='text' name='artistname' id='artistname' required max='25'>";
      echo "<label for='genre'>Genre</label>";
      echo "<select name='genre' id='genre'>";
      echo "<option value='Pop'>Pop</option>";
      echo "<option value='Rock'>Rock</option>";
      echo "<option value='EDM'>EDM</option>";
      echo "<option value='Metal'>Metal</option>";
      echo "</select>";
      echo "</fieldset>";
      echo"
          <fieldset>
          <legend>Image</legend>
          UPLOAD IMAGE CODE HERE
          </fieldset>
          <div class='centered'>
          <button type='submit'>Add</button>
          </div>
        </form>
        </div>";
    }
    else
    {
      isNotLoggedIn();
    }
  ?>

  <?php
  include('functions.php');

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $artist = strip_tags($_POST['artistname']);
    $genre = $_POST['genre'];

    if(regexCheck($artist)){
      $insertQuery = mysqli_prepare($link, "INSERT INTO artists(artistID, Artist_name, Genre) VALUES(DEFAULT, ?, ?)");
      mysqli_stmt_bind_param($insertQuery,"ss", $artist, $genre);

      if($insertQuery->execute()){
        echo "<script type='text/javascript'>alert('Artist successfully added!');</script>";
        header( "refresh:.5;url=manageartists.php" );
      }
      else {
        echo "ERROR adding artist.";
        //echo mysqli_error($link);
      }
      mysqli_close($link);

    }else {
      echo "<script type='text/javascript'>alert('Please try again. The artist name
      can only contain numbers, letters, hyphens, periods, and or spaces.');</script>";
    }
  }

    include('footer.html');
   ?>
