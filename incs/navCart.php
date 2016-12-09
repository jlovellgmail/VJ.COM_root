<?php
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
if (isset($_GET["from"]) && $_GET["from"] == "AJAX") {
    $rootpath = $_SERVER['DOCUMENT_ROOT'];
    require_once $rootpath . "/classes/Cart.class.php";
    require_once $rootpath . "/classes/Product.class.php";
    if (!isset($_SESSION)) {
        session_start();
    }
    $UsrPriv = $_SESSION["UsrPriv"];
    $login = $_SESSION["login"];
    $rootpath = $_SERVER['DOCUMENT_ROOT'];
}
$cartExist = FALSE;
if (!isset($_SESSION)) {
    session_start();
}
$CartItmCount = 0;
if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    if ($Cart->count() > 0) {
        $cartExist = TRUE;
        $CartItmCount = $Cart->count();
        $paymMeth = $Cart->getPaymMethod();
    }
}

?>


<div class="navDropdownContainer">
    <!-- <?php if ($CartItmCount>0){ ?>
    <div class="navNotificationBubble"><?php echo $CartItmCount; ?></div><?php } ?> -->
    <a href="javascript:void(0)" class="navDropdownToggle" id="navDropdownToggle_cartID" >
        <i class="icon-basket"></i>
        <i class="icon-angle-down userHoverArrow"></i>
    </a>
    <div class="navDropdown navDropdownCart" id="navDropdownDiv_cartID">
        <div class="navDropdownOutside">
            <div class="navDropdownInside">
                <div class="navDropdownTitle">
                    <h1 class="caps black">Shopping Cart<span><a href="/cart/" class="size7">Edit</a></span></h1>
                </div>
                <div class="navDropdownContent cart"><!--
                    --><?php if (!$cartExist) { ?>
                        <div class="row v-mid marBottom30 textCenter"><div class="alertMessage clearBord">Your cart is empty.</div></div>
                        <?php
                    } else {

                        foreach ($Cart as $productArr) {
                            $product = $productArr["item"];
                            $prodQty = $productArr["qty"];
                            //$PID = $product->getId();
                            $ProductName = $product->getName();
                            $ProdImgUrl = $product->getThumbnailUrl();
                            if ($ProdImgUrl == "") {
                                $ProdImgUrl = "/img/product/canvas_black_backpack.png";
                            }
                            $ProdPrice = number_format((float) $product->getVar("Price"), 0, '.', ',');
                            ?><!--    
                            --><div class="row v-mid">
                                <div class="sm-three v-mid textCenter">
                                    <div class="flexImage">
                                        <div><img src="<?php echo $ProdImgUrl; ?>" alt=""></div>
                                    </div>
                                </div><!--
                                --><div class="sm-nine v-mid textRight">
                                    <span class="block marBottom5 fw-600"><?php echo $ProductName; ?></span>
                                    <?php if ($prodQty > 1) { ?>
                                    <span>Quantity&nbsp;(&nbsp;<?php echo $prodQty; ?>&nbsp;)<br /></span><?php } ?>$<?php echo $ProdPrice; ?>
                                    
                                </div>
                            </div>

                            <?php
                        }
                    }
                    ?>
                    <?php if ($cartExist) { ?>
                        <div class="row v-mid cartSubTotalRow">
                            <div class="lg-four v-bottom textLeft caps">
                                Subtotal
                            </div><!--
                            --><div class="lg-eight v-bottom textRight">
                                $<?php echo $Cart->getTotalWithOutTax(); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php if ($cartExist) { ?>
                    <div style="margin: 30px auto 0; text-align: center;">
                        <a href="javascript:goToCheckout();"  class="fillBtn caps">Proceed to Checkout</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>                        
</div>