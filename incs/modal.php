<div class="modalOverlay hide">
    <div class="modalContainer">
        <div class="modalWindow">
            <button class="modalClose caps fw-400 size5"><i class="icon-cancel-1 size7"></i></button>

            <div id="modalContact" class="modalContent hide">
                <h6 class="modalTitle caps fw-700 size6">Contact Us</h6>
                <div class="row" style="text-align: center;">
                    <div class="col sm-three md-two" style="text-align: left;"><p class="fw-700">Phone:</p></div><div class="col sm-nine md-six" style="text-align: left;"><p><a href="tel:1-323-336-4122">(323) 336-4122</a></p></div>
                </div>
                <div class="row" style="text-align: center;">
                    <div class="col sm-three md-two" style="text-align: left;"><p class="fw-700">Email:</p></div><div class="col sm-nine md-six" style="text-align: left;"><p><a href="mailto:support@virgiljames.com">support@virgiljames.com</a></p></div>
                </div>
                <div class="row" style="text-align: center;">
                    <div class="col sm-three md-two" style="text-align: left;"><p class="fw-700">Mail:</p></div><div class="col sm-nine md-six" style="text-align: left;"><p>214 N. Cedros Avenue Solana&nbsp;Beach, CA&nbsp;92075</p></div>
                </div>
            </div>

            <div id="modalGuarantee" class="modalContent hide">
                <h6 class="modalTitle caps fw-700 size6">Guarantee</h6>
                <p>If your purchase is in its <span style="text-decoration: underline;">original</span> condition, we will buy it back for the original purchase price - for any reason or at any time.</p>
                <p>If your purchase has been <span style="text-decoration: underline;">used</span>, you may select one of the following options:</p>

                <div class="sm-one">
                    <div class="sm-one md-six"></div><span>1.</span>
                </div><div class="sm-eleven">
                    <p>As the original owner, we will repair your purchase, as best we can, at no charge to you.</p>
                </div>

                <div class="sm-one">
                    <div class="sm-one md-six"></div><span>2.</span>
                </div><div class="sm-eleven">
                    <p>As the original owner, if your purchase is beyond repair or you no longer want it, we will provide a merchandise credit equal to 33% of the original purchase price.</p>
                </div>

            </div>

            <div id="modalShipping" class="modalContent hide">
                <h6 class="modalTitle caps fw-700 size6">Shipping</h6>
                <p>All purchases are shipped prepaid to your mailing address by UPS 2<sup>nd</sup> Day in the United States, or by expedited international carriers (DHL, FEDEX, etc.) in the rest of the world.</p>
                <p>Return shipping labels are included in the event you want to immediately return your purchase. Unless special arrangements are made, customers are responsible for all non-US customs and/or duty charges.</p>
            </div>

            <div id="modalPrivacy" class="modalContent hide">
                <h6 class="modalTitle caps fw-700 size6">We take your privacy seriously.</h6>
                <p>We respect your privacy. All personal information collected on our website is used solely to manage your user experience. We will never share or sell your personal information.</p>
                <p>Financial information is used only to process order transactions, and is not saved by Virgil James.</p>
                <p>If you register with Virgil James, it's easy to modify your saved information or remove it entirely by clicking on the Account icon at the top of any page.</p>
                <p>If you login, we use temporary session cookies to manage your user experience. Please access your device’s Security Settings to manage these cookies.</p>
                <p>If you have any questions regarding our Privacy Policy or practices, please send an email to: <a href="mailto:privacy@virgiljames.com">privacy@virgiljames.com.</a></p>
            </div>
            <div id="modalCheckout" class="modalContent hide">





                <h1 class="caps fw-700">Sign In</h1>
                <div class="leftLogin leftCol lg-six">
                    <h2 class="ital fw-400">Returning Customer</h2>
                    <form id="signInFormCart" class="generalForm" name="signInFormCart" method="post" action="/login_action.php?from=checkout">
                        <label for="userEmail">Email:</label>
                        <input id="email" name="email" type="text" value="" />
                        <label for="userPass">Password:</label>
                        <input id="passwd" name="passwd" type="password" value="" />
                        <button class="fillBtn mobileElement" form="signInForm" id="cartLoginBtn" onclick="cartLogin()">Sign In</button>
                    </form>
                </div><div class="rightLogin rightCol lg-six">
                    <h2 class="ital fw-400">Guest Customer</h2>
                    <p>Checkout without signing in. During Checkout you can create an account using the information you provide for this transaction.</p>
                    <a class="fillBtn mobileElement" href="checkout.php">Continue</a>
                </div>
                <div class="desktopElement lg-twelve">
                    <div class="signInButtonWrapper lg-six">
                        <button class="fillBtn" form="signInForm" id="cartLoginBtn" onclick="cartLogin()">Sign In</button>
                    </div><div class="guestButtonWrapper lg-six">
                        <a class="fillBtn" href="checkout.php">Continue</a>
                    </div>
                </div>



            </div>
            <div id="modalReviewCheckout" class="modalContent hide">
                <h1 class="caps fw-700">Sign In</h1>
                <div class="leftLogin leftCol lg-six">
                    <h2 class="ital fw-400">Returning Customer</h2>
                    <form id="signInFormReview" class="generalForm" name="signInFormReview" method="post" action="/login_action_cart.php">
                        <label for="userEmail">Email:</label>
                        <input id="reviewModalEmail" name="email" type="text" value="" />
                        <label for="userPass">Password:</label>
                        <input id="reviewModalPassw" name="passwd" type="password" value="" />
                        <button class="fillBtn mobileElement" form="signInForm" id="cartLoginBtn" onclick="reviewLogin()">Sign In</button>
                    </form>
                </div><div class="rightLogin rightCol lg-six">
                    <h2 class="ital fw-400">Guest Customer</h2><br />
                    <p>The email address entered is already in use on Virgil James. You may login to this account using the form on the left, you may also continue as a guest below.</p>
                    <a class="fillBtn mobileElement" href="javascript:placeOrd('<?php echo $PaymMethod; ?>');">Continue</a>
                </div>
                <div class="desktopElement lg-twelve">
                    <div class="signInButtonWrapper lg-six">
                        <button class="fillBtn" form="signInForm" id="cartLoginBtn" onclick="reviewLogin()">Sign In</button>
                    </div><div class="guestButtonWrapper lg-six">
                        <a class="fillBtn" href="javascript:placeOrd('<?php echo $PaymMethod; ?>');">Continue</a>
                    </div>
                </div>



            </div>

            <div class="modalContent modalContentCart hide">
                <div class="row">
                    <div class="lg-five">
                        <h6 class="modalTitle">Login / Register</h6>
                        <div class="textCenter">
                            <button type="button" class="fillBtn"  onclick="window.location = '/login.php?from=checkout';">CONTINUE</button>
                        </div>
                    </div><div class="lg-two" style="font-size:16px; padding-top:33px; font-weight:bold; text-align:center;">OR</div><div class="lg-five">
                        <h6 class="modalTitle">Guest Checkout</h6>
                        <div class="textCenter">
                            <a href="checkout.php" class="fillBtn">CONTINUE</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="cartAddrModal" onclick="alert('Savvas')" class="modalContent hide">
                <h6 class="modalTitle">Add Shipping Address</h6>
                
            </div>

        </div>
    </div>
