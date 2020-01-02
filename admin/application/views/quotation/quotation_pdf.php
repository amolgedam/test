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
.main_table
{
	border:2px solid #000;font-family: sans-serif;
}
	</style>
<!DOCTYPE html>
<html>
	<head>
		<title>WPES</title>
	</head>
<body>
	<table cellpadding="0px" cellspacing="0px" align="center" width="850px" class="main_table" id="content">
		<tr>
			<td style="border-bottom:1.5px solid #000;text-align: center;padding-left: 25px !important;padding-top: 5px !important;padding-bottom: 0px !important" width="30%">
				<img src="<?= base_url();?>uploads/logo96.png" width="160px" height="120px">
			</td>
			
			<td style="border-bottom:1.5px solid #000; text-align: center;padding-top: 5px !important;padding-bottom: 0px !important;font-family: sans-serif;" width="70%" height="150px">
				<b style="font-size: 26px;text-transform: uppercase;color:#0F4F91;">World Planet E-Solutions Pvt. Ltd.</b><br><br>
				<span style="font-size: 15px;font-weight: bold;color:#696969">Mobile Applications (Android / iOS) | Website Designing |<br>
				Billing Software | ERP Management Software |<br>
				Digital Marketing | Social Media | Cyber Security</span>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top;text-align: center;" colspan="2" height="850px">
				<table cellpadding="0px" cellspacing="0px" width="100%">
					<tr>
						<td style="padding-top: 10px;padding-bottom: 10px; vertical-align: top; text-align:left;" width="65%">
							<b style="padding-top: 3px; background-color:#0F4F91; color: white;font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QUOTATION NO : <?php echo $invoiceData->quotation_no; ?>&nbsp;&nbsp;</b> <br><br>
						</td>
						<td style="padding-left: 30px;padding-bottom: 3px;vertical-align: top;padding-top: 10px;" rowspan="2">
							<table border="0" cellpadding="2px" width="100%" style="font-size: 16px; text-align: left; ">
								<tr>
									<td>GSTIN <b>:</b>&nbsp; 27AACCW0199D1ZC
								</tr>
								<tr>
									<td>PAN &nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; AACCW0199D
								</tr>
								<tr>
									<td>Date &nbsp;&nbsp;&nbsp;<b>:</b>&nbsp; <?php echo date("d-M-Y",strtotime($invoiceData->created));?>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="padding-top: 10px;padding-bottom: 10px; vertical-align: top; text-align:left; padding-left:50px;" width="65%" height="120px">
							<b  style="font-size: 15px;" >To </b><b style="text-transform: uppercase;font-size: 16px;">: <?php echo $customerData->customer_name; ?></b><br>
							<b style="font-size: 15px;text-transform: capitalize; font-weight: normal"><?php echo $customerData->address; ?></b><br>
							<b style="font-size: 15px; font-weight: normal">Mo. <?php echo $customerData->mobile_no; ?></b>
						</td>
					</tr>
				</table>
				<table cellpadding="0px" cellspacing="0px" width="95%" align="center">
					<tr>
						<td height="25px" style="border-top:1px solid #000;border-bottom:1.5px solid #000;border-left:1.5px solid #000;border-right:1px solid #fff;background-color:#0F4F91;color:white" width="9%">SR. NO</td>
						<td style="border-top:1.5px solid #000;border-bottom:1.5px solid #000;background-color:#0F4F91;color:white">PRODUCT NAME</td>
						<td style="border-top:1.5px solid #000;border-bottom:1.5px solid #000;border-left:1.5px solid #fff;border-right:1.5px solid #fff;background-color:#0F4F91;color:white" width="12%">PRICE</td>
						<td style="border-top:1.5px solid #000;border-bottom:1.5px solid #000;border-right:1.5px solid #fff;background-color:#0F4F91;color:white" width="12%">GST (%)</td>
						<td style="border-top:1.5px solid #000;border-bottom:1.5px solid #000;background-color:#0F4F91;color:white" width="12%">DISC (%)</td>
						<td style="border-top:1.5px solid #000;border-bottom:1.5px solid #000;border-left:1.5px solid #fff;border-right:1.5px solid #000;background-color:#0F4F91;color:white" width="12%">AMOUNT</td>
					</tr>
					<?php $i=0; 
						foreach ($logData as $key) {
							
							if($i<$countd-1){ $height="5%";}else{$height="";}
						?>
					<tr>
						<td height="<?= $height;?>" style="vertical-align: top; padding-top:10px; padding-bottom:10px; text-align: center;border-left:1.5px solid #000;border-right:1px solid #000;"><?php echo $i+1; ?></td>
						<td style="vertical-align: top;padding-top:10px; padding-bottom:10px; padding-right: 10px;padding-left: 10px;text-align: justify;">
							<?php echo $key->product_name; ?><br>
						</td>
						<td style="vertical-align: top;padding-top:10px; padding-bottom:10px; text-align: right;padding-right: 10px;border-left:1.5px solid #000;border-right:1.5px solid #000;"><?php echo $key->price; ?> /-</td>
						<td style="vertical-align: top;padding-top:10px; padding-bottom:10px; text-align: right;padding-right: 10px;border-right:1.5px solid #000;"><?php echo $key->gst; ?> %</td>
						<td style="vertical-align: top;padding-top:10px; padding-bottom:10px; text-align:center;"><?php echo $key->discount; ?> %</td>
						<td style="vertical-align: top;padding-top:10px; padding-bottom:10px; text-align: right;padding-right: 10px;border-left:1.5px solid #000;border-right:1.5px solid #000;"><?php echo $key->total; ?> /-</td>
					</tr>
					<?php $i++;} ?>
					<tr>
						<td height="5%" colspan="5" style="vertical-align: bottom;padding-top:10px; padding-bottom:10px; text-align: right;padding-right: 20px;font-weight: bold;border-top:1.5px solid #000;border-bottom:1.5px solid #000;border-left:1.5px solid #000;">Total</td>
						<td style="vertical-align: bottom;padding-top:10px; padding-bottom:10px; text-align: right;padding-right: 10px;border-top:1.5px solid #000;border-bottom:1.5px solid #000;border-right:1.5px solid #000;border-left:1.5px solid #000;"><?php echo $invoiceData->total_amount; ?>/-</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="130px" style="padding-left: 50px;padding-right: 40px;padding-top: 10px;padding-bottom: 10px;border-bottom:1px solid #000;vertical-align: top" colspan="2">
                <b><u>Terms & Conditions:</u></b>
                <?php echo $invoiceData->terms; ?>
			</td>
		</tr>
		<tr>
			<td style="border-top:1px solid #000; padding-left: 50px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;" colspan="2" height="120px">
				
                  	<label style="padding-bottom: 5px;"><b>Head Office &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> A/2A, Viceroy court, Opp. Domino’s Pizza, Thakur Village, Kandivali (E) Mumbai 400101.</label><br>
					<label style="padding-bottom: 5px;"><b>Contact No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> +91 9561997500 / +91 9821304242<br></label>
					<label style="padding-bottom: 5px;"><b>Website &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b> www.worldplanetesolution.com<br></label>
					<label><b>Our Branches &nbsp;:</b> ● Mumbai   ● Nagpur   ● Pune   ● Nashik   ● Australia.</label>
			</td>
		</tr>
	</table>
</body>
</html>