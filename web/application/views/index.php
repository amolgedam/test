<?php $this->load->view('common/header.php');?>
<style type="text/css">
.about-slider-2 {
    margin-top:0px;
}
/*.post-row:hover {*/
/*    background-color: #016ab2;*/
/*}*/
/*.post-row:hover h2 a,*/
/*.post-row:hover p {*/
/*    color: #fff;*/
/*}*/
.post-row{
    padding-left: 30px;
    padding-right: 30px;
}
.portfolio-caption-content h4 a{
    color: #016ab2;
    font-weight: bold;
}
.ser-img{
    height: 400px;
}
.client-img{
    height: 20px;
}
.indus{
    margin-left: -316px;
}
.mm{
    margin-left: -528px;
}
.service{
    margin-left: -325px;
}
.industries{
    margin-left: -225px;
}
.product{
    margin-left: -500px;
}
.ser{
    height: 200px;
}
.glyphicon {
    margin-left: 100px;
    font-size: 100px;
}
</style>
    <!-- End Nav Section -->
    <!-- Hero Section -->
    <div class="hero-area" id="home">
        <div id="hero-slider-screen" class="owl-carousel owl-theme hero-slider-inner">
             <?php if(!empty($banners)) { foreach($banners as $row) { ?>
            <div class="item">
                <img class="img-responsive" src="<?php echo base_url('admin/uploads/banners/'.$row->image); ?>" alt="responsive img">
            </div>
            <?php }}?>
          <!--  <div class="item">
                <img class="img-responsive"  src="<?php echo base_url('assets/img/2.jpg'); ?>" alt="responsive img">
                <div class="hero-caption">
                    <div class="hero-caption-inner">
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="img-responsive" src="<?php echo base_url('assets/img/3.jpg'); ?>" alt="responsive img">
                <div class="hero-caption">
                    <div class="hero-caption-inner">
                    </div>
                </div>
            </div>-->
            <!--<div class="item">-->
            <!--    <img class="img-responsive" src="<?php echo base_url('assets/img/banner/4.png'); ?>" alt="responsive img">-->
            <!--    <div class="hero-caption">-->
            <!--        <div class="hero-caption-inner">-->
            <!--            <h3>WE PROVIDE BEST SOLUTIONS</h3>-->
            <!--            <h1>FOR YOUR BUSINESS</h1>-->
            <!--            <p>Lorem consectetur adipiscing elit, sed do eiusmod tempor dolor sit amet contetur adipiscing elit, sed do eiusmod tempor incididunt </p>-->
            <!--            <a href="#" class="btn btn-default btn-sm-outline" role="button">DISCOVER MORE</a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </div>
    <!-- End Hero Section -->
    
    <!--<div class="action-area inner-padding">-->
    <!--    <div class="action-area-inner1">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-xs-12">-->
                        
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- About Section -->
    <div class="action-area inner-padding">
        <div class="action-area-inner1 img-responsive img-banner1">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="action-caption foo" data-sr='enter'>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-area inner-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div id="about-silder-2" class="owl-carousel owl-theme about-slider-2 foo" data-sr='enter'>
                        <div class="item">
                            <img src="<?php echo base_url('assets/img/about-3.png'); ?>" alt="responsive img">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url('assets/img/about-2.png'); ?>" alt="responsive img">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url('assets/img/about-1.png'); ?>" alt="responsive img">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="section-title-area-1 foo" data-sr='enter'>
                        <h2 class="section-title">About Us</h2>
                    </div>
                    <div class="about-content foo" data-sr='enter'>
                        <p><span class="text-bold">World Planet</span>  is a Mobile App Development, and Web Development solutions provider. We leverage our extensive and deep industry knowledge to furnish our clients with solutions that are customized to your each and every requirement.</p>
                        <a href="<?php echo site_url('Aboutus/aboutus_data') ?>" class="btn btn-default btn-readmore-2" role="button">Read More..</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Section -->
    
    <!-- Call To Action Section -->
    <div class="action-area inner-padding">
        <div class="action-area-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="action-caption foo" data-sr='enter'>
                            <h2>#1 Best Website Design & Development Company</h2>
                            <p>World Planet is a full featured web design, Ecommerce website designing and development, Web development company. We provides custom application design and development android & IOS Mobile App development and more for affordable prices.</p>
                            <a href="<?php echo site_url('Welcome/contact') ?>" class="btn btn-default btn-sm-outline" role="button">Know More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Call To Action Section -->
   
    <!-- Portfolio Section -->
    <div class="portfolio-area inner-padding7">
        <div class="container">
            <div class="row foo" data-sr='enter'>
                <div class="col-xs-12 text-center">
                    <div class="portfolio-filter">
                        <div class="section-title-area-4 foo" data-sr='enter'>
                        <h2 class="section-title">Our Services</h2>
                        <p>We offer a wide variety of website design and development services, including Graphic Design with Ecommerce and custom application design with Responsive feature.</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row foo" data-sr='enter'>
                <div class="portfolio-masonry portfolio-items">
                    <div class="portfolio-grid isotope print-design">
                        <img src="<?php echo base_url('assets/img/retail.jpg'); ?>" alt="responsive img" class="ser-img">
                        <div class="portfolio-caption">
                            <a class="portfolio-action-btn" href="<?php echo base_url('assets/img/retail.jpg');?>" data-popup="prettyPhoto[img]"></a>
                            <div class="portfolio-caption-content">
                            <h4><a href="#"><?php if(!empty($product_type)){echo $product_type;} ?></a></h4><br>
                                <p>
                                <a href="#"> <?php if(!empty($product_description)) 
                                                { 
                                                    if (strlen($product_description)>100) 
                                                    {
                                                        $product_de=substr($product_description,0,100).'...';
                                                        echo $product_de;
                                                    }
                                                    else
                                                    {
                                                        echo $product_description;
                                                    }
                                                }?></a></p>
                                <a href="<?php echo site_url('Products/retail_management/'.$product_id); ?>" class="btn btn-default btn-sm-outline" role="button">
                                    
                                READ MORE</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-grid isotope graphic-design">
                        <img src="<?php echo base_url('assets/img/ecommerce.jpg'); ?>" alt="responsive img" class="ser-img">
                        <div class="portfolio-caption">
                            <a class="portfolio-action-btn" href="<?php echo base_url('assets/img/ecommerce.jpg'); ?>" data-popup="prettyPhoto[img]"></a>
                            <div class="portfolio-caption-content">
                                 <h4><a href="#"><?php if(!empty($industry_type)){echo $industry_type;} ?></a></h4><br><p>
                                <a href="#"><?php if(!empty($industry_description)) 
                                                { 
                                                    if (strlen($industry_description)>100) 
                                                    {
                                                        $industry_descript=substr($industry_description,0,100).'...';
                                                        echo $industry_descript;
                                                    }
                                                    else
                                                    {
                                                        echo $industry_description;
                                                    }
                                                }?></a></p>
                                <a href="<?php echo site_url('Industries/indeustry_detail/'.$industry_id); ?>" class="btn btn-default btn-sm-outline" role="button">READ MORE</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="portfolio-grid isotope print-design">
                        <img src="<?php echo base_url('assets/img/health.jpg'); ?>" alt="responsive img" class="ser-img">
                        <div class="portfolio-caption">
                            <a class="portfolio-action-btn" href="<?php echo base_url('assets/img/health.jpg');?>" data-popup="prettyPhoto[img]"></a>
                            <div class="portfolio-caption-content">
                                <h4><a href="#"><?php if(!empty($service_type)){echo $service_type;} ?></a></h4><br><p>
                                <a href="#"><?php if(!empty($service_description))
                                    {
                                   if (strlen($service_description)>100) 
            {
              $service_descript=substr($service_description,0,100).'...';
              echo $service_descript;
            }
            else{
                echo $service_description;
            }
               } ?></a></p>
                                <a href="<?php echo site_url('Services/service_type/'.$service_id); ?>" class="btn btn-default btn-sm-outline" role="button">READ MORE</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-grid isotope graphic-design">
                        <img src="<?php echo base_url('assets/img/institute.jpeg') ?>" alt="responsive img" class="ser-img">
                        <div class="portfolio-caption">
                            <a class="portfolio-action-btn" href="assets/img/institute.jpeg" data-popup="prettyPhoto[img]"></a>
                            <div class="portfolio-caption-content">
                                <h4><a href="#"><?php if(!empty($heading)){echo $heading;} ?></a></h4><br>
                                <p>
                                <a href="#"><?php if(!empty($hardware_description))
                                    {
                                   if (strlen($hardware_description)>100) 
            {
              $hardware_descript=substr($hardware_description,0,100).'...';
              echo $hardware_descript;
            }
            else{
                echo $hardware_description;
            }
               } ?></a></p>
                                <a href="<?php echo site_url('Hardware/indeustry_detail/'.$hardware_id); ?>" class="btn btn-default btn-sm-outline" role="button">READ MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Portfolio Section -->

    <!-- Blog Section -->
    <div class="blog-area inner-padding2">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title-area-4 foo" data-sr='enter'>
                        <h2 class="section-title">Our Services</h2>
                        <p>We offer a wide variety of website design and development services, including Graphic Design with Ecommerce and custom application design with Responsive feature.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="post-row foo" data-sr='enter'>
                        <div class="post-header">
                            <div class="post-feature">
                                <i class="glyphicon glyphicon-globe"></i>
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="post-caption">
                                <h2 class="post-heading"><a href="#">Website Designing</a></h2>
                            </div>
                            <div class="post-text"><p>Website Redesigning, Designing, Ecommerce Website Design, Web Portal Development, Dynamic Website Design, Responsive Website Design, Print Design, Logos & Branding.</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="post-row foo" data-sr='enter'>
                        <div class="post-header">
                            <div class="post-feature">
                               <i class="glyphicon glyphicon-signal"></i> 
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="post-caption">
                                <h2 class="post-heading"><a href="#">Website Development</a></h2>
                            </div>
                            <p class="post-text">World Class Website Development, Ecommerce Website Development, Custom Web Development, Ecommerce Solutions, Custom Web Applications Development.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="post-row foo" data-sr='enter'>
                        <div class="post-header">
                            <div class="post-feature">
                               <i class="glyphicon glyphicon-piggy-bank"></i> 
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="post-caption">
                                <h2 class="post-heading"><a href="#">ERP Application Software</a></h2>
                            </div>
                            <p class="post-text">Track. Reconcile. Optimize. With World Planet ERP Software World Planet ERP is easy-to-use accounting software that facilitates recording and processing of different financial transactions and processes.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="post-row foo" data-sr='enter'>
                        <div class="post-header">
                            <div class="post-feature">
                               <i class="glyphicon glyphicon-modal-window"></i>
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="post-caption">
                                <h2 class="post-heading"><a href="#">Software Solution</a></h2>
                            </div>
                            <div class="post-text"><p>ERP, CRM, HRM, Billing Software, POS Software, GST / VAT Feature, healthcare software, school management software, institute management software, IOT, AI</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="post-row foo" data-sr='enter'>
                        <div class="post-header">
                            <div class="post-feature">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="post-caption">
                                <h2 class="post-heading"><a href="#">Online Marketing</a></h2>
                            </div>
                            <p class="post-text">Digital Marketing, Search Engine Optimization, Search Engine Marketing, Social Media Marketing, Email Marketing, Google Ads, Branding, Viral Marketing.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="post-row foo" data-sr='enter'>
                        <div class="post-header">
                            <div class="post-feature">
                              <i class="glyphicon glyphicon-phone"></i>
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="post-caption">
                                <h2 class="post-heading"><a href="#">Mobile App Development</a></h2>
                            </div>
                            <p class="post-text">Android Application Development, PHP Application Development, Java Applications Development, Mobile Applications Development, iOS App Development, Windows Application Development.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog Section -->

    
    <?php $this->load->view('common/footer');?>
