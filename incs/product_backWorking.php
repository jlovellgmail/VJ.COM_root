<?php
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);


$PID = $_GET["pid"];
$Product = new Product();
$Product->initialize($PID);
$pgallery = $Product->getProductGallery();
if (isset($pgallery) && $pgallery->count() > 0) {
    include '/incs/productHighResGallery.php';
}
//print_r($Product);
//exit();
?>

<!-- Product Hero -->

<div class="bgWrapperLeaf marBottom30">
    <div class="landingLeafWrapper productLeafWrapper leafShadow">
        <div class="tableWrapper">
            <div class="cellWrapper">
                <div class="widthWrapper">

                    <div class="col lg-eight">
                        <img src="/img/product/spinner_sprite_32-1-min.png" alt="" class="reel productImg"
                             data-image="/img/product/spinner_sprite_32-min.png"
                             data-frames="32"
                             data-footage="8"
                             data-responsive="true"
                             data-cursor="hand"
                             data-revolution="300"
                             data-brake="0.05"
                             data-opening="1" />
                        <span class="rotate360"><i class="icon-arrows-cw"></i>&nbsp;Rotate 360&deg;</span>
                    </div><div class="heroDetails col lg-four">
                        <span class="lineTitle1"><?php echo $Product->getLineName(); ?></span><div class="lineTitleSpace"></div><span class="lineTitle2">Line</span>
                        <span class="collectionTitle">&nbsp;&#124;&nbsp;<?php echo $Product->getCollectionName(); ?> Collection</span><br />
                        <h1 class="productTitle"><?php echo $Product->getStyleName(); ?></h1>
                        <div class="productMSRP">$<?php echo number_format((float) $Product->getVar("Price"), 2, '.', ''); ?></div>
                        <p class="productOverview"><?php echo $Product->getVar("ShortDescription"); ?></p>
                        <!--<a href="#product_details" class="productDetailsA">
                            <div class="detailsCTA">
                                <span class="viewDetails">View Product Details</span>
                                <div class="arrow-right"></div>
                            </div>
                        </a>-->

                        <div class="purchaseVarsRow lg-twelve">
                            <div class="qtyWrapper2">
                                <div class="qtyLabel">Qty:</div><input class="qtyInput" type="number" name="itemQty" id="itemQty" onfocus="this.value = ''" value="1"/>
                            </div><div class="purchaseRow2">
                                <a class="buyButtonA" href="javascript:addToCart(<?php echo $PID; ?>)"><div class="buyButton">Add to Cart</div></a>
                            </div>
                        </div>

                    </div>
                    <div class="socialRow lg-twelve">
                        <div class="lg-eight textLeft"></div><!-- 
                        --><div class="productSocialWrapper lg-four">
                            <ul class="shareIcons">
                                <li><a href="https://twitter.com" target="_blank"><i class="icon-mail-squared"></i>Mail</a></li><!--
                                --><li><a href="https://facebook.com" target="_blank"><i class="icon-twitter-squared"></i>Tweet</a></li><!--
                                --><li><a href="https://pinterest.com" target="_blank"><i class="icon-facebook-squared"></i>Share</a></li><!--
                                --><li><a href="https://instagram.com" target="_blank"><i class="icon-pinterest-squared"></i>Pin</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="backBtnWrapper">


                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/shop.php" || $_SERVER['HTTP_REFERER'] == "http://virgiljames.net/shop.php") {
                        echo '<a href="/shop.php" class="aWhite caps f-12px" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Back to Shop</a>';
                    }
                    ?>

                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/shop.php?type=mens") {
                        echo '<a href="/shop.php?type=mens" class="aWhite caps f-12px" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Back to Mens</a>';
                    }
                    ?>

                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/shop.php?type=womens") {
                        echo '<a href="/shop.php?type=womens" class="aWhite caps f-12px" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Back to Womens</a>';
                    }
                    ?>

                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/shop.php?type=accessories") {
                        echo '<a href="/shop.php?type=accessories" class="aWhite caps f-12px" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Back to Accessories</a>';
                    }
                    ?>

                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/collection/details.php?col=canvas&line=classic") {
                        echo '<a href="/collection/details.php?col=canvas&line=classic" class="aWhite caps f-12px" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Back to Canvas Collection</a>';
                    }
                    ?>

                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/collection/details.php?col=reykjavik&line=city") {
                        echo '<a href="/collection/details.php?col=reykjavik&line=city" class="aWhite caps f-12px" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Back to Reykjavik Collection</a>';
                    }
                    ?>

                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/collection/details.php?col=santa-fe&line=city") {
                        echo '<a href="/collection/details.php?col=santa-fe&line=city" class="aWhite caps f-12px" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Back to Santa Fe Collection</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bgWrapper productDetailsBgWrapper">
    <div class="widthWrapper">
        <?php if (isset($pgallery) && $pgallery->count() > 0) { ?>     
            <!--         <div class="headingWrapper">
                        <div class="headingDashes">
                            <h2 class="ital fw-300 size4">Gallery</h2>
                        </div>
                    </div> -->
        </div>

        <div class="bgWrapperLeaf marBottomR2">
            <div class="leafWrapper">

                <div class="absBgWrapper h100p zI2">
                    <div class="cornerFixUL"></div>
                    <div class="cornerFixLR"></div>
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
                        </div>
                        <?php
                        $i++;
                    }
                    ?>


                </div>

            </div>
        </div>

        <script>
            $(document).ready(function () {
                $("#owlThumb").owlCarousel({
                    startPosition: 2,
                    loop: true,
                    margin: 5,
                    autoplay: true,
                    autoplayTimeout: 2500,
                    autoplaySpeed: 750,
                    autoplayHoverPause: true,
                    dots: false,
                    nav: true,
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
    <div class="widthWrapper">         

        <div class="detailsPanel leafCorners1">
            <div class="productDetailsWaypoint" id="product_details"></div> 
            <h3>Details</h3>
            <div class="detailsP col lg-six leftCol">
                <p><?php echo $Product->getVar('Description'); ?></p>
            </div><div class="detailsSpecs col lg-six rightCol">
                <span class="detailsSpecsTitle">Dimensions:</span><br />
                <span class="detailsSpec">Height / Width <?php if ($Product->getVar("Depth") > 0) { ?>/ Depth<?php } ?>:<br /><?php echo $Product->getSize(); ?>&nbsp;&nbsp;&#124;&nbsp;&nbsp;<?php echo $Product->getSizeCM(); ?></span><br />
                <span class="detailsSpecsTitle">Weight:</span><br />
                <span class="detailsSpec"><?php echo $Product->getVar('Weight'); ?> lbs&nbsp;&nbsp;&#124;&nbsp;&nbsp;<?php echo $Product->getVar('WeightKG'); ?> kg</span><br />
                <span class="detailsSpecsTitle">Primary Material(s):</span><br />
                <span class="detailsSpec"><?php echo $Product->getVar('PrimaryMaterial'); ?></span>
            </div>
            <?php
            $ProductDetTempl = $Product->getTemplates();
            if (sizeof($ProductDetTempl) > 0) {
                ?>
                <div class="featurePaneWrapper leafCorners2">
                    <?php
                    foreach ($ProductDetTempl as $Det) {
                        $PtemplImgUrl = $Det->getImageUrl();
                        //$PtemplImgUrl = str_replace('\\', '/', $PtemplImgUrl);
                        ?>
                        <div class="featurePane col sm-twelve">
                            <div class="featureTitle lg-four">
                                <img src="<?php echo $PtemplImgUrl; ?>" alt="" height="68" /><br /><br />
                                <span class="featurePaneTitle"><?php echo $Det->getVar('Name'); ?></span>
                            </div><div class="lg-eight">
                                <p class="featureCopy featurePaneP"><?php echo $Det->getVar('Description'); ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


<script>
    function openModalStatic(i) {
        $('#owlLarge').trigger("to.owl.carousel", [i, 1, true]);
        $("#staticModal").removeClass("hide");
    }
</script>