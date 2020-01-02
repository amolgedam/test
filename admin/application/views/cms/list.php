<?php $this->load->view('common/header');
      $this->load->view('common/left_panel');
?>

<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $heading;?>
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id']); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"> <?php echo $heading;?></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

                    <div class="box-header">
                        <div class="content-header_button  pull-right"> 
                          <!-- <a class="btn btn-primary" title="Download Format" download="region.xls" href="<?php echo base_url(); ?>assets/location/region.xls"><i class="glyphicon glyphicon-download "></i>Download Format</a>
                            <a class="btn btn-primary" data-toggle="modal" data-target="#upload_location_modal"><i class="glyphicon glyphicon-import "></i>Import from Excel</a> -->
                          <a class="btn btn-primary" title="Create" href="<?= $createAction ?>">Add Cms</a> 
                        </div>  
                    </div>
                
                   
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-striped table-bordered table-hover table-condensed example_datatable">
                            <thead>
                                <tr>
                                   <th>Sr No</th>
                                  <th>Title</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            
                            
                            <tbody>
                            </tbody>
                            
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/custom_js/cms.js"></script>
<script>
    var url = '<?= site_url('Cms/ajax_manage_page')?>';
    var actioncolumn=3;
</script>

