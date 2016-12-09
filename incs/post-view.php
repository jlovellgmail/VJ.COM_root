<!-- Navgivation -->
<?php 
include '/incs/nav.php';
include '/bitly/bitly.php';
 ?>

<?php
if ($postExist) {
    $urlTitle = str_replace(' ', '-', $Title);
    $urlTitle = str_replace('?', '-', $Title);
    $dateObj = new DateTime($Post->getVar('PostDate'));
    $PostDate = $dateObj->format('M j, Y');
    $SubTitle = $Post->getVar("SubTitle");

    $PostImg = $Post->getVar("ImgUrl");
    $PostImg = str_replace('\\', '/', $PostImg);
    $PostHeroImg = $Post->getVar("HeroImgUrl");
    $PostHeroImg = str_replace('\\', '/', $PostHeroImg);
    $Post->initializeBlocks();
    $postBlocks = $Post->getBlocks();
    $blockCount = $Post->getBlockCount();

    $PermLink = $_GET['PermLink'];
	$currentURI=$_SERVER['REQUEST_URI'];
	$PostUrlSEO = "http://www.virgiljames.net$currentURI";
	$PostUrlImgSEO = "http://www.virgiljames.net$PostHeroImg";
	
	$facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=http://www.virgiljames.net$currentURI";
	$twitterUrl = "https://twitter.com/share?text=$SubTitle&url=http://www.virgiljames.net$currentURI";
	$params['longUrl'] = "http://www.virgiljames.net$currentURI";
	$bitlyResults = bitly_get('shorten', $params);
	if (isset($bitlyResults["data"]["url"]) && $bitlyResults["data"]["url"]!="" ) {
		$CCShortUrl = $bitlyResults["data"]["url"];
		$twitterShortUrl = "https://twitter.com/share?text=" . $SubTitle . "%0a&url=" . $CCShortUrl;
	}else {
		$twitterShortUrl = $twitterUrl;
	}
	//change to get shares work -- see above code by christos
    //if ($from == "lifestyle") {
    //    $facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=http://www.virgiljames.net$currentURI";
    //    $twitterUrl = "https://twitter.com/share?text=&url=http://www.virgiljames.net/post-view.php?from=ambassador&PermLink=$PermLink&Title=$urlTitle&PID=$PID";
    //} else if ($from == "ambassador") {
     //   $facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=http://www.virgiljames.net/post-view.php?from=ambassador&PermLink=$PermLink&Title=$urlTitle&PID=$PID";
     //   $twitterUrl = "https://twitter.com/share?text=&url=http://www.virgiljames.net/post-view.php?from=ambassador&PermLink=$PermLink&Title=$urlTitle&PID=$PID";
    //}
}
?>

<!-- Landing Hero -->
<div class='landing-hero-wrapper'>
    <div class='block rel'>
        <div class='aspect-dummy-hero'></div>
        <div class='aspect-img aspect-img-hero' style="background: linear-gradient(rgba(0,0,0,0.25), rgba(0,0,0,0.25)), url(<?php echo $PostHeroImg; ?>) no-repeat center; background-size: cover;">
            <div class="backBtnWrapper">
                <?php
                if ($from == "lifestyle") {
                    echo '<a href="/lifestyle/' . $PID . '" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Lifestyle Journal</a>';
                } else if ($from == "ambassador") {
                    echo '<a href="' . $_SERVER['HTTP_REFERER'] . '" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>'.$FName.'&#39;s posts </a>';
                }
                ?>

            </div>
            <div class="hero-content-wrapper tableWrapper h100p">
                <div class="cellWrapper">
                    <div class="heroText ital size2"><?php echo $Title; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (count($postBlocks) > 0) {
    ?>
    <div class="widthWrapper post-wrapper">
        <?php
        foreach ($postBlocks as $Block) {
            $PBID = $Block->getVar("PBID");
            $blockContent = $Block->getVar("BlockContent");
            $mediaType = $Block->getVar("MediaType");
            $title = $Block->getVar("Title");
            $caption = $Block->getVar("Caption");
            $credit = $Block->getVar("Credit");
            $imgUrl = $Block->getVar("ImgUrl");
            $videoUrl = $Block->getVar("VideoUrl");
            if ($videoUrl != "") {
                include $rootpath . '/AutoEmbed/AutoEmbed.class.php';
                $AutoEmbed = new AutoEmbed();
                $result = $AutoEmbed->parseUrl($videoUrl);
                if ($result == 1) {
                    $vidEmbedCode = $AutoEmbed->getEmbedCode();
                }
            }
            ?>

            <div class="post-paragraph xs-twelve lg-nine">
                <?php echo $blockContent; ?>
            </div>

            <div class='post-image xs-twelve'>
                <?php if (isset($title) && $title != "") { ?>
                    <div class='img-breakline-top'>
                        <div class='img-breakline-title'>
                            <span><?php echo $title; ?></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($mediaType == "I" && (isset($imgUrl) && $imgUrl != "")) { ?>
                    <img class='post-image-img leafCorners2' src='<?php echo $imgUrl; ?>' alt='<?php echo $caption; ?>' />
                    <?php if (isset($caption) && $caption != "") { ?>    
                        <p class='post-image-subtitle'><?php echo $caption; ?><span>&nbsp;</span><?php if (isset($credit) && $credit != "") { ?> <span class='post-image-credit'>Photo: <?php echo $credit; ?></span><?php } ?></p>
                    <?php } ?>
                    <div class='img-breakline-bottom'></div>
                <?php } ?>
                <?php
                if ($mediaType == "S") {
                    $Block->initializeSlideshow();
                    $slideshow = $Block->getSlideshow();
                    $slideCount = $Block->getSlideshowCount();
                    if ($slideCount > 0) {
                        echo "<div class='owl-carousel'>";
                        $sCount = 1;
                        foreach ($slideshow as $Slide) {
                            $PSID = $Slide->getVar("PSID");
                            $caption = $Slide->getVar("Caption");
                            $credit = $Slide->getVar("Credit");
                            $sImgUrl = $Slide->getImgUrl();
                            ?>

                            <div>
                                <img class='post-image-img leafCorners2' src='<?php echo $sImgUrl; ?>' alt='<?php echo $caption; ?>' />
                                <?php if (isset($caption) && $caption != "") { ?>    
                                    <p class='post-image-subtitle'><?php echo $caption; ?><span>&nbsp;</span><?php if (isset($credit) && $credit != "") { ?> <span class='post-image-credit'>Photo: <?php echo $credit; ?></span><?php } ?></p>
                                <?php } ?>
                                <div class='img-breakline-bottom'></div>
                            </div>

                            <?php
                            $sCount++;
                        }
                        echo "</div>";
                    }
                    ?>
                    <!-- Slideshow goes here -->
                <?php } ?>
                <?php if ($mediaType == "V" && (isset($videoUrl) && $videoUrl != "")) { ?>
                    <div class="post-video">
                        <?php echo $vidEmbedCode; ?>
                        <!--<iframe width="640" height="360" src="<?php //echo $videoUrl;             ?>" frameborder="0" allowfullscreen></iframe>-->
                    </div>
                    <?php if (isset($caption) && $caption != "") { ?>    
                        <p class='post-image-subtitle'><?php echo $caption; ?><span>&nbsp;</span><?php if (isset($credit) && $credit != "") { ?> <span class='post-image-credit'>Photo: <?php echo $credit; ?></span><?php } ?></p>
                    <?php } ?>
                    <div class='img-breakline-bottom'></div>
                <?php } ?>

            </div>
        <?php } ?>
        <div class='post-footer xs-twelve lg-nine'>
            <div class="xs-five textLeft">
                <span class="postDate size8">Posted <?php echo $PostDate; ?></span>
            </div><div class="xs-seven textRight">
                <ul class="shareIcons size8 fw-400">
                    <li><a href="<?php echo $facebookUrl; ?>" target="_blank"><i class="icon-facebook-squared"></i>Share</a></li>
                    <li><a href="<?php echo $twitterShortUrl ?>" target="_blank"><i class="icon-twitter-squared"></i>Tweet</a></li>
                    <li><a href="javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());"><i class="icon-pinterest-squared"></i>Pin</a></li>
                </ul>
            </div>
        </div>

    </div>
<?php } ?>
<script src="/js/owl/owl24b/owl.carousel.js"></script>
<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: true,
            nav: true,
            items: 1,
            margin: 15,
            center: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            autoplay: false,
            autoplayTimeout: 10000,
            autoplayHoverPause: true
        })
    });
</script>