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
