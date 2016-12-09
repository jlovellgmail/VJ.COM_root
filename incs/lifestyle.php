<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
if (!isset($_SESSION)) {
    session_start();
}
$tragetDiv = '';

if (isset($_GET['PID']) && $_GET['PID'] != '') {
    $_SESSION["Home"]["scrollStart"] = 0;
    $tragetDiv = "divID_" . $_GET['PID'];
} else {
    $_SESSION["Home"]["scrollStart"] = 0;
    $_SESSION["Home"]["scrollStop"] = 5;
}

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/classes/Lifestyle.class.php';
include $rootpath . '/classes/AmbassadorPost.class.php';
include $rootpath . '/classes/AmbassadorEvent.class.php';

$lifestyle = new Lifestyle();
$lifestylePosts = $lifestyle->getLifestylePosts();
$lifestyleEvents = $lifestyle->getLifestyleEvents();

$eventsCount = count($lifestyleEvents);
$postCount = count($lifestylePosts);

$query = "{call F_GetLifestyleGalleryItems}";
$dbo->doQuery($query);
$gallery = $dbo->loadObjectList();
?>


<div class='landing-hero-wrapper h100vh index-slide'>
    <div class='flip-card-blur-bg flip-card-blur-bg-lifestyle'></div>
    <div class='flipcard-01 flipcard'>
        <div class='aspect-dummy-two-thirds'></div>
        <div class='aspect-img'>
            <img class='postcard-stamp' src='/img/index/postcardstamps-morrocco.png' alt='' />
            <div class='card-divider'></div>
            <div class='xs-twelve lg-six h100p'>
                <div class='card-left'>
                    <p>Virgil,</p>
                    <p>I love the Lifestyle section.  So smart to share some of the things that inspire you and the VJ brand.  Clearly, you’ve been influenced by a life of travel and so many interesting experiences. It’s also pretty apparent that excellence, in its many forms, is a force for you.  This is reflected so well in all of the Virgil James products.  To&nbsp;an&nbsp;authentic&nbsp;life!</p>
                    <p>Your biggest fan!</p>
                </div>
            </div><div class='card-right xs-six h100p'>
                <div class='rel block h100p'>
                    <div class='return-address'>
                        <span class='postcard-address-01'>Virgil James</span>
                        <span class='postcard-address-02'>214 N. Cedros Avenue</span>
                        <span class='postcard-address-02'>Solana Beach, CA</span>
                        <span class='postcard-address-03'>USA</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--     <div class='widthWrapper tableWrapper h100p'>
        <div class='lifestyle-hero-cellwrapper cellWrapper'>
            <div class="sm-twelve lifestyle-title-block heroText">
                <h1 class="caps size2 fw-400">Inspired Living</h1>
                <span class='fw-300 zI3 heroText' style='font-size: 18px;'>An authentic and fulfilled life is rich with experiences.</span>
            </div>
        </div>
    </div> -->
    <div class='gps-lockup'>
        <div class='lockup-topline'>
            <img class='flippy-01 stampy-mc-stampface' src='/img/index/postcard-icon.png' alt='' />
        </div>
        <div class='lockup-bottomline'>
            <span class="heroText caps size3 fw-300 spaceLetters">Inspired </span>
            <span class="heroText caps size3 fw-600 spaceLetters">Living</span>
        </div>
    </div>
    <div class='scroll-arrow-indicator'><i class='icon-angle-down'></i></div>
</div>


<div class='scroll-down-to'></div>
<div class='lifestyle-content-wrapper widthWrapper'>

    <!-- Upcoming Events -->
    <?php if ($eventsCount > 0) { ?>
        <div class='event-view-all-holster-top xs-twelve'>
            <div class='events-wrapper xs-twelve textLeft' style='max-width: 960px; margin-left: auto; margin-right: auto;'>
                <div class='events-title-wrapper-top xs-zero xl-two textLeft' style='padding: 0; height: 50px;'>
                    <span class="marBottom15 fw-400" style="line-height: 50px; font-style: italic; font-size: 24px; color: #000;">Next Even</span><!-- 
                    --><span class="marBottom15 fw-400" style="line-height: 50px; font-style: italic; font-size: 24px; color: #000; letter-spacing: 4px;">t!&nbsp;</span>
                </div><div class='events-list-wrapper-top truncate xs-twelve xl-eight'>
                    <div class='events-list-top'>
                        <?php
                        foreach ($lifestyleEvents as $event) {
                            $eventDate = new DateTime($event->getVar("Date") . " " . $event->getVar("Time"));
                            ?><a class='event-list-item-top' href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleEvent.php?EID=<?php echo $event->getVar("EID"); ?>');">
                                <div class='event-list-text xs-twelve lg-ten'>
                                    <div class='cal-wrapper vam xs-zero sm-two'>
                                        <div class='cal-block'>
                                            <div class='cal-title'></div>
                                            <div class='cal-ring-1'></div>
                                            <div class='cal-ring-2'></div>
                                            <span class='cal-month-span'><?php echo $eventDate->format("M"); ?></span>
                                            <span class='cal-date-span'><?php echo $eventDate->format("d"); ?></span>
                                        </div>
                                    </div><div class='rel iB vam xs-twelve sm-ten'>
                                    	<span class='caps fw-600'><?php echo $event->getVar("Name"); ?></span>
                                        <span class=''><?php echo $eventDate->format("l F d, Y"); ?> - <?php echo $eventDate->format("g:i a"); ?></span>
                                    </div>
                                </div>
                            </a><?php } ?>
                    </div>
                </div>
                <button class='events-list-btn events-list-btn-desktop borderBtn' style='border-color: #000; color: #000;'>All Events</button>
            </div>
            <button class='events-list-btn events-list-btn-mobile borderBtn' style='border-color: #000; color: #000;'>Upcoming Events</button>
        </div>
    <?php } ?>

    <!-- Upcoming Events -->
    <?php if ($eventsCount > 0) { ?>
        <div class='event-view-all-holster truncate'>
            <div class='events-wrapper sm-twelve textLeft textCenter'>
                <div class='events-list-wrapper xs-twelve textLeft' style='max-width: 960px;'>
                    <div class='events-list'>
                        <?php
                        foreach ($lifestyleEvents as $event) {
                            $eventDate = new DateTime($event->getVar("Date") . " " . $event->getVar("Time"));
                            ?><a class='event-list-item' href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleEvent.php?EID=<?php echo $event->getVar("EID"); ?>');">
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
                                </div><div class='event-list-text xs-twelve sm-ten xl-eleven'>
                                    <span class='caps fw-600'><?php echo $event->getVar("Name"); ?></span>
                                    <span class=''><?php echo $eventDate->format("l F d, Y"); ?> - <?php echo $eventDate->format("g:i a"); ?></span>
                                </div>
                            </a><?php } ?>
                    </div>
                    <button class='event-list-close caps fw-400 size5 hide'><i class='icon-cancel-1 size7'></i></button>
                </div>
            </div>
        </div>
    <?php } ?>

<!-- <div class='rel block' style='margin: auto; width: 100%; margin-bottom: 30px;'>
    <div class='grid' style='margin: -4px;'>
        <div class='grid-item packery-post-landscape-wrapper'>
            <div class='packery-post-landscape-sizing'></div>
            <div class='grid-item-content packery-post-landscape-content'>
            <div class='post-landscape-title-banner'><span class='size5'>Example Title Goes Here - Sometimes It&nbsp;Might&nbsp;Be&nbsp;a&nbsp;Bit&nbsp;Long</span></div>
            </div>
        </div><div class='grid-item packery-post-portrait-wrapper'>
            <div class='packery-post-portrait-sizing'></div>
            <div class='grid-item-content packery-post-portrait-content'>
            </div>
        </div><div class='grid-item packery-gallery-wrapper'>
            <div class='packery-gallery-sizing'></div>
            <div class='grid-item-content packery-gallery-content'>
            </div>
        </div><div class='grid-item packery-post-portrait-wrapper'>
            <div class='packery-post-portrait-sizing'></div>
            <div class='grid-item-content packery-post-portrait-content' style='background: url(/uploadedImages/Posts/Slideshow/1010_SS1462316748.jpg) no-repeat center; background-size:cover;'>
            </div>
        </div><div class='grid-item packery-post-portrait-wrapper'>
            <div class='packery-post-portrait-sizing'></div>
            <div class='grid-item-content packery-post-portrait-content'>
            </div>
        </div><div class='grid-item packery-gallery-wrapper'>
            <div class='packery-gallery-sizing'></div>
            <div class='grid-item-content packery-gallery-content'>
            </div>
        </div><div class='grid-item packery-post-landscape-wrapper'>
            <div class='packery-post-landscape-sizing'></div>
            <div class='grid-item-content packery-post-landscape-content'>
            <div class='post-landscape-title-banner'><span class='size5'>Example Title Goes Here - Sometimes It&nbsp;Might&nbsp;Be&nbsp;a&nbsp;Bit&nbsp;Long</span></div>
            </div>
        </div><div class='grid-item packery-gallery-wrapper'>
            <div class='packery-gallery-sizing'></div>
            <div class='grid-item-content packery-gallery-content'></div>
        </div><div class='grid-item packery-gallery-wrapper'>
            <div class='packery-gallery-sizing'></div>
            <div class='grid-item-content packery-gallery-content' style='
    background: url(/uploadedImages/Posts/1010_BLK1464815628.jpg) no-repeat center; background-size: cover;'></div>
        </div><div class='grid-item packery-gallery-wrapper'>
            <div class='packery-gallery-sizing'></div>
            <div class='grid-item-content packery-gallery-content'></div>
        </div><div class='grid-item packery-post-landscape-wrapper'>
            <div class='packery-post-landscape-sizing'></div>
            <div class='grid-item-content packery-post-landscape-content'>
            </div>
        </div><div class='grid-item packery-post-portrait-wrapper'>
            <div class='packery-post-portrait-sizing'></div>
            <div class='grid-item-content packery-post-portrait-content'>
            </div>
        </div><div class='grid-item packery-gallery-wrapper'>
            <div class='packery-gallery-sizing'></div>
            <div class='grid-item-content packery-gallery-content'>
            </div>
        </div><div class='grid-item packery-post-portrait-wrapper'>
            <div class='packery-post-portrait-sizing'></div>
            <div class='grid-item-content packery-post-portrait-content' style='background: url(/uploadedImages/Posts/Slideshow/1010_SS1462316748.jpg) no-repeat center; background-size:cover;'>
            </div>
        </div><div class='grid-item packery-post-portrait-wrapper'>
            <div class='packery-post-portrait-sizing'></div>
            <div class='grid-item-content packery-post-portrait-content'>
            </div>
        </div><div class='grid-item packery-gallery-wrapper'>
            <div class='packery-gallery-sizing'></div>
            <div class='grid-item-content packery-gallery-content'>
            </div>
        </div><div class='grid-item packery-post-landscape-wrapper'>
            <div class='packery-post-landscape-sizing'></div>
            <div class='grid-item-content packery-post-landscape-content'>
            </div>
        </div><div class='grid-item packery-gallery-wrapper'>
            <div class='packery-gallery-sizing'></div>
            <div class='grid-item-content packery-gallery-content'></div>
        </div><div class='grid-item packery-gallery-wrapper'>
            <div class='packery-gallery-sizing'></div>
            <div class='grid-item-content packery-gallery-content' style='
    background: url(/uploadedImages/Posts/1010_BLK1464815628.jpg) no-repeat center; background-size: cover;'></div>
        </div><div class='grid-item packery-gallery-wrapper'>
            <div class='packery-gallery-sizing'></div>
            <div class='grid-item-content packery-gallery-content' style='background: url(/uploadedImages/Posts/Slideshow/1010_SS1462316748.jpg) no-repeat center; background-size: cover;'></div>
        </div>
    </div>
</div> -->

    <?php if ($postCount > 0) { ?>

        <div class='rel sm-twelve xl-eight marBottom45'>

            <div class='sm-twelve'>
                <div class='title-block-pad'>
                    <div class="lifestyle-section-title-block">
                        <!-- <div class="line-separator50px marBottom15 bgContrastGrey"></div> -->
                        <h3 class="ital fw-300">Virgil James Lifestyle</h3>
                        <h2 class="caps size45">Journal</h2>
                        <!-- <div class="line-separator50px bgContrastGrey"></div> -->
                    </div>
                </div>
                <div class="journal-rows-wrapper" id="lifestylePosts" data-ui="jscroll-default">
                    <?php include "/getLifestylePosts.php"; ?>
                </div>
                <div class="next jscroll-next-parent" style="display: none;">

                </div>
                <!-- <a href='#' class='black-button'>Load More</a> -->
            </div>
        </div><?php } ?><!--



Image Grid
    --><div class='image-grid-column sm-twelve xl-four marBottomR2'>
        <!-- <div id="instafeed" class='marBottom30'></div> -->

        <div class="lifestyle-section-title-block">
            <!-- <div class="line-separator50px marBottom15 bgContrastGrey"></div> -->
            <h3 class="ital fw-300">Virgil James Lifestyle</h3>
            <h2 class="caps size45">Gallery</h2>
            <!-- <div class="line-separator50px bgContrastGrey"></div> -->
        </div>

        <div class='image-grid-wrapper marBottomR1'>
            <?php
            $count = 0;

            if (is_array($gallery)) {
                foreach ($gallery as $item) {
                    $LGID = $item['LGID'];
                    $ImgUrl = $item['ImgUrl'];
                    $ImgUrl = str_replace('\\', '/', $ImgUrl);
                    ?><!--
                    --><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                        <div class='image-grid-img-wrapper'>
                            <div class='square-aspect-dummy'></div>
                            <a href="javascript:void(0);" onclick="showModal('/incs/modals/modal-gallery-item.php?LGID=<?php echo $LGID; ?>');" class='aspect-img' style='background-image: url(<?php echo $ImgUrl; ?>);'></a>
                        </div>
                    </div><!--
                    --><?php
                    $count++;
                }
            }
            ?>

        </div>
    </div>

</div>

<script>
    $('.events-list-btn, .event-list-close').on('click', function () {
        $('.event-view-all-holster').toggleClass('truncate').toggleClass('expand');
        $('.events-list-btn, .event-list-close, .event-view-all-holster-top').toggleClass('hide');
        $('.events-list-bg').toggleClass('hide');
        // $('.lifestyle-content-wrapper').toggleClass('landing-margin');
    });

    $('#lifestylePosts').jscroll({nextSelector: 'a.scroll:last'});
</script>



<script>
    $('.flippy-01').click(function () {
        $('.index-slide').toggleClass('flippyshow');
    })

    $(document).on('click', '.flip-card-blur-bg-lifestyle', function () {
        $('.index-slide').removeClass('flippyshow');
    });

    $(document).on('click', '.index-slide', function (e) {
        e.stopPropagation();
    });
</script>

<script>

    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    if( isMobile.any() ) {
        $(".index-slide, .flip-card-blur-bg, .flip-card-blur-bg-lifestyle").css("background-attachment","scroll");
    } else {
        $(".index-slide, .flip-card-blur-bg, .flip-card-blur-bg-lifestyle").css("background-attachment","fixed");
    };

</script>

<!--
<script>
    $(document).ready(function () {
        $(".image-grid-wrapper .img-grid-pad-wrapper:first-child .aspect-img").addClass('img-grid-first-corner');
        $(".image-grid-wrapper .img-grid-pad-wrapper:last-child .aspect-img").addClass('img-grid-last-corner');
    });
</script>
-->

<?php if ($tragetDiv != '') {
    ?>
    <script>
        $(document).ready(function () {
            var scrollTo = $("#<?php echo $tragetDiv; ?>");
            $('html,body').animate({scrollTop: scrollTo.offset().top - ($(window).height() / 2) + (scrollTo.height() / 2)});
        });
    </script>



    <?php
}
?>
