
<?php $this->load->view('common/header.php');?>
<style type="text/css">
	.about-slider-2 {
    margin-top:100px;
}
.inner-padding5{padding:60px 0px 30px;
}
.about-area{margin-top: -20px; margin-bottom:20px;}

.feature-content {
    height: 200px;
}
.icon-1{background-color: #08ada7;width: 80px;height: 80px;border-radius: 50px;margin-top: 32px;
}
.text-1{margin-top: 20px; color: white;}
/*.features-item .icon-outer{display: inline-table;width: 90px;height: 90px;position: relative;}*/
.page-header-dark{background-color: #262626;padding: 75px;}

.features-item .icon-outer{display: inline-table;width: 90px;height: 90px;position: relative;}
.features-item{position: relative;z-index: 1;}
.light-text{color: #ffffff;}
.features-item .icon-outer{display: inline-table;background-color: #ffffff;width: 90px;height: 90px;position: relative;-webkit-box-shadow: 0 8px 48px 0 rgba(0, 0, 0, 0.15);border-radius: 50px;color: #38A6F1;}
.features-item-item .icon-outer-icon{display: inline-table;background-color: #ffffff;width: 90px;height: 90px;position: relative;-webkit-box-shadow: 0 8px 48px 0 rgba(0, 0, 0, 0.15);color: #38A6F1;border-radius: 50px}

.features-item::before{content: '';width: 100%;border-top: 1px solid;position: absolute;top: 45px;z-index: -1;color: #ffffff;right: 5px;}
.text{margin-top: 20px;color: #38A6F1;}
.btn.btn--solid--a{color: #fff;background-color: #d82533;}
.btn--xl.btn--square{width: 80px;padding-left: 0;padding-right: 0;}
.btn--rounded{border-radius: 100px;}
.icon{font-size: 55px;margin-top: 16px;}
.icon1 img{width: 50px;margin-top: 20px;}
</style>
<div class="page-header" id="home">
        <div class="header-caption">
            <div class="header-caption-contant">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="header-caption-inner">
                                <!--<p><a href="<?php echo site_url('Welcome/index'); ?>">Home </a> >Automotive</p>-->
                                <?php if(!empty($service_detail->heading)) { ?>
                              <h1> <?php echo $service_detail->heading; ?></h1>
                                <?php } else{ echo "N/A"; }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->
    <!-- About Section -->
   
        <div class="about-area inner-padding5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div id="about-silder-2" class="owl-carousel owl-theme about-slider-2 foo banner-image" data-sr='enter'>
                        <?php if(!empty($service_image)){ ?>
                        <?php foreach ($service_image as $imagee) {?>
                            <img src="<?php echo base_url() ?>admin/uploads/service/<?php echo $imagee->image; ?>" alt="responsive img">
                           <?php }?>
                        <?php }?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="section-title-area-1 foo" data-sr='enter'></div>
                    <div class="about-content foo" data-sr='enter'>
                        <?php if(!empty($service_detail->description)){?>
                       <p> <?php echo $service_detail->description; ?></p>

                   <?php } else { echo "N/A"; }?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End About Section -->

    <!-- Service Section -->
   
   <?php
   
    if(!empty($service_work)) { ?>
    <div class="service-area inner-padding5">
        <div class="page-header-dark" id="home">
        <div class="header-caption">
            <div class="header-caption-contant">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="header-caption-inner" style="margin-top: -152px;">
                                <center>
                                <?php if(!empty($service_work->heading)) { ?>
                                <h2 class="header-caption-inner" style="display: inline-block;color: white;border-bottom: 2px solid;"><?php echo $service_work->heading; ?></h2>
                                <?php } else{ echo "N/A"; }?><br/>
    
                                <?php if(!empty($service_work->description)){?>
                                    <p style="padding: 10px;margin-left: 150px;margin-right: 150px;color: white;"><?php echo $service_work->description; ?></p>
                                 <?php } else { echo "N/A"; }?>
                                </center>
                            </div>
                        </div>
 
                            <div class="row"> 
                        <?php if(!empty($service_work_detail)) { 
                                foreach ($service_work_detail as $ser) {?>
                        <div class="features-item text-center col-sm-3 col-md-3 col-xs-12" data-sr='enter'>
                            <div class="icon-outer icon1">
                               
                                <center><img src="<?php echo base_url() ?>admin/uploads/service/<?php echo $ser->image; ?>" alt="responsive img" style="border-radius: 50px;"></center>
                                
                            </div>
                            <h4 class="text-1"><?php echo $ser->heading; ?></h4>

                            <?php if(!empty($service_work_detail->description)) { ?>
                            <p class="text-1"><?php echo $ser->description; ?></p>
                        <?php } ?>

                        </div>
                         
                            <?php } } ?>
                        </div>
                       
                       
                       
                    </div>
                </div>
            </div> 
        </div>
    </div>
    </div>
     <?php } ?>
  
    <br/><br/>
     
           <?php if(!empty($service_article)) { ?>
         <div class="about-area inner-padding5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="section-title-area-1 foo" data-sr='enter'></div>
                    <div class="about-content foo" data-sr='enter'>
                    <?php if(!empty($service_article->heading)) { ?>
                        <h4> <?php echo $service_article->heading; ?></h4>
                        <?php } else{ echo "N/A"; }?>

                        <?php if(!empty($service_article->description)){?>
                       <p> <?php echo $service_article->description; ?></p>
                   <?php } else { echo "N/A"; }?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5" style="margin-top: 97px; height: 300px;width: 300px;">
                    
                        <?php if(!empty($service_article->image)){ ?>
                            <img src="<?php echo base_url() ?>admin/uploads/ourservice/<?php echo $service_article->image ?>" alt="responsive img">
                        <?php }?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
            <div class="container" style="padding: 10px;">
                <?php if(!empty($ourservice)) { ?>
                <center>
                    <?php if(!empty($ourservice->heading)) { ?>
                    <h2 class="header-caption-inner" style="display: inline-block;border-bottom: 2px solid;"><?php echo $ourservice->heading; ?></h2>
                    <?php } else{ echo "N/A"; }?><br/>

                    <?php if(!empty($ourservice->description)){?>
                        <p style="padding: 10px;margin-left: 150px;margin-right: 150px;"><?php echo $ourservice->description; ?></p>
                     <?php } else { echo "N/A"; }?>
                    </center>
            <?php } ?>
            <?php if(!empty($ourservicelist)) { ?>
            <div class="row"> 
                <?php if(!empty($ourservicelist)){ ?>
                        <?php foreach ($ourservicelist as $ser) {?>
                <div class="col-xs-12 col-sm-6 col-md-3 foo" data-sr='enter'>
                    <div class="service-item">
                       
                             <h4><?php echo $ser->heading; ?></h4>
                             <p><?php echo $ser->description; ?></p>
                      
                    </div>
                </div>
                <?php }?>
                        <?php }?>
            </div>
            <?php } ?>
        </div>
        
   
    
<?php $this->load->view('common/footer');?>