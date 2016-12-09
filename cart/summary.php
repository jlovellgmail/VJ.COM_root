<!doctype html>
<?php
$page = "cartSummary";
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . "/incs/conn.php";
require_once $rootpath . "/classes/Address.class.php";
include $rootpath . "/core/Countries.class.php";
require_once $rootpath . "/classes/CreditCard.class.php";
include $rootpath . "/incs/check_login.php";
$cartExist = FALSE;
if (!isset($_SESSION)) {
    session_start();
}
$usrMode = "";
if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    if ($Cart->count() > 0) {
        $cartExist = TRUE;
        $usrMode = $Cart->getUsrMode();
        $PaymMethod = $Cart->getPaymMethod();
        $Notes = $Cart->getShipNotes();
    }
}

if (!$cartExist) {
    header("Location: /cart/");
}

$Countries = new Countries();
//print_r($Cart->getUsrID());
//exit();
?>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Cart Summary | Virgil James</title>
        <?php include '../incs/head-links.php'; ?>
        <link rel="stylesheet" href="/css/cartv2.css">
        <link rel="stylesheet" href="/css/forms.css">
        <script src="/cart/js/cart.js" type="text/javascript"></script>
    </head>
    <body class="blackBg">
        <div class="bgWrapper">
            <div class="widthWrapper marBottom60">
                <div class="row">
                    <div class="sm-twelve marTop30 marBottom30 textLeft"> <img src="/img/vj-logo-white.png" alt="" width="280"> </div>
                </div>
                <div class="row">
                    <div class="sm-twelve mTextCenterDLeft fw-300">
                        <div class="leafCorners1 whiteBg pad30">
                            <?php include 'incs/cartNav.php'; ?>

                            <div class="row">
                                <div class="lg-eight leftCol cartLeft">
                                    <?php include 'incs/summary.php'; ?>
                                </div><!--
                                --><div class="lg-four rightCol">                            
                                    <?php include 'incs/cartSidebar.php'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include '/incs/cartFooter.php'; ?>
            </div>
        </div>
        <?php  include $_SERVER['DOCUMENT_ROOT'] .'/incs/modalFrame.php'; ?>
        <div class="modalOverlayCart hide">
            <div class="modalContainer">
                <div class="modalWindow paddingR3">
                    <button class="modalClose caps fw-400 size5">X</button>
                    <div id="modalReviewCheckout" class="modalContent hide">
                        <h1 class="caps fw-700">Sign In</h1>
                        <div class="leftLogin leftCol lg-six">
                            <div id="accDelDiv">
                                <h2 class="ital fw-400">Account Deleted</h2><br />
                                <p>The email address entered has been deleted. Please contact customerservice@virgiljames.com to re-enable your account.</p>
                            </div>
                            <div id="accExitstDiv">
                                <h2 class="ital fw-400">Returning Customer</h2>
                                <form id="signInFormReview" class="generalForm" name="signInFormReview">
                                    <div class='alertMessage' id="summaryLoginErrDiv"></div>
                                    <label for="userEmail">Email:</label>
                                    <input id="reviewModalEmail" name="email" type="text" value="" />
                                    <label for="userPass">Password:</label>
                                    <input id="reviewModalPassw" name="passwd" type="password" value="" />
                                    <a href ="#" class="fillBtn mobileElement" id="cartLoginBtn" onClick="reviewLogin('<?php echo $PaymMethod; ?>')">Sign In</a>
                                </form>
                            </div>
                        </div><div class="rightLogin rightCol lg-six">
                            <h2 class="ital fw-400">Guest Customer</h2><br />
                            <p id="accDelP">The email address entered has been deleted. You may continue as a guest below.</p>
                            <p id="accExistP">The email address entered is already in use on Virgil James. You may login to this account using the form on the left, you may also continue as a guest below.</p>
                            <a class="fillBtn mobileElement" href="javascript:placeOrd('<?php echo $PaymMethod; ?>');">Continue</a>
                        </div>
                        <div class="desktopElement lg-twelve">
                            <div class="signInButtonWrapper lg-six">
                                <div id="singInBtnDiv">
                                    <a href ="javascript:void(0)" class="fillBtn " id="cartLoginBtn" onClick="reviewLogin('<?php echo $PaymMethod; ?>')">Sign In</a>
                                </div>
                            </div><div class="guestButtonWrapper lg-six">
                                <a class="fillBtn" href="javascript:placeOrd('<?php echo $PaymMethod; ?>');">Continue</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>