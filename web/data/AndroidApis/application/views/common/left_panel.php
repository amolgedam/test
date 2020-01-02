<?php  
  $user_id = $_SESSION['admin']['id'];
  $con = "id='".$user_id."'";
  $userData = $this->Crud_model->get_single('admin',$con);
 // print_r($userData->name);exit();
  if (!file_exists('uploads/'.$userData->profile)) {
    if (!empty($userData->profile)) {
      $imageProfile = base_url('uploads/'.$userData->profile);
    }else{
      $imageProfile = base_url('uploads/default1.png');
    }
  }else{
    $imageProfile = base_url('uploads/default1.png');
  }
  $seg1 =$this->uri->segment(1);
  $seg2 =$this->uri->segment(2);
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= $imageProfile; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
      <span class="logo-mini"><b></b></span>
          <p><?php if(!empty($userData)){?><?php echo ucfirst($userData->name); ?><?php }else{ echo "-";} ?></p>
           <a href="#"><i class="fa fa-circle text-success"></i> <?php if(!empty($userData)){?><?php echo ucfirst($userData->admin_type); ?><?php }else{ echo "-";} ?></a> 
        </div>
      </div>
       <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search..." id="id_search2">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php 
              /*if(isset($_SESSION['admin'])){*/

               // print_r($_SESSION);exit;

          if(isset($_SESSION))
          {

          if($_SESSION['admin']['admin_type']=='admin_1')
          { ?>
        <li <?php if ($seg1 =='Welcome' && $seg2 =='dashboard') {?>class="active"<?php }?>>
          <a href="<?= site_url('Welcome/dashboard');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
         <!--  <ul class="treeview-menu">
            <li class="active"><a href=""><i class="fa fa-circle-o"></i> Dashboard</a></li>
          </ul> -->
        </li>
        <li class="treeview <?php if ($seg1 =='Countries' || $seg1 =='States' || $seg1 =='Cities' || $seg1 =='CompanyMaster' || $seg1 == 'Subcategory' || $seg1 =='BatchMaster' || $seg1 =='BranchMaster' || $seg1 =='MasterCourse' || $seg1 =='DocumentMaster'|| $seg1 =='MasterExpnces'|| $seg1 =='MasterGform'|| $seg1 =='MasterModel'|| $seg1 =='MasterSubExpence') {?> active <?php }?>" >
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
            <li <?php if ($seg1 =='CategoryMaster') {?>class="active"<?php }?>><a href="<?= site_url('CategoryMaster');?>"><i class="fa fa-circle-o"></i> Category Master</a></li>
             <li <?php if ($seg1 =='Subcategory') {?>class="active"<?php }?>><a href="<?= site_url('Subcategory');?>"><i class="fa fa-circle-o"></i>Products Master</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Manage Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($seg1 =='Users') {?>class="active"<?php }?>><a href="<?= site_url('Users'); ?>"><i class="fa fa-circle-o"></i>Customers</a></li>

            <li><a href="<?= site_url('Usersassign'); ?>"><i class="fa fa-circle-o"></i>Assign Old Customer</a></li>
            <!-- <li < ?php if ($seg1 =='Students') {?>class="active"< ?php }?>><a href="< ?= site_url('Students'); ?>"><i class="fa fa-circle-o"></i> Students</a></li> -->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Manage Employees</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($seg1 =='Employees') {?>class="active"<?php }?>><a href="<?= site_url('Employees'); ?>"><i class="fa fa-circle-o"></i>Employees</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Manage Order</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($seg1 =='ManageCashOrder') {?>class="active"<?php }?>><a href="<?= site_url('ManageCashOrder'); ?>"><i class="fa fa-circle-o"></i> Manage Days Order</a>
            </li>
            <li <?php if ($seg1 =='ManageCusomerAmount') {?>class="active"<?php }?>><a href="<?= site_url('ManageCusomerAmount'); ?>"><i class="fa fa-circle-o"></i> Manage Customer Amount</a>
            </li>
             <li <?php if ($seg1 =='ManageDayWise') {?>class="active"<?php }?>><a href="<?= site_url('ManageDayWise'); ?>"><i class="fa fa-circle-o"></i> Employee Day Wise</a>
            </li>

          </ul>
        </li>
        <!-- <li>
          <a href="<?= site_url('Contact_us'); ?>">
            <i class="fa fa-folder"></i> <span>Contact Us</span>
           
          </a>
        </li> -->
       
        <li <?php if ($seg1 =='Settings') {?>class="active"<?php }?>><a href="<?= site_url('Settings'); ?>"><i class="fa fa-cog"></i> <span>General Settings</span></a></li>
        
        <li class="treeview <?php if($seg1=='CMS'){ echo "active"; }   ?>">
          <a href="#">&nbsp;<i class="fa fa-bars"></i> <span>Manage CMS</span><i class= "fa fa-angle-left pull-left">
            
          </i> </a>
          <ul class="treeview-menu">

          <li class="<?php if($seg1=='CMS'){ echo "active";} ?>">
            <a href="<?= site_url('CMS/index'); ?>">
            &nbsp;<span><i class="fa fa-file" aria-hidden="true"></i>
            &nbsp; CMS</span> 
            </a>
          </li>
        <?php }else{?>
          <li <?php if($seg1 =='Welcome' && $seg2 =='dashboard') {?>class="active"<?php } ?>>
          <a href="<?= site_url('Welcome/dashboard');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
         <!--  <ul class="treeview-menu">
            <li class="active"><a href=""><i class="fa fa-circle-o"></i> Dashboard</a></li>
          </ul> -->
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Manage Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($seg1 =='Users') {?>class="active"<?php }?>><a href="<?= site_url('Users'); ?>"><i class="fa fa-circle-o"></i>Customers</a></li>
            <!-- <li <?php if ($seg1 =='Students') {?>class="active"<?php }?>><a href="<?= site_url('Students'); ?>"><i class="fa fa-circle-o"></i> Students</a></li> -->
          </ul>
        </li>
        <?php } } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>