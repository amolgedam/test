<?php  $this->load->view('common/header'); 
$this->load->view('common/left_panel'); ?>
<style type="text/css" media="screen">
  .select2-container--default {
    width: 404px!important;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?= $header; ?>
      <small><!--advanced tables--></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
      <li class="active">  <?= $header; ?></li>
    </ol>
  </section>
  <section class="content">
    <form action="<?php echo $actionUrl; ?>" method="POST" >
    <div class="row">
      <div class="col-lg-12">
        <div class="box box-primary">
          <div class="box-body">
            <div class="col-md-4">
              <label> Customer Name <span style="color:red;">* </span><span style="color:red;font-size:14px" id="errorcustname" class="error"></span></label>
              <select class="form-control" name="customer_name" id="customer_name" onchange="return getcustomer(this.value)">
                <option value="">--------select Customer--------</option>
                <?php foreach ($customer as $key) {?>
                  <option value="<?= $key->id?>" <?php if($customer_id==$key->id){ echo "selected";}?>><?= $key->customer_name;?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-5">
              <label> Email-ID</label>
              <input type="text" name="email_id" id="email_id" class="form-control" placeholder="Email-ID" readonly="" value="<?php echo $email;?>">
            </div>
            <div class="col-md-3">
              <label> Mobile No</label>
              <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No" onkeypress="return only_number(event)" maxlength="12" readonly="" value="<?php echo $mobile_no;?>">
            </div>
            <div class="col-md-9">
              <label> Address</label>
              <textarea class="form-control" name="address" id="address" placeholder="Address" readonly=""><?php echo $address;?></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
          <div class="box box-primary">
            <div class="box-body">
               <div class="col-lg-12">
                <!-- <button class="btn btn-primary pull-right" type="button" name="save" id="save" data-toggle="modal" data-target="#myModal">Add Quotation</button>
                <br>
                <br> -->
              <input type="hidden" name="selected_client" id="selected_client" class="filter_search_data1" >
              <div class="table-responsive" id="refresh_div">
                <table class="table table-bordered" id="quotations_field">
              <thead style="background-color:#9fbfdf;">
                <tr>
                  <th>Product Name <span id="item_err" style="color:red;"></span></th>
                  <th>Product Detail</th>
                  <th>Price</th>
                  <th>GST(%)</th>
                  <th>Discount</th>
                  <th>
                      Action &nbsp; 
                      <!-- <button title="Add row" type="button" onclick="addrow_quotaion()" class="btn bg-green waves-effect"><b><i class="fa fa-plus"></i></b></button> -->

                      <button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody id="quotations_fieldbody">

                  <?php if($quot_id==''){ ?>
                    <tr id="row1">
                        <td>
                            <input type="text" name="pname[]" placeholder="Enter Product Name" id="pname_row1" class="form-control" />
                        </td>

                        <td> 
                            <textarea id="pdetail_row1" name="pdetails[]" placeholder="Product Details" class="form-control ck_details ckeditor"></textarea>
                        </td>

                        <td>
                            <input type="text" class="form-control" value="0" name="rate[]" id="rate_row1" >
                        </td>

                        <td>
                            <input type="text" class="form-control" name="gst[]" id="gst_row1" value="18" onkeypress="return only_number(event)">
                        </td>

                        <td>
                            <input type="text" class="form-control" name="discount[]" id="discount_row1" value="0" onkeypress="return only_number(event)">
                        </td>

                        <td>
                            <!-- <button title="Delete row" type="button" onclick="deleteRow_quotation($(this).closest('tr').index())" class="btn bg-red waves-effect"><b><i class="fa fa-minus"></i></b>
                            </button> -->
                            <button type="button" name="remove" id="1" class="btn btn-danger btn_remove">X</button>
                        </td>
                    </tr>
                  <?php
                      }else{

                        if(!empty($quotation_pro))
                        {
                  ?>
                            <?php
                              $row_id = 1;
                              foreach ($quotation_pro as $key => $value)
                              {
                            ?>

                                <tr id="row<?php echo $row_id ?>">
                                    <td>
                                        <input type="text" name="pname[]" placeholder="Enter Product Name" id="pname_row<?php echo $row_id ?>" class="form-control" value="<?php echo $value->product_name ?>" />
                                    </td>

                                    <td> 
                                        <textarea id="pdetail_row<?php echo $row_id ?>" name="pdetails[]" placeholder="Product Details" class="form-control ck_details ckeditor"><?php echo $value->description ?></textarea>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control" value="<?php echo $value->price ?>" name="rate[]" id="rate_row<?php echo $row_id ?>" >
                                    </td>

                                    <td>
                                        <input type="text" class="form-control" name="gst[]" id="gst_row<?php echo $row_id ?>" value="<?php echo $value->gst ?>" onkeypress="return only_number(event)">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control" name="discount[]" id="discount_row<?php echo $row_id ?>" value="<?php echo $value->discount ?>" onkeypress="return only_number(event)">
                                    </td>

                                    <td>
                                        <!-- <button title="Delete row" type="button" onclick="deleteRow_quotation($(this).closest('tr').index())" class="btn bg-red waves-effect"><b><i class="fa fa-minus"></i></b>
                                        </button> -->
                                        <button type="button" name="remove" id="<?php echo $row_id ?>" class="btn btn-danger btn_remove">X</button>
                                    </td>
                                </tr>
                            <?php
                              }
                            ?>
                  <?php 
                        }
                    }
                  ?>
              </tbody>
            </table>
               
              </div>
              <span id="attrname_error" class="error"></span>
              <div class="col-md-12">
                <label>Terms & Conditions</label>
                <textarea id="editor1" name="terms" placeholder="Description" class="form-control ckeditor description"><?= $terms;?></textarea><br>
              </div>
              <div class="hr-line-dashed"></div>
              <div class="form-group">
                <div class="col-md-12">
                  <div>
                    <input type="hidden" name="quot_id" id="quot_id" value="<?= $quot_id;?>">
                    <button class="btn btn-warning pull-right" name="button_type" value="print" type="submit"  onclick="return print_validations()"> <?php echo $button;?></button>
                    <a href="<?php echo site_url('Quotation')?>" class="btn btn-danger btn-md">Back</a>
                    <!-- onclick="return print_validations()" -->
                  </div>
                </div>
              </div>
            
            </div>
          </div>
      </div>
    </div>
    </form>
  </section>
</div>

   <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
<script>
var count = $('#clonetable_feedback tr').length;
   for(var i=1; i <= count;  i++)
  {
	   CKEDITOR.replace['description'+i]; 
  }
</script>

<?php 
  $this->load->view('common/footer'); 
?>
 

 
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
 <script>
    var url = '<?= site_url('Quotation/ajax_manage_page')?>';
    var actioncolumn=2;
</script>

<script type='text/javascript'>
    // CKEDITOR.replaceAll('ck_details');
</script>

<!-- Add Row Functionality -->
<script type="text/javascript">

  $(document).ready(function(){

      var totalRowCount = $("#quotations_field tr").length;
      var rowCount = $("#quotations_field td").closest("tr").length;
            
      var i=rowCount;  
      $('#add').click(function(){  
           i++;

           var table = '';

           table += '<tr id="row'+i+'" >';

            table += '<td>';
              table += '<input type="text" name="pname[]" placeholder="Enter Product Name" id="pname_row'+i+'" class="form-control" />';
            table += '</td>';

            table += '<td>';
              table += '<textarea id="pdetail_row'+i+'" name="pdetails[]" placeholder="Product Details" class="form-control ck_details"></textarea>';
            table += '</td>';

            table += '<td>';
              table += '<input type="text" class="form-control" value="0" name="rate[]" id="rate_row'+i+'" onkeypress="return only_number(event)">';
            table += '</td>';

            table += '<td>';
              table += '<input type="text" class="form-control" name="gst[]" id="gst_row'+i+'" value="18" onkeypress="return only_number(event)">';
            table += '</td>';

            table += '<td>';
              table += '<input type="text" class="form-control" name="discount[]" id="discount_row'+i+'" value="0" onkeypress="return only_number(event)">';
            table += '</td>';

            table += '<td>';
              table += '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>';
            table += '</td>';

           table += '</tr>';


           $('#quotations_field').append(table);   

           CKEDITOR.replace('pdetail_row'+i);

           // <tr id="row1">
                      

           //            <td>
           //                <input type="text" class="form-control" name="rate[]" id="rate_row1" value="1000" onkeypress="return only_number(event)">
           //            </td>

           //            <td>
           //                <input type="text" class="form-control" name="gst[]" id="gst_row1" value="18" onkeypress="return only_number(event)">
           //            </td>

           //            <td>
           //                <input type="text" class="form-control" name="discount[]" id="discount_row1" value="0" onkeypress="return only_number(event)">
           //            </td>

           //            <td>
           //                <!-- <button title="Delete row" type="button" onclick="deleteRow_quotation($(this).closest('tr').index())" class="btn bg-red waves-effect"><b><i class="fa fa-minus"></i></b>
           //                </button> -->
           //                <button type="button" name="remove" id="1" class="btn btn-danger btn_remove">X</button>
           //            </td>
           //        </tr>
      }); 

  });

  $(document).on('click', '.btn_remove', function(){  
       var button_id = $(this).attr("id");   
       $('#row'+button_id+'').remove();  
  });  

  function addrow_quotaion()
  { 
      CKEDITOR.remove('ck_details');

      var y=document.getElementById('quotations_fieldbody');
      var new_row = y.rows[0].cloneNode(true);
      var len = y.rows.length;
      new_number=Math.round(Math.exp(Math.random()*Math.log(10000000-0+1)))+0;

      var inp1 = new_row.cells[0].getElementsByTagName('input')[0];
      inp1.value = '';
      inp1.id = 'pname_row'+(len+1);

      var inp2 = new_row.cells[1].getElementsByTagName('textarea')[0];
      inp2.value = '';
      inp2.id = 'pdetail_row'+(len+1);

      // var inp3 = new_row.cells[2].getElementsByTagName('input')[0];
      // inp3.value = '0';
      // inp3.id = 'piece_row'+(len+1);

      // var inp4 = new_row.cells[3].getElementsByTagName('input')[0];
      // inp4.value = '0';
      // inp4.id = 'rate_suggestion_value'+(len+1);
      
      // var inp5 = new_row.cells[4].getElementsByTagName('input')[0];
      // inp5.value = '';
      // inp5.id = 'rate_suggestion_mul'+(len+1);


      y.appendChild(new_row);

      CKEDITOR.replace('pdetail_row'+(len+1));
       
  }

  function deleteRow_quotation(row)
   {
       var y=document.getElementById('quotations_field');
       var len = y.rows.length;
       if(len>2)
       {
           var i= (len-1);
           document.getElementById('quotations_fieldbody').deleteRow(row);
       }
   }
</script>




<script type="text/javascript">
function only_number(event)
{
   var x = event.which || event.keyCode;
    console.log(x);
    if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 )
    {
        return;
    }else{
        event.preventDefault();
    }    
}

function print_validations()
{
  var customer_name = $("#customer_name").val();
  var item = $("#item").val();

  //alert(item);return false;
  
  if(customer_name=='')
  {
    $("#errorcustname").html("Required").fadeIn();
      setTimeout(function(){$("#errorcustname").fadeOut()},3000);
      $("#customer_name").focus();
    return false;
  }
//   if(item=='')
//   {
//     $("#item_err").html("Required").fadeIn();
//       setTimeout(function(){$("#item_err").fadeOut()},3000);
//       $("#item").focus();
//     return false;
//   }
  
}

  function getcustomer(id)
{
  var id = id;
        $.ajax({
                type:"post",
                cache:false,
                url:"<?php echo site_url('/Quotation/get_customer');?>",
                data:{id:id},
                success:function(returndata)
                {
                    var obj = $.parseJSON(returndata);
                    $("#email_id").val(obj.email);
                    $("#mobile_no").val(obj.mobile_no);
                    $("#address").val(obj.address);
                }
        });
}

function get_product(val)
{
   var  customer_id =  $("#customer_name").val();
    $.ajax({
            type:"post",
            cache:false,
            url:"<?php echo site_url('Quotation/get_productDetails')?>",
            data:{val:val},
            success:function(returndata)
            {
                $("#product_detail_id").html(returndata);
                $("#customer_id").val(customer_id);
            }

  })

}

function save_quo_data(val)
{
   var  customer_id =  $("#customer_name").val();
   var  product_id =  $("#product_id").val();
   var  product_detail_id =  $("#product_detail_id").val();

   //alert(product_detail_id);return false;
    var quot_id = $("#quot_id").val();
   var  site_url =  $("#site_url").val();

  if(product_id== '')
  {
      $("#product_id_err").html("Required").fadeIn();
      setTimeout(function(){$("#product_id_err").fadeOut()},3000);
      $("#product_id").focus();
      return false;
  }
  if(product_detail_id==null)
  {
      $("#product_detail_id_err").html("Required").fadeIn();
      setTimeout(function(){$("#product_detail_id_err").fadeOut()},3000);
      $("#product_detail_id").focus();
      return false;
  }


    $.ajax({
            type:"post",
            cache:false,
            url:"<?php echo site_url('Quotation/add_product')?>",
            data:{customer_id:customer_id,product_id:product_id,product_detail_id:product_detail_id},
            success:function(returndata)
            {

              if(returndata==1)
              {

              if(quot_id!='')
             {

              window.location.href=site_url+"/Quotation/update/"+quot_id;
             }
             else
             {
                window.location.href=site_url+"/Quotation/create";
             }
                
              }
            }
  })

}

</script>
<script>
 function qou_delete(id)
  {
    var site_url = $("#site_url").val();
    var quot_id = $("#quot_id").val();

     $.ajax({
              type:"post",
              cache:false,
              url:"<?php echo site_url('Quotation/delete_quotation')?>",
              data:{id:id,quot_id:quot_id},
              success:function(returndata)
              {
               
                 if(quot_id!='')
                 {

                  window.location.href=site_url+"/Quotation/update/"+quot_id;
                 }
                 else
                 {
                    window.location.href=site_url+"/Quotation/create";
                 }
              }

     });  
  }
</script>
<script>
   function qou_edit(id)
  {
      var id = id;

      $.ajax(
        {
          type:"post",
          cache:false,
          url:"<?php echo site_url('Quotation/get_quotation_edit')?>",
          data:{id:id},
          success:function(returndata)
          {
            //alert(returndata);return false;
             var obj = JSON.parse(returndata);
            alert(obj.get_product);
            alert(obj.get_product_details);return false;

            /*$("#product_id").select2(json.get_product);

            $("#myModal_edit").modal('show');*/
          }
        });
    
  }
</script>
