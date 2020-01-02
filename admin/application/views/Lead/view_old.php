<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Manage Lead
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Lead View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row"> 
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Lead');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Client Name :</label>
                      <p><?php if(!empty($client_name)) { echo $client_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Assign To :</label>
                      <p><?php if(!empty($get_assign_name->name)) { echo $get_assign_name->name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="type">client_mobile :</label>
                      <p><?php if(!empty($client_mobile)) { echo $client_mobile;}else {echo "N/A";}?></p>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="type">email :</label>
                      <p><?php if(!empty($email)) { echo $email;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="type">address :</label>
                      <p><?php if(!empty($address)) { echo $address;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="type">requred_product :</label>
                      <p><?php if(!empty($requred_product)) { echo $requred_product;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="type">date :</label>
                      <p><?php if(!empty($date)) { echo $date;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="type">follop_date :</label>
                      <p><?php if(!empty($follop_date)) { echo $follop_date;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="type">appoint_date :</label>
                      <p><?php if(!empty($appoint_date)) { echo $appoint_date;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="type">alternet_no :</label>
                      <p><?php if(!empty($alternet_no)) { echo $alternet_no;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <!-- table -->
                <div class="col-md-12">
                <table class="table table-dark" width="800px" >
    <thead>
      <tr>
        <th>Date</th>
        <th>Remark</th>
       
      </tr>
    </thead>
    <tbody>
      <?php  if(!empty($follow_data)){
       foreach ($follow_data as $row) {?>
      <tr>
        <td><?php if(!empty($row->date)){ echo $row->date;} else {echo "NA";}?></td>
        <td><?php if(!empty($row->remark)){ echo $row->remark;} else {echo "NA";}?></td>
      </tr>
    <?php }} ?>
    </tbody>
  </table>
</div>
   <!-- End Table -->
            </div>
        </div>
      </div>
    </div>
  </section>
  
   
</div>
     
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>