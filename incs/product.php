<?php
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

include '/bitly/bitly.php';

$style = "Virgil James " . $Product->getName();
$currentURI=$_SERVER['REQUEST_URI'];
$facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=http://www.virgiljames.net$currentURI";
$twitterUrl = "https://twitter.com/share?text=$style&url=http://www.virgiljames.net$currentURI";
$params['longUrl'] = "http://www.virgiljames.net$currentURI";
$bitlyResults = bitly_get('shorten', $params);
	if (isset($bitlyResults["data"]["url"]) && $bitlyResults["data"]["url"]!="" ) {
		$CCShortUrl = $bitlyResults["data"]["url"];
		$twitterShortUrl = "https://twitter.com/share?text=" . $style . "%0a&url=" . $CCShortUrl;
	}else {
		$twitterShortUrl = $twitterUrl;
	}
//change to get shares work -- see above code by christos
//$facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode("http://www.virgiljames.net/product.php?style=" . $_GET["style"] . "&pid=" . $_GET["pid"]);
//$twitterUrl = "https://twitter.com/share?url=" . urlencode("http://www.virgiljames.net/product.php?style=" . $_GET["style"] . "&pid=" . $_GET['pid']);

$websiteHandle = urlencode("http://www.virgiljames.net/product.php?style=" . $_GET["style"] . "&pid=" . $_GET['pid']);
?>

