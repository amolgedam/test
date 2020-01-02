
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        
        <?php echo $header;?>

        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"><?= $page_title; ?></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

                    <div class="box-header">
                    <?php 
     $assign_developer=$this->Crud_model->GetData('admin','',"designation_id='8' or designation_id='10' and status='Active'");
     
        ?>
         <?php 
                       if($_SESSION['SESSION_NAME']['designation']=='admin')
                    {  ?>
                <div class="col-md-4">
                            <label>Select Assign <span id="assign_id_err" style="color:red;"></span></label>
                            <select name="assign_id" id="assign_id" class="form-control filter_search_data5">
                            <option value=''>--Assign Developer--</option>
                    <?php if(!empty($assign_developer)) { foreach($assign_developer as $assign){?>
                            <option value="<?php echo $assign->id;?>"><?php echo ucfirst($assign->name);?>     </option>
                                
                       <?php }} ?>
                            </select>
                          </div> 
                        <div class="content-header_button  pull-right"> 
                          
                          <a class="btn btn-primary" title="Create" href="<?= $action ?>">Add task</a> 
                        </div>  
                         <?php } ?>
                    </div>
                
                   <input type="hidden" class="filter_search_data5">
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-striped table-bordered table-hover table-condensed example_datatable">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Employee Name</th>
                                    <th>Tasks Image</th>
                                    <th>Date</th>
                                    <th>Tasks</th> 
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
<script>
    var url = '<?= site_url('Taskassign/ajax_manage_page/'.$flag)?>';
    var actioncolumn=6;
</script>
 <script type="text/javascript" src="<?php echo base_url('assets/custom_js/task_assign.js');?>"></script>
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); 
</script>













