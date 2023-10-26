<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include necessary functions and components
require "../AZ-store/layouts/header.php";
require "../AZ-store/layouts/footer.php";

session_start();


// Check if the shopping cart session variable exists
if (!isset($_SESSION["shoppingCart"])) {
    $_SESSION["shoppingCart"] = array();
}

$shoppingCart = $_SESSION["shoppingCart"];


// Your shopping cart HTML and PHP code can go here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Shopping Cart</title>
</head>
<body>
    <!-- Include the header -->
    <?php headerHtml(); ?>

    <!-- Your shopping cart content here -->
    <div class="shopping-cart">
        <h2>Your Shopping Cart</h2>
        <?php
        // Check if the shopping cart is not empty
        if (!empty($shoppingCart)) {
            foreach ($shoppingCart as $item) {
				echo '<div class="cart-item">';
				echo '<img src="' . $item['image_url'] . '" alt="' . $item['product'] . '">';
				echo '<h3>' . $item['product'] . '</h3>';
				echo '<p>' . $item['price'] . ' €</p>';
				echo '<p>Quantity: ' . $item['quantity'] . '</p>';
				echo '</div>';
			}
        } else {
            echo '<p>Your shopping cart is empty.</p>';
        }
        ?>
    </div>

    <!-- Include the footer -->
    <?php footerHtml(); ?>
</body>
</html>
