<?php session_start(); ?>
<div class="loginForm">
    <div class="title">Login</div>
    <br />
    <form class="generalForm" id="loginForm" action="/login_action.php" method="post">
        <?php
        if (isset($_SESSION["er"]) && $_SESSION["er"] != "") {
            switch ($_SESSION["er"]) {
                case "e":
                    echo "
                            <div class='alertMessage'>
                              Please enter your email and password.
                            </div>";
                    break;
                case "em":
                    echo "
                            <div class='alertMessage'>
                              Please enter a valid email address.
                            </div>";
                    break;
                case "pass":
                    echo "
                            <div class='alertMessage'>Your password and email login do not match</div>";
                    break;
                case "del":
                    echo "
                            <div class='alertMessage'>
                              This user is deleted.
                            </div>";
                    break;
                case "emex":
                    echo "
                            <div class='alertMessage'>
                              This email does not exist.
                            </div>";
                    break;
            }
        }
        ?>
        <label for="email_address" class="italic ">Email Address:</label>
        <input class="textField" type="email" id="email" name="email" />
        <label for="password" class="italic">Password:</label>
        <input class="textField" type="password" id="passwd" name="passwd" />
        <button type="button" class="textBtn toggleDivBtn" data-id="ChangePw"><small>Forgot Password?</small></button>
        <button style="position:absolute; right:0" type="submit" class="fillBtn caps" onclick="validateLoginForm();">Submit</button>
        <br><br><br>
    </form> 
    <br><br><br>
    <form class="generalForm" action="" id="ChangePw" style="display:none;">
        <div id="forgotPassDiv">
            <?php include "/incs/forgotPass.php"; ?>
        </div>
    </form>
</div>
