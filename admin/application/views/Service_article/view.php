<div class="content-wrapper">
    <section class="content-header">
      <h1>
          Service Article View
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Services-Article</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">     
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Service_article');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                          <label for="Article Heading">Article Heading :</label>
                          <p><?php if(!empty($service_heading_id)) { echo $service_heading_id;}else {echo "N/A";}?></p>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="type">Heading :</label>
                              <p><?php if(!empty($heading)) { echo $heading;}else {echo "N/A";}?></p>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="type">Image :</label>
                             <p><img src="<?php echo base_url() ?>uploads/ourservice/<?php echo $image ?>" style="height:80px;width:80px"></p> 
                            </div>
                        </div>
                    <div class="col-md-12">
                        <div class="form-group">
                          <label for="type">Description :</label>
                          <p><?php if(!empty($description)) { echo $description;}else {echo "N/A";}?></p>
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