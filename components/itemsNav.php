<?php
    $items = array('Home','About','Products','Contact');
    ?>
    <div>
        <?php
        foreach ($items as $value) {
            echo "<a class='linkNav' href='#'>$value</a>";
        }
        ?>
</div>
