function validateEmail(email)
{
	var valid = true;
	var atpos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	var splitDomain = email.split('@');
	if (splitDomain.length > 1)
	{
		var domainPart = splitDomain[1];
		var splitDot = domainPart.split('.');
		var splitHyphen = domainPart.split('-');
		var re = new RegExp("[^0-9a-zA-z.-]");
	}
	else
	{
		//alert ("Please enter a valid e-mail address.");
		return false;
	}
	if (splitDomain.length > 2)
	{
		valid = false;
	}
	else if (atpos<1 || dotpos<atpos+2 || dotpos+1>=email.length) 
	{
	    valid = false;
	}
	else if (re.test(domainPart))
	{
		valid = false;
	}
	else if (splitHyphen[0] == "" || splitHyphen[splitHyphen.length-1] == "")
	{
		valid = false;
	}
	
	for (var i = 0; i < splitDot.length; i++)
	{
		if (splitDot[i] == "")
		{
			valid = false;
			i = splitDot.length;
		}
	}
	
	if (valid == false)
	{
		//alert ("Please enter a valid e-mail address.");
		return false;
	}
	else
	{
		return true;
	}
}