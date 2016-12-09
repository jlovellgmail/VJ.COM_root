<div class="checkoutFormFieldsWrapper sm-twelve">                                

    <h2 class="caps black">Payment Method</h2>
    <br />
    <div class="row cartBorderBottom marBottom30">
        <div class="radialWrapper sm-five lg-three">
            <input id="ccPaymentSelect" class="radial" type="radio" name="group1" value="cc" <?php
            if ($paymMeth == "cc") {
                echo " checked";
            }
            ?> />&nbsp;
            <img class="ccImg" src="/img/cart/amex-min.png" alt="American Express" />
            <img class="ccImg" src="/img/cart/mastercard-min.png" alt="MaterCard" />
            <img class="ccImg" src="/img/cart/visa-min.png" alt="Visa" />
        </div><div class="sm-one"></div><!-- 
        --><div class="radialWrapper sm-five lg-three">
            <input id="paypalPaymentSelect" class="radial" type="radio" name="group1" value="paypal" <?php
            if ($paymMeth == "paypal") {
                echo " checked";
            }
            ?> />&nbsp;
            <img class="ccImg" src="/img/cart/paypal-min.png" alt="Paypal" />
        </div>
    </div>
    <div class="paypalMessage" <?php
    if ($paymMeth != "paypal") {
        echo "style='display:none;'";
    }
    ?> >
        <div class="well">You will be redirected to PayPal on the next page.</div>
        <div class="row marTop30">
            <div class="sm-twelve">
                <!--<a class="caps black underline" href="#"><b>Back To Summary</b></a>-->
            </div><!--
            --><div class="sm-twelve textRight">
                <a class="fillBtn" id="continueButton" href="#"><b>Continue</b></a>
            </div>
        </div>
    </div>

    <div style="display:none;" id="ccBillInfo">

        <?php
        if ($showSaved) {
            include 'incs/AddressBook.php';
        } else {
            include 'incs/AddressForm.php';
        }
        ?>

        <?php
        if ($cartExist && $paymMeth == "cc") {
            $CCObj = $Cart->getCreditCard();
            if (isset($CCObj)) {
                $CCName = $CCObj->getVar("CCName");
                $CCNo = $CCObj->getVar("CCNumber");
            }
        }
        ?>
        <div class="row toggleDivGroupItem toggleDivGroupDefault">
            <div class="sm-twelve"><!--
        <div class="formValidateMessage error">Your card was declined. Please try again.</div>   
        <div class="formValidateMessage error">Your card has expired. Please try again.</div>   
        <div class="formValidateMessage error">Your security code is invalid. Please try again.</div> -->
                <?php
                if (isset($_SESSION["CCError"]) && $_SESSION["CCError"] != "") {
                    echo "<div class='formValidateMessage error'>" . $_SESSION["CCError"] . "</div>";
                    unset($_SESSION["CCError"]);
                }
                ?>
                <form class="checkoutForm generalForm generalFormBlock" action="" method="post" id="cartcc" name="cartcc">     
                    <div class="row">
                        <div class="sm-twelve lg-six leftCol">
                            <label for="cardName">Cardholder Name</label>
                            <input id="CCName" type="text" name="CCName" value="<?php echo $CCName; ?>">
                        </div><!--
                        --><div class="sm-twelve lg-six rightCol">
                            <div id="ccCardType" class="">
                                <label for="ccNumber">Credit Card Number</label>
                                <input id="CCNumber" type="text" name="CCNumber" value="<?php echo $CCNo; ?>">
                                <input id="CCType" name="CCType" type="hidden" value="" />
                            </div>
                        </div>
                    </div>    
                    <div class="row cartBorderBottom marTop15 marBottom30">
                        <div class="sm-twelve lg-six leftCol">
                            <label for="ccXMonth">Exp. Month</label>
                            <select id="CCXMonth" name="CCXMonth">
                                <option value="">Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select></div><!--
                        --><div class="sm-twelve lg-three centerCol"><label>Exp. Year</label>
                            <select name="CCXYear" id="CCXYear">
                                <option value="xx">Year</option>
                                <?php for ($i = date("Y"); $i <= date("Y") + 10; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select></div><!--
                        --><div class="sm-twelve lg-three rightCol">
                            <label for="ccCode">Security Code</label>
                            <input id="CCCode" type="text" name="CCCode">
                        </div>
                    </div>
                    <div class="row">
                        <div class="sm-twelve lg-six">
                            <!--<a class="caps black underline" href="/cart/"><b>Back To Summary</b></a>-->
                        </div><!--
                        --><div class="sm-twelve lg-six textRight">
                            <a class="fillBtn" id="continueAddrBtn" href="addAddr_Action.php?AddrID=<?php echo $AddrID; ?>&AddrType=<?php echo $AddrFrmType; ?>"><b>Continue</b></a>
                        </div>
                    </div>
                </form>
                <script>
                    //Function to validate the credit card
                    $(function () {
                        $('#ccCardType input').validateCreditCard(function (result) {
                            var getCardType = (result.card_type == null ? '-' : result.card_type.name);
                            $("#ccCardType").removeAttr("class");
                            $('#ccCardType').addClass(getCardType);
                            $("#CCType").val(getCardType);
                            if (result.valid) {
                                ccValid = true;
                                return $("#ccCardType label").addClass('valid');
                            } else {
                                ccValid = false;
                                return $("#ccCardType label").removeClass('valid');
                            }
                        }, {accept: ['visa', 'mastercard', 'amex']});
                    });
                </script></div>
        </div>	

    </div>

</div>