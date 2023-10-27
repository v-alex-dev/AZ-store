<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    // session_destroy();

    // Include necessary functions and components
    require "../AZ-store/layouts/header.php";
    require "../AZ-store/layouts/footer.php";


    $totalOrder = 0;
    $totalOrderTVAC = 0;

    if (isset($_SESSION["shoppingCart"])) {
        $shoppingCart = $_SESSION["shoppingCart"];

        if (isset($_POST['incr-item'])) {
            $incrItemId = $_POST['incr-item'];
            if (isset($shoppingCart[$incrItemId])) {
                $shoppingCart[$incrItemId]['quantity']++;
            }
            $_SESSION["shoppingCart"] = $shoppingCart;
        }
        if (isset($_POST['decr-item'])) {
            $decrItemId = $_POST['decr-item'];
            if (isset($shoppingCart[$decrItemId])) {
                $shoppingCart[$decrItemId]['quantity']--;
            }
            if ($shoppingCart[$decrItemId]['quantity'] === 0) {
                unset($shoppingCart[$decrItemId]);
            }
            $_SESSION["shoppingCart"] = $shoppingCart;
        }

        
        foreach ($shoppingCart as $product) {
            if (is_array($product)) {
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
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Shopping Cart</title>
</head>
<body>
    <!-- Include the header -->
    <?php headerHtml(); ?>

    <!-- Your shopping cart content here -->
    <main id="main-shopping-cart">
        <div id="shopping-cart">
            <h2>Your Shopping Cart</h2>
            <?php
                // Check if the shopping cart is not empty
                if (!empty($shoppingCart) && is_array($shoppingCart)) {
                    foreach ($shoppingCart as $key => $item) { 
                        if (is_array($item)) { ?>
                            <div class="cart-item">
                                <picture>
                                    <img src="<?php echo $item['image_url'] ?>" alt="<?php echo $item['product'] ?>">
                                </picture>
                                <h3><?php echo $item['product'] ?></h3>
                                <p>Prix unitaire : <?php echo $item['price'] ?> €</p>
                                <div class="btn-group">                                
                                    <form method="post" id="btn-delete">
                                        <input type="hidden" name="decr-item" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="decr-button">-</button>
                                    </form>
                                    <button><?php echo $item['quantity'] ?></button>
                                    <form method="post" id="btn-delete">
                                        <input type="hidden" name="incr-item" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="incr-button">+</button>
                                    </form>
                                </div>
                                <p>Total : <?php echo $item['quantity'] * $item['price'] ?> €</p>
                            </div>
                    <?php }
                    }	
                } else { ?>
                    <p>Your shopping cart is empty.</p>
                <?php } ?>
        </div>

        <div id="total-order">
            <h3>Récapitulatif de la commande</h3>
            <p>Total : <?php if (isset($shoppingCart['totalOrder'])) {echo $shoppingCart['totalOrder'];} ?> €</p>
            <button><a href="checkout.php">Poursuivre la commande</a></button>

        </div>
    </main>
    <!-- Include the footer -->
    <?php footerHtml(); ?>
</body>
</html>
