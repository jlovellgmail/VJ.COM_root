<?php
if (!$cartExist) {
    echo "<div class='cartItemsRow'><div class='emptyCartLine lg-twelve' style='text-align: center;'>Your cart is empty.</div></div>";
} else {
    $totalCount = $Cart->count();
    ?><!--
    --><div class="cartTableWrapper">
        <div class="titleRow">
            <div class="itemTitle sm-five lg-two textCenter">Item</div><!--
            --><div class="qtyTitle sm-three lg-three">Quantity</div><!--
            --><div class="productTitle sm-zero lg-five">Product</div><!--
            --><div class="priceTitle sm-four lg-two">Price</div>
        </div>
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
            <div class="updateTotalOverlayWrapper">
                <div class="updateTotalOverlay" style="display:none;"></div>
                <div class="cartItemsRow">
                    <div class="cartItemItem sm-five lg-two">
                        <img class="cartProductImage" src="<?php echo $ProdImgUrl; ?>" alt="">
                        <span class="productNameMobile"><?php echo $ProductName; ?></span>
                        <span class="produtNumber">VJ - <?php echo $PID; ?></span>
                    </div><!--
                    --><div class="cartItemQty sm-three lg-three">
                        <input class="qtyInput" type="number" name="itemQty_<?php echo $PID; ?>_<?php echo $SCPID; ?>" id="itemQty_<?php echo $PID; ?>_<?php echo $SCPID; ?>" value="<?php echo $prodQty; ?>">
                        <a href="javascript:removeProduct(<?php echo $PID; ?>,'<?php echo $SCPID; ?>')" onclick="return false;" class="removeLinkMobile fw-300"><em>remove</em></a>
                    </div><!--
                    --><div class="cartItemProduct  sm-zero lg-five">
                        <span class="productName"><?php echo $ProductName; ?></span>
                        <!-- <span class="shippingInfo">Shipping Included</span> -->
                        <a href="javascript:removeProduct(<?php echo $PID; ?>,'<?php echo $SCPID; ?>')" class="removeLink fw-300"><em>remove</em></a>
                    </div><!--
                    --><div class="cartItemPrice sm-four lg-two">$<?php echo $ProdPrice; ?></div>
                </div>
            </div>
        <?php } ?>

        <div class="totalRow">
            <div class="subtotalSpacer sm-eight lg-ten">Total&nbsp;&nbsp;&nbsp;</div><!--
            --><div class="subtotalPrice sm-four lg-two">$<?php echo $Cart->getTotalWithOutTax(); ?></div>
        </div>
    </div>   
<?php } ?>