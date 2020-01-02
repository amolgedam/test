<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<center>

<table  cellpadding="5px" cellspacing="10px" style="border:0px solid black;" width="850px;">
    <tr>
         <?php if(!empty($logo)) {?>
      <td><img src="<?php echo base_url('uploads/logo/'.$logo) ?>" style="width:300px;height:200px;"></td>
    <?php }?>
        <td style="padding:0px;margin:0px;">
          <table style="padding:0px;margin:0px; margin-left:400px;" width="608px;" cellspacing="10px">
            <tr>
              <td style="float:right;">
                <address style=" width:400px; margin-left:400px; font-size:20px;"><?php if(!empty($address)){ echo $address;}?>
                </address>
              </td>
            </tr>
            <tr>
              <td>
                <span style="margin-left:400px;font-size:20px; "><b>M: -<?php if(!empty($mobile)){ echo $mobile.','.$alternate_mobile;}?></b></span>
              </td>
            </tr>
            <tr>
              <td>
                <span style="margin-left:400px;font-size:20px;color:blue; ">E-mail: -<?php if(!empty($email)){ echo $email;}?></span>
              </td>
            </tr>
            <tr>
              <td>
                <span style=" margin-left:400px;color:blue;font-size:20px;"> Website: -<?php if(!empty($website)){ echo $website;}?></span>
              </td>
            </tr> 

          </table>
          
      </td>
    </tr>
       
       <tr>
        <td colspan="2">
          <div ><hr style="color:blue; width: 100%;"></div>
        </td>
      </tr>
    <br>
      <tr>
       <td colspan="2">
        <center><h1 style="color:#66ccff;"><u><?php if(!empty($title)) { 
          echo ucfirst($title);  } ?></u></h1></center>
      </td>
      </tr>
      <br><br>
      <tr>
         <td>
          <p><b style="margin-left: 0px; font-size:25px;">Date:&nbsp;<?php echo date('d-M-Y')?></b></p>
        </td>
      </tr>
 

    <tr>
    <td colspan="2">
      <p style="margin-left: 0px; font-size:25px;"><b>Name :</b> Harsha Tiwari</p>
      <p style="margin-left: 0px; font-size:25px;"><b>Address:</b> 24, Shambhu Nagar, Mankapur, Koradi Road, Nagpur, Maharashtra</p>
      <p style="margin-left: 0px; font-size:25px;"><b>Subject:</b> Letter Of Intent for the position of Android Developer.</p>
    </td>
    </tr>
    <br><br>
      <tr>
        <td>
         <p style="margin-left: 0px; font-size:25px;">Dear .....,</p>
         </td>
      </tr>
      
      <br><br> 
        <tr>  
          <td colspan="2" style="text-align:justify; line-height:2.5;">
            <p style=" margin-left:0px; font-size:25px; text-align:justify; line-height:2.5;"> <?php if(!empty($description)){ echo $description;}?> </p>
          </td>
        </tr>
      
      
    <br>
    <tr>
    <td colspan="2">
    <br><br>
        <p><b style="margin-left: 0px;font-size:25px;">Thanks and Regards,</b></p>
        <p><b style="margin-left: 0px;font-size:25px;"> <?php if(!empty($site_name)){ echo $site_name;}?></b></p>
    </td>    
    </tr>

</table>
</center>

  
  <br><br>
    <footer>
      <center>
        <p style="background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;">
        <strong> Head Office:</strong> 
         <?php if(!empty($head_office)){ echo $head_office;}?>
        </p>
      </center>
     </footer>

 
    <script type="text/javascript">
      window.print();
  
    </script>
</body>
</html>
                