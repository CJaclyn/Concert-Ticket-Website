<?php
// Initialize the session
session_start();
include('loginfunctions.php');
require_once "config.php";
isNotLoggedIn();

$concertID = $tickets = $total = $price = $ticketID = $orderID = "";
?>

<html>
<head>
<title>Order Summary</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/Concert-Ticket-Website/css/generalstylesheet.css">
<link rel="stylesheet" type="text/css" href="order.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
<?php include('header.html');?>
<?php isLoggedIn() ?>

<h1>Order Summary</h1>

<div class="form">
	<form>
		<fieldset class="subform">
        <?php
        $userID = $_SESSION["id"];

        $sql = "SELECT * FROM users WHERE userID = ".$userID."";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $firstname = $row['Firstname'];
        }

        $sql = "SELECT * FROM orders WHERE orderID = (SELECT max(orderID) FROM orders) AND userID = ".$userID."";
        $result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);
        $totalRows_results = mysqli_num_rows($result);

        if($totalRows_results > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $orderID = $row['orderID'];
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
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_array($result)) {
        echo "<div id =\"boxshadow\">";
        echo "<img src='". $row['Image']."'width='300'>"."<br />";
        echo "</div>";
        echo "<h3>".$row['Artist']."<br />"."</h3>";
        echo "Congratulations, ".$firstname.",<br />";
        echo "You've Got ".$tickets." Tickets for the show"."<br />";
        echo "On ".$row['Date']."<br />";
        echo "At ".$row['Time']."<br />";
        echo $row['Street'].", ".$row['City'].", ".$row['State']."<br />";
        echo "<div class=\"right\">";
        echo "<label>Order Summary</label><br />";
        echo "Ticket Price: $".$price."<br />";
        echo "Quantity: ".$tickets."";
        echo "<h2>Total: $".$total."</h2>";
        echo "</div>";
        }

        mysqli_close($link);
	} else {
        	echo "No Order Placed";
    }
        ?>
		</fieldset>
	</form>
</div>

<?php include('footer.html'); ?>
</body>

</html>
