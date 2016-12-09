<?php 
if (!isset($Countries)) {
    $Countries = new Countries();
}
$Country = "US";

if ($AddrFrmType=="Shp"){
    $addrTitle="shipping";   
}
else if ($AddrFrmType=="Bil") {
    $addrTitle="billing";
}
if ($AddrFrmType=="Shp" && isset($currentShipAddr)){
    $FName = $currentShipAddr->getVar("FName");
    $LName = $currentShipAddr->getVar("LName");
    $Addr1 = $currentShipAddr->getVar("Addr1");
    $Addr2 = $currentShipAddr->getVar("Addr2");
    $City = $currentShipAddr->getVar("City");
    $State = $currentShipAddr->getVar("State");
    $Postal = $currentShipAddr->getVar("Postal");
    $Phone = $currentShipAddr->getVar("Phone");
    $Country = $currentShipAddr->getVar("Country");
    $SaveAddrFlag = $currentShipAddr->getSaveAddrFlag();
} else if($AddrFrmType=="Bil" && isset($currentBillAddr)){
    $FName = $currentBillAddr->getVar("FName");
    $LName = $currentBillAddr->getVar("LName");
    $Addr1 = $currentBillAddr->getVar("Addr1");
    $Addr2 = $currentBillAddr->getVar("Addr2");
    $City = $currentBillAddr->getVar("City");
    $State = $currentBillAddr->getVar("State");
    $Postal = $currentBillAddr->getVar("Postal");
    $Phone = $currentBillAddr->getVar("Phone");
    $Country = $currentBillAddr->getVar("Country");
    $SaveAddrFlag = $currentBillAddr->getSaveAddrFlag();
}else {
    $FName = "";
    $LName ="";
    $Addr1 = "";
    $Addr2 = "";
    $City = "";
    $State = "";
    $Postal = "";
    $Phone = "";
    $CountryCode = "US";
    $SaveAddrFlag = FALSE;
}
$CountryCode=$Country;
?>


<div class="row">
	<div class="sm-twelve md-eight">
        <h2 class="black caps marBottom30"><?php echo ucfirst($addrTitle); ?> Info</h2>
    </div><!--
	--><?php if (isset($AddrFrmType) && $AddrFrmType=="Bil") { ?><div class="sm-twelve md-four marBottom15 textRight">
    <label class="f-14px"><input type="checkbox" id="sameAddressAsShipping" name="sameAddressAsShipping" />
        &nbsp; Use Shipping Address
    </label>
    </div><?php 
        $ShipAddrSelect = $Cart->getShipAddr();
        echo "<input type='hidden' name='fNameShipField' id='fNameShipField' value='".$ShipAddrSelect->getVar("FName")."'>";
        echo "<input type='hidden' name='lNameShipField' id='lNameShipField' value='".$ShipAddrSelect->getVar("LName")."'>";
        echo "<input type='hidden' name='address1ShipField' id='address1ShipField' value='".$ShipAddrSelect->getVar("Addr1")."'>";
        echo "<input type='hidden' name='address2ShipField' id='address2ShipField' value='".$ShipAddrSelect->getVar("Addr2")."'>";
        echo "<input type='hidden' name='cityShipField' id='cityShipField' value='".$ShipAddrSelect->getVar("City")."'>";
        echo "<input type='hidden' name='stateShipField' id='stateShipField' value='".$ShipAddrSelect->getVar("State")."'>";
        echo "<input type='hidden' name='postalCodeShipField' id='postalCodeShipField' value='".$ShipAddrSelect->getVar("Postal")."'>";
        echo "<input type='hidden' name='countryShipSelect' id='countryShipSelect' value='".$ShipAddrSelect->getVar("Country")."'>";
        echo "<input type='hidden' name='phoneShipSelect' id='phoneShipSelect' value='".$ShipAddrSelect->getVar("Phone")."'>";
        } ?>
</div>
<form class="checkoutForm generalForm generalFormBlock" action="addAddr_action.php" method="post" id="cartaddr" name="cartaddr">
    <input type="hidden" name="addrType" id="addrType" value="<?php echo $AddrFrmType; ?>" />
    <input type="hidden" name="post_redirection" id="post_redirection" value="summary.php" />
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
        --><div class="sm-twelve lg-two rightCol">
            <label for="postalCodeField">Postal Code</label>
            <input id="postalCodeField" type="text" name="Postal" value="<?php echo $Postal ?>">
        </div><!-- 
        --><div class="sm-twelve lg-six leftCol">
            <label for="countrySelect">Country</label>
            <select id="countrySelect" name="Country" onChange="changeCountry('Shp')">
                <?php echo $Countries->getCountriesDropDown($Country); ?> 
            </select>
        </div><!--
    --><div class="sm-twelve lg-six rightCol">
            <label for="telField">Telephone</label>
            <input id="telField" type="text" name="Phone" value="<?php echo $Phone; ?>">
        </div>
    </div>
    <?php if ($usrMode!="guest") { ?>
    <div class="row cartItemsRow marBottom30">
        <label><input type="checkbox" id="saveNewAddress" name="saveNewAddress" <?php if ($SaveAddrFlag){echo "checked=''";} ?>>
        &nbsp; Save this <?php echo $addrTitle; ?> address for future orders</label>
    </div>
    <?php }?>
    <?php if($AddrFrmType != "Bil"){ ?>
    <div class="row">
        <div class="sm-twelve lg-six"><!-- <a class="caps black underline" href="/cart/"><b>Back To Summary</b></a> --></div><!--
        --><div class="sm-twelve lg-six textRight"><a class="fillBtn" href="javascript:addAddr();"><b>Continue</b></a> </div>
    </div>
    <?php } ?>
</form>