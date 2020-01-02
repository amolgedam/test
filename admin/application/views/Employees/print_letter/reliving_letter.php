<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
   <center>
  <table  cellpadding="5px" cellspacing="10px" style="border:0px solid black;" width="850px;">
  <tr>
   <td> <img src="<?php echo base_url('uploads/logo/logo1.jpg') ?>" width="300px" height="300px" alt="" /></td>
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
       <tr>
          <td colspan="2">
            <hr style="color:blue; width: 100%;">
          </td>
        </tr>
    <br><br>
      <tr>
          <td colspan="2">
            <center><h1 style="color:#66ccff;"><u><?php if(!empty($title)) { 
          echo ucfirst($title);  } ?></u></h1></center> 
          </td>
        </tr>
        <br><br>
        <tr>
            <td>
            <p style="margin-left: 0px; font-size:25px;">Dear <?php if(!empty($name)) { 
          echo ucfirst($name);  } else{ echo "N/A";}?>,</p>
            </td>
        </tr>
        <tr>  
          <td colspan="2" style="text-align:justify; line-height:2.5;">
            <p style=" margin-left:0px; font-size:25px; text-align:justify; line-height:2.5;"> <?php if(!empty($description)){ echo $description;}?> </p>
          </td>
        </tr>
        <br><br> 
        
        
        <table align="left" style="margin-left: 20px;">
        <tr>
            <td>
                <b>&nbsp;&nbsp;&nbsp;&nbsp;----------------------------</b>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    
                      
                <b> <img src="<?php echo base_url('uploads/logo/wpes.jpg') ?>" style="width:250px;height:100px;"> </b>
            </td>   
        </tr>
        <tr>
            <td>
                <b style="font-size:25px;"> Yours Faithfully</b>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <b style="font-size:25px;"> Managing Director </b>
            </td>   
        </tr>
        </table>
       

</table>
</center>

<!--<br>
    <br><br><br><br>  
    <br><br><br>
    <footer>
      <center>
        <p style="background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;">
        <strong> Head Office:</strong> 
         < ?php if(!empty($head_office)){ echo $head_office;}?>
        </p>
      </center>
     </footer>-->

    
    <script type="text/javascript">
      window.print();
  
    </script>


</body>
</html> 

 


