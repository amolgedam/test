<?Php $setting=$this->Common_model->GetData('settings',"*","","","","","1");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>World Planet E-Solution pvt. Ltd.</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Meta  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:400,600,700" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css');?>">
    <!--Owl Carousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.min.css');?>">
    <!-- Animated CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.min.css');?>">
    <!-- Prettyphoto Css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/prettyPhoto.css');?>">
    <!-- Theme CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/default.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/typography.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css');?>">
    <!-- Favicon -->
    <link rel="shortcut icon" type="<?php echo base_url('assets/image/png');?>" href="<?php echo base_url('assets/img/favicon.jpg');?>">
</head>
<style type="text/css">
    .post-row:hover {
    background-color: #016ab296 ;
}
.post-row:hover h2 a,
.post-row:hover p {
    color: #fff;
}
.subheader b{
    color:#016ab296;
}

.post-row{
    padding-left: 30px;
    padding-right: 30px;
}
.portfolio-caption-content h4 a{
    color: #016ab296 ;
    font-weight: bold;
}
.ser-img{
    height: 400px;
}
.client-img{
    height: 20px;
}
.indus{
    margin-left: -200px;
}
.mm{
    margin-left: -200px;
}
.service{
    margin-left: -350px;
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
.logo {
    max-width: 110px;
    height: auto;
    margin-top: -14px;
}
</style>
<body data-spy="scroll" data-target="#scroll-menu" data-offset="65">
    <!-- Preloader -->


    <div class="preloader-wrap">
        <div class="preloader-inside">
            <div <!--class="spinner spinner-1"-->>
                <img class="logo" src="<?php echo base_url('assets/img/151.gif'); ?>"  alt="responsive img">
                <span>WPES</span>
            </div>
        </div>
    </div>

    
    <!-- End Preloader -->
    <!-- Scroll Top Button -->
    <a href="#home" class="smoothscroll">
        <div class="scroll-top"><i class="fa fa-angle-up"></i></div>
    </a>

    <!-- End Scroll Top Button -->
    <!-- Nav Section -->
    <header>
        <!-- Nav Section -->
        <nav class="navbar navbar-default navbar-fixed-top nav-area" id="scroll-menu">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   <?php if(!empty($setting->logo)){  ?>
                    <a class="navbar-brand" href="<?php echo site_url('Welcome/index'); ?>"><img class="logo" src="<?php echo base_url('admin/uploads/logo/'.$setting->logo);?>" alt="responsive img"></a>
               <?php } ?>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >Industries</a>
                            <div class="dropdown-menu mega-dropdown-menu row industries">
                                <div class="col-xs-12 col-sm-3">
                                    <?php  $data=$this->Common_model->GetData('industries',"*","status='Active'");?> 
                                    <ul>
                                        <li class="dropdown-header">Product Engineering</li>
                                        <li class="divider"></li>
                                        <?php if(!empty($data)) { foreach ($data as $key) { ?>
                                        <li><a href="<?php echo site_url('Industries/indeustry_detail/'.$key->id); ?>"><?php if ($key->type == 'Product_Engineering'){?>
                                            <?php echo $key->title;?>
                                        </a></li>
                                        <?php } } }?>

                                    </ul>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <ul>
                                        <li class="dropdown-header">Markets</li>
                                        <li class="divider"></li>
                                        <?php if(!empty($data)) { foreach ($data as $key) { ?>
                                        <li><a href="<?php echo site_url('Industries/indeustry_detail/'.$key->id); ?>"><?php if ($key->type == 'Markets'){?>
                                            <?php echo $key->title;?>
                                        </a></li>
                                        <?php } } }?>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <ul>
                                        <li class="dropdown-header">Investment</li>
                                        <li class="divider"></li>
                                        <?php if(!empty($data)) { foreach ($data as $key) { ?>
                                        <li><a href="<?php echo site_url('Industries/indeustry_detail/'.$key->id); ?>"><?php if ($key->type == 'Investment'){?>
                                            <?php echo $key->title;?>
                                        </a></li>
                                        <?php } } }?>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <ul>
                                        <li class="dropdown-header">Financial</li>
                                        <li class="divider"></li>
                                        <?php if(!empty($data)) { foreach ($data as $key) { ?>
                                        <li><a href="<?php echo site_url('Industries/indeustry_detail/'.$key->id); ?>"><?php if ($key->type == 'Financial'){?>
                                            <?php echo $key->title;?>
                                        </a></li>
                                        <?php } } }?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services</a>
                             <div class="dropdown-menu mega-dropdown-menu row service">
                                <div class="col-xs-12 col-sm-3">
                                    <?php  $data=$this->Common_model->GetData('services',"*","status='Active'");
                                    ?>
                                    <ul>
                                       <li class="dropdown-header">Application Development</li>
                                        <li class="divider"></li>
                                        <?php if(!empty($data)) { foreach ($data as $key) { ?>
                                        <li><a href="<?php echo site_url('Services/service_type/'.$key->id); ?>"><?php if ($key->type == 'Application_Development'){?>
                                            <?php echo $key->title;?>
                                        </a></li>
                                        <?php } } }?>
                                    </ul>
                                        <hr>
                                    <ul>
                                       <li class="dropdown-header subheader"><a href="<?php echo site_url('Hosting/hosting_services') ?>"><b>Hosting Services</b></a></li>
                                        
                                        
                                    </ul>
                                     <ul>
                                       <li class="dropdown-header subheader"><a href="<?php echo site_url('Consultancies/consultancy_services') ?>"><b>Consultancy</b></a></li>
                                        
                                        
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <ul>
                                        <li class="dropdown-header">Digital Marketing</li>
                                        <li class="divider"></li>
                                         <?php if(!empty($data)) { foreach ($data as $key) { ?>
                                        <li><a href="<?php echo site_url('Services/service_type/'.$key->id); ?>"><?php if ($key->type == 'Digital_Marketing'){?>
                                            <?php echo $key->title;?>
                                        </a></li>
                                        <?php } } }?>
                                    </ul>
                                    <hr>
                                    <ul>
                                        <li class="dropdown-header">Mobile App</li>
                                        <li class="divider"></li>
                                        <?php if(!empty($data)) { foreach ($data as $key) { ?>
                                        <li><a href="<?php echo site_url('Services/service_type/'.$key->id); ?>"><?php if ($key->type == 'Mobile_App'){?>
                                            <?php echo $key->title;?>
                                        </a></li>
                                        <?php } } }?>
                                    </ul>
                                </div>
                                
                                <div class="col-xs-12 col-sm-3">
                                    <ul>
                                        <li class="dropdown-header">INFRASTRUCTURE</li>
                                        <li class="divider"></li>
                                        <?php if(!empty($data)) { foreach ($data as $key) { ?>
                                        <li><a href="<?php echo site_url('Services/service_type/'.$key->id); ?>"><?php if ($key->type == 'Infrastructure'){?>
                                            <?php echo $key->title;?>
                                        </a></li>
                                        <?php } } }?>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <ul>
                                        <li class="dropdown-header">Business Services</li>
                                        <li class="divider"></li>
                                        <?php if(!empty($data)) { foreach ($data as $key) { ?>
                                        <li><a href="<?php echo site_url('Services/service_type/'.$key->id); ?>"><?php if ($key->type == 'Business_Services'){?>
                                            <?php echo $key->title; }?>
                                        </a></li>
                                        <?php } } ?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                         <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Product</a>
                            <div class="dropdown-menu mega-dropdown-menu row product">
                                <div class="col-xs-12 col-sm-3">
                                    
                    <!-- Products Title Name -->
                                     <?php $data=$this->Common_model->GetData('product',"*","status='Active'");
                                        ?> 
                                    <ul>
                                        <li class="dropdown-header">Retail Management</li>
                                        <li class="divider"></li>
                                       <?php if(!empty($data)) { foreach ($data as $key) { ?>
                   

                                        <li><a href="<?php echo site_url('Products/retail_management/'.$key->id); ?>"><?php if ($key->product_type == 'Retail_Management'){?><?php echo $key->product_title;?></a></li>
                                      

                                   <?php  } } }?> 
                             
                                       </ul>
                                       
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <ul>
                                        <li class="dropdown-header">Markets</li>
                                        <li class="divider"></li>
                                        <?php if(!empty($data)) { foreach ($data as $key) { ?>
                                     <li><a href="<?php echo site_url('Products/retail_management/'.$key->id); ?>"><?php if ($key->product_type == 'Markets'){?><?php echo $key->product_title;?></a></li>
                                         <?php  } } }?> 
                                    </ul> 
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <ul>
                                        <li class="dropdown-header">Investment</li>
                                        <li class="divider"></li>
                                         <?php if(!empty($data)) { foreach ($data as $key) { ?>
                                <li><a href="<?php echo site_url('Products/retail_management/'.$key->id); ?>"><?php if ($key->product_type == 'Investment'){?><?php echo $key->product_title;?></a></li>
                                        <?php } } }?>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <ul>
                                        <li class="dropdown-header">Financial</li>
                                        <li class="divider"></li>
                                        <?php if(!empty($data)) { foreach ($data as $key) { ?>
                             <li><a href="<?php echo site_url('Products/retail_management/'.$key->id); ?>"><?php if ($key->product_type == 'Financial'){?><?php echo $key->product_title;?></a></li>
                                        <!-- <li><a href="#">Oracle</a></li>
                                        <li><a href="#">Business Assurance & Testing</a></li>
                                        <li><a href="#">DRYiCE Autonomics & Orchestration</a></li>
                                        <li><a href="#">SIAM for Applications</a></li>
                                        <li><a href="#">ERP Software Development</a></li> -->
                                    <?php } } }?>
                                    </ul>
                                </div>
                            </div>
                        </li>   
                       <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hardware</a>
                            <ul class="dropdown-menu">
                                <?php  $data=$this->Common_model->GetData('hardware',"*","status='Active'");
                                    ?>
                                    <?php foreach($data as $hard) {?>
                                <li><a href="<?php echo site_url('Hardware/indeustry_detail/'.$hard->id); ?>"><?php echo $hard->title ?></a></li>
                            <?php } ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="<?php echo site_url('Industries/career'); ?>" class="dropdown-toggle">Career</a>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Training</a>
                            <ul class="dropdown-menu">
                                <li><a href="">Marketing</a></li>
                                <li><a href="portfolio-masonary.html">HR and Development</a></li>
                                <li><a href="portfolio-3.html">Software Deveolpment Training </a></li>
                            </ul>
                        </li>
                         <li class="dropdown">
                            <?php  $data=$this->Common_model->GetData('aboutus',"*","status='Active'");
                                    ?>
                            <a href="<?php echo site_url('Aboutus/aboutus_data'); ?>" aria-haspopup="true" aria-expanded="false">About Us</a>

                        </li>
                        <li><a href="<?php echo site_url('Welcome/contact'); ?>">Contact</a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div> 
        </nav>
    </header>
   