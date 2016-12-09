

<div class="bgWrapper productBgWrapper">
    <div class="widthWrapper">
    <!-- <h2 class="genderTitle">All <?php echo ucfirst($type); ?></h2> -->
        <div class="contentWrapper shopItemsWrapper copyPanel">
            <h2 class='caps black size4'><?php echo $pTitle; ?></h1>
            <?php
            foreach ($List as $product) {
                $ProdImgUrl = $product->getThumbnailUrl();
                if ($ProdImgUrl == "") {
                    $ProdImgUrl = "/img/product/canvas_black_backpack.png";
                }
                $ProdPrice = number_format((float) $product->getVar("Price"), 0, '.', ',');
                $ProdTitle = $product->getProductName();
                $Title = $product->getName();
                $Style = str_replace(" ", "-", $ProdTitle);
                ?><a class="shopItem lg-four" href="/product.php?style=<?php echo $Style; ?>&pid=<?php echo $product->getVar("PID"); ?>">
                    <img src="<?php echo $ProdImgUrl; ?>" alt="<?php echo $Title; ?>" />
                    <span class="shopItemPrice">$<?php echo $ProdPrice; ?></span>
                    <span class="shopItemTitle"><?php echo $Title; ?></span>
                    <!-- <span class="shopItemSubtitle"><?php echo ucfirst($collName); ?> Collection</span> -->
                </a><?php
        }
            ?>

        </div>
    </div>
</div>

<script>
    $('.shopItemsWrapper').imagesLoaded(function () {
        // Fade in the Product images here
        $('.shopItemsWrapper').fadeTo(1000, 1);
        console.log('Mens images loaded.');
    });
</script>