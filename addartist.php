<?php
  session_start();
  include('loginfunctions.php');
  require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Artist</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/add.css">

<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
  <div class="page-wrap">
<?php include('header.html');?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $artist = htmlspecialchars($_POST['artistname']);
  $genre = $_POST['genre'];

  if(regexCheck($artist)){
    //select query
    $selectQ = $link->prepare("SELECT COUNT(1) FROM artists WHERE Artist_name = ?");
    $selectQ->bind_param("s", $artist);

    if($selectQ->execute()){
      $selectQ->bind_result($count);
      $selectQ->fetch();

      if ($count == 0){
        $selectQ->close();

        //insert query
        $insertQ = $link->prepare("INSERT INTO artists(Artist_name, Genre) VALUES(?, ?)");
        $insertQ->bind_param("ss", $artist, $genre);

        if($insertQ->execute()){
          echo "<script type='text/javascript'>alert('Artist successfully added!');</script>";
          header( "refresh:.5;url=manageartists.php" );

        }else {
          echo "ERROR adding artist.<br>";
          echo mysqli_error($link);

        }
      }else {
        $selectQ->close();
        echo "<script type='text/javascript'>alert('Artist already exists!');</script>";

      }
    }else{
      echo "ERROR selecting artist query.<br>";
      echo mysqli_error($link);

    }
    $link->close();

  }else {
    echo "<script type='text/javascript'>alert('Please try again. The artist name can only contain numbers, letters, hyphens, periods, and or spaces.');</script>";
  }
}

    if (isLoggedInAdmin())
    {
      echo "<h1>Add Artist</h1>";

      $currDate = date("Y-m-d");

      echo "<div class='centered'>";
      echo "<form method='POST' action=''>";
      echo "<fieldset>";
      echo "<legend>Artist</legend>";
      echo "<label for='artistname'>Artist</label>";
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
      isNotLoggedInAdmin();
    }
  ?>
</div>
  <?php
    include('footer.html');
   ?>
