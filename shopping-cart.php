<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include necessary functions and components
require "../AZ-store/layouts/header.php";
require "../AZ-store/layouts/footer.php";

session_start();
// session_destroy();

$totalOrder = 0;
$totalOrderTVAC = 0;

if (isset($_SESSION["shoppingCart"]) && is_array($_SESSION["shoppingCart"])) {
    $shoppingCart = $_SESSION["shoppingCart"];

    foreach ($shoppingCart as $product) {
        if (is_array($product)) { // Check if the item is an array
            $subtotal = $product['price'] * $product['quantity'];
            $totalOrder += $subtotal;
        }
    }

    $totalOrder = number_format($totalOrder, 2, '.', '');
    $tva = number_format($totalOrder * 0.21, 2, '.', '');
    $totalOrderTVAC = number_format($totalOrder * 1.21, 2, '.', '');

    $shoppingCart['totalOrder'] = $totalOrder;
    $shoppingCart['tva'] = $tva;
    $shoppingCart['totalOrderTVAC'] = $totalOrderTVAC;

    $_SESSION["shoppingCart"] = $shoppingCart;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Shopping Cart</title>
</head>
<body>
<!-- Include the header -->
<?php headerHtml(); ?>

<!-- Your shopping cart content here -->
<div id="shopping-cart">
    <h2>Your Shopping Cart</h2>
    <?php
    // Check if the shopping cart is not empty and is an array
    if (!empty($shoppingCart) && is_array($shoppingCart)) {
        foreach ($shoppingCart as $key => $item) {
            if (is_array($item)) {

                ?>
                <div class="cart-item">
                    <picture>
                        <img src="<?php echo $item['image_url'] ?>" alt="<?php echo $item['product'] ?>">
                    </picture>
                    <h3><?php echo $item['product'] ?></h3>
                    <p>Prix unitaire : <?php echo $item['price'] ?> €</p>
                    <div class="btn-group">
                        <button>-</button>
                        <button><?php echo $item['quantity'] ?></button>
                        <button>+</button>
                    </div>
                    <p>Total : <?php echo $item['quantity'] * $item['price'] ?> €</p>
                </div>
            <?php }
        }
    } else { ?>
        <p>Your shopping cart is empty.</p>
    <?php } ?>
</div>

<div>
    <h3>Récapitulatif de la commande</h3>
    <p><?php if (isset($shoppingCart)) {
            echo $shoppingCart['totalOrder'];
        } ?></p>
    <p><?php if (isset($shoppingCart)) {
            echo $shoppingCart['totalOrderTVAC'];
        } ?></p>
</div>

<!-- Include the footer -->
<?php footerHtml(); ?>
</body>
</html>
