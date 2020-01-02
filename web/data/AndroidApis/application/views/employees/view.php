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
                                  <div class="panel-heading"> <?= $heading;?>        
                                    <a href="<?= site_url('Employees/index');?>" class="pull-right btn btn-primary btn-md" style="margin-top:-7px;">Back</a>
                                  </div>
                                  <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="col-md-8">
                                            <div class="col-md-3"><h5><b>Full name :</b></h5>
                                                <span><?php if($getuser->name) { echo $getuser->name; }else{ echo "N/A"; } ?></span>
                                            </div>
                                            <div class="col-md-4"><h5><b>Email id :</b></h5>
                                                <span><?php if(!empty($getuser->email)){ echo $getuser->email;}else { echo "N/A";} ?></span>
                                            </div>
                                            <div class="col-md-3"><h5><b>Password:</b></h5>
                                                <span><?php if(!empty($getuser->password)){ echo $getuser->password;}else { echo "N/A";} ?></span>
                                            </div>
                                            <div class="col-md-3"><h5><b>Mobile :</b></h5>
                                                <span><?php if(!empty($getuser->mobile)){ echo $getuser->mobile;}else { echo "N/A";} ?></span>
                                            </div>
                                          
                                            <div class="col-md-3"><h5><b>Addhar Card No:</b></h5>
                                                <span><?php if(!empty($getuser->addhar_card_no)){ echo $getuser->addhar_card_no; }else{ echo "N/A";} ?></span>
                                            </div>

                                            <div class="col-md-3"><h5><b>Degination:</b></h5>
                                                <span><?php if(!empty($getuser->degination)){ echo $getuser->degination; }else{ echo "N/A";} ?></span>
                                            </div>
                                              <div class="col-md-3"><h5><b>Address:</b></h5>
                                                <span><?php if(!empty($getuser->address)){ echo $getuser->address; }else { echo "N/A";} ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col-md-6"><h5><b>Image :</b></h5>
                                                <span>
                                                   <?php  if(!empty($getuser->image)) { ?>
                                                    <img src="<?= base_url('/uploads/employees/'.$getuser->image);?>" height="110px" width="150px">
                                                    <?php }else
                                                    { ?>
                                                        <img src="<?= base_url('/uploads/users/images.jpg');?>" height="50px" width="50px"> 
                                                    <?php } ?>

                                                </span>
                                            </div>
                                            <div class="col-md-6"><h5><b>Addhar Card :</b></h5>
                                                <span>
                                                   <?php  if(!empty($getuser->addhar_card)) { ?>
                                                    <img src="<?= base_url('/uploads/addhar_card/'.$getuser->addhar_card);?>" height="110px" width="150px">
                                                    <?php }else
                                                    { ?>
                                                        <img src="<?= base_url('/uploads/users/images.jpg');?>" height="50px" width="50px"> 
                                                    <?php } ?>

                                                </span>
                                            </div>
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