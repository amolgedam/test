
<?php $this->load->view('common/header.php');?>
<style type="text/css">
/*  .margin{margin-left: 190px;margin-right: 183px;}*/
    .section-divider{margin-top: 20px;}
    .divider-traingle{border: 1px solid #38A6F1; width: 200px;opacity: 0.4;position: relative;display: inline-block;}
    .divider-traingle::before{position: absolute;content: "";width: 18px;height: 18px;background-color: #00aeef;opacity: 0.4;-ms-transform: rotate(45deg);-webkit-transform: rotate(45deg);transform: rotate(45deg);margin-top: -9px;}
    .divider-traingle::after{background: #38A6F1;position: absolute;
    content: "";
    width: 18px;
    height: 18px;
    /*background: #00aeef;*/
    top: -9px;
    left: 45%;
    opacity: 0.4;
    -ms-transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
}
.text-1{margin-top: 30px; color: white;margin-bottom:30px;}
.features-item .icon-outer{display: inline-table;width: 90px;height: 90px;position: relative;}
.page-header-dark{background-color: #262626;height: auto;}
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

</style>
<!-- <div class="" id="home"> -->
        <div class="header-caption">
            <!-- <div class="header-caption-contant"> -->
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 style="margin-top: 50px;">ABOUT US</h2>
                                 <?php if(!empty($aboutus->description)){?>
                                <p class="margin"><?php echo $aboutus->description; ?></p>
                                <?php } else { echo "N/A"; }?>
                            <!-- </div> -->
                        </div>
                        <div class="section-divider divider-traingle"></div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    <!--    </div> -->
    
            <div class="service-area inner-padding5">
        <div class="page-header-dark" id="home">
        <div class="header-caption">
            <div class="header-caption-contant">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="header-caption-inner" style="margin-top: -56px;">
                                <h2 class="header-caption-inner" style="color: white;display: inline-block;border-bottom: 2px solid;">Our Journey</h2><br/>
                                 <p style="margin-right: 100px;margin-left: 100px;margin-top: 20px; margin-bottom:30px"> </p>
                            </div>
                        </div>
                         <div class="features-item text-center col-sm-3 col-xs-12" data-sr='enter'>
                            <div class="icon-outer">
                                <h2 class="text">2016</h2>
                            </div>
                            <h4 class="text-1">Target the goal</h4>
                        </div>

                        <div class="features-item text-center col-sm-3 col-xs-12" data-sr='enter'>
                            <div class="icon-outer">
                                <h2 class="text">2017</h2>
                            </div>
                            <h4 class="text-1">Work in heard</h4>
                        </div>
                        <div class="features-item text-center col-sm-3 col-xs-12" data-sr='enter'>
                            <div class="icon-outer">
                                <h2 class="text">2018</h2>
                            </div>
                            <h4 class="text-1">Analytic everything</h4>
                        </div>
                        <div class="features-item text-center col-sm-3 col-xs-12" data-sr='enter'>
                            <div class="icon-outer">
                                <h2 class="text">2019</h2>
                            </div>
                            <h4 class="text-1">Live the goal</h4>
                        </div>
              
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
        <div class="container">
        <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 foo" data-sr='enter'>
                    <div class="service-item features-item-item">
                        <div class="icon-outer-icon" style="margin-top: -35px;">
                                <i class="fa fa-smile-o icon" aria-hidden="true"></i>
                            </div><br/><br/>
                        <p style="font-size: 20px;"><b>Quality</b></p>
                        <p>World planet specsialists there are only officially certified experts and talented developers with years of experience and technology + industry knowledge. World Planet developers- over 50% of whom are Seniors .</p>
                    </div>
                </div>
                 <div class="col-xs-12 col-sm-6 col-md-4 features-item-item" data-sr='enter'>
                    <div class="service-item">
                        <div class="icon-outer-icon" style="margin-top: -35px;">
                                <i class="fa fa-users icon" aria-hidden="true"></i>
                            </div><br/><br/>
                        <p style="font-size: 20px;"><b>Client</b></p>
                        <p>100% authentic web design reviews testimonials by World Planet E-Solution clients. Honesty and integrity is everything World Planet E-Solution.</p>
                    </div>
                </div>
                 <div class="col-xs-12 col-sm-6 col-md-4 features-item-item" data-sr='enter'>
                    <div class="service-item">
                        <div class="icon-outer-icon" style="margin-top: -35px;">
                                <i class="fa fa-certificate icon" aria-hidden="true"></i>
                            </div><br/><br/>
                        <p style="font-size: 20px;"><b>Certifications</b></p>
                        <p>World Planet is a Leading website design and development company which is headquartered. World Planet has 6+ years of experience in web design and development Industry completely in A to Z design solution providers.</p>
                    </div>
                </div>
            </div>
        </div>
   
    
<?php $this->load->view('common/footer');?>