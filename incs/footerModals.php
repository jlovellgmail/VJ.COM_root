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