<?php

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once($rootpath . '/incs/conn.php');
include $rootpath . '/classes/Address.class.php';
include $rootpath . '/classes/Order.class.php';
include $rootpath . '/classes/CreditCard.class.php';
include $rootpath . "/incs/check_login.php";

session_start();
if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    try {

        require_once($rootpath . '/core/PayFlowTransaction.class.php'); //assumes it's in the current dir

        $txn = new PayflowTransaction();
        //
        //these are provided by your payflow reseller
        //
        $txn->PARTNER = 'paypal';
        $txn->USER = 'mjcweb';
        $txn->PWD = 'MJC2014mjc!';
        $txn->VENDOR = $txn->USER; //or your vendor name

        $txn->TENDER = 'C'; //sets to a cc transaction
        $txn->TRXTYPE = 'S'; //txn type: sale
        $txn->AMT = $Cart->getTotal(); //amount: 1 dollar
        $txn->ACCT = $Cart->getCreditCard()->getVar("CCNumber"); //cc number
        $txn->EXPDATE = $Cart->getCreditCard()->getVar("CCXMonth") . substr($Cart->getCreditCard()->getVar("CCXYear"), -2); //4 digit
        $txn->FIRSTNAME = $Cart->getCreditCard()->getVar("CCName");
        $txt->CVV2 = $Cart->getCreditCard()->getVar("CCCode");
        $txn->STREET = $Cart->getBillAddr()->getVar("Addr1") . " " . $Cart->getBillAddr()->getVar("Addr2");
        $txn->CITY = $Cart->getBillAddr()->getVar("City");
        if ($Cart->getBillAddr()->getVar("State") != "") {//&& $user->getVar("BState")!="xx" ){
            $txn->STATE = $Cart->getBillAddr()->getVar("State");
        }
        $txn->COUNTRY = $Cart->getBillAddr()->getVar("Country");
        //$txn->debug = true; //uncomment to see debugging information
        //$txn->avs_addr_required = 1; //set to 1 to enable AVS address checking, 2 to force "Y" response
        //$txn->avs_zip_required = 1; //set to 1 to enable AVS zip code checking, 2 to force "Y" response
        //$txn->cvv2_required = 1; //set to 1 to enable cvv2 checking, 2 to force "Y" response
        //$txn->fraud_protection = true; //uncomment to enable fraud protection

        $txn->process();
        if ($txn->txn_successful == 1) {
            $resArr = $txn->response_arr;
            $_SESSION["TransID"] = $resArr["PNREF"];
            $_SESSION["AuthCode"] = $resArr["AUTHCODE"];
            $Order = $Cart->generateOrder();
            $TaxAmt = $Cart->getTaxAmt();
            $TaxFlag = $Cart->getTaxFlag();
            $TaxInvoiceNo = $Cart->getTaxInvoice();
            $Order->store();
            $OrdID = $Order->getOrdID();
            if (isset($TaxFlag) && $TaxFlag && isset($TaxInvoiceNo) && $TaxAmt > 0) {
                if (strpos($TaxInvoiceNo, "INV") == FALSE && $TaxInvoiceNo == "0000000") {
                    $mailTo = "spolycarpou@study.net";
                    $mailSubj = "VirgilJames Order with manual Tax calculation";
                    $MailBody = "An order has been placed with a manual tax clculation.  Order ID=" . $OD_ID . "\n\n";
                    $headers = 'From: erros@study.net' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                    mail($mailTo, $mailSubj, $MailBody, $headers);
                } else {
                    include $rootpath . '/tax/post_taxes.php';
                }
            }
            $_SESSION["Order"] = $Order;
            sendEmail($Order);
            header("Location: receipt.php");
        }
    } catch (TransactionDataException $tde) {
        //echo 'bad transaction data ' . $tde->getMessage();
        $_SESSION["CCError"] = $tde->getMessage();
        header("Location: billing.php");
    } catch (InvalidCredentialsException $e) {
        echo 'Invalid credentials';
    } catch (InvalidResponseCodeException $irc) {
        //echo 'bad response code: ' . $irc->getMessage();
        $_SESSION["CCError"] = $irc->getMessage();
        header("Location: billing.php");
    } catch (AVSException $avse) {
        //echo 'AVS error: ' . $avse->getMessage();
        $_SESSION["CCError"] = 'AVS error: ' . $avse->getMessage();
        header("Location: billing.php");
    } catch (CVV2Exception $cvve) {
        //echo 'CVV2 error: ' . $cvve->getMessage();
        $_SESSION["CCError"] = 'CVV2 error: ' . $cvve->getMessage();
        header("Location: billing.php");
    } catch (FraudProtectionException $fpe) {
        //echo 'Fraud Protection error: ' . $fpe->getMessage();
        $_SESSION["CCError"] = 'Fraud Protection error: ' . $fpe->getMessage();
        header("Location: billing.php");
    } catch (Exception $e) {
        $_SESSION["CCError"] = $e->getMessage();
        header("Location: billing.php");
//echo $e->getMessage();
    }


