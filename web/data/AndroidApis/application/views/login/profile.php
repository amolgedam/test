<?php $this->load->view('common/header'); 
$this->load->view('common/left_panel');?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--   <li><a href="#">Examples</a></li> -->
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?= $profilePhoto;?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?= ucfirst($name); ?></h3>

              <p class="text-muted text-center"><?= ucwords($user_type);?></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
         <!--  <div class="box box-primary">
           <div class="box-header with-border">
             <h3 class="box-title">About Me</h3>
           </div>
           /.box-header
           <div class="box-body">
             <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
         
             <p class="text-muted">
               B.S. in Computer Science from the University of Tennessee at Knoxville
             </p>
         
             <hr>
         
             <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
         
             <p class="text-muted">Malibu, California</p>
         
             <hr>
         
             <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
         
             <p>
               <span class="label label-danger">UI Design</span>
               <span class="label label-success">Coding</span>
               <span class="label label-info">Javascript</span>
               <span class="label label-warning">PHP</span>
               <span class="label label-primary">Node.js</span>
             </p>
         
             <hr>
         
             <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
         
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
           </div>
           /.box-body
         </div> -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
             <!--  <li ><a href="#activity" data-toggle="tab">Activity</a></li> -->
              <li class="active"><a href="#settings" data-toggle="tab">Profile</a></li>
              <li><a href="#timeline" data-toggle="tab">Change Password</a></li>
            </ul>
            <div class="tab-content">
             <!--  <div class="active tab-pane" id="activity">
               Post
               <div class="post">
                 <div class="user-block">
                   <img class="img-circle img-bordered-sm" src="<?= base_url();?>assets/dist/img/user1-128x128.jpg" alt="user image">
                       <span class="username">
                         <a href="#">Jonathan Burke Jr.</a>
                         <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                       </span>
                   <span class="description">Shared publicly - 7:30 PM today</span>
                 </div>
                 /.user-block
                 <p>
                   Lorem ipsum represents a long-held tradition for designers,
                   typographers and the like. Some people hate it and argue for
                   its demise, but others ignore the hate as they create awesome
                   tools to help create filler text for everyone from bacon lovers
                   to Charlie Sheen fans.
                 </p>
                 <ul class="list-inline">
                   <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                   <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                   </li>
                   <li class="pull-right">
                     <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                       (5)</a></li>
                 </ul>
             
                 <input class="form-control input-sm" type="text" placeholder="Type a comment">
               </div>
               /.post
             
               Post
               <div class="post clearfix">
                 <div class="user-block">
                   <img class="img-circle img-bordered-sm" src="<?= base_url();?>assets/dist/img/user7-128x128.jpg" alt="User Image">
                       <span class="username">
                         <a href="#">Sarah Ross</a>
                         <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                       </span>
                   <span class="description">Sent you a message - 3 days ago</span>
                 </div>
                 /.user-block
                 <p>
                   Lorem ipsum represents a long-held tradition for designers,
                   typographers and the like. Some people hate it and argue for
                   its demise, but others ignore the hate as they create awesome
                   tools to help create filler text for everyone from bacon lovers
                   to Charlie Sheen fans.
                 </p>
             
                 <form class="form-horizontal">
                   <div class="form-group margin-bottom-none">
                     <div class="col-sm-9">
                       <input class="form-control input-sm" placeholder="Response">
                     </div>
                     <div class="col-sm-3">
                       <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                     </div>
                   </div>
                 </form>
               </div>
               /.post
             
               Post
               <div class="post">
                 <div class="user-block">
                   <img class="img-circle img-bordered-sm" src="<?= base_url();?>assets/dist/img/user6-128x128.jpg" alt="User Image">
                       <span class="username">
                         <a href="#">Adam Jones</a>
                         <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                       </span>
                   <span class="description">Posted 5 photos - 5 days ago</span>
                 </div>
                 /.user-block
                 <div class="row margin-bottom">
                   <div class="col-sm-6">
                     <img class="img-responsive" src="<?= base_url();?>assets/dist/img/photo1.png" alt="Photo">
                   </div>
                   /.col
                   <div class="col-sm-6">
                     <div class="row">
                       <div class="col-sm-6">
                         <img class="img-responsive" src="<?= base_url();?>assets/dist/img/photo2.png" alt="Photo">
                         <br>
                         <img class="img-responsive" src="<?= base_url();?>assets/dist/img/photo3.jpg" alt="Photo">
                       </div>
                       /.col
                       <div class="col-sm-6">
                         <img class="img-responsive" src="<?= base_url();?>assets/dist/img/photo4.jpg" alt="Photo">
                         <br>
                         <img class="img-responsive" src="<?= base_url();?>assets/dist/img/photo1.png" alt="Photo">
                       </div>
                       /.col
                     </div>
                     /.row
                   </div>
                   /.col
                 </div>
                 /.row
             
                 <ul class="list-inline">
                   <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                   <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                   </li>
                   <li class="pull-right">
                     <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                       (5)</a></li>
                 </ul>
             
                 <input class="form-control input-sm" type="text" placeholder="Type a comment">
               </div>
               /.post
             </div> -->
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <form class="form-horizontal" method="post" action="<?= $actionPassword; ?>">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Old Password <span style="color:red">*</span></label>

                    <div class="col-sm-6">
                      <input type="password" class="form-control" id="oldPass" name="oldPass" placeholder="Old Password" required="" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">New Password <span style="color:red">*</span></label>

                    <div class="col-sm-6">
                      <input type="password" class="form-control" id="newPass" name="newPass" placeholder="New Password" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Confirm Password <span style="color:red">*</span></label>

                    <div class="col-sm-6">
                      <input type="password" class="form-control" id="confPass" name="confPass" placeholder="Confirm Password" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" method="POST" action="<?= $actionProfile; ?>" enctype="multipart/form-data" >
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name <span style="color:red">*</span></label>

                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="" value="<?=  $name; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email <span style="color:red">*</span></label>

                    <div class="col-sm-6">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="" value="<?=  $email; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Profile <span style="color:red">*</span></label>

                    <div class="col-sm-6">
                      <input type="file" class="form-control" id="image" name="image" >

                      <input type="hidden" class="form-control" name="old_image" value="<?= $profile ?>">
                      <img src="<?php echo $profilePhoto;?>">

                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('common/footer');?>