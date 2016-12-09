
	<?php
		session_start();
        if (isset($_SESSION["er"]) && $_SESSION["er"] != "") {
            switch ($_SESSION["er"]) {
                case "em":
                    echo "
						<div class='alertMessage'>Please enter a valid email address.</div>";
                    break;
				case "emex":
                    echo "
						<div class='alertMessage'>This email address could not be found.</div>";
                    break;
				case "false":
                    echo "
						<div class='alertMessage'>Thank you for contacting us.</div>
						<div class='alertMessage'>PLEASE CHECK YOUR EMAIL INBOX FOR INSTRUCTIONS TO RESET YOUR PASSWORD.</div>";
                    break;
            }
        }
        ?>
<?php if (isset($_SESSION["er"]) && $_SESSION["er"] == "false") {

} else { ?>
    <label for="password">Reset Password:</label>
    <input class="textField" type="email" name="rstEmail" id="rstEmail" placeholder="Email Address"  />
    <button type="button" onclick="validateFrgtPass();" class="fillBtn fltR">Reset Password</button>
<?php } ?>