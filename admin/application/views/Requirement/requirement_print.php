<style type="text/css">
	@media print {
    table, tr, th, td{
    	-webkit-print-color-adjust: exact; 
    }
    div
    {
		page-break-after: always;
	}
}

#background{
    position:absolute;
    z-index:0;
    background:white;
    display:block;
    color:yellow;
    top:400px;
    left: 10%;
}
#content{
    position:absolute;
    z-index:1;
    margin-left:2%;
}

#bg-text
{
    color:lightgrey;
    font-size:70px;
    transform:rotate(300deg);
    -webkit-transform:rotate(310deg);
}
	</style>
<!DOCTYPE html>
<html>
	<head>
		<title>WPES</title>
	</head>
<body>
<div id="background">
  <p id="bg-text">World Planet e-Solutions</p>
</div>
<div>
	<table cellpadding="0px" cellspacing="0px" align="center" width="850px" style="border:1px solid #000;font-family: sans-serif;" id="content">
		<tr>
			<td style="border-bottom:1.5px solid #000;border-top:1.5px solid #000;border-left:1px solid #000;text-align: center;padding-left: 25px !important;padding-top: 5px !important;padding-bottom: 0px !important" width="30%">
				<img src="<?= base_url();?>uploads/logo96.png" width="160px" height="120px">
			</td>
			
			<td style="border-bottom:1.5px solid #000;border-top:1.5px solid #000;text-align: center;padding-top: 5px !important;padding-bottom: 0px !important;font-family: sans-serif;" width="70%" height="150px">
				<b style="font-size: 26px;text-transform: uppercase;color:#0F4F91;">World Planet E-Solutions Pvt. Ltd.</b><br><br>
				<span style="font-size: 15px;font-weight: bold;color:#696969">Mobile Applications (Android / iOS) | Website Designing |<br>
				Billing Software | ERP Management Software |<br>
				Digital Marketing | Social Media | Cyber Security</span>
			</td>
		</tr>
		<tr>
			<td style="height:700px;vertical-align: top;text-align: center;border-left:1px solid #000;" colspan="2">
				<table cellpadding="0px" cellspacing="0px" width="100%" height="120px">
					<!-- <tr>
						<td style="padding-top: 10px;vertical-align: top" width="65%">
							<b style="padding-left: 50px;padding-bottom: 3px;padding-top: 3px;background-color:#0F4F91;color: white;font-size: 16px;">Requirement NO : 2001&nbsp;&nbsp;</b> <br><br> -->
							<!-- <span  style="padding-left: 50px;font-size: 15px;">Business Name : <b style="text-transform: uppercase;font-size: 16px;">dfdfdf</b></span><br>
							<span style="padding-left: 77px;font-size: 15px;text-transform: capitalize;">vcvcv</span><br>
							<span style="padding-left: 77px;font-size: 15px;">Mo. cvcvc</span> -->
						<!-- </td> -->
						<td style="padding-left: 30px;padding-bottom: 3px;vertical-align: top;padding-top: 10px;">
							<table border="0" cellpadding="2px" width="100%" style="font-size: 16px;">
								<tr>
									<td style="padding-top: 10px;vertical-align: top" width="65%">
									<b style="padding-left: 50px;padding-bottom: 3px;padding-top: 3px;background-color:#0F4F91;color: white;font-size: 16px;">Requirement NO : <?php if(!empty($requirement_no)) { echo $requirement_no; } else { echo "N/A"; } ?>&nbsp;&nbsp;</b> <br><br>
									</td>
								</tr>
								<tr>
									<td><b>Business Name</b> <b>:</b>&nbsp; <?php if(!empty($business_name)) { echo $business_name; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Owner Name</b> &nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($owner_name)) { echo $owner_name; } else { echo "N/A"; } ?></br></br> 
								</tr>
								<tr>
									<td><b>Address</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($address)) { echo $address; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Contact Number</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($contact_info)) { echo $contact_info; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Alternet Contact Number</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($alter_info)) { echo $alter_info; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Pan Number</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($pan_number)) { echo $pan_number; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>GST Number</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($gst_number)) { echo $gst_number; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Product Name</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($product_name)) { echo $product_name; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Product Description</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($product_desc_number)) { echo $product_desc_number; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Logo Designing</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($logo)) { echo $logo; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Domain Name</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($domain_name)) { echo $domain_name; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Required Tabs</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($required_tab)) { echo $required_tab; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Content</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($content)) { echo $content; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Social Media Links</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($social_link)) { echo $social_link; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Admin Panel</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($admin)) { echo $admin; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Order Placing Date</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($order_date)) { echo $order_date; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Expected Delivery Date</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($expected_date)) { echo $expected_date; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Any Referral Website</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($referred)) { echo $referred; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Mode of Payment</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($mode_of_payment)) { echo $mode_of_payment; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Total Payment</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($total_payment)) { echo $total_payment; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>GST Included</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($gstadd)) { echo $gstadd; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Total Payment + GST Included </b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($total_payment_gst)) { echo $total_payment_gst; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Advance Payment</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($advance_payment)) { echo $advance_payment; } else { echo "N/A"; } ?></br></br>
								</tr>
								<tr>
									<td><b>Balance Payment</b> &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php if(!empty($balance_payment)) { echo $balance_payment; } else { echo "N/A"; } ?></br></br>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<!-- <table cellpadding="0px" cellspacing="0px" width="95%" height="575px" align="center">
					<tr>
						<th height="5%" style="border-top:1px solid #000;border-bottom:1.5px solid #000;border-left:1.5px solid #000;border-right:1px solid #fff;background-color:#0F4F91;color:white" width="5%">SR. NO</th>
						<th height="5%"style="border-top:1.5px solid #000;border-bottom:1.5px solid #000;background-color:#0F4F91;color:white">PRODUCT NAME</th>
						<th height="5%"style="border-top:1.5px solid #000;border-bottom:1.5px solid #000;border-left:1.5px solid #fff;border-right:1.5px solid #fff;background-color:#0F4F91;color:white" width="12%">PRICE</th>
						<th height="5%"style="border-top:1.5px solid #000;border-bottom:1.5px solid #000;border-left:1.5px solid #fff;border-right:1.5px solid #fff;background-color:#0F4F91;color:white" width="12%">GST (%)</th>
						<th height="5%"style="border-top:1.5px solid #000;border-bottom:1.5px solid #000;background-color:#0F4F91;color:white" width="12%">DISC (%)</th>
						<th height="5%"style="border-top:1.5px solid #000;border-bottom:1.5px solid #000;border-left:1.5px solid #fff;border-right:1.5px solid #000;background-color:#0F4F91;color:white" width="12%">AMOUNT</th>
					</tr>
					<?php $i=0; 
						foreach ($logData as $key) {
							if($i<$countd-1){ $height="5%";}else{$height="";}
						?>
					<tr>
						<td height="<?= $height?>" style="vertical-align: top; padding-top:10px; padding-bottom:10px; text-align: center;border-left:1.5px solid #000;border-right:1px solid #000;"><?php echo $i+1; ?></td>
						<td style="vertical-align: top;padding-top:10px; padding-bottom:10px; padding-right: 10px;padding-left: 10px;text-align: justify;"><span style="text-transform: capitalize;"><?php echo $key->product_name;?><br></span><span style="padding-left: 20px;"><?php echo $key->description; ?></span></td>
						<td style="vertical-align: top;padding-top:10px; padding-bottom:10px; text-align: right;padding-right: 10px;border-left:1.5px solid #000;border-right:1.5px solid #000;"><?php echo $key->price; ?> /-</td>
						<td style="vertical-align: top;padding-top:10px; padding-bottom:10px; text-align: right;padding-right: 10px;border-right:1.5px solid #000;"><?php echo $key->gst; ?> %</td>
						<td style="vertical-align: top;padding-top:10px; padding-bottom:10px; text-align:center;"><?php echo $key->discount; ?> %</td>
						<td style="vertical-align: top;padding-top:10px; padding-bottom:10px; text-align: right;padding-right: 10px;border-left:1.5px solid #000;border-right:1.5px solid #000;"><?php echo $key->total?> /-</td>
					</tr>
					<?php $i++;} ?>
					<tr>
						<td height="5%" colspan="5" style="vertical-align: bottom;padding-top:5px; padding-bottom:5px; text-align: right;padding-right: 20px;font-weight: bold;border-top:1.5px solid #000;border-bottom:1.5px solid #000;border-left:1.5px solid #000;">Total</td>
						<td style="vertical-align: bottom;padding-top:10px; padding-bottom:10px; text-align: right;padding-right: 10px;border-top:1.5px solid #000;border-bottom:1.5px solid #000;border-right:1.5px solid #000;border-left:1.5px solid #000;"><?php echo $invoiceData->total_amount; ?>/-</td>
					</tr>
				</table> -->
			</td>
		</tr>
		<!-- <tr>
			<td height="150px" style="padding-left: 50px;padding-right: 40px;padding-top: 10px;padding-bottom: 10px;border-left:1px solid #000;border-bottom:1px solid #000;vertical-align: top" colspan="2">
                <b><u>Terms & Conditions:</u></b>
                sfdfd
			</td>
		</tr> -->
		<tr>
			<td style="border-top:1px solid #000; padding-left: 0px;padding-right: 20px;padding-top: 10px;padding-bottom: 0px;border-left:1px solid #000;border-bottom:1px solid #000;" colspan="2">
				<ol style="list-style: none">
                  	<li style="padding-bottom: 5px;"><b>Head Office &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> A/2A, Viceroy court, Opp. Domino’s Pizza, Thakur Village, Kandivali (E) Mumbai 400101.</li>
					<li style="padding-bottom: 5px;"><b>Contact No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> +91 9561997500 / +91 9821304242<br></li>
					<li style="padding-bottom: 5px;"><b>Website &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> www.worldplanetesolution.com<br></li>
					<li><b>Our Branches &nbsp;:</b> ● Mumbai   ● Nagpur   ● Pune   ● Nashik   ● Australia.</li>
				</ol>
			</td>
		</tr>
	</table>
</div>
</body>
</html>
<script type="text/javascript">
	window.print();
</script>