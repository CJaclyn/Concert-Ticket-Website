<?php

session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

require_once "config.php";
 

$username = $password = "";
$username_err = $password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
       
        $sql = "SELECT userID, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
           
            $param_username = $username;
            
           
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    
                    mysqli_stmt_bind_result($stmt, $userID, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            session_start();
                            
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $userID;
                            $_SESSION["username"] = $username;                            
                            
                           
                            header("location: index.php");
                        } else{
                            
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
			        
		mysqli_stmt_close($stmt);
        }
        else {
			echo "Something's wrong with the query: " . mysqli_error($link);
		}
     

		}
    
    mysqli_close($link);
}
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
  <nav>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="concerts.html">Concerts<i class="down"></i></a>
			<ul>
				<li><a href="pop.php">Pop</a></li>
				<li><a href="rock.php">Rock</a></li>
				<li><a href="edm.php">EDM</a></li>
				<li><a href="metal.php">Metal</a></li>
				<li><a href="all.php">All</a></li>
			</ul>
		</li>
		<li><a href="purchase.php">Purchase Tickets</a></li>
		<li><a href="news.html">News</a></li>
		<li><a href="profile.php">Profile</a></li>
		<li><?php if(isset($_SESSION['id'])){ ?>
				<a class="link" href="logout.php" style="text-decoration:none">logout</a>
			<?php }else{ ?>
				<a class="link" href="login.php" style="text-decoration:none">login</a>
			<?php } ?>
		</li>
    </ul>
  </nav>
  
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
</body>
</html>