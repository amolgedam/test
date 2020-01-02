<?php
// 	echo "<pre>"; print_r($customerData); exit();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $settings->site_name;?></title>
	
	<style type="text/css">
		.borderSimple
		{
			border-bottom: 1px solid #000;
			border-left: 1px solid #000;
		}
		.borderRightSimple
		{
			border-right: 1px solid #000;
		}
		.borderColor
		{
			border-top: 2px solid #3258A3;
			border-left: 2px solid #3258A3;
			border-bottom: 2px solid #3258A3;
		}
		.borderRight
		{
			border-right: 2px solid #3258A3;
		}
		.fontColor
		{
			color: #3258A3;
		}
		.fontColorWhite
		{
			color: #fff;
		}
		.backgoundColorBlue
		{
			background-color: #2AB2E8;
		}

	</style>

</head>
<body>
    <table cellspacing="5px" cellpadding="0px" align="center" width="100%" style="border: 2px solid; overflow:auto; " >
		<tr>
			<td>
			    <table cellspacing="0px" cellpadding="5px" align="center" width="100%">
					<tr>
					    <td>
                            <table width="100%">
					            <tr>
					                <td style="width: 30%">
            							<img src="<?php echo base_url('uploads/logo/logo1.jpg') ?>" style="width:30%; height: 80px; padding-left: 30px">
            								<!-- <u>< ?php echo "Quotation" ?></u> -->
            						</td>
            						<td style="width: 60%">
            						    <table  width="100%">
            						        <tr>
                						       	<td style="text-align: center; font-family: Tempus Sans ITC;">
                						       	    <h2 style="font-family: Tempus Sans ITC; text-align: right;"><u><?php echo $settings->site_name;?></u></h2>
                						       	</td>
                						    </tr>
                						    <tr>
                						        <td style=" text-align: center;">
                						            <span style="font-weight: 15px; font-family: Vrinda;"> Mobile Application (Android/iOS) | ERP/CRM | Management Software | <br> Web Designing | Digital Marketing | Cyber Security |</span>
                						        </td>
                						    </tr>
            						    </table>
            						</td>
					            </tr>
					        </table>
                        </td>
                    </tr>
                    <tr>
						<td style="border-bottom:1px solid;"></td>
					</tr>
					<tr>
						<td>
						    <table width="100%">
						        <tr>
						            <td style="padding-top: 10px"><b>GST No: <?php echo "27AACCW5301K1ZB"; ?></b></td>
						            <td style="text-align: right; padding-top: 10px"><b>CIN No: <?php echo "U72900MH2019PTC332123"; ?></b></td>
						        </tr>
						    </table>
						</td>
					</tr>
					<tr>
						<td style="border-bottom:1px solid; "></td>
					</tr>
					<tr>
						<td style="border-bottom:1px solid; text-align: center;">
							<span style="color: #0C7ECF; text-align: center; font-weight: bold;">Quotation No. : </span> <?php echo 'WPES'.$invoiceData->quotation_no;?>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%">
							    <tr>
							        <td style="text-align: right"><b>Date:</b> <?php echo date('d-m-Y',strtotime($invoiceData->quotation_date));?></td>
							    </tr>
							    <tr>
							        <td style="text-align: left">
							            <b>To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>&nbsp; <?php echo ucwords($customerData->customer_name);?> 
        								<!--<br><br>-->
        								<!--<b>Mobile &nbsp;&nbsp;&nbsp;&nbsp;: </b>&nbsp; < ?php echo $customerData->mobile_no;?>-->
        								<br><br>
        								<b>Address &nbsp;&nbsp;: </b>&nbsp; <?php echo $customerData->address;?>
							        </td>
							    </tr>
							</table>
								
						</td>
					</tr>
					<tr>
						<td style="border-bottom:1px solid; "></td>
					</tr>
					
					
					
			        
			        <tr>
						<td>
							<table cellspacing="0px" cellpadding="5px" align="center" width="100%">
								<thead>
									<tr>
										<th class="borderColor fontColor" style="width: 9%">Sr No.</th>
										<!-- <th class="borderColor fontColor">Product Name</th> -->
										<th class="borderColor fontColor" style="width: 58%">Product Description</th>
										<th class="borderColor fontColor;" style="width:10%">Price</th>
										<th class="borderColor fontColor;" style="width:10%">GST (18 %)</th>
										<th class="borderColor borderRight fontColorWhite backgoundColorBlue" style="width:13%">Amount</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if(!empty($logData))
										{
											$sr = 1; $total = 0;
											foreach ($logData as $key => $value)
											{
										?>
												<tr>
													<td class="borderSimple"><span style="margin:0px; padding:0px"><?php echo $sr; ?></span></td>
													<!-- <td class="borderSimple"><center>< ?php echo ucwords($value->product_name); ?></center></td> -->
													<td class="borderSimple">
														<b>&nbsp;&nbsp;&nbsp;<?php echo ucwords($value->product_name); ?></b>
														<?php echo $value->description ?>	
													</td>
													<td class="borderSimple"><?php echo number_format($value->price, 2) ?></td>
													<td class="borderSimple"><?php echo number_format($value->gst, 2).'%' ?></td>
													<td class="borderSimple borderRightSimple"><?php echo 'Rs'.number_format($value->total, 2) ?></td>
												</tr>
									
									<?php
												$sr++;
												$total += $value->total;
											}
										}
									?>
										
										<tr>
											<td colspan="4" class="borderSimple" style="text-align: right; color: #3258A3"><b>Total</b> &nbsp;</td>
											<td class="borderSimple borderRightSimple"><?php echo 'Rs'.number_format($total, 2); ?></td>
										</tr>
								</tbody>
							</table>
						</td>
					</tr>
					   
					
					<tr>
						<td style="border-bottom:1px solid; "></td>
					</tr>
					<tr>
						<td style="width:600px;">
						    <table width="100%">
						        <tr>
						            <td>
						                <span style="margin-right:20px; font-size: 20px;">&nbsp;&nbsp;<b>Terms and Conditions:</b></span> 
            							 <br><br>
            							<p style="text-align:justify; padding-left: 15px"><?php echo $invoiceData->terms;?></p>
            							<!--<br><br>-->
            							<!--<b>Declaration: </b> We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct. The total amount is including all taxes. -->
						            </td>
						        </tr>
						        <!--<tr>-->
						        <!--    <td style="text-align: right;">-->
						        <!--        <br><br><br><br>-->
						        <!--        <span><b>Authorised Signatory</b>&nbsp;&nbsp;&nbsp;&nbsp;</span>-->
						        <!--    </td>-->
						        <!--</tr>-->
						    </table>
						</td>
					</tr>
                </table>
            </td>
        </tr>
    </table>
    <table cellspacing="5px" cellpadding="0px" align="center" width="850px" height="1400px" style="border: 2px solid; width: 850px; height: 1400px; " >
		<tr>
			<td style="padding:0px;margin:0px;">
				<table cellspacing="0px" cellpadding="5px" align="center" width="100%">
					<tr>
						<td>
							<!--<div style="margin-top: 200px; margin-left: 30%">-->
								<img src="<?php echo base_url('uploads/logo/logo1.jpg') ?>" style="width:1200px; height: 500px; margin-top: 350px; margin-left: 30%">
							<!--</div>-->
						</td>
					</tr>
					<tr>
						<td>
						    <table width="100%">
						        <tr>
						            <td style="text-align: center;">
						                <br><br><br>
						                <span style="font-family: Calibri (Body); color: #1592c4; font-size: 40px; font-weight: bold">HEAD OFFICE</span>
								        <p style="border:none;text-align:center; font-family: Calibri (Body); font-size: 25px; font-weight: bold">A/2A, Viceroy Court, Opp. Dominos Pizza, Thakur, Kandiwali(E), Mumbai</p>
						            </td>
						        </tr>
						        <tr>
						            <td style="text-align: center;">
						                <br><br>
						                <span style="font-family: Calibri (Body); color: #1592c4; font-size: 40px; font-weight: bold">OUR BRANCHES </span>
							            <p style="border:none;text-align:center; font-family: Calibri (Body); font-size: 25px; font-weight: bold">Nagpur/ Pune / Mumbai / Nashik / Bangalore / Australia</p>
						            </td>
						        </tr>
						        <tr>
						            <td style="text-align: center;">
						                <br><br>
						                <span style="font-family: Calibri (Body); color: #1592c4; font-size: 20px; font-weight: bold">Contact : 9561997500, 9821304242</span>
						                <br>
            							<span style="font-family: Calibri (Body); color: #1592c4; font-size: 20px; font-weight: bold">Email ID : info@worldplanetsolution.com</span>
						                <br>
					                	<span style="font-family: Calibri (Body); color: #1592c4; font-size: 20px; font-weight: bold">Websites : www.worldplanetesolution.com</span>
            							
						            </td>
						        </tr>
						    </table>
						    
						</td>
					</tr>
					
				</table>
			</td>
		</tr>
		<tr>
		    <td>
		        <br><br><br><br><br><br><br><br>
		    </td>
		</tr>
	</table>
    
</body>
</html>

<script type="text/javascript">
	window.print();
</script>