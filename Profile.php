<?php
session_start();
include('loginfunctions.php');
?>

<!DOCTYPE html>
<head>
<title>Profile Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" type="text/css" href="/Concert-Ticket-Website/css/Profile.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
  <?php include('header.html');?>
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



<?php
require_once("config.php");

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


	<h1><?php echo $_SESSION['username']; ?>'s Profile</h1>
	<section>
		<div class="image">
		<?php
		$sql = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($result);

		?><img src="Profile/<?php echo $row['prof_picture']; ?>" height="400" width="400" class="img">

		<form method="post" action="" enctype='multipart/form-data'>
		<p>Select New Profile Picture</p>
		<input class = "button" type='file' name='file' />
		<input class = "button" type='submit' value='Upload Image' name='upload_profile'>
		</form>
		</div>
		<br>
		<br>
		<div class = "wrapper">
		<div>
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
				echo "<td>Street:</td>";
				echo "<td>" . $row['Street'] . "</td>";
				echo "</tr><tr>";
				echo "<td>Last Name:</td>";
				echo "<td>" . $row['Lastname'] . "</td>";
				echo "<td>City</td>";
				echo "<td>" . $row['City'] . "</td>";
				echo "</tr><tr>";
				echo "<td>Email: </td>";
				echo "<td>" . $row['Email'] . "</td>";
				echo "<td>State:</td>";
				echo "<td>" . $row['State'] . "</td>";
				echo "</tr>";

		}
		echo "</table>";
		echo "</fieldset";
        ?>
		</div>
		<!--
		<div class="form">
		<?php
		$sql = "SELECT * FROM users where username='".$_SESSION['username']."'";

		$result = mysqli_query($link,$sql);
		echo "<fieldset class='info'>";
			echo "<legend>Orders</legend>";
			while($row = mysqli_fetch_array($result)) {
				echo "Concert: ";
				echo "Date: ";
				echo "Price: ";
		}
		echo "</fieldset>";
        ?>
		</div>
		-->
</section>
</div>
<section class="a2">
	<h3>Favorite Bands/Artists</h3>
	<!--<form method="post" action="">
    <fieldset>
		<?php
		$sql = "SELECT * FROM artists";
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($result);

		while($row = mysqli_fetch_array($result)){
			echo "<input type='checkbox' name='".$row['Artist_name']. "'> " .$row['Artist_name'] ;
		}

		?>
        <input type="checkbox" name="favorite_pet" value="Cats">Cats<br>
        <input type="checkbox" name="favorite_pet" value="Dogs">Dogs<br>
        <input type="checkbox" name="favorite_pet" value="Birds">Birds<br>
        <br>
        <input type="submit" value="Submit now" />
    </fieldset>
</form>
-->
	<table style ="width: 100%">
		<tr>
			<th class="th1">Seven Lions</th>
			<th class="th1">Slander</th>
			<th class="th1">Said the Sky</th>
			<th class="th1">Illenium</th>
			<th class="th1">Rezz</th>
		</tr>
		<tr>
			<td><img src="https://d3vhc53cl8e8km.cloudfront.net/hello-staging/wp-content/uploads/2014/05/25232225/hak2mppaisjKrQ5e9PJb7xRwNh1KJfnvBuwNRjqo-972x597.jpeg" class="img1"</td>
			<td><img src="http://beachclub.com/wp-content/uploads/2019/06/BC_2019_slander-1.jpg" class="img1"</td>
			<td><img src="https://www.lollapalooza.com/wp-www-lollapalooza-com/wp/wp-content/uploads/2019/03/saidthesky2-b5f08f9a.jpg" class="img1"</td>
			<td><img src="https://m.media-amazon.com/images/I/81Nj1uIGwkL._SS500_.jpg" class="img1"</td>
			<td><img src="https://mixmag.net/assets/uploads/images/_fullX2/rezzlead.jpg" class="img1"</td>
		</tr>
	</table>
</section>
<section class="a2">
	<h3>Concert Pictures</h3>
<?php
if(isset($_POST['upload_concert'])){

  $name = $_FILES['file']['name'];
  $target_dir2 = "upload/";
  $target_file2 = $target_dir2 . basename($_FILES["file"]["name"]);


  $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));


  $extensions_arr2 = array("jpg","jpeg","png","gif", "jfif");


  if( in_array($imageFileType2,$extensions_arr2) ){

     $query = "REPLACE INTO images(user_id, name, username) values('".$_SESSION['id']."', '".$name."', '".$_SESSION['username']."')";
     mysqli_query($link,$query);

     move_uploaded_file($_FILES['file']['tmp_name'],$target_dir2.$name);

  }

}
?>

	<fieldset class="subform1">
		<form class = "form" method="post" action="" enctype='multipart/form-data'>
			<input class = "button" type='file' name='file'>
			<input class = "button" type='submit' value='Upload Image' name='upload_concert'>
		</form>
	</fieldset>
<?php
$sql = "SELECT * FROM images WHERE username='".$_SESSION['username']."'";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_array($result);


echo"<tr>";

$i=0;
while($row = mysqli_fetch_array($result)) {
   $i=$i+1;

   echo "<td>";?><img src="Upload/<?php echo $row['name']; ?>" height="400" width="25%" ><?php echo"</td>";

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
</section>
</body>


</html>
