<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<center>

<table  cellpadding="5px" cellspacing="10px" style="border:0px solid black;" width="850px;"><br><br><br>
    <tr>
         
     <td> <img src="<?php echo base_url('uploads/logo/logo1.jpg') ?>" width="300px" height="180px" alt="" /></td>

        <td style="padding:0px; margin:0px;">
          <table style="padding:0px;margin:0px; margin-left:400px;" width="608px;" cellspacing="10px">
        <tr>
              <td style="float:right;">
                <address style="width:400px;margin-left:400px;font-size:20px;"><b><?php if(!empty($address)){ echo $address;}?> </b>
                </address>
              </td>
            </tr>
            <tr>
              <td>
                <span style=" margin-left:400px;font-size:20px;"><b>M: -<?php if(!empty($mobile) and !empty($alternate_mobile)){ echo $mobile.','.$alternate_mobile;}?></b></span>
              </td>
            </tr>
            <tr>
              <td>
                <span style="margin-left:400px;font-size:20px;color:blue;">E-mail: -<?php if(!empty($email)){ echo $email;}?></span>
              </td>
            </tr>
            <tr>
              <td>
                <span style="margin-left:400px;color:blue;font-size:20px;"> Website: -<?php if(!empty($website)){ echo $website;}?></span>
              </td>
            </tr> 

          </table>
          
      </td>
    </tr>
       <tr>
        <td colspan="2">
          <div ><hr style="color:blue;"></div>
        </td>
      </tr>

      <tr>
       <td colspan="2">
        <center><h1 style="color:#66ccff;"><u><?php if(!empty($title)) { 
          echo ucfirst($title);  } ?></u></h1></center>
      </td>
      </tr> <br><br><br>
    <tr>
      <td colspan="2">
        <span><b style="margin-left: 0px;font-size:25px;">Date   :&nbsp;<?php echo date('d-M-Y')?></b></span><br><br>
       
        <span><b style="margin-left: 0px;font-size:25px;">Name   :&nbsp;<?php echo $name;?></b></span><br><br>
        <span><b style="margin-left: 0px;font-size:25px;">Address:&nbsp;<?php echo $address_1;?></b></span><br><br>
        <span><b style="margin-left: 0px;font-size:25px;">Subject:&nbsp;Letter Of Intent for the position of &nbsp;<?php echo $designation_name;?></b>.</span>
      </td>
    </tr>
  
    <br><br> 
        <tr>  
          <td colspan="2" style="text-align:justify; line-height:2.5;">
            <span style=" margin-left:0px; font-size:25px; text-align:justify; line-height:2.5;"> <?php if(!empty($certificate_id)){ echo $certificate_id;}?> </span>
          </td>
        </tr>
        
    <tr>
        <td colspan="2">
        <br><br>
            <p><b style="margin-left: 0px;font-size:25px;">Thanks and Regards,</b></p>
            <br>
            <p><b style="margin-left: 0px;font-size:25px;"> <?php if(!empty($site_name)){ echo $site_name;}?></b></p>
        </td>    
    </tr> 
 
 </table>
</center>
   

   <!-- <footer>
      <center>
        <p style="background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;">
        <strong> Head Office:</strong> 
         < ?php if(!empty($head_office)){ echo $head_office;}?>
        </p>
      </center>
     </footer>-->
  

 <!--  </tr> -->

 
    <script type="text/javascript">
      window.print();
  
    </script>
</body>
</html>
                