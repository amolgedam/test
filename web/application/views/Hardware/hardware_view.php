<?php $this->load->view('common/header.php');?>
<div class="page-header" id="home">
        <div class="header-caption">
            <div class="header-caption-contant">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="header-caption-inner">
                                <!--<p><a href="<?php echo site_url('Industries/index'); ?>">Home </a> >< ?php if (!empty($insdustry->title)) { echo $insdustry->title;}else{?>
                                    < ?php  echo "N/A"; }?>
                                </p><br><br>-->
                                <h1><?php if(!empty($insdustrydetail->heading))echo $insdustrydetail->heading; ?></h1>
                                
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
                    <div id="about-silder-2" class="owl-carousel owl-theme about-slider-2 foo" data-sr='enter'>
                        <?php if(!empty($insdustryimage)){ ?>
                        <?php foreach($insdustryimage as $images) {?>
                        <div class="item item-banner">
                            <img src="<?php echo base_url()?>admin/uploads/hardware/<?php echo $images->image; ?>" alt="responsive img">
                        </div>
                        <?php } }?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="section-title-area-1 foo" data-sr='enter'>
                        <h2 class="section-title">Overview</h2>
                    </div>
                    <div class="about-content foo" data-sr='enter'>
                        <p><?php if(!empty($insdustrydetail->description)){ echo $insdustrydetail->description; }else{?>
                        <?php echo "NA"; }?> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Section -->

    <!-- Feature Section -->
    <div class="feature-area inner-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 foo" data-sr='enter'>
                    <div class="section-title-area-2">
                        <h2 class="section-title"><?php if(!empty($insdustry_service->heading)) {echo $insdustry_service->heading;}else { ?>
                            <?php echo "NA"; }?>
                        </h2>
                        <p><?php if(!empty($insdustry_service->description)) {echo $insdustry_service->description;} else{?>
                            <?php echo "NA"; }?>
                        </p>
                    </div>
                </div>
                <?php if(!empty($industries_list)){ ?>
                <?php foreach($industries_list as $row) {?>
                <div class="col-sm-12 col-md-6">
                    <div class="feature-item">
                        <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-pencil"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title"><?php echo $row->heading; ?></h4>
                                <p><?php echo $row->description; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } } ?>
            </div>
        </div>
    </div>
    <!-- End Feature Section -->
    <?php if(!empty($hardware_article)) { ?>
         <div class="about-area inner-padding" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="section-title-area-1 foo" data-sr='enter'></div>
                    <div class="about-content foo" data-sr='enter'>
                    <?php if(!empty($hardware_article->heading)) { ?>
                        <h4> <?php echo $hardware_article->heading; ?></h4>
                        <?php } else{ echo "N/A"; }?>

                        <?php if(!empty($hardware_article->description)){?>
                       <p> <?php echo $hardware_article->description; ?></p>
                   <?php } else { echo "N/A"; }?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5" style="margin-top: 97px; height: 300px;width: 300px;">
                    
                        <?php if(!empty($hardware_article->image)){ ?>
                            <img src="<?php echo base_url() ?>admin/uploads/hardware/<?php echo $hardware_article->image ?>" alt="responsive img">
                        <?php }?>
                </div>
            </div>
        </div>
    </div>                                    
<?php } ?>  
<br/><br/> 
    <!-- End Service Section -->
    
<?php $this->load->view('common/footer');?>