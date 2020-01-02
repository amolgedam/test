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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Full Name<span style="color:red;">*</span></label> <span style="color:red" id="name_err"> </span><?php echo form_error('name')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Full Name" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email<span style="color:red;">*</span></label> <span style="color:red" id="email_err"> </span><?php echo form_error('email')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <input type="text" placeholder="Email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password<span style="color:red;">*</span></label> <span style="color:red" id="password_err"> </span>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <input type="text" placeholder="Password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile<span style="color:red;">*</span></label> <span style="color:red" id="mobile_err"> </span><?php echo form_error('mobile')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                    <input type="text" placeholder="Mobile" class="form-control" id="mobile" name="mobile" value="<?php echo $mobile; ?>" maxlength="10">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Addhar Card No.<span style="color:red;">*</span></label> <span style="color:red" id="addhar_card_no_err"> </span><?php echo form_error('addhar_card_no')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                    <input type="text" placeholder="Addhar Card No" class="form-control" id="addhar_card_no" name="addhar_card_no" value="<?php echo $addhar_card_no; ?>">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Image
                                    <span style="color:red;">*</span> </label><span style="color:red" id="image_err"> </span><span style="color:red"><!-- < ?php echo form_error('company_logo')?> </span> -->
                                    <input type="file" placeholder="Category" class="form-control" id="image" name="image" accept="image/gif, image/jpeg, image/png">
                                    <br>
                                    <?php if($button!='Create')
                                    {?>

                                        <?php
                                            $img1 = empty($image) ? base_url('uploads/users/images.jpg') : base_url('uploads/employees/'.$image);

                                            $img = empty($image) ? 'images.jpg' : $image;

                                        ?>

                                        <img src="<?php echo $img1 ?>" width="80px">
                                        <input type="hidden" name="old_image" id="old_image" value="<?php echo $img; ?>">
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Addhar Card
                                    <span style="color:red;">*</span> </label><span style="color:red" id="addhar_card_err"> </span><span style="color:red"><!-- < ?php echo form_error('company_logo')?> </span> -->
                                    <input type="file" placeholder="Category" class="form-control" id="addhar_card" name="addhar_card" accept="image/gif, image/jpeg, image/png">
                                    <br>
                                    <?php if($button!='Create'){?>

                                        <?php
                                            $aimg1 = empty($addhar_card) ? base_url('uploads/users/images.jpg') : base_url('uploads/addhar_card/'.$addhar_card);

                                            $aimg = empty($addhar_card) ? 'images.jpg' : $addhar_card;

                                        ?>

                                        <img src="<?php echo $aimg1 ?>" width="80px">
                                        <input type="hidden" name="old_addhar_card" id="old_addhar_card" value="<?php echo $aimg; ?>">
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Address<span style="color:red;">*</span></label> <span style="color:red" id="address_err"> </span><?php echo form_error('address')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                    <textarea type="text" placeholder="Address" class="form-control" id="address" name="address"><?php echo $address; ?> </textarea> 
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div>
                                        <input type="hidden" id="button" value="<?= $button; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <button class="btn btn-primary pull-right" type="submit" onclick="return check_error()">
                                            <?php echo $button; ?>
                                        </button>
                                        <a href="<?php echo site_url('Employees/index') ?>" class="btn btn-danger" type="button">Cancel</a>
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
        var name = $("#name").val().trim();
        var email = $("#email").val().trim();
        var password = $("#password").val().trim();
        var mobile = $("#mobile").val().trim();
        var address = $("#address").val().trim();
        var image = $("#image").val().trim();
        var addhar_card = $("#addhar_card").val().trim();

        var addhar_card_no = $("#addhar_card_no").val().trim();
       
        // var degination = $("#degination").val().trim();
        var button = $("#button").val().trim();

        if(name== "") 
        {
            $("#name_err").fadeIn().html("Please enter Name");
            setTimeout(function() 
            {
                $("#name_err").fadeOut();
            }, 3000);
            $("#name").focus();
            return false;
        }
        if(email=="") 
        {
            $("#email_err").fadeIn().html("Please enter Email");
            setTimeout(function() 
            {
                $("#email_err").fadeOut();
            }, 3000);
            $("#email").focus();
            return false;
        }
         if(password=="") 
        {
            $("#password_err").fadeIn().html("Please enter Password");
            setTimeout(function() 
            {
                $("#password_err").fadeOut();
            }, 3000);
            $("#password").focus();
            return false;
        }
        if(mobile== "") 
        {
            $("#mobile_err").fadeIn().html("Please enter quntity");
            setTimeout(function() 
            {
                $("#mobile_err").fadeOut();
            }, 3000);
            $("#mobile").focus();
            return false;
        }
        // if(degination== "0") 
        // {
        //     $("#degination_err").fadeIn().html("Please Select Degination");
        //     setTimeout(function() 
        //     {
        //         $("#degination_err").fadeOut();
        //     }, 3000);
        //     $("#degination").focus();
        //     return false;
        // }
         if(addhar_card_no== "") 
        {
            $("#addhar_card_no_err").fadeIn().html("Please enter Addhar card no");
            setTimeout(function() 
            {
                $("#addhar_card_no_err").fadeOut();
            }, 3000);
            $("#addhar_card_no").focus();
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
             if(addhar_card=="") 
            {
                $("#addhar_card_err").fadeIn().html("Please Select Addhar Card");
               setTimeout(function() 
                {
                    $("#addhar_card_err").fadeOut();
                }, 3000);
                $("#addhar_card").focus();
                return false;
            }
            if(address== "") 
            {
                $("#address_err").fadeIn().html("Please enter address");
                setTimeout(function() 
                {
                    $("#address_err").fadeOut();
                }, 3000);
                $("#address").focus();
                return false;
            }

        }



        }
</script>