<style>
  table{
    border:none;

  }
  .tbl{
    border:1px solid black;
    border-collapse: collapse;
    text-align: center;

  }
  th{
    padding: 2px;
    text-align: left;
    font-size:17px;
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

          <table>
            <center>
              <?php if(!empty($logo)) {?>
      <img src="<?php echo base_url('uploads/logo/'.$logo) ?>" style="height: 100px;" />
       <?php }?>
    </center>
            <h1 style="text-align: center;"><?php if(!empty($title)) { 
          echo ucfirst($title);  } ?></h1>
            <table align="left" width="70%" style="margin-left:18px;">
              <tr>
                <tr><th>Employee Name:&nbsp;<?php if(!empty($name)) { 
          echo ucfirst($name);  } ?></th></tr>
                <tr><th> Designation:&nbsp;<?php if(!empty($designation_name)) { 
          echo ucfirst($designation_name);  } ?> </th></tr>
                <tr><th> Month & Year:&nbsp;<?php echo date('Y-m-d',strtotime('M,Y'));?></th></tr>
              </tr>
            </table>
            <br>

<table class="tbl t1">
  <tr class="tbl">
    <th class="tbl">Earnings</th>
    <th class="tbl">AMOUNT</th>
    <th class="tbl">Deductions</th>
    <th class="tbl">AMOUNT</th>
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
  <table align="left" style="margin-left: 20px;">
    <tr style="margin-left: 1200px;">
      <tr><th>Rupees: Eight Thousand only</th></tr>
      <tr><th> Date:   10th August 2017</th></tr>

    </tr>
  </table>
  <br>
  <br>
  <br>

  <table align="left" style="margin-left: 20px;">
    <tr style="margin-left: 1200px;">
      <th>Signature Employee:_______________</th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th style="float:right"> Director:_______________</th>   
    </tr>


  </table>

</table>
