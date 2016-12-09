<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once($rootpath.'/incs/conn.php');
include $rootpath.'/classes/LifestyleGallery.class.php';

$LGID = $_GET['LGID'];
$LifestyleGallery = new LifestyleGallery();
$LifestyleGallery->initialize($LGID);

$list = $LifestyleGallery->getLiveRelatedProducts();
?>

<div class='modal-wrapper-lifestyle-gallery'>
    <!-- <h2 class="modalTitle caps fw-700 size6">WHAT WE CALL DIS</h6> -->
    <div class='row'>
        <div class='rel lg-six'>
            <div class='square-aspect-dummy'></div>
            <div class='aspect-img' style='background-image: url(<?php echo $LifestyleGallery->getImgUrl(); ?>);'></div>
        </div><div class='rel lg-six textLeft lifestyle-gallery-modal-right-col'>
            <div class='row marBottomR1'>
                <h3 class='caps fw-600'><?php echo $LifestyleGallery->getVar("Title"); ?></h3>
                <span class='fw-400'><?php echo $LifestyleGallery->getVar("Description"); ?></span>
            </div>
            <div class='row lifestyle-gallery-modal-images-wrapper'>
            	<?php 
            		foreach ($list as $relatedProduct)
						{
							$ImgUrl = $relatedProduct->getVar("ImgUrl");
                     $ImgUrl = str_replace('\\', '/', $ImgUrl);
                     $ProdTitle = $relatedProduct->getProductName();
							$Style = str_replace(" ", "-", $ProdTitle);
            	?><!--
                	--><div class='rel lg-four lifestyle-gallery-modal-img-wrapper'>
                    	<div class='rel'>
                        	<div class='square-aspect-dummy'></div>
                        	<a href="/product.php?style=<?php echo $Style; ?>&pid=<?php echo $relatedProduct->getVar("PID"); ?>"><div class='aspect-img' style='background-image: url(<?php echo $ImgUrl; ?>);'></div></a>
                    	</div>
                	</div><?php
                	} ?>
            </div>
        </div>
    </div>
</div>