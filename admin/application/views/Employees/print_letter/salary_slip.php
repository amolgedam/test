
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
  table{
    border:none;
  }
  .tbl{
    border:2px solid black;
    border-collapse: collapse;
    text-align: center;

  }
  th{
    padding:5px;
    text-align: left;
    font-size:17px;
  }
  td{
      padding:5px;
  }
  .t1{
    height: 250px;
    width: 96%;
    margin-left: 20px;
  }

  .t2{
    margin-left: 60px;
  }
</style>
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
                <address style=" width:400px; margin-left:400px; font-size:20px;"> <?php if(!empty($address)){ echo $address;}?>
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
    </table>
        
    <table align="left" style="margin-left: 20px;">
    
      <tr>
        <td> <b style="margin-left: 20px;"> Employee Name:&nbsp;</b> <?php if(!empty($name)) { echo ucfirst($name);} ?> </td> 
      </tr>
      
      <tr>
        <td><b style="margin-left: 20px;"> Designation:&nbsp;</b> <?php if(!empty($designation_name)) { echo ucfirst($designation_name);} ?> </td> 
      </tr>
      
      <tr>
        <td><b style="margin-left: 20px;"> Month & Year:&nbsp;</b> <?php echo date('Y-m-d',strtotime('M,Y')); ?> </td>
      </tr>
    </table>
  
</table>   
  <br>

<table class="tbl t1">
  <tr class="tbl">
    <th class="tbl">Earnings</th>
    <th class="tbl">Amount</th>
    <th class="tbl">Deductions</th>
    <th class="tbl">Amount</th>
  </tr>
  <tr class="tbl">
    <td class="tbl"><b>Basic & DA</b></td>
    <td class="tbl">5600</td>
    <td class="tbl"><b>Attendance</b></td>
    <td class="tbl">00 </td>
  </tr>
  <tr class="tbl">
    <td class="tbl"><b>HRA</b></td>
    <td class="tbl">1500</td>
    <td class="tbl"><b>Advance Pay</b></td>
    <td class="tbl">00</td>
  </tr>
  <tr class="tbl">
    <td class="tbl"><b>PF</b></td>
    <td class="tbl"></td>
    <td class="tbl"><b></b></td>
    <td class="tbl"></td>
  </tr>
  <tr class="tbl">
    <td class="tbl"><b>Conveyance</b></td>
    <td class="tbl">500</td>
    <td class="tbl"><b>Others</b></td>
    <td class="tbl"></td>
  </tr>
  <tr class="tbl">
    <td class="tbl"><b>Other Allowance</b></td>
    <td class="tbl">400</td>
    <td class="tbl">Others</td>
    <td class="tbl">--</td>
  </tr> 
  <tr class="tbl">
    <td class="tbl"><b>Total Addition</b></td>
    <td class="tbl">Rs.8000</td>
    <td class="tbl"><b>Total Deduction</b></td>
    <td class="tbl">Rs.00</td>
  </tr><tr class="tbl">
    <td class="tbl"></td>
    <td class="tbl"></td>
    <td class="tbl"><b>NET Salary</b></td>
    <td class="tbl">Rs. 8000</td>
  </tr>
  <tr>

 </table>
  <br>
 <table align="left" style="margin-left: 20px;">
    
      <tr>
        <td><b>Rupees:&nbsp;</b>Eight Thousand only</td> 
      </tr>
      
      
      <tr>
        <td><b>Date:&nbsp;</b>10th August 2017 </td>
      </tr>

 </table>
  
    <br>
        <table align="left" style="margin-left: 20px;">
        <tr>
            <td>
                <b>&nbsp;&nbsp;&nbsp;&nbsp;----------------------------</b>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <b> <img src="<?php echo base_url('uploads/logo/wpes.jpg') ?>" style="width:200px;height:90px;"> </b>
            </td>   
        </tr>
        <tr>
            <td>
                <b style="font-size:15px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yours Faithfully</b>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
                <b style="font-size:15px;"> Managing Director </b>
            </td>   
        </tr>
        </table>


 
 
</table> 
 </center>
  <!--<br>
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