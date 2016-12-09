<div class="row cartBorderBottom">
	<h2 class="caps black marTop30 marBottom15">Customer Service</h2>
	<p>Please enter a valid email address to send your order reciept.</p>
    <form class="generalForm">
    	<div class="row">
            <div class="sm-twelve md-six lg-six leftCol">
            	<div class="clearfix">
                	<label>Email Address:</label>
            		<input type="email" id="emailReview" name="emailReview" />
                </div>
                <br />	
                <label class="contrastGrey clearfix">
                	<div class="col"><input type="checkbox" name="accChkbx" id="accChkbx" class="collapseCheckOff" value="createAccountCheckOff" onchange="setUsrMode()"/></div>
					<div class="sm-ten" style="padding-left:15px"> I don't want to create an account or
save my information.</div>
                </label>
			</div><div class="sm-twelve md-six lg-six leftCol" id="createAccountCheckOff">
            	<div class="clearfix">
                	<label>Password:</label>
            		<input type="password" id="psw" name="psw" />
                </div>
            	<div class="clearfix">
                	<label>Confirm Password:</label>
            		<input type="password" id="confpsw" name="confirmpsw" />
				</div>
    		</div>
        </div>
    </form>
</div>
<script>
	function setUsrMode(){
		
		if ($("#accChkbx").prop('checked')){
			usrMode = 'guest';
		} else {
			usrMode = 'new';
		}
	}
</script>