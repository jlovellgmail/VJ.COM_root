<h1 class="caps fw-700">Sign In</h1>
<div class="leftLogin leftCol lg-six">
    <h2 class="ital fw-400">Returning Customer</h2>
    <form id="signInFormCart" class="generalForm" name="signInFormCart" method="post" action="/login_action.php?from=checkout">
        <label for="userEmail">Email:</label>
        <input id="email" name="email" type="text" value="" />
        <label for="userPass">Password:</label>
        <input id="passwd" name="passwd" type="password" value="" />
        <button class="fillBtn mobileElement" form="signInForm" id="cartLoginBtn" onClick="cartLogin()">Sign In</button>
    </form>
</div><div class="rightLogin rightCol lg-six">
    <h2 class="ital fw-400">New Customer</h2>
    <br>
    <p>Checkout without signing in. During Checkout you can create an account using the information you provide for this transaction.</p>
    <a class="fillBtn mobileElement" href="setUserMode.php?mode=new">Checkout as a New User</a>
    <br>
    <a class="fillBtn mobileElement" href="setUserMode.php?mode=guest">Checkout as Guest</a>
</div>
<div class="desktopElement lg-twelve">
    <div class="signInButtonWrapper lg-six">
        <button class="fillBtn" form="signInForm" id="cartLoginBtn" onClick="cartLogin()">Sign In</button>
    </div><div class="guestButtonWrapper lg-six">
        <a class="fillBtn" href="setUserMode.php?mode=new">Checkout as a New User</a>
        <br><br>
        <a class="fillBtn" href="setUserMode.php?mode=guest">Checkout as Guest</a>
    </div>
</div>