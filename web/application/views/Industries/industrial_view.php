<?php $this->load->view('common/header.php');?>
<div class="page-header" id="home">
        <div class="header-caption">
            <div class="header-caption-contant">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="header-caption-inner">
                               <!-- <p><a href="<?php echo site_url('Industries/index'); ?>">Home </a> >< ?php if (!empty($insdustry->title)) { echo $insdustry->title;}else{?>
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
                            <img src="<?php echo base_url()?>admin/uploads/industries/<?php echo $images->image; ?>" alt="responsive img">
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
                            <?php echo ""; }?>
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
                       <!--  <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-crop"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title">Electronics Engineering Services</h4>
                                <p>Hardware engineering services, such as board design, design analysis, and platforms for in-flight entertainment.</p>
                            </div>
                        </div>
                        <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-object-group"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title">Mechanical & Structural Engineering Services</h4>
                                <p>Composite lifecycle solutions encompassing industrial design, CAD, CAE, reliability, and documentation.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="feature-item">
                        <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-file-code-o"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title">ATE & Test Engineering Services</h4>
                                <p>Test solution implementation experience and strong process and standards for test equipment design and development.</p>
                            </div>
                        </div>
                        <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-desktop"></i><i class="fa fa-tablet inner-icon"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title">Automation</h4>
                                <p>IoT-led manufacturing process efficiencies</p>
                            </div>
                        </div>
                        <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-code"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title">PLM-led Agility</h4>
                                <p>Next generation PLM strategies for lower risk and increased agility.</p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- End Feature Section -->
    <!-- Service Section -->
    <div class="service-area inner-padding5">
        <div class="container">
            <div class="section-title-area-4 foo" data-sr='enter'>
                        <h2 class="section-title"><?php if(!empty($insdustry_blog->heading)){ echo $insdustry_blog->heading; }else{?>
                            <?php echo " "; }?>
                        </h2>
                        <p><?php if(!empty($insdustry_blog->description)){ echo $insdustry_blog->description; }else{?>
                            <?php echo " "; }?>
                        </p>
                    </div>
            <div class="row">
                <?php if(!empty($industries_blog_list)){ ?>
                <?php foreach ($industries_blog_list as $row) { ?>
                    
               
                <div class="col-xs-12 col-sm-6 col-md-3 foo" data-sr='enter'>
                    <div class="service-item">
                       <!-- <div class="service-icon">
                            <img src="<?php echo base_url('assets/img/research-white.png') ?>" alt="responsive img">
                        </div>-->
                        <h4><?php echo $row->heading; ?>
                        </h4>
                        <p><?php echo $row->description; ?>
                        </p>
                    </div>
                </div>
               <?php } }?>
            </div>
        </div>
    </div>
    <!-- End Service Section -->
    
<?php $this->load->view('common/footer');?>