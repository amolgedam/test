<style>
  .rotate90 {
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
}
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
          <?php echo $heading;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Welcome/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
       <li class="active"> <?php echo $heading;?></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
          
            <div>&nbsp;</div> 
            <div class="col-lg-12">
              <div class="panel panel-default">
              <div class="panel-heading"><h4>View<a href="<?= site_url('Employees');?>"><button type="button"  class="btn btn-primary pull-right">Back</button></a></h4></div>
              <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Employees Name:</label>
                      <p><?php if(!empty($Getcustomerdata->name)) { echo $Getcustomerdata->name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Employees Email:</label>
                      <p><?php if(!empty($Getcustomerdata->email)) { echo $Getcustomerdata->email;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <div class="col-md-4">
                   <div class="form-group">
                      <label for="title">Personal Employees Email:</label>
                      <p><?php if(!empty($Getcustomerdata->personal_email)) { echo $Getcustomerdata->personal_email;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Password:</label>
                      <p><?php if(!empty($Getcustomerdata->show_password)) { echo $Getcustomerdata->show_password;}else {echo "N/A";}?></p>
                    </div>
                </div>
               
             <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Mobile No:</label>
                      <p><?php if(!empty($Getcustomerdata->mobile_no)) { echo $Getcustomerdata->mobile_no;}else {echo "N/A";} ?></p>
                    </div>
                </div>

                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Joining Date:</label>
                      <p><?php if(!empty($Getcustomerdata->joining_date)) { echo $Getcustomerdata->joining_date;}else {echo "N/A";} ?></p>
                    </div>
                </div>
                
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Designation name:</label>
                      <p><?php if(!empty($Getcustomerdata->designation_name)) { echo $Getcustomerdata->designation_name;}else {echo "N/A";}?></p>
                    </div>
                </div>    
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">State Name :</label>
                      <p><?php if(!empty($Getcustomerdata->state_name)) { echo $Getcustomerdata->state_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">City name:</label>
                      <p><?php if(!empty($Getcustomerdata->city_name)) { echo $Getcustomerdata->city_name;}else {echo "N/A";}?></p>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Address :</label>
                      <p><?php if(!empty($Getcustomerdata->address)) { echo $Getcustomerdata->address;}else {echo "N/A";} ?>,
                     <?php if(!empty($Getcustomerdata->pincode)) { echo $Getcustomerdata->pincode;}else {echo "N/A";} ?></p>
                    </div>
                </div> 
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Salary</label>
                      <p><?php if(!empty($Getcustomerdata->salary)) { echo $Getcustomerdata->salary;}else {echo "N/A";} ?></p>
                    </div>
                </div> 
                  
               <!--  <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">State name</label>
                      <p><?php if(!empty($Getcustomerdata->state_name)) { echo $Getcustomerdata->state_name;}else {echo "N/A";} ?></p>
                    </div>
                </div>     -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Date Of Birth</label>
                      <p><?php if(!empty($Getcustomerdata->birthday)) { echo $Getcustomerdata->birthday;}else {echo "N/A";} ?></p>
                    </div>
                </div> 
                 
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Bank Name</label>
                      <p><?php if(!empty($Getcustomerdata->bank_name)) { echo $Getcustomerdata->bank_name;}else {echo "N/A";} ?></p>
                    </div>
                </div> 
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">IFSC Code</label>
                      <p><?php if(!empty($Getcustomerdata->ifsc)) { echo $Getcustomerdata->ifsc;}else {echo "N/A";} ?></p>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Account</label>
                      <p><?php if(!empty($Getcustomerdata->account)) { echo $Getcustomerdata->account;}else {echo "N/A";} ?></p>
                    </div>
                </div> 
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Candidate Type</label>
                      <p><?php if(!empty($Getcustomerdata->candidate_type)) { echo $Getcustomerdata->candidate_type;}else {echo "N/A";} ?></p>
                    </div>
                </div> 
                
                <?php if($Getcustomerdata->candidate_type=='experience') {?>
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Final Year Mark sheet</label><br>
                      <?php if(!empty($Getcustomerdata->final)) { ?>
                              <img src="<?php echo base_url('uploads/document/'.$Getcustomerdata->final);?>" style="height:100px;width:100px;" id="myImg">
                            <?php } else{ echo "N/A";} ?>
                    </div>
                </div> 
                    <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Final Year Degree</label><br>
                      <?php if(!empty($Getcustomerdata->degree)) { ?>
                              <img src="<?php echo base_url('uploads/document/'.$Getcustomerdata->degree);?>" style="height:100px;width:100px;" id="myImg1">
                            <?php } else{ echo "N/A";} ?>
                    </div>
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Adhar Card</label><br>
                      <?php if(!empty($Getcustomerdata->adhar)) { ?>
                              <img src="<?php echo base_url('uploads/document/'.$Getcustomerdata->adhar);?>" style="height:100px;width:100px;" id="myImg2">
                            <?php } else{ echo "N/A";} ?>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Pan Card</label><br>
                      <?php if(!empty($Getcustomerdata->pan)) { ?>
                              <img src="<?php echo base_url('uploads/document/'.$Getcustomerdata->pan);?>" style="height:100px;width:100px;" id="myImg3">
                            <?php } else{ echo "N/A";} ?>
                    </div>
                </div> 
            
                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Relieving Certificate</label><br>
                     <?php if(!empty($Getcustomerdata->relieving_cer)) { ?>
                              <img src="<?php echo base_url('uploads/document/'.$Getcustomerdata->relieving_cer);?>" style="height:100px;width:100px;" id="myImg4">
                        <?php } else{ echo "N/A";}?>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Payment Slip</label><br>
                     <?php if(!empty($Getcustomerdata->payment_slip)) { ?>
                              <img src="<?php echo base_url('uploads/document/'.$Getcustomerdata->payment_slip);?>" style="height:100px;width:100px;" id="myImg5">
                        <?php } else{ echo "N/A";}?>
                    </div>
                </div>
              <?php } else if($Getcustomerdata->candidate_type=='fresher') {?>
               <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Final Marksheet Fresher</label><br>
                     <?php if(!empty($Getcustomerdata->final_marksheet)) { ?>
                              <img src="<?php echo base_url('uploads/document/'.$Getcustomerdata->final_marksheet);?>" style="height:100px;width:100px;" id="myImg6">
                        <?php } else{ echo "N/A";}?>
                    </div>
                </div>
               <div class="col-md-4">
                    <div class="form-group">
                      <label for="title">Final Degree Fresher</label><br>
                     <?php if(!empty($Getcustomerdata->final_degree)) { ?>
                              <img src="<?php echo base_url('uploads/document/'.$Getcustomerdata->final_degree);?>" style="height:100px;width:100px;" id="myImg7">
                        <?php } else{ echo "N/A";}?>
                    </div>
                </div>   
               <div class="col-md-4">
                    <div class="form-group">
                      <label for="title"> Fresher Adhar Card</label><br>
                     <?php if(!empty($Getcustomerdata->final_adhar)) { ?>
                              <img src="<?php echo base_url('uploads/document/'.$Getcustomerdata->final_adhar);?>" style="height:100px;width:100px;" id="myImg8">
                        <?php } else{ echo "N/A";}?>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="title"> Fresher Pan Card</label><br>
                     <?php if(!empty($Getcustomerdata->final_pan)) { ?>
                              <img src="<?php echo base_url('uploads/document/'.$Getcustomerdata->final_pan);?>" style="height:100px;width:100px;" id="myImg9">
                        <?php } else{ echo "N/A";}?>
                    </div>
                </div> 
                <?php } ?> 
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
     
<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg1");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg2");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg3");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg4");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg5");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg6");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg7");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg8");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg9");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>