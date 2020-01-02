<style>
    textarea 
    {
        resize: none;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $heading; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Login/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('CategoryMaster/index'); ?>"><?= $heading;?></a></li>
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

                        <div class="col-md-4">&nbsp;&nbsp;</div>
                        <div class="col-md-4"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data">
                            <div class="row">  
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <div class="col-md-4">
                                            <label class="control-label">Employee From<span style="color:red;">*</span></label> <span style="color:red" id="errempfrom"> </span><?php echo form_error('errempfrom')?>
                                       
                                            
                                            <select name="empfrom" id="empfrom" class="form-control">
                                                <option value="0">Select Option</option>
                                                
                                                <?php foreach ($emp as $key => $value) { ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                             <label class="control-label">Employee To<span style="color:red;">*</span></label> <span style="color:red" id="errempto"> </span><?php echo form_error('errempto')?>
                                            <select name="empto" id="empto" class="form-control">
                                                <option value="0">Select Option</option>
                                                <?php foreach ($emp as $key => $value) { ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                             <label class="control-label">Assign Status<span style="color:red;">*</span></label> <span style="color:red" id="errassignstatus"> </span><?php echo form_error('errassignstatus')?>
                                            <select name="assignstatus" id="assignstatus" class="form-control">
                                                <option value="0">Select Option</option>
                                                <option value="tmp">Temporary</option>
                                                <option value="per">Parmanent</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 statusDate" style="display: none">
                                             <label class="control-label">Date From<span style="color:red;">*</span></label> <span style="color:red" id="errdatefrom"> </span><?php echo form_error('errdatefrom')?>
                                            <input type="date" name="datefrom" id="datefrom" class="form-control">
                                        </div>

                                        <div class="col-md-4 statusDate" style="display: none">
                                             <label class="control-label">Date To<span style="color:red;">*</span></label> <span style="color:red" id="errdateto"> </span><?php echo form_error('errdateto')?>
                                            <input type="date" name="dateto" id="dateto" class="form-control">
                                        </div>                                        



                                        <div class="col-md-12" style="display: none" id="custList">
                                            <h5>Customer List</h5>
                                               <span style="color:red;">*</span><span style="color:red" id="selectUsers"> </span><?php echo form_error('selectUsers')?>

                                            <div >
                                               
                                               <table width="50%">
                                                   <thead>
                                                       <tr>
                                                          <th>Sr No.</th>
                                                          <th>
                                                            <input type="checkbox" name="allusers" id="allusers" value="all"> Select All
                                                          </th>
                                                          <th>Customer Name</th>
                                                       </tr> 
                                                   </thead>
                                                   <tbody id="customerList">

                                                   </tbody>


                                               </table>

                                            </div>
                                        </div>



                                    </div>
                                    
                                </div>

                                <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div>
                                                <br>
                                                <button class="btn btn-primary pull-right" type="submit" onclick="return check_error()">
                                                    <?php echo $button; ?>
                                                </button>

                                                <a href="<?php echo site_url('Users/index') ?>" class="btn btn-danger" type="button">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>   
                           
                          
                           
                           

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script type="text/javascript">


    var url="";
    var actioncolumn ="";

    function check_error() 
    { 
        var empfrom = $("#empfrom").val().trim();
        var empto = $("#empto").val().trim();
        
        var status = $("#assignstatus").val().trim();

        // var setUsers = $(".checkuserid").val().trim();
        
        // var dateFrom = $("#datefrom").val().trim();
        // var dateto = $("#dateto").val().trim();

        if(empfrom== "0") 
        {
            $("#errempfrom").fadeIn().html("Select Employee From");
            setTimeout(function() 
            {
                $("#errempfrom").fadeOut();
            }, 3000);
            $("#empfrom").focus();
            return false;
        }

        if(empto== "0") 
        {
            $("#errempto").fadeIn().html("Select Employee To");
            setTimeout(function() 
            {
                $("#errempto").fadeOut();
            }, 3000);
            $("#empto").focus();
            return false;
        }

        if(status== "0") 
        {
            $("#errassignstatus").fadeIn().html("Select Assign Status");
            setTimeout(function() 
            {
                $("#errassignstatus").fadeOut();
            }, 3000);
            $("#assignstatus").focus();
            return false;
        }

        if (($("input[name*='userid']:checked").length)<=0) {
            
            $("#selectUsers").fadeIn().html("Select Assign Users");
            setTimeout(function() 
            {
                $("#selectUsers").fadeOut();
            }, 3000);
            
            return false;
        }
        

        // $("input.select:checked").length > 0;

        // if(setUsers.length = 0) 
        // {
        //     $("#selectUsers").fadeIn().html("Select Assign Users");
        //     setTimeout(function() 
        //     {
        //         $("#selectUsers").fadeOut();
        //     }, 3000);
            
        //     return false;
        // }

        // if(dateFrom == '') 
        // {
        //     $("#errdatefrom").fadeIn().html("Select Assign Date From");
        //     setTimeout(function() 
        //     {
        //         $("#errdatefrom").fadeOut();
        //     }, 3000);
        //     $("#datefrom").focus();
        //     return false;
        // }

        // if(dateto == '') 
        // {
        //     $("#errdateto").fadeIn().html("Select Assign Date To");
        //     setTimeout(function() 
        //     {
        //         $("#errdateto").fadeOut();
        //     }, 3000);
        //     $("#dateto").focus();
        //     return false;
        // }


    }

</script>


