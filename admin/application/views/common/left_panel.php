<?php  
$user_id = $_SESSION['SESSION_NAME']['id'];
$con = "id='".$user_id."'";
$userData = $this->Crud_model->get_single('admin',$con);
if (file_exists('uploads/document/'.$userData->profile)) {
  if (!empty($userData->profile)) {
    $imageProfile = base_url('uploads/document/'.$userData->profile);
  }else{
    $imageProfile = base_url('uploads/document/user.jpg');
  }
}else{
  $imageProfile = base_url('uploads/document/user.jpg');
}
$seg1 =$this->uri->segment(1);
$seg2 =$this->uri->segment(2);
?>
<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= $imageProfile; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <span class="logo-mini"><b></b></span>
        <p style="text-transform: uppercase;"><strong><?php if(!empty($userData)){?><?php echo ucfirst($userData->name); ?><?php }else{ echo "-";} ?></strong></p>  
        <p><?php if(!empty($_SESSION)){?><?php echo $_SESSION['SESSION_NAME']['designation']; ?><?php }else{ echo "-";} ?></p>
      </div>
    </div>
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search..." id="id_search2">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li <?php if ($seg1 =='Welcome' && $seg2 =='dashboard') {?>class="active"<?php }?>>
        <a href="<?= site_url('Welcome/dashboard');?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
     <?php  if($_SESSION['SESSION_NAME']['designation']=='admin') { ?>
      <li class="treeview <?php if ($seg1 =='Countries' || $seg1 =='States' || $seg1 =='Cities' || $seg1 =='ProductMaster' || $seg1 =='Cms') {?> active <?php }?>" >
        <a href="#">
          <i class="fa fa-edit"></i> <span>Manage Master</span> 
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($seg1 =='Countries') {?>class="active"<?php }?>><a href="<?= site_url('Countries');?>"><i class="fa fa-circle-o"></i> Countries</a></li>
          <li <?php if ($seg1 =='States') {?>class="active"<?php }?>><a href="<?= site_url('States');?>"><i class="fa fa-circle-o"></i> States</a></li>
          <li <?php if ($seg1 =='Cities') {?>class="active"<?php }?>><a href="<?= site_url('Cities');?>"><i class="fa fa-circle-o"></i> Cities</a></li>
           <li <?php if ($seg1 =='Settings') {?>class="active"<?php }?>><a href="<?= site_url('Settings');?>"><i class="fa fa-circle-o"></i> Manage Settings</a></li>
           <li <?php if ($seg1 =='Cms') {?>class="active"<?php }?>><a href="<?= site_url('Cms');?>"><i class="fa fa-circle-o"></i> Manage CMS</a></li>
            <li <?php if ($seg1 =='Expence') {?>class="active"<?php }?>>
        <a href="<?= site_url('Expence');?>"><i class="fa fa-circle-o"></i>Manage Expences</a>
      </li> 
          <li <?php if ($seg1 =='Holidays') {?>class="active"<?php }?>><a href="<?= site_url('Holidays');?>"><i class="fa fa-circle-o"></i> Holidays</a></li>
           <li <?php if ($seg1 =='Demo_details') {?>class="active"<?php }?>><a href="<?= site_url('Demo_details');?>"><i class="fa fa-circle-o"></i>Manage Product</a></li>
        </ul>
      </li>
       <li <?php if ($seg1 =='CustomerMaster') {?>class="active"<?php }?>>
        <a href="<?= site_url('CustomerMaster');?>"><i class="fa fa-circle-o"></i> Manage Customer</a>
      </li>
       <li class="treeview <?php if ($seg1 =='Banner' || $seg1 =='Aboutus' || $seg1 =='Slider_image' || $seg1 =='career' || $seg1 =='contact' ||  $seg1 =='Designation') {?> active <?php }?>" >
        <a href="#">
          <i class="fa fa-edit"></i> <span>Manage Website</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
             <li <?php if ($seg1 =='Banner') {?>class="active"<?php }?>>
            <a href="<?= site_url('Banner');?>"><i class="fa fa-circle-o"></i> Banner</a>
          </li>
          <li <?php if ($seg1 =='Aboutus') {?>class="active"<?php }?>>
            <a href="<?= site_url('Aboutus');?>"><i class="fa fa-circle-o"></i> About Us</a>
          </li>
          <li <?php if ($seg1 =='Slider Image') {?>class="active"<?php }?>>
            <a href="<?= site_url('Slider_image');?>"><i class="fa fa-circle-o"></i> Client Image</a>
          </li>
          <li <?php if ($seg1 =='career') {?>class="active"<?php }?>>
            <a href="<?= site_url('career');?>"><i class="fa fa-circle-o"></i> Career</a>
          </li>
          <li <?php if ($seg1 =='contact') {?>class="active"<?php }?>>
            <a href="<?= site_url('contact');?>"><i class="fa fa-circle-o"></i> Contact</a>
          </li>
          <li <?php if ($seg1 =='Designation') {?>class="active"<?php }?>><a href="<?= site_url('Designation');?>"><i class="fa fa-circle-o"></i>Manage Designation</a></li>

          <li class="treeview <?php if ($seg1 =='Hardware' || $seg1 =='HardwareDetail' || $seg1 =='Hardware_Service' || $seg1 =='Hardware_list' || $seg1 =='Hardware_Article') {?> active <?php }?>" >
            <a href="#">
              <i class="fa fa-edit"></i> <span>Manage Hardware</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?php if ($seg1 =='Hardware') {?>class="active"<?php }?>><a href="<?= site_url('Hardware');?>"><i class="fa fa-circle-o"></i> Hardware</a></li>
              <li <?php if ($seg1 =='HardwareDetail') {?>class="active"<?php }?>><a href="<?= site_url('HardwareDetail');?>"><i class="fa fa-circle-o"></i> Hardware Details</a></li> 
              <li <?php if ($seg1 =='Hardware_Service') {?>class="active"<?php }?>><a href="<?= site_url('Hardware_Service');?>"><i class="fa fa-circle-o"></i> Hardware Services</a></li> 
              <li <?php if ($seg1 =='Hardware_list') {?>class="active"<?php }?>><a href="<?= site_url('Hardware_list');?>"><i class="fa fa-circle-o"></i> Hardware Services List</a></li>
              <li <?php if ($seg1 =='Hardware_Article') {?>class="active"<?php }?>><a href="<?= site_url('Hardware_Article');?>"><i class="fa fa-circle-o"></i> Hardware Article</a></li>
            </ul>
          </li>
          <li class="treeview <?php if ($seg1 =='Services' || $seg1 =='Service_detail' || $seg1 =='Service_article' ||  $seg1 =='Service_work' || $seg1 =='Service_work_detail' || $seg1 =='Ourservices' || $seg1 =='Service_work_detail' || $seg1 =='Ourserviceslist') {?> active <?php }?>" >
            <a href="#">
              <i class="fa fa-edit"></i> <span>Manage Services</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?php if ($seg1 =='Services') {?>class="active"<?php }?>><a href="<?= site_url('Services');?>"><i class="fa fa-circle-o"></i>Services</a></li>
              <li <?php if ($seg1 =='Service_detail') {?>class="active"<?php }?>><a href="<?= site_url('Service_detail');?>"><i class="fa fa-circle-o"></i> Service Detail</a></li>
              <li <?php if ($seg1 =='Service_article') {?>class="active"<?php }?>><a href="<?= site_url('Service_article');?>"><i class="fa fa-circle-o"></i> Service Article</a></li>
              <li <?php if ($seg1 =='Service_work') {?>class="active"<?php }?>><a href="<?= site_url('Service_work');?>"><i class="fa fa-circle-o"></i> Service Work</a></li>
              <li <?php if ($seg1 =='Service_work_detail') {?>class="active"<?php }?>><a href="<?= site_url('Service_work_detail');?>"><i class="fa fa-circle-o"></i> Service Work Detail</a></li> 
              <li <?php if ($seg1 =='Ourservices') {?>class="active"<?php }?>><a href="<?= site_url('OurServices');?>"><i class="fa fa-circle-o"></i>Our Services</a></li>
              <li <?php if ($seg1 =='Ourserviceslist') {?>class="active"<?php }?>><a href="<?= site_url('OurServiceslist');?>"><i class="fa fa-circle-o"></i>Our Services List</a></li>
            </ul>
          </li>
          <li class="treeview <?php if ($seg1 =='Industries' || $seg1 =='Industries_Detail' || $seg1 =='Industries_Services' || $seg1 =='Industries_Services' ||  $seg1 =='Industries_Blog' ||  $seg1 =='Industrial_Blog_list') {?> active <?php }?>" >
            <a href="#">
              <i class="fa fa-edit"></i> <span>Manage Industries</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?php if ($seg1 =='Industries') {?>class="active"<?php }?>><a href="<?= site_url('Industries');?>"><i class="fa fa-circle-o"></i> Industries</a></li>
              <li <?php if ($seg1 =='Industries Detail') {?>class="active"<?php }?>><a href="<?= site_url('Industries_Detail');?>"><i class="fa fa-circle-o"></i> Industries Detail</a></li>
              <li <?php if ($seg1 =='Industries Services') {?>class="active"<?php }?>><a href="<?= site_url('Industries_Services');?>"><i class="fa fa-circle-o"></i> Industries Services</a></li>
              <li <?php if ($seg1 =='Industries Services List') {?>class="active"<?php }?>><a href="<?= site_url('Industries_list');?>"><i class="fa fa-circle-o"></i> Industries Services List</a></li>
              <li <?php if ($seg1 =='Industries Blog') {?>class="active"<?php }?>><a href="<?= site_url('Industries_Blog');?>"><i class="fa fa-circle-o"></i> Industries Blog</a></li>
              <li <?php if ($seg1 =='Industries Blog List') {?>class="active"<?php }?>><a href="<?= site_url('Industrial_Blog_list');?>"><i class="fa fa-circle-o"></i> Industries Blog List</a></li>
            </ul>
          </li>
        </ul>
      </li>
       <li class="treeview <?php if ($seg1 =='Software' || $seg1 =='Manage_Software' || $seg1 =='Quotation') {?> active <?php }?>" >
            <a href="#">
              <i class="fa fa-edit"></i> <span>Manage Quotation</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
               <li <?php if ($seg1 =='Software') {?>class="active"<?php }?>><a href="<?= site_url('Software');?>"><i class="fa fa-circle-o"></i> Manage Software</a></li>
              <li <?php if ($seg1 =='Manage_Software') {?>class="active"<?php }?>>
                <a href="<?= site_url('Manage_Software');?>"><i class="fa fa-circle-o"></i>Software Details</a>
              </li>
              <li <?php if ($seg1 =='Quotation') {?>class="active"<?php }?>>
              <a href="<?= site_url('Quotation');?>"><i class="fa fa-circle-o"></i>Manage Quotation</a>
            </li>
            </ul>
          </li>
        
        <li <?php if ($seg1 =='Intendletter') {?>class="active"<?php }?>>
            <a href="<?= site_url('Intendletter');?>"><i class="fa fa-circle-o"></i>Manage Letter Head</a>
        </li> 
          
          
          
          
          <li class="treeview <?php if ($seg1 =='Invoice' || $seg1 =='Invoice_GST') {?> active <?php }?>" >
        <a href="#">
          <i class="fa fa-edit"></i> <span>Manage Invoice</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($seg1 =='Invoice') {?>class="active"<?php }?>><a href="<?= site_url('Invoice');?>"><i class="fa fa-circle-o"></i> Invoice</a></li>
          <li <?php if ($seg1 =='Invoice_GST') {?>class="active"<?php }?>><a href="<?= site_url('Invoice_GST');?>"><i class="fa fa-circle-o"></i> Invoice GST</a></li>
        </ul>
      </li>
       <li <?php if ($seg1 =='Employees') {?>class="active"<?php }?>><a href="<?= site_url('Employees');?>"><i class="fa fa-circle-o"></i>Manage Employees</a></li>
        <li class="treeview <?php if ($seg1 =='Industries' || $seg1 =='Industries_Detail' || $seg1 =='Industries_Services' || $seg1 =='Industries_Services' ||  $seg1 =='Industries_Blog' ||  $seg1 =='Industrial_Blog_list') {?> active <?php }?>" >
            <a href="#">
              <i class="fa fa-edit"></i> <span>Manage Training</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?php if ($seg1 =='Training') {?>class="active"<?php }?>><a href="<?= site_url('Training');?>"><i class="fa fa-circle-o"></i> Create Receipts </a></li>
             
            </ul>
          </li>
     <li <?php if ($seg1 =='Lead') {?>class="active"<?php }?>>
        <a href="<?= site_url('Lead');?>"><i class="fa fa-circle-o"></i>Manage Lead</a>
      </li> 
     
       <li <?php if ($seg1 =='Certificate_type') {?>class="active"<?php }?>><a href="<?= site_url('Certificate_type');?>"><i class="fa fa-circle-o"></i>Manage Company Document</a></li>
      <li <?php if ($seg1 =='Certificates') {?>class="active"<?php }?>><a href="<?= site_url('Certificates');?>"><i class="fa fa-circle-o"></i>Manage Document</a></li>
     <li <?php if ($seg1 =='Students') {?>class="active"<?php }?>><a href="<?= site_url('Students');?>"><i class="fa fa-child"></i>Manage Students</a></li>
      <li <?php if ($seg1 =='Requirement') {?>class="active"<?php }?>>
        <a href="<?= site_url('Requirement');?>"><i class="fa fa-circle-o"></i>Client Requirement</a>
      </li>
       <li <?php if ($seg1 =='Manage_company_data') {?>class="active"<?php }?>>
        <a href="<?= site_url('Manage_company_data');?>"><i class="fa fa-circle-o"></i>PVT.LTD. Leads</a>
      </li>
       <li <?php if ($seg1 =='LLP_company_data') {?>class="active"<?php }?>>
        <a href="<?= site_url('LLP_company_data');?>"><i class="fa fa-circle-o"></i>LLP Leads</a>
      </li>
      <li <?php if ($seg1 =='LoginHistory') {?>class="active"<?php }?>>
          <a href="<?= site_url('LoginHistory');?>"><i class="fa fa-circle-o"></i> Login History</a>
        </li>
       
       <li <?php if ($seg1 =='Intent_letter') {?>class="active"<?php }?>>
        <a href="<?= site_url('Intent_letter');?>"><i class="fa fa-circle-o"></i>Add Intent Letter</a>
      </li>
       <li <?php if ($seg1 =='Taskassign') {?>class="active"<?php }?>><a href="<?= site_url('Taskassign');?>"><i class="fa fa-list-alt"></i>Tasks Assign</a></li>
      <?php }?>
        <?php  if($_SESSION['SESSION_NAME']['designation']=='marketing' || $_SESSION['SESSION_NAME']['designation']=='telecaller') { ?>
        <li <?php if ($seg1 =='Lead') {?>class="active"<?php }?>>
        <a href="<?= site_url('Lead');?>"><i class="fa fa-circle-o"></i>Manage Lead</a>
      </li>
      <li <?php if ($seg1 =='Requirement') {?>class="active"<?php }?>>
        <a href="<?= site_url('Requirement');?>"><i class="fa fa-circle-o"></i>Add Client Requirement</a>
      </li>
       <li <?php if ($seg1 =='Manage_company_data') {?>class="active"<?php }?>>
        <a href="<?= site_url('Manage_company_data');?>"><i class="fa fa-circle-o"></i>PVT.LTD. Leads</a>
      </li>
         <li <?php if ($seg1 =='LLP_company_data') {?>class="active"<?php }?>>
        <a href="<?= site_url('LLP_company_data');?>"><i class="fa fa-circle-o"></i>LLP Leads</a>
      </li>
      <?php } ?>
      <?php  if($_SESSION['SESSION_NAME']['designation']=='HR Recruiter') { ?>
       <li <?php if ($seg1 =='Students') {?>class="active"<?php }?>><a href="<?= site_url('Students');?>"><i class="fa fa-child"></i>Manage Students</a></li>
         <?php } ?>
          <?php  if($_SESSION['SESSION_NAME']['designation']=='PHP DEVELOPER') { ?>
       <li <?php if ($seg1 =='Taskassign') {?>class="active"<?php }?>><a href="<?= site_url('Taskassign');?>">
           <i class="fa fa-list-alt"></i>Tasks Assign</a></li>
         <?php } ?>
         
         <?php  if($_SESSION['SESSION_NAME']['designation']!='admin') { ?>
          <li <?php if ($seg1 =='Attendence') {?>class="active"<?php }?>>
          <a href="<?= site_url('Attendence/viewLogin');?>"><i class="fa fa-circle-o"></i>Login Summary</a>
        </li>
        <?php } ?>
      <!--<li <?php if ($seg1 =='Attendence') {?>class="active"<?php }?>>
          <a href="<?= site_url('Attendence');?>"><i class="fa fa-circle-o"></i>My Login</a>
        </li>  -->
       
    </ul>
  </section>
</aside>