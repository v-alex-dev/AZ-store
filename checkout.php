<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/style.css">
	<title>Checkout</title>
</head>
<body>
	<!-- checkout -->
	<section class="checkout_body">

	</section>
	<!-- form -->
	<section class="checkout_footer">
		<form action="checkout.php" method="post">
			<h3>Name :</h3>
			<div class="name">
				<!-- name -->
				<input type="text" name="firstname" id="firstname" placeholder="firstname" required>
				<!-- last name -->
				<input type="text" name="lastname" id="lastname" placeholder="lastname" required>
			</div>
			<!-- email -->
			<h3>Mail :</h3>
			<input type="email" name="email" id="email" required>
			<h3>Delevery Adress :</h3>
			<!-- street -->
			<input type="text" name="address" id="address" placeholder="Address" required>
			<div class="city">
				<!-- city -->
				<input type="text" name="city" id="city" placeholder="City" required>
				<!-- region -->
				<input type="text" name="region" id="region" placeholder="Region" required>
			</div>
			<div class="country">
				<!-- postal code -->
				<input type="text" name="zip" id="zip" placeholder="Zip Code" required>
				<!-- country -->
				<input type="text" name="country" id="country" placeholder="Country" required>
			</div>
			<!-- submit -->
			<input class="button" type="submit" value="Submit">
		</form>
		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$firstname = sanitizeInput($_POST["firstname"]);
			$lastname = sanitizeInput($_POST["lastname"]);
			$email = sanitizeInput($_POST["email"]);
			$address = sanitizeInput($_POST["address"]);
			$city = sanitizeInput($_POST["city"]);
			$zip = sanitizeInput($_POST["zip"]);
			$country = sanitizeInput($_POST["country"]);

			if (empty($firstname) || empty($lastname) || empty($email) || empty($address) || empty($city) || empty($zip) || empty($country)) {
				// Handle required fields not filled in
				echo "All fields are required.";
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				// Handle invalid email format
				echo "Invalid email address.";
			} elseif (!is_numeric($zip)) {
				// Handle non-numeric zip code
				echo "Zip code should be a number.";
			} else {
				// Form data is valid, process it as needed
				echo "Form submitted successfully.";
			}
		}

		function sanitizeInput($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>
	</section>
</body>
</html>