<?php
// Initialize the session
session_start();
include('loginfunctions.php');
require_once "config.php";


$concert = $ticket_type = $tickets = $street = $city = $state = $total = $price = $amount = "";
$concert_err = $ticket_type_err = $tickets_err = $street_err = $city_err = $state_err = $terms_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

	//validate concert
	if(empty(trim($_POST['Artist']))) {
		$concert_err = "Please select a concert";
	} else {
		$concert = $_POST['Artist'];
	}

	//validate quantity
	if(($_POST['quantity'] < 1) || ($_POST['quantity'] > 8)) {
		$tickets_err = "Please select a valid number of tickets";
	} else {
		$tickets = $_POST['quantity'];
	}

	//validate ticket type
	if(empty(trim($_POST['ticket_type']))) {
		$ticket_type_err = "Please select a ticket type";
	} else {
		$ticket_type = $_POST['ticket_type'];
	}

	// Validate street
    if(empty(trim($_POST["street"]))){
        $street_err = "Please enter a street address.";
	} else {
		$street = trim($_POST["street"]);
		if (!preg_match("/^\\d+ [a-zA-Z ]+ [a-zA-Z ]+$/",$street)) {
			$street_err = "No special characters allowed";
		} else{
			$street = trim($_POST["street"]);
		}
	}

	//validate city
	if(empty(trim($_POST["city"]))){
        $city_err = "Please enter city name.";
    } else {
		$city = trim($_POST["city"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
			$city_err = "Only letters and white space are allowed";
		} else {
			$city = trim($_POST["city"]);
		}
	}

	//validate state
	if(empty(trim($_POST["state"]))){
        $state_err = "Please enter state name.";
    } else {
		$state = trim($_POST["state"]);
		if (!preg_match("/^[A-Z]{2}$/",$state)) {
			$state_err = "Only letters and white space are allowed";
		} else {
			$state = trim($_POST["state"]);
		}
	}

	if(!isset($_POST['terms']) || $_POST['terms'] ="") {
		$terms_err = "You must accept terms and conditions.";
	}

	if(empty($concert_err) && empty($ticket_type_err) && empty($tickets_err)){

		$userID = $_SESSION["id"];
		$amount = (($concert * $ticket_type)*($tickets));

		$sql = "INSERT INTO orders (userID, amount) VALUES (?, ?)";

		if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "id", $param_userID, $param_amount);


            $param_userID = $userID;
            $param_amount = $amount;

			if(mysqli_stmt_execute($stmt)){

			}
		}
		mysqli_stmt_close($stmt);
	}

	//need to insert statement here to create ticket after order is created.

    if(empty($street_err) && empty($city_err) && empty($state_err)){

		$userID = $_SESSION["id"];


        $sql = "UPDATE users SET Street=?, City=?, State=? WHERE userID = ".$userID."";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "sss", $param_street, $param_city, $param_state);


            $param_street = $street;
            $param_city = $city;
			$param_state = $state;


            if(mysqli_stmt_execute($stmt)){

                header("location: profile.php"); //will probably add a different page to jump to after it executes the order.
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }


    mysqli_close($link);
}
?>



<html>
<head>
<title>Purchase Tickets</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="generalstylesheet.css">
<link rel="stylesheet" type="text/css" href="Purchase.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.calculate').change(function() {
        var total = 0;
        $('.calculate').each(function() {
            if($(this).val() != 0) {
                total += parseFloat($(this).val());
            }
        });
        $('#total').text('$' + total.toFixed(2));
    });
});
</script>

</head>
<body>
  <header>
  <img src="logo1.png" alt="midsommar music logo" height="55" width="55">
  </header>
 <?php isLoggedIn() ?>

<h1>Purchase Tickets</h1>

<div class="form">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<fieldset class="subform">
			<legend>Ticket Selection</legend>

				<div <?php echo (!empty($concert_err)) ? 'has-error' : ''; ?>>
				<label>Select Concert</label>
						<?php

							$sql = "SELECT c.Artist, t.Price from concerts as c
							INNER JOIN tickets as t on t.concertID = c.concertID";
							$result = mysqli_query($link, $sql);

							if ($result->num_rows > 0) {
								echo "<select class = 'calculate' id='concert' name='Artist'>";
								echo "<option value=''>---Select A Concert---</option>";
							while($row = mysqli_fetch_array($result)) {
								echo "<option value='" . $row['Price'] . "'>" . $row['Artist'] . "</option>";
							}
							echo "</select>";
							}


						?>
				<br>
				<span class="error"><?php echo $concert_err; ?></span>
				</div>


				<div <?php echo (!empty($ticket_type_err)) ? 'has-error' : ''; ?>>
				<label>Select Ticket Type</label>
				<select id="ticket_type" name="ticket_type">
				<option value = "">---Select Ticket Type---</option>
				<option value = "1.0">Normal</option>
				<option value = "2.5">VIP</option>
				</select>
				<br>
				<span class="error"><?php echo $ticket_type_err; ?></span>
				</div>

			<label>Quantity</label>
			<input type="number" name="quantity" min="1" max="8" value="1">
		</fieldset>

		<fieldset class="subform">
			<legend>User Information</legend>
				<div <?php echo (!empty($street_err)) ? 'has-error' : ''; ?>>
					<label>Street Address</label>
					<input type="text" name="street" value="<?php echo $street; ?>" placeholder="16008 Temple Dr">
					<br>
					<span class="error"><?php echo $street_err; ?></span>
				</div>
				<div <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>>
					<label>City</label>
					<input type="text" name="city" value="<?php echo $city; ?>" placeholder="Minnetonka">
					<br>
					<span class="error"><?php echo $city_err; ?></span>
				</div>
				<div <?php echo (!empty($state_err)) ? 'has-error' : ''; ?>>
					<label>State</label>
					<input type="text" name="state" value="<?php echo $state; ?>" placeholder="MN">
					<br>
					<span class="error"><?php echo $state_err; ?></span>
				</div>
				<h3>Total</h3>
				<span>Ticket: <span id="total">$</span></span>

				<br>

				<div <?php echo (!empty($terms_err)) ? 'has-error' : ''; ?>>
					<input type="checkbox" id ="terms" name="terms" value="yes">I Agree to Terms & Conditions<br>
					<span class="error"><?php echo $terms_err; ?></span>
				</div>

      <div class="checkout">
        <input type="submit" class="button" value="Check Out">
      </div>
		</fieldset>
	</form>
</div>

<?php include('footer.html'); ?>
</body>

</html>
