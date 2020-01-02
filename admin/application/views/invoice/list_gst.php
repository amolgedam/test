<?php  $this->load->view('common/header'); 
$this->load->view('common/left_panel'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?= $header; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
      <li class="active">  <?= $header; ?></li>
    </ol>
  </section>
  <section class="content">
    <form action="<?php echo $actionUrl; ?>" method="POST" onsubmit="return print_validations();">
    <div class="row">
      <div class="col-lg-12">
        <div class="box box-primary">
          <div class="box-body">
            <div class="col-md-4">
              <label> Customer Name <span style="color:red;">* </span><span style="color:red;font-size:14px" id="errorcustname" class="error"></span></label>
              <select class="form-control" name="customer_name" id="customer_name" onchange="return getcustomer(this.value)">
                <option value="">--------select Customer--------</option>
                <?php foreach ($customer as $key) {?>
                  <option value="<?= $key->id?>"><?= $key->customer_name;?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-5">
              <label> Email-ID</label>
              <input type="text" name="email_id" id="email_id" class="form-control" placeholder="Email-ID" readonly="">
            </div>
            <div class="col-md-3">
              <label> Mobile No</label>
              <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No" onkeypress="return only_number(event)" maxlength="12" readonly="">
            </div>
            <div class="col-md-9">
              <label> Address</label>
              <textarea class="form-control" name="address" id="address" placeholder="Address" readonly=""></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
          <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="purchaseTableclone123" >
                  <thead>
                    <tr bgcolor="#e0e0d1">
                      <th class="col-xs-3"><h5><b>Products </b><span style="color:red;">*</span><span style="color:red;font-size:12px" id="error1" class="error"></span> <span id="attrname_error" style="color:red;font-size:12px"></span></h5></th>
                      <th class="col-xs-2"><h5><b>Price </b><span style="color:red;">*</span><span style="color:red;font-size:12px" id="error2" class="error"></span> </h5></th>
                      <th class="col-xs-2"><h5><b>CGST(%)</b><span style="color:red;">*</span><span style="color:red;font-size:12px" id="error3" class="error"></span> </h5></th>
                      <th class="col-xs-2"><h5><b>SGST(%)</b><span style="color:red;">*</span><span style="color:red;font-size:12px" id="error4" class="error"></span> </h5></th>
                      <th class="col-xs-3"><h5><b>Discount(%)</b><span style="color:red;font-size:12px" id="error5" class="error"></span> </h5></th>
                      <th class="col-xs-2">
                        <div>
                          <button title="Add row" type="button" onclick="addrow_feedback()" class="btn bg-green waves-effect"><b><i class="fa fa-plus"></i></b></button>
                        </div>
                      </th>
                    </tr>
                  </thead>
                  <tbody id="clonetable_feedback">

                    <tr class="rows">
                      <td>
                        <input type="text" name="item[]" id="item1" class="form-control attrname" placeholder="Product Name">
                      </td>
                      <td>
                        <input type="text" value="" class="form-control" name="rate[]" id="rate1" placeholder="Rate" maxlength="8" onkeypress="return only_number(event)" />
                      </td>
                      <td>
                        <input type="text" value="" class="form-control" name="cgst[]" id="cgst1" placeholder="CGST" maxlength="8" onkeypress="return only_number(event)" />
                      </td>
                      <td>
                        <input type="text" value="" class="form-control" name="sgst[]" id="sgst1" placeholder="SGST" maxlength="8" onkeypress="return only_number(event)" />
                      </td>
                      <td>
                        <input type="text" value="0" class="form-control" name="discount[]" id="discount1" placeholder="Discount" maxlength="8" onkeypress="return only_number(event)" />
                      </td>
                      <td>
                        <button title="Delete row" type="button" onclick="deleteRow_feedback(this)" class="btn bg-red waves-effect"><b><i class="fa fa-minus"></i></b>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <span id="attrname_error" class="error"></span>
              <div class="hr-line-dashed"></div>
              <div class="form-group">
                <div class="col-md-12">
                  <div>
                    <button class="btn btn-warning" name="button_type" value="print" type="submit">Print Invoice</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </form>
  </section>
  <input type="hidden" id="url">
</div>
<?php 
  $this->load->view('common/footer'); 
?>
<script type="text/javascript" src="<?= base_url()?>assets/custom_js/row_increment.js"></script>
<script type="text/javascript">
  function getcustomer(id)
{
  var id = id;
        $.ajax({
                type:"post",
                cache:false,
                url:"<?php echo site_url('/Invoice_GST/get_customer');?>",
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
</script>