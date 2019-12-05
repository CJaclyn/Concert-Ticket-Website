<?php
session_start();
include('loginfunctions.php');
loginAdmin();
global $user_err, $pass_err;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/generalstylesheet.css">
<link rel="stylesheet" href="css/adminlogin.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>

<body>
<?php include('header.html');?>

  <?php
  if (isLoggedInAdmin()){
    echo "<h1>Redirecting to Admin Page. . .</h1>";
    header("refresh:1;url=adminpage.php");

  }elseif(isset($_SESSION['username'])){
    header('location:index.php');
  }
  else{
    echo '
    <h2>Admin Login</h2>
    <div id="form">
      <form action="adminlogin.php" method="post" name="adminForm">
        <label for="username">Admin Username</label>
        <input type="text" id="username" name="username" required><br>';
    echo "<div class='error'>".$user_err."</div>";
    echo'
        <label for="password">Admin Password</label>
        <input type="password" id="password" name="password" required>';
    echo "<div class='error'>".$pass_err."</div>";
    echo'
        <div id="button"><button type="submit">Login</button></div>
      </form>
    </div>
    ';
    include('footer.html'); 
  }
  ?>

</body>
</html>
