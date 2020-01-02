<div class="content-wrapper">
    <section class="content-header">
      <h1>
          <?php echo $heading;?>
        <small><!--advanced tables--></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"><?php echo $heading;?></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          <div>
            <div class="col-lg-12">
              <a href="<?= site_url('Subcategory/index/');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a>
            </div>
            </div>
            <div>&nbsp;</div>
            <div class="col-lg-12 col-md-12">
              <div class="panel panel-default">

              <div class="panel-heading">
                <div class="row">
                <div class="col-md-4">
                <h4><?php echo $heading;?></h4>
              </div>
              <div class="col-md-4">
                &nbsp;
              </div>
              
                <div class="col-md-1">
               
               </div>
                </div>
                </div>
              
              <div class="panel-body">
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Product Image:</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(file_exists('uploads/subcategory/'.$image)) 
                      {
                          if(!empty($image))
                          {
                        ?>
                      <img src="<?= base_url('uploads/subcategory/'.$image)?>" style="height:100px;width:150px;">
                    <?php }else { ?>
                      <img src="<?= base_url('uploads/subcategory/9627_index.jpg')?>" style="height:100px;width:150px;">
                    <?php } }else {?>
                      <img src="<?= base_url('uploads/subcategory/9627_index.jpg')?>" style="height:100px;width:150px;">
                    <?php } ?>

                     </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Product name:</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($subcat_name)) { echo $subcat_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Half Liter Price :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($half_liter_price)) { echo 'Rs. '.number_format(round($half_liter_price),2);}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">One Liter Price :</label>&nbsp;<span id="enq_code_err" ></span>
                      <p><?php if(!empty($one_liter_price)) { echo 'Rs. '.number_format(round($one_liter_price),2);}else {echo "N/A";}?></p>
                    </div>
                </div>             
             
              </div>
            
            <!--  <div class="container">
              <h3>Product List</h3>           
              <table class="table table-bordered">
                <thead>
                  <tr>
                    
                    <th>Last Qauntiy</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Available Quantity</th>
                    <th>date</th>
                    <th>description </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if(!empty($get_productlog)) {

                   foreach($get_productlog as $log)  
                   { 
                      if($log->status=='Add')
                      {
                        $status = '<span class="badge" style="background-color:#336600;">'.$log->status.'</span>';
                      }
                      else
                      {
                        $status = '<span class="badge" style="background-color:#660000;">'.$log->status.'</span>';
                      }

                    ?>
                  <tr>
                    <td><?php if(!empty($log->last_quantity)) { echo $log->last_quantity.'Kg';}else { echo "N/A";}?></td>
                    <td><?= $status; ?></td>
                    <td><?php if(!empty($log->quantity)) { echo $log->quantity.'Kg';}else { echo "N/A";}?></td>
                    <td><?php if(!empty($log->total_quantity)) { echo $log->total_quantity.'Kg';}else { echo "N/A";}?></td>
                    <td><?php if(!empty($log->date)) { echo date('jS m Y',strtotime($log->date));}else { echo "N/A";}?></td>
                    <td><?php if(!empty($log->description)) { echo $log->description;}else { echo "N/A";}?></td>
                  </tr>
                <?php }}else{?>
                  <tr><td colaspan="6">No records found</td></tr>
                <?php }?>
                </tbody>
              </table>
            </div> -->
            </div>
            </div>
            </div>
          </section>
        </div>

            
<script>
    var url = '<?= site_url('EnquiryForm/ajax_manage_page')?>';
    var actioncolumn=10;
</script>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>

<script type="text/javascript">
/*function checkStatus(id){
    $("#statusId").val(id);
    $("#deleteId").val(id);
}*/



function Delete(obj,cid)
{
  
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  { 
    $(".id"+cid).fadeOut();
    var datastring="cid="+cid;
    $.ajax({
        type:"POST",
        url:"<?php echo site_url('EnquiryForm/delete'); ?>",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
          table.draw();
         
        }
      });
  }
}

function statuss(id)
{ 
  var cnf = confirm('Are you sure to change the status?');
  if(cnf==true)
  {
    var status=$("#status"+id).val();
    if(status=="Active")
    {
      $("#statusVal"+id).removeClass("btn-success");
      $("#statusVal"+id).addClass("btn-danger");
      $("#statusVal"+id).attr("onclick", "statuss("+id+",'Inactive')").html('Inactive');
      var status ='Inactive';
      $("#status"+id).val('Inactive');
    }
    else
    {
      $("#statusVal"+id).removeClass("btn-danger");
      $("#statusVal"+id).addClass("btn-success");
      $("#statusVal"+id).attr("onclick", "statuss("+id+",'Active')").html('Active');
      var status ='Active';
      $("#status"+id).val('Active');
    } 
    var datastring="id="+id+"&status="+status+"&statusupdate="+'update';
    $.ajax({
        type:"POST",
        url:"<?=  site_url('EnquiryForm/change_status')?>",
        data:datastring,
        cache:false,                    
        success:function(returndata)
        {
          //alert(returndata);
          //console.clear();  
        }
      });   
  }
}
</script>
<script type="text/javascript">
  
  function send_data()
  {
     var order_process = $("#order_process").val()
     var order_id = $("#order_id").val()
     var customer_id = $("#customer_id").val()

     if(order_process=='')
     {
        $("#order_process_err").fadeIn().html("Required");
            setTimeout(function() 
            {
                $("#order_process_err").fadeOut();
            }, 3000);
            $("#order_process").focus();
            return false;

     }

     $.ajax({
              type:"POST",
              cache:false,
              url:"<?= site_url('ManageCashOrder/updatedOrderProcess');?>",
              data:{order_process:order_process,order_id:order_id,customer_id:customer_id},
              success:function(returndata)
              {

               // alert(returndata);return false;

                if(returndata=='1')
                {
                   location.reload();
                }

              }


     })


  }


</script>











