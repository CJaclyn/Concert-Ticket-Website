<?php
session_start();
include('loginfunctions.php');
?>

<!DOCTYPE html>
<head>
<title>Profile Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="generalstylesheet.css">
<link rel="stylesheet" type="text/css" href="Profile.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
<script>
function myFunction1() {
  var x = document.getElementById("div1");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function myFunction2() {
  var x = document.getElementById("div2");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function myFunction3() {
  var x = document.getElementById("div3");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
</head>
<body>
<?php include('header.html');?>
  <?php isLoggedIn(); ?>


<div class = "row">	
<div class ="header centered">
<img src="profileheader.jpg">
<h1><?php echo $_SESSION['username']; ?></h1>
</div>
<?php
include("config.php");

if(isset($_POST['upload_profile'])){
 
  $profile = $_FILES['file']['name'];
  $target_dir = "Profile/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  $extensions_arr = array("jpg","jpeg","png","gif", "jfif");


  if( in_array($imageFileType,$extensions_arr) ){
 
     $query = "UPDATE users SET prof_picture = '".$profile."' WHERE username='".$_SESSION['username']."'";
     mysqli_query($link,$query);
  
     move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$profile);

  }

}
?> 
<div class = "leftcolumn">
	<?php
	$sql = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_array($result);
	
	?>
	<div id = "boxshadow">
	<img src="Profile/<?php echo $row['prof_picture']; ?>" height="300" width="300" ><?php
	?>
	</div>
	<div class = "form">
	<button onclick="myFunction1()" class="button4" style="background-color:#f14e4e">Upload Profile Picture</button>
	<div class = "hide" id="div1">
		<form method="post" action="" enctype='multipart/form-data'>
			<input class = "button" type='file' name='file' />
			<input class = "button" type='submit' value='Upload Image' name='upload_profile'>
		</form>
<	/div>
	</div>
</div>
</div>
<div class = "row">
	<div class = "infoleft">
		<div class = "card">

	        <?php
			$sql = "SELECT * FROM users where username='".$_SESSION['username']."'";

			$result = mysqli_query($link,$sql);
			echo "<fieldset class='info'>";
			echo "<legend>Personal Information</legend>";
			echo "<table>";
			while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>First Name:</td>";
				echo "<td>" . $row['Firstname'] . "</td>";
				echo "</tr><tr>";
				echo "<td>Last Name:</td>";
				echo "<td>" . $row['Lastname'] . "</td>";
				echo "</tr><tr>";
				echo "<td>Email: </td>";
				echo "<td>" . $row['Email'] . "</td>";			
				echo "</tr><tr>";
				echo "<td>Street:</td>";
				echo "<td>" . $row['Street'] . "</td>";
				echo "</tr><tr>";
				echo "<td>City</td>";
				echo "<td>" . $row['City'] . "</td>";
				echo "</tr><tr>";
				echo "<td>State:</td>";
				echo "<td>" . $row['State'] . "</td>";
				echo "</tr>";

			}
			echo "</table>";
			echo "</fieldset>";
        ?>
		</div>
	</div>
	<div class = "inforight">
		<div class = "card">

        <?php
        $userID = $_SESSION["id"];
	
		$sql = "SELECT * FROM orders WHERE orderID = (SELECT max(orderID) FROM orders) AND userID = ".$userID."";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_array($result)) {
			$orderID = $row['orderID'];
			$date = $row['date'];
        }

        $sql = "SELECT * FROM order_tickets WHERE orderID = ".$orderID."";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $ticketID = $row['ticketID'];
            $tickets = $row['quantity'];
            $total = $row['total'];
        }

        $sql = "SELECT * FROM tickets WHERE ticketID = ".$ticketID."";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $concertID = $row['concertID'];
            $price = $row['Price'];
        }
        
			$sql = "SELECT Artist, artists.Image, Street, City, State, DATE_FORMAT(Date, '%a %b %e %Y') Date, TIME_FORMAT(Time, '%h %i %p') Time
			FROM concerts
			INNER JOIN artists ON artists.Artist_name = concerts.Artist
			WHERE concertID = ".$concertID."";

			$result = mysqli_query($link,$sql);
			echo "<fieldset class='info'>";
			echo "<legend>Recent Order</legend>";
			echo "<table>";
			$result = mysqli_query($link,$sql);
			while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<div class =\"right\">";
				echo "<div id =\"boxshadow\">";
				echo "<img src='". $row['Image']."'width='300'>"."<br />";
				echo "</div>";
				echo "</div>";
				echo "<tr>";
				echo "<td>Artist:</td>";
				echo "<td>" . $row['Artist'] . "</td>";
				echo "</tr><tr>";
				echo "<td>Date:</td>";
				echo "<td>" . $row['Date'] . "</td>";
				echo "</tr><tr>";
				echo "<td>Time:</td>";
				echo "<td>" . $row['Time'] . "</td>";
				echo "</tr><tr>";
				echo "<td>Street</td>";
				echo "<td>" . $row['Street'] . "</td>";
				echo "</tr><tr>";
				echo "<td>City: </td>";
				echo "<td>" . $row['City'] . "</td>";
				echo "</tr><tr>";
				echo "<td>State:</td>";
				echo "<td>" . $row['State'] . "</td>";
				echo "</tr><tr>";					
				echo "<td>Tickets: </td>";
				echo "<td>" . $tickets . "</td>";
				echo "</tr><tr>";				
				echo "<td>Total: </td>";
				echo "<td>$" . $total . "</td>";
				echo "</tr><tr>";				
				echo "<td>Date Purchased: </td>";
				echo "<td>" . $date . "</td>";
				echo "</tr>";

			}
			echo "</table>";
			echo "</fieldset>";

		?>
		</div>
	</div>
