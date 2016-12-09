<!doctype html>
<?php 
$page = "cartReceipt"; 
$rootpath = $_SERVER['DOCUMENT_ROOT'];

require_once $rootpath . "/classes/Order.class.php";
require_once $rootpath . "/classes/Product.class.php";
require_once $rootpath . "/classes/Address.class.php";
require_once $rootpath . "/core/Countries.class.php";
require_once $rootpath . "/classes/CreditCard.class.php";
include $rootpath . "/incs/check_login.php";

$orderExist = FALSE;
if (!isset($_SESSION)) {
    session_start();
}


if (isset($_SESSION["Order"])) {
    $Order = $_SESSION["Order"];
    if ($Order->count() > 0) {
        $orderExist = TRUE;
    }
} else {
    header("Location: /cart/");
}

if (!$orderExist){
   header("Location: /cart/");
}

$Countries = new Countries();
?>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Cart Receipt | Virgil James</title>
        <?php include '../incs/head-links.php'; ?>
        <link rel="stylesheet" href="/css/cartv2.css">
        <link rel="stylesheet" href="/css/forms.css">
        <link rel="stylesheet" href="/css/forms.css" />
        <script src="/cart/js/cart.js" type="text/javascript"></script>
    </head>
    <body class="blackBg">
        <div class="bgWrapper">
            <div class="widthWrapper marBottom60">
                <div class="row">
                    <div class="sm-twelve marTop30 marBottom30 textLeft"><a href="/"><img src="/img/vj-logo-white.png" alt="" width="280"></a></div>
                </div>
                <div class="row">
                    <div class="sm-twelve mTextCenterDLeft fw-300">
                        <div class="leafCorners1 whiteBg pad30">
                            <?php include '/incs/cartNav.php'; ?>
                            <?php include '/incs/receipt.php'; ?>                    
                        </div>
                    </div>
                </div>
				<?php include '/incs/cartFooter.php'; ?>     
            </div>
        </div>
		<?php include $_SERVER['DOCUMENT_ROOT'] .'/incs/modalFrame.php'; ?>
    </body>
</html>