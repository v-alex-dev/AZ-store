<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

    //requires
    require "./layouts/header.php";
    require "./layouts/footer.php";

	session_start();
	
	if (isset($_SESSION["shoppingCart"])) {
		echo '<pre>';
		print_r($_SESSION["shoppingCart"]);
		echo '</pre>';
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
	
	<!-- footer -->
	<?php footerHtml(); ?>
</body>
</html>