<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $settings->site_name;?></title>
</head>
<body>
	<table cellspacing="10px" cellpadding="0px" align="center" width="850px" style="border:1px solid #000;" >
		<tr>
			<td colspan="2" style="padding:0px;margin:0px;">
				<table cellspacing="0px" cellpadding="10px" align="center" width="100%">
					<tr>
						<td>
							<img src="<?php echo base_url('uploads/logo/'.$settings->logo);?>" style="width:100%; max-width:220px; height: 100px;">
						</td>
						<td style="text-align:center;">
							<h3><u><?php echo $settings->site_name;?></u></h3>
							<span style="font-weight: 15px; text-align: left;"> Web Designing | Mobile Application (Android/iOS)  Billing <br>Software | ERP/CRM | Management Software | Digital Marketing | Cyber Security<br>
							</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><b>GST No. <?php echo $settings->gst_no;?></b></td>
			<td style="float:right;"><b>Pan No. <?php echo $settings->pan_no;?></b></td>
		</tr>
		<tr>
			<td colspan="2" style="border-bottom:1px solid;"></td>
		</tr>

		<tr>
			<td colspan="2">
				 <table cellspacing="0px" cellpadding="10px" width="100%">
				<tr>
					<td>
						<span style="color:#0c7ecf;"><b>Quotation To:</b></span>
					</td>
					<td>
					<span style="color:#0c7ecf;"><center><b>Quotation No:</b> <?php echo 'WPES'.$invoiceData->quotation_no;?></center>
					</span>
					</td>
					<td>
						<span style="color:#0c7ecf;float:right;"> <b>Date:</b> <?php echo date('d-m-Y',strtotime($invoiceData->quotation_date));?></span>
					</td>
				</tr>
				</table>	
			</td>
			
		</tr>
			<tr>
				<td style="text-align:left border:none;">
					<?php echo ucwords($customerData->customer_name);?><br>
					<span>(<?php echo $customerData->mobile_no;?>)</span>	
					<address><?php echo $customerData->address;?></address>	
				</td>
				<td style="text-align:right;">
					<span><b>Bank Name: </b><?php echo $settings->bank_name;?></span><br>
					<span><b>Account No: </b><?php echo $settings->account_no;?></span>	<br>
					<span><b>IFSC Code: </b><?php echo $settings->ifsc_code;?>&nbsp;&nbsp;&nbsp;&nbsp;</span>	
				</td> 
			</tr>
				<tr>
					<td colspan="2">
						<table cellspacing="0px" cellpadding="5px" align="center" width="100%" border="1">
							<thead style="background-color:#7dcafd;">
							<tr class="info">
								<th>
									Qty
								</th>
								<th style="width: 400px;">
									Description
								</th>
								<th>
									Price
								</th>
								<th>
									GST(18%)
								</th>
								<th>
									Amount
								</th>
							</tr>
							</thead>
							<tbody>
							<?php if(!empty($logData)) { $sr=1; foreach($logData as $log) { 
							    
							    $get_product = $this->Crud_model->GetData('software_details','',"id='".$log->product_name."'",'','','','1');
							
							?>
								<tr>
									<td>
										<?php echo $sr++;?>
									</td>
									<td style="text-align:left;">
								<strong><?php echo $get_product->title;?></strong>
										<p style="text-align:justify;"><?php echo $log->description;?></p>
									</td>
									<td >
										<?php echo 'Rs. '.number_format(round($log->price),2);?>
									</td>
									<td>
										<?php echo number_format(round($log->gst),2).' %';?>
									</td>
									<td>
										<?php echo 'Rs. '.number_format(round($log->total),2);?>
									</td>
								</tr>
							</tbody>
							<?php }} ?>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="width:600px;">
					<span style="margin-right:20px;"><b>Terms and Conditions:</b></span> 
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<p style="text-align:justify;"><?php echo $invoiceData->terms;?></p>
					</td>
				</tr>
				<tr>
					<!-- <td colspan="2" style="border:none;"><strong>Declaration:</strong>
						<span><?php echo $content;?></span></td>
					</tr> -->
					<tr>
						<td colspan="2" style="text-align:center;border:none;"><strong><u>Head Office</u></strong>
							<p style="border:none;text-align:center;">A/2A, Viceroy Court, Opp. Dominos Pizza, Thakur, Kandiwali(E), Mumbai</p>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;border:none;"><strong><u>Our Branches</u></strong>
							<p style="border:none;text-align:center;">Nagpur/ Pune / Mumbai / Nashik / Australia</p></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center;border:none;"><strong>Website:</strong><span><u>http://worldplanetesolution.com</u></span>
								<b>Contact No: <?php echo $settings->mobile?>, <?php echo $settings->alternate_mobile?></b>
							</td>
						</tr>
					</table>
				</body>
				</html>
				<script type="text/javascript">
					window.print();
				</script>