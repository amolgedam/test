 <?php $settings = $this->Crud_model->GetData('settings','','','','','','1');?>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong><a href="http://www.worldplanetesolution.com/"><?php echo $settings->copyright;?></a>.</strong> All rights
    reserved <!--<?php if(empty($checkAttendence)){?><span onclick="makeattendence()">.</span> <?php } ?>-->.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <!-- <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li> -->
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->
<input type="hidden" name="site_url" id="site_url" value="<?= site_url(); ?>">
<!-- jQuery 3 -->
<!-- <script src="<?= base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url()?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<!-- <script src="<?= base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url(); ?>assets/dist/js/pages/dashboard2.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>assets/dist/js/demo.js"></script>

<script src="<?= base_url()?>assets/js/ckeditor/ckeditor.js"></script>
<!-- page script -->
<script>
  /*$(function () {
    $('#example1').DataTable()
  })*/

</script>
<script src="<?= base_url();?>/assets/notify/notify.min.js"></script>
<script type="text/javascript">
  // alert();
        $(document).ready(function(){
      var sessionMessage = '<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>';
      //alert(notifi);
      if(sessionMessage==null || sessionMessage=="" ){ return false;}
      $.notify(sessionMessage,{ position:"top center",className: 'success' });//session msg
        });

    
    </script>
 <script>
$(document).ready(function(){
      //alert("hi");
    $("#id_search2").keyup(function(){
 
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(), count = 0;
 
        // Loop through the comment list
        $(".sidebar-menu li").each(function(){
 
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
                count++;
            }
        });
 
        // Update the count
        var numberItems = count;
        //$("#filter-count").text("Number of Comments = "+count);
    });
});
</script>
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url()?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url()?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url(); ?>assets/select2/select2.js"></script>
<?php 
$controller = $this->uri->segment(1);
$function = $this->uri->segment(2);
$value = $this->uri->segment(3);
if(!empty($controller)){

  if($controller == "Quotation")
  {
    $show = "show";
    $len = 10;
  }
  }else{
    $len = 10;
    $show = "";
    } ?>
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {

  $(".msghide").fadeOut(8000);
  
    table = $('.example_datatable').DataTable({ 
         "oLanguage": {
         "sProcessing": "<img src='<?= base_url()?>assets/server_side/media/images/ajax-loader.gif'>" 
    },
    
        //"scrollX":true,
         //"scrollX":false,
        "stateSave": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "lengthMenu" : [[10,25, 100,200,500,1000,2000], [10,25, 100,200,500,1000,2000 ]],"pageLength" : 10,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": url,
            "type": "POST",
       "data": function(d) {
                    d.Foo = 'gmm';
                     d.select_all = $(".select_all").is(":checked");
                    d.SearchData = $(".filter_search_data").val();
                    d.SearchData1 = $(".filter_search_data1").val();
                    d.SearchData2 = $(".filter_search_data2").val();
                    d.SearchData3 = $(".filter_search_data3").val();
                    d.SearchData4 = $(".filter_search_data4").val();
                    d.SearchData5 = $(".filter_search_data5").val();
                    d.SearchData6 = $(".filter_search_data6").val();
                    d.SearchData7 = $(".filter_search_data7").val();
                    d.SearchData8 = $(".filter_search_data8").val();
                    d.SearchData9 = $(".filter_search_data9").val();
                    d.SearchData10 = $(".filter_search_data10").val();
                    d.FormData = $(".filter_data_form").serializeArray();
                }
                 
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ actioncolumn ], //first column / numbering column
            "orderable": false, //set not orderable

        },
        ],
         <?php if(!empty($show)){ ?>
                    "fnDrawCallback": function() {
                    var api = this.api()
                    var json = api.ajax.json();
                    $(".append_ids").val(json.ids);
                    // uni_array(); 
                 },
          <?php } ?> 
    });
    
    $(".filter_search_data4").change(function(){
                     table
                    .draw();
  
    });
    $(".filter_search_data5").change(function(){
                     table
                    .draw();
  
    });
    $(".filter_search_data6").change(function(){
                     table
                    .draw();
  
    });
    $(".filter_search_data7").change(function(){
                     table
                    .draw();
  
    });
    $(".filter_search_data8").change(function(){
                     table
                    .draw();
  
    });
    $(".filter_search_data9").change(function(){
                     table
                    .draw();
  
    });
    $(".filter_search_data10").change(function(){
                     table
                    .draw();
  
    });

 });
 
function imageFile()
  {  
  // alert("hi");
    $('#image').change(function () {  
    var files = this.files;   
    var reader = new FileReader();
    name=this.value;    
    //validation for photo upload type    
    var filetype = name.split(".");
    ext = filetype[filetype.length-1];  //alert(ext);return false;
    if(!(ext=='jpg') && !(ext=='png') && !(ext=='PNG') && !(ext=='jpeg') && !(ext=='img') && !(ext=='JPEG'))
    {   
        $("#image_err").html("Please select proper type like jpg, png, jpeg image");     
        setTimeout(function(){$("#image_err").html("&nbsp;")},8000);
        $("#image").val("");
    return false;
    }
    reader.readAsDataURL(files[0]);
    });
  }
  //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
    $( ".dob" ).datepicker({
      defaultDate: "today",
       endDate: 'today',
     format: 'yyyy-mm-dd',
       minDate:0,
       endDate: "today",
       changeMonth: true,
        changeYear: true,
        autoclose: true
    });
    $( ".datepick" ).datepicker({
       /*endDate: 'today',*/
     format: 'yyyy-mm-dd',
      minDate: 'today',
      /* endDate: "today",*/
       changeMonth: true,
        changeYear: true,
        autoclose: true
    });
   
    $(document).ready(function(){
     // $('.preloader').fadeOut('fast');
      $('.select2').select2();
       // rate_live();
       var dob_n =$("#dob").val();
       
       if (dob_n!="0000:00:00" && dob_n!=undefined) {
       // alert(dob_n);
        ageCalculator(dob_n); 
       }else{
       }
       //changeLiveRateAlert(id);
        //$(".select2-container").css("vertical-align", "none");
    });
     /*$(function () {
      CKEDITOR.replace('editor1');
  });*/
   $('.dateee').datepicker({
  multidate: true,
  format: 'dd-mm-yyyy',
  multidate:3,
  closeOnDateSelect:true
});
</script>
</body>
</html>