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
          <div class="panel-heading"><h4>View
            <?php if(!empty($flag)) { ?>
            <a href="<?= site_url('Lead/index/'.$flag);?>">
            <?php }else { ?>
              <a href="<?= site_url('Lead');?>">
              <?php } ?>
              <button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
          <div class="panel-body">
            <div class="col-md-4">
              <div class="form-group">
                <label for="title">Client Name :</label>
                <p><?php if(!empty($client_name)) { echo $client_name;}else {echo "N/A";}?></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="title">Company Name :</label>
                <p><?php if(!empty($company_name)) { echo $company_name;}else {echo "N/A";}?></p>
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
                <label for="type">Client Mobile :</label>
                <p><?php if(!empty($client_mobile)) { echo $client_mobile;}else {echo "N/A";}?></p>
              </div>
            </div>  
            <div class="col-md-4">
              <div class="form-group">
                <label for="type">Email :</label>
                <p><?php if(!empty($email)) { echo $email;}else {echo "N/A";}?></p>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-group">
                <label for="type">Requred Product :</label>
                <p><?php if(!empty($requred_product)) { echo $requred_product;}else {echo "N/A";}?></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="type">Date :</label>
                <p><?php if(!empty($date)) { echo date('d-m-Y',strtotime($date));}else {echo "N/A";}?></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="type">Follow Up Date :</label>
                <p><?php if(!empty($follop_date)) { echo date('d-m-Y',strtotime($follop_date));}else {echo "N/A";}?></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="type">Appoint Date :</label>
                <p><?php if(!empty($appoint_date)) { echo date('d-m-Y',strtotime($appoint_date));}else {echo "N/A";}?></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="type">Alternet no :</label>
                <p><?php if(!empty($alternet_no)) { echo $alternet_no;}else {echo "N/A";}?></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="type">Remark :</label>
                <p><?php if(!empty($remark)) { echo $remark;}else {echo "N/A";}?></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="type">Status Remark :</label>
                <p><?php if(!empty($type_remark)) { echo $type_remark;}else {echo "N/A";}?></p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="type">Address :</label>
                <p><?php if(!empty($address)) { echo $address;}else {echo "N/A";}?></p>
              </div>
            </div>
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
                        <td><?php if(!empty($row->date)){ echo date('d-m-Y',strtotime($row->date));} else {echo "NA";}?></td>
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
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>