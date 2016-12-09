<?php
if ($cartExist) {

    $ShipAddr = $Cart->getShipAddr();
    $ContFlag = FALSE;
    if ($PaymMethod == "cc") {
        $BillAddr = $Cart->getBillAddr();
    }
    if (isset($ShipAddr) && isset($BillAddr) && isset($PaymMethod) && $PaymMethod == "cc") {
        $ContFlag = TRUE;
    }

    if (isset($ShipAddr) && isset($PaymMethod) && $PaymMethod == "paypal") {
        $ContFlag = TRUE;
    }

    if (!$ContFlag) {
        header("Location: /cart/");
    }
} else {
    header("Location: /cart/");
}
?>

<div class="row cartBorderBottom">
    <h2 class="caps black">Shipping Info</h2>
    <div class="clearfix marTop15">
        <?php
        if (isset($ShipAddr)) {
            $AddrID = $ShipAddr->getVar("AddrID");
            $SName = $ShipAddr->getVar("FName") . " " . $ShipAddr->getVar("LName");
            $SAddr1 = $ShipAddr->getVar("Addr1");
            $SAddr2 = $ShipAddr->getVar("Addr2");
            $SCityStateZip = $ShipAddr->getVar("City") . ", " . $ShipAddr->getVar("State") . " " . $ShipAddr->getVar("Postal");
            $SCoutry = $Countries->getCountryName($ShipAddr->getVar("Country"));
            //$Email = $ShipAddr->getVar("Email");
            $Phone = $ShipAddr->getVar("Phone");
            $Email = $Cart->getEmail();
            ?>    
            <?php echo $SName; ?><br>
            <?php echo $SAddr1; ?><br>
            <?php
            if (isset($SAddr2) && $SAddr2 != "") {
                echo $SAddr2 . "<br>";
            }
            ?>
            <?php echo $SCityStateZip; ?><br>
            <?php echo $SCoutry; ?><br><br>

        <?php } ?>
    </div>    
    <form class="generalForm clearfix">
        <label class="contrastGrey"><em>Shipping Notes</em></label>
        <textarea id="shipNotesField" name="Notes"><?php echo $Notes; ?></textarea>
    </form>
</div>

<div class="row cartBorderBottom">
    <h2 class="caps black marTop30 marBottom15">Payment Info</h2>
    <div class="sm-twelve lg-six leftCol">
        <h4 class="caps black">Billing Address</h4>
        <div class="clearfix marTop15">
            <?php
            if ($PaymMethod == "cc") {
                if (isset($BillAddr)) {
                    $AddrID = $BillAddr->getVar("AddrID");
                    $BName = $BillAddr->getVar("FName") . " " . $BillAddr->getVar("LName");
                    $BAddr1 = $BillAddr->getVar("Addr1");
                    $BAddr2 = $BillAddr->getVar("Addr2");
                    $BCityStateZip = $BillAddr->getVar("City") . ", " . $BillAddr->getVar("State") . " " . $BillAddr->getVar("Postal");
                    $BCoutry = $Countries->getCountryName($BillAddr->getVar("Country"));
                    ?>
                    <?php echo $BName; ?><br>
                    <?php echo $BAddr1; ?><br>
                    <?php
                    if (isset($BAddr2) && $BAddr2) {
                        echo $BAddr2 . "<br>";
                    }
                    ?>
                    <?php echo $BCityStateZip; ?><br>
                    <?php echo $BCoutry; ?><br><br>
                <?php } ?>
            <?php } else if ($PaymMethod == "paypal") { ?>
                <?php echo $_SESSION["paypal_usrName"]; ?><br />
                <?php echo $_SESSION["paypal_email"]; ?><br><br />
                <em>Additional info on file with PayPal</em>
            <?php } ?>
        </div>    
    </div><!--
    --><div class="sm-twelve lg-six rightCol">
        <h4 class="caps black">Payment Method</h4>
        <div class="clearfix">
            <?php
            if ($PaymMethod == "cc") {
                $CC = $Cart->getCreditCard();
                $CCHolder = $CC->getVar("CCName");
                $CCLastDig = substr($CC->getVar("CCNumber"), -4);
                $CCType = $CC->getVar("CCType");
                $monthNum = $CC->getVar("CCXMonth");
                $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
                $CCExp = $monthName . ", " . $CC->getVar("CCXYear");
                ?>
                <div class="marTop15 col v-top"><img src="/img/cart/<?php echo $CCType; ?>-min.png" alt="<?php echo $CCType; ?>" width="44"></div><!--
                --><div class="marTop15 col posRel">
                    <div class="inlineTextField"><span class="fw-300">Cardholder:</span> <?php echo $CCHolder; ?></div>
                    <div class="inlineTextField"><span>Card Type:</span> Ending in <?php echo $CCLastDig; ?></div>
                    <div class="inlineTextField"><span>Card Expires:</span> <?php echo $CCExp; ?></div>
                </div>
            <?php } else if ($PaymMethod == "paypal") { ?>
                <div class="marTop15 col v-top"><img src="/img/cart/paypal-min.png" alt="PayPal" width="44"></div><!--
                --><div class="marTop15 col posRel"> 
                    &nbsp;&nbsp;<?php echo $_SESSION["paypal_usrName"]; ?><br />
                    &nbsp;&nbsp;<?php echo $_SESSION["paypal_email"]; ?><br><br />
                    <em>Additional info on file with PayPal</em>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php 
    if (isset($usrMode) && $usrMode=="guest"){
        include "incs/guestCustomerAccount.php";
    }else if (isset($usrMode) && $usrMode=="new"){
        include "incs/newCustomerAccount.php";
    }

?>
<div class="row marTop30">
    <div class="sm-twelve sm-twelve lg-nine f-14px textLeft marBottom15">
        <div class="col"> 
            <input type="checkbox" name="termAndCont" id="termAndCont"/> 
        </div><!--  
        --><div class="sm-ten" style="padding-left:15px">    
            <label for="termAndCont">I accept Virgil James</label> <a class="underline" href="javascript:showModal('/incs/modals/common/modalShipping.php');">shipping</a> and <a class="underline" href="javascript:showModal('/incs/modals/common/modalGuarantee.php');">guarantee</a> policies.
        </div>
    </div><!--
    --><div class="sm-twelve sm-twelve lg-three textRight marBottom15">
        <div id="completeOrdDiv"><a class="fillBtn" href="javascript:completeOrd('<?php echo $PaymMethod; ?>');" ><b>Continue</b></a></div>
        <div class="processBtn" id="processingDiv" style="display:none;">Processing...</div>
    </div>
</div>
<script>
    var usrMode = '<?php echo $usrMode ;?>';
</script>

