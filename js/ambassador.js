$(document).ready(function () {
    $("#favSlider").owlCarousel({
        center: false,
        autoWidth: true,
        loop: true,
        autoplay: false,
        autoplayTimeout: 2500,
        autoplaySpeed: 750,
        dots: false,
        responsive: {
            0: {
                margin: 15,
                items: 1
            },
            640: {
                margin: 30,
                items: 2
            },
            1000: {
                margin: 30,
                items: 3
            }
        }
    });
});

function validateTrunk()
{
    if ($('#TrunkName').val() == "") {
        alert("Please provide your name.");
        $('#TrunkName').focus();
        return;
    }

    if (!validateEmail($('#TrunkEmail').val())) {
        alert("Please provide a valid email.");
        $('#TrunkEmail').focus();
        return;
    }

    if ($('#TrunkTelephone').val() == "") {
        alert("Please provide your telephone number.");
        $('#TrunkTelephone').focus();
        return;
    }

    if ($('#TrunkLocation').val() == "") {
        alert("Please enter your location.");
        $('#TrunkLocation').focus();
        return;
    }

    if ($('#TrunkComments').val() == "") {
        alert("Please enter comments.");
        $('#TrunkComments').focus();
        return;
    }

    Name = $('#TrunkName').val();
    Email = $('#TrunkEmail').val();
    Telephone = $('#TrunkTelephone').val();
    Location = $('#TrunkLocation').val();
    Comments = $('#TrunkComments').val();
    AID = $('#TrunkAID').val();

    $.ajax({
        type: 'POST',
        url: '/ambassadorTrunk_action.php',
        data: {Name: Name, Email: Email, Telephone: Telephone, Location: Location, Comments: Comments, AID: AID},
        error: function (xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success: function (result) {
            $('#trunkDiv').html(result);
            $('#trunkBtn').hide();
        }
    });
}

function validateMeeting()
{
    if ($('#MeetingName').val() == "") {
        alert("Please provide your name.");
        $('#MeetingName').focus();
        return;
    }

    if (!validateEmail($('#MeetingEmail').val())) {
        alert("Please provide a valid email.");
        $('#MeetingEmail').focus();
        return;
    }

    if ($('#MeetingTelephone').val() == "") {
        alert("Please provide your telephone number.");
        $('#MeetingTelephone').focus();
        return;
    }

    if ($('#MeetingComments').val() == "") {
        alert("Please enter comments.");
        $('#MeetingComments').focus();
        return;
    }

    Name = $('#MeetingName').val();
    Email = $('#MeetingEmail').val();
    Telephone = $('#MeetingTelephone').val();
    Comments = $('#MeetingComments').val();
    AID = $('#MeetingAID').val();

    $.ajax({
        type: 'POST',
        url: '/ambassadorMeeting_action.php',
        data: {Name: Name, Email: Email, Telephone: Telephone, Comments: Comments, AID: AID},
        error: function (xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success: function (result) {
            $('#MeetingDiv').html(result);
            $('#MeetingBtn').hide();
        }
    });
}

function validateContact()
{
    if ($('#ContactName').val() == "") {
        alert("Please provide your name.");
        $('#ContactName').focus();
        return;
    }

    if (!validateEmail($('#ContactEmail').val())) {
        alert("Please provide a valid email.");
        $('#ContactEmail').focus();
        return;
    }

    if ($('#ContactComments').val() == "") {
        alert("Please enter comments.");
        $('#ContactComments').focus();
        return;
    }

    Name = $('#ContactName').val();
    Email = $('#ContactEmail').val();
    Comments = $('#ContactComments').val();
    AID = $('#ContactAID').val();

    $.ajax({
        type: 'POST',
        url: '/ambassadorContact_action.php',
        data: {Name: Name, Email: Email, Comments: Comments, AID: AID},
        error: function (xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
        },
        success: function (result) {
            $('#ContactDiv').html(result);
            $('#ContactBtn').hide();
        }
    });
}

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
        data: {Name: Name, Email: Email, Comments: Comments, AID: AID, EventName: EventName},
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

function validateAmbEventRSVP(){
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
    var serializedData = $("#EventForm").serialize();
    $.ajax({
        type: "POST",
        url: "/ambassadorRSVP_action.php",
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

function openFavoriteModal(FID)
{
    //$('#modalFavorite').load('/incs/favoriteModal.php?FID=' + FID);
    //$('#modalFavorite').toggleClass('hide', false);
    //$('.modalOverlay').toggleClass('hide', false);
    showModal("/incs/modals/favoriteModal.php?FID=" + FID);
}

function openAmbRsvpModal(AID, EName) {
    showModal("/incs/modals/modalEventRsvp.php?AID=" + AID + "&Name=" + EName)
}

function openAmbContactModal(AID, FName) {
    showModal("/incs/modals/modalAmbContact.php?AID=" + AID + "&Name=" + FName)
}

function openMeetingModal(AID, FName) {
    showModal("/incs/modals/modalAmbMeeting.php?AID=" + AID + "&Name=" + FName)
}

function openTrunkModal(AID, FName) {
    showModal("/incs/modals/modalAmbTrunkShow.php?AID=" + AID + "&Name=" + FName)
}
