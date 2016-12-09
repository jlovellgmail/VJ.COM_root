<?php
if (!$cartExist) {
    echo "<div class='cartItemsRow'><div class='emptyCartLine lg-twelve' style='text-align: center;'>Your cart is empty.</div></div>";
} else {
    $totalCount = $Cart->count();
    ?><!--
    --><div class="cartSidebar">
        <h2 class="caps">Order Details</h2>
        <?php
        foreach ($Cart as $productArr) {
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
            <div class="row cartSidebarRow">
                <div class="lg-three v-mid textCenter">
                    <div class="flexImage">
                        <div><img src="<?php echo $ProdImgUrl; ?>" alt="" width="90"></div>
                    </div>
                </div><div class="lg-one">&nbsp;</div><!--
                --><div class="lg-eight v-mid textRight">
                    <span class="block marBottom5 fw-600"><?php echo $ProductName; ?></span>
                    <?php if ($prodQty > 1) { ?>
                    <span class="block marBottom5">Quantity (<?php echo $prodQty; ?>)</span>
                    <?php } ?>
                    <span class="block">$<?php echo $ProdPrice; ?> </span>
                </div>
            </div>
        <?php } ?>        
        <div class="cartSubTotalRow">                   
            <?php
            $CartTotal = $Cart->getTotalWithOutTax();
            if ($page == 'cartSummary' || $page == "cartBilling") {
                $TaxAmt = $Cart->getTaxAmt();
                $TaxFlag = $Cart->getTaxFlag();
                if (isset($TaxFlag) && $TaxFlag && isset($TaxAmt) && $TaxAmt > 0) {
                    $CartTotal = $Cart->getTotal();
                    ?>
                    <div class="row marBottom15">
                        <div class="sm-tweleve lg-five v-bottom caps">
                            Subtotal
                        </div><div class="lg-one">&nbsp;</div><!--
                        --><div class="sm-tweleve lg-six v-bottom textRight">
                            $<?php echo $Cart->getTotalWithOutTax(); ?>                         
                        </div>
                    </div>     
                    <div class="row marBottom15">
                        <div class="lg-five v-bottom caps">
                            Sales Tax
                        </div><div class="lg-one">&nbsp;</div><!--
                        --><div class="lg-six v-bottom textRight">
                            $<?php echo number_format((float) $Cart->getTaxAmt(), 2, '.', ','); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($page == 'cartSummary') { ?>
                    <div class="row marBottom15">
                        <div class="sm-tweleve lg-five v-bottom caps">
                            &nbsp;
                        </div><div class="lg-one">&nbsp;</div><!--
                        --><div class="sm-tweleve lg-six v-bottom textRight">
                            <em>Shipping Included</em>                            
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>                 
            <div class="row finalTotalRow">
                <div class="sm-tweleve lg-five v-bottom caps">
                    <b>Total</b>
                </div><div class="lg-one">&nbsp;</div><!--
                --><div class="sm-tweleve lg-six v-bottom textRight">
                    <b>$<?php echo $CartTotal; ?></b>                            
                </div>
            </div>                        
        </div>
    </div>
<?php } ?> 