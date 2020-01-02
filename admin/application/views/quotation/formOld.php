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
        <button class="btn btn-primary pull-right" type="button" name="save" id="save" data-toggle="modal" data-target="#myModal">Add Quotation</button>
        <br>
        <br>
              <input type="hidden" name="selected_client" id="selected_client" class="filter_search_data1" >
              <div class="table-responsive" id="refresh_div">
                <table class="table table-bordered">
              <thead style="background-color:#9fbfdf;">
                <tr>
                  <th>Product Name <span id="item_err" style="color:red;"></span></th>
                  <th>Product Detail</th>
                  <th>Price</th>
                  <th>GST(%)</th>
                  <th>Discount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($quotation_pro)) { foreach($quotation_pro as $pro) 
                  { 
                    $exlopd = explode(",", $pro->description);

                    $get_software = $this->Crud_model->GetData('software',"title","id='".$pro->product_name."'",'','','','1');
                    ?>
                <tr>
                  <td><?= $get_software->title;?>
                      <input type="hidden" id="item" name="item[]" value="<?php echo $pro->product_name;?>"> 
                  </td>
                  <td>
                  <ul>
                    <?php foreach($exlopd as $exl) 
                          { 
                            $get_d = $this->Crud_model->GetData('software_details','software_details',"id='".$exl."'",'','','','1');
                            ?>
                    <li><?= $get_d->software_details;?></li>
                  <?php }?>       
                  </ul>
                  <input type="hidden" name="description[]" value="<?php echo $pro->description;?>">    
                    </td>
                  <td><input type="text" class="form-control" name="rate[]" id="rate[]" value="1000" onkeypress="return only_number(event)"></td>
                  <td><input type="text" class="form-control" name="gst[]" id="gst" value="18" onkeypress="return only_number(event)"></td>
                  <td><input type="text" class="form-control" name="discount[]" id="discount" value="0" onkeypress="return only_number(event)"></td>
                  <td><!-- <button type="button" onclick="qou_edit(<?= $pro->id?>)">Edit</button>| --><button onclick="qou_delete(<?= $pro->id?>)" type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></td>
                </tr>
              <?php }  }else { ?>
                <tr>
                  <td colspan="5">
                   <center> No data Available</center>
                    <input type="hidden" id="item" value="">
                  </td>
                </tr>
              <?php } ?>
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


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <label> Select Product: <span id="product_id_err" style="color:red;"></span></label>
         <p> <select class="form-control select2" name="product_id" id="product_id">
            <option value="">--Select Product--</option>
            <?php if(!empty($get_product)) { foreach($get_product as $p) { ?>
            <option value="<?php echo $p->id;?>"><?php echo $p->title;?></option>
          <?php }}?>
          </select></p>
          <br>
          <label>Select Product Details <span id="product_detail_id_err" style="color:red;"></span></label>
        <p><select class="form-control select2" name="product_detail_id[]" id="product_detail_id" multiple="multiple" data-placeholder="Select Product Details">

            <?php if(!empty($get_product_de)) { foreach($get_product_de as $pp) { ?>
            <option value="<?php echo $pp->id;?>"><?php echo $pp->software_details;?></option>
          <?php }}?>
          </select></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" onclick="return save_quo_data()">Save</button>
      </div>

    </div>
  </div>
</div>

<div id="myModal_edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <label> Select Product: <span id="product_id_err" style="color:red;"></span></label>
         <p> <select class="form-control select2" name="product_id" id="product_id">
            <option value="">--Select Product--</option>
            <?php if(!empty($get_product)) { foreach($get_product as $p) { ?>
            <option value="<?php echo $p->id;?>" ><?php echo $p->title;?></option>
          <?php }}?>
          </select></p>
          <br>
          <label>Select Product Details <span id="product_detail_id_err" style="color:red;"></span></label>
        <p><select class="form-control select2" name="product_detail_id[]" id="product_detail_id" multiple="multiple" data-placeholder="Select Product Details">
            <?php if(!empty($get_product_de)) { foreach($get_product_de as $pp) { ?>
            <option value="<?php echo $pp->id;?>"><?php echo $pp->software_details;?></option>
          <?php }}?>
          </select></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" onclick="return save_quo_data()">Save</button>
      </div>

    </div>
  </div>
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
 
 <script>
    var url = '<?= site_url('Quotation/ajax_manage_page')?>';
    var actioncolumn=2;
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
  if(item=='')
  {
    $("#item_err").html("Required").fadeIn();
      setTimeout(function(){$("#item_err").fadeOut()},3000);
      $("#item").focus();
    return false;
  }
  
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
