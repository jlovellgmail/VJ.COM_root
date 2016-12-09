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
$favorites = $ambassador->getFavorites();
$posts = $ambassador->getPostsWithLeadAmb();
//$posts = $ambassador->getPublishedPosts();
//$newsAndEvents = $ambassador->getNewsAndEventsWithLeadAmb();
$events = $ambassador->getAmbEventsWithGeneralEvents();

$questions = $ambassador->getQuestions();
$agallery = $ambassador->getSlideshow();
$AlignHero = $ambassador->getVar("AlignHeroImg");
if ($AlignHero == "top") {
    $AlignHero = "background-position: top;";
} else if ($AlignHero == "center" || $AlignHero == "") {
    $AlignHero = "";
} else if ($AlignHero == "bottom") {
    $AlignHero = "background-position: bottom;";
}
include '/incs/ambHighResGallery.php';
?>

<div class='landing-hero-wrapper' style='margin-bottom: 0;'>
    <div class='block rel'>
        <div class='aspect-dummy-hero'></div>
        <div class='aspect-img aspect-img-hero ambProfileHeroWrapper' style="background-image: linear-gradient(rgba(0,0,0,0.35), rgba(0,0,0,0.4)), url('<?php echo $HeroImg; ?>'); <?php echo $AlignHero; ?>">
            <div class="widthWrapper tableWrapper h100p">
                <div class="cellWrapper">
                    <div class="lg-twelve heroText">
                        <h1 class="caps fw-600 size1" style="letter-spacing: 2px;"><?php echo $Name; ?></h1>
                        <h2 class="ital fw-400 size3"><?php echo $LocationTxt; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ambassador Profile -->
<div class="bgWrapper ambProfileBgWrapper">
    <div id="qCloseAnchor"></div>
    <div class="widthWrapper">

        <div class="row ambIntroRow">
            <div class="lg-four ambAvatarWrapper">
                <div class='amb-event-left-col-margin hide'></div>
                <div class="ambAvatar leafCorners1 leafShadow">
                    <div class="aspectDummy"></div>
                    <div class="ambAvatarImgBg leafShadow" style="background-image: url('<?php echo $ProfilePrevImg; ?>');">
                    </div>
                </div>

                <button type="button" class="ambQuestionsBtn ambQuestionFn ital fw-300 f-28px" data-id="showReadMore">More About <?php echo $FName; ?></button>
                <div class="mobileAmbTitle">
                    <h1 class="caps fw-700 size1 black"><?php echo $Name; ?></h1>
                    <h2 class="ital fw-400 size3 black marBottom15"><?php echo $LocationTxt; ?>, Ambassador</h2>
                </div>

                <div class='events-title-wrapper block hide'>
                    <h2 class="caps marBottom15 size45">Upcoming Events</h2>
                    <div class='events-list-bg leafCorners2'></div>
                </div>

            </div><div class="lg-eight ambInfoWrapper">
                <div class="ambButtonRow">
                    <div class="mobileRowBreaker">
                        <!-- <a class="ambProfileBtn caps"  href="/amb-events.php?PermLink=<?php echo $PermLink; ?>" >Upcoming Events +</a> -->
                        <a class="ambProfileBtn caps events-trigger" >Upcoming Events +</a>
                    </div><div class="mobileRowBreaker">
                        <a class="ambProfileBtn caps"  href="javascript:void(0)" onclick="javascript:openTrunkModal('<?php echo $AID; ?>', '<?php echo $FName; ?>');">Request Trunk Show +</a>
                    </div><!-- <div class="mobileRowBreaker">
                        <a class="ambProfileBtn caps"  href="javascript:void(0)" onclick="javascript:openMeetingModal('<?php echo $AID; ?>', '<?php echo $FName; ?>');">Request Meeting +</a>
                    </div> --><div class="mobileRowBreaker">
                        <a class="ambProfileBtn caps"  href="javascript:void(0)" onclick="javascript:openAmbContactModal('<?php echo $AID; ?>', '<?php echo $FName; ?>');">Contact +</a>
                    </div>
                </div>
                <div class="ambIntroP textLeft">
                    <h3 class="caps fw-700 size45 marBottom15">Introducing <?php echo $FName; ?></h3>
                    <p class="wsPl"><?php echo $ProfileIntro; ?></p>
                    <button type="button" class="ambQuestionsBtn2 ambQuestionFn ital fw-300 f-28px" data-id="showReadMore">More About <?php echo $FName; ?></button>
                </div>
                <!-- Ambassador Events -->


                <div class='ambEventsBlock textLeft hide'>
                    <button class="eventClose caps fw-400 size5"><i class="icon-cancel-1 size7"></i></button>
                    <!-- <h1 class='caps fw-700 size45 marBottomR1'>Upcoming Events</h1> -->
                    <div>
                        <?php
                        if (is_array($events)) {
                            foreach ($events as $row) {
                                $event = new AmbassadorEvent();
                                $event->initialize($row);
                                $eventDate = new DateTime($event->getVar("Date") . " " . $event->getVar("Time"));
                                ?>
                                <div class='event-block'>
                                    <a href="javascript:void(0);" class='event-expand event-details' onclick="showModal('/incs/modals/modalAmbEvent.php?EID=<?php echo $event->getVar("EID"); ?>&AmbID=<?php echo $AID; ?>');">
                                        <div class='xs-zero sm-two xl-one'>
                                            <div class='cal-wrapper'>
                                                <div class='cal-block'>
                                                    <div class='cal-title'></div>
                                                    <div class='cal-ring-1'></div>
                                                    <div class='cal-ring-2'></div>
                                                    <span class='cal-month-span'><?php echo $eventDate->format("M"); ?></span>
                                                    <span class='cal-date-span'><?php echo $eventDate->format("d"); ?></span>
                                                </div>
                                            </div>
                                        </div><div class='event-list-text xs-twelve sm-ten xl-eleven' style='padding-top: 2px;'>
                                            <h4 class='caps fw-600'><?php echo $event->getVar("Name"); ?></h4>
                                            <span class='f-14px'><?php echo $eventDate->format("l F d, Y"); ?> - <?php echo $eventDate->format("g:i a"); ?></span>
                                        </div>
                                    </a>
                                </div><?php
                            }
                        } else {
                            ?>
                            <div class='event-block'>
                                <div class='event-details'>
                                    There are no upcoming events for this ambassador.
                                </div>
                            </div>
<?php } ?>
                    </div>
                    <!--<div class='all-events-btn-wrapper'>
                        <div class='view-all-events fillBtn'>View All</div>
                    </div>-->
                </div>
            </div>
        </div>


        <div id="showReadMore" class="ambQuestionsBlock textLeft" style="display:none;">
            <!-- <h3 class="caps size45 fw-700"><?php echo $questions->count(); ?> Questions</h3><br /> -->
            <?php
            $count = 0;
            foreach ($questions as $quest) {
                $QID = $quest->getVar('QID');
                $AID = $quest->getVar('AID');
                $Question = $quest->getVar('Question');
                $Answer = $quest->getVar('Answer');
                $count++;
                ?>
                <div class="ambInterviewGroup lg-twelve textLeft">
                    <div class="ambInterviewQ"><?php echo $Question; ?></div>
                    <div class="ambInterviewA"><?php echo $Answer; ?></div>
                </div>
                <?php if ($questions->count() != $count) { ?>
                    <!-- <hr class="marBottom15" style="border-color:transparent; margin-bottom:30px;" /> -->
                    <?php
                }
            }
            if ($count == 0) {
                echo "<div class='alertMessage textCenter'>No Questions/Answers have been created.</div>";
            }
            ?>
            <a href="#qCloseAnchor" class="textBtn ambQuestionClose ambQuestionCloseFn caps fw-600 f-14px textGrey block textCenter" data-id="showReadMore">Close</a>
        </div>

    </div>
    <div class="favBottomHR marBottom30"></div>
