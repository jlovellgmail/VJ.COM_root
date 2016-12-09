<?php
if (!$orderExist) {
    echo "<div class='cartItemsRow'><div class='emptyCartLine lg-twelve' style='text-align: center;'>Invalid Order </div></div>";
} else {
    $Email = $Order->getVar("Email");
    $ShipAddr = $Order->getVar("ShippingAddr");
    $ShipNotes = $Order->getVar("ShipNotes");
    if (isset($ShipAddr)) {
        $AddrID = $ShipAddr->getVar("AddrID");
        $SName = $ShipAddr->getVar("FName") . " " . $ShipAddr->getVar("LName");
        $SAddr1 = $ShipAddr->getVar("Addr1");
        $SAddr2 = $ShipAddr->getVar("Addr2");
        $SCityStateZip = $ShipAddr->getVar("City") . ", " . $ShipAddr->getVar("State") . " " . $ShipAddr->getVar("Postal");
        $SCoutry = $Countries->getCountryName($ShipAddr->getVar("Country"));

        $Phone = $ShipAddr->getVar("Phone");
        $SCoutry = $Countries->getCountryName($ShipAddr->getVar("Country"));
    }
    if ($Order->getVar("PaymMethod") == "cc") {
        $BillAddr = $Order->getVar("BillingAddr");
        if (isset($BillAddr)) {
            $AddrID = $BillAddr->getVar("AddrID");
            $BName = $BillAddr->getVar("FName") . " " . $BillAddr->getVar("LName");
            $BAddr1 = $BillAddr->getVar("Addr1");
            $BAddr2 = $BillAddr->getVar("Addr2");
            $BCityStateZip = $BillAddr->getVar("City") . ", " . $BillAddr->getVar("State") . " " . $BillAddr->getVar("Postal");
            $BCoutry = $Countries->getCountryName($BillAddr->getVar("Country"));
            $CreditCard = $Order->getCreditCard();
            $CCNo = $CreditCard->getVar("CCNumber");
            $CCNum = substr($CCNo, -4);
            $CCType = $CreditCard->getVar("CCType");
        }
    }
    ?>

    <div class="row">
        <div class="lg-eight leftCol">
            <div class="row">
                <h1 class="caps black marTop30">Order Receipt</h1>
                <h2 class="black ital fw-300 marTop15 marBottom30">Order #<?php echo $Order->getOrdID()." - ".  $Order->getDate(); ?></h2>
                <div class="sm-twelve lg-six leftCol">
                    <h4 class="caps black">Shipping to</h4>
                    <div class="clearfix marTop15"> <?php echo $SName; ?><br>
                        <?php echo $SAddr1; ?><br>
                        <?php
                        if (isset($SAddr2) && $SAddr2 != "") {
                            echo $SAddr2 . "<br>";
                        }
                        ?> 
                        <?php echo $SCityStateZip; ?><br>
                        <?php echo $SCoutry; ?><br>
                        <?php echo $Phone; ?> <br>
                        <?php
                        if (isset($ShipNotes) && $ShipNotes != "") {
                            echo $ShipNotes . "<br>";
                        } else {
                            echo "<br>";
                        }
                        ?>
                    </div>
                </div><!--
                --><div class="sm-twelve lg-six rightCol">
                    <h4 class="caps black">Billed to</h4>
                    <?php if ($Order->getVar("PaymMethod") == "cc") { ?>
                        <div class="clearfix marTop15"><?php echo $BName; ?><br>
                            <?php echo $BAddr1; ?><br>
                            <?php if (isset($BAddr2) && $BAddr2 != "") { ?>
                                <?php echo $BAddr2 . "<br>"; ?>    
                            <?php } ?>
                            <?php echo $BCityStateZip; ?><br>
                            <?php echo $BCoutry; ?><br>
                            <?php echo ucfirst($CCType) . " ending in " . $CCNum; ?>
                        </div>
                    <?php } else if ($Order->getVar("PaymMethod") == "paypal") { ?>
                        <div class="clearfix marTop15"> <?php echo $_SESSION["paypal_usrName"]; ?><br>
                            PayPal Email : <?php echo $_SESSION["paypal_email"]; ?><br>
                            <em>Additional info on file with PayPal</em>
                        </div>
                    <?php } ?>    
                </div>
            </div>
        </div><!--
        --><div class="lg-four rightCol">
            <div class="textCenter cartSidebar lGrayWhiteGradient" style="min-height:200px; vertical-align:middle;"> <br>
                <div class="line-separator50px marBottom15 marTop15"></div>
                <h1 class="caps black marBottom0"> Thank You </h1>
                <span class="ital marBottom0"> For purchasing from Virgil James </span>
                <div class="line-separator50px marTop15 marBottom15"></div>
                <br>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row marTop30">
            <div class="sm-twelve">
                <div class="cartTableWrapper">
                    <div class="titleRow">
                        <div class="itemTitle sm-five lg-two textCenter">Item</div><!--
                        --><div class="qtyTitle sm-three lg-two">Quantity</div><!--
                        --><div class="productTitle sm-zero lg-six">Product</div><!--
                        --><div class="priceTitle sm-four lg-two">Price</div>
                    </div>
                    <div class="updateTotalOverlayWrapper">
                        <div class="updateTotalOverlay" style="display:none;"></div>
                        <?php
                        foreach ($Order as $productArr) {
                            $product = $productArr["item"];
                            $prodQty = $productArr["qty"];
                            $SCPID = $product->getId();
                            $PID = $product->getPID();
                            $ProductName = $product->getName();
                            $ProdImgUrl = $product->getThumbnailUrl();
                            if ($ProdImgUrl == "") {
                                $ProdImgUrl = "/img/product/canvas_black_backpack.png";
                            }
                            $ProdPrice = number_format((float) $product->getVar("Price"), 0, '.', ',');
                            ?>
                            <div class="cartItemsRow">
                                <div class="cartItemItem sm-five lg-two"><img class="cartProductImage" src="<?php echo $ProdImgUrl; ?>" alt=""> <span class="productNameMobile"><?php echo $ProductName; ?></span><span class="produtNumber">SKU: <?php echo $PID; ?></span></div><!--
                                --><div class="cartItemQty sm-three lg-two"> <?php echo $prodQty; ?></div><!--
                                --><div class="cartItemProduct  sm-zero lg-six"> <span class="productName"><?php echo $ProductName; ?></span><!--<span class="shippingInfo">Shipping Included</span>--></div><!--
                                --><div class="cartItemPrice sm-four lg-two">$<?php echo $ProdPrice;?></div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row cartPriceRow">
                        <div class="subtotalSpacer sm-eight lg-ten">Sub Total&nbsp;&nbsp;&nbsp;</div><!--
                        --><div class="subtotalPrice sm-four lg-two">$<?php echo $Order->getTotalWithOutTax(); ?></div>
                    </div>
                    <?php
                    $TaxAmt = $Order->getVar("TaxAmt");
                    if (isset($TaxAmt) && $TaxAmt > 0) {
                        ?>
                        <div class="row cartPriceRow">
                            <div class="subtotalSpacer sm-eight lg-ten">Tax&nbsp;&nbsp;&nbsp;</div><!--
                            --><div class="subtotalPrice sm-four lg-two">$<?php echo number_format((float) $TaxAmt, 2, '.', ','); ?></div>
                        </div>
                    <?php } ?>
                    <div class="row cartPriceRow">
                        <div class="subtotalSpacer sm-eight lg-ten">&nbsp;</div><!--
                        --><div class="subtotalPrice sm-four lg-two">Shipping Included</div>
                    </div>
                    <div class="row totalRow">
                        <div class="subtotalSpacer sm-eight lg-ten">Total&nbsp;&nbsp;&nbsp;</div><!--
                        --><div class="subtotalPrice sm-four lg-two">$<?php echo $Order->getTotal(); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row marTop30">
            <div class="sm-twelve sm-twelve lg-nine">&nbsp;</div><!--
            --><div class="sm-twelve sm-twelve lg-three textRight">
            	<a class="fillBtn" href="javascript:printOrd('<?php echo $Order->getOrdID(); ?>');"><b>Print</b></a>
            </div>
        </div>
    </div>

<?php }
?>