</div>
<div class ="row">
	<h1 class="head">Favorite Artists</h1>
	<!--<div>
	<button onclick="myFunction2()">Update Favorite Artists</button>
	<div class = "hide" id = "div2">
	<form method="post" action="">
    <fieldset class="card">
	<?php
		$sql = "SELECT * FROM artists";
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($result);
		echo "<ul class = 'checkbox'>";
		while($row = mysqli_fetch_array($result)){
			echo "<li><input type='checkbox' name='".$row['Artist_name']. "'> " .$row['Artist_name']."<li>";
			echo "<br>";
		}
		echo "</ul>";
		?>
        <input type="submit" value="Update Favorite Artists" />
    </fieldset>
	</form>
	</div>-->
</div>
	<div class = "concerts">
	<table style ="width: 100%">
		<tr>
			<th class="th1">Seven Lions</th>
			<th class="th1">Arctic Monkeys</th>
			<th class="th1">Lana Del Rey</th>
			<th class="th1">Illenium</th>
			<th class="th1">Milky Chance</th>
		</tr>
		<tr>
			<td><img src="/concert-ticket-website/artistphotos/Seven_Lions.jfif" class="img1"</td>
			<td><img src="/concert-ticket-website/artistphotos/Arctic_Monkeys.jfif" class="img1"</td>
			<td><img src="/concert-ticket-website/artistphotos/Lana_Del_Rey.jfif" class="img1"</td>
			<td><img src="/concert-ticket-website/artistphotos/Illenium.jfif" class="img1"</td>
			<td><img src="/concert-ticket-website/artistphotos/Milky_Chance.jfif" class="img1"</td>
		</tr>
	</table>
</div>
</div>
<div class ="row">
	<h1 class="head">Concert Pictures</h1>

<div class = "concerts">
<?php

if(isset($_POST['upload_concert'])){
 
  $name = $_FILES['file']['name'];
  $target_dir2 = "upload/";
  $target_file2 = $target_dir2 . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr2 = array("jpg","jpeg","png","gif", "jfif");

  // Check extension
  if( in_array($imageFileType2,$extensions_arr2) ){
 
     $query = "REPLACE INTO images(user_id, name, username) values('".$_SESSION['id']."', '".$name."', '".$_SESSION['username']."')";
     mysqli_query($link,$query);
  
     move_uploaded_file($_FILES['file']['tmp_name'],$target_dir2.$name);
  }

}
?>
	<div class = "form">
	<button onclick="myFunction3()" class="button4" style="background-color:#f14e4e">Upload Concert Pictures</button>
	<div class = "hide" id = "div3">
		<form class = "form" method="post" action="" enctype='multipart/form-data'>
			<input class = "button" type='file' name='file'>
			<input class = "button" type='submit' value='Upload Image' name='upload_concert'>
		</form>
	</div>
</div>
<div>
<?php
$sql = "SELECT * FROM images WHERE username='".$_SESSION['username']."'";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_array($result);


echo"<tr>"; 

$i=0; //keeps count of the row
while($row = mysqli_fetch_array($result))
{
   $i=$i+1;

   echo "<td>";?><img src="Upload/<?php echo $row['name']; ?>" height="400" width="33%" ><?php echo"</td>";

  if($i%4==0)
  {
    echo"</tr>";
  }
if($i%4!=0)
{
   echo"</tr>";
}

}  
mysqli_close($link);
?>
</div>
</div>
</div>
<?php include('footer.html'); ?>
</body>
</html>