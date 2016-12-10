<?php
    // preorder site had this, and the original below was commented out:
    // include "modalFrame.php";

    // com root site has this:
    include $_SERVER['DOCUMENT_ROOT'] .'/incs/modalFrame.php';
?>
<div class="footerContainer">



    <div class="footerWidthWrapper">
        <div class="topBorder"></div>




        <div class ="leftFooterColumn">
            <ul class="socialIcons">
                <li><a href="https://twitter.com/virgiljames_" target="_blank"><img src="/img/footer/grey/twitter_sm_icon.png" alt="Twitter" /></a></li><!-- 
             --><li><a href="https://www.facebook.com/virgiljamesdesign" target="_blank"><img src="/img/footer/grey/facebook_sm_icon.png" alt="Facebook" /></a></li><!-- 
             --><li><a href="https://www.pinterest.com/virgiljamesbags/" target="_blank"><img src="/img/footer/grey/pinterest_sm_icon.png" alt="Pinterest" /></a></li><!-- 
             --><li><a href="https://instagram.com/virgiljamesdesign/" target="_blank"><img src="/img/footer/grey/instagram_sm_icon.png" alt="Instagram" /></a></li>
            </ul>
            <ul class="footerLinks caps fw-400 sizeNavFoot">
                <li><a class="footerLink" href='/terms.php'>Terms</a></li>
                <li><button class="footerLink" onclick="showModal('/incs/modals/common/modalNewsletter.php');">Newsletter</button></li>
                <li><button class="footerLink" onclick="showModal('/incs/modals/common/modalContact.php');">Contact</button></li>
            </ul>
        </div>

        <div class ="rightFooterColumn">
            &copy; 2016 Virgil James
        </div>




    </div>




</div>
<?php unset($_SESSION["er"]); ?>