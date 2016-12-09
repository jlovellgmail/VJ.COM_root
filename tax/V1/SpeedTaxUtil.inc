<?php
// *******************************************************************
// *                                                                 *
// *                    *** UTIL FUNCTION ***                        *
// *                                                                 *
// *******************************************************************

//
// All output is formatted for the console, not for a web page
//

function STLog($text)
{
	$myFile = "phplog.txt";
	$fh = fopen($myFile, 'w') or die("can't open file");
	fwrite($fh, $text);
	fclose($fh);
}




function DisplayInvoiceResult($result)
{

	foreach ($result as $name => $value)
	{	
		switch ($name)
		{
			case 'resultType':
				print "Result............: " . $value . "<br>";
				break;
			case 'lineItemBundles':
				print "Line Item Bundle:<br>";
				DisplayInvoiceBundle($value);
				break;
			case 'totalExemptSales':
				print "Total Exempt Sales: $" . number_format($value->decimalValue, 2) . "<br>";
				break;
			case 'totalSales':
				print "Total Sales.......: $" . number_format($value->decimalValue, 2) . "<br>";
				break;
			case 'totalTax':
				print "Total Tax.........: $" . number_format($value->decimalValue, 2) . "<br>";
				break;
		}
	}
}

/*
This function might receive one single bundle or an array of bundles
*/
function DisplayInvoiceBundle($bundle)
{	
	if (is_array($bundle))
	{
		foreach ($bundle as $value)
		{		
			DisplayOneInvoiceBundle($value);
		}
	} 
	else 
	{
		DisplayOneInvoiceBundle($bundle);
	}
}

function DisplayOneInvoiceBundle($value)
{
		print "    Address for Tax:<br>";
		DisplayFullAddress($value->addressForTax, "        ");
		print "    Line Item:<br>";
		DisplayLineItem($value->lineItems);
		print "    Recalculated Jurisdictions: " . $value->recalculatedJurisdictions . "<br>";
		print "    Result Type: " . $value->resultType . "<br>";
		print "    Taxes: <br>";
		
		if (isset($value->taxes))
		{
			DisplayTaxes($value->taxes);
		}
}

function DisplayLineItem($item)
{	
    // We might get one line item or an array of line items.  Use recursion to simplify.
    // This is a different path than the one used for line item bundles, which defines
    // a separate function    
    if (is_array($item))
    {
        foreach ($item as $value)
        {
            DisplayLineItem($value);
        }
    }
    else
    {
        foreach ($item as $name => $value)
        {	
            switch ($name)
            {
                case 'lineItemNumber':
                    print "        Line Item Number: " . $value . "<br>";
                    break;
                case 'customReference':
                    print "        Custom Reference: " . $value . "<br>";
                    break;
                case 'productCode':
                    print "        Product Code....: " . $value . "<br>";
                    break;
                case 'taxAmount':
                    print "        Tax.............: $" . DisplayAmount($value) . "<br>";
                    break;
                case 'salesAmount':
                    print "        Sales Amount....: $" . DisplayAmount($value) . "<br>";
                    break;
                case 'nonTaxableSalesAmount':
                    print "        Non-Tax. Amt....: $" . DisplayAmount($value) . "<br>";
                    break;
                case 'taxableSalesAmount':
                    print "        Taxable Amt.....: $" . DisplayAmount($value) . "<br>";
                    break;
                case 'taxes':
                    print "        Line Item Tax Breakdown:<br>";
                    DisplayTaxes($value);
                    break;
                default:
                    //print $name . "<br>";
                    break;
            }
        }
	}
	print "        --------<br>";
}

function DisplayTaxes($value)
{
    if (!isset($value))
    {
        return;
    }
    
    if (is_array($value))
    {
        foreach($value as $tax)
        {
            DisplayTaxes($tax);
            //print "        " . $tax->jurisdictionName . " (" . $tax->jurisdictionFips . "): $" . DisplayAmount($tax->totalTax) . "<br>";
        }
    }
    else
    {
        $tax = $value; // There was only one tax, so $value is not an array but rather the specific tax object.
        print "        " . $tax->jurisdictionName . " (" . $tax->jurisdictionFips . "): $" . DisplayAmount($tax->totalTax) . "<br>";
    }
    
}

function DisplayAmount($value)
{
	
	if (isset($value->decimalValue))
	{
		$amt = $value->decimalValue;
	}
	else
	{
		$amt = 0;
		
		if (isset($value->dollars))
		{
			$amt = $value->dollars;
		}
		if (isset($value->cents))
		{
			$amt = $amt + ($value->cents / 100);
		}
	}
	
	return number_format($amt, 2);
}

function DisplayFullAddress($fullAddress, $prefix)
{
	if (isset($prefix)) print $prefix;
	print $fullAddress->address . "<br>";

	if (isset($prefix)) print $prefix;
	print $fullAddress->city . ", " . $fullAddress->state . "  " . $fullAddress->zip . "<br>";
}

function DisplayJurisdictions($jurisdictions)
{
	foreach($jurisdictions as $j)
	{
		print $j->jurisdictionName . " (" . $j->jurisdictionFips . ")<br>";
	}
}

function DisplayErrors($errors)
{
    if (is_array($errors))
    {
        foreach($errors as $e)
        {
            DisplayErrors($e);
        }
    }
    else
    {
        print $errors . "<br>";
    }
}

function DisplayInvoice($invoice)
{
	foreach ($invoice as $name => $value)
	{	
        //print "Name" . $name . ": ";
        //print_r ($value);
            
		switch ($name)
		{
			case 'customerIdentifier':
				print 'customerIdentifier..: ' . $value . "<br>";
				break;
			case 'customerName':
				print 'customerName........: ' . $value . "<br>";
				break;
			case 'exempt':
				print 'exempt..............: ' . $value . "<br>";
				break;
			case 'exemptionCertificate':
				print 'exemptionCertificate: ' . $value . "<br>";
				break;
			case 'exemptionReason':
				print 'exemptionReason.....: ' . $value . "<br>";
				break;
			case 'invoiceDate':
				print 'invoiceDate.........: ' . $value . "<br>";
				break;
			case 'invoiceNumber':
				print 'invoiceNumber.......: ' . $value . "<br>";
				break;
			case 'invoiceType':
				print 'invoiceType.........: ' . $value . "<br>";
				break;
			//case 'lineItems':
			//	print "Line Items:<br>";
			//	DisplayLineItem($value);
			//	break;
			default:
				//print $name . " = " . $value;
				break;
		}
	}
		
	print "Line Items:<br>";		
	
	foreach ($invoice->lineItems as $name => $value)
	{
		DisplayLineItem($value);
	}
}

?>