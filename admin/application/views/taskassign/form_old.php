<style>
.table-wrapper-scroll-x {
        display: block;
    }
.my-custom-scrollbar {
        position: relative;
       /* height: 200px;*/
        overflow: auto;
    }
</style>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <div>&nbsp;Add Tasks</div>
    </h1>
    <ol class="breadcrumb">
      <li>
        <a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li><a href="<?php echo site_url('Taskassign/index'); ?>"><?php echo $header; ?></a></li>
        <li class="active">Add Task</li>
        <li class="active">
         
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
              <form method="POST" action="<?php echo $action; ?>"  enctype="multipart/form-data" >
            
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" >Assign To <span style="color:red;">* </span>
                    </label>
                   <!--  <span style="color:red" id="heading_err"> </span> -->
                    <select id="emp_id" name="emp_id" class="form-control">
                    <option value="">select Employee</option>
                 <?php if(!empty($get_employee)){ foreach($get_employee as $emp){?>
                      <option value="<?php echo $emp->id ?>"<?php if($emp_id==$emp->id){echo "selected";}?>><?php echo $emp->name;?></option>
                     <?php } }?>

                    </select>
                    
                  </div>
                </div>
<!-- addrow -->
<div class="col-md-12">
                <label class="col-md-12" style="background-color:#e6ffe6;">
                  <b>Assign Tasks </b><span style="color:red;"></span></label><span id="attribute_name_err" style="color:red;"></span>
                  <div class="col-md-6">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="purchaseTableclone1" >
                        <thead style="background-color:#8cb3d9;">
                          
                          <tr>
                            <th class="col-xs-3"><h5><b>Tasks</b><span style="color:red;"></span><span style="color:red;font-size:12px" id="error1" class="error"></span> <span id="attrname_error" style="color:red;font-size:12px"></span></h5></th>
                           
                            <th class="col-xs-1">
                              <div>
                                <button title="Add row" type="button" onclick="addrow_feedback1()" class="btn btn-info"><b><i class="fa fa-plus"></i></b></button>
                              </div>
                            </th>
                          </tr>
                    
                        </thead>
                        <tbody id="clonetable_feedback1" style="background-color:#ecf2f9;">
                         <?php if($button == 'Create') { ?>
                            <tr class="rows">
                              
                              <td>
                                 <input type="text" value="" name="tasks[]" id="q_to1" class="col-sm-12 attrmobile form-control datepicker_recurring_start" placeholder="Tasks">
                              </td>
                              
                             
                              <td>
                                <button title="Delete row" type="button" onclick="deleteRow_feedback1(this)" class="btn bg-red waves-effect"><b><i class="fa fa-minus"></i></b>
                                </button>
                              </td>
                            </tr>
                          <?php } else{ ?> 
                        <?php $row=1;foreach($get_multiple_task as $task){?>
                            <tr class="rows">
                              
                              <td>
                                 <input type="text" value="<?= $task->tasks ?>" name="tasks[]" id="q_to<?= $row ?>" class="col-sm-12 attrmobile form-control datepicker_recurring_start" placeholder="Tasks">
                              </td>
                              
                             
                              <td>
                                <button title="Delete row" type="button" onclick="deleteRow_feedback1(this)" class="btn bg-red waves-effect"><b><i class="fa fa-minus"></i></b>
                                </button>
                              </td>
                            </tr>

                          <?php } }?>
                             
                             
                            
                          </tbody>
                        </table>
                      </div>
                    </div>          
              <br> 
              </div>


<!-- end addrow -->

          
             <input type="hidden" name="id" value="<?php echo $id;?>"> 
                      <div class="clearfix">&nbsp;</div>
                      <div class="box-footer">
                        <a> <button type="submit" style="width:65px;height:35px;" class="btn btn-primary pull-right" name="" onclick="return validation();"><?php echo $button;?></button></a>
                        <a href="<?= site_url('Taskassign');?>"><button type="button"  class="btn btn-danger">Cancel</button></a> 
                      </div>  
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <script type="text/javascript">
          var url = '';
          var actioncolumn=0;
          var  pageLength= '';
        </script>

       <script type="text/javascript">
    function addrow_feedback1()
    {   
      var y=document.getElementById('clonetable_feedback1');
      var new_row = y.rows[0].cloneNode(true);
      var len = y.rows.length; 
      new_number=Math.round(Math.exp(Math.random()*Math.log(10000000-0+1)))+0;

      var inp2 = new_row.cells[0].getElementsByTagName('input')[0];
      inp2.value = '';
      inp2.id = 'qualification'+(len+1);
      var submit_btn =$('#submit').val();
      y.appendChild(new_row);            
    }

    function deleteRow_feedback1(row)
    {
      var y=document.getElementById('purchaseTableclone1');
      var len = y.rows.length;
      if(len>2)
      {
        var i= (len-1);
        document.getElementById('purchaseTableclone1').deleteRow(i);
      }
    } 
</script>

        <script type="text/javascript" src="<?php echo base_url('assets/custom_js/taskassign.js');?>"></script>
