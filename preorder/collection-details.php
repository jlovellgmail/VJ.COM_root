<!doctype html>
<?php 
$page = "home"; 
$seo_variable = "home";
$collection = $_GET["col"];
$line = $_GET["line"];
if (isset($_GET["type"]) && $_GET["type"] != ""){
    $type = $_GET["type"];
} else {
    $type="";
}

 if ($collection == "reykjavik") {
	$headLine = "Reykjavik";
	$description = "Reykjavik is about beauty and raw strength. Its volcanic origin belies a region still in formation. This city exhibits a resolve to honor the past and embrace the future. Our selection of materials and original bronze designs are inspired by the unique independence of this remarkable city.";
 }else if($collection == "santa-fe"){
	 $headLine = "Santa Fe";
     $description = "Santa Fe showcases an incredible heritage of artistic creativity and original thought. The city has attracted diverse cultures and pioneers in every sense for thousands of years. Our selection of materials and original bronze designs pay tribute to this spiritual capital.";
 }

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once($rootpath . '/incs/conn.php');
include $rootpath . '/classes/Collection.class.php';
include $rootpath . '/classes/Image.class.php';
$CollObj = new Collection();

$CollObj->initializeByName($collection);
$CollID = $CollObj->getVar("CID");

$CollProdList = $CollObj->getProducts();
?>
<html class="no-js" lang="en">
<head>
    <?php include '/incs/head-links.php'; ?>
	<link rel="stylesheet" href="/css/index.css" />
	<link rel="stylesheet" href="../css/preorder.css" />
</head>
<body class="body">
	<?php include 'nav.php'; ?>
	


	<div class="collectionPage">
		<div class="widthWrapper">



			<div class="topRow">
				<div class="headline">
					<div class="part1"><?php echo $headLine; ?></div><div class="part2">Collection</div>
				</div>
				<div class="text">
					<?php echo $description; ?>
				</div>
			</div>
			<?php
			foreach ($CollProdList as $product) {
				$ProdImgUrl = $product->getThumbnailUrl();
				if ($ProdImgUrl == "") {
					$ProdImgUrl = "/img/product/canvas_black_backpack.png";
				}
				$ProdPrice = number_format((float) $product->getVar("Price"), 0, '.', ',');
				$ProdTitle = $product->getProductName();
				$Style = str_replace(" ", "-", $ProdTitle);
				//if ($collection == "reykjavik") {
					//$ProdImgUrl= "../images/". $Style."_161127.jpg";
				//}else if($collection == "santa-fe"){
					//$ProdImgUrl= "../images/SantaFe_". $Style."_thumbnail.jpg";
				//}
            ?>
			<a class="item" href="/preorder/product.php?style=<?php echo $Style; ?>&pid=<?php echo $product->getVar("PID"); ?>">
				<img src="<?php echo $ProdImgUrl; ?>" />
				<div class="caption">
					<div class="title"><?php echo $ProdTitle; ?></div>
					<div class="price">$<?php echo $ProdPrice; ?></div>
				</div>
			</a>
			<?php } ?>
		</div>
	</div>





    <?php include '/incs/footer.php'; ?>
</body>
</html>

