<?php 
$AID = $_GET["AID"];
$FName = $_GET["Name"];
?>
<form class="generalForm modalForm" id="ambMeetingFrm" action="ambassadorMeeting_action.php" method="post">
    <div class="row">
        <div class="lg-twelve">
            <h2 class="caps textCenter">Request a Meeting with <?php echo $FName; ?></h2>
            <br />
            <div id="MeetingDiv">
                <label>Name</label>
                <input type="text" id="MeetingName" name="Name" placeholder="First and Last Name" value="">
                <label>Email Address</label>
                <input type="text" id="MeetingEmail" name="Email" placeholder="email@domain..." value="">
                <label>Telephone</label>
                <input type="text" id="MeetingTelephone" name="Telephone" placeholder="Enter Full Telephone Number" value="">
                <label>Comments</label>
                <textarea placeholder="Please include any specifics" id="MeetingComments" name="Comments"></textarea>
                <input type="Hidden" id="MeetingAID" name="AID" value="<?php echo $AID; ?>"/>
            </div>
        </div>
    </div>
    <br>
    <div id="MeetingBtn" class="generalFormSubmit textCenter">
        <a type="button" class="fillBtn" href="javascript:validateMeeting();">Submit</a>
    </div>
</form>