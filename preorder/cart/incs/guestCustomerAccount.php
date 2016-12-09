<div class="row cartBorderBottom">
	<h2 class="caps black marTop30 marBottom15">Customer Service</h2>
	<p>Please enter a valid email address to help us successfully process your order.</p>
    <form class="generalForm">
    	<div class="row">
            <div class="sm-twelve md-six lg-six leftCol">
            	<div class="clearfix">
                	<!--<label>Email Address:</label>-->
            		<input type="email" id="emailReview" name="emailReview" placeholder="Email Address"/>
                </div>
                <div id="createAccountCheck" style="display:none;">
                    <div class="clearfix">
                        <!--<label>Password:</label>-->
                        <input type="password" id="psw" name="psw"   placeholder="Password" />
                    </div>
                    <div class="clearfix">
                        <!--<label>Confirm Password:</label>-->
                        <input type="password" id="confpsw" name="confirmpsw"  placeholder="Confirm Password" />
                    </div>
                <br />
                </div>
			</div><!--<div class="sm-twelve md-six lg-six leftCol" id="createAccountCheck" style="display:none;">
            	<div class="clearfix">
                	<label>Password:</label>
            		<input type="password" id="psw" name="psw"  />
                </div>
            	<div class="clearfix">
                	<label>Confirm Password:</label>
            		<input type="password" id="confpsw" name="confirmpsw"  />
				</div>
    		</div>-->
        </div>
        <label class="contrastGrey clearfix marBottom15">
            <div class="col"><input type="checkbox" name="accChkbx" id="accChkbx" class="collapseCheck" value="createAccountCheck" onchange="setUsrMode()"/></div><div class="sm-ten" style="padding-left:15px">Save my information and create a Virgil James account.</div>
        </label>

    </form>
</div>

<script>
	function setUsrMode(){
		if ($("#accChkbx").prop('checked')){
			usrMode = 'new'
		} else {
			usrMode = 'guest';
		}
	}
</script>