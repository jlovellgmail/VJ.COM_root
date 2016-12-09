<!-- Navgivation -->
<?php include '/incs/nav.php'; ?>
<?php
//$PID = $AmbassadorPost->getVar('PID');
$AID = $AmbassadorPost->getVar('AID');
$Title = $AmbassadorPost->getVar('Title');
$urlTitle = str_replace(' ', '-', $Title);
$dateObj = new DateTime($AmbassadorPost->getVar('PostDate'));
$PostDate = $dateObj->format('M dS, Y');
$ImgUrl = $AmbassadorPost->getImgUrl();
$HeroImgUrl = $AmbassadorPost->getHeroImgUrl();
$PostContent = $AmbassadorPost->getVar("PostContent");
$facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=http://www.virgiljames.net/post.php?Title=$urlTitle&PermLink=$PermLink&PID=$PID";
$twitterUrl = "https://twitter.com/share?text=&url=http://www.virgiljames.net/post.php?Title=$urlTitle&PermLink=$PermLink&PID=$PID";

$AmbassadorPostOwner = new Ambassador();
$AmbassadorPostOwner->initialize($AID);
$ProfilePrevImg = $AmbassadorPostOwner->getProfilePrevImgUrl();



$HeroImg = $Ambassador->getProfileHeroImgUrl();
//print_r($HeroImg);
//exit();
if ($HeroImg == "") {
    $HeroImg = "/img/ambassadors_graphic.jpg";
}
/*if ($from == "ambassador") {
    $newsAndEvents = $Ambassador->getNewsAndEventsWithLeadAmb();
} else {
    $newsAndEvents = $Ambassador->getCommonNewsAndEvents();
}*/
?>

<?php if (isset($HeroImgUrl) && $HeroImgUrl != "") { ?>
<div class='landing-hero-wrapper'>
    <div class='block rel'>
        <div class='aspect-dummy-hero'></div>
        <div class='aspect-img aspect-img-hero' style="background: linear-gradient(rgba(0,0,0,0.25), rgba(0,0,0,0.25)), url(<?php echo $HeroImgUrl; ?>) no-repeat center; background-size: cover;">
            <div class="backBtnWrapper">

                <?php
                if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/ambassadors/") {
                    echo '<a href="/ambassadors/" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Ambassador Highlights</a>';
                }
                ?>

                <?php
                if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/ambassador/Lucia-Contreras/profile/") {
                    echo '<a href="/ambassador/Lucia-Contreras/profile/" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Lucia&apos;s Journal</a>';
                }
                ?>

                <?php
                if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/ambassador/Maya-Stewart/profile/") {
                    echo '<a href="/ambassador/Maya-Stewart/profile/" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Maya&apos;s Journal</a>';
                }
                ?>

                <?php
                if ($_SERVER['HTTP_REFERER'] == "http://www.virgiljames.net/ambassador/Rob-Ross/profile/") {
                    echo '<a href="/ambassador/Rob-Ross/profile/" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>Back</a>';
                }
                ?>

            </div>
            <div class="widthWrapper tableWrapper h100p">
                <div class="cellWrapper">
                    <span class="heroText ital size2"><?php echo $Title; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>

<div class='landing-hero-wrapper'>
    <div class='block rel'>
        <div class='aspect-dummy-hero'></div>
        <div class='aspect-img aspect-img-hero' style="background-color: #000;">
            <div class="widthWrapper tableWrapper h100p">
                <div class="cellWrapper">
                    <div class="backBtnWrapper">
                        <a href="" class="aWhite caps f-12px" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Back</a>
                    </div>
                    <span class="heroText ital size2"><?php echo $Title; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="ambPostWidthWrapper widthWrapper">
    <!--Div closed too early? Replaced on line 71 - JC - SEP 1 2015</div>-->
    <div class="sm-twelve lg-eight textLeft marBottom15">
        <!--TINYMCE CONTENT BEGIN-->
        <p><?php echo $PostContent; ?></p>
        <!--TINYMCE CONTENT END-->
    </div>

    <div class="lg-six textLeft marBottom15">
        <img class="postAuthorImg" src="<?php echo $ProfilePrevImg; ?>" alt="" />
        <span class="postDate size8">Posted <?php echo $PostDate; ?></span>
    </div><div class="lg-six textRight">
        <ul class="shareIcons size8 fw-400">
            <li><a href="<?php echo $facebookUrl; ?>" target="_blank"><i class="icon-facebook-squared"></i>Share</a></li>
            <li><a href="<?php echo $twitterUrl; ?>" target="_blank"><i class="icon-twitter-squared"></i>Tweet</a></li>
            <li><a href="javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());"><i class="icon-pinterest-squared"></i>Pin</a></li>
        </ul>
    </div>
</div>