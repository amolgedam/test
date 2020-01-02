
<!-- <div class="content-wrapper">
    <section class="content-header">
      <h1>
         Jar Distribution Customer Wise View
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active">Certificates View</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div>
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Certificates');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body"> -->
                 
              <!-- <body> -->
                <center>
  <table  cellpadding="5px" cellspacing="10px" style="border:1px solid black;" width="850px;">
  <tr>
    <?php if(!empty($logo)) {?>
      <td><img src="<?php echo base_url('uploads/logo/'.$logo) ?>" style="width:300px;height:200px;"></td>
    <?php }?>
      <td style="padding:0px;margin:0px;">
        <table style="padding:0px;margin:0px;" width="608px;" cellspacing="10px">
          <tr>
            <td >
              <address style="float:right;"><?php if(!empty($address)){ echo $address;}?>
              </address> 
            </td>
          </tr>
            <tr>
            <td>
                  <span style="float:right;"><b>M: -<?php if(!empty($mobile)){ echo $mobile.','.$alternate_mobile;}?></b></span>
            </td>
          </tr>
            <tr>
            <td>
                <span style="float:right ;color:blue;">E-mail: -<?php if(!empty($email)){ echo $email;}?></span>
            </td>
          </tr>
          <tr>
            <td>
              <span style="float:right;color:blue;"> Website:-<?php if(!empty($website)){ echo $website;}?></span>
            </td>
          </tr>

        </table>
          
      </td>
       <tr>
        <td colspan="2">
          <div ><hr style="color:blue;"></div>
        </td>
      </tr>
       <td colspan="2">
        <center><h1 style="color:blue;"><u><?php if(!empty($title)) { 
          echo ucfirst($title);  } ?>
        <u/></h1></center>
       
         <br><br> <br><br>
        
      
  </td>



     
      <tr>
        <td>
         
            <p>Dear <?php if(!empty($name)){ echo ucfirst($name);}?>,</p>
          
        </td>
       
      </tr>
<td colspan="2">
        <!-- <p style="margin-left: 20px; ">
With reference to your resignation dated 09/01/2018, we hereby accept your resignation and agree to relieve you from the duties on 31st January 2018. We confirm that you are working with World Planet e Solutions Pvt Ltd from 16th August 2017 as a Android Developer in our development team. 
.</p> -->
<p style="margin-left: 20px; text-align:justify;"> <?php if(!empty($description)){ echo $description;}?></p>

       
</td>
<tr>
        <td colspan="2">
<br><br><br><br>
 <span><b>Yours Faithfully</b>
            <p><b>Managing Director</b></p>
          </span>

  </tr>
<br><br><br><br>
<tr>
  <td colspan="2">
    <hr>
     <center  style="background-color: #00264d; color: white;padding: 15px; ">

<strong> Head Office:</strong> 
         <?php if(!empty($head_office)){ echo $head_office;}?> 
</center>

        </td>
      </tr>

  </tr>
</table>
</center>
                
                 
                
                 
                
                
                      
                      
                     
                        
               <!--  </div>  end panel 
            </div>
        </div>
      </div>
    </div>
  </section>
</div> -->
     
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>