<style>
    textarea {
        resize: none;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $heading; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Employees/index'); ?>"><?= $heading;?></a></li>
            <li class="active">
                <?= $heading;?>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    
                   
                   
                    <div class="box-header with-border">

                        <div class="col-md-3">&nbsp;&nbsp;</div>
                        <div class="col-md-3"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="box-body">       
                            
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                  <div class="row">
                                    <div class="col-md-6">
                                    <b>View Customer Details</b>
                                    </div>
                                    
                                   <div class="col-md-4">
                                        <label>Employees Name :</label>
                                        <span>
                                <?php if($getuser->name) { echo ucfirst($getuser->name); }else{ echo "N/A"; } ?> (<?php if(!empty($get_lister)) { echo number_format($get_lister->total_liter,1)." Liters";}?>)</span>
                                    </div>
                                    <div class="col-md-2">
                                     <a href="<?= site_url('Employees/index');?>" class="pull-right btn btn-primary btn-md" style="margin-top:-7px;">Back</a>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="panel-body">
                                    <div class="col-md-12">
                                          <div class="table-responsive" >
                                            <table id="table" class="table table-bordered table-striped example_datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Sr no</th>
                                                        <th>Image</th>
                                                        <th>Full name</th>
                                                        <th>Mobile no</th>      
                                                        <th>Email id</th>
                                                        <th>Quantity</th>
                                                        <th>Address</th>
                                                    </tr>
                                                </thead>     
                                                <tbody>
                                                    <?php if($getcustomer)
                                                    { 
                                                         $sr=1; foreach ($getcustomer as $cus) 
                                                         {
                                                            
                                                            if($cus->empnew_id=='0' and $cus->user_status=='Customer_Regular')
                                                            {
                                                                $status ="<span class='badge' style='background-color:#336699;'>Customer_Regular</span>";
                                                            }
                                                            else if($cus->empnew_id!='0' and $cus->user_status=='Customer_Join')
                                                            {
                                                                $status ="<span class='badge' style='background-color:#009933;'>Customer_Join</span>"; 
                                                            }
                                                            else if($cus->empnew_id!='0' and $cus->executive_id!='0' and $cus->user_hold=='Customer_Hold')
                                                            {
                                                                $status ="<span class='badge' style='background-color:#ffc34d;'>Customer_Hold</span>"; 
                                                            }
                                                            else if($cus->user_hold=='Customer_Hold' and $cus->user_status=='Customer_Hold')
                                                            {
                                                                 $status ="<span class='badge' style='background-color:#ffc34d;'>Customer_Hold</span>"; 
                                                            }

                                                               $getorders=$this->Crud_model->GetData('service_orders','',"customer_id='".$cus->id."'");  

                                                               $getordersdate=$this->Crud_model->GetData('service_orders','max(booking_date) as date',"customer_id='".$cus->id."'",'','','','1');  

                                                                $a =  date('Y-m-d');
                                                                $date1 = $getordersdate->date;
                                                                $date2 = $a;

                                                                $diff = abs(strtotime($date2) - strtotime($date1));

                                                                $years = floor($diff / (365*60*60*24));
                                                                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                                                                $yr = $years;
                                                                $month = $months;
                                                                $day = $days.'days';
                                                                       
                                                        ?>
                                                    <tr>
                                                        <td><?= $sr++;?></td>
                                                        <td> <?php if(!empty($cus->image)) {?>
                                                            <img src="<?= base_url('uploads/users/'.$cus->image);?>" width="70px" height="60px"> 
                                                            <?php }else {?>  
                                                            <img src="<?= base_url('uploads/users/images.jpg');?>" width="70px" height="60px">   
                                                            <?php }?>             
                                                            </td>
                                                        <td><?= ucwords($cus->name);?></td>
                                                        <td><?= $cus->mobile;?></td>
                                                        <td><?php if(!empty($cus->email)){ echo $cus->email;}else{ echo "N/A";}?></td>    
                                                        <td><?= number_format($cus->pliter,1).'&nbsp;'.'Liters';?></td>    
                                                        <td><?= $cus->address;?></td>
                                                        <td><?= $status;?></td>
                                                    </tr>
                                                <?php   }      }else {?>
                                                    <tr>
                                                        <td colspan="9">No data available</td>
                                                    </tr>
                                                <?php } ?>

                                                </tbody>
                                                
                                                
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                              
                              </div>
   
                          
                            <div class="hr-line-dashed"></div>
                            
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    setTimeout(function() {
        $(".errid").fadeOut();
    }, 3000);
</script>

<script type="text/javascript">
    function check_error() 
    {
        var title = $("#title").val().trim();
        var banner = $("#banner").val().trim();
        var button = $("#button").val().trim();

        //alert(button);return false;
        // var company_logo = $("#company_logo").val().trim();
        // var name_filter = /^[A-Za-z]{1}[A-Za-z' ]{2,80}$/i;

        if(title== "") 
        {
            $("#title_err").fadeIn().html("Please enter title");
            setTimeout(function() 
            {
                $("#title_err").fadeOut();
            }, 3000);
            $("#title").focus();
            return false;
        }
        if(button=='Create')
        {

            if(banner== "") 
            {
                $("#banner_err").fadeIn().html("Please Select banner");
               setTimeout(function() 
                {
                    $("#banner_err").fadeOut();
                }, 3000);
                $("#banner").focus();
                return false;
            }

        }



        }
</script>