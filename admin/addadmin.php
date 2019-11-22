<?php
  session_start();
  include('../loginfunctions.php');
  require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Admin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" href="/Concert-Ticket-Website/css/addremoveadmin.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('../header.html');?>
<?php
    if (isLoggedIn())
    {
      echo "<h1>Add Admin Permissions</h1>";

      if($result=$link->query("SELECT Username FROM users WHERE admin = 0 ORDER BY created ASC")){
        echo "<div class='centered'>";
        echo "<form method='POST' action=''>";
        echo "<label for='username'>Select User</label>";
        echo "<select name='username' id='username'>";
            while ($row=$result->fetch_array()) {
              $username = $row['Username'];
              echo '<option value="'.$username.'">'.$username.'</option>';
            }
        echo "</select>";
        echo"
            <div class='centered'>
            <button type='submit' name='submit'>Add</button>
            </div>
          </form>
          </div>";


      }else {
        echo mysqli_error($link);
      }
    }
    else
    {
      isNotLoggedInAdmin();
    }
  ?>

  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];

    if($addAdminQ = $link->query("UPDATE users SET admin = 1 WHERE Username = '".$username."'")){
      echo "<script type='text/javascript'>alert('User is now an admin!');</script>";
      header( "refresh:.5;url=manageusers.php" );
    }
    else {
      echo "ERROR making user an admin.";
      echo mysqli_error($link);
    }
      $link->close();
  }

    include('../footer.html');
   ?>
