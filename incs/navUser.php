<?php if (isset($login) && $login) { ?>
    <div class="navDropdownContainer">
        <a href="#" class="navDropdownToggle">
            <i class="icon-torso"></i>
            <i class="icon-angle-down userHoverArrow <?php echo ($page == "userAccount" ? "hoverArrow" : "") ?>"></i>
            <i class="icon-down-dir <?php echo ($page == "userAccount" ? "hoverArrow" : "") ?>"></i>
        </a>
        <div class="navDropdown navDropdownUser" id="i_01">
            <div class="navDropdownOutside">
                <div class="navDropdownInside">
                    <ul class="navList">
                        <li <?php if (isset($page2 )&& $page2 == "userInfo"){ echo "class='active'";} ?> ><a href="user/info.php">User&nbsp;Info</a></li>
                        <li <?php if (isset($page2 )&& $page2 == "userOrders"){ echo "class='active'";} ?>><a href="user/orders.php">Order History</a></li>
                        <?php if (isset($UsrPriv) && $UsrPriv>=80 && $UsrPriv<90){ ?>
                        <li <?php if (isset($page2 )&& $page2 == "ambInfo"){ echo "class='active'";} ?>><a href="info.php">Ambassador</a></li>
                        <?php /*<li <?php if (isset($page2 )&& $page2 == "ambEvents"){ echo "class='active'";} ?>><a href="ambassador/events.php">Events</a></li>
                        <li <?php if (isset($page2 )&& $page2 == "ambNews"){ echo "class='active'";} ?>><a href="ambassador/news.php">News</a></li>
                        <li <?php if (isset($page2 )&& $page2 == "ambFavorites"){ echo "class='active'";} ?>><a href="ambassador/favorites.php">Favorites</a></li>
                        <li <?php if (isset($page2 )&& $page2 == "ambPosts"){ echo "class='active'";} ?>><a href="ambassador/posts.php">Posts</a></li>*/?>
                        <?php }?>
                        <?php if (isset($UsrPriv) && $UsrPriv>=90) {  ?>
                            <li <?php if (isset($page2 )&& $page2 == "admin"){ echo "class='active'";} ?>><a href="/admin/ambassador-posts.php?type=L">Content Admin</a></li>
                        <?php } ?>
                        <li class="sep">&nbsp;</li>
                        <li class="bottom"><a href="/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="navDropdownContainer">
        <a href="/login.php" class="navDropdownToggle"><i class="icon-torso"></i></a>
    </div>
<?php } ?>