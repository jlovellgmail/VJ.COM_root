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