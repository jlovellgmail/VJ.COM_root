// JavaScript Document
function validateLoginForm() {

    if ($('#email').val() == "") {
        alert("Please provide an email address.");
        $('#email').focus();
        return false;
    }
    else if (!validateEmail($('#email').val())) {
        alert("Please provide a valid email address.");
        $('#email').focus();
        return false;
    }
    else if ($('#passwd').val() == "") {
        alert("Please provide a valid password");
        $('#passwd').focus();
        return false;
    }
    else
    {
        $('#loginForm').submit();
    }
}

function validateRegister()
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

    if (!validateEmail($('#Email').val())) {
        alert("Please provide a valid email address.");
        $('#Email').focus();
        return;
    }

    if (!validateEmail($('#Conf_Email').val())) {
        alert("Please provide a valid email address.");
        $('#Conf_Email').focus();
        return;
    }

    if ($('#Conf_Email').val() !== $('#Email').val()) {
        alert("Emails do not match.");
        $('#Conf_Email').focus();
        return;
    }

    if ($('#Password').val() == "") {
        alert("Please provide a valid password.");
        $('#Password').focus();
        return;
    }

    if ($('#Password_Conf').val() == "") {
        alert("Please provide a valid password.");
        $('#Password_Conf').focus();
        return;
    }

    if ($('#Password_Conf').val() !== $('#Password').val()) {
        alert("Passwords do not match.");
        $('#Password_Conf').focus();
        return;
    }
    else
    {
        $('#registerFrm').submit();
    }
}

function validateFrgtPass()
{
    if (!validateEmail($('#rstEmail').val())) {
        alert("Please provide a valid email address.");
        $('#rstEmail').focus();
        return;
    }
    else
    {
        rstEmail = $('#rstEmail').val();
        $.ajax({
            type: 'POST',
            url: '/forgotPass_action.php',
            data: {Email: rstEmail},
            error: function (xhr, status, error) {
                alert(status);
                alert(xhr.responseText);
            },
            success: function (result) {

                $("#forgotPassDiv").load("/incs/forgotPass.php");
            }
        });
    }
}

function validateResetPassForm()
{
    if ($('#Password').val() == "") {
        alert("Please provide a valid password.");
        $('#Password').focus();
        return false;
    }

    if ($('#Password_Conf').val() == "") {
        alert("Please provide a valid password.");
        document.resetPassFrm.Password_Conf.focus();
        return false;
    }

    if ($('#Password_Conf').val() !== $('#Password').val()) {
        alert("Passwords do not match.");
        $('#Password_Conf').focus();
        return false;
    }
    else
    {
        $('#resetPassFrm').submit();
    }
}