//print_r($Order);
}

function sendEmail($Order) {
    $rootpath = $_SERVER['DOCUMENT_ROOT'];
    require_once $rootpath . "/core/Countries.class.php";
    $Countries = new Countries();

    if ($logedIn) {
        $EmailName = $_SESSION["Name"];
    } else {
        $ShipAddr = $Order->getVar("ShippingAddr");
        $EmailName = $ShipAddr->getVar("FName") . " " . $ShipAddr->getVar("LName");
    }
    $prodNames = "";
    $n = 0;
    foreach ($Order as $productArr) {
        $product = $productArr["item"];
        $ProductName = $product->getProductName();
        if ($n > 0) {
            $prodNames = $prodNames . "," . $ProductName;
        } else {
            $prodNames = $ProductName;
        }
    }
    $ShipAddr = $Order->getVar("ShippingAddr");
    $SCityStateZip = $ShipAddr->getVar("City") . ", " . $ShipAddr->getVar("State") . " " . $ShipAddr->getVar("Postal");
    $SCoutry = $Countries->getCountryName($ShipAddr->getVar("Country"));
    $BillAddr = $Order->getVar("BillingAddr");
    $BCityStateZip = $BillAddr->getVar("City") . ", " . $BillAddr->getVar("State") . " " . $BillAddr->getVar("Postal");
    $BCoutry = $Countries->getCountryName($BillAddr->getVar("Country"));
    $CreditCard = $Order->getCreditCard();
    $CCNo = $CreditCard->getVar("CCNumber");
    $CCNum = substr($CCNo, -4);
    $CCType = $CreditCard->getVar("CCType");

    $mailBody = "<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='utf-8'>
	<!-- utf-8 works for most cases -->
	<meta name='viewport' content='width=device-width'>
	<!-- Forcing initial-scale shouldnt be necessary -->
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<!-- Use the latest (edge) version of IE rendering engine -->
	<title>Virgil James - Credit Card Receipt</title>
	<!-- The title tag shows in email notifications, like Android 4.4. -->
	<style type='text/css'>
		/* ===[ What it does: Remove spaces around the email design added by some email clients. ]=== */
		/* ===[ Beware: It can remove the padding / margin and add a background color to the compose a reply window. ]=== */
		
		html,
		body {
			margin: 0;
			padding: 0;
			height: 100% !important;
			width: 100% !important;
		}
		/* ===[ What it does: Stops email clients resizing small text. ]=== */
		
		* {
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}
		/* ===[ What it does: Forces Outlook.com to display emails full width. ]=== */
		
		.ExternalClass {
			width: 100%
		}
		/* ===[ What it does: Stops Outlook from adding extra spacing to tables. ]=== */
		
		table,
		td {
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
		}
		/* ===[ What it does: Fixes webkit padding issue. ]=== */
		
		table {
			border-spacing: 0 !important
		}
		/* ===[ What it does: Fixes Outlook.com line height. ]=== */
		
		.ExternalClass,
		.ExternalClass * {
			line-height: 100%
		}
		/* ===[ What it does: Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. ]=== */
		
		table {
			border-collapse: collapse;
			margin: 0 auto;
		}
		/* ===[ What it does: Uses a better rendering method when resizing images in IE. ]=== */
		
		img {
			-ms-interpolation-mode: bicubic
		}
		/* ===[ What it does: Overrides styles added when Yahoos auto-senses a link. ]=== */
		
		.yshortcuts a {
			border-bottom: none !important
		}
		/* ===[ What it does: Overrides blue, underlined links auto-detected by iOS Mail. ]=== */
		/* ===[ More Info: https://litmus.com/blog/update-banning-blue-links-on-ios-devices ]=== */
		
		.mobile-link--footer a {
			color: #666666 !important
		}
		/* ===[ What it does: Overrides styles added images. ]=== */
		
		img {
			border: 0 !important;
			outline: none !important;
			text-decoration: none !important;
		}
		/* ===[ What it does: Apple Mail doesnt support max-width, so a media query constrains the email container width. ]=== */
		
		@media only screen and (min-width: 601px) {
			.email-container {
				width: 600px !important
			}
		}
		/* ===[ What it does: Apple Mail doesnt support max-width, so a media query constrains the email container width. ]=== */
		
		@media only screen and (max-width: 600px) {
			.email-container {
				width: 100% !important;
				max-width: none !important;
			}
		}
	</style>
</head>

<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' bgcolor='#FFFFFF' style='margin:0; padding:0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none;'>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' bgcolor='#FFFFFF' style='border-collapse:collapse; height:auto;'>
		<tr>
			<td>
				<!-- Visually Hidden Preheader Text : BEGIN -->

				<div style='display:none;font-size:1px;color:#FFFFFF;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide: all;'> </div>

				<!-- Visually Hidden Preheader Text : END -->

				<!-- Outlook and Lotus Notes dont support max-width but are always on desktop, so we can enforce a wide, fixed width view. -->
				<!-- Beginning of Outlook-specific wrapper : BEGIN -->
				<!--[if (gte mso 9)|(IE)]>
  <table width='600' align='center' cellpadding='0' cellspacing='0' border='0'>
    <tr>
      <td>
  <![endif]-->
				<!-- Beginning of Outlook-specific wrapper : END -->

				<!-- Email wrapper : BEGIN -->

				<table border='0' width='100%' cellpadding='0' cellspacing='0' align='center' style='max-width:600px; margin:auto;' class='email-container'>
					<tr>
						<td>
                        	<!-- Head Links : BEGIN -->
                            
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                <tr>
<td valign='middle' style='padding-top:15px; padding-bottom:15px; text-align:center; font-family: Proxima Nova, Arial, sans-serif;' width='268'><a style='color:#000; font-size:12px;' href='http://www.virgiljames.net/email_view/receiptCC.php?OrdID=" . $Order->getOrdID() . "'>View in Browser</a></td>
                                </tr>
                            </table>
                            
                            <!-- Head Links : END --> 

							<!-- Main Email Body : BEGIN -->

							<table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='#000000' style=' -webkit-border-top-left-radius: 35px; -webkit-border-bottom-right-radius: 35px; -moz-border-radius-topleft: 35px; -moz-border-radius-bottomright: 35px; border-top-left-radius: 35px; border-bottom-right-radius: 35px;'>

								<!-- Logo : BEGIN -->
								<tr>
									<td valign='middle' style='padding:30px 15px 15px 15px; text-align:center;' width='268'>
										<img src='http://www.virgiljames.net/img/vj_logo_white_tag.png' alt='Virgil James' width='268' height='54' border='0' align='center'>
									</td>
								</tr>
								<!-- Logo : END -->

								<!-- Dashed Rule : BEGIN -->
								<tr>
									<td>
										<table border='0' width='90%' cellpadding='0' cellspacing='0' align='center' style='text-align:center;'>
											<tr>
												<td style='border-bottom:1px dashed #7A7C7E;'>&nbsp;</td>
											</tr>
										</table>
									</td>
								</tr>
								<!-- Dashed Rule : END -->

								<!-- Full Width, Fluid Column : BEGIN -->
								<tr>
									<td style=' font-family: Proxima Nova, Arial, sans-serif; padding:15px 6% 0px 6%; color:#fff;'>
										<span style='font-size:36px;'>Hello " . $EmailName . ",</span>
									</td>
								</tr>
								<tr>
									<td style='padding:15px 6% 0 6%; font-family: Proxima Nova, Arial, sans-serif; font-size: 14px; line-height: 1.3; color: #FFFFFF;'><p>You have completed your purchase of  " . $prodNames . " from <b>Virgil James</b>. If you need any assistance, please contact us at: <a href='mailto:customerservice@virgiljames.com' style='color:#818181;'>customerservice@virgiljames.com</a></p>
										<br> Thank you for your order with
										<span style='font-weight:bold;'>VirgilJames.com.</span>
									</td>
								</tr>

								<!-- Full Width, Fluid Column : END -->

								<!--Rounded Middle Area : BEGIN -->
								<tr>
									<td style='padding:15px 6%; font-family: Proxima Nova, Arial, sans-serif; font-size:15px;'>
										<table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' style='background-color:#FFFFFF; border-top-left-radius: 35px; border-bottom-right-radius: 35px; color:#000; padding-left:15px; padding-right:15px; width:100%;'>
											<tbody>
												<tr>
													<td style='font-weight:bold; font-size:20px; padding:30px 30px 15px 30px; text-transform:uppercase; text-align:left;' align='left'>Order Receipt</td>
												</tr>
												<tr>
													<td style='text-align:left; padding:10px 30px 10px 30px; '>
																			<span style='font-family:serif; font-style:italic; font-size:20px; '>Order #" . $Order->getOrdID() . " - " . $Order->getDate() . "</span></td>
													</td>
												</tr>
												<tr>
													<td style='padding:10px 30px 10px 30px;'>
														<table border='0' width='100%' cellpadding='0' cellspacing='0' align='left' style='text-align:left;'>
															<tr>
																<td style='vertical-align:top; font-family: Proxima Nova, Arial, sans-serif; font-size: 14px; line-height: 1.3; color: #000000; padding-bottom:30px;'>
																	<table border='0' width='100%' cellpadding='0' cellspacing='0' align='left' style='text-align:left;'>
																		<tr>
																			<td style='padding-top:8px;'>
																				<span style='font-weight:bold; text-transform:uppercase;'>Ship to</span>
																			</td>
																		</tr>
																		<tr>
                                                                            <td style='padding-top:8px;'>" . $ShipAddr->getVar("FName") . " " . $ShipAddr->getVar("LName") . "</td>
																		</tr>
																		<tr>
                                                                            <td style='padding-top:4px;'>" . $ShipAddr->getVar("Addr1") . " " . $ShipAddr->getVar("Addr2") . "</td>
																		</tr>
																		<tr>
																			<td style='padding-top:4px;'>" . $SCityStateZip . "</td>
																		</tr>
																		<tr>
                                                                            <td style='padding-top:4px; padding-bottom:12px;'>" . $SCoutry . "</td>
																		</tr>
                                                                        <tr>
                                                                            <td style='padding-top:12px; padding-bottom:12px;'><span style='font-style:italic;'>" . $Order->getVar('ShipNotes') . "</span></td>
                                                                        </tr>
																	</table>
																</td>
																<td style='vertical-align:top; font-family: Proxima Nova, Arial, sans-serif; font-size: 14px; line-height: 1.3; color: #000000; padding-bottom:30px;'>
																	<table border='0' width='100%' cellpadding='0' cellspacing='0' align='left' style='text-align:left;'>
																		<tr>
																			<td style='padding-top:8px;'>
																				<span style='font-weight:bold; text-transform:uppercase;'>Bill to</span>
																			</td>
																		</tr>
																		<tr>
                                                                            <td style='padding-top:4px;'>" . $BillAddr->getVar("FName") . " " . $BillAddr->getVar("LName") . "</td>
																		</tr>
																		<tr>
                                                                            <td style='padding-top:4px;'>" . $BillAddr->getVar("Addr1") . " " . $BillAddr->getVar("Addr2") . "</td>
																		</tr>
																		<tr>
                                                                            <td style='padding-top:4px;'>" . $BCityStateZip . "</td>
																		</tr>
																		<tr>
                                                                            <td style='padding-top:4px;'>" . $BCoutry . "</td>
																		</tr>
                                                                        <tr>
                                                                            <td style='padding-top:12px; padding-bottom:12px;'><span style='font-style:italic;'>" . ucfirst($CCType) . " ending in " . $CCNum . "</span></td>
                                                                        </tr>
																	</table>
																</td>
															</tr>
														</table>
														</td>
														</tr>
														<tr>
														<td style='padding:10px 30px 10px 30px;'>
														<table border='0' width='100%' cellpadding='0' cellspacing='0' align='left' style='text-align:left;'>

															<!-- Data Table : BEGIN -->
															<tr>
																<td style='padding:0 0 0 0; border-left:1px solid #eeeeee; border-right:1px solid #eeeeee;'>
																	<table cellspacing='0' cellpadding='0' border='0' width='100%'>
																		<tr>
																			<td valign='top' align='center' style='padding: 10px; font-family: Proxima Nova, Arial, sans-serif; font-size: 15px; line-height: 1.3; color: #FFFFFF; background-color:#000000; font-weight: bold; border-bottom: 1px solid #cccccc'>
																				Item
																			</td>
																			<td valign='top' align='center' style='padding: 10px; font-family: Proxima Nova, Arial, sans-serif; font-size: 15px; line-height: 1.3; color: #FFFFFF; background-color:#000000; font-weight: bold; border-bottom: 1px solid #cccccc'>
																				Qty.
																			</td>
																			<td valign='top' align='left' style='padding: 10px; font-family: Proxima Nova, Arial, sans-serif; font-size: 15px; line-height: 1.3; color: #FFFFFF; background-color:#000000; font-weight: bold; border-bottom: 1px solid #cccccc'>
																				Product Description
																			</td>
																			<td valign='top' align='right' style='padding: 10px; font-family: Proxima Nova, Arial, sans-serif; font-size: 15px; line-height: 1.3; color: #FFFFFF; background-color:#000000; font-weight: bold; border-bottom: 1px solid #cccccc'>
																				Price
																			</td>
																		</tr>";
    foreach ($Order as $productArr) {
        $product = $productArr["item"];
        $prodQty = $productArr["qty"];
        $SCPID = $product->getId();
        $PID = $product->getPID();
        $ProductName = $product->getProductName();
        $ProdImgUrl = $product->getThumbnailUrl();
        if ($ProdImgUrl == "") {
            // $ProdImgUrl = "/img/product/canvas_black_backpack.png";
        }
        $ProdPrice = number_format((float) $product->getVar("Price"), 2, '.', '');

        $mailBody = $mailBody . "<tr>
																			<td valign='middle' align='center' style='padding: 10px; font-family: Proxima Nova, Arial, sans-serif; font-size: 15px; line-height: 1.3; color: #333333; border-bottom: 1px solid #eeeeee'>
																				<img src='http://www.virgiljames.net" . $ProdImgUrl . "' width='50'>
																				<br>
																				<span style='font-size:75%;'>" . $PID . "</span>
																			</td>
																			<td valign='middle' align='center' style='padding: 10px; font-family: Proxima Nova, Arial, sans-serif; font-size: 15px; line-height: 1.3; color: #333333; border-bottom: 1px solid #eeeeee'>
																				" . $prodQty . "
																			</td>
																			<td valign='middle' align='left' style='padding: 10px; font-family: Proxima Nova, Arial, sans-serif; font-size: 15px; line-height: 1.3; color: #333333; border-bottom: 1px solid #eeeeee'>
																				" . $ProductName . "
																			</td>
																			<td valign='middle' align='right' style='padding: 10px; font-family: Proxima Nova, Arial, sans-serif; font-size: 15px; line-height: 1.3; color: #333333; border-bottom: 1px solid #eeeeee'>
																				$" . $ProdPrice . "
																			</td>
																		</tr>";
    }
    $mailBody = $mailBody . "</table>
																</td>
															</tr>
															<!-- Data Table : END -->

															<!-- Full Width, Fluid Column : BEGIN -->
															<tr>
																<td style='padding-top:15px; padding-bottom:30px;'>
																	<table cellspacing='0' cellpadding='0' border='0' width='75%' align='right'>";
    $TaxAmt = $Order->getVar("TaxAmt");
    if (isset($TaxAmt) && $TaxAmt > 0) {
        $mailBody = $mailBody . "<tr>
																			<td align='right' style='font-family: Proxima Nova, Arial, sans-serif; padding:15px 10px 0 10px; color:#000000; text-align:right;'>
																				Subtotal
																			</td>
																			<td align='right' style='font-family: Proxima Nova, Arial, sans-serif; padding:15px 10px 0 10px; color:#000000; text-align:right;'>
																				$" . $Order->getTotalWithOutTax() . "
																			</td>
																		</tr>
																		<tr>
																			<td align='right' style='font-family: Proxima Nova, Arial, sans-serif; padding:15px 10px 0 10px; color:#000000; text-align:right;'>
																				Sales Tax
																			</td>
																			<td align='right' style='font-family: Proxima Nova, Arial, sans-serif; padding:15px 10px 0 10px; color:#000000; text-align:right;'>
																				$" . number_format((float) $TaxAmt, 2, '.', '') . "
																			</td>
																		</tr>";
    }
    $mailBody = $mailBody . "<tr>
																			<td colspan='2' align='right' style='font-family: Proxima Nova, Arial, sans-serif; padding:15px 10px 0 10px; color:#000000; text-align:right; font-style:italic;'>
																				Shipping Included
																			</td>
																		</tr>
																		<tr>
																			<td align='right' style='font-family: Proxima Nova, Arial, sans-serif; padding:15px 10px 0 10px; color:#000000; text-align:right; font-weight:bold;'>
																				Total
																			</td>
																			<td align='right' style='font-family: Proxima Nova, Arial, sans-serif; padding:15px 10px 0 10px; color:#000000; text-align:right; font-weight:bold;'>
																				$" . $Order->getTotal() . "
																			</td>
																		</tr>
																	</table>
															</tr>

															<!-- Full Width, Fluid Column : END -->

														</table>
														</td>
												</tr>
											</tbody>
										</table>
										</td>
								</tr>

								<!--Rounded Middle Area : END -->

								<!-- VJ - Contact Info: BEGIN -->
								<tr>
									<td style='color:#818181; padding:15px 6%;  padding-bottom:30px; padding-top:60px; font-size: 13px; '>
										<table border='0' width='100%' cellpadding='0' cellspacing='0' style='color:#818181;'>
											<tbody>
												<tr>
													<td style='font-size:13px; font-family: Proxima Nova, Arial, sans-serif; color:#818181;'>Virgil James Customer Service</td>
												</tr>
												<tr>
													<td style='font-size:13px; font-family: Proxima Nova, Arial, sans-serif; color:#818181;'> Tel: &zwnj; 858 &zwnj; 555 &zwnj; 555 &zwnj; </td>
												</tr>
												<tr>
													<td style='font-size:13px; font-family: Proxima Nova, Arial, sans-serif; color:#818181;'>Monday &zwnj; through &zwnj; Friday &zwnj; 8&zwnj;am &zwnj; 5&zwnj;pm</td>
												</tr>
												<tr>
													<td style='font-size:13px; font-family: Proxima Nova, Arial, sans-serif; color:#818181;'><a style='color:#818181;' href='mailto:customerservice@virgiljames.com'>customerservice@virgiljames.com</a></td>
												</tr>
												<tr>
													<td style='font-family: Proxima Nova, Arial, sans-serif; font-size:13px; padding-top:20px; padding-bottom:20px; text-transform:uppercase; color:#818181;'>Virgil &zwnj; James • 214 &zwnj; N. &zwnj; Cedros &zwnj; Ave. • &zwnj; Solana &zwnj; Beach, &zwnj; Ca &zwnj; 92075</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<!-- Full Width, Fluid Column : END -->

							</table>

							<!-- Main Email Body : END -->
							</td>
					</tr>

					<!-- Footer : BEGIN -->
					<tr>
						<td style='text-align:center; padding:4% 0; font-family: Proxima Nova, Arial, sans-serif; font-size:13px; line-height:1.2; color:#000000;'>&nbsp;
							<br>
							<br>
						</td>
					</tr>
					<!-- Footer : END -->
				</table>

				<!-- Email wrapper : END -->
				<!-- End of Outlook-specific wrapper : BEGIN -->
				<!--[if (gte mso 9)|(IE)]>
                  </td>
                </tr>
              </table>
              <![endif]-->
				<!-- End of Outlook-specific wrapper : END -->
            </td>
		</tr>
	</table>
</body>

</html>";

    $mailTo = $Order->getVar("Email");
    $mailSubj = "VirgilJames Order";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: <customerservice@virgiljames.com>" . "\r\n";
    mail($mailTo, $mailSubj, $mailBody, $headers);
}

?>