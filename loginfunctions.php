<?php
function isLoggedIn(){
  if (isset($_SESSION["loggedin"])) {
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
?>
