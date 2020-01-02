<?php $this->load->view('common/header');
  $this->load->view('common/left_panel');
  ?>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Attendence History
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"> Attendence History</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>&nbsp;<a href="<?= site_url('Welcome/dashboard');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
                          <div class="box-body">
                    <div class="table-responsive" >
                        <table id="table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Date</th>
                                    <th>Login Time</th>
                                    <th>Logout Time</th>
                                    <th>Late Mark</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            

                             <?php 
                                 $sr=0;
                                 foreach ($attendenceHistory as $key) {
                                 
                                 $sr=$sr+1;
                                 ?>
                              <tr>
                                 <td><?php echo $sr; ?></td>
                                 <td><?php echo $key->date; ?></td>
                                 <td><?php echo date("g:i a", strtotime($key->in_time)); ?></td>
                                 <?php if(!empty($key->out_time)){
                                  $outTime=date("g:i a", strtotime($key->out_time));
                                   }
                                   else{
                                    $outTime='';
                                   }
                                   ?>
                                 <td><?php echo $outTime ?></td>
                                 <td><?php echo  $key->late_time?></td>
                                
                                 
                        
                                 </td>
                              </tr>
                              <?php }
                                 ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
      </div>
    </div>
  </section>
</div>
   <?php $this->load->view('common/footer'); ?>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript">
  var url="";
  var actioncolumn="";
  function myFunction(obj,cid) {
    var site_url = $("#site_url").val();
    var ask = confirm("Are You sure to want delete this image?");
    if (ask==true) 
    {
      $(".id"+cid).fadeOut();
      var datastring="cid="+cid;
      $.ajax({
          type:"POST",
          url:site_url+"/Industries_Detail/img_delete",
          data:datastring,
          cache:false,        
          success:function(returndata)
          { 
              location.reload();
          }
        });
    }
}
</script>