<!-- Product Hero -->
<?php if ($showProduct) { ?>
    <div class="landing-hero-wrapper index-slide productLeafWrapper leafShadow">
        <div class="aspect-dummy-hero product-dummy-hero"></div>
        <div class="aspect-img aspect-img-hero product-aspect-hero">
            <div class="widthWrapper h100p">
                <!-- Back Button -->
                <div class="backBtnWrapper">
                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/shop.php" || $_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/shop/") {
                        echo '<a href="/shop/" class="aWhite caps f-12px" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;All Products</a>';
                    }
                    ?>
                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/shop/men/") {
                        echo '<a href="/shop/men/" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;All Mens</a>';
                    }
                    ?>
                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/shop/women/") {
                        echo '<a href="/shop/women/" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;All Womens</a>';
                    }
                    ?>
                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/shop/accessories/") {
                        echo '<a href="/shop/accessories/" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;All Accessories</a>';
                    }
                    ?>
                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/collection/classic/canvas/") {
                        echo '<a href="/collection/classic/canvas/" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Canvas Collection</a>';
                    }
                    ?>
                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/collection/city/reykjavik/") {
                        echo '<a href="/collection/city/reykjavik/" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Reykjavik Collection</a>';
                    }
                    ?>
                    <?php
                    if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/collection/city/santa-fe/") {
                        echo '<a href="/collection/city/santa-fe/" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Santa Fe Collection</a>';
                    }
                    ?>
                </div>
                <div class="tableWrapper h100p">
                    <div class="cellWrapper">
                        <div class="col xs-twelve md-six xl-seven product-image-block">
                            <!-- <img src="/img/product/spinner_sprite_32-1-min.png" alt="" class="reel productImg"
                                 data-image="/img/product/spinner_sprite_32-min.png"
                                 data-frames="32"
                                 data-footage="8"
                                 data-responsive="true"
                                 data-cursor="hand"
                                 data-revolution="300"
                                 data-brake="0.05"
                                 data-opening="1" />
                            <span class="rotate360"><i class="icon-arrows-cw"></i>&nbsp;Rotate 360&deg;</span> -->
                            <?php
                            $ImgUrl = $Product->getVar("ImgUrl");
                            $ImgUrl = str_replace('\\', '/', $ImgUrl);
                            $pinterest = "http://pinterest.com/pin/create/button/?url=" . urlencode("http://www.virgiljames.net/product.php?style=" . $_GET["style"] . "&pid=" . $_GET["pid"]) . "&media=" . urlencode("http://www.virgiljames.net$ImgUrl");
                            ?>
                            <img class="tempProductImg xs-nine sm-eight lg-six xl-five" src="<?php echo $ImgUrl; ?>" alt="<?php echo $Product->getName(); ?>" />
                        </div><div class="heroDetails col xs-twelve md-six xl-five">
                            <span class="lineTitle1"><?php echo $Product->getLineName(); ?></span><div class="lineTitleSpace"></div><?php if ($Product->getType() != "Accessory") { ?><span class="lineTitle2">Line</span><?php } ?>
                            <span class="collectionTitle">&nbsp;&#124;&nbsp;<?php echo $Product->getCollectionName(); ?> <?php if ($Product->getType() != "Accessory") { ?>Collection<?php } ?></span><br />
                            <h1 class="productTitle"><?php echo $Product->getName(); ?></h1>
                            <div class="productMSRP">$<?php echo number_format((float) $Product->getVar("Price"), 0, '.', ','); ?></div>
                            <div class="productOverview rel block"><?php echo $Product->getVar("ShortDescription"); ?><a href="#product-details" class="productDetailsA caps fw-600" style="display: block; padding-top: 12px;">Product Details<i class="icon-down-dir white"></i></a></div>
                            <div class="purchaseVarsRow lg-twelve">
                                <div class="qtyWrapper2">
                                    <div class="qtyLabel">Qty:</div><input class="qtyInput" type="number" name="itemQty" id="itemQty" onfocus="this.value = ''" value="1"/>
                                </div><div class="purchaseRow2">
                                    <a class="buyButtonA" href="javascript:addToCart(<?php echo $PID; ?>)"><div class="buyButton">Add to Cart</div></a>
                                </div>
                            </div>
                        </div>
                        <div class="socialRow lg-twelve">
                            <div class="xs-zero md-six lg-seven textLeft"></div><div class="productSocialWrapper md-six lg-five">
                                <ul class="shareIcons">
                                    <li><a href="<?php echo $facebookUrl; ?>" target="_blank"><i class="icon-facebook-squared"></i>Share</a></li><!--
                                 --><li><a href="<?php echo $twitterShortUrl; ?>" target="_blank"><i class="icon-twitter-squared"></i>Tweet</a></li><!--
                                 --><li><a href="<?php echo $pinterest; ?>" target="_blank"><i class="icon-pinterest-squared"></i>Pin</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bgWrapper productDetailsBgWrapper">
        <div class="widthWrapper">
            <?php if (isset($pgallery) && $pgallery->count() > 0) { ?>     

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

            <div id='product-details' class="detailsPanel">
                <h3>Product Details</h3>
                <div class="detailsP col lg-six leftCol">
                    <p><?php echo $Product->getVar('Description'); ?></p>
                </div><div class="detailsSpecs col lg-six rightCol">
                <?php if (isset($Type) && $Type=="Bag"){ ?>    
                    <?php if ($Product->getSize() != "" || $Product->getSizeCM() != "") { ?>
                        <span class="detailsSpecsTitle">Dimensions:</span><br />
                        <span class="detailsSpec">Height / Width <?php if ($Product->getVar("Depth") > 0) { ?>/ Depth<?php } ?>:<?php if ($Product->getSize() != "") { ?><br /><?php
                                echo $Product->getSize();
                            }
                            ?><?php if ($Product->getSizeCM() != "") { ?><br/><?php
                                echo $Product->getSizeCM();
                            }
                            ?></span><br />
                    <?php } ?>
                    <?php if ($Product->getWeight() != "") { ?>
                        <span class="detailsSpecsTitle">Weight:</span><br />
                        <span class="detailsSpec"><?php echo $Product->getWeight(); ?></span><br />
                    <?php } ?>
                <?php } else { ?>
                      <?php if ($Product->getVar("AccessorySize")!="") { ?>
                        <span class="detailsSpecsTitle">Size:</span><br />
                        <span class="detailsSpec">
                            <?php echo $Product->getVar("AccessorySize"); ?>
                        </span><br>
                      <?php } ?>   
                <?php } ?>        
                    <span class="detailsSpecsTitle">Primary Material(s):</span><br />
                    <span class="detailsSpec"><?php echo $Product->getVar('PrimaryMaterial'); ?></span>
                </div>
                <?php
                $ProductDetTempl = $Product->getTemplates();
                if (sizeof($ProductDetTempl) > 0) {
                    ?>
                    <div class="featurePaneWrapper">
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
<?php } else { ?>

    <div class="row">
        <div class="sm-eleven lg-six centerCol">
            <h1 class="caps marTop30">Currently Unavailable</h1>
            <div class="alertMessage">Please visit the <a class="underline" href="/shop.php">shop</a> to view our current collection of products.</div>			
        </div>
    </div>

<?php } ?>
