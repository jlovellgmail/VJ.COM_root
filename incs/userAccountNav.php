<?php 
    if (isset($AmbName)&& $AmbName!=""){
        $DisplayName = $AmbName;
    } else {
        $DisplayName = $_SESSION["Name"];
    }
    
?>
<div class='navPlaceholder'></div>
<div class="bgWrapperLeaf userAccountBanner">
    <div class="rel block aboutLeafWrapper" style="background-image:url(http://www.virgiljames.net/img/bg/cart_header_image.jpg);"> 
        <div class="tableWrapper h100p" style='padding-bottom: 30px;'>
            <div class="cellWrapper">
                <div class="widthWrapper">
                    <div class="lg-twelve">
                        <?php if (($UsrPriv >= 80 && $UsrPriv < 100)||(isset($adminEdit) && $adminEdit) ) { ?>
                            <div class="userAccountImage">
                                <?php if (isset($ProfilePrevImg) && $ProfilePrevImg != "") { ?>
                                    <img src="<?php echo $ProfilePrevImg; ?>" alt="" class="ambImg" width="220" />
                                <?php } else { ?>
                                    <img src="http://placehold.it/350x350&txt=Preview" alt="" class="ambImg" width="220" />
                                <?php } ?>
                                <img class="ambCardSq ambCardSq240" src="/img/ambassadors/ambassador_profile_image.png" />
                            </div>
                            <div class="textLeft userAccountTitle">
                                <h1 class="heroText">WELCOME</h1>
                                <!--<span class="heroText ital size2"></span>-->
                                <span class="heroText ital size2"><?php echo $DisplayName; ?></span>
                            </div>
                        <?php } else { ?>
                            <div class="row userAccountTitle">
                                <div class="md-twelve lg-six">
                                    <h1 class="heroText">WELCOME</h1>
                                <!--<span class="heroText ital size2"></span>-->
                                    <span class="heroText ital size2"><?php echo $_SESSION["Name"]; ?></span>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (!isset($adminEdit) || !$adminEdit) {
                            ?>

                            <div class="userAccountNav <?php if ($UsrPriv <= 79 || $UsrPriv == 100) { ?> textCenter <?php } ?>"     >
                               <!-- <a class="<?php //echo ($page2 == "userInfo" ? "active" : "") ?>" href="user/info.php">User Info</a>
                                <a class="<?php //echo ($page2 == "userOrders" ? "active" : "") ?>" href="user/orders.php">Order History</a><span class="hidden-user-nav"><br/></span>-->
                                <?php if ($UsrPriv == 80) { ?>
                                    <a class="<?php echo ($page2 == "ambInfo" ? "active" : "") ?>" href="info.php">Ambassador Profile</a>
                                    <a class="<?php echo ($page2 == "ambEvents" ? "active" : "") ?>" href="ambassador/events.php">Events</a>
                                    <?php /*<a class="<?php echo ($page2 == "ambNews" ? "active" : "") ?>" href="ambassador/news.php">News</a>*/ ?>
                                    <a class="<?php echo ($page2 == "ambInspirations" ? "active" : "") ?>" href="ambassador/inspirations.php">Inspiration</a>
                                    <a class="<?php echo ($page2 == "ambPosts" ? "active" : "") ?>" href="ambassador/posts/journal-posts.php">Journal Posts</a>
                                    <a class="<?php echo ($page2 == "ambSales" ? "active" : "") ?>" href="#">Sales</a>
                                <?php } ?>
                                    
                            </div>
                        <?php }else {
                            ?>
                            <div class="userAccountNav" >
                                <a class="<?php echo ($page2 == "ambInfo" ? "active" : "") ?>" href="info.php">Ambassador Profile</a>
                                <a class="<?php echo ($page2 == "ambEvents" ? "active" : "") ?>" href="ambassador/events.php">Events</a>
                                <?php /*<a class="<?php echo ($page2 == "ambNews" ? "active" : "") ?>" href="ambassador/news.php">News</a>*/ ?>
                                <a class="<?php echo ($page2 == "ambInspirations" ? "active" : "") ?>" href="ambassador/inspirations.php">Inspiration</a>
                                <a class="<?php echo ($page2 == "ambPosts" ? "active" : "") ?>" href="ambassador/posts/journal-posts.php">Journal Posts</a>
                                <a class="<?php echo ($page2 == "ambSales" ? "active" : "") ?>" href="#">Sales</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>