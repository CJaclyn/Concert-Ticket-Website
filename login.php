<?php
session_start();
include('loginfunctions.php');
login();

$username = $password = "";
$username_err = $password_err = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="generalstylesheet.css">
	<link rel="stylesheet" type="text/css" href="login.css">
	<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
  <header>
  <img src="logo1.png" alt="midsommar music logo" height="55" width="55">
  </header>
  <?php if(isLoggedIn()){
    header('location:index.php');
  } ?>

  <h1>Login</h1>
<div class="form">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<fieldset class="subform">
			<p>Please fill in your credentials to login.</p>
				<div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
					<label>Username</label>
					<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
					<br>
					<span class = "error"><?php echo $username_err; ?></span>
				</div>
				<div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
					<label>Password</label>
					<input type="password" name="password" placeholder="Password">
					<br>
					<span class = "error"><?php echo $password_err; ?></span>
				</div>
				<div>
					<input type="submit" class ="button" value="Login">
				</div>
				<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
			</form>
		</fieldset>
</div>

<?php include('footer.html');?>
</body>
</html>
