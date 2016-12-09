<!-- Navgivation -->
<?php include '/incs/nav.php'; ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
//$PID = $AmbassadorPost->getVar('PID');
$AID = $AmbassadorPost->getVar('AID');
$Title = $AmbassadorPost->getVar('Title');
$urlTitle = str_replace(' ', '-', $Title);
$urlTitle = str_replace('?', '-', $Title);
$dateObj = new DateTime($AmbassadorPost->getVar('PostDate'));
$PostDate = $dateObj->format('M dS, Y');
$ImgUrl = $AmbassadorPost->getImgUrl();
$HeroImgUrl = $AmbassadorPost->getHeroImgUrl();
$PostContent = $AmbassadorPost->getVar("PostContent");
$facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=http://www.virgiljames.net/lifestyle-post.php?PermLink=$PermLink&Title=$urlTitle&PID=$PID";
$twitterUrl = "https://twitter.com/share?text=&url=http://www.virgiljames.net/lifestyle-post.php?PermLink=$PermLink&Title=$urlTitle&PID=$PID";

?>

<!-- Landing v2 -->
<?php if (isset($HeroImgUrl) && $HeroImgUrl != "") { ?>
<div class='landing-hero-wrapper'>
    <div class='block rel'>
        <div class='aspect-dummy-hero'></div>
        <div class='aspect-img aspect-img-hero' style="background: linear-gradient(rgba(0,0,0,0.25), rgba(0,0,0,0.25)), url(<?php echo $HeroImgUrl; ?>) no-repeat center; background-size: cover;">
            <div class="widthWrapper tableWrapper h100p">
                <div class="cellWrapper">
                    <div class="backBtnWrapper">

                            <?php
                                echo '<a href="/lifestyle/' . $PID . '" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Lifestyle Journal</a>';
                            ?>

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
        <div class="dropcap"><p><?php echo $PostContent; ?></p></div>
        <!--TINYMCE CONTENT END-->
    </div>

    <div class="lg-six textLeft marBottom15">
        <span class="postDate size8">Posted <?php echo $PostDate; ?></span>
    </div><div class="lg-six textRight">
        <ul class="shareIcons size8 fw-400">
            <li><a href="<?php echo $facebookUrl; ?>" target="_blank"><i class="icon-facebook-squared"></i>Share</a></li>
            <li><a href="<?php echo $twitterUrl; ?>" target="_blank"><i class="icon-twitter-squared"></i>Tweet</a></li>
            <li><a href="javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());"><i class="icon-pinterest-squared"></i>Pin</a></li>
        </ul>
    </div>
</div>