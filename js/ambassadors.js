function validateRSVP()
{
    if ($('#RSVPName').val() == "") {
        alert("Please provide your name.");
        $('#RSVPName').focus();
        return;
    }

    if (!validateEmail($('#RSVPEmail').val())) {
        alert("Please provide a valid email.");
        $('#RSVPEmail').focus();
        return;
    }

    if ($('#RSVPCommnets').val() == "") {
        alert("Please enter comments.");
        $('#RSVPCommnets').focus();
        return;
    }

    Name = $('#RSVPName').val();
    Email = $('#RSVPEmail').val();
    Comments = $('#RSVPCommnets').val();
    AID = $('#RSVPAID').val();
    EventName = $('#EventName').val();

    $.ajax({
        type: 'POST',
        url: '/ambassadorRSVP_action.php',
        data: {Name: Name, Email: Email, Comments: Comments, AID: AID,EventName:EventName},
        error: function (xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success: function (result) {
            $('#RSVPDiv').html(result);
            $('#RSVPBtn').hide();
        }
    });
}

function openAmbRsvpModal(AID, EName) {
    showModal("/incs/modals/modalEventRsvp.php?AID=" + AID + "&Name=" + EName)
}