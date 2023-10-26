<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

    //requires
    require "../AZ-store/layouts/header.php";
    require "../AZ-store/layouts/footer.php";

	$productsJson = file_get_contents('./data/products.json');
    $products = json_decode($productsJson, true); 


	session_start();
	
	if (!isset($_SESSION["shoppingCart"])) {
		$_SESSION["shoppingCart"] = array();
	}

	$shoppingCart = $_SESSION["shoppingCart"];

	if (isset($_POST['add-cart'])) {
		$id = $_POST['add-cart'];
		
		if (isset($products[$id-1])) {
			$selectedProduct = $products[$id-1];
	
			// Vérifiez si le produit est déjà dans le panier
			if (isset($shoppingCart[$selectedProduct['id']])) {
				// Si le produit existe, augmentez simplement la quantité
				$shoppingCart[$selectedProduct['id']]['quantity'] += 1;
			} else {
				// Si le produit n'existe pas, ajoutez-le avec une quantité de 1
				$selectedProduct['quantity'] = 1;
				$shoppingCart[$selectedProduct['id']] = $selectedProduct;
			}
	
			$_SESSION["shoppingCart"] = $shoppingCart;
		} else {
			echo "Product not found.";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<title>AZ-Store</title>
</head>

<body>
	<!-- header -->
	<?php headerHtml(); ?>
	<!-- main -->
		<!-- section-our-store -->
		<!-- START - section-our-store -->
		<section id="section-our-store">
            <div class="left-side">
                <h1>Shoe the right <span>one</span>.</h1>
                <button>See our store</button>
            </div>
            <div class="right-side">
                <p>nike</p>
                <picture>
                    <img src="public/images/shoe/shoe_one.png" alt="Photo of a nike shoe.">
                </picture>
            </div>
        </section>
        <!-- END - section-our-store -->

		<!-- section-last-products -->
		<section class="last-products">
			<h2><span>Our</span> last product</h2>
			<div class="all-product">
				<?php 
					// Check if JSON data was successfully loaded
					if ($products) {
						// Iterate through the products and display them
						foreach ($products as $product) { ?>
							<div class="product">
								<div class="product-header">
									<img class="shoes" src="<?php echo $product['image_url'] ?>" alt="<?php echo $product['product'] ?>">
								</div>
								<div class="product-footer">
									<div class="product-details">
										<h2><?php echo $product['product'] ?></h2>
										<p><?php echo $product['price'] ?> €</p>
									</div>
									<form method="post">
										<input type="hidden" name="add-cart" value="<?php echo $product['id'] ?>">
										<div class="product-button">
											<button type="submit" class="button">Add to cart</button>
										</div>
									</form>
								</div>
							</div> 
						<?php }
					} else {
						echo 'Error loading JSON data.';
					}
				?>
			</div>
        
		</section>

		<!-- section-quality -->
		<section class="quality">
			<img class="qualityShoes" src="./public/images/shoe_two.png" alt="Chaussure mauve">
			<h3>WE PROVIDE YOU THE <span>BEST</span> QUALITY.</h3>
			<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam, enim laboriosam officia provident nostrum commodi.</p>
		</section>

		<!-- section-comments -->
		<!-- START - section-comments -->
		<section id="section-comments">
			<div class="comment-group">
				<picture>
					<img src="public/images/image-emily.jpg" alt="Photo de ...">
				</picture>
				<div>
					<h3>Emily from xyz</h3>
					<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam, ipsum necessitatibus animi id temporibus incidunt.</p>
				</div>
			</div>
			<div class="comment-group">
				<picture>
					<img src="public/images/image-thomas.jpg" alt="Photo de ...">
				</picture>
				<div>
					<h3>Thomas from corporate</h3>
					<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam, ipsum necessitatibus animi id temporibus incidunt.</p>
				</div>
			</div>
			<div class="comment-group">
				<picture>
					<img src="public/images/image-jennie.jpg" alt="Photo de ...">
				</picture>
				<div>
					<h3>Jennie from Nike</h3>
					<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam, ipsum necessitatibus animi id temporibus incidunt.</p>
				</div>
			</div>

		</section>
		<!-- END - section-comments -->
	<!-- footer -->
	<?php footerHtml(); ?>
</body>
</html>