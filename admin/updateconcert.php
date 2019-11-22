<?php
  session_start();
  include('../loginfunctions.php');
  require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Update Concert</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/update.css">

<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('../header.html');?>

<?php
  $currDate = date("Y-m-d");
    if (isLoggedIn())
    {
      echo "<h1 id='update'>Update Concert</h1>";

      echo "<form method='POST' action=''>
          <label for='date'>Date</label>
          <input type='date' name='date' id='date' min='".$currDate."'></input>";
      echo "<label for='time'>Time</label>
          <input type='time' name='time' id='time'></input>
          <div id='centered'>
          <button type='submit'>Update</button>
          </div>
        </form>";

    }
    else
    {
      isNotLoggedInAdmin();
    }
  ?>

  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = strip_tags($_GET['id']);
    $date = strip_tags($_POST['date']);
    $time = strip_tags($_POST['time']);

    $dateQuery = mysqli_prepare($link, "UPDATE concerts SET Date = ? WHERE concertID = '".$id."'");
    $timeQuery = mysqli_prepare($link, "UPDATE concerts SET Time = ? WHERE concertID = '".$id."'");

    mysqli_stmt_bind_param($dateQuery,"s", $date);
    mysqli_stmt_bind_param($timeQuery,"s", $time);

    if(!empty($date) && !empty($time)){
      if($dateQuery->execute() && $timeQuery->execute()){
        echo "<script type='text/javascript'>alert('Date & Time Succesfully Updated!');</script>";
        header( "refresh:.5;url=manageConcerts.php" );
      }else{
          echo "ERROR: Could not able to execute $dateQuery. " . mysqli_error($db);
          echo "ERROR: Could not able to execute $timeQuery. " . mysqli_error($db);
      }
    }elseif(!empty($date) && empty($time)){
      if($dateQuery->execute()){
        echo "<script type='text/javascript'>alert('Date Successfully Updated!');</script>";
        header( "refresh:.5;url=manageConcerts.php" );
      }else{
        echo "ERROR: Could not able to execute $dateQuery. " . mysqli_error($db);
      }
    }elseif(!empty($time) && empty($date)){
      if($timeQuery->execute()){
        echo "<script type='text/javascript'>alert('Time Successfully Updated!');</script>";
        header( "refresh:.5;url=manageConcerts.php" );
      }else{
        echo "ERROR: Could not able to execute $timeQuery. " . mysqli_error($db);
      }
    }else {
      header('location:updateconcert.php');
    }
    mysqli_close($link);
  }

  include('../footer.html');
   ?>
