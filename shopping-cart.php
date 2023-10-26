<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

    //requires
    require "./layouts/header.php";
    require "./layouts/footer.php";

	session_start();
	$shoppingFromSession = array();
	$shoppingCart = array();
	if (isset($_SESSION["shoppingCart"])) {
		$shoppingFromSession = $_SESSION["shoppingCart"];

		foreach ($shoppingFromSession as $product) {
			$productId = $product['id'];
			$productName = $product['product'];
			$productPrice = $product['price'];
			$productUrl = $product['image_url'];

			if (!isset($shoppingCart[$productId])) {
				$shoppingCart[$productId] = [
					'product' => $productName,
					'price' => $productPrice,
					'id' => $productId,
					'image_url' => $productUrl,
					'count' => 0
				];
			}

			$shoppingCart[$productId]['count']++;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title>Shopping card</title>
</head>
<body>
	<!-- header -->
	<?php headerHtml(); ?>

	<!-- main -->
	<main id="shopping-cart">
		<?php 
			if ($shoppingCart) {
				foreach ($shoppingCart as $product) { ?>
				<section>
					<picture>
						<img src="<?php echo $product['image_url'] ?>" alt="<?php echo $product['product'] ?>">
					</picture>
					<h2><?php echo $product['product'] ?></h2>
					<p><?php echo $product['price'] ?> €</p>
					<p>x <?php echo $product['count'] ?></p>
				</section>
				
			
		<?php 
				}
			} else {
					
			}
		?>
	</main>
	<!-- footer -->
	<?php footerHtml(); ?>
</body>
</html>