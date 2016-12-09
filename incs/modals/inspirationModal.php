<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/incs/conn.php';
include $rootpath . '/classes/AmbassadorInspiration.class.php';

$IID = $_GET['IID'];

$imageTitle = '';
$message = '';
$imgUrl = '';
$imgType = '';

if (isset($IID) && $IID != "") {
    $Inspiration = new AmbassadorInspiration();
    $Inspiration->initialize($IID);

    $imageTitle = $Inspiration->getVar("ImageTitle");
    $message = $Inspiration->getVar("Message");
    $imgUrl = $Inspiration->getImgUrl();
    $imgType = $Inspiration->getVar("ImgType");
    $cssClassLeft = 'square-image lg-six marBottomR1';
    $cssClassRight = 'lg-six marBottom15';
    $cssModalMessage = 'max-width: 480px;';
    $relatedShifterTop = '</div>';
    $relatedShifterBottom = '';
    $relatedProductGrid = 'lg-three';
    $relatedProductTitle = 'lg-three';
    $titleBreak = '<br />';
    if ($imgType == 'W')
    {
        $cssClassLeft = 'wide-image lg-twelve marBottomR1';
        $cssClassRight = 'lg-twelve marBottomR1';
        $cssModalMessage = 'padding-left: 0; max-width: 480px;';
        $titleBreak = ' ';
    } else if ($imgType == 'T') {
        $cssClassLeft = 'tall-image md-six lg-six';
        $cssClassRight = 'md-six lg-six';
        $cssModalMessage = 'max-width: 420px;';
        $relatedShifterTop = '';
        $relatedShifterBottom = '</div>';
        $relatedProductGrid = 'lg-four';
        $relatedProductTitle = 'lg-twelve';
        $titleBreak = ' ';
    }
    $list = $Inspiration->getLiveRelatedProducts();
}
?>
<div class='rel block inspiration-modal-content'>

    <div class='rel block xs-twelve'>
        <div class='inspire-img-title-line'><span class='size45 fw-600 black rel block marBottom15' style='padding: 0 15px;'><?php echo $imageTitle; ?></span></div>

        <div class='inspire-image-wrapper xs-twelve <?php echo $cssClassLeft; ?>'>
            <div class='rel block'>
                <?php if ($imgType == 'S') { ?>
                <div class='square-aspect-dummy inspire-img-square'></div>
                <?php } else if ($imgType == 'W') { ?>
                <div class='aspect-dummy-one-half inspire-img-wide'></div>
                <?php } else if ($imgType == 'T') { ?>
                <div class='one-two-aspect-dummy inspire-img-tall'></div>
                <?php } ?>
                <div class='aspect-img' style='background-image: url(<?php echo $imgUrl; ?>);'></div>
            </div>
        </div><!-- 
     --><div class='inspire-modal-message xs-twelve textLeft <?php echo $cssClassRight; ?>' style='<?php echo $cssModalMessage; ?>'>
            <?php echo $message; ?>

            <?php echo $relatedShifterTop; ?>

            <div class='xs-twelve textLeft'>
            	 <?php if ($list->count() > 0) { ?>
                    <div class='rel xs-twelve <?php echo $relatedProductTitle; ?> marBottom5'>
                        <span class='rel block caps fw-700 size6 textLeft' style='margin-bottom: 0;'>Related<?php echo $titleBreak; ?>Products</span>
                    </div><?php } ?><?php 
                    foreach ($list as $relatedProduct)
                    {
                        $ImgUrl = $relatedProduct->getVar("ImgUrl");
                        $ImgUrl = str_replace('\\', '/', $ImgUrl);
                        $ProdTitle = $relatedProduct->getProductName();
                        $Style = str_replace(" ", "-", $ProdTitle);
                ?><!--
                    --><div class='rel xs-four <?php echo $relatedProductGrid; ?>'>
                        <div class='rel'>
                            <div class='square-aspect-dummy'></div>
                            <a href="/product.php?style=<?php echo $Style; ?>&pid=<?php echo $relatedProduct->getVar("PID"); ?>"><div class='aspect-img' style='background-image: url(<?php echo $ImgUrl; ?>);'></div></a>
                        </div>
                    </div><?php
                    } ?>
            </div>
            <?php echo $relatedShifterBottom; ?>
    </div>
</div>