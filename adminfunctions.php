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
 ?>
