

function addrValidation(){
    var errorExist=false;
    $(".formError").removeClass("formError");
    if ($('#FName').val() == "") {
        $('#FName').addClass("formError");
        $('#FName').focus();
        errorExist=true;
        
    }
    if ($('#LName').val() == "") {
        $('#LName').addClass("formError");
        $('#LName').focus();
        errorExist=true;
    }
    if ($('#Addr1').val() == "") {
        $('#Addr1').addClass("formError");
        $('#Addr1').focus();
        errorExist=true;
    }
    if ($('#City').val() == "") {
        $('#City').addClass("formError");
        $('#City').focus();
        errorExist=true;
    }
    if ($('#State').val() == "") {
        $('#State').addClass("formError");
        $('#State').focus();
        errorExist=true;
    }
    if ($('#Postal').val() == "") {
        $('#Postal').addClass("formError");
        $('#Postal').focus();
        errorExist=true;
    }
    if ($('#Country').val() == "") {
        $('#Country').addClass("formError");
        $('#Country').focus();
        errorExist=true;
    }
    if (errorExist){
        $(".formValidateMessage").show();
    }
    else {
        $("#cartship").submit();
    }
}


