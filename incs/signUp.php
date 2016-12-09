<h1 class="caps textLeft">Sign Up</h1>
<br />
<?php
if (isset($_SESSION["er"]) && $_SESSION["er"] != "") {
    switch ($_SESSION["er"]) {
        case "e":
            echo "
                        <div class='alertMessage'>
                          Please enter all required fields.
                        </div>";
            break;
        case "em":
            echo "
                        <div class='alertMessage'>
                          Please enter a valid email address.
                        </div>";
            break;
        case "cem":
            echo "
                        <div class='alertMessage'>
                          Email addresses do not match.
                        </div>";
            break;
        case "pw":
            echo "
                        <div class='alertMessage'>
						  Passwords do not match
						</div>";
            break;
        case "ue":
            echo "
                        <div class='alertMessage'>
                          This email address is already registered with Virgiljames.com
                        </div>";
            break;
		case "ud":
            echo "
                        <div class='alertMessage'>
                          This user has been deleted. Please contact customerservice@virgiljames.com
                        </div>";
            break;
        case "false":
            echo "
                        <div class='alertMessage'>
                          Registration successful
                        </div>";
            break;
    }
}
?>
<form class="generalForm" id="registerFrm" action="/register_action.php" method="post">
    <label for="signup_firstname">First Name:</label>
    <input class="textField" name="FName" id="FName" />

    <label for="signup_lastname">Last Name:</label>
    <input class="textField" name="LName" id="LName" />

    <label for="signup_email_address">Email Address:</label>
    <input class="textField" type="email" id="Email" name="Email" />

    <label for="signup_confirm_email_address">Confirm Email Address:</label>
    <input class="textField" type="email" id="Conf_Email" name="Conf_Email" />

    <label for="signup_password">Password:</label>
    <input class="textField" type="password" name="Password" id="Password" />

    <label for="signup_confirm_password">Confirm Password:</label>
    <input class="lastFormItem textField" type="password" name="Password_Conf" id="Password_Conf" />

    <button type="submit" onclick="validateRegister();" class="fillBtn fltR caps">Submit</button>
</form>