
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
              <div class="panel-heading"><h4>View<a href="<?= site_url('HardwareDetail');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Title :</label>
                      <p><?php if(!empty($titleData)) { echo $titleData;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Heading :</label>
                      <p><?php if(!empty($heading)) { echo $heading;}else {echo "N/A";}?></p>
                    </div>
                </div>
               <div class="col-md-12">
                    <div class="form-group">
                      <label>Description :</label>
                      <p><?php if(!empty($description)) { echo $description;}else {echo "N/A";}?></p>
                    </div>
                </div>
               <div class="col-md-12">
                    <div class="form-group im">
                      
                      
                      <?php if(!empty($image)) { ?>
                        <div><label>Image :</label></div>
                        <?php foreach ($image as $row) {?>
                          <div class="col-md-3">
                              <p><img src="<?php echo base_url()?>uploads/hardware/<?php echo $row->image;?>" width="230px" height="200px" style="margin-top: 20px;">&nbsp;<center>
                                <a href="" class="btn btn-danger"  onclick="myFunction(this,<?php echo $row->id;?>)">Remove</a></center></p>
                              &nbsp;&nbsp;&nbsp;&nbsp;
                          </div>
                          <?php } ?>
                          <?php }else {echo "N/A";}?>
                          
                    </div>
                </div>
                
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
     

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
          url:site_url+"/HardwareDetail/img_delete",
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
