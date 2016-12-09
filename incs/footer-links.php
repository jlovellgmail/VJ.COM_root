<script type="text/javascript" src="/js/navigation.js"></script>

<!-- Newsletter Request Email Validation -->
<script>
$("#email").keyup(function (e) {
    if (e.keyCode == 13) {
        validate();
    }
});

function validate()
{
	if (validateEmail($("#email").val()))
	{
		var serializedData = $("#maillingListFrm").serialize();
	
		var request = $.ajax({
	        url: "/newsletter_action.php",
	        type: "post",
	        data: serializedData
	    });
		
		request.done(function (response, textStatus, jqXHR){
			// alert(jqXHR.responseText);
			
			$("#responseGroup").html(jqXHR.responseText);
	    });
	
	    // callback handler that will be called on failure
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        // log the error to the console
	       alert(
	            "The following error occured: "+
	            textStatus, errorThrown
	        );
			alert(jqXHR.responseText);
	    });
	}
	else
	{
		alert ("Please enter a valid e-mail address.");
		$("#email").focus();
		return false;
	}
}
</script>