<div style="height:30px;">
    <center><span class="badge" style="color:white;background-color:red;font-size:15px;" id="selectUsers"></span></center>
</div>
<table class="table table-bordered">
    <thead style="background-color:#9fbfdf;">
        <tr>
            <th><center><input class="all_check" type="checkbox" onclick="toggle(this);" /> &nbsp;Check all</center></th>
            <th>Sr.No</th>
            <th>Customer Name</th>
            <th>Mobile No</th>
            <th>Quantity</th>
            <th>Customer Status</th>
            
        </tr>
    </thead>
    <tbody style="background-color:#ecf2f9;">
        <?php if(!empty($get_customer))
         {  
            $sr=1; foreach($get_customer as $cust) 
            {
                if($cust->empnew_id=='0' and $cust->user_status=='Customer_Regular')
                {
                    $status ="<span class='badge' style='background-color:#336699;'>Customer_Regular</span>";
                }
                else if($cust->empnew_id!='0' and $cust->user_status=='Customer_Join')
                {
                    $status ="<span class='badge' style='background-color:#009933;'>Customer_Join</span>"; 
                }
                else if($cust->empnew_id!='0' and $cust->executive_id!='0' and $cust->user_hold=='Customer_Hold')
                {
                    $status ="<span class='badge' style='background-color:#ffc34d;'>Customer_Hold</span>"; 
                }
                 else if($cust->user_hold=='Customer_Hold' and $cust->user_status=='Customer_Hold')
                {
                     $status ="<span class='badge' style='background-color:#ffc34d;'>Customer_Hold</span>"; 
                }
                else
                {
                    $status="Customer";
                }

             ?>
            <tr>
                <td><center><input class="all_check" type="checkbox" name="cust_id[]" value="<?php echo $cust->id;?>"></center></td>
                <td><?php echo $sr++;?></td>
                <td><?php echo ucwords($cust->name);?></td>
                <td><?php echo $cust->mobile;?></td>
                <td><?php echo $cust->pliter.' (Lt)';?></td>
                <td><?php echo $status;?> <?php if($cust->datefrom!='0000-00-00')
                { 
                    echo $cust->datefrom.' To '.$cust->dateto;
                }?></td>
                
            </tr>
        <?php }}else { ?>
        <tr>
            <td colspan="5">No Customer Data Availabel</td>      
        </tr>
    <?php } ?>
    </tbody>
</table>

<script>
function toggle(source) 
{
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');

    for (var i = 0; i < checkboxes.length; i++) 
    {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
} 
    
</script>