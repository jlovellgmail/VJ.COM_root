<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/classes/ProductList.class.php';

$MainPID = $_GET["pid"];
if (isset($MainPID) && $MainPID != ""){
    $ProductList = new ProductList();
    $FeatProduct = $ProductList->getAllRelatedProducts($MainPID);
    if (isset($FeatProduct) && $FeatProduct->count()>0){

?>

<!-- Pile of Featured Products -->
<div class="bgWrapper featuredProductsBg filterFeatured filterOn">
    <div class="widthWrapper"> <!-- Needs to be added to mens/womens/acc -->
        <div class="headingWrapper">
            <!-- <div class="headingDashes"> -->
                <h2 class="ital fw-300 size4">Related Products</h2>
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
                $ProdPrice = number_format((float) $product->getVar("Price"), 2, '.', '');
                $ProdTitle = $product->getProductName();
				$Style = str_replace(" ", "-", $ProdTitle);
                ?><a class="shopItem lg-four" href="/product.php?style=<?php echo $Style; ?>&pid=<?php echo $product->getVar("PID"); ?>">
                    <img src="<?php echo $ProdImgUrl; ?>" alt="" />
                    <span class="shopItemPrice">$<?php echo $ProdPrice; ?></span>
                    <span class="shopItemTitle"><?php echo $ProdTitle; ?></span>
                    <span class="shopItemSubtitle"><?php echo ucfirst($collName); ?> Collection</span></a><!--
            --><?php } ?> 
        </div>
    </div>
</div>
<?php 
    }
}
?>