</div>



<div class="bgWrapper footerBgWrapper footerGrey sdFooter">
    <div class="widthWrapper">
        <div class="tableWrapper">
            <div class="cellWrapper">
                <div class ="leftFooterColumn col lg-nine">
                    <ul class="socialIcons">
                        <li><a href="https://twitter.com/virgiljames_" target="_blank"><img src="/img/footer/grey/twitter_sm_icon.png" alt="Twitter" /></a></li><!-- 
                        --><li><a href="https://www.facebook.com/virgiljamesdesign" target="_blank"><img src="/img/footer/grey/facebook_sm_icon.png" alt="Facebook" /></a></li><!-- 
                        --><li><a href="https://www.pinterest.com/virgiljamesbags/" target="_blank"><img src="/img/footer/grey/pinterest_sm_icon.png" alt="Pinterest" /></a></li><!-- 
                        --><li><a href="https://instagram.com/virgiljamesdesign/" target="_blank"><img src="/img/footer/grey/instagram_sm_icon.png" alt="Instagram" /></a></li>
                    </ul><ul class="footerLinks footShow caps fw-400 sizeNavFoot">
                        <li><button class="footerLink caps" href="#" onclick="openModal('modalContact');">Contact</button></li>
                        <li><button class="footerLink caps" href="#" onclick="openModal('modalGuarantee');">Guarantee</button></li>
                        <li><button class="footerLink caps" href="#" onclick="openModal('modalShipping');">Shipping</button></li>
                        <li><button class="footerLink caps" href="#" onclick="openModal('modalPrivacy');">Privacy</button></li>
                    </ul>
                </div><div class ="rightFooterColumn caps fw-300 size8 col lg-three">
                    <span class="footerCopyright">&copy; 2015 Virgil James</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php unset($_SESSION["er"]); ?>