</div>


<!-- Favorite Things -->
<?php if (is_object($favorites) && $favorites->count() > 0) { ?>
    <div class="bgWrapper ambFavsBgWrapper marBottomR2">
        <div class="widthWrapper favWidthWrapper">

            <div class="favThingsHead">
                <div class="line-separator50px marBottom15 bgContrastGrey"></div>
                <h3 class="ital fw-300">Here Are A Few Of My</h3>
                <h2 class="caps marBottom15 size45">Favorite Things</h2>
                <div class="line-separator50px bgContrastGrey"></div>
            </div>

            <div id="favSlider" class="owl-carousel">
                <?php
                foreach ($favorites as $favorite) {
                    $FID = $favorite->getVar("FID");
                    if ($favorite->getVar("Type") == "P") {
                        $PID = $favorite->getVar("PID");
                        $product = new Product();
                        $product->initialize($PID);
                        $productImg = $product->getThumbnailUrl();
                        $favTitle = $product->getProductName();
                        $comment = $favorite->getVar("Comments");
                        $productHidden = $product->getVar("Hidden");
                        if ($productHidden) {
                            continue;
                            exit();
                        }
                        if (!isset($comment) && $comment == "") {
                            $comment = $product->getVar("ShortDescription");
                        }
                    } else {
                        $productImg = $favorite->getImgUrl();
                        $favTitle = $favorite->getVar("ItemName");
                        //$omment = $favorite->getVar("ItemName");
                        $comment = $favorite->getVar("Comments");
                        $productHidden = FALSE;
                    }
                    ?>
                    <a class="ambFavWrapper" href="javascript:void(0);" onclick="openFavoriteModal('<?php echo $FID; ?>');">
                        <div class="ambFav leafCorners2 bgWhite">
                            <div class="xs-six ambFavImg h100p bgWhite" style="background-image: url('<?php echo $productImg; ?>'); margin-left: -1px;">
                            </div><div class="xs-six ambFavTxt h100p textLeft">
                                <h3 class="caps fw-700 black f-14px marBottom10"><?php echo $favTitle; ?></h3>
                                <span class="fw-300 textGrey f-14px"><?php echo $comment; ?></span>
                            </div>
                        </div>
                    </a>

    <?php } ?>

            </div>

        </div>
        <div class="favBottomHR"></div>
    </div>
<?php } ?>


