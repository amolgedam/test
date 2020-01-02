<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Quotation Detailed View
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Quotation View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View Quotation for : <b><?php echo $invoiceData->id; ?></b><a href="<?= site_url('Quotation');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Customer Name :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($customer_name)) { echo $customer_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Email ID :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($email)) { echo $email;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Mobile No :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($mobile_no)) { echo $mobile_no;}else {echo "N/A";} ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Customer Address :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($address)) { echo $address;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">City :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($city_id)) { echo $city_id;}else {echo "N/A";} ?></p>
                    </div>
                </div>

                
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Quotation Value :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($invoiceData->total_amount)) { echo "<i class='fa fa-inr'></i> ".number_format($invoiceData->total_amount);}else {echo "N/A";}?></p>
                    </div>
                </div>
            </div>
            <div class="panel-heading"><h4>Quotation Details</h4></div>
              <div class="panel-body">
              <table class="table table-striped" cellpadding="0" cellspacing="0">
                <thead>
                  <th>Product Name</th>
                  <th width="40%">Description</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>GST</th>
                  <th>Discount</th>
                  <th>Total</th>
                </thead>
            <?php 
            foreach($getlogdata as $key)
              { 

                // $get_pro = $this->Crud_model->GetData('software','title',"id='".$key->product_name."'",'','','','1')
                ?>
                <tr>
                  <td><?= $key->product_name; ?></td>
                  <td>
                      <?= $key->description; ?>
                   <!--  < ?php 
                    $get_d = explode(",",$key->description);

                     $sr=1; foreach($get_d as $d)
                    { 
                      $get_pro = $this->Crud_model->GetData('software_details','software_details',"id='".$d."'",'','','','1') 
                    ?>


                        <?= $get_pro->software_details;?>,
                     < ?php } ?>  -->
                    </td>
                  <td><i class='fa fa-inr'></i> <?= number_format($key->price); ?></td>
                  <td><?= $key->quantity; ?></td>
                  <td><?= $key->gst; ?> %</td>
                  <td><?= $key->discount; ?> %</td>
                  <td><i class='fa fa-inr'></i> <?= number_format($key->total); ?></td>
                </tr>
            <?php } ?>
              </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
     
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>