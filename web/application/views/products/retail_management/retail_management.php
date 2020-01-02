<?php $this->load->view('common/header.php');?>
<style type="text/css">
    .productimage{
        height: 300px;
    }
</style>
<div class="page-header" id="home">
        <div class="header-caption">
            <div class="header-caption-contant">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="header-caption-inner">
                               <!-- <p><a href="<?php echo site_url('Welcome/index'); ?>">Home </a>>< ?php if(!empty($get_product->product_title)) { echo $get_product->product_title;}else {echo "";}?></p><br><br>-->
                                <h1><?php if(!empty($retail_data->heading)) { echo $retail_data->heading;}else {echo "";}?></h1>
                               
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
                 <div class="col-sm-10 col-md-5">
                    <div id="about-silder-2" class="owl-carousel owl-theme about-slider-2 foo productimage" data-sr='enter'>
                        <?php if(!empty($productimage)){ ?>
                        <?php foreach($productimage as $row) {?>
                        <div class="item item-banner">
                    <img src="<?php echo base_url()?>admin/uploads/products/<?php echo $row->image; ?>" alt="responsive img">
                        </div>
                        <?php } }?>
                    </div>
                </div>
                
                <div class="col-sm-12 col-md-7">
                    <div class="section-title-area-1 foo" data-sr='enter'>
                        <h2 class="section-title">Overview</h2>
                    </div>
                    <div class="about-content foo" data-sr='enter'>
                        <center>
                        <p><span class="text-bold"><b style="font-size:16px;"><?php if(!empty($get_product->product_title)) { echo $get_product->product_title;}else {echo "";}?> :</b></span> </p>
                       <p><?php if(!empty($retail_data->description)) { echo $retail_data->description;}else {echo "";}?></p> 
                       </center>
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
                        <h2 class="section-title"><?php if(!empty($product_service->service_heading)) { echo $product_service->service_heading;}else {echo "";}?></h2>
                        <p><?php if(!empty($product_service->description)) { echo $product_service->description;}else {echo "";}?></p>
                    </div>
                </div>

               <!--  <div class="col-sm-12 col-md-6">
                    <div class="feature-item">
                        < ?php if(!empty($product_list)){
                         foreach ($product_list as $key) {
                           ?>
                     
                        <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-pencil"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title">< ?php if(!empty($product_list)) { echo $key->service_heading;}else {echo "N/A";}?></h4>
                                <p>< ?php if(!empty($product_list)) { echo $key->description;}else {echo "N/A";}?></p>
                            </div>
                        </div>
                    < ?php }}?> -->
                        <!-- <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-crop"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title">Electronics Engineering Services</h4>
                                <p>Hardware engineering services, such as board design, design analysis, and platforms for in-flight entertainment.</p>
                            </div>
                        </div> -->
                       <!--  <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-object-group"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title">Mechanical & Structural Engineering Services</h4>
                                <p>Composite lifecycle solutions encompassing industrial design, CAD, CAE, reliability, and documentation.</p>
                            </div>
                        </div> -->
                   
                <?php if(!empty($product_list)){ ?>
                <?php foreach($product_list as $row) {?>
                <div class="col-sm-12 col-md-6">
                    <div class="feature-item">
                        <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-pencil"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title"><?php echo $row->service_heading_list; ?></h4>
                                <p><?php echo $row->description; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } } ?>
                        <!-- <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-file-code-o"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title">ATE & Test Engineering Services</h4>
                                <p>Test solution implementation experience and strong process and standards for test equipment design and development.</p>
                            </div>
                        </div> -->
                       <!--  <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-desktop"></i><i class="fa fa-tablet inner-icon"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title">Automation</h4>
                                <p>IoT-led manufacturing process efficiencies</p>
                            </div>
                        </div> -->
                       <!--  <div class="single-feature foo" data-sr='enter'>
                            <div class="feature-icon"><i class="fa fa-code"></i></div>
                            <div class="feature-content">
                                <h4 class="feature-title">PLM-led Agility</h4>
                                <p>Next generation PLM strategies for lower risk and increased agility.</p>
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
                        <h2 class="section-title"><?php if(!empty($product_blog->blog_heading)){ echo $product_blog->blog_heading; }else{?>
                            <?php echo " "; }?>
                        </h2>
                        <p><?php if(!empty($product_blog->description)){ echo $product_blog->description; }else{?>
                            <?php echo " "; }?>
                        </p>
                    </div>
            <div class="row">
                 <?php if(!empty($product_blog_list))
                 {  // print_r($product_blog_list); exit(); ?>
                <?php foreach($product_blog_list as $row) 
                {


                    ?>
               
                <div class="col-xs-12 col-sm-6 col-md-3 foo" data-sr='enter'>
                    <div class="service-item">
                       <!-- <div class="service-icon">
                            <img src="< ?php echo base_url('assets/img/research-white.png') ?>" alt="responsive img">
                        </div>-->
                        <h4><?php echo $row->blog_heading_list; ?>
                            
                        </h4>
                        <p><?php echo $row->description;?>
                          
                        </p>
                    </div>

                </div>
               <?php } }?>
            </div>

        </div>
    </div>
    <!-- End Service Section -->
<?php $this->load->view('common/footer');?>