<?php
session_start();
include('loginfunctions.php');

require_once "config.php";

$username = $password = $confirm_password = $email = $firstname = $lastname = "";
$username_err = $password_err = $confirm_password_err = $email_err = $firstname_err = $lastname_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
		$sql = "SELECT userID FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Error. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords did not match.";
        }
    }
	// Validate email
	if(empty(trim($_POST["email"]))){
        $email_err = "Please Enter Email Address.";
    } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
		$email_err = "Invalid email format.";
    } else{
		$email = trim($_POST["email"]);
    }
	//Validate firstname
	if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter first name.";
    } else {
		$firstname = trim($_POST["firstname"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
			$firstname_err = "Only letters and white space are allowed";
		} else {
			$firstname = trim($_POST["firstname"]);
		}
	}
	//Validate lastname
	if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter last name.";
    } else {
		$lastname = trim($_POST["lastname"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
			$lastname_err = "Only letters and white space are allowed";
		} else {
			$lastname = trim($_POST["lastname"]);
		}
    }


    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($firstname_err) && empty($lastname_err)){


        $sql = "INSERT INTO users (Username, Password, Email, Firstname, Lastname) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_email, $param_firstname, $param_lastname);


            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
			$param_email = $email;
			$param_firstname = $firstname;
			$param_lastname = $lastname;


            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="generalstylesheet.css">
	<link rel="stylesheet" type="text/css" href="register.css">
	<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
  <header>
  <img src="logo1.png" alt="midsommar music logo" height="55" width="55">
  </header>
  <?php if(isLoggedIn()){
    header('location:index.php');
  } ?>

    <h1>Sign Up</h1>
    <div class="form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<p>Please create an account.</p>

				<div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
					<label>Username</label>
					<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
					<br>
					<span class="error"><?php echo $username_err; ?></span>
				</div>
				<div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
					<label>Password</label>
					<input type="password" name="password" value="<?php echo $password; ?>" placeholder="Password">
					<br>
					<span class="error"><?php echo $password_err; ?></span>
				</div>
				<div <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
					<label>Confirm Password</label>
					<input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>" placeholder="Password">
					<br>
					<span class="error"><?php echo $confirm_password_err; ?></span>
				</div>
				<div <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>>
					<label>Email Address</label>
					<input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email Address">
					<br>
					<span class="error"><?php echo $email_err; ?></span>
				</div>
				<div <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>>
					<label>First Name</label>
					<input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="First Name">
					<br>
					<span class="error"><?php echo $firstname_err; ?></span>
				</div>
				<div <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>>
					<label>Last Name</label>
					<input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Last Name">
					<br>
					<span class="error"><?php echo $lastname_err; ?></span>
				</div>
				<div>
					<input type="submit" class="button" value="Submit">
					<input type="reset" class="button" value="Reset">
				</div>
				<p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>

    <?php include('footer.html');?>
</body>
</html>
