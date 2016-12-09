<?php
if (!$orderExist) {
    echo "Invalid Order";
    exit();
} else {
    $Email = $Order->getVar("Email");
    $ShipAddr = $Order->getVar("ShippingAddr");
    $Email = $Order->getVar("Email");
    $ShipAddr = $Order->getVar("ShippingAddr");
    $PaymMethod = $Order->getVar("PaymMethod");
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
            $CCNum = "**********" . substr($CCNo, -4);
        }
    }
}
?>
<div id="page-wrap">
    <table>
        <tr class="v-top no-bord">
            <td class="logo"><img src="/img/vj_logo_black.png" alt="" width="180" /></td>
            <td class="right">Order #<?php echo $Order->getOrdID(); ?><br />
                <?php echo $Order->getDate(); ?> </td>
        </tr>
    </table>
    <table class="customer-info">
        <tbody>
            <tr>
                <td class="v-mid"><table>
                        <thead>
                            <tr>
                                <th class="left">Ships to:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $SName; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $SAddr1; ?></td>
                            </tr>
                            <?php if (isset($SAddr2) && $SAddr2 != "") { ?>
                                <tr>
                                    <td><?php echo $SAddr2; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td><?php echo $SCityStateZip; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $SCoutry; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $Phone; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $Email; ?></td>
                            </tr>
                        </tbody>
                    </table></td>
                <td class="v-mid"><table>
                        <thead>
                            <tr>
                                <th class="left">Billed to:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (ltrim(rtrim($PaymMethod)) == "cc") { ?>
                                <tr>
                                    <td><?php echo $BName; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $BAddr1; ?></td>
                                </tr>
                                <?php if (isset($$BAddr2) && $$BAddr2 != "") { ?>
                                    <tr>
                                        <td><?php echo $BAddr2; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td><?php echo $BCityStateZip; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $BCoutry; ?></td>
                                </tr>
                                <tr>
                                    <td>Visa ending in <?php echo $CCNum; ?></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td><?php echo $_SESSION["paypal_usrName"]; ?></td>
                                </tr>
                                <tr>
                                    <td>PayPal Email : <?php echo $_SESSION["paypal_email"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Additional info on file with Paypal.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table></td>
            </tr>
        </tbody>
    </table>
    <?php if (isset($ShipNotes) && $ShipNotes != "") { ?>
        <table class="italic">
            <tr>
                <td class="no-bord"><p class="bold">Shipping Notes:</td>
            </tr>
            <tr>
                <td class="no-bord"><?php echo $ShipNotes; ?></td>
            </tr>
        </table>
    <?php } ?>
    <br />
    <table id="items">
        <thead>
            <tr>
                <th class="left">Item</th>
                <th>Quantity</th>
                <th class="right">Price</th>
            </tr>
        </thead>
        <tbody>
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


                <tr class="item-row">
                    <td class="item-name"><table class="inner">
                            <tbody>
                                <tr>
                                    <td class="item-name-info"><?php echo $ProductName; ?></td>
                                </tr>
                            </tbody>
                        </table></td>
                    <td class="center"><?php echo $prodQty; ?></td>
                    <td class="price right">$<?php echo $ProdPrice; ?></td>
                </tr>
            <?php } ?>    
            <tr class="total-rows pad-t-15">
                <td colspan="1" ></td>
                <td colspan="1" class="right">Subtotal</td>
                <td class="total right">$<?php echo $Order->getTotalWithOutTax(); ?></td>
            </tr>
            <?php
            $TaxAmt = $Order->getVar("TaxAmt");
            if (isset($TaxAmt) && $TaxAmt > 0) {
                ?>
                <tr class="total-rows">
                    <td colspan="1" ></td>
                    <td colspan="1" class="right">Tax</td>
                    <td class="total right">$<?php echo number_format((float) $TaxAmt, 2, '.', ','); ?></td>
                </tr>
            <?php } ?>
            <tr class="total-rows bold">
                <td colspan="1" ></td>
                <td colspan="1" class="right">Total</td>
                <td class="total right">$<?php echo $Order->getTotal(); ?></td>
            </tr>
        </tbody>
    </table>
</div>
