<!doctype html>
<?php
$page = "cartBilling";
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
        $paymMeth = $Cart->getPaymMethod();
        $currentBillAddr = $Cart->getBillAddr();
    }
}
if (!$cartExist){
   header("Location: /cart/");
}

$showSaved = FALSE;

if ($logedIn) {
    include $rootpath . "/classes/AddressList.class.php";
    $UsrID = $_SESSION['UsrID'];
    $AddressList = new AddressList($UsrID);
    $AddressList = $AddressList->getBillAddressList();
    if (count($AddressList) > 0) {
        $showSaved = TRUE;
    }
}

$AddrFrmType = "Bil";
$Countries = new Countries();

?>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Cart Billing | Virgil James</title>
        <?php include '../incs/head-links.php'; ?>
        <link rel="stylesheet" href="/css/cartv2.css">
        <link rel="stylesheet" href="/css/forms.css">
        <link rel="stylesheet" href="/css/forms.css" />
        <script src="/cart/js/cart.js" type="text/javascript"></script>
        <script src="/js/jquery.creditCardValidator.js"></script>
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
                            <?php include 'incs/cartNav.php'; ?>

                            <div class="row">
                                <div class="lg-eight leftCol cartLeft">
                                    <?php include 'incs/billing.php'; ?>
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
		<?php include $_SERVER['DOCUMENT_ROOT'] .'/incs/modalFrame.php'; ?>
        <script>
            var showSaved = '<?php echo $showSaved; ?>';
            $(document).ready(function () {
                $('.toggleDivGroupButton').click(function () {
                    var toggleId = $(this).data('id');
                    $(".toggleDivGroupItem").hide();
                    $("#" + toggleId + ".toggleDivGroupItem").slideToggle();
                });

                $('.toggleDivGroupItemClose').click(function () {
                    $(".toggleDivGroupItem").hide();
                    $(".toggleDivGroupItem.toggleDivGroupDefault").show();
                });
                <?php if (isset($paymMeth) && $paymMeth == "cc") { ?>
                $('#ccPaymentSelect').trigger('click');
                <?php } ?>
                <?php if (isset($paymMeth) && $paymMeth == "paypal") { ?>
                $('#paypalPaymentSelect').trigger('click');
                <?php } ?>
            });
            
        </script>      
    </body>
</html>