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
            <li><a href="<?php echo site_url('Login/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('CategoryMaster/index'); ?>">Manage Category</a></li>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Category Name<span style="color:red;">*</span></label> <span style="color:red" id="categories_id_err"> </span><?php echo form_error('categories_id')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control" id="categories_id" name="categories_id">
                                                    <option value="">Select Category</option>
                                                    <?php if(!empty($getcat)) 
                                                    { 
                                                        foreach ($getcat as $cat) 
                                                        {          
                                                        ?>
                                        <option value="<?= $cat->id; ?>" 
                                            <?php    
                                            if($categories_id==$cat->id){ echo "selected";}?> ><?= $cat->cat_name; ?></option>
                                                <?php } }?>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Product Name<span style="color:red;">*</span></label> <span style="color:red" id="subcat_name_err"> </span><?php echo form_error('subcat_name')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Product Name" class="form-control" id="subcat_name" name="subcat_name" value="<?php echo $subcat_name; ?>">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Half Liter Price<span style="color:red;">*</span></label> <span style="color:red" id="half_liter_price_err"> </span><?php echo form_error('half_liter_price')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                    <input type="text" placeholder="Half Liter Price" class="form-control" id="half_liter_price" name="half_liter_price" value="<?php echo $half_liter_price; ?>"  >
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">One Liter Price<span style="color:red;">*</span></label> <span style="color:red" id="one_liter_price_err"> </span>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                             <input type="text" placeholder="One Liter Price" class="form-control" id="one_liter_price" name="one_liter_price" value="<?php echo $one_liter_price; ?>">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>      
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Image
                                    <span style="color:red;">*</span> </label><span style="color:red" id="image_err"> </span><span style="color:red">
                                    <input type="file" placeholder="Category" class="form-control" id="image" name="image">
                                    <br>
                                    <?php if($button!='Create'){?>
                                        <img src="<?= base_url('uploads/subcategory/'.$image);?>" width="80px">
                                        <input type="hidden" name="old_image" id="old_image" value="<?= $image; ?>">
                                    <?php }?>
                                </div>
                            </div>
                            <?php if($button!='Create'){?>
                             <!--    <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Add product stock<span style="color:red;">*</span></label> <span style="color:red" id="add_stock_err"> </span><?php echo form_error('maximum_kg')?>
                                    <div>
                                       
                                            <div class="col-md-8">
                        <input type="text" placeholder="Add product stock" class="form-control btn-sm" id="add_stock" name="add_stock" value="0">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary" onclick="return checkaddStock();">Add</button>
                                            </div>
                                           

                                        </div>
                                    </div>
                                </div>
                           
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Minus Product Stock<span style="color:red;">*</span></label> <span style="color:red" id="minus_stock_err"> </span><?php echo form_error('maximum_kg')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-8">
                                    <input type="text" placeholder="Minus Product Stock" class="form-control" id="minus_stock" name="minus_stock" value="0">
                                </div>
                                <div class="col-md-4">

                                    <button type="button" class="btn btn-primary btn-sm" onclick="return checkminusStock()">Minus</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div> -->
                            <?php }?>



                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div>
                                        <input type="hidden" id="button" value="<?= $button; ?>" />
                                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                                        <button class="btn btn-primary pull-right" type="submit" onclick="return check_error()">
                                            <?php echo $button; ?>
                                        </button>
                                        <a href="<?php echo site_url('Subcategory/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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

<script>
    setTimeout(function() {
        $(".errid").fadeOut();
    }, 3000);
</script>

<script type="text/javascript">
    function check_error() 
    {
        var categories_id = $("#categories_id").val().trim();
        var subcat_name = $("#subcat_name").val().trim();
        var half_liter_price = $("#half_liter_price").val().trim();
        var one_liter_price = $("#one_liter_price").val().trim();
        var image = $("#image").val().trim();
        var button = $("#button").val().trim();

        if(categories_id== "") 
        {
            $("#categories_id_err").fadeIn().html("Please Select Category");
            setTimeout(function() 
            {
                $("#categories_id_err").fadeOut();
            }, 3000);
            $("#categories_id").focus();
            return false;
        }
         if(subcat_name== "") 
        {
            $("#subcat_name_err").fadeIn().html("Please enter Product Name");
            setTimeout(function() 
            {
                $("#subcat_name_err").fadeOut();
            }, 3000);
            $("#subcat_name").focus();
            return false;
        }
        if(half_liter_price== "") 
        {
            $("#half_liter_price_err").fadeIn().html("Please enter Price");
            setTimeout(function() 
            {
                $("#half_liter_price_err").fadeOut();
            }, 3000);
            $("#half_liter_price").focus();
            return false;
        }
        if(one_liter_price== "") 
        {
            $("#one_liter_price_err").fadeIn().html("Please enter Price");
            setTimeout(function() 
            {
                $("#one_liter_price_err").fadeOut();
            }, 3000);
            $("#one_liter_price").focus();
            return false;
        }
        if(button=='Create')
        {

            if(image=="") 
            {
                $("#image_err").fadeIn().html("Please Select Image");
               setTimeout(function() 
                {
                    $("#image_err").fadeOut();
                }, 3000);
                $("#image").focus();
                return false;
            }

        }



        }
</script>
<script type="text/javascript">
    
    function checkaddStock()
    {

      
        var add_stock = $("#add_stock").val().trim();
        var quantity_in_kg = $("#quantity_in_kg").val().trim();
        var id = $("#id").val().trim();

        if(add_stock=='0' || add_stock=='')
        {
            $("#add_stock_err").fadeIn().html("Please enter Add stock");
            setTimeout(function() 
            {
                $("#add_stock_err").fadeOut();
            }, 3000);
            $("#add_stock").focus();
            return false;
        }

        $.ajax({
                type:"POST",
                cache:false,
                url:"<?php echo site_url('Subcategory/addStock');?>",
                data:{id:id,quantity_in_kg:quantity_in_kg,add_stock:add_stock},
                success:function(returndata)
                {
                    if(returndata=='1')
                    {
                         $("#add_stock_err").fadeIn().html("Stock added Successfully");
                        setTimeout(function() 
                        {
                            $("#add_stock_err").fadeOut();
                        }, 3000);
                        $("#add_stock").focus();
                        

                        location.reload();
                    }
                    if(returndata=='2')
                    {

                        $("#add_stock_err").fadeIn().html("Stock not available");
                        setTimeout(function() 
                        {
                            $("#add_stock_err").fadeOut();
                        }, 3000);
                        $("#add_stock").focus();
                        return false;           
                    }

                }
        });



    }
</script>
<script type="text/javascript">
    
    function checkminusStock()
    {

      
        var minus_stock = $("#minus_stock").val().trim();
        var quantity_in_kg = $("#quantity_in_kg").val().trim();
        var id = $("#id").val().trim();

        if(minus_stock=='0' || minus_stock=='')
        {
            $("#minus_stock_err").fadeIn().html("Please enter Minus stock");
            setTimeout(function() 
            {
                $("#minus_stock_err").fadeOut();
            }, 3000);
            $("#minus_stock").focus();
            return false;
        }
        if(parseInt(minus_stock) > parseInt(quantity_in_kg))
        {
             $("#minus_stock_err").fadeIn().html("Minus stock should not be greater than Stock");
            setTimeout(function() 
            {
                $("#minus_stock_err").fadeOut();
            }, 3000);
            $("#minus_stock").focus();
            return false;
        }

        //alert("go");return false;

        $.ajax({
                type:"POST",
                cache:false,
                url:"<?php echo site_url('Subcategory/minusStock');?>",
                data:{id:id,quantity_in_kg:quantity_in_kg,minus_stock:minus_stock},
                success:function(returndata)
                {
                    if(returndata=='1')
                    {
                        $("#minus_stock_err").fadeIn().html("Stock Minus Successfully");
                        setTimeout(function() 
                        {
                            $("#minus_stock_err").fadeOut();
                        }, 3000);
                        $("#minus_stock").focus();

                        location.reload();
                    }
                    if(returndata=='2')
                    {

                        $("#minus_stock_err").fadeIn().html("Stock not available");
                        setTimeout(function() 
                        {
                            $("#minus_stock_err").fadeOut();
                        }, 3000);
                        $("#minus_stock").focus();
                        return false;           
                    }

                }
        });



    }
</script>