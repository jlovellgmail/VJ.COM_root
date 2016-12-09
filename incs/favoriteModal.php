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

if ($favorite->getVar("Type") == "P")
{
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
}
else
{
	$Img = $favorite->getImgUrl();
	$comment = $favorite->getVar("ItemName");
	$Description = $favorite->getVar("Description");
	$link = $favorite->getVar("Link");
}
?>
<div class="lg-six" style="position: relative; height: 100%; top: 0; bottom: 0; display: inline-block;">
   <div class="favModalImg" style="position: relative; width: 100%; height: 100%; position: relative; display: block;">
   	<div class="tableWrapper" style="height: 100%;">
   		<div class="cellWrapper">
     		<img src="<?php echo $Img; ?>" alt="" style="width: 100%;" />
    	</div>
   	</div>
   </div>
</div><div class="lg-six">
	<?php if ($collection != "") { ?>
   		<h2 class="ital size5 fw-300 contrastGrey"><?php echo $collection; ?> Collection</h2>
	    <h1 class="caps fw-700 black"><?php echo $ProdTitle; ?></h1>
	    <span class="size45 black caps fw-700 block">$<?php echo $price; ?></span>
   <?php } ?>
   <span class="size5 black caps fw-700"><?php echo $comment; ?></span>
   <p class="fw-400 textGrey"><?php echo $Description; ?></p>
   <?php if ($favorite->getVar("Type") == "P") { ?>
	   <a class="fillBtn bgBlack white caps" href="/product.php?style=<?php echo $Style; ?>&pid=<?php echo $product->getVar("PID"); ?>">View Product Details</a>
   <?php } else if ($favorite->getVar("Type") == "C" && $link != "") { ?>
   	   <a class="fillBtn bgBlack white caps" href="<?php echo $link; ?>" target="_blank">View Favorite</a>
   <?php } ?>
</div>