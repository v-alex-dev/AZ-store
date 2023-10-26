<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

    //requires
    require "../AZ-store/layouts/header.php";
    require "../AZ-store/layouts/footer.php";

	$productsJson = file_get_contents('./data/products.json');
    $products = json_decode($productsJson, true); 
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
        <?php
		echo '<div class="all-product">'; // Opening div tag all-product
        // Check if JSON data was successfully loaded
        if ($products) {
            // Iterate through the products and display them
            foreach ($products as $product) {
				echo '<div class="product">'; // Opening div tag product
					echo '<div class="product-header">'; // Opening div tag product header
						echo '<img class="shoes" src="' . $product['image_url'] . '" alt="' . $product['product'] . '">';
					echo '</div>'; // Closing div tag product header	
					echo '<div class="product-footer">'; // Opening div tag product-footer
						echo '<div class="product-details">'; // Opening div tag product-details
							echo '<h2>' . $product['product'] . '</h2>';
							echo '<p>' . $product['price'] . '€</p>';
						echo '</div>'; // Closing div tag product-details
						echo '<div class="product-button">'; // Opening div tag product-button
							echo '<button class="button">Add to cart</button>';
						echo '</div>'; // Closing div tag product-button
					echo '</div>'; // Closing div tag product-footer
				echo '</div>'; // Closing div tag product
            }
        } else {
            echo 'Error loading JSON data.';
        }
		echo '</div>'; // Closing div tag all-product
        ?>
		</section>

		<!-- section-quality -->
		<section class="quality">
			<img class="qualityShoes" src="./public/images/shoe_two.png" alt="Chaussure mauve">
			<h3>WE PROVIDE YOU THE <span>BEST</span> QUALITY.</h3>
			<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam, enim laboriosam officia provident nostrum commodi.</p>
		</section>
		<!-- section-comments -->
	<!-- footer -->
	<?php footerHtml(); ?>
</body>
</html>