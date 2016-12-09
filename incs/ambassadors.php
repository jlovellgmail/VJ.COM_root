<!-- Navgivation -->
<?php include '/incs/nav.php'; ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath.'/classes/AmbassadorList.class.php';
include $rootpath.'/classes/AmbassadorPost.class.php';
include_once($rootpath . '/classes/Image.class.php');

unset($_SESSION["er"]);
$AmbassadorList = new AmbassadortList();

$ambassadors = $AmbassadorList->getAmbassadors();
$leadAmbassador;
foreach ($ambassadors as $ambassador) {
    $RoleTxt = $ambassador->getRoleTxt();
    if ($RoleTxt == "Lead Ambassador") {
        $leadAmbassador = $ambassador;
    }
}
//$LAID = $leadAmbassador->getVar("AID");
?>




<div class='landing-hero-wrapper bg-fixer h100vh index-slide ambsLeafWrapper'>
    <!-- <div class='ambsLeafWrapper h100p'>
        <div class="widthWrapper tableWrapper h100p">
            <div class="cellWrapper">
                <div class="sm-twelve lifestyle-title-block heroText textLeft">
                    <h1 class="caps size2 fw-400">Ambassadors</h1>
                    <span class='fw-300 zI3 heroText' style='font-size: 18px;'>Meet your personal guides to Virgil James.</span>
                </div>
            </div>
        </div>
    </div> -->
    <div class='flip-card-blur-bg flip-card-blur-bg-ambassador'></div>
    <div class='flipcard-01 flipcard'>
        <div class='aspect-dummy-two-thirds'></div>
        <div class='aspect-img'>
            <img class='postcard-stamp' src='/img/index/postcardstamps-buenosaires.png' alt='' />
            <div class='card-divider'></div>
            <div class='xs-twelve lg-six h100p'>
                <div class='card-left'>
                    <p>Hi Virgil,</p>
                    <p>This is the best idea ever!  So, one of your Ambassadors will meet with me – alone, or at a group event – and introduce all of your products! This is like a personal stylist, without the cost! And to think that they actually know (and use) your products. By the way, how did you ever assemble such an interesting and smart group of Ambassadors? I’m so impressed!</p>
                    <p>Your best customer!</p>
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
    <div class='gps-lockup'>
        <div class='lockup-topline'>
            <img class='flippy-01 stampy-mc-stampface' src='/img/index/postcard-icon.png' alt='' />
        </div>
        <div class='lockup-bottomline'>
            <span class="heroText caps size3 fw-300 spaceLetters">VJ </span>
            <span class="heroText caps size3 fw-600 spaceLetters">Ambassadors</span>
        </div>
    </div>
    <div class='scroll-arrow-indicator'><i class='icon-angle-down'></i></div>
</div>


<div class='scroll-down-to'></div>

<!-- Ambassador Cards -->
<div class='bgWrapper'>

    <div class='widthWrapper marBottom60 marTop60' style='max-width: 1100px; margin-left: auto; margin-right: auto;'>
        <div class='anti-padding-wrapper' style='margin: 0 -15px;'>
            <?php
            $count = 0;
            foreach ($ambassadors as $ambassador) {
                $AID = $ambassador->getVar("AID");
                if ($ambassador->getVar("Hidden")) {
                    continue;
                }
                $FName = $ambassador->getFName();
                $LName = $ambassador->getLName();
                $Email = $ambassador->getEmail();
                $Name = $FName . " " . $LName;
                $RoleTxt = $ambassador->getRoleTxt();

                $dateObj = new DateTime($ambassador->getDateRegistered());
                $DateRegistered = $dateObj->format('M d, Y');
                $ProfilePrevImg = $ambassador->getProfilePrevImgUrl();
                $PermLink = $ambassador->getVar("PermLinkKey");
                $LocationTxt = $ambassador->getLocationTxt();
                if ($RoleTxt == "Ambassador") {
                    ?><!-- 
                 --><a href='/ambassador.php?PermLink=<?php echo $PermLink; ?>' class='amb-wrapper xs-twelve md-six lg-four'>
                        <div class='amb-padding-wrapper'>
                            <div class='amb-img-wrapper aspect-img-wrapper xs-twelve marBottom15 ' style='border: solid 10px #fff; box-shadow: rgba(0,0,0,0.35) 0 8px 12px; max-width: 320px;'>
                                <div class='square-aspect-dummy'></div>
                                <div class='aspect-img' style='background: url(<?php echo $ProfilePrevImg; ?>) no-repeat center; background-size: cover;'></div>
                            </div>
                            <div class='xs-twelve amb-name-wrapper' style='border-bottom: 1px solid #bfbdbb; padding: 0 15px; max-width: 320px;'>
                                <!-- <span class='amb-meet-plaque' style='line-height: 1.1em; position: absolute; top: -12px; right: 50%; margin-right: -30px; width: 60px; background-color: #fff; color: #52504f; font-family: "minion-pro-subhead",serif; font-style: italic; font-size: 18px;'>Meet</span> -->
                                <span class='block' style='font-family: "minion-pro-subhead",serif; font-size: 26px; font-style: italic; padding:0;'><?php echo $Name; ?></span>
                                <span class='block' style='font-family: "minion-pro-subhead",serif; font-size: 18px; font-style: italic; margin-bottom: 10px;'><?php echo $LocationTxt; ?></span>
                                <!-- <span style='position: absolute; bottom: 15px; left: 0; right: 0; color: #fff; font-family: "minion-pro-subhead",serif; font-size: 18px; font-style: italic; background-color: rgba(0,0,0,0.5); text-shadow: 0 2px 4px #000; line-height: 36px;'><?php echo $LocationTxt; ?></span> -->
                            </div>
                        </div>
                    </a><!-- 
                 --><?php
                } else {
                    $leadAmbassador = $ambassador;
                }
                $count++;
            }
            if ($count == 0) {
                echo "<tr><td colspan='6' class='text-center pad-20 font-16'>There are no Ambassadors.</td></tr>";
            }
            ?>
        </div>
    </div>
</div>

<script>
    $('.flippy-01').click(function () {
        $('.index-slide').toggleClass('flippyshow');
    })

    $(document).on('click', '.flip-card-blur-bg-ambassador', function () {
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
        $(".bg-fixer, .flip-card-blur-bg").css("background-attachment","scroll");
    } else {
        $(".bg-fixer, .flip-card-blur-bg").css("background-attachment","fixed");
    };

</script>