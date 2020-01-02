<?php 
  $this->load->view('common/header'); 
  $this->load->view('common/left_panel');
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?= $title1; ?>
          </h1>
          <?= $breadcrum; ?>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                 <!--  <h3 class="box-title"><?= $title1; ?></h3> -->
          <?php if(isset($_SESSION['ERROR'])){?>
          <div class="required" id="session-message"><?= $_SESSION['ERROR']; unset($_SESSION['ERROR']); ?></div>
          <?php } ?>
          <div class="required" id="error_msg">&nbsp;</div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data" action="<?= $action ?>"  onSubmit="return getvalidation(); ">
                  <div class="box-body">

                     <div class="col-md-6">
                    <div class="form-group">
                      <label for="title">Title <span style="color:red">*</span></label>&nbsp;<span id="title_err" ></span>
                      <input type="text" id="title" name="title" placeholder="Title" class="form-control" value="<?php echo $title;?>">
                    </div>
                    </div>


                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="user_id">Subject <span  style="color:red">*</span></label>&nbsp;<span id="subject_err" ></span>
                      <input type="text" id="subject" class="form-control" name="subject" value="<?php echo $subject ?>" placeholder="Subject" >
                    </div>
                    </div>
                   

                     <div class="col-md-6">
                        <div class="form-group" id="description_menu">
                           <label for="editor1">Description <span class="required" style="color:red">*</span></label>&nbsp;<span id="editor1_err" class="required"></span>
                           <textarea id="editor1" name="description" placeholder="Description" class="form-control mytext"><?php echo $description; ?></textarea>
                        </div>
                     </div>
                    

                   
                  </div>
                  <!-- <input type="hidden" name="testi_type" id="testi_type" value="<?php echo $type; ?>"> -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="Create" ><?= $button ?></button>
                   <a href="<?= site_url('Email');?>"><button type="button"  class="btn btn-danger">Cancel</button></a>
                      <input type="hidden" name="id" id="id" value="<?= $id?>">          
                  </div>
                </form>
              </div><!-- /.box -->

            </div>
          </div>
        </section>
      </div><!-- /.content-wrapper -->
      <script>
var url='';
var actioncolumn='';
var  pageLength='';
</script>
<?php 
  $this->load->view('common/footer'); 
?>

 <script>
    $(function () {
     CKEDITOR.replace('editor1');
   });
</script>




<script>
/*$(function () {
  CKEDITOR.replace('editor1');
});*/

/*$(function () {
  CKEDITOR.replace('editor1',{
            uiColor:'#2778a7', 
            toolbar:toolbar_custom,
            autoParagraph:false,
            enterMode:CKEDITOR.ENTER_DIV,
            allowedContent:true,
            extraAllowedContent:'*{*}'
        })
});*/

/*jQuery(function(){
        CKEDITOR.replace('editor1',{
            uiColor:'#2778a7', 
            toolbar:toolbar_custom,
            autoParagraph:false,
            enterMode:CKEDITOR.ENTER_DIV,
            allowedContent:true,
            extraAllowedContent:'*{*}'
        })
    });*/

</script>
<script>
function getvalidation()
{
  var title = $("#title").val();
 // alert(title);
  var subject = $("#subject").val();
  //var description = CKEDITOR.instances.editor1.getData();
   var editor1 = CKEDITOR.instances.editor1.getData();

    if(title.trim() =="")
    {
      //alert('hiii');
        $("#title_err").fadeIn().html("Please enter title").css('color','red');
        setTimeout(function(){$("#title_err").html("&nbsp;");},3000);
        $("#title").focus();
        return false;
    }

     if(subject.trim() =="")
    {
        $("#subject_err").fadeIn().html("Please enter subject").css('color','red');
        setTimeout(function(){$("#subject_err").html("&nbsp;");},3000);
        $("#subject").focus();
        return false;
    }

   /* if(description.trim() =="")
    {
        $("#description_err").fadeIn().html("Please enter description").css('color','red');
        setTimeout(function(){$("#description_err").html("&nbsp;");},3000);
        $("#editor1").focus();
        return false;
    }*/

      if(editor1.trim()=="")
         {
             $("#editor1_err").fadeIn().html("Please enter description").css('color','red');
             setTimeout(function(){$("#editor1_err").html("&nbsp;");},5000);
             $("#editor1").focus();
             return false;
         }
    
    
  }

</script>