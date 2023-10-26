<?php

require "../AZ-store/layouts/header.php";
require "../AZ-store/layouts/footer.php";

session_start();
if (!isset($_SESSION["shoppingCart"])) {
    $_SESSION["shoppingCart"] = array();
}


$shoppingCart = $_SESSION["shoppingCart"];
echo '<pre>';
print_r($shoppingCart);
echo'</pre>';
// Function to find the index of a product in the cart
function findProductIndex($productId, $cart) {
    foreach ($cart as $index => $item) {
        if ($item['id'] == $productId) {
            return $index;
        }
    }
    return -1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link>
    <title>Shopping card</title>
</head>
<body>
<!--header-->
<?php headerHtml(); ?>
<main>
    <?php
    // Check if the shopping cart is not empty
    if (!empty($shoppingCart)) {
        foreach ($shoppingCart as $item) {
            $productIndex = findProductIndex($item['id'], $shoppingCart);
            $quantity = 1;
            // Check if the product appears more than once
            if ($productIndex !== -1) {
                $quantity = 0;
                for ($i = 0; $i < count($shoppingCart); $i++) {
                    if ($shoppingCart[$i]['id'] == $item['id']) {
                        $quantity++;
                    }
                }
            }
            // Display each item in the shopping cart
            echo '<div class="cart-item">';
            echo '<img src="' . $item['image_url'] . '" alt="' . $item['product'] . '">';
            echo '<h3>' . $item['product'] . '</h3>';
            echo '<p>' . $item['price'] . ' €</p>';
            echo '<p>Quantity: ' . $quantity . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>Your shopping cart is empty.</p>';
    }
    ?>
</main>
<!--footer-->
<?php footerHtml(); ?>
</body>
</html>