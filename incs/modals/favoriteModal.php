<?php
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once $rootpath . '/incs/conn.php';
include $rootpath . '/classes/AmbassadorFavorite.class.php';
include $rootpath . '/classes/Product.class.php';

$FID = $_GET['FID'];
$favorite = new AmbassadorFavorite();
$favorite->initialize($FID);

$price = "";
$collection = "";
$comment = "";
$Description = "";
$link = "";

if ($favorite->getVar("Type") == "P") {
    $PID = $favorite->getVar("PID");
    $product = new Product();
    $product->initialize($PID);
    $Img = $product->getThumbnailUrl();
    $price = $product->getVar('Price');
    $price = number_format($price, 0, '.', ',');
    $collection = $product->getCollectionName();
    $ProdTitle = $product->getProductName();
    $Style = str_replace(" ", "-", $ProdTitle);
    //$comment = $favorite->getVar("Comment");
    $Description = $product->getVar("ShortDescription");
} else {
    $Img = $favorite->getImgUrl();
    $comment = $favorite->getVar("ItemName");
    $Description = $favorite->getVar("Description");
    $link = $favorite->getVar("Link");
}
?>
<div class='modal-wrapper-fav-thing'>
    <div class="sm-twelve ambFavInfo textLeft">
        <?php if ($collection != "") { ?>
        <h2 class="ital size5 fw-300 contrastGrey"><?php echo $collection; ?> Collection</h2>
        <h1 class="caps fw-700 black"><?php echo $ProdTitle; ?></h1>
        <span class="size45 black caps fw-700 block">$<?php echo $price; ?></span>
        <?php } ?>
        <span class="block size5 black caps fw-700"><?php echo $comment; ?></span>
        <div class='xs-twelve sm-five md-four'>
            <img class="" src="<?php echo $Img; ?>" alt="" style="width: 100%;"/>
        </div><div class='fav-modal-right-col xs-twelve sm-seven md-eight'>
            <div class="fw-400 textGrey fav-mod-desc"><?php echo $Description; ?></div>
            <?php if ($favorite->getVar("Type") == "P") { ?>
            <a class="fillBtn bgBlack white caps" target="_blank" href="/product.php?style=<?php echo $Style; ?>&pid=<?php echo $product->getVar("PID"); ?>">View Product</a>
            <?php } else if ($favorite->getVar("Type") == "C" && $link != "") { ?>
                <a class="fillBtn bgBlack white caps" href="<?php echo $link; ?>" target="_blank">View Favorite</a>
            <?php } ?>
        </div>
    </div>
</div>