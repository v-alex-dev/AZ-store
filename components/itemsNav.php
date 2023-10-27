<?php
$items = [
    ['name' => 'Home', 'url' => './index.php'],
    ['name' => 'About', 'url' => '#section-our-store'],
    ['name' => 'Products', 'url' => '#last-products'],
    ['name' => 'Contact', 'url' => '#comments']
];
?>

<div>
    <?php
    foreach ($items as $item) {
        echo "<a class='linkNav' href='" . $item['url'] . "'>" . $item['name'] . "</a>";
    }
    ?>
</div>
