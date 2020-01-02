
<cenetr>
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
            <hr style="color:blue; width: 100%;">
          </td>
        </tr>
        <tr>
        <td colspan="2">
          <span><b style="margin-left: 20px;">Date: 26/06/2018</b> </span>
        </td>
      </tr>
        <tr>
          <td>

          </td>
          <td>

          </td>
        </tr>
        <tr>
          <td colspan="2" >
            <center><h3 ><u><?php if(!empty($title)) { 
          echo ucfirst($title);  } ?></u></h3></center> <br>

            <p style="margin-left:30px; text-align: justify;"><?php if(!empty($description)){ echo $description;}?>
              </p>
            </td>
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
            <td colspan="2" style="color:black;">
              <hr >
            </td>

          </tr>
          <tr>
          <td colspan="4">
            <center  style="background-color: #00264d; color: white;padding: 15px; ">

<strong> Head Office:</strong> 
         <?php if(!empty($head_office)){ echo $head_office;}?> 
</center>
          </td> 
</tr>


 </tr>                            
  </table>
  <cenetr>

