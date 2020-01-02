

<?php 
   $this->load->view('common/header'); 
   $this->load->view('common/left_panel');
    $sec = $this->uri->segment(3);
   $id = $this->uri->segment(4);
   ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1><?php echo $title1; ?></h1>
   <?php echo $breadcrum; ?>
</section>
<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-primary">
            <div class="box-body view-box">
               <button type="button" class="btn btn-danger btn-md pull-right" onclick="window.history.back()">Back</button>
               <div class="table-responsive ">
                  <table class="table">
                     <tbody>
                        <tr>
                           <th>Title</th>
                           <th>:</th>
                           <td><?php if(!empty($row->title)){ echo ucwords($row->title); }else{ echo "N/A";} ?></td>
                        </tr>

                        <tr>
                           <th>Subject</th>
                           <th>:</th>
                           <td><?php if(!empty($row->subject)){ echo ucwords($row->subject); }else{ echo "N/A";} ?></td>
                        </tr>

                        <tr>
                           <th>Status</th>
                           <th>:</th>
                           <td><?php if(!empty($row->status)){ echo ucwords($row->status); }else{ echo "N/A";} ?></td>
                        </tr>
                        <tr>
                           <th>Description</th>
                           <th>:</th>
                           <td><?php if(!empty($row->description)){ echo $row->description; }else{ echo "N/A";} ?></td>
                        </tr>
                        
                     </tbody>
                  </table>
               </div>
               <!-- /.box-body -->             
            </div>
            <!-- /.box -->
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
</section>
</div>
<script>
   var url= '';
   var actioncolumn='';
     var pageLength='';
</script>
<?php
   $this->load->view('common/footer'); 
   ?>