<div class="widthWrapper">
    <div class="ambBodyWrapper">
        <div class="lg-twelve textLeft">
            <div class="journalHighlightsHead textCenter">
                <div class="line-separator50px marBottom15 bgContrastGrey"></div>
                <h3 class="ital fw-300"><?php echo $Name; ?></h3>
                <h2 class="caps marBottom15 size45">Ambassador Journal</h2>
                <div class="line-separator50px bgContrastGrey"></div>
            </div>
            <?php
            $count = 0;
            if (is_array($posts)) {
                $postCount = count($posts);
                foreach ($posts as $row) {
                    $post = new AmbassadorPost();
                    $post->initialize($row);
                    $PID = $post->getVar('PID');
                    $AID = $post->getVar('AID');
                    $Title = $post->getVar('Title');
                    $urlTitle = str_replace(' ', '-', $Title);
                    $urlTitle = str_replace('&', '-', $urlTitle);
                    $urlTitle = str_replace('/', '-', $urlTitle);
                    $SubTitle = $post->getVar("SubTitle");
                    $dateObj = new DateTime($post->getVar('PostDate'));
                    $PostDate = $dateObj->format('M dS, Y');
                    $ImgUrl = $post->getImgUrl();
                    $Img = new Image($row["ProfilePrevImg"]);
                    $ProfilePrevImg = $Img->getImageUrl();
                    $count++;
                    $divClass1 = "xl-six";
                    $divClass2 = "xl-four";
                    if ($count == $postCount && $count % 2 != 0) {
                        $divClass1 = "xl-twelve";
                        $divClass2 = "xl-two";
                    }
                    ?><!-- 
                    --><div class='ambJournalPost <?php echo $divClass1; ?>'>
                        <div class="highlightArticle">
                            <div class="highlightThumbWrapper sm-five md-four lg-three <?php echo $divClass2; ?>"><a href="/post.php??PermLink=<?php echo $PermLink; ?>&Title=<?php echo $urlTitle; ?>&PID=<?php echo $PID; ?>"><img class="highlightThumb leafCorners2" src="<?php echo $ImgUrl; ?>" alt="" /></a></div><!-- 
                            --><div class="highlightCopy sm-seven md-eight lg-nine xl-eight">
                                <a href="/post.php??PermLink=<?php echo $PermLink; ?>&Title=<?php echo $urlTitle; ?>&PID=<?php echo $PID; ?>"><h4><?php echo $Title; ?></h4></a>
                                <p class='truncated-post' data-truncate-lines="3"><?php echo $SubTitle; ?></p><a href="/post.php??PermLink=<?php echo $PermLink; ?>&Title=<?php echo $urlTitle; ?>&PID=<?php echo $PID; ?>" class="fw-600 size7">Read More &#43;</a>
                                <!-- <div class="infoRow">
                                    <img class="postAuthorImg" src="<?php echo $ProfilePrevImg; ?>" alt="" /><span class="postDate size7">Posted <?php echo $PostDate; ?></span>
                                </div> -->
                                <!-- <a href="/ambassadorPost.php?PermLink=<?php echo $PermLink; ?>&PID=<?php echo $PID; ?>&from=ambassador" class="readMore caps fw-600 size7">Read More &#43;</a> -->
                            </div>
                        </div><div class="line-separator100p bgContrastGrey marTop30 marBottom30"></div></div><?php
                    }
                    if ($count == 0) {
                        echo "<div class='alertMessage textCenter'>No Posts have been created.</div>";
                    }
                } else {
                    echo "<div class='alertMessage textCenter'>No Posts have been created.</div>";
                }
                ?><!-- 
            --></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.ambQuestionFn').click(function () {
            var toggleId = $(this).data('id');
            $(this).toggleClass("on");
            $("#" + toggleId).slideToggle();
        });
    });
    $(document).ready(function () {
        $('.ambQuestionCloseFn').click(function () {
            $('#showReadMore').slideToggle();
        });
    });
</script>

<script>
    $(document).on('click', '.ambAvatar', function () {
        $("#staticModal").removeClass("hide");
    });
</script>

<script src="/js/truncate.js"></script>
<script type="text/javascript">
    $('.truncated-post').each(function () {
        var $el = $(this);
        $el.truncate({
            lines: $el.data('truncate-lines'),
            lineHeight: $el.css('line-height'),
            ellipsis: " ... "
        });
    });
</script>

<script>
    $('.events-trigger, .eventClose').on('click', function () {
        $('.ambEventsBlock').toggleClass('hide');
        $('.ambIntroP').toggleClass('hide');
        $('.events-trigger').toggleClass('events-button-toggled');
        $('.ambAvatar, .ambQuestionsBtn, .amb-event-left-col-margin, .events-title-wrapper').toggleClass('hide');
    });

</script>

