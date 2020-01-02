<?php
// 	echo "<pre>"; print_r($customerData); //exit();
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
<!--height: 1100px;-->
</head>
<body>
	<table cellspacing="5px" cellpadding="0px" align="center" width="850px"  style="border: 2px solid; width: 850px; " >
		<tr>
			<td style="padding:0px;margin:0px;">
				<table cellspacing="0px" cellpadding="0px" align="center" width="100%">
					<tr>
						<td style="width: 200px">
							<img src="<?php echo base_url('uploads/logo/logo1.jpg') ?>" style="width:100%; max-width:215px; height: 80px; padding-left: 30px">
								<!-- <u>< ?php echo "Quotation" ?></u> -->
						</td>
						<td style="text-align: right">
						    
						    <br>
						    <h2><?php echo $settings->site_name;?></h2>
						    
						    <table align="right" width="50%">
						        <tr>
						            <td><?php echo $settings->address;?></td>
						        </tr>
						        <tr>
						            <td><?php echo $settings->mobile;?></td>
						        </tr>
						        <tr>
						            <td>
						                <?php echo $settings->alternate_email;?>
						                <br>
						                <br>
						                <br>
						            </td>
						        </tr>
						    </table>
						    
						</td>
					</tr>
					<tr>
					    <td colspan="2">&nbsp;</td>
					</tr>
					<tr>
                		<td colspan="2" style="border-bottom:2px solid #3F8BD6; "></td>
                	</tr>
            		<tr>
                        <td colspan="2">
                            <table align="center" width="90%">
                                <tr>
                                    <td>
                                        <br>
                                        <br>
                                        <br><br><br><br><br><br><br><br>
                                        <span style="font-size: 20px"><b>To,</b></span>
                                        <br><br>
                                        <span style="font-size: 20px"><?php echo ucwords($customerData->name);?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <br>
                                        
                                            <?php echo ucwords($customerData->description);?>
                                        
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                	<tr>
                	    <td colspan="2">
                	        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                	    </td>
                	</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="850px"  align="center">
	    <tr>
	        <td style="border-right: 1px solid; width: 425px; text-align: right;">
	            <span style="font-weight: bold; font-size: 15px; color: #3f8bd6" >&nbsp;&nbsp;Website: http://worldplanetesolution.com &nbsp;&nbsp;&nbsp;</span>
	        </td>
	        <td>
	            <span style="font-weight: bold; font-size: 15px; color: #3f8bd6" >&nbsp;&nbsp;&nbsp; Contact: <?php echo $settings->mobile.", 9821304242";?> &nbsp;&nbsp;&nbsp;</span>
	        </td>
	        <!--<td>-->
	        <!--    <span style="font-weight: bold" >< ?php echo $settings->email;?> &nbsp;&nbsp;&nbsp;</span>-->
	        <!--</td>-->
	    </tr>
	</table>
    
</body>
</html>

<script type="text/javascript">
	window.print();
</script>
