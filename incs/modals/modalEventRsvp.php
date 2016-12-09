<?php
$AID = $_GET["AID"];
$Name = $_GET["Name"];
?>
<form class="generalForm modalForm" id="ambContactFrm">
    <div class="row">
        <div class="lg-twelve">
            <h2 class="caps textCenter">RSVP For <?php echo $Name; ?></h2>
            <br />
            <div id="RSVPDiv">
                <label>Name</label>
                <input type="text" id="RSVPName" name="Name" placeholder="First and Last Name" value="">
                <label>Email Address</label>
                <input type="text" id="RSVPEmail" name="Email" placeholder="email@domain..." value="">
                <label>Comments</label>
                <textarea placeholder="Please include any specifics" id="RSVPCommnets" name="Comments"></textarea>
                <input type="Hidden" id="RSVPAID" name="AID" value="<?php echo $AID; ?>"/>
                <input type="Hidden" id="EventName" name="EventName" value=" <?php echo $Name; ?>"/>
            </div>
        </div>
    </div>
    <br>
    <div id="RSVPBtn" class="generalFormSubmit textCenter">
        <a type="button" class="fillBtn" href="javascript:validateRSVP();">RSVP</a>
    </div>
</form>