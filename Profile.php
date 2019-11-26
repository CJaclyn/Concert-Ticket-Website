<?php
session_start();
include('loginfunctions.php');
isNotLoggedIn();

$date = $tickets = $total = $price = $ticketID = $orderID = $concertID = "";
?>

<!DOCTYPE html>
<head>
<title>Profile Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" type="text/css" href="/Concert-Ticket-Website/css/Profile.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">

<script>
function myFunction1() {
  var x = document.getElementById("profpic-form");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function myFunction2() {
  var x = document.getElementById("uploadconcert-form");
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
<?php
isLoggedIn();
if(isLoggedInAdmin()){
  header('location:index.php');
}
?>

<h1><?php echo $_SESSION['username']; ?></h1>

<?php
include("config.php");

//upload profile picture query
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

<!--profile picture query and form-->
<div class='centered'>
<?php
  //query to get profile picture
	$sql = "SELECT prof_picture FROM users WHERE username='".$_SESSION['username']."'";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_array($result);
  if (empty($row['prof_picture'])){
    echo '
    <img src="Profile/nopic.png" height="300" width="300" id=\'profile-picture\'><br>';
  }else {
    echo '
    <img src="Profile/'.$row['prof_picture'].'
    " height="300" width="300" id=\'profile-picture\'><br>';
  }
?>

    <button onclick="myFunction1()" class='button' id='profpic-button'>Upload Profile Picture</button>
    <div class = "hide upload-form" id="profpic-form">
      <form method="post" action="" enctype='multipart/form-data'>
        <input class = "button" type='file' name='file' />
        <input class = "button" type='submit' value='Upload Image' name='upload_profile'>
      </form>
    </div>
</div>

      <!--user information-->
	    <?php
			$sql = "SELECT * FROM users where username='".$_SESSION['username']."'";
			$result = mysqli_query($link,$sql);

			echo "<fieldset id='info'>";
			echo "<legend>Personal Information</legend>";
			echo "<table>";
			while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>Name:</td>";
				echo "<td>" . $row['Firstname'] . " ". $row['Lastname'] . "</td>";
				echo "</tr><tr>";
				echo "<td>Email:</td>";
				echo "<td>" . $row['Email'] . "</td>";
				echo "</tr><tr>";
				echo "<td>Location:</td>";
				echo "<td>" . $row['Street'] . ", " . $row['City'] . ", " . $row['State'] . "</td>";
				echo "</tr>";

			}
			echo "</table>";
			echo "</fieldset>";
      ?>

    <?php
    echo "<div id='orders-container'>";
  	echo "<fieldset id='orders'>";
	echo "<legend>Recent Order</legend>";
	echo "<table align='center'>";
    $userID = $_SESSION["id"];

    //get orders query
	$sql = "SELECT * FROM orders WHERE orderID = (SELECT max(orderID) FROM orders) AND userID = ".$userID."";
        $result = mysqli_query($link, $sql);


	if (mysqli_num_rows($result) > 0) {

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

		while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
      echo "<div class ='centered'>";
			echo "<img src='". $row['Image']."'width='300'>"."<br />";
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
			echo "<td>Location</td>";
			echo "<td>".$row['Street'].", ".$row['City'].", ".$row['State'] ."</td>";
			echo "</tr><tr>";
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
		} else {
			echo "No Recent Orders";
		}
			echo "</table>";
			echo "</fieldset>";
      echo "</div>";
		?>

<h1 class="head">Concert Pictures</h1>
  <?php
  //upload concert pictures query
  if(isset($_POST['upload_concert'])){
    $name = $_FILES['file']['name'];
    $target_dir2 = "Upload/";
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

  <div class='centered'>
    <button onclick="myFunction2()" class="button">Upload Concert Pictures</button>
    <div class = "hide upload-form" id = "uploadconcert-form">
      <form method="post" action="" enctype='multipart/form-data'>
        <input class = "button" type='file' name='file'>
        <input class = "button" type='submit' value='Upload Image' name='upload_concert'>
      </form>
    </div>
  </div>


<?php
//get concert pictures query
$sql = "SELECT * FROM images WHERE username='".$_SESSION['username']."'";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_array($result);

echo"<tr>";
$i=0; //keeps count of the row
while($row = mysqli_fetch_array($result)){
   $i=$i+1;
   echo "<td>";?>
  <img src="Upload/<?php echo $row['name']; ?>" class='img'><?php echo"</td>";
   if($i%4==0){
     echo"</tr>";
   }
   if($i%4!=0){
     echo"</tr>";
   }
}
mysqli_close($link);
?>

<?php include('footer.html'); ?>
</body>
</html>
