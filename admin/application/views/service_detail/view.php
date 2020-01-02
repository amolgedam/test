<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Manage Service-Detail View
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Services-Detail View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">     
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Service_detail');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                      <label for="title">Title :</label>
                      <p><?php if(!empty($title)) { echo $title;}else {echo "N/A";}?></p>
                    </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                      <label for="type">Type :</label>
                      <p><?php if(!empty($service_type)) { echo $service_type;}else {echo "N/A";}?></p>
                    </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="type">Heading :</label>
                              <p><?php if(!empty($heading)) { echo $heading;}else {echo "N/A";}?></p>
                            </div>
                        </div> 
                         
                </div>
                  <div class="col-md-12">
                        <div class="form-group">
                          <label for="type">Description :</label>
                          <p><?php if(!empty($description)) { echo $description;}else {echo "N/A";}?></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                      <div class="row">
                        <div><label for="type">Image :</label></div>     
                        <?php foreach ($row1 as $img) { ?>
                        <div class="col-md-3">    
                           <p><img src="<?php echo base_url("uploads/service/".$img->image) ?>" style="height:200px;width:200px;padding: 10px;"><center><a class="btn btn-danger" value="submit" onclick="deleteItem(this,<?php echo $img->id; ?>)">remove</center></a> </p>
                       </div>
                         <?php } ?>
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
function deleteItem(obj,cid) 
{
    var site_url = $("#site_url").val();
    var ask = confirm("Are You sure to want delete this image?");
    if (ask==true) 
    {
      $(".id"+cid).fadeOut();
      var datastring="cid="+cid;
      $.ajax({
          type:"POST",
          url:site_url+"/Service_detail/img_delete",
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