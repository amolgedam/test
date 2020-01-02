

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
          <tr>
            <td colspan="2">
                <div ><hr style="color:blue;"></div>
            </td>
            </tr>
            <br><br>
            <tr>
            <td colspan="2">
              <center><h3><u style="color:blue; "> Increment Letter  </u></h3></center>
            </td>
            </tr> 

            <tr>
              <td style="text-align: left; "> <b style="margin-left: 20px;">Date: 17/01/18 </b></td>
            </tr>
            <br>

            <tr>
              <td style="text-align: left;"><p style="margin-left: 20px;"> Dear Mr. Prasanna Lekurwale, </p> </td>
            </tr>

            <tr>
              <td colspan="2" style="text-align: justify; ">     
               <p style="margin-left:30px;text-align: justify;"><?php if(!empty($description)){ echo $description;}?>
              </p>
              </td>
            </tr>

            <tr>
              <td style="text-align: left;"><b style="margin-left: 20px;"> Thanks and Regards<br><br> <br><br> </b></td>
            </tr>

            <tr>
          <td>
            <span>
              <b style="float: left;margin-left:40px;">_____________<br><br>
              Yours Faithfully </b><br> 
            </span>
          </td>
          <td>
            <span style="float: right;margin-right:10px;margin-right: 50px;">

              <p> ____________________<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Signature</b><br>
                <b> Managing Director</b></p>
              </span>

            </td>
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
    </tr>
  </table>
                