<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Industries View
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Industries View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Requirement');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Requirement Number :</label>
                      <p><?php if(!empty($requirement_no)) { echo $requirement_no;}else {echo "N/A";}?></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Business Name :</label>
                      <p><?php if(!empty($business_name)) { echo $business_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Owner Name :</label>
                      <p><?php if(!empty($owner_name)) { echo $owner_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Address :</label>
                      <p><?php if(!empty($address)) { echo $address;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Contact Number:</label>
                      <p><?php if(!empty($contact_info)) { echo $contact_info;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Alernate Number :</label>
                      <p><?php if(!empty($alter_info)) { echo $alter_info;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Pan Number :</label>
                      <p><?php if(!empty($pan_number)) { echo $pan_number;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">GST Number :</label>
                      <p><?php if(!empty($gst_number)) { echo $gst_number;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Product Name :</label>
                      <p><?php if(!empty($product_name)) { echo $product_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="title">Product Description :</label>
                      <p><?php if(!empty($product_desc_number)) { echo $product_desc_number;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Logo Designing :</label>
                      <p><?php if(!empty($logo)) { echo $logo;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Domain Name :</label>
                      <p><?php if(!empty($domain_name)) { echo $domain_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Required Tabs :</label>
                      <p><?php if(!empty($required_tab)) { echo $required_tab;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Content :</label>
                      <p><?php if(!empty($content)) { echo $content;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Social Media Links:</label>
                      <p><?php if(!empty($social_link)) { echo $social_link;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Admin Panel :</label>
                      <p><?php if(!empty($admin)) { echo $admin;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Order Placing Date  :</label>
                      <p><?php if(!empty($order_date)) { echo $order_date;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Expected Delivery Date :</label>
                      <p><?php if(!empty($expected_date)) { echo $expected_date;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Any Referral Website :</label>
                      <p><?php if(!empty($referred)) { echo $referred;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Mode of Payment :</label>
                      <p><?php if(!empty($mode_of_payment)) { echo $mode_of_payment;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Total Payment :</label>
                      <p><?php if(!empty($total_payment)) { echo $total_payment;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">GST Included :</label>
                      <p><?php if(!empty($gstadd)) { echo $gstadd;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Total Payment + GST Included  :</label>
                      <p><?php if(!empty($total_payment_gst)) { echo $total_payment_gst;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Advance Payment :</label>
                      <p><?php if(!empty($advance_payment)) { echo $advance_payment;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Balance Payment :</label>
                      <p><?php if(!empty($balance_payment)) { echo $balance_payment;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
               
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
     
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>