<?php
  session_start();
  include('loginfunctions.php');
  require_once "config.php";
  global $artist_err, $pic_errors;
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
<?php include('header.html');?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $artist = htmlspecialchars($_POST['artistname']);
  $genre = $_POST['genre'];

  $pic_err = array();
  $err_count = array();
  $artist_err = "";

if(isset($_FILES['artistimage_upload'])) {
  $target_dir = 'artistphotos/';
	$filename = $target_dir.($_FILES['artistimage_upload']['name']);
  $maxsize    = 2097152;
  $extensions = array(
    'jpeg',
    'jpg',
    'gif',
    'png',
    'jfif'
    );
  $fileExtention = pathinfo($filename, PATHINFO_EXTENSION);

  //check if file is selected for upload
  if(!isset($_FILES['artistimage_upload']) || $_FILES['artistimage_upload']['error'] == UPLOAD_ERR_NO_FILE) {
    array_push($err_count, 1);
  }else {
    //check if image already exists in folder
    if (file_exists($filename)) {
      array_push($err_count, 2);
    }
  }

  //check if size is less than 2 MB
  if(($_FILES['artistimage_upload']['size'] >= $maxsize)) {
    array_push($err_count, 3);
  }

  //check extention
  if(!in_array($fileExtention, $extensions) && (!empty($_FILES["artistimage_upload"]["type"]))) {
    array_push($err_count, 4);
  }
}

	if(regexCheck($artist) && !$err_count){
    $artistimage = basename($_FILES['artistimage_upload']['name']);
    $artistphoto = 'artistphotos/'.$artistimage;
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
          header( "refresh:.5;url=manageartists.php" );

        }else {
          echo "ERROR adding artist.<br>";
          echo mysqli_error($link);

        }
      }else {
        $selectQ->close();
        $artist_err = 'Artist already exists!';

      }
    }else{
      echo "ERROR selecting artist query.<br>";
      echo mysqli_error($link);

    }
    $link->close();

  }if(!regexCheck($artist)){
    $artist_err = 'Artist name can only contain numbers, letters, hyphens, periods, and or spaces';
  }if(in_array(1, $err_count)){
    array_push($pic_err, 'Please select a file to upload.');
  }if(in_array(2, $err_count)){
    array_push($pic_err, 'Image already exists!');
  }if(in_array(3, $err_count)){
    array_push($pic_err, 'File too large. File must be less than 2 megabytes.');
  }if(in_array(4, $err_count)){
    array_push($pic_err, 'Invalid file type. Only JPG, GIF, PNG, and JFIF types are accepted.');
  }

  $pic_errors = implode("<br>", $pic_err);
}

    if (isLoggedInAdmin())
    {
      echo "<h1>Add Artist</h1>";
      echo "<div class='centered'>";
      echo "<form method='POST' enctype='multipart/form-data' action=''>";
      echo "<fieldset>";
      echo "<legend>Artist</legend>";
      echo "<label for='artistname'>Artist</label>";
      echo "<input type='text' name='artistname' id='artistname' required max='25'>";
      echo "<div class='error'>".$artist_err."</div>";
      echo "<label for='genre'>Genre</label>";
      echo "<select name='genre' id='genre'>";
      echo "<option value='Pop'>Pop</option>";
      echo "<option value='Rock'>Rock</option>";
      echo "<option value='EDM'>EDM</option>";
      echo "<option value='Metal'>Metal</option>";
      echo "</select>";
      echo "</fieldset>";
      echo "
          <fieldset>
          <legend>Image</legend>
          <input type='file' name='artistimage_upload' />";
      echo "<div class='error'>".$pic_errors."</div>";
      echo "</fieldset>
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
  <?php
    include('footer.html');
   ?>
