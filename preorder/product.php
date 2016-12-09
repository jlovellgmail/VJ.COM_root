<!doctype html>
<?php 
$page = "home"; 
$seo_variable = "home";
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once($rootpath . '/incs/conn.php');
$PID = $_GET["pid"];
$Product = new Product();
$Product->initialize($PID);
$showProduct = TRUE;
if ($Product->getVar("Hidden") || $Product->getVar("DelFlag")) {
    $showProduct = FALSE;
}
$ObjPID = $Product->getPID();
$ObjName = $Product->getProductName();
$Type = ltrim(rtrim($Product->getType()));
if (!isset($ObjPID) || $ObjPID == "" || $ObjName == "") {
    $showProduct = FALSE;
}
if (isset($_GET["from"]) && $_GET["from"] == "admin") {
    $showProduct = TRUE;
}

$TImgUrl = $Product->getVar("ThumbnailUrl");
$TImgUrl = str_replace('\\', '/', $TImgUrl);
if (!isset($_SESSION)) {
    session_start();
}
$ImgUrl = $Product->getVar("ImgUrl");
$ImgUrl = str_replace('\\', '/', $ImgUrl);
?>
<html class="no-js" lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../css/bootstrap-grid.css" />
    <?php include '/incs/head-links.php'; ?>
	<link rel="stylesheet" href="/css/index.css" />
	<link rel="stylesheet" href="../css/preorder.css" />
	<link rel="stylesheet" href="/js/owl/dev/dist/assets/owl.carousel.css" />
    <link rel="stylesheet" href="/css/owl/owl.theme.vj.product.css" />
    <link rel="stylesheet" href="/css/lightBox.css" />
    <script src="/js/owl/dev/dist/owl.carousel.js"></script>
	<script src="/js/product.js" type="text/javascript"></script>
</head>
<body class="body">

			

	<?php include 'nav.php'; ?>
	
	<!-- <div class="page"> -->
	<div class="productPage">

		<div class="widthWrapper">

			
			<div class="breadcrumb">
				<a class="first" href="#">Home</a>
				<a href="preorder/collections.php">Collections</a>
				<a href="preorder/collection_reykjavik.php">Reykjavik Collection</a>
				<a href="preorder/reykjavik_drawstring.php">Drawstring</a>
				<div class="hline"></div>
			</div>

			<?php if ($showProduct) { 
					$pgallery = $Product->getProductGallery();
					  if (isset($pgallery) && $pgallery->count() > 0) {
							include $rootpath.'/incs/productHighResGallery.php';
					  }
			?>
			<div class="rowTop">
				<div class="productImageContainer">
					<img src="<?php echo $ImgUrl; ?>" />
				</div>
				<div class="productDescriptionContainer">
					<div class="collection">
						<?php echo $Product->getCollectionName(); ?><?php if ($Product->getType() != "Accessory") { ?> <span class="collection2">Collection</span><?php } ?>
					</div>
					<div class="productTitle">
						<?php echo $Product->getName(); ?>
					</div>
					<div class="productPrice">
						$<?php echo number_format((float) $Product->getVar("Price"), 0, '.', ','); ?>
					</div>
					<div class="productDescription">
						<?php echo $Product->getVar("ShortDescription"); ?>
					</div>
					<div class="addToCartButton">
						<a href="javascript:addToCart(<?php echo $PID; ?>)">Add to cart</a>
					</div>
				</div>
			</div>




			<?php if (isset($pgallery) && $pgallery->count() > 0) { ?>     

				<script>
					console.log(<?php echo $pgallery->count(); ?>);
				</script>

			    <div class="bgWrapperLeaf marBottomR3 prodGallerySlider">
			        <div class="absBgWrapper h100p zI2">
			            <!--<div class="cornerFixUL"></div>
			            <div class="cornerFixLR"></div>-->
			        </div>
			        <div id="owlThumb" class="owl-carousel">
			            <?php
			            $i = 0;
			            foreach ($pgallery as $img) {
			                $ImgUrl = $img->getVar("ThumbnailUrl");
			                $ImgUrl = str_replace('\\', '/', $ImgUrl);
			                ?>        
			                <div class="productGalleryImgWrapper">
			                    <div class="aspectDummy43"></div>
			                    <a class="productGalleryImg" href="javascript:openModalStatic(<?php echo $i; ?>);" style="background-image: url(<?php echo $ImgUrl; ?>);"></a>

			                    <script>
			                    	console.log(<?php //echo $ImgUrl; ?>);
			                    </script>

			                </div>
			                <?php
			                $i++;
			            }
			            ?>
			        </div>
			    </div>

			    <script>
			        $(document).ready(function () {
			            $("#owlThumb").owlCarousel({
			                startPosition: 2,
			                loop: true,
			                margin: 5,
			                autoplay: false,
			                // autoplayTimeout: 2500,
			                // autoplaySpeed: 750,
			                // autoplayHoverPause: true,
			                dots: true,
			                nav: true,
			                dotsEach: 1,
			                responsive: {
			                    0: {
			                        items: 1
			                    },
			                    640: {
			                        items: 3
			                    },
			                    1000: {
			                        items: 4
			                    }
			                }
			            });
			        });
			    </script>
		    <?php } ?>         







			<div class="rowDetails">
				<div class="blurb">
					<div class="heading">
						Details
					</div>
					<div class="bodyCopy">
						<?php echo $Product->getVar('Description'); ?>
					</div>
				</div>
				<div class="specs">
					<div class="section">
						<div class="heading">
							Dimensions
						</div>
						<div class="bodyCopy">
							Height / Width / Depth:<br/>
							<?php  echo $Product->getSize();?><br/>
							<?php  echo $Product->getSizeCM(); ?>
						</div>
					</div>
					<div class="section">
						<div class="heading">
							Weight
						</div>
						<div class="bodyCopy">
							<?php echo $Product->getWeight(); ?>
						</div>
					</div>
					<div class="section">
						<div class="heading">
							Primary Materials
						</div>
						<div class="bodyCopy">
							<?php echo $Product->getVar('PrimaryMaterial'); ?>
						</div>
					</div>
				</div>
			</div>

		<?php
            $ProductDetTempl = $Product->getTemplates();
            if (sizeof($ProductDetTempl) > 0) {
        ?>

			<div class="featuresSection">
				<div class="featuresContainer">
				<?php
					$featCount=0;
                    foreach ($ProductDetTempl as $Det) {
						$PtemplImgUrl = $Det->getImageUrl();
                        
                ?>
				<?php 
					if ($featCount>0){
						echo "<div class='hline'></div>";
					}
				?>	
					<div class="feature">
						<div class="iconFrame">
							<img src="<?php echo $PtemplImgUrl; ?>" />
							<div class="heading">
								<?php echo $Det->getVar('Name'); ?>
							</div>
						</div>
						<div class="bodyCopy">
							<?php echo $Det->getVar('Description'); ?>
						</div>
					</div>
				<?php 
					$featCount++;
				} ?>	
					
				</div>
			</div>
			<?php } ?>
			<?php  } ?>
		</div>
	</div>
    <?php include '/incs/footer.php'; ?>



</body>
</html>
 <script>
        function openModalStatic(i) {
            $('#owlLarge').trigger("to.owl.carousel", [i, 1, true]);
            $("#staticModal").removeClass("hide");
        }
    </script>
