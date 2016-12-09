function addrModal(AddrID, Type, UsrID, from)
{
    showModal('/user/incs/userAddressModal.php?AddrID=' + AddrID + '&Type=' + Type + '&UsrID=' + UsrID + "&from=" + from);
    //$('#addrModal').load('/user/incs/userAddressModal.php?AddrID=' + AddrID + '&Type=' + Type + '&UsrID=' + UsrID + "&from=" + from);
   // $('#addrModal').toggleClass('hide', false);
    //$('#modalOverlay').toggleClass('hide', false);
}

function changeCountryUsr(){
    $("#UsrAddrAjaxRes").load("/incs/state_input.php?Country="+$("#Country").val());
   
}

function addAddress(AddrID, from)
{

    if ($('#FName').val() == "") {
        alert("Please provide a first name.");
        $('#FName').focus();
        return;
    }

    if ($('#LName').val() == "") {
        alert("Please provide a last name.");
        $('#LName').focus();
        return;
    }

    if ($('#Addr1').val() == "") {
        alert("Please provide Address 1.");
        $('#Addr1').focus();
        return;
    }

    if ($('#City').val() == "") {
        alert("Please provide a city.");
        $('#City').focus();
        return;
    }

    if ($('#State').val() == "") {
        alert("Please provide state.");
        $('#State').focus();
        return;
    }

    if ($('#Postal').val() == "") {
        alert("Please provide zip code.");
        $('#Postal').focus();
        return;
    }else {
        if ($('#Country').val()=="US"){
            if (!isValidUSZip($('#Postal').val())){
                alert("Please provide a valid postal code.");
                $('#Postal').focus();
                return;
            }
        }
    }
    
    if ($('#Country').val() == "xx") {
        alert("Please select country.");
        $('#Country').focus();
        return;
    }
    if (from == "user" && $("#Type").val()=="Shp") {
        if ($('#Phone').val() != "") {
            if (!isInteger($('#Phone').val()))
            {
                alert("Please provide a valid phone number.");
                $('#Phone').focus();
                return;
            }
        }
    }
    FName = $('#AddrFrm input[id=FName]').val();
    LName = $('#AddrFrm input[id=LName]').val();
    Addr1 = $('#Addr1').val();
    Addr2 = $('#Addr2').val();
    City = $('#City').val();
    State = $('#State').val();
    Postal = $('#Postal').val();
    Country = $('#Country').val();
    Type = $('#Type').val();
    UsrID = $('#UsrID').val();
    if($("#Type").val()=="Shp") {
        Phone = $('#Phone').val();
    } else {
        Phone="";
    }

    if (!$('#isPrimary').prop('checked'))
    {
        isPrimary = 0;
    } else {
        isPrimary = $('#isPrimary').val();
    }

    selectedBefore = '';
    if (from == 'cart')
    {
        if (Type == 'Shp')
        {
            selectedBefore = getSelectedAddr('formSelectableRadioBil');
        }
        else if (Type == 'Bil')
        {
            selectedBefore = getSelectedAddr('formSelectableRadioShp');
        }
    }

    $.ajax({
        type: 'POST',
        url: '/addAddr_action.php?AddrID=' + AddrID,
        data: {FName: FName, LName: LName, Addr1: Addr1, Addr2: Addr2, City: City, State: State, Country: Country, Type: Type, Postal: Postal, Phone: Phone, isPrimary: isPrimary, UsrID: UsrID},
        error: function (xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success: function (result) {
            if (from == "user")
            {
                $('.modalOverlay').addClass('hide');
                $('#AddressDiv').load('/user/incs/userAddress.php?UsrID=' + UsrID);
                
            }
            else if (from == "cart")
            {
                //  alert(result);
                //$('#AddressDiv').load('/cart/incs/user_info.php?UsrID=' + UsrID, function () {
                if (Type == "Shp")
                {
                    if (AddrID == "") {
                        $('#usrInfoShipAddrs').load('/cart/incs/user_shp_addrs.php?callMethod=ajax&UsrID=' + UsrID, function () {
                            addAddrToSession(result, 'Shp');
                            shipAddrExist = true;
                        });
                    }
                    else {
                        $("#shipAddrDet_" + result).load("/cart/incs/addr_details.php?AddrID=" + result);
                        addAddrToSession(result, 'Shp');
                    }

                    //$('#formSelectableRadioShp_' + result).prop("checked", true);
                    //$('#formSelectableRadioBil_' + selectedBefore).prop("checked", true);
                    //addAddrToSession(result, 'Shp');
                    //shipAddrExist = true;
                    //addAddrToSession(selectedBefore, 'Bil');
                }
                else if (Type == "Bil")
                {
                    if (AddrID == "") {
                        $('#usrInfoBillAddrs').load('/cart/incs/user_bill_addrs.php?callMethod=ajax&UsrID=' + UsrID, function () {
                            addAddrToSession(result, 'Bil');
                            billAddrExist = true;
                        });
                    } else {
                        $("#billAddrDet_" + result).load("/cart/incs/addr_details.php?AddrID=" + result);
                        addAddrToSession(result, 'Bil');
                    }

                    //$('#formSelectableRadioBil_' + result).prop("checked", true);
                    //$('#formSelectableRadioShp_' + selectedBefore).prop("checked", true);

                    //billAddrExist = true;
                    //addAddrToSession(selectedBefore, 'Shp');
                }
                //  });
            }
            else if (from == "review") {
                if (Type == "Shp") {
                    addAddrToSessionReview(result, 'Shp');
                } else {
                    addAddrToSessionReview(result, 'Bil');
                }

            }
            $('#addrModal').toggleClass('hide', true);
            $('#modalOverlay').toggleClass('hide', true);
        }
    });
}

function deleteAddress(AddrID, UsrID, from)
{
    if (confirm("Are you sure you want to delete this address?"))
    {
        $.ajax({
            type: 'GET',
            url: '/user/delAddr_action.php?AddrID=' + AddrID + "&from=" + from,
            error: function (xhr, status, error) {
                alert(status);
                alert(xhr.responseText);
            },
            success: function (result) {
                if (from == "user")
                {
                    $('#AddressDiv').load('/user/incs/userAddress.php?UsrID=' + UsrID);
                    $('.modalOverlay').addClass('hide');
                    //window.location="/user/info.php";
                }
                else if (from == "cart")
                {

                    $('#AddressDiv').load('/cart/incs/user_info.php?UsrID=' + UsrID);
                }
            }
        });
    }
}

function getSelectedAddr(inputName) {
    var ids = "";
    var ckbxObjects = document.getElementsByTagName("input");
    for (var i = 0; i < ckbxObjects.length; i++) {
        if (ckbxObjects[i].type == "radio") {
            if (ckbxObjects[i].checked) {
                var ckName = ckbxObjects[i].id.split("_");
                if (ckName[0] == inputName) {
                    ids = ckName[1];
                }
            }
        }
    }
    return ids;
}

function addAddrToSession(AddrID, Type)
{
    ///if (Type=="Shp"){
    //var  addAddrURL = '/cart/addAddrToCart.php?AddrID=' + AddrID + '&Type=' + Type + "&Notes=" + $("#shipNotesField").val();
    //}//else {
    //var  addAddrURL = '/cart/addAddrToCart.php?AddrID=' + AddrID + '&Type=' + Type;
    //}
    var addAddrURL = '/cart/addAddrToCart.php?AddrID=' + AddrID + '&Type=' + Type;
    $.ajax({
        type: 'GET',
        url: addAddrURL,
        error: function (xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success: function (result) {
            //alert(result);
        }
    });
}

function removeAddrFromSession(Type)
{
    $.ajax({
        type: 'GET',
        url: '/cart/removeAddrFromCart.php?Type=' + Type,
        error: function (xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success: function (result) {
            //alert(result);
        }
    });
}

function addAddrToSessionReview(AddrID, Type)
{

    $.ajax({
        type: 'GET',
        url: '/cart/addAddrToCart.php?AddrID=' + AddrID + '&Type=' + Type,
        error: function (xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success: function (result) {
            window.location = "review.php";
            //alert(result);
        }
    });
}