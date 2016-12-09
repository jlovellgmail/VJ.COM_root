function validateLifestyleEventRSVP(){
    if ($("#rsvp_name").val()==""){
        alert("Please enter your name to proceed.");
        $("#rsvp_name").focus();
        return;
    }
    if ($("#rsvp_email").val()==""){
        alert("Please enter your email to proceed.");
        $("#rsvp_email").focus();
        return;
    }

    if ($("#rsvp_guest_no").val()==""){
        alert("Please enter the # of guest to proceed.");
        $("#rsvp_guest_no").focus();
        return;
    }
    var serializedData = $("#lifestyleEventForm").serialize();
    $.ajax({
        type: "POST",
        url: "/lifestyle-RSVP-action.php",
        data: serializedData,
        error: function (xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success: function (result) {

            $('#result').html(result);

        }
    });

}