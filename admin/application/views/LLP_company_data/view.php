
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        LLP Compnay Data View
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">LLP Compnay Data View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('LLP_company_data');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Company Code:</label>
                      <p><?php if(!empty($company_code)) { echo $company_code;}else {echo "N/A";}?></p>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="form-group">
                      <label>Company Name :</label>
                      <p><?php if(!empty($company_name)) { echo $company_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="form-group">
                      <label>District :</label>
                      <p><?php if(!empty($district)) { echo $district;}else {echo "N/A";}?></p>
                    </div>
                </div>
               <div class="col-md-4">
                    <div class="form-group">
                      <label>State :</label>
                      <p><?php if(!empty($state)) { echo $state;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Email :</label>
                      <p><?php if(!empty($email)) { echo $email;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                      <label>Delivery Date :</label>
                      <p><?php if(!empty($delivery_date)) { echo $delivery_date;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                      <label>Lead Remark :</label>
                      <p><?php if(!empty($lead_remark)) { echo $lead_remark;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                      <label>Required product :</label>
                      <p><?php if(!empty($required_product)) { echo $required_product;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Description :</label>
                      <p><?php if(!empty($description)) { echo $description;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Address :</label>
                      <p><?php if(!empty($address)) { echo $address;}else {echo "N/A";}?></p>
                    </div>
                </div> 
                  <div class="col-md-12">
              <table class="table table-bordered" width="300px" border="1px" cellspacing="1px" cellpadding="1px">
                <thead>
                  <tr>
                    <th width="100px"><center>Date</center></th>
                    <th width="300px">Remark</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  if(!empty($follow_data)){
                    foreach ($follow_data as $row) {?>
                      <tr>
                        <td><center><?php if(!empty($row->follop_date)){ echo date('d-m-Y',strtotime($row->follop_date));} else {echo "NA";}?></center></td>
                        <td><?php if(!empty($row->remark)){ echo $row->remark;} else {echo "NA";}?></td>
                      </tr>
                    <?php }}else {?>
                      <tr>
                        <td colspan="2"><center>No Followup Data</center></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
                
                <br>
                 <div class="col-md-12">
                    <div class="form-group">
                      
                      <?php $addess1=$address;?>

                <iframe width="600px" height="350px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $addess1 ?>&output=embed"></iframe>
                    </div>
                </div>
                 <div class="col-md-12">
                    <div class="form-group">
                      
                      <?php $string =$address;
                          $zipcode = preg_match("/\b\d{6}\b/", $string, $matches);
         //print_r($matches[0]);   ?>

                <iframe width="600px" height="350px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $matches[0];?>&output=embed"></iframe>
                    </div>
                </div>
                
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
     

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>


