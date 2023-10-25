<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

    //requires
    require "../AZ-store/layouts/header.php";
    require "../AZ-store/layouts/footer.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/style.css">
	<title>AZ-Store</title>
</head>
<body>
	<!--header-->
	<?php headerHtml(); ?>
	<!--main-->
		<!--section-our-store-->
		<!--section-last-products-->
		<!--section-quality-->
		<!--section-comments-->
	<!--footer-->
  <?php footerHtml(); ?>
</body>
</html>