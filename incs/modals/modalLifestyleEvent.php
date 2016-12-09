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
    <div class='modalLifestyleEventWrapper'>
        <div class='xs-twelve'>
            <span class='block caps fw-600 textGrey size5 marBottomR1'><?php echo $event->getVar("Name"); ?></span>
        </div>
        <div class='rel xs-twelve marBottomR1'>
            <div class='rel iB aspect-img-wrapper xs-eight sm-five marBottomR1'>
                <div class='square-aspect-dummy'></div>
                <div class='aspect-img' style='background-image: url(<?php echo $event->getImgUrl(); ?>);'></div>
            </div><div class='rel iB xs-twelve sm-seven smPaddingL15 textLeft'>
                <span class='block italic textGrey size6 fw-300'><?php echo $event->getVar("Subtitle"); ?></span>
                <span class='block textGrey size7 fw-300'><?php echo $event->getVar("Description"); ?></span>
                <span class='block size7 fw-300'><?php echo $eventDate->format("l F d, Y"); ?> - <?php echo $eventDate->format("g:i a"); ?><br /><?php echo $event->getVar("Location"); ?></span>
            </div>
        </div>
        <div class='rel xs-twelve' id='result'>
            <form class='rel block generalForm' id='lifestyleEventForm' name='lifestyleEventForm' action='/lifestyle-RSVP-action.php' method='post'>
                <input type="hidden" name="EventName" id="EventName" value="<?php echo $event->getVar("Name");  ?>">
                <input id="rsvp_name" name="rsvp_name" placeholder="First and Last Name" value="" type="text">
                <input id="rsvp_email" name="rsvp_email" placeholder="Email Address" value="" type="text">
                <input id="rsvp_tel" name="rsvp_tel" placeholder="Phone Number" value="" type="text">
                <input id="rsvp_guest_no" name="rsvp_guest_no" placeholder="Number of Guests in Party" value="" type="text">
            </form>
            <div id="eventRSVPBtn" class="generalFormSubmit textCenter">
                <a type="button" class="fillBtn" href="javascript:validateLifestyleEventRSVP();">Request Invite</a>
            </div>
        </div>
    </div>

<?php } ?>