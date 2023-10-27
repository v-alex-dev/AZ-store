<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include necessary functions and components
require "../AZ-store/layouts/header.php";
require "../AZ-store/layouts/footer.php";

session_start();

$totalOrder = 0;
$totalOrderTVAC = 0;

if (isset($_SESSION["shoppingCart"])) {
    $shoppingCart = $_SESSION["shoppingCart"];

    foreach ($shoppingCart as $product) {
        echo '<br>';
        var_dump($product['price']);
        echo '<br>';
        var_dump($product['quantity']);
        echo '<br>';
        $subtotal = 0;
        var_dump($subtotal);
        $subtotal = $product['price'] * $product['quantity'];
        $totalOrder += $subtotal;
    }
    $totalOrder = number_format($totalOrder, 2, '.', '');
    $tva = number_format($totalOrder * 0.21, 2, '.', '');
    $totalOrderTVAC = number_format($totalOrder * 1.21, 2, '.', '');

    $shoppingCart['totalOrder'] = $totalOrder;
    $shoppingCart['tva'] = $tva;
    $shoppingCart['totalOrderTVAC'] = $totalOrderTVAC;

    $_SESSION["shoppingCart"] = $shoppingCart;
}

/*if (isset($_POST['delete-item'])) {
    $deleteItemId = $_POST['delete-item'];
    if (isset($shoppingCart[$deleteItemId])) {
        unset($shoppingCart[$deleteItemId]);
        $_SESSION["shoppingCart"] = $shoppingCart;
    }
}*/
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
<div id="shopping-cart">
    <h2>Your Shopping Cart</h2>
    <?php
    // Check if the shopping cart is not empty
    if (!empty($shoppingCart)) {
        foreach ($shoppingCart as $key => $item) {
            if ($key === 'totalOrder') {
                break;
            }
            if (is_array($item)) {
                ?>
                <div class="cart-item">
                    <picture>
                        <img src="<?php echo $item['image_url'] ?>" alt="<?php echo $item['product'] ?>">
                    </picture>
                    <h3><?php echo $item['product'] ?></h3>
                    <p><?php echo 'Total : '.$item['price'].'€'?> </p>
                    <div class="btn-group">
                        <button>-</button>
                        <button><?php echo $item['quantity'] ?></button>
                        <button>+</button>
                    </div>
                    <p><?php echo 'Total : '.$item['totalOrder'].'€' ?> </p>
                    <form method="post" id="btn-delete">
                        <input type="hidden" name="delete-item" value="<?php echo $item['id']; ?>">
                        <button type="submit" class="delete-button">X</button>
                    </form>
                </div>
            <?php }
        }
    } else { ?>
        <p>Your shopping cart is empty.</p>
    <?php } ?>
</div>

<div>
    <h3>Récapitulatif de la commande</h3>
    <p><?php echo $shoppingCart['totalOrder'] ?></p>
    <p><?php echo $shoppingCart['totalOrderTVAC'] ?></p>

</div>

<!-- Include the footer -->
<?php footerHtml(); ?>
</body>
</html>
