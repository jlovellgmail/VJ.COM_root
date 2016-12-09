<h1 class="caps marTop30">Reset Password</h1>
<div class="row">
	<div class="sm-eleven lg-six centerCol">
		<?php	$resetPass = false;
			if (isset($_GET["action"]) && $_GET["action"] == "reset" && !$PswErr)
			{
				$resetPass = true; ?>
		        <div class='alertMessage'>Password reset successfully.</div>
		<?php	} 
			if (isset($ExpErr) && $ExpErr)
			{ 
				$resetPass = true; ?>
				<div class='alertMessage'>This link is expired. Please generate a new link and try again.</div>
		<?php	}?>
		
    	<form class="generalForm" id="resetPassFrm" name="resetPassFrm" method="POST" action="/resetPw.php?token=<?php echo $_GET['token']; ?>&action=reset">
			<?php
				if (isset($TknErr) && $TknErr)
				{
					echo "<div class='alertMessage'>This email address was not found in our system.</div>";
				}				
				if (isset($PswErr) && $PswErr)
				{
					echo "<div class='alertMessage'>Your passwords do not match. Please check and submit again.</div>";
				}
				if ($resetPass == false) {
			?>
    	    <label for=" ">Enter New Password:</label>
    	    <input type="password" id="Password" name="Password" />
    	    <label for=" ">Re-Enter New Password:</label>
    	    <input type="password" id="Password_Conf" name="Password_Conf" />
    	    <div class="textRight"><button type="button" class="fillBtn" onclick="validateResetPassForm();">SUBMIT</button></div>
			<?php } ?>
    	</form>
    </div>
</div>