<?php
//print_r($currentBillAddr);
//exit();
if ($AddrFrmType == "Shp") {
    $addrTitle = "shipping";
} else if ($AddrFrmType == "Bil") {
    $addrTitle = "billing";
}
if ($usrMode == "existing" && $AddrFrmType == "Shp" && isset($currentShipAddr)) {
    $AddrID = $currentShipAddr->getVar("AddrID");

    //echo "Savvas";

    $FName = $currentShipAddr->getVar("FName");
    $LName = $currentShipAddr->getVar("LName");
    $Addr1 = $currentShipAddr->getVar("Addr1");
    $Addr2 = $currentShipAddr->getVar("Addr2");
    $City = $currentShipAddr->getVar("City");
    $State = $currentShipAddr->getVar("State");
    $Postal = $currentShipAddr->getVar("Postal");
    $Phone = $currentShipAddr->getVar("Phone");
    $CountryCode = $currentShipAddr->getVar("Country");
    $Country = $Countries->getCountryName($currentShipAddr->getVar("Country"));
    $SaveAddrFlag = $currentShipAddr->getSaveAddrFlag();
} else if ($usrMode == "existing" && $AddrFrmType == "Bil" && isset($currentBillAddr)) {
    $FName = $currentBillAddr->getVar("FName");
    $LName = $currentBillAddr->getVar("LName");
    $Addr1 = $currentBillAddr->getVar("Addr1");
    $Addr2 = $currentBillAddr->getVar("Addr2");
    $City = $currentBillAddr->getVar("City");
    $State = $currentBillAddr->getVar("State");
    $Postal = $currentBillAddr->getVar("Postal");
    $Phone = $currentBillAddr->getVar("Phone");
    $CountryCode = $currentBillAddr->getVar("Country");
    $Country = $Countries->getCountryName($currentBillAddr->getVar("Country"));
    $SaveAddrFlag = $currentBillAddr->getSaveAddrFlag();
} else {
    $primaryAddr = $AddressList[0];
    if ($AddrFrmType == "Bil") {
        $Cart->addBillAddr($primaryAddr);
        $_SESSION["Cart"] = $Cart;
    }
    $AddrID = $primaryAddr->getVar("AddrID");
    $FName = $primaryAddr->getVar("FName");
    $LName = $primaryAddr->getVar("LName");
    $Addr1 = $primaryAddr->getVar("Addr1");
    $Addr2 = $primaryAddr->getVar("Addr2");
    $City = $primaryAddr->getVar("City");
    $State = $primaryAddr->getVar("State");
    $Postal = $primaryAddr->getVar("Postal");
    $Phone = $primaryAddr->getVar("Phone");
    $CountryCode = $primaryAddr->getVar("Country");
    $Country = $Countries->getCountryName($primaryAddr->getVar("Country"));
}
?>
<div class="toggleDivGroup">
    <div class="toggleDivGroupItem toggleDivGroupDefault">                                
        <div class="row v-btm marBottom30">
            <div class="sm-twelve lg-nine v-btm">
                <h2 class="black caps"><?php echo ucfirst($addrTitle); ?> Info</h2>
            </div><div class="sm-twelve lg-three textRight v-btm">
                <a href="#" class="caps underline toggleDivGroupButton" data-id="addressEdit"><b>edit</b></a>
            </div>
        </div>                        
        <div class="clearfix">
            <!--<input class="fltL" type="radio" checked>-->                                
            <div class="">
                <?php echo $FName . " " . $LName; ?><br>
                <?php echo $Addr1 ?><br>
                <?php
                if (isset($Addr2) && $Addr2 != "") {
                    echo $Addr2;
                }
                ?>
                <?php echo $City . ", " . $State . " " . $Postal ?><br>
                <?php echo $Country; ?>
                <?php
                if (isset($Phone) && $Phone != "") {
                    echo "<br>" . $Phone;
                }
                ?>
                <br><br>
                <?php if ($AddrID > 0) { ?>
                    <!--<p class="contrastGrey">Currently set as your default <?php // echo $addrTitle;  ?> address.</p>-->
                <?php } ?>
            </div>    
        </div>
        <div class="clearfix buttonGroup cartBorderBottom marTop15 marBottom30">
            <!--<button class="fillBtn grayBtn toggleDivGroupButton" data-id="addressEdit">Edit Address</button>-->
            <button class="fillBtn grayBtn toggleDivGroupButton" data-id="addressChange">Select Another Address</button>
            <button class="fillBtn grayBtn toggleDivGroupButton" data-id="addressNew">Add New Address</button>
        </div>
        <?php if ($AddrFrmType != "Bil") { ?>
            <div class="row">
                <div class="sm-twelve lg-six">
                    <!--<a class="caps black" href="/cart/"><b>< Back To Summary</b></a>-->
                </div><!--
                --><div class="sm-twelve lg-six textRight">
                    <a class="fillBtn" id="continueAddrBtn" href="addAddr_Action.php?AddrID=<?php echo $AddrID; ?>&AddrType=<?php echo $AddrFrmType; ?>"><b>Continue</b></a>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="toggleDivGroupItem clearfix" id="addressEdit">
        <div class="row v-btm marBottom30">
            <div class="sm-twelve lg-nine v-btm">
                <h2 class="black caps">Edit <?php echo ucfirst($addrTitle); ?> Address Info</h2>
            </div><div class="sm-twelve lg-three textRight v-btm">
                <a href="#" class="caps underline toggleDivGroupItemClose">Cancel</a>
            </div>
        </div>                                        
        <form class="checkoutForm generalForm generalFormBlock" action="addAddr_Action.php?AddrID=<?php echo $AddrID; ?>&action=update" method="post" id="cartEditaddr" name="cartEditaddr">
            <input type="hidden" name="addrType" id="addrType" value="<?php echo $AddrFrmType; ?>" />
            <input type="hidden" name="post_redirection" id="post_redirection" value="billing.php" />
            <div class="row" id="shipAddrFormDet"> 
                <div class="sm-twelve lg-six leftCol">
                    <label for="fNameField">First Name</label>
                    <input id="fNameField" type="text" name="FName" value="<?php echo $FName; ?>">
                </div><!--
                --><div class="sm-twelve lg-six rightCol">
                    <label for="lNameField">Last Name</label>
                    <input id="lNameField" type="text" name="LName" value="<?php echo $LName; ?>">
                </div><!--
                --><div class="sm-twelve lg-six leftCol">
                    <label for="address1Field">Address Line 1</label>
                    <input id="address1Field" type="text" name="Addr1" value="<?php echo $Addr1; ?>">
                </div><!-- 
                --><div class="sm-twelve lg-six rightCol">
                    <label for="address2Field">Address Line 2</label>
                    <input id="address2Field" type="text" name="Addr2" value="<?php echo $Addr2; ?>">
                </div><!--
                --><div class="sm-twelve lg-six leftCol">
                    <label for="cityField">City</label>
                    <input id="cityField" type="text" name="City" value="<?php echo $City; ?>">
                </div><!-- 
                --><div class="sm-twelve lg-four centerCol">
                    <label for="stateField">State / Province</label>
                    <div id="SStateAJAXRes"><?php include 'state_input.php'; ?></div>
                </div><!--
                <!--
                --><div class="sm-twelve lg-two rightCol">
                    <label for="postalCodeField">Postal Code</label>
                    <input id="postalCodeField" type="text" name="Postal" value="<?php echo $Postal; ?>">
                </div><!-- 
                --><div class="sm-twelve lg-six leftCol">
                    <label for="countrySelect">Country</label>
                    <select id="countrySelect" name="Country" onChange="changeCountry('<?php echo $AddrFrmType; ?>')">
                        <?php echo $Countries->getCountriesDropDown($CountryCode); ?>
                    </select>
                </div><!--
                --><div class="sm-twelve lg-six rightCol">
                    <label for="telField">Telephone</label>
                    <input id="telField" type="text" name="Phone" value="<?php echo $Phone; ?>">
                </div>
            </div>
            <?php if ($AddrID == "") { ?>
                <div class="row cartBorderBottom marBottom30">
                    <label><input type="checkbox" id="saveNewAddress" name="saveNewAddress" <?php if ($SaveAddrFlag) {
                echo "checked=''";
            } ?>>
                        &nbsp; Save this <?php echo $addrTitle; ?> address for future orders</label>
                </div>
<?php } ?>
            <div class="row">
                <div class="sm-twelve lg-six">
                    <!--<a class="caps black" href="/cart/"><b>< Back To Summary</b></a>-->
                </div><!--
                --><div class="sm-twelve lg-six textRight">
                    <a class="fillBtn" href="javascript:updAddr();"><b>Save</b></a>
                </div>
            </div>                                
        </form>                                    
    </div>
    <div class="toggleDivGroupItem" id="addressChange">
        <div class="row v-btm marBottom30">
            <div class="sm-twelve lg-nine v-btm">
                <h2 class="black caps">Select <?php echo ucfirst($addrTitle); ?> Address</h2>
            </div><div class="sm-twelve lg-three textRight v-btm">
                <a href="#" class="caps underline toggleDivGroupItemClose">Cancel</a>
            </div>
        </div>                                        
        <div class="clearfix marBottom30 gridLined twoBy">
            <div class="row"><!--
                --><?php
                $count = 0;
                foreach ($AddressList as $Addr) {
                    $AddrID = $Addr->getVar("AddrID");
                    $FName = $Addr->getVar("FName");
                    $LName = $Addr->getVar("LName");
                    $Addr1 = $Addr->getVar("Addr1");
                    $Addr2 = $Addr->getVar("Addr2");
                    $City = $Addr->getVar("City");
                    $State = $Addr->getVar("State");
                    $Postal = $Addr->getVar("Postal");
                    $Phone = $Addr->getVar("Phone");
                    $Country = $Countries->getCountryName($Addr->getVar("Country"));
                    //echo $count % 2;
                    ?><!--
                    --><div class="sm-twelve lg-six <?php
                    if ($count % 2 == 0) {
                        echo "leftCol";
                    } else {
                        echo "rightCol";
                    }
                    ?>">
                        <label>
                            <input class="fltL" type="radio" name="chooseAnotherAddress" id="chkBx_<?php echo $AddrID ?>" value="<?php echo $AddrID ?>" <?php if ( $count == 0) {?>checked="" <?php } ?>>                               
                            <div class="fltL marginX10">
                                <?php echo $FName . " " . $LName; ?><br>
                                <?php echo $Addr1 ?><br>
                                <?php
                                if (isset($Addr2) && $Addr2 != "") {
                                    echo $Addr2;
                                }
                                ?>
                                <?php echo $City . ", " . $State . " " . $Postal ?><br>
                                <?php echo $Country; ?>
                                <?php
                                if (isset($Phone) && $Phone != "") {
                                    echo "<br>" . $Phone;
                                }
                                ?>
                                <?php if ($count == 0) { ?>     
                                        <!--<p class="contrastGrey marTop6">Currently set as your default address.</p>-->
    <?php }
    ?>
                            </div>
                        </label>    
                    </div><?php
                    $count++;
                }
                ?><!--
    
                --></div><!--                      
            --></div>                                    
        <div class="row marTop30">
            <div class="sm-twelve lg-six">
                <button class="fillBtn grayBtn toggleDivGroupButton" data-id="addressNew">Add New <!--<?php // echo ucfirst($addrTitle); ?>--> Address</button>
            </div><!--
            --><div class="sm-twelve lg-six textRight">
                <a class="fillBtn" href="javascript:useSelectedAddr();"><!--Use this <?php // echo ucfirst($addrTitle); ?> Address--> Continue</a>
            </div>
        </div>    
    </div>
    <div class="toggleDivGroupItem clearfix" id="addressNew">
        <div class="row v-btm marBottom30">
            <div class="sm-twelve lg-nine v-btm">
                <h2 class="black caps">Add New <?php echo ucfirst($addrTitle); ?> Address</h2>
            </div><div class="sm-twelve lg-three textRight v-btm">
                <a href="#" class="caps underline toggleDivGroupItemClose">Cancel</a>
            </div>
        </div>                                        
        <form class="checkoutForm generalForm generalFormBlock" action="addAddr_action.php" method="post" id="cartaddr" name="cartaddr">
            <input type="hidden" name="addrType" id="addrType" value="<?php echo $AddrFrmType; ?>" />
            <input type="hidden" name="post_redirection" id="post_redirection" value="billing.php" />
            <div class="row" id="shipAddrFormDet"> 
                <div class="sm-twelve lg-six leftCol">
                    <label for="fNameField">First Name</label>
                    <input id="fNameField" type="text" name="FName" value="">
                </div><!--
                --><div class="sm-twelve lg-six rightCol">
                    <label for="lNameField">Last Name</label>
                    <input id="lNameField" type="text" name="LName" value="">
                </div><!--
                --><div class="sm-twelve lg-six leftCol">
                    <label for="address1Field">Address Line 1</label>
                    <input id="address1Field" type="text" name="Addr1" value="">
                </div><!-- 
                --><div class="sm-twelve lg-six rightCol">
                    <label for="address2Field">Address Line 2</label>
                    <input id="address2Field" type="text" name="Addr2" value="">
                </div><!--
                --><div class="sm-twelve lg-six leftCol">
                    <label for="cityField">City</label>
                    <input id="cityField" type="text" name="City" value="">
                </div><!-- 
                --><div class="sm-twelve lg-four centerCol">
                    <label for="stateField">State / Province</label>
                    <div id="SStateAJAXResOnNew"><?php
                        $State = "";
                        $Country = "US";
                        include 'state_input.php';
                        ?></div>
                </div><!--
             
                --><div class="sm-twelve lg-two rightCol">
                    <label for="postalCodeField">Postal Code</label>
                    <input id="postalCodeField" type="text" name="Postal" value="">
                </div><!-- 
                --><div class="sm-twelve lg-six leftCol">
                    <label for="countrySelect">Country</label>
                    <select id="countrySelectOnNew" name="Country" onChange="changeCountryOnNew('<?php echo $AddrFrmType; ?>')">
<?php echo $Countries->getCountriesDropDown($Country); ?> 
                    </select>
                </div><!--
                --><div class="sm-twelve lg-six rightCol">
                    <label for="telField">Telephone</label>
                    <input id="telField" type="text" name="Phone" value="">
                </div><!--
                --></div>
            <div class="row cartBorderBottom marBottom30">
                <label><input type="checkbox" id="saveNewAddress" name="saveNewAddress">
                    &nbsp; Save this <?php echo $addrTitle; ?> address for future orders</label>
            </div>
            <div class="row">
                <div class="sm-twelve lg-six">
                    <!--<a class="caps black" href="/cart/"><b>< Back To Summary</b></a>-->
                </div><!--
                --><div class="sm-twelve lg-six textRight">
                    <a class="fillBtn" href="javascript:addAddr()"><b>Save</b></a>
                </div>
            </div>                                
        </form>
    </div>
</div>