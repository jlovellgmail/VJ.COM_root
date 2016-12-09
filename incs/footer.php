<?php include $_SERVER['DOCUMENT_ROOT'] .'/incs/modalFrame.php'; ?>
<div class="bgWrapper footerBgWrapper footerGrey sdFooter">
    <div class="widthWrapper h100p">
        <div class="tableWrapper h100p">
            <div class="cellWrapper">
                <div class ="leftFooterColumn">
                    <ul class="socialIcons">
                        <li><a href="https://twitter.com/virgiljames_" target="_blank"><img src="/img/footer/grey/twitter_sm_icon.png" alt="Twitter" /></a></li><!-- 
                     --><li><a href="https://www.facebook.com/virgiljamesdesign" target="_blank"><img src="/img/footer/grey/facebook_sm_icon.png" alt="Facebook" /></a></li><!-- 
                     --><li><a href="https://www.pinterest.com/virgiljamesbags/" target="_blank"><img src="/img/footer/grey/pinterest_sm_icon.png" alt="Pinterest" /></a></li><!-- 
                     --><li><a href="https://instagram.com/virgiljamesdesign/" target="_blank"><img src="/img/footer/grey/instagram_sm_icon.png" alt="Instagram" /></a></li>
                    </ul><ul class="footerLinks caps fw-400 sizeNavFoot">
                        <!-- <li><a class="footerLink caps footerGrey" href='/about.php'>About</a></li> -->
                        <li><a class="footerLink caps footerGrey" href='/terms.php'>Terms</a></li>
                        <li><button class="footerLink caps" onclick="showModal('/incs/modals/common/modalNewsletter.php');">Newsletter</button></li>
                        <li><button class="footerLink caps" onclick="showModal('/incs/modals/common/modalContact.php');">Contact</button></li>
                    </ul>
                </div><div class ="rightFooterColumn">
                    <span class="footerCopyright caps fw-300 size8">&copy; 2016 Virgil James</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php unset($_SESSION["er"]); ?>