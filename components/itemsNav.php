<?php
$items = array('Home','About','Products','Contact');
?>
<div>
    <?php
    foreach ($items as $value) {
        echo "<a href='#'>$value</a>";
    }
    ?>
</div>
