<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $settings->site_name;?></title>
</head>
<body>
	<table cellspacing="0px" cellpadding="5px" align="center" width="850px" style="border:1px solid #000;" >
		<tr>
			<td colspan="2" style="padding:0px;margin:0px;border-bottom:0px;">
				<table cellspacing="0px" cellpadding="10px" align="center" width="100%">
					<tr>
						<!-- <td style="border-bottom:0px;">
							<img src="<?= base_url();?>uploads/logo96.png" width="160px" height="120px">
						</td> -->
						<td style="text-align:center;border-bottom:0px;">
							<h3><u><img src="<?= base_url();?>uploads/logo96.png" width="160px" height="120px"></u></h3>
							
						</td>
					</tr>
				</table>
				<table cellspacing="0px" cellpadding="10px" align="center" width="100%">
					<tr>
						<!-- <td style="border-bottom:0px;">
							<img src="<?= base_url();?>uploads/logo96.png" width="160px" height="120px">
						</td> -->
						<td style="text-align:center;border-bottom:0px;">
							<h3><u>Client Requirement Form</u></h3>
							
						</td>
					</tr>
				</table>
			</td>


		</tr>

		

		
			
				<tr>
					<td colspan="2" style="border-bottom:0px;">
						<table cellspacing="0px" cellpadding="5px" align="center" width="100%" border="1">
					
							<tbody>
							fg
								<tr>
									<td>
										1 
									</td>
									<td style="text-align:left;">
										<strong>Business Name</strong>
										
									</td>
									<td >
										<?php echo $business_name; ?>
									</td>
									
								</tr>	
									<tr>
									<td>
										2
									</td>
									<td style="text-align:left;">
										<strong>Owner Name</strong>
									
									</td>
									<td >
										<?php echo $owner_name; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										3 
									</td>
									<td style="text-align:left;">
										<strong>Address</strong>
										
									</td>
									<td >
										<?php echo $address; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										4
									</td>
									<td style="text-align:left;">
										<strong>Contact Number</strong>
										
									</td>
									<td >
										<?php echo $contact_info; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										5 
									</td>
									<td style="text-align:left;">
										<strong>Alternate Contact Number</strong>
									
									</td>
									<td >
										<?php echo $alter_info; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										6 
									</td>
									<td style="text-align:left;">
										<strong>Pan Number</strong>
										
									</td>
									<td >
										<?php echo $pan_number; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										7 
									</td>
									<td style="text-align:left;">
										<strong>GST Number</strong>
										
									</td>
									<td >
										<?php echo $gst_number; ?>
									</td>
									
								</tr>
								<tr>
									<td>
									    8
									</td>
									<td style="text-align:left;">
										<strong>Product Name</strong>
										
									</td>
									<td >
										<?php echo $product_name; ?>
									</td>
									
								</tr>
								<tr>
									<td>
									    9
									</td>
									<td style="text-align:left;">
										<strong>Product Description</strong>
										
									</td>
									<td >
										<?php echo $product_desc_number; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										10
									</td>
									<td style="text-align:left;">
										<strong>Logo Designing</strong>
										
									</td>
									<td >
										<?php echo $logo; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										11
									</td>
									<td style="text-align:left;">
										<strong>Customize Requirement</strong>
										<p style="text-align:justify;">gff</p>
									</td>
									<td >
										<p style="text-align:justify;">Domain Name: &nbsp;&nbsp;<?php echo $domain_name; ?> </p>
										<p style="text-align:justify;">Required : &nbsp;&nbsp;<?php echo $required_tab; ?> </p>
										<p style="text-align:justify;">Content: &nbsp;&nbsp;<?php echo $content; ?></p>
										<p style="text-align:justify;">Social Media Links: <?php echo $social_link; ?></p>
										<p style="text-align:justify;">Admin Panel: &nbsp;&nbsp;<?php echo $admin; ?></p>
									</td>
									
								</tr>
								<tr>
									<td>
										12
									</td>
									<td style="text-align:left;">
										<strong>Order Placing Date</strong>
										
									</td>
									<td >
										<?php echo $order_date; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										13
									</td>
									<td style="text-align:left;">
										<strong>Expected Delivery Date</strong>
										
									</td>
									<td>
										<?php echo $expected_date; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										14
									</td>
									<td style="text-align:left;">
										<strong>Any Referral Website</strong>
										
									</td>
									<td >
										<?php echo $referred; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										15
									</td>
									<td style="text-align:left;">
										<strong>Mode of Payment</strong>
										
									</td>
									<td >
										<?php echo $mode_of_payment; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										15
									</td>
									<td style="text-align:left;">
										<strong>Total Payment</strong>
										
									</td>
									<td >
										<?php echo $total_payment; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										15
									</td>
									<td style="text-align:left;">
										<strong>GST Included</strong>
										
									</td>
									<td >
										<?php echo $gstadd; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										15
									</td>
									<td style="text-align:left;">
										<strong>Total Payment + GST Included </strong>
										
									</td>
									<td >
										<?php echo $total_payment_gst; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										16
									</td>
									<td style="text-align:left;">
										<strong>Advance Payment</strong>
										
									</td>
									<td >
										<?php echo $advance_payment; ?>
									</td>
									
								</tr>
								<tr>
									<td>
										17
									</td>
									<td style="text-align:left;">
										<strong>Balance Payment</strong>
										
									</td>
									<td >
										<?php echo $balance_payment; ?>
									</td>
									
								</tr>
							</tbody>
							}
						</table>
					</td>
				</tr>
				
				<tr>
					<!-- <td colspan="2" style="border:none;"><strong>Declaration:</strong>
						<span><?php echo $content;?></span></td>
					</tr> -->
					<tr>
						<td colspan="2" style="text-align:center;border:none;"><strong><u>Head Office</u></strong>
							<p style="border:none;text-align:center;">A/2A, Viceroy Court, Opp. Dominos Pizza, Thakur,Kandivali(E), Mumbai</p>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;border:none;"><strong><u>Our Branches</u></strong>
							<p style="border:none;text-align:center;">Nagpur/ Pune / Mumbai / Nashik / Australia</p></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center;border:none;"><strong>Website:</strong><span><u>http://worldplanetesolution.com</u></span>
								<b>Contact No: 9821304242,7387065009</b>
							</td>
						</tr>
					</table>
				</body>
				</html>
	