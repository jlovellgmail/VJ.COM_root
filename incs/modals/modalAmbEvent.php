<?php
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath.'/incs/conn.php';
include $rootpath.'/classes/AmbassadorEvent.class.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
if (isset($_GET["EID"]) && $_GET["EID"]!=""){
    $EID = $_GET["EID"];
    $event = new AmbassadorEvent();
    $event->initialize($EID);
    $eventDate = new DateTime($event->getVar("Date")." ".$event->getVar("Time") );

?>
    <div class='rel block' style='max-width: 640px;'>
        <div class='sm-twelve'>
            <span class='block caps fw-600 textGrey size5 marBottomR1'><?php echo $event->getVar("Name"); ?></span>
        </div>
        <div class='rel sm-twelve marBottomR1'>
            <div class='rel iB aspect-img-wrapper xs-eight md-four marBottomR1'>
                <div class='square-aspect-dummy'></div>
                <div class='aspect-img' style='background-image: url(<?php echo $event->getImgUrl(); ?>);'></div>
            </div><div class='rel iB xs-twelve md-eight textLeft mdPaddingL15'>
                <span class='block italic textGrey size6 fw-300'><?php echo $event->getVar("Subtitle"); ?></span>
                <span class='block textGrey size7 fw-300'><?php echo $event->getVar("Description"); ?></span>
                <span class='block size7 fw-300'><?php echo $eventDate->format("l F d, Y"); ?> - <?php echo $eventDate->format("g:i a"); ?><br /><?php echo $event->getVar("Location"); ?></span>
            </div>
        </div>
        <div class='rel sm-twelve' id="result">
            <form class="rel block generalForm" id="EventForm" name="lifestyleEventForm" action="/lifestyle-RSVP-action.php" method="post">
                <input type="hidden" name="EventName" id="EventName" value="<?php echo $event->getVar("Name");  ?>">
                <input type="hidden" name="AID" id="AID" value="<?php echo $_GET["AmbID"];  ?>">
                <input id="rsvp_name" name="Name" placeholder="First and Last Name" value="" type="text">
                <input id="rsvp_email" name="Email" placeholder="Email Address" value="" type="text">
                <input id="rsvp_tel" name="rsvp_tel" placeholder="Phone Number" value="" type="text">
                <input id="rsvp_guest_no" name="rsvp_guest_no" placeholder="Guests in Party" value="" type="text">
            </form>
            <div id="eventRSVPBtn" class="generalFormSubmit textCenter">
                <a type="button" class="fillBtn" href="javascript:validateAmbEventRSVP();">Request Invite</a>
            </div>
        </div>
    </div>

<?php } ?>