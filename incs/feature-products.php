<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/classes/ProductList.class.php';
//include $rootpath . '/classes/Product.class.php';
$ProductList = new ProductList();
$FeatProduct = $ProductList->getFeaturedProducts();

?>

<!-- Pile of New / Featured Products -->
<div class="bgWrapper featuredProductsBg filterFeatured filterOn">
    <div class="widthWrapper"> <!-- Needs to be added to mens/womens/acc -->
        <div class="headingWrapper">
            <!-- <div class="headingDashes"> -->
                <!-- <h2 class="ital fw-300 size4">All Products</h2> -->
            <!-- </div> -->
        </div>
        <div class="contentWrapper shopItemsWrapper">
            <?php
            foreach ($FeatProduct as $product) {
                $ProdImgUrl = $product->getThumbnailUrl();
                //if ($ProdImgUrl == "") {
                //  $ProdImgUrl = "/img/product/canvas_black_backpack.png";
                //}
                $collName=$product->getCollectionName();
                $ProdPrice = number_format((float) $product->getVar("Price"), 0, '.', ',');
                $ProdTitle = $product->getProductName();
				$Style = str_replace(" ", "-", $ProdTitle);
				$Title = $product->getName();
                ?><a class="shopItem lg-four" href="/product.php?style=<?php echo $Style; ?>&pid=<?php echo $product->getVar("PID"); ?>">
                    <img src="<?php echo $ProdImgUrl; ?>" alt="<?php echo $Title; ?>" />
                    <span class="shopItemPrice">$<?php echo $ProdPrice; ?></span>
                    <span class="shopItemTitle"><?php echo $ProdTitle; ?></span>
                    <span class="shopItemSubtitle"><?php echo ucfirst($collName); ?> Collection</span></a><!--
            --><?php } ?> 
        </div>
    </div>
</div>