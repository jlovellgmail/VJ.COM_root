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
include $rootpath . '/classes/OldLifestylePosts.class.php';
include $rootpath . '/classes/AmbassadorPost.class.php';
include $rootpath . '/classes/AmbassadorEvent.class.php';

$lifestyle = new OldLifestylePosts();
$lifestylePosts = $lifestyle->getLifestylePosts();
$lifestyleEvents = $lifestyle->getLifestyleEvents();

$eventsCount = count($lifestyleEvents);
$postCount = count($lifestylePosts);
?>

<!-- Landing v2 -->
<div class='landing-hero-wrapper'>
    <div class='block rel'>
        <div class='aspect-dummy-hero' style='min-height: 400px;'></div>
        <div class='aspect-img aspect-img-hero' style='background-image: url(/img/bg/about_graphic.jpg); min-height: 400px;'>
            <div class="widthWrapper tableWrapper h100p">
                <div class="lifestyle-hero-cellwrapper cellWrapper" style='padding-bottom: 38px;'>
                    <div class="sm-twelve lifestyle-title-block heroText">
                        <span class="ital size3 fw-400">Authentic Quality Functionally</span>
                        <h1 class="caps size2 fw-600">Inspired Living</h1>
                        <p class="size7 fw-300"> Cras nec lectus metus. Maecenas imperdiet est sit amet enim cursus, porta pulvinar odio lobortis. Vivamus nulla nibh, sodales non placerat et, consequat sit amet massa. Morbi vehicula consectetur est. Aliquam aliquam facilisis faucibus. Mauris convallis lacus in imperdiet interdum. Cras feugiat ante ut lorem sagittis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class='lifestyle-content-wrapper widthWrapper landing-margin'>

    <!-- Upcoming Events -->
    <?php if ($eventsCount > 0) { ?>
        <div class='event-view-all-holster-top xs-twelve xxl-nine'>
            <div class='events-wrapper sm-twelve textLeft marBottomR2'>
            <!-- <img class='event-stretch-img' src='/img/lifestyle/eventimage-stretch.jpg' alt='' /> -->
                <div class='events-title-wrapper-top xs-zero xl-four textRight' style='padding: 0; height: 50px;'>
                    <span class="marBottom15 fw-400" style="line-height: 50px; font-style: italic; font-size: 24px; color: #fff;">Next Even</span><!-- 
                    --><span class="marBottom15 fw-400" style="line-height: 50px; font-style: italic; font-size: 24px; color: #fff; letter-spacing: 4px;">t!&nbsp;</span>
                </div><div class='events-list-wrapper-top truncate xs-zero xl-eight'>
                    <div class='events-list-top'>
                        <?php
                        foreach ($lifestyleEvents as $event) {
                            $eventDate = new DateTime($event->getVar("Date") . " " . $event->getVar("Time"));
                            ?><a class='event-list-item-top' href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleEvent.php?EID=<?php echo $event->getVar("EID"); ?>');">
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
                </div>
            </div>
            <button class='events-list-btn events-list-btn-mobile borderBtn' style='border-color: #fff; color: #fff;'>Upcoming Events</button>
            <button class='events-list-btn events-list-btn-desktop borderBtn' style='border-color: #fff; color: #fff;'>View All Events</button>
        </div>
    <?php } ?>

    <!-- Upcoming Events -->
    <?php if ($eventsCount > 0) { ?>
        <div class='event-view-all-holster truncate'>
            <div class='events-wrapper sm-twelve textLeft marBottomR2'>
            <!-- <img class='event-stretch-img' src='/img/lifestyle/eventimage-stretch.jpg' alt='' /> -->
                <div class='events-title-wrapper sm-twelve lg-four'>
                    <!-- <span class="caps marBottom15 size4" style='font-style: italic;'>All Events!&nbsp;</span> -->
                    <div class='events-list-bg hide leafCorners2'></div>
                </div><div class='events-list-wrapper sm-twelve lg-eight'>
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

    <!-- Journal -->

    <?php if ($postCount > 0) { ?>

        <div class='rel sm-twelve lg-eight marBottom45'>

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
                    <?php include "/OldGetLifestylePosts.php"; ?>
                </div>
                <div class="next jscroll-next-parent" style="display: none;">

                </div>
                <!-- <a href='#' class='black-button'>Load More</a> -->
            </div>
        </div><?php } ?><!--

Image Grid
    --><div class='sm-twelve lg-four marBottomR2'>
        <!-- <div id="instafeed" class='marBottom30'></div> -->

        <div class="lifestyle-section-title-block">
            <!-- <div class="line-separator50px marBottom15 bgContrastGrey"></div> -->
            <h3 class="ital fw-300">Virgil James Lifestyle</h3>
            <h2 class="caps size45">Gallery</h2>
            <!-- <div class="line-separator50px bgContrastGrey"></div> -->
        </div>

        <div class='image-grid-wrapper marBottomR1'>

            <div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <a href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleGallery.php');" class='aspect-img' style='background-image: url(/img/dev-static-img-grid/01.jpg);'></a>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <a href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleGallery.php');" class='aspect-img' style='background-image: url(/img/dev-static-img-grid/02.jpg);'></a>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <a href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleGallery.php');" class='aspect-img' style='background-image: url(/img/dev-static-img-grid/03.jpg);'></a>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <a href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleGallery.php');" class='aspect-img' style='background-image: url(/img/dev-static-img-grid/04.jpg);'></a>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <a href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleGallery.php');" class='aspect-img' style='background-image: url(/img/dev-static-img-grid/05.jpg);'></a>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <a href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleGallery.php');" class='aspect-img' style='background-image: url(/img/dev-static-img-grid/06.jpg);'></a>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <a href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleGallery.php');" class='aspect-img' style='background-image: url(/img/dev-static-img-grid/07.jpg);'></a>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <a href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleGallery.php');" class='aspect-img' style='background-image: url(/img/dev-static-img-grid/08.jpg);'></a>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <a href="javascript:void(0);" onclick="showModal('/incs/modals/modalLifestyleGallery.php');" class='aspect-img' style='background-image: url(/img/dev-static-img-grid/09.jpg);'></a>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <div class='aspect-img' style='background-image: url(/img/dev-static-img-grid/10.jpg);'></div>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <div class='aspect-img' style='background-image: url(/img/dev-static-img-grid/11.jpg);'></div>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <div class='aspect-img' style='background-image: url(/img/dev-static-img-grid/12.jpg);'></div>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <div class='aspect-img' style='background-image: url(/img/dev-static-img-grid/13.jpg);'></div>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <div class='aspect-img' style='background-image: url(/img/dev-static-img-grid/14.jpg);'></div>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <div class='aspect-img' style='background-image: url(/img/dev-static-img-grid/15.jpg);'></div>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <div class='aspect-img' style='background-image: url(/img/dev-static-img-grid/16.jpg);'></div>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <div class='aspect-img' style='background-image: url(/img/dev-static-img-grid/17.jpg);'></div>
                </div>
            </div><div class='img-grid-pad-wrapper xs-six md-four lg-six'>
                <div class='image-grid-img-wrapper'>
                    <div class='square-aspect-dummy'></div>
                    <div class='aspect-img' style='background-image: url(/img/dev-static-img-grid/18.jpg);'></div>
                </div>
            </div>

        </div>
        <!-- <div class='sm-twelve'><a href='#' class='black-button'>Load More</a></div> -->
    </div>

</div>

<script>
    $('.events-list-btn, .event-list-close').on('click', function () {
        $('.event-view-all-holster').toggleClass('truncate').toggleClass('expand');
        $('.events-list-btn, .event-list-close, .event-view-all-holster-top').toggleClass('hide');
        $('.events-list-bg').toggleClass('hide');
        $('.lifestyle-content-wrapper').toggleClass('landing-margin');
    });

    $('#lifestylePosts').jscroll({nextSelector: 'a.scroll:last'});
</script>

<script>
    $(document).ready(function () {
        $(".image-grid-wrapper .img-grid-pad-wrapper:first-child .aspect-img").addClass('img-grid-first-corner');
        $(".image-grid-wrapper .img-grid-pad-wrapper:last-child .aspect-img").addClass('img-grid-last-corner');
    });
</script>

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
