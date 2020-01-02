<?php
// 	echo "<pre>"; print_r($customerData); exit();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $settings->site_name;?></title>

	<style type="text/css">
	    .borderBottom
	    {
	        border-bottom: 2px solid #000;
	        border-left: 2px solid #000;
	        /*border-right: 2px solid #000;*/
	    }
		.borderSimple
		{
			/*border-bottom: 2px solid #000;*/
			border-left: 2px solid #000;
		}
		.borderRightSimple
		{
			border-right: 2px solid #000;
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
		
		.flexEqH {
              display: flex;
              flex-direction: row;
        }

		/*div{*/
		/*    border-collapse: collapse;*/
		/*    border: 1px solid black;*/
		/*}*/
		/*.tableCell*/
		/*{*/
		    /*display: table-cell;*/
		    /*height:auto;*/
		/*    flex: 1;*/
		/*}*/

	</style>

</head>
<body>
    <div style="border: 2px solid; ">
        <table cellspacing="5px" cellpadding="0px" align="center" width="850px" >
    		<tr>
    			<td>
    		        <table style="width:100%">
    		            <tr>
    		                <td style="width: 40%">
    							<img src="<?php echo base_url('uploads/logo/logo1.jpg') ?>" style="width:30%; height: 80px; padding-left: 30px">
    								<!-- <u>< ?php echo "Quotation" ?></u> -->
    						</td>
    						<td style="width: 60%">
    						    <table style="width:100%">
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
    	</table>
    	
    	<div class="page-break-inside: avoid !important; width: 98%; margin-top: 5px">
    	    <div style="margin-left: 2px">
                <div class="borderColor fontColor"  style="float: left; width: 10%;">&nbsp;Sr No.</div>
                <div class="borderColor fontColor"  style="float: left; width: 48%;">&nbsp;Product Description</div>
                <div class="borderColor fontColor"  style="float: left; width: 12%;">&nbsp;Price</div>
                <div class="borderColor fontColor"  style="float: left; width: 12%;">&nbsp;GST (18%)</div>
                <div class="borderColor borderRight fontColorWhite backgoundColorBlue" style="float: left; width: 16%;">&nbsp;Amount</div>
            </div>
            
            <section class="flexEqH">
            <?php 
    			if(!empty($logData))
    			{
    				$sr = 1; $total = 0;
    				foreach ($logData as $key => $value)
    				{
    		?>
                        <div style="display: flex">
                            <div style="float: left; width: 10%;">
                                &nbsp;<?php echo $sr; ?>
                            </div>
                            <div class="borderSimple" style="float: left; width: 48%;" id="desc">
                                <div style="padding-left: 10px;">
                                    &nbsp;<?php echo ucwords($value->product_name); ?>
                                    <!--<br>-->
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value->description ?>
                                    
                                </div>
                            </div>
                            <div class="borderSimple" style="float: left; width: 12%;" >
                                &nbsp;<?php echo number_format($value->price, 2) ?>
                            </div>
                            <div class="borderSimple" style="float: left; width: 12%;">
                                &nbsp;<?php echo number_format($value->gst, 2).'%' ?>
                            </div>
                            <div class="borderSimple" style="float: left; width: 16%;">
                                &nbsp;<?php echo 'Rs'.number_format($value->total, 2) ?>
                            </div>
                        </div>
            <?php
						$sr++;
						$total += $value->total;
					}
				}
			?>
			</section >
            <div style="margin-left: 2px">
                <div class="borderSimple" style="float: left; width: 10%;">
                    &nbsp;
                </div>
                <div class="borderSimple" style="float: left; width: 48%;">
                    &nbsp;
                </div>
                <div class="borderSimple" style="float: left; width: 12%;">
                    &nbsp;
                </div>
                <div class="borderSimple" style="float: left; width: 12%;">
                    &nbsp; Total
                </div>
                <div class="borderSimple borderRightSimple" style="float: left; width: 16%;">
                    &nbsp; <?php echo 'Rs'.number_format($total, 2); ?>
                </div>
            </div>
            <br>
        </div>
        
        <table cellspacing="5px" cellpadding="0px" align="center" width="850px" >
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
    </div>
    
	
	
		
		<!--<tr>-->
		<!--	<td>-->
			    <!--<div style="page-break-inside: avoid !important;">-->
			        
			    <!--</div>-->
				
				<!--<table cellspacing="0px" cellpadding="5px" align="center" width="100%" autosize="1">-->
				<!--    <thead>-->
		  <!--              <tr>-->
				<!--			<th class="borderColor fontColor" style="width: 10%">Sr No.</th>-->
							<!--<th class="borderColor fontColor">Product Name</th> -->
				<!--			<th class="borderColor fontColor" sttyle="width: 50%">Product Description</th>-->
				<!--			<th class="borderColor fontColor;" style="width:12%">Price</th>-->
				<!--			<th class="borderColor fontColor;" style="width:13%x">GST (18 %)</th>-->
				<!--			<th class="borderColor borderRight fontColorWhite backgoundColorBlue" style="width:15%">Amount</th>-->
				<!--		</tr>-->
		  <!--          </thead>-->
		            
		  <!--          <tbody>-->
		  <!--              < ?php -->
				<!--			if(!empty($logData))-->
				<!--			{-->
				<!--				$sr = 1; $total = 0;-->
				<!--				foreach ($logData as $key => $value)-->
				<!--				{-->
				<!--			?>-->
				<!--					<tr>-->
				<!--						<td class="borderSimple"><span style="margin:0px; padding:0px"><?php echo $sr; ?></span></td>-->
										<!-- <td class="borderSimple"><center>< ?php echo ucwords($value->product_name); ?></center></td> -->
				<!--						<td class="borderSimple">-->
				<!--							<b>&nbsp;&nbsp;&nbsp;< ?php echo ucwords($value->product_name); ?></b>-->
				<!--							< ?php echo $value->description ?>		-->
				<!--						</td>-->
				<!--						<td class="borderSimple">< ?php echo number_format($value->price, 2) ?></td>-->
				<!--						<td class="borderSimple">< ?php echo number_format($value->gst, 2).'%' ?></td>-->
				<!--						<td class="borderSimple borderRightSimple">< ?php echo 'Rs '.number_format($value->total, 2) ?></td>-->
				<!--					</tr>-->
				<!--			< ?php-->
				<!--					$sr++;-->
				<!--					$total += $value->total;-->
				<!--				}-->
				<!--			}-->
				<!--		?>-->
		  <!--          </tbody>-->
				<!--    <tfoot>-->
				<!--        <tr>-->
				<!--			<td colspan="4" class="borderSimple" style="text-align: right; color: #3258A3"><b>Total</b> &nbsp;</td>-->
				<!--			<td class="borderSimple borderRightSimple">< ?php echo number_format($total, 2); ?></td>-->
				<!--		</tr>-->
				<!--    </tfoot>-->
				    
				<!--</table>-->
		<!--	</td>-->
		<!--</tr>-->
		
		
		
		
		
	<!--</table>-->
</body>
<script src="<?php echo base_url()?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!--<script>-->
<!--    checkHeight();-->
    
<!--    function checkHeight()-->
<!--    {-->
<!--        var descHeight = $('#desc').height();-->
        
<!--        $(".setHeight").css("height:", descHeight);-->
        
<!--        var height = $('.setHeight').css({height: descHeight});-->
        
<!--        console.log("descHeight "+descHeight+" height "+height);-->
        
<!--    }-->
    
<!--</script>-->

</html>
			    
			    
			    
			    