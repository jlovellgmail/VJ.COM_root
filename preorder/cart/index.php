<!doctype html>
<?php
$page = "checkout";
$rootpath = $_SERVER['DOCUMENT_ROOT'];

require_once $rootpath . "/classes/Cart.class.php";
require_once $rootpath . "/classes/Product.class.php";
require_once $rootpath . "/classes/Address.class.php";
include $rootpath . "/incs/check_login.php";

$cartExist = FALSE;
if (!isset($_SESSION)) {
    session_start();
}


if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    if ($Cart->count() > 0) {
        $cartExist = TRUE;
    }
}
?>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Cart Checkout | Virgil James</title>
        <?php include '../incs/head-links.php'; ?>
        <link rel="stylesheet" href="/css/cartv2.css">
        <link rel="stylesheet" href="/css/forms.css">
        <script src="js/cart.js" type="text/javascript"></script>
    </head>
    <body class="blackBg">
        <div class="bgWrapper">
            <div class="widthWrapper marBottom60">
                <div class="row">
                    <div class="sm-twelve marTop30 marBottom30 textLeft"><img src="/img/vj-logo-white.png" alt="" width="280"></div>
                </div>
                <div class="row">
                    <div class="sm-twelve mTextCenterDLeft fw-300">
                        <div class="leafCorners1 whiteBg pad30">
                            <?php include "incs/CartNav.php"; ?>
                            <div class="row">
                                <div class="sm-twelve md-twelve lg-nine leftCol cartLeft">
                                    <h1 class="black caps marBottom10">Shopping Cart</h1>
                                    <?php include "incs/cartDetails.php"; ?>                         
                                    <div class="row marTop30 v-btm">
                                        <div class="sm-twelve lg-six v-btm">
                                            <a class="caps black" href="/shop.php"><b> &lt; Continue Shopping</b></a>
                                        </div><!--
                                        --><?php if ($cartExist) { ?><!--
                                            --><div class="sm-twelve lg-six v-btm textRight">
                                                <a class="fillBtn" href="<?php echo ($logedIn ? "shipping.php" : "javascript:modalLogin()") ?>">Checkout</a>
                                            </div>
                                        <?php } else { ?><!--
                                            --><div class="sm-twelve lg-six v-btm textRight">
                                                <a class="fillBtn" href="/">Home</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div><!--
                                --><div class="sm-twelve md-twelve lg-three rightCol">
                                    <div class="textCenter cartSidebar lGrayWhiteGradient">  
                                        <img src="/uploadedImages/Products/shipping_icon.png" alt="" width="90">
                                        <div class="line-separator50px marBottom15 marTop15"></div>
                                        <span class="ital marBottom0">
                                            All Purchases Receive
                                        </span>
                                        <h2 class="caps black marTop0">
                                            FREE SHIPPING
                                        </h2>  
                                        <div class="line-separator50px marTop15 marBottom15"></div>
                                        <p>
                                            All purchases are shipped prepaid to your mailing address by FedEx in the United States, and by DHL Priority  to international customers.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
		        <?php include '/incs/cartFooter.php'; ?>
            </div>
        </div>
		<?php include $_SERVER['DOCUMENT_ROOT'] .'/incs/modalFrame.php'; ?>
<!--
        <div class="modalOverlay hide">
            <div class="modalContainer">
                <div class="modalWindow paddingR3">
                    <button class="modalClose caps fw-400 size5">X</button>
                    <div id="modalCheckout" class="modalContent hide">
                        <h1 class="caps fw-700">Sign In</h1>
                        <div class="leftLogin leftCol lg-six">
                            <h2 class="ital fw-400">Returning Customer</h2>
                            <form id="signInFormCart" class="generalForm" name="signInFormCart" method="post" action="/login_action.php?from=checkout">
                                <label for="userEmail">Email:</label>
                                <input id="email" name="email" type="text" value="" />
                                <label for="userPass">Password:</label>
                                <input id="passwd" name="passwd" type="password" value="" />
                                <button class="fillBtn mobileElement" form="signInForm" id="cartLoginBtn" onClick="cartLogin()">Sign In</button>
                            </form>
                        </div><div class="rightLogin rightCol lg-six">
                            <h2 class="ital fw-400">New Customer</h2>
                            <br>
                            <p>Checkout without signing in. During Checkout you can create an account using the information you provide for this transaction.</p>
                            <a class="fillBtn mobileElement" href="setUserMode.php?mode=new">Checkout as a New User</a>
                            <br>
                            <a class="fillBtn mobileElement" href="setUserMode.php?mode=guest">Checkout as Guest</a>
                        </div>
                        <div class="desktopElement lg-twelve">
                            <div class="signInButtonWrapper lg-six">
                                <button class="fillBtn" form="signInForm" id="cartLoginBtn" onClick="cartLogin()">Sign In</button>
                            </div><div class="guestButtonWrapper lg-six">
                                <a class="fillBtn" href="setUserMode.php?mode=new">Checkout as a New User</a>
                                <br><br>
                                <a class="fillBtn" href="setUserMode.php?mode=guest">Checkout as Guest</a>
                            </div>
                        </div>        
                    </div>
                </div>
            </div>
        </div>        
-->
    </body>
</html>