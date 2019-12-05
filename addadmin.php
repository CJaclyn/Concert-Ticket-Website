<?php
  session_start();
  include('loginfunctions.php');
  require_once "config.php";
  global $user_err;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Admin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/generalstylesheet.css">
<link rel="stylesheet" href="css/addremoveadmin.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('header.html');?>
<?php
if (isset($_POST['username'])){
  require_once "config.php";
  $username = htmlspecialchars($_POST['username']);

  global $user_err;
  $user_err = "";

  if(usernameRegex($username)){
    $selectUserQ = $link->prepare("SELECT COUNT(1) FROM users WHERE Username = ? AND admin = 0");
    $selectUserQ->bind_param("s", $username);

    if($selectUserQ->execute()){
      $selectUserQ->bind_result($count);
      $selectUserQ->fetch();
      $selectUserQ->close();

      if($count == 1){
        if($addAdminQ = $link->query("UPDATE users SET admin = 1 WHERE Username = '".$username."'")){
          echo "<script type='text/javascript'>alert('User is now an admin!');</script>";
          header( "refresh:.5;url=manageusers.php" );

        }else {
          echo "ERROR making user an admin.";
          echo mysqli_error($link);
        }
      }else {
        $user_err = "No user found or user is already an admin";
      }
    }else {
      echo "ERROR with select query.";
      echo $link->error();
    }
  }else {
    $user_err = "Username can only contain letters, numbers, and underscores.";
  }
  $link->close();
}
 ?>

<?php
    if (isLoggedInAdmin()){
      echo "<h1>Add Admin Permissions</h1>";
      echo "<div class='centered'>";
      echo "<form method='POST' action=''>";
      echo "<label for='username'>Select User</label>";
      echo "<input name ='username' id='username'>";
      echo "<div class='error'>".$user_err."</div>";
      echo"
          <div class='centered'>
          <button type='submit' name='submit'>Add</button>
          </div>
        </form>
        </div>";

      }else{
      isNotLoggedInAdmin();
    }
  ?>
 </body>
 </html>
