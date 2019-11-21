<?php

function login(){
  require_once "config.php";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

      // Check if username is empty
      if(empty(trim($_POST["username"]))){
          $username_err = "Please enter username.";
      }else{
          $username = trim($_POST["username"]);
      }

      // Check if password is empty
      if(empty(trim($_POST["password"]))){
          $password_err = "Please enter your password.";
      }else{
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
                          if(SHA1($password) == $hashed_password){
                              session_start();

                              $_SESSION["loggedin"] = true;
                              $_SESSION["id"] = $userID;
                              $_SESSION["username"] = $username;

                              header("location: index.php");

                          }else{
                              $password_err = "The password you entered was not valid.";
                          }
                      }
                  }else{
                      $username_err = "No account found with that username.";
                  }
              }else{
                  echo "Oops! Something went wrong. Please try again later.";
              }

  		mysqli_stmt_close($stmt);
          }else{
  			       echo "Something's wrong with the query: " . mysqli_error($link);
  		      }
  		}
      mysqli_close($link);
  }
}

function isLoggedIn(){
  if (isset($_SESSION["loggedin"])) {
    $username = $_SESSION['username'];
		echo "
		<nav>
		  <ul>
		    <li><a href=\"index.php\">Home</a></li>
		    <li><a href=\"concerts.php\">Concerts<i class=\"down\"></i></a>
		      <ul>
		        <li><a href=\"pop.php\">Pop</a></li>
		        <li><a href=\"rock.php\">Rock</a></li>
		        <li><a href=\"edm.php\">EDM</a></li>
		        <li><a href=\"metal.php\">Metal</a></li>
		        <li><a href=\"all.php\">All</a></li>
		      </ul>
		    </li>
		    <li><a href=\"Purchase.php\">Purchase Tickets</a></li>
		    <li><a href=\"News.php\">News</a></li>
		    <li><a href=\"profile.php\">Profile</a></li>
		    <li><a href=\"logout.php\">Logout</a></li>
        <li><span id='user'>$username</span></a></li>
		  </ul>
		</nav>";
    return true;
  }else {
    echo "<nav>
        <ul>
          <li><a href=\"index.php\">Home</a></li>
          <li><a href=\"concerts.php\">Concerts<i class=\"down\"></i></a>
            <ul>
              <li><a href=\"pop.php\">Pop</a></li>
              <li><a href=\"rock.php\">Rock</a></li>
              <li><a href=\"edm.php\">EDM</a></li>
              <li><a href=\"metal.php\">Metal</a></li>
              <li><a href=\"all.php\">All</a></li>
            </ul>
          </li>
          <li><a href=\"Purchase.php\">Purchase Tickets</a></li>
          <li><a href=\"News.php\">News</a></li>
          <li><a href=\"login.php\">Login</a></li>
        </ul>
      </nav>";
    return false;
  }
}

function logout(){
  if (isset($_SESSION['loggedin'])) {
  $_SESSION = array();
  session_destroy();
}
}
?>
