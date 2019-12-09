<?php
  session_start();
  include('loginfunctions.php');
  require_once "config.php";
  global $street_err, $city_err, $state_err;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Concert</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/generalstylesheet.css">
<link rel="stylesheet" href="css/add.css">

<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('header.html');?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $artist = htmlspecialchars($_POST['artist']);
  $street = htmlspecialchars($_POST['street']);
  $city = htmlspecialchars($_POST['city']);
  $state = htmlspecialchars($_POST['state']);
  $date = htmlspecialchars($_POST['date']);
  $time = htmlspecialchars($_POST['time']);
  $price = htmlspecialchars($_POST['price']);
  $street_err = $city_err = $state_err = "";

  if(regexCheck($street) && regexCheck($city) && ctype_alpha($state)){
    $insertQ = $link->prepare("INSERT INTO concerts VALUES(DEFAULT, ?, ?, ?, ?, ?, ?)");
    $insertQ->bind_param("ssssss", $artist, $street, $city, $state, $date, $time);

    if($insertQ->execute()){
        $concertID = mysqli_insert_id($link);

        $insertPrice = $link->prepare("INSERT INTO tickets VALUES(DEFAULT, ?, ?)");
        $insertPrice->bind_param("ii", $concertID, $price);

        if($insertPrice->execute()){
          echo "<script type='text/javascript'>alert('Concert successfully added!');</script>";
          header( "refresh:.5;url=manageconcerts.php" );
        }else {
          echo "Something went wrong.";
          //echo mysqli_error($link);
        }
      }else {
        echo "Something went wrong.";
        //echo mysqli_error($link);
      }

  }if(!regexCheck($street)){
    $street_err = "Street can only have letters, numbers, spaces, periods, single quotes, and or hyphens.";
  }if(!regexCheck($city)){
    $city_err = "City can only have letters, numbers, spaces, periods, single quotes, and or hyphens.";
  }if(!ctype_alpha($state)){
    $state_err = "State can only have 2 letters.";
  }
}
 ?>

<?php
    if (isLoggedInAdmin())
    {
      echo "<h1>Add Concert</h1>";

      $query = "SELECT Artist_name FROM artists";
      $artistq = mysqli_query($link, $query);
      $currDate = date("Y-m-d");

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
          <input type='text' name='street' id='street' required maxlength='25'></input>";
      echo"<div class='error'>".$street_err."</div>";
      echo"<label for='city'>City</label>
          <input type='text' name='city' id='city' required maxlength='25'></input>";
      echo"<div class='error'>".$city_err."</div>";
      echo"<label for='state'>State</label>
          <input type='text' name='state' id='state' required maxlength='2'></input>";
      echo "<div class='error'>".$state_err."</div>";
      echo"</fieldset>
          <fieldset>
          <legend>Date, Time & Price</legend>
          <label for='date'>Date</label>";
      echo"<input type='date' name='date' id='date' required min='".$currDate."'></input>";
      echo"
          <label for='time'>Time</label>
          <input type='time' name='time' id='time' required></input>
          <label for='price'>Price</label>
          <input type='number' name='price' id='price' min='1' required></input>";
      echo "</fieldset>
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

    include('footer.html');
    $link->close();
  ?>
