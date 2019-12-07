<?php
  session_start();
  include('loginfunctions.php');
  require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Artist</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/generalstylesheet.css">
<link rel="stylesheet" href="css/add.css">

<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
  <div class="page-wrap">
<?php include('header.html');?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $artist = htmlspecialchars($_POST['artistname']);
  $genre = $_POST['genre'];
  
if(isset($_FILES['artistimage_upload'])) {
  $target_dir = 'artistphotos/';
	$filename = $target_dir.($_FILES['artistimage_upload']['name']);
	$errors     = array();
  $maxsize    = 2097152;
  $extensions = array(
    'image/jpeg',
    'image/jpg',
    'image/gif',
    'image/png'
    );
  
  //check if file is selected for upload
  if(!isset($_FILES['artistimage_upload']) || $_FILES['artistimage_upload']['error'] == UPLOAD_ERR_NO_FILE) {
      $errors[] = 'Please select a file to upload.';
  } else {

    //check if image already exists in folder
    if (file_exists($filename)) {
      $errors[] = 'Image already exists!';
    }
}
  
  //check if size is less than 2 MB
	if(($_FILES['artistimage_upload']['size'] >= $maxsize)) {
        $errors[] = 'File too large. File must be less than 2 megabytes.';
    }
    
  //check if file extensions are correct
  if(!in_array($_FILES['artistimage_upload']['type'], $extensions) && (!empty($_FILES["artistimage_upload"]["type"]))) {
    $errors[] = 'Invalid file type. Only JPG, GIF, PNG, and JFIF types are accepted.';
}

//check if any errors exists
if(count($errors) === 0) {
	$artistimage = basename($_FILES['artistimage_upload']['name']);
  $artistphoto = '/artistphotos/'.$artistimage;
} else {
    foreach($errors as $error) {
        echo '<script>alert("'.$error.'");</script>';
		header( "refresh:1;url=addartist.php" );
    }
	    die(); //if errors exist, kill process so it cannot add artists without file
	}
}

	
	if(regexCheck($artist)){
    //select query
    $selectQ = $link->prepare("SELECT COUNT(1) FROM artists WHERE Artist_name = ?");
    $selectQ->bind_param("s", $artist);

    if($selectQ->execute()){
      $selectQ->bind_result($count);
      $selectQ->fetch();

      if ($count == 0){
        $selectQ->close();

        //insert query
        $insertQ = $link->prepare("INSERT INTO artists(Artist_name, Genre, Image) VALUES(?, ?, ?)");
        $insertQ->bind_param("sss", $artist, $genre, $artistphoto);

        move_uploaded_file($_FILES['artistimage_upload']['tmp_name'], $target_dir.$artistimage);

        if($insertQ->execute()){
          echo "<script type='text/javascript'>alert('Artist successfully added!');</script>";
          header( "refresh:5;url=manageartists.php" );

        }else {
          echo "ERROR adding artist.<br>";
          echo mysqli_error($link);

        }
      }else {
        $selectQ->close();
        echo "<script type='text/javascript'>alert('Artist already exists!');</script>";

      }
    }else{
      echo "ERROR selecting artist query.<br>";
      echo mysqli_error($link);

    }
    $link->close();

  }else {
    echo "<script type='text/javascript'>alert('Please try again. The artist name can only contain numbers, letters, hyphens, periods, and or spaces.');</script>";
  }
}	

    if (isLoggedInAdmin())
    {
      echo "<h1>Add Artist</h1>";

      $currDate = date("Y-m-d");

      echo "<div class='centered'>";
      echo "<form method='POST' enctype='multipart/form-data' action=''>";
      echo "<fieldset>";
      echo "<legend>Artist</legend>";
      echo "<label for='artistname'>Artist</label>";
      echo "<input type='text' name='artistname' id='artistname' required max='25'>";
      echo "<label for='genre'>Genre</label>";
      echo "<select name='genre' id='genre'>";
      echo "<option value='Pop'>Pop</option>";
      echo "<option value='Rock'>Rock</option>";
      echo "<option value='EDM'>EDM</option>";
      echo "<option value='Metal'>Metal</option>";
      echo "</select>";
      echo "</fieldset>";
      echo"
          <fieldset>
          <legend>Image</legend>
          <input type='file' name='artistimage_upload' />
          </fieldset>
          <div class='centered'>
          <button type='submit'>Add</button>
          </div>
        </form>
        </div>";
    }
    else
    {
      isNotLoggedInAdmin();
    }
  ?>
</div>
  <?php
    include('footer.html');
   ?>
