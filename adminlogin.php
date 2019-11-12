<?php
session_start();
include('adminfunctions.php');
login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="generalstylesheet.css">
<link rel="stylesheet" href="adminlogin.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>

<body>
  <header>
  <img src="logo1.png" alt="midsommar music logo" height="55" width="55">
  </header>

  <?php
  if (isLoggedIn()){
    echo "<h1>Redirecting to Admin Page. . .</h1>";
    header("refresh:1;url=adminpage.php");
  }else{
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
  		</ul>
  	</nav>";

    echo"
    <h2>Admin Login</h2>
    <div id=\"form\">
      <form action=\"adminlogin.php\" method=\"post\" name=\"adminForm\" onsubmit=\"return validation();\">
        <label for=\"admin-username\">Admin Username</label>
        <input type=\"text\" id=\"admin-username\" name=\"admin-username\" required><span id=\"validate-adminU\"></span><br>
        <label for=\"admin-password\">Admin Password</label>
        <input type=\"password\" id=\"admin-password\" name=\"admin-password\" required><span id=\"validate-adminP\"></span><br>
        <button type=\"submit\">Login</button>
      </form>
    </div>";
  }

    include('footer.html');
  ?>

  <script>
  function validation(){
    var username, password;
    username = document.getElementById("admin-username").value;
    password = document.getElementById("admin-password").value;

    if(username == "admin" && password == "admin"){
      login();
      return true;
    }else {
      alert("Invalid admin credentials!");
      if(username !== "admin" && password == "admin"){
        document.getElementById("validate-adminU").innerHTML = "Admin username invalid.";
        document.getElementById("validate-adminP").innerHTML = "";
        return false;
      }
      if(password !== "admin" && username == "admin"){
        document.getElementById("validate-adminP").innerHTML = "Admin password invalid.";
        document.getElementById("validate-adminU").innerHTML = "";
        return false;
      }
      if(username != "admin" && password != "password"){
        document.getElementById("validate-adminU").innerHTML = "Admin username invalid.";
        document.getElementById("validate-adminP").innerHTML = "Admin password invalid.";
        return false;
      }
    }

  }
  </script>

</body>
</html>
