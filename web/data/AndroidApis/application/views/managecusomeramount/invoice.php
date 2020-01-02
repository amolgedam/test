<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    .fontsize
    {
      font-size:13px;

    }

  </style>
</head>
<body style="width:275px;">
  <table id="pdf_div" cellspacing="7px" cellpadding="0px" border="0" align="center" width="150px" style="border:1px solid #000;">
    <tr>
      <td>
        <table cellspacing="7px" cellpadding="0px" border="0" align="center" width="270px" style="border:1px solid #000;">
          <tr>
            <td colspan="4" class="text-center" style="font-size: 18px;"><center><b><?= $setting[0]->details;?></b></center></td>
          </tr>
          <tr>
            <td colspan="4" class="text-center fontsize"><?= $setting[1]->details;?></td>
          </tr>
          <tr>
            <td colspan="4" class="text-center fontsize">Mobile No :<?= $setting[5]->details;?></td>
          </tr>
          <!-- <tr>
            <td colspan="4" class="text_center"><h5>Shop Timing 11.00AM To 8:30PM</h5></td>
          </tr> -->
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table cellspacing="0px" cellpadding="0px" border="0" align="center" width="100%">
          <!-- <tr>
            <td colspan="4" class="text_right" style="padding:7px 0px;">Time : &nbsp;&nbsp;&nbsp; <?php echo date('h:i:s');?></td>
          </tr>  --> 
          <tr>
            <td class="fontsize"><b>Ordr No:</b></td>
            <td class="fontsize"><?= $order_no;?></td>
            <td class="fontsize"><b>Order Date:</b></td>
            <td class="fontsize"><?= date('d-m-Y h:i:A',strtotime($created));?></td>
          </tr>
          <tr>
            <td class="fontsize"><b>Name:</b></td>
            <td class="fontsize"><?= $name;?></td>
            <td class="fontsize"><b>Mobile No:</b></td>
            <td class="fontsize"><?= $mobile;?></td>
          </tr>
          <tr>
            <td class="fontsize"><b>Paymnet Mode:</b></td>
            <td class="fontsize"><?= $payment_type;?></td>
            <td class="fontsize"><b>Delivered Date:</b></td>
            <td class="fontsize"><?= date('d-m-Y',strtotime('+1 day',strtotime($created)));?></td>
          </tr>
          <tr>
            <td class="fontsize"><b>Order Status:</b></td>
            <td class="fontsize"><?= $order_status;?></td>
            <!-- <td><b>Delivered Date</b></td>
            <td><?= date('d-m-Y');?></td> -->
          </tr>
          <tr> 
            <td colspan="4">&nbsp;</td>
          </tr>
           <tr>
            <td class="fontsize"><b>Address:</b></td>
            <td colspan="3" class="fontsize"><?= $address;?></td>
          </tr>
         <!--  <tr>
            <td><b>Contact :</b></td>
            <td colspan="3"><?php echo $row->contact1 ?></td>
          </tr>
          <tr>
            <td><b>JC Status :</b></td>
            <td colspan="3">Job card slip received</td>
          </tr> -->
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table cellspacing="0px" cellpadding="7px" border="1" align="center" style="width:268px;">
          <tr>
            <th style="width:100px;" class="fontsize"><b>Item</b></th>
            <th style="width:20px;" class="fontsize"><b>Qty</b></th>
            <th style="width:20px;" class="fontsize"><b>PerKG</b></th>
            <th style="width:20px;" class="fontsize"><b>Total</b></th>
          </tr>
          <?php if(!empty($getorderdetails)) {

              foreach ($getorderdetails as $data)
             {
              
            ?>
          <tr>
            <td class="fontsize"><?= $data->subcat_name;?></td>
            <td class="fontsize"><?= $data->quantity;?></td>
            <td class="fontsize"><?= $data->price;?></td>
            <td class="fontsize"><?= 'Rs.'.number_format($data->total,2);?>/-</td>
          </tr>
        <?php } }?>
        <tr>
            <td colspan="3" class="fontsize">&nbsp;</td>
            <td class="fontsize">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" class="fontsize"><b>Sub Total:</b></td>
            <td class="fontsize"><?php echo 'Rs.'.number_format(round($sub_total),2);?>/-</td>
        </tr>
        <tr>
            <td colspan="3" class="fontsize"><b>Service Charges:</b></td>
            <td class="fontsize"><?php echo 'Rs.'.number_format(round($extra_charges),2);?>/-</td>
        </tr>
        <tr>
            <td colspan="3" class="fontsize"><b>Amount to paid:</b></td>
            <td class="fontsize"><b><?php echo 'Rs.'.number_format(round($final_amount),2);?>/-</b></td>
        </tr>
        </table>
      </td>
    </tr>
    <!-- <tr>
        <td class="fontsize"><b>Sub Total:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo 'Rs.'.number_format($sub_total,2);?>/-</td>               
    </tr>
     <tr>
        <td class="fontsize"><b>Service Charges:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo 'Rs.'.number_format($extra_charges,2);?>/-</td>               
    </tr>
     <tr>
        <td colspan="2" class="fontsize"><b>Amount to paid:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo 'Rs.'.number_format($final_amount,2);?>/-</b></td> 
           
    </tr> -->
    <!-- <tr>
      <td style="text-align: justify">
        <b>Note : </b> Reparing items should be collected within three months from the reparing date after that we will not be responsible for the products.
      </td>
    </tr> -->
    <tr class="information" >
                <td style="text-align: center">If you have any question concerning this Order contact with us.</td>
            </tr>
             <tr class="information">
                <td style="text-align: center"><strong>Thank you for your business</strong></td>
            </tr>
  </table><br>
  <div id="show_print">
  <center>
      <button type="button" class="btn-bt-defaullt btn-sm" onclick="printDiv('pdf_div');" id="id_print" >Print</button>
    <a  class="btn-bt-defaullt btn-sm" href="<?= site_url('ManageCashOrder/index/Cash');?>" id="id_back" >Back</a>
    <a  class="btn-bt-defaullt btn-sm" href="<?= site_url('GeneratePDF/Openpdf/'.$id);?>" id="id_download" onclick="return hide_buttons();">Download</a>
  </center>
</div>
</body>
</html>
<script type="text/javascript">
  
  function hide_buttons()
  {
    
    $("#id_download").hide();
    $("#id_back").hide();
    $("#id_print").hide();
    
  }

</script>
<script>
function printDiv(divName) 
{
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
} 
</script>





