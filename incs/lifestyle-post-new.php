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

<!-- Landing Hero -->
<div class='landing-hero-wrapper'>
    <div class='block rel'>
        <div class='aspect-dummy-hero'></div>
        <div class='aspect-img aspect-img-hero' style="background: linear-gradient(rgba(0,0,0,0.25), rgba(0,0,0,0.25)), url(/img/temp/coffee_cup.jpg) no-repeat center; background-size: cover;">
            <div class="widthWrapper tableWrapper h100p">
                <div class="cellWrapper">
                    <div class="backBtnWrapper">

                        <?php echo '<a href="/lifestyle/' . $PID . '" class="aWhite caps size8" style="line-height: 28px;"><i class="icon-left-dir"></i>&nbsp;Lifestyle Journal</a>'; ?>

                    </div>
                    <div class="heroText ital size2">The Third Wave of Coffee?</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="widthWrapper post-wrapper">
    <div class="post-paragraph xs-twelve lg-nine">
        <p>Thile learning that 93-year-old Renato Bialetti, the man behind the famous little octagonal Moka maker from Italy, was buried inside his iconic pot in February 2016, we started thinking about coffee and what it has become in the United States as of late. Coffee is a huge thing, from Portland to Los Angeles to DC. In fact, it is such a thing, it has a specific designation: the "third wave of coffee."</p>
        <p>This implies that there was a second wave and a first, and we shall get to that. But third things first. “Third wave” refers to the fact that the prerequisite pick-me-up of the populace has become an exalt- ed object of foodie desire and artisanal connoiseurship, aspiring to the highest form of culinary appreciation. Anecdotal evidence is plentiful. Go to pretty much any local urban coffee shop and you will discover café lattes and cappuchinos that cost $6 and upwards — but they will have extravagant foam designs. You don’t just order a shot of espresso; you will have a choice: bold, mild, non-acidic.</p>
    </div>

    <div class='post-image xs-twelve'>
        <div class='img-breakline-top'>
            <div class='img-breakline-title'>
                <span>Coffee Goes Artisanal</span>
            </div>
        </div>
        <img class='post-image-img leafCorners2' src='/img/temp/bialetti-moka-maker.jpg' alt='' />
        <p class='post-image-subtitle'>The iconic, octagonal Bialetti coffee maker<span>&nbsp;</span><span class='post-image-credit'>Photo: John Doe</span></p>
    </div>

    <div class="post-paragraph xs-twelve lg-nine">
        <p>Regular coffee? The latest de rigueur iteration is cold-brewed, single origin, or mixed with top quality butter. You will hear aficionados discussing notes of honey, grass and tobacco, the way they would with a Cotes du Rhone. You can attend tastings or cuppings, a practice that “involves deeply sniffing the coffee, then loudly slurp- ing the coffee so it spreads to the back of the tongue,” according to Wikipedia. This used to be done by professional coffee tasters. Now it’s your neighbors, buying single-roast origin beans whose labels sport not just the names of the farms they hail from but the names of the roasters. It’s really a lot like the micro-brewing of beer or farm-to-table cuisine. Coffee now enjoys a lofty status as artis- anal commodity like wine.</p>
        <p>It’s a certainly long way from Folger’s (maverick of the first wave). It’s even a long way from Starbucks and Peet’s (the harbingers of the second wave). The big names who ushered in this third wave and revolutionized coffee much the way Peet’s and Starbucks did in the 1980s, are referred to as the “Big Three:” Intelligentsia, Counter Culture Coffee and Stumptown. Now there are others. Many others.</p>
        <p>At Grand Central Market in Downtown Los Angeles, G&amp;B Coffee serves its espresso with a chaser of carbonated tea that tastes like Kombucha or a Lambic. They serve no sugar, which would alter the pure taste of the beans. Instead you get simple syrup. Everyman Coffee in NYC does not have a menu posted. But they will hand you a list of the day’s signature offerings upon request. Among their creations that have reached cult status: the Espresso Old Fash- ioned, which combines espresso with grapefruit bitters and simple syrup.</p>
    </div>

    <div class='post-image xs-twelve'>
        <div class='img-breakline-top'>
            <div class='img-breakline-title'>
                <span>Small Quantity, Bold Taste</span>
            </div>
        </div>
        <img class='post-image-img leafCorners2' src='/img/temp/coffee-collage.jpg' alt='' />
        <p class='post-image-subtitle'>At Not Just Coffee, they’re focused on quality over quanitity and storefront&nbsp;atmosphere.<span>&nbsp;</span><span class='post-image-credit'>Photo: John Doe</span></p>
    </div>

    <div class="post-paragraph xs-twelve lg-nine">
        <p>Madcap Coffee in Grand Rapids, MI, devoted to building strong relationships with farmers and telling their stories, has introduced a concept for 2016 where every month a barista gets to curate a menu. So you might encounter an espresso-based Moscow Mule or a latte made with cereal milk and grapefruit pineapple lavender soda. As you can see, there are the purists, obsessing over unadulterated bean flavor and those who work  like craft cocktail mixologists, inventing drinks that redefine good ' Joe in ways never dreamed of before.</p>
        <p>While many people with the funds and desire to afford “third wave” coffee are just now hopping on board, others are already leaving the train station due to the arrival of big conglomerates who bought up their beloved (former) indie brands. Stumptown and Intelligentsia have been swallowed up by Peet’s, a part of Luxembourg-based conglomerate JAB. And hip La Colombe was bought by Chobani. So aficionados have to go smaller and smaller.</p>
    </div>

    <div class='post-image xs-twelve'>
        <div class='img-breakline-top'>
            <div class='img-breakline-title'>
                <span>America's Favorite Brand</span>
            </div>
        </div>
        <div class="post-video">
            <iframe width="640" height="360" src="https://www.youtube.com/embed/hwPOEJ-CjOQ" frameborder="0" allowfullscreen></iframe>
        </div>
        <!--<img class='post-image-img leafCorners2' src='/img/temp/cappuchino1800x1200.jpg' alt='' />-->
        <p class='post-image-subtitle'>Coffee now enjoys a status as artisanal commodity,&nbsp;like&nbsp;wine.<span>&nbsp;</span><span class='post-image-credit'>Photo: John Doe</span></p>
    </div>

    <div class="post-paragraph xs-twelve lg-nine">
        <p>Meanwhile, Folgers, according to Bloomberg Business Journal is still America’s favorite brand, followed by Maxwell House – just like they were in the 1800s, when these American household names mass marketed affordable coffee, a drink that was until that time the prerogative of the upper classes. Coffee became mainstream, middle class and ubiquitous in American kitchens. And Starbucks shows no sign of slowing down. In fact, the chain's CEO Howard Schultz just announced they are poised to open their first outpost in Milan, Italy. He's coming full circle. After all, it was a trip to that country 33 years ago that gave him the idea to bring quality coffee to the masses in the U.S.</p>
        <p>Like its game-changing predecessor Peet's in 1966, Starbucks peddled artisanal, small-batch, high-quality coffee in small coffee shops. When this notion went mass market and became completely homogenized, the third wave rolled around; as early as 2002 when Trish Skeie of Wrecking Ball Coffee Roasters coined the phrase in an article.</p>
        <p>Trends come and go. In 1969 in Berkeley, we had Peetniks. In the late '90s, we were gifted with the term "barista." Now we have coffee ambassadors. We’re curious as to what the fourth wave will brew up.</p>
    </div>

	<div class='post-image xs-twelve'>
		<div class='img-breakline-top'>
			<div class='img-breakline-title'>
				<span>Small Quantity, Bold Taste</span>
			</div>
		</div>
		<div class="owl-carousel">
			<div>
				<img class='post-image-img leafCorners2' src='/img/temp/cafe-interior.jpg' alt='' />
				<p class='post-image-subtitle'>Proin viverra nunc sit amet auctor&nbsp;commodo.<span>&nbsp;</span><span class='post-image-credit'>Photo: John Doe</span></p>
				<div class='img-breakline-bottom'></div>
			</div>
			<div>
				<img class='post-image-img leafCorners2' src='/img/temp/cafe-lattes.jpg' alt='' />
				<p class='post-image-subtitle'>Coffee now enjoys a status as artisanal commodity,&nbsp;like&nbsp;wine.<span>&nbsp;</span><span class='post-image-credit'>Photo: John Doe</span></p>
				<div class='img-breakline-bottom'></div>
			</div>
			<div>
				<img class='post-image-img leafCorners2' src='/img/temp/drip-coffee-maker.jpg' alt='' />
				<p class='post-image-subtitle'>Integer sit amet libero non augue rutrum laoreet sit amet quis&nbsp;lectus.<span>&nbsp;</span><span class='post-image-credit'>Photo: John Doe</span></p>
				<div class='img-breakline-bottom'></div>
			</div>
			<div>
				<img class='post-image-img leafCorners2' src='/img/temp/foam-art-with-succulent.jpg' alt='' />
				<p class='post-image-subtitle'>Coffee now enjoys a status as artisanal commodity,&nbsp;like&nbsp;wine.<span>&nbsp;</span><span class='post-image-credit'>Photo: John Doe</span></p>
				<div class='img-breakline-bottom'></div>
			</div>
		</div>
	</div>

</div>

<script src="/js/owl/owl24b/owl.carousel.js"></script>
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop: true,
            nav: true,
            items: 1,
            margin: 15,
            center:true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
			autoplay:true,
			autoplayTimeout:5000,
			autoplayHoverPause:true
        })
    });
</script>