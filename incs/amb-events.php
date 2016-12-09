<!-- Navgivation -->
<?php

include '/incs/nav.php';


$AID = $ambassador->getVar("AID");
$FName = $ambassador->getFName();
$LName = $ambassador->getLName();
$Name = $FName . " " . $LName;
$ProfileIntro = $ambassador->getVar('ProfileIntro');
$HeroImg = $ambassador->getProfileHeroImgUrl();
$RoleTxt = $ambassador->getRoleTxt();
$dateObj = new DateTime($ambassador->getDateRegistered());
$DateRegistered = $dateObj->format('M d, Y');
$ProfilePrevImg = $ambassador->getProfilePrevImgUrl();

$ViewAmbID = $AID;
$LocationTxt = $ambassador->getLocationTxt();
$events = $ambassador->getEvents();
//print_r($events);
//print_r(is_array($events));
//exit();
//$favorites = $ambassador->getFavorites();
//$posts = $ambassador->getPostsWithLeadAmb();
//$newsAndEvents = $ambassador->getNewsAndEventsWithLeadAmb();
//$questions = $ambassador->getQuestions();
//$agallery = $ambassador->getSlideshow();
$AlignHero = $ambassador->getVar("AlignHeroImg");
if ($AlignHero == "top") {
    $AlignHero = "background-position: top;";
} else if ($AlignHero == "center" || $AlignHero == "") {
    $AlignHero = "";
} else if ($AlignHero == "bottom") {
    $AlignHero = "background-position: bottom;";
}
//include '/incs/ambHighResGallery.php';
?>

<!-- Ambassador Hero -->
<div class="bgWrapperLeaf landingWrapperHeight ambProfileHeroBgWrapper h60vh">
    <div class="widthWrapper h100p">
        <div class="landingLeafWrapper2 ambProfileHeroWrapper heroText" style="background-image: linear-gradient(rgba(0,0,0,0.35), rgba(0,0,0,0.4)), url(<?php echo $HeroImg; ?>); <?php echo $AlignHero; ?>">
            <div class="tableWrapper h100p">
                <div class="cellWrapper">
                    <div class="lg-twelve">
                        <h1 class="caps fw-600 size1" style="letter-spacing: 2px;"><?php echo $Name; ?></h1>
                        <h2 class="ital fw-400 size3"><?php echo $LocationTxt; ?>, Ambassador</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="widthWrapper tighter">
    <div class="ambBodyWrapper">
        <div class="lg-twelve">

            <div class="newsEventsHead">
                <div class="line-separator50px marBottom15 bgContrastGrey"></div>
                <h3 class="ital fw-300"><?php echo $Name; ?></h3>
                <h2 class="caps marBottom15 size45">News &amp; Events</h2>
                <div class="line-separator50px bgContrastGrey"></div>
            </div>

            <?php
            $count = 0;
            //if (is_array($events)) {
            foreach ($events as $event) {
                $EID = $event->getVar('EID');
                $AID = $event->getVar('AID');
                $Name = $event->getVar('Name');
                $EventDate = $event->getVar('EventDate');
                $Location = $event->getVar('Location');
                $dateObj = new DateTime($event->getVar('PostDate'));
                $ImgUrl= $event->getImgUrl();
                /*$AID = $row['AID'];
                $EID = $row['EID'];
                //$NID = $row['NID'];
                $Name = $row['Name'];
                $Location = $row["Location"];
                $Subtitle = $row['Subtitle'];
                $Description = $row['Description'];
                $Img = new Image($row["ImgUrl"]);
                if ($EID > 0) {
                    $EventDate = $row["EventDate"];
                }
                $ImgUrl = $Img->getImageUrl();*/
            if ($EID > 0) {
                $facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode("http://www.virgiljames.net/share/event.php?EID=$EID&AID=$ViewAmbID");
                $facebookUrlSEO = "https://www.facebook.com/sharer/sharer.php?u=" . "http://www.virgiljames.net/share/event.php?EID=" . $EID . "&AID=" . $ViewAmbID;
                $twitterUrl = "https://twitter.com/share?url=" . urlencode("http://www.virgiljames.net/share/event.php?EID=$EID&AID=$ViewAmbID");
                $twitterUrlSEO = "https://twitter.com/share?url=" . "http://www.virgiljames.net/share/event.php?EID=" . $EID . "&AID=" .$ViewAmbID;
                $eventUrlSEO =  "http://www.virgiljames.net/share/event.php?EID=" . $EID . "&AID=" .$ViewAmbID;
                $pinterest = "http://pinterest.com/pin/create/button/?url=" . urlencode("http://www.virgiljames.net/share/event.php?NID=$NID&AID=$ViewAmbID") . "&media=" . urlencode("http://www.virgiljames.net$ImgUrl");
            } else {
                $facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode("http://www.virgiljames.net/share/news.php?NID=$NID&AID=$ViewAmbID");
                $facebookUrlSEO = "https://www.facebook.com/sharer/sharer.php?u=" . "http://www.virgiljames.net/share/news.php?NID=" . $NID . "&AID=" . $ViewAmbID;
                $twitterUrl = "https://twitter.com/share?url=" . urlencode("http://www.virgiljames.net/share/news.php?NID=$NID&AID=$ViewAmbID");
                $twitterUrlSEO = "https://twitter.com/share?url=" . "http://www.virgiljames.net/share/news.php?NID=" . $NID . "&AID=" . $ViewAmbID;
                $pinterest = "http://pinterest.com/pin/create/button/?url=" . urlencode("http://www.virgiljames.net/share/news.php?NID=$NID&AID=$ViewAmbID") . "&media=" . urlencode("http://www.virgiljames.net$ImgUrl");
            }
            $count++;
            ?>
            <div class="eventBlock">
                <img class="eventImg leafCorners2" src="<?php echo $ImgUrl; ?>" alt="" />
                <h5 class="caps fw-700 size6"><?php echo $Name; ?></h5>
                <?php
                if (isset($EventDate) && $EventDate != "") {
                    echo "<span>" . $EventDate . "</span>";
                }
                ?>
                <h6 class="fw-300 size6 marBottom15 marTop15" style="text-transform: capitalize; font-style: italic;"><?php echo $Subtitle; ?></h6>
                <p class="fw-300 size7"><?php echo $Description; ?></p>
                <?php if ($EID > 0) { ?>
                    <div class="rsvpBtnWrapper marBottom15"><a class="fillBtn textCenter" style="width:100%;" href="javascript:void(0)" onclick="javascript:openAmbRsvpModal('<?php echo $AID; ?>', '<?php echo $Name; ?>');">RSVP</a></div>
                <?php } ?>
                <ul class="shareIcons size8 fw-400">
                    <!--
                    --><li><a href="<?php echo $facebookUrl; ?>" target="_blank"><i class="icon-facebook-squared"></i>Share</a></li><!--
                    --><li><a href="<?php echo $twitterUrl; ?>" target="_blank"><i class="icon-twitter-squared"></i>Tweet</a></li><!--
                    --><!--<li><a href="<?php //echo $pinterest;      ?>" target="_blank"><i class="icon-pinterest-squared"></i>Pin</a></li>-->
                </ul>
                <div class="line-separator100p bgContrastGrey marTop30 marBottom30"></div>
            </div>
            <?php
            }
            if ($count == 0) {
            echo "<div class='alertMessage textCenter'>No Events or News been created.</div>";
            }
            //} else {
           // echo "<div class='alertMessage textCenter'>No Events or News been created.</div>";
            //}
            ?>
        </div>
    </div>
</div>
