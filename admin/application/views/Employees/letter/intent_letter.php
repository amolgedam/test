
<table  cellpadding="5px" cellspacing="10px" style="border:1px solid black;" width="850px;">
    <tr>
         <?php if(!empty($logo)) {?>
      <td><img src="<?php echo base_url('uploads/logo/'.$logo) ?>" style="width:300px;height:200px;"></td>
    <?php }?>
        <td style="padding:0px;margin:0px;">
          <table style="padding:0px;margin:0px;" width="608px;" cellspacing="10px">
        <tr>
              <td style="float:right;">
                <address style="width:400px; text-align: right;"><?php if(!empty($address)){ echo $address;}?>
                </address>
              </td>
            </tr>
            <tr>
              <td>
                <span style="float:right;"><b>M: -<?php if(!empty($mobile)){ echo $mobile.','.$alternate_mobile;}?></b></span>
              </td>
            </tr>
            <tr>
              <td>
                <span style="float:right ;color:blue;">E-mail: -<?php if(!empty($email)){ echo $email;}?></span>
              </td>
            </tr>
            <tr>
              <td>
                <span style="float:right;color:blue;"> Website: -<?php if(!empty($website)){ echo $website;}?></span>
              </td>
            </tr> 

          </table>
          
      </td>
       <tr>
        <td colspan="2">
          <div ><hr style="color:blue;"></div>
        </td>
      </tr>

      <tr>
       <td colspan="2">
        <center><h1><u><?php if(!empty($title)) { 
          echo ucfirst($title);  } ?><u/></h1></center>
      </td>
      </tr>
         <br><br> <br><br>
         <td>
          <span><b style="margin-left: 20px;">Date: -<?php echo date('d-M-Y')?></b></span>
        </td>
      
 

 <tr>
    <td colspan="2">
      <h4 style="margin-left: 20px;">Name : Harsha Tiwari</h4>
      <h4 style="margin-left: 20px;">Address: 24, Shambhu Nagar, Mankapur, Koradi Road, Nagpur, Maharashtra</h4>
      <h4 style="margin-left: 20px;">Subject: Letter Of Intent for the position of Android Developer.</h4>
    </td>
  </tr>
      <tr>
        <td>
         
            <p style="margin-left: 20px;">Dear .....,</p>
          
        </td>
       
      </tr>
<td colspan="2" style="text-align: justify;">
        <p style="margin-left: 40px;margin-right:40px;text-align: justify;"><?php if(!empty($description)){ echo $description;}?></p>

       
</td>
<tr>
<td colspan="2">
<br><br>
 <span><b style="margin-left: 20px;">Thanks and Regards,</b>
            <p><b style="margin-left: 20px;"> <?php if(!empty($site_name)){ echo $site_name;}?></b></p>
          </span>

  </tr>

<tr>
  <td colspan="2">
     <center  style="background-color: #00264d; color: white;padding: 15px; ">

<strong> Head Office:</strong> 
         <?php if(!empty($head_office)){ echo $head_office;}?> 
</center>
  </td>
</tr>

  </tr>
</table>

                