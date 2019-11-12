<?php
function login(){
	if (isset($_POST['admin-username']) && isset($_POST['admin-password']))
	{
	  $username = $_POST['admin-username'];
	  $password = $_POST['admin-password'];

    if($username == "admin" && $password == "admin"){
          $_SESSION['valid_admin'] = $username;
    }

  }
}

function isLoggedIn()
{
	if (isset($_SESSION['valid_admin'])) {
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
		    <li><a href=\"adminlogout.php\">Logout</a></li>
				<li><span id='user'>Admin</a></li>
		  </ul>
		</nav>";

		return true;
	}else{
		return false;
	}
}

function logOut()
{
  if (isset($_SESSION['valid_admin'])) {
    unset($_SESSION['valid_admin']);
    session_destroy();
  }
}

function isNotLoggedIn(){
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

	echo '<div id="error"><h1>You need to be logged in as admin to see this page.</h1>';
	echo "<a href='index.php'>Go to homepage</a></div>";
}
 ?>
