<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $heading; ?>
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"><?php echo $heading; ?></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

                    <div class="box-header">
                        <div class="content-header_button  pull-right"> 
            
                        </div>  
                    </div>
                
                   
                <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-bordered table-striped example_datatable">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Employee Name</th>
                                    <th>Date</th>
                                    <th>in Time </th>
                                    <th>out Time</th>
                                    <th>Description</th>
                                    <!--  <th>Status</th> -->
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
    var url = '<?= site_url('Employee_feedback/ajax_manage_page')?>';
    var actioncolumn=6;
</script>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript">


</script>