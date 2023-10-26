<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Include necessary functions and components
    require "../AZ-store/layouts/header.php";
    require "../AZ-store/layouts/footer.php";

    session_start();
    // session_destroy();

    if (isset($_SESSION["shoppingCart"])) {
        $shoppingCart = $_SESSION["shoppingCart"];
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
    <div id="shopping-cart">
        <h2>Your Shopping Cart</h2>
        <?php
            // Check if the shopping cart is not empty
            if (!empty($shoppingCart)) {
                foreach ($shoppingCart as $item) { ?>
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
            } else { ?>
                <p>Your shopping cart is empty.</p>
            <?php } ?>

    </div>

    <!-- Include the footer -->
    <?php footerHtml(); ?>
</body>
</html>
