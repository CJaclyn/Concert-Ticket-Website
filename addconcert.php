<?php
  session_start();
  include('adminfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Concert</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="addConcert.css">
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
      echo "<h1>Add Concert</h1>";
      require_once "config.php";

      $query = "SELECT Artist_name FROM artists";
      $artistq = mysqli_query($link, $query);

      echo "<div class='centered'>";
      echo "<form method='POST' action=''>";
      echo "<fieldset>";
      echo "<legend>Artist</legend>";
      echo "<label for='artist'>Artist</label>";
      echo "<select name='artist' id='artist'>";
        if(mysqli_query($link, $query)){
          while ($row = mysqli_fetch_array($artistq)) {
                      $name = $row['Artist_name'];
                      echo '<option value="'.$name.'">'.$name.'</option>';
          }
        }
      echo "</select>";
      echo "</fieldset>";
      echo"
          <fieldset>
          <legend>Location</legend>
          <label for='street'>Street</label>
          <input type='text' name='street' id='street' required maxlength='25'></input>
          <label for='city'>City</label>
          <input type='text' name='city' id='city' required maxlength='25'></input>
          <label for='state'>State</label>
          <input type='text' name='state' id='state' required maxlength='2'></input>
          </fieldset>
          <fieldset>
          <legend>Date & Time</legend>
          <label for='date'>Date</label>
          <input type='date' name='date' id='date' required></input>
          <label for='time'>Time</label>
          <input type='time' name='time' id='time' required></input>
          </fieldset>
          <div class='centered'>
          <button type='submit'>Add</button>
          </div>
        </form>";
      echo"</div>";
    }
    else
    {
      isNotLoggedIn();
    }
  ?>

  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $artist = $_POST['artist'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $insertQuery = mysqli_prepare($link, "INSERT INTO concerts VALUES(DEFAULT, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($insertQuery,"ssssss", $artist, $street, $city, $state, $date, $time);

    if($insertQuery->execute()){
      echo "<script type='text/javascript'>alert('Concert successfully added!');</script>";
      header( "refresh:.5;url=manageconcerts.php" );
    }
    else {
      echo "ERROR: ".mysqli_error($link);
    }

    mysqli_close($link);

  }
    include('footer.html');
   ?>
