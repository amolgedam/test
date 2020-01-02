<?php 
  $this->load->view('common/header'); 
  $this->load->view('common/left_panel');
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title1; ?>
          </h1>
          <?php echo $breadcrum; ?>
        </section>

         <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
     
          <div class="box box-primary">
          <div class="box-body view-box">
                         <a role="button" class="btn btn-danger pull-right" href="<?php echo site_url('CMS/index')?>">Back</a>   
        
          <!-- <div class="col-md-4 text-right">
          <a class="btn btn-primary" href="#">Add Contact Us</a>
          </div> -->
        <!-- /.box-header -->
                <div class="table-responsive ">
                       <table class="table">
                                <tbody>
                                    <tr>
                                        <th width="10%">Title</th>
                                        <th width="5%">:</th>
                                        <td width="85%"><?php  if(!empty($title)){ echo ucwords($title); }else{ echo "N/A";} ?></td>
                                    </tr>
                                    <tr>
                                        <th width="10%">CMS Type</th>
                                        <th width="5%">:</th>
                                        <td width="85%"><?php  if(!empty($display_name)){ echo ucwords($display_name); }else{ echo "N/A";} ?></td>
                                    </tr>
                                  <tr>
                                        <th>Image</th>
                                        <th>:</th>
                                      <td>
                                       

                                        <?php   if(!empty($row->image))
                                        {if(!file_exists("uploads/cms_images/".$row->image)) { ?>
                                              <img src="<?php echo base_url('uploads/no_image.png')?>" width="150px" height="150px" id="thumb" alt="No Image">
                                        <?php } else { ?>
                        
                                           <!--  <img src="<?php echo base_url('uploads/cms_images/'.$row->image)?>" width="150px" height="150px" id="thumb" alt="No Image"> -->

                                            <a href="<?php echo base_url('uploads/cms_images/'.$row->image)?>" data-lightbox="roadtrip"><img src="<?php echo base_url('uploads/cms_images/'.$row->image)?>" width="150px" height="150px" id="thumb" alt="No Image"></a>

                                        <?php } } else { ?>
                                        <img src="<?php echo base_url('uploads/no_image.png')?>" width="150px" height="150px" id="thumb" alt="No Image">
                                       <?php } ?>

                                      </td>
                                    </tr>
                                    <tr> 
                                        <th>Description</th>
                                        <th>:</th>
                                        <td class="text-justify"><?php  if(!empty($description)){ echo ucwords($description); }else{ echo "N/A";}   ?></td>
                                    </tr>
                                    
                                       
                                </tbody>
                            </table>
                </div><!-- /.box-body -->
             
            </div>
              <!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>

        <!-- Main content -->
       <!-- /.content -->
      </div><!-- /.content-wrapper -->
<script>
var url= '';
var actioncolumn='';
</script>
<?php
  $this->load->view('common/footer'); 
?>   