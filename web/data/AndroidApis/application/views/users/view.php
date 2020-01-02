<style>textarea {resize: none;}</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <div>&nbsp;<?php echo $heading; ?></div>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('Users/index'); ?>"><?= $heading;?></a></li>
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
                            <div class="panel-heading"><?= $heading;?>       
                            <a href="<?= site_url('Users/index');?>" class="pull-right btn btn-primary btn-md" style="margin-top:-7px;">Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-8">
                                    <div class="col-md-3"><h5><b>Full Name :</b></h5>
                                        <span><?php if(!empty($getuser->name)) { echo ucfirst($getuser->name);}else { echo "N/A"; }?></span>
                                    </div>
                                    <div class="col-md-3"><h5><b>Email :</b></h5>
                                        <span><?php if(!empty($getuser->email)) { echo $getuser->email; }else{ echo "N/A"; } ?></span>
                                    </div>
                                    <div class="col-md-3"><h5><b>Mobile No :</b></h5>
                                        <span><?php if(!empty($getuser->mobile)) { echo $getuser->mobile; }else { echo "N/A";}  ?></span>
                                    </div>
                                    <div class="col-md-3"><h5><b>Password:</b></h5>
                                        <span><?php if(!empty($getuser->password)) { echo $getuser->password; }else { echo "N/A";}  ?></span>
                                    </div>
                                    <div class="col-md-3"><h5><b>Employee Type:</b></h5>
                                        <span><?php if(!empty($getuser->ename)) { echo '<span class="btn btn-primary btn-xs">'.$getuser->ename.'</span>'; }else { echo "N/A";}  ?>
                                    </span>
                                </div>
                                
                                <div class="col-md-3"><h5><b>Milk Quantity:</b></h5>
                                    <span><?php if(!empty($getuser->pliter)){ echo $getuser->pliter; }else { echo "N/A";} ?></span>
                                </div>
                                <div class="col-md-3"><h5><b>Product Name:</b></h5>
                                    <span><?php if(!empty($getuser->subcat_name)){ echo $getuser->subcat_name; }else { echo "N/A";} ?></span>
                                </div>
                                <div class="col-md-12"><h5><b>Address:</b></h5>
                                    <span><?php if(!empty($getuser->address)){ echo $getuser->address; }else { echo "N/A";} ?></span>
                                </div> 
                                
                            </div>
                            <div class="col-md-4">
                                <h5><b>Profile Picture :</b></h5>
                                <span>
                                    <?php  if(!empty($getuser->image)) 
                                    { 
                                     if(file_exists('/uploads/users/'.$getuser->image))
                                     {
                                         
                                    ?>
                                        <img src="<?= base_url('/uploads/users/'.$getuser->image);?>" height="150px" width="200px">
                                    <?php }else
                                    { ?>
                                        <img src="<?= base_url('/uploads/users/images.jpg');?>" height="150px" width="150px"> 
                                    <?php }}else { ?>
                                    <img src="<?= base_url('/uploads/users/images.jpg');?>" height="150px" width="150px"> 
                                    <?php } ?>
                                </span>
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