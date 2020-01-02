<?php  $this->load->view('common/header'); 
$this->load->view('common/left_panel'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?= $heading; ?>
      <small><!--advanced tables--></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
      <li class="active">  <?= $heading; ?></li>
    </ol>
  </section>
  <section class="content">
    <form action="<?php echo $actionUrl; ?>" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-lg-12">
        <div class="box box-primary">
          <div class="box-body">
           <div class="col-md-6">
                    <div class="form-group">
                      <label>Title <span class="red">*</span><span class="red" id="title_error"><?php echo form_error('title') ?></span></label>
                      <input type="text" class="form-control" name="title" id="title" value="<?php echo $title; ?>" placeholder="Title" <?php if($button =='Update'){ echo "readonly"; }?> oninput="convert_slug();">
                      <input type="hidden" name="slug" id="slug1" value="<?= $slug; ?>"  />
                      <span><b>Slug: </b></span><span id="slug"><?php echo $slug; ?></span><br>
                    </div>
                  </div>
                      <div class="col-md-6">
                    <div class="form-group">
                      <label>Image<span class="red" id="image_error"></span></label>
                       <input type="file" class="file-image" name="image" id="image">
                    <?php if($image!=''){ ?>
                      <img src="<?php echo base_url() ?>uploads/cms/<?php echo $image; ?>" height="50px" width="50px">
                    <?php } ?>
                    </div>
                  </div>
                    <div class="col-md-6">
                    <div class="form-group">
                      <label>Content <span class="red">*</span><span class="red" id="content_error"></span></label>
                      <textarea class="form-control" name="content" rows="4" id="content" placeholder="Content"><?php echo $content; ?></textarea>
                    </div>
                  </div>
                 
                   <div class="col-md-12">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                   <input type="hidden" name="old_image" value="<?php echo $image; ?>">
             <button type="submit" class="btn btn-info mr-2 btn-sm pull-right" onclick="return validation()"><?php echo $button ?></button>
                <a href="<?php echo site_url('Cms/index') ?>" class="btn btn-danger btn-sm">Cancel</a>
              </div>
          </div>
            </div>
       
      </div>
    </div>
    </form>
  </section>
</div>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/custom_js/cms.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/ckeditor/ckeditor.js"></script> 
<script type="text/javascript">
  CKEDITOR.replace('content');
</script>
