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
          <a href="<?= site_url('ManageCusomerAmount');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a>
        </div>
      </div>
      <div>&nbsp;</div>
      <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">

          <div class="panel-heading">
            <div class="row">
              <div class="col-md-4">
                <h4>View</h4>
              </div>
              <div class="col-md-4">
                &nbsp;
              </div>
            </div>
          </div> 
          <div class="panel-body">
            <div class="col-md-12">
              <div class="panel panel-info">
                <div class="panel-heading">Customer Monthly Report - <?php if(!empty($month)){ echo $month;}?></div>
                <div class="panel-body">
                  <table class="table table-bordered">
                    <tr>
                      <th>Sr.no</th>
                      <th>Delivery Date</th>
                      <th>Delivery time</th>
                      <th>Quantity</th>
                      <th>Address</th>
                    </tr>
                    <?php if(!empty($getorderdata)) { 
                      $sr=1; foreach ($getorderdata as $row) 
                      {  

                          $latitude=$row->emp_latitude;
                           $longitude=$row->emp_longitude;

                           if(!empty($latitude) and !empty($longitude))
                           {
                               $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&key=AIzaSyCMtDBsl6HlxFbLb4vlt1qWfPAAnfpF0hw&libraries=places&callback=initialize'); 

                            $output = json_decode($geocodeFromLatLong);
                            $status = $output->status;
                            //Get address from json data
                            $address = ($status=="OK")?$output->results[1]->formatted_address:'';
                            
                            if(!empty($address))
                            {
                                $address =$address;
                            }    
                            else
                            {
                                $address ='N/A';
                            } 


                           }
                           else
                           {
                              $address ='N/A';
                           }    
                        ?>
                        <tr>
                          <td><?= $sr++;?></td>
                          <td><?= date('jS M Y',strtotime($row->date));?></td>
                          <td><?= $row->time;?></td>
                          <td><?= $row->quantity.'-Liter';?></td>
                          <td><?= $address;?></td>
                        </tr>
                      <?php } }else { ?>
                        <tr>
                          <td colspan="3">No order logs</td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
              <div class="panel panel-info">
                <div class="panel-heading">Customer Monthly Amount - <?php if(!empty($month)){ echo $month;}?></div>
                <div class="panel-body">
                  <table class="table table-bordered">
                    <tr>
                      <th>Sr.no</th>
                      <th>Payment Month</th>
                      <th>Date</th>
                      <th>Amount</th>
                     
                    </tr>
                    <?php if(!empty($get_payment)) { 
                      $sr=1; foreach ($get_payment as $row) 

                      {  
                        ?>
                        <tr>
                          <td><?= $sr++;?></td>
                          <td><?= $row->date;?></td>
                          <td><?= date('jS M Y',strtotime($row->payment_date));?></td>
                          <td><?= 'Rs.'.$row->amount;?></td>
                        </tr>
                      <?php } }else { ?>
                        <tr>
                          <td colspan="3">No order logs</td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
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