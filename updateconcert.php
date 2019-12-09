<?php
  session_start();
  include('loginfunctions.php');
  require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Update Concert</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/generalstylesheet.css">
<link rel="stylesheet" href="css/update.css">

<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('header.html');?>

<?php
    if (isLoggedInAdmin()){
      echo "<h1 id='update'>Update Concert</h1>";
      echo "<form method='POST' action=''>
              <label for='date'>Price</label>
              <input type='number' name='price' id='price' min='1'></input>
              <div id='centered'>
                <button type='submit'>Update</button>
              </div>
            </form>";
    }else{
      isNotLoggedInAdmin();
    }
  ?>

  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = strip_tags($_GET['id']);
    $price = htmlspecialchars($_POST['price']);

    $priceQuery = mysqli_prepare($link, "UPDATE tickets SET Price = ? WHERE concertID = '".$id."'");
    mysqli_stmt_bind_param($priceQuery,"i", $price);

    if(!empty($price)){
      if($priceQuery->execute()){
        echo "<script type='text/javascript'>alert('Concert ticket price successfully updated!');</script>";
        header( "refresh:.5;url=manageConcerts.php" );
      }else{
          echo "ERROR: Could not able to execute $priceQuery. " . mysqli_error($db);
      }
    }else {
      header('location:updateconcert.php');
    }
    mysqli_close($link);
  }
   ?>
