<?php

function headerHtml()
{
    ?>
    <header>
        <nav>
            <div class="header-title">AZ[store]</div>
            <?php include "../AZ-store/components/itemsNav.php";?>
            <div>
                <a class="icone" href="#"><img src="../AZ-store/public/icones/shopping-cart.svg" alt="img"/></a>
                <a href="#">Login</a>
            </div>
        </nav>
    </header>
    <?php
};


?>
