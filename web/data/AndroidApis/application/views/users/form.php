<style>
    textarea 
    {
        resize: none;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
      <div>&nbsp;<?php echo $heading; ?></div>
    </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Login/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('CategoryMaster/index'); ?>"><?= $heading;?></a></li>
            <li class="active">
                <?= $heading;?>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">

                        <div class="col-md-4">&nbsp;&nbsp;</div>
                        <div class="col-md-4"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="<?php echo $action; ?>" enctype="multipart/form-data">  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Full Name<span style="color:red;">*</span></label> <span style="color:red" id="name_err"> </span><?php echo form_error('name')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Full Name" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email<span style="color:red;">*</span></label> <span style="color:red" id="email_err"> </span><?php echo form_error('email')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <input type="text" placeholder="Email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile<span style="color:red;">*</span></label> <span style="color:red" id="mobile_err"> </span><?php echo form_error('mobile')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                    <input type="text" placeholder="Mobile" class="form-control" id="mobile" name="mobile" value="<?php echo $mobile; ?>" maxlength="10">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password<span style="color:red;">*</span></label> <span style="color:red" id="password_err"> </span><?php echo form_error('password')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                    <input type="password" placeholder="Password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                           
                             
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">Image
                                    <span style="color:red;">*</span> </label><span style="color:red" id="image_err"> </span><span style="color:red"><!-- < ?php echo form_error('company_logo')?> </span> -->
                                    <input type="file" placeholder="Category" class="form-control" id="image" name="image">
                                    <br>
                                    <?php if($button!='Create')
                                    {?>
                                        <img src="<?= base_url('uploads/users/'.$image);?>" width="80px">
                                        <input type="hidden" name="image_old" id="image_old" value="<?= $image; ?>">
                                    <?php }?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Product Category<span style="color:red;">*</span></label> <span style="color:red" id="pcat_err" > </span><?php echo form_error('pcate')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                     <!-- <input type="text" placeholder="" class="form-control" id="password" name="password" value="<?php echo $password; ?>"> -->
                                        <select class="form-control" id="pcate1" name="pcate">
                                            <option value="0">Select Category</option>
                                            <?php if(!empty($category)) 
                                            { 
                                                foreach ($category as $rows) 
                                                {      
                                                ?>
                                            <option value="<?= $rows->id;?>" <?php if($pcat==$rows->id) { echo "selected";}?> ><?= $rows->cat_name;?></option>
                                        <?php } }?>
                                        </select>

                                        <br>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Product<span style="color:red;">*</span></label> <span style="color:red" id="product_err" > </span><?php echo form_error('psubcate')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                     <!-- <input type="text" placeholder="" class="form-control" id="password" name="password" value="<?php echo $password; ?>"> -->
                                        <select class="form-control" id="psubcate1" name="psubcate">
                                            <option value="0">Select Product</option>
                                            <?php if(!empty($subcategory)) 
                                            { 
                                                foreach ($subcategory as $rows) 
                                                {      
                                                ?>
                                            <option value="<?= $rows->id;?>" <?php if($pid==$rows->id) { echo "selected";}?> ><?= $rows->subcat_name;?></option>
                                        <?php } }?>
                                        </select>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Amount <span style="color:red;"></span></label> <span style="color:red" > </span><?php echo form_error('pamt')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                    
                                        <input type="text" name="pamt" id="pamt" class="form-control" readonly>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Product Liter Type<span style="color:red;">*</span></label> <span style="color:red" > </span><?php echo form_error('psubcate')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                           <input type="text" placeholder="Enter Product Liters" class="form-control" id="pliter" name="pliter" value="<?php echo $pliter;?>" oninput="creat_type()"> 
                                                <!-- <select class="form-control" id="pliter" name="pliter">
                                                 
                                                    <option value="1" < ?php if($pliter== '1') { echo "selected";}?> >One Liter</option>
                                                    <option value="2" < ?php if($pliter== '2') { echo "selected";}?> >Half Liter</option>
                                                    
                                                </select> -->

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Total Amount <span style="color:red;"></span></label> <span style="color:red" > </span><?php echo form_error('pamt')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                    
                                        <input type="text" name="total_amt" id="total_amt" class="form-control" readonly value="<?php echo $total_amt;?>">


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                          
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Address / Location<span style="color:red;">*</span></label> <span style="color:red" id="location_err"> </span><?php echo form_error('location')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                      <input type="text" name="location" class="form-control black" placeholder="Choose Your Location" id="location" value="<?= $location;  ?>">
                                           <input type="hidden" name="lat"  id="lat" value="<?= $latitude; ?>" >
                                           <input type="hidden" name="lon"  id="lon" value="<?= $longitude; ?>" > 
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Employee Name<span style="color:red;">*</span></label> <span style="color:red" id="executive_id_err"> </span><?php echo form_error('executive_id')?>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                     <!-- <input type="text" placeholder="" class="form-control" id="password" name="password" value="< ?php echo $password; ?>"> -->
                                        <select class="form-control" id="executive_id" name="executive_id">
                                            <option value="0">Select Employee</option>
                                            <?php if(!empty($getexecutive)) 
                                            { 
                                                foreach ($getexecutive as $executive) 
                                                {      
                                                ?>
                                            <option value="<?= $executive->id;?>" <?php if($executive_id==$executive->id) { echo "selected";}?> ><?= $executive->name;?></option>
                                        <?php } }?>
                                        </select>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10" id="map" style="height:200px;">
                            
                            <br>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div>
                                        <input type="hidden" id="button" value="<?= $button; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        
                                        <button class="btn btn-primary pull-right" type="submit" onclick="return check_error()">
                                            <?php echo $button; ?>
                                        </button>


                                        <a href="<?php echo site_url('Users/index') ?>" class="btn btn-danger" type="button">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    setTimeout(function() {
        $(".errid").fadeOut();
    }, 3000);
</script>
<script type="text/javascript">
     function creat_type()
      {
       var amt =$('#pamt').val();
        var littertype =  $('#pliter').val();
       var amount= Math.round(littertype*amt);
       $('#total_amt').val(amount);
      }
</script>
<script type="text/javascript">
    function check_error() 
    {   
        var name = $("#name").val().trim();
        var email = $("#email").val().trim();


        // var IndNum = /^[789][0-9]{9}$/;
        var mobile = $("#mobile").val().trim();
        var mob_length = mobile.length;
        var first = mobile.substring(0,1);



        var password = $("#password").val().trim();
        // var business_type = $("#business_type").val().trim();
        var image = $("#image").val().trim();


        
        var pcate = $("#pcate1").val().trim();


        var product = $("#psubcate1").val().trim();
        // var pliter = $("#pliter").val().trim();


        // var shop_image = $("#shop_image").val().trim();
        var button = $("#button").val().trim();
        var location = $("#location").val().trim();
        var executive_id = $("#executive_id").val();


        



        // alert("Heelo");
        if(name== "") 
        {
            $("#name_err").fadeIn().html("Please enter Name");
            setTimeout(function() 
            {
                $("#name_err").fadeOut();
            }, 3000);
            $("#name").focus();
            return false;
        }
         if(email=="") 
        {
            $("#email_err").fadeIn().html("Please enter Email");
            setTimeout(function() 
            {
                $("#email_err").fadeOut();
            }, 3000);
            $("#email").focus();
            return false;
        }
        if(mobile== "") 
        {
            $("#mobile_err").fadeIn().html("Please enter Mobile No");
            setTimeout(function() 
            {
                $("#mobile_err").fadeOut();
            }, 3000);
            $("#mobile").focus();
            return false;
        }
        if(mob_length != 10)
        {
            $("#mobile_err").fadeIn().html("Please enter 10 Digit Mobile No");
            setTimeout(function() 
            {
                $("#mobile_err").fadeOut();
            }, 3000);
            $("#mobile").focus();
            return false;
        }
       /* else if(mobile.charAt(0) != "9"  && mobile.charAt(0) != "8" && mobile.charAt(0) != "7") 
        {
            $("#mobile_err").fadeIn().html("Please enter Valid Mobile No");
            setTimeout(function() 
            {
                $("#mobile_err").fadeOut();
            }, 3000);
            $("#mobile").focus();
            return false;
        }*/
        if(password== "") 
        {
            $("#password_err").fadeIn().html("Please enter Password");
            setTimeout(function() 
            {
                $("#password_err").fadeOut();
            }, 3000);
            $("#password").focus();
            return false;
        } 
       

         
        // if(business_type== "") 
        // {
        //     $("#business_type_err").fadeIn().html("Please select business type");
        //     setTimeout(function() 
        //     {
        //         $("#business_type_err").fadeOut();
        //     }, 3000);
        //     $("#business_type").focus();
        //     return false;
        // }
        
        if(button=='Create')
        {
            if(image=="") 
            {
                $("#image_err").fadeIn().html("Please Select Image");
               setTimeout(function() 
                {
                    $("#image_err").fadeOut();
                }, 3000);
                $("#image").focus();
                return false;
            }
            //  if(shop_image=="") 
            // {
            //     $("#shop_image_err").fadeIn().html("Please Select Shop Image");
            //    setTimeout(function() 
            //     {
            //         $("#shop_image_err").fadeOut();
            //     }, 3000);
            //     $("#shop_image").focus();
            //     return false;
            // }
            

        }

         if(pcate== "0") 
        {
            $("#pcat_err").fadeIn().html("Please Select Product Category");
            setTimeout(function() 
            {
                $("#pcat_err").fadeOut();
            }, 3000);
            $("#pcate").focus();
            return false;
        }

        if(product== "0") 
        {
            $("#product_err").fadeIn().html("Please Select Product Category");
            setTimeout(function() 
            {
                $("#product_err").fadeOut();
            }, 3000);
            $("#psubcate1").focus();
            return false;
        }
        if(location== "") 
        {
            $("#location_err").fadeIn().html("Please enter Location");
            setTimeout(function() 
            {
                $("#location_err").fadeOut();
            }, 3000);
            $("#location").focus();
            return false;
        }
         if(executive_id== "0") 
        {
            $("#executive_id_err").fadeIn().html("Please select Executive");
            setTimeout(function() 
            {
                $("#executive_id_err").fadeOut();
            }, 3000);
            $("#executive_id").focus();
            return false;
        }



        }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCMtDBsl6HlxFbLb4vlt1qWfPAAnfpF0hw&libraries=places&callback=initialize"
  type="text/javascript">
</script>
<script>

    var url="";
    var actioncolumn ="";

  /* for google locations autocomplete */
function initialize() 
{
    var input = document.getElementById('location');
    autocomplete = new google.maps.places.Autocomplete(input);
    google.maps.event.addListener(autocomplete, 'place_changed', function() 
    {
      var place = autocomplete.getPlace();
      var lat = place.geometry.location.lat();
      var lng = place.geometry.location.lng();
      $("#lat").val(lat);
      $("#lon").val(lng);
      initMap();
        if (!place.geometry) {
            //try a basic geocode
            searchlocation(place.name);
            return;
        }

    });
    // Set initial restrict to the greater list of countries.
        autocomplete.setComponentRestrictions(
            {'country': ['in']});

    function setupClickListener(id, countries) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setComponentRestrictions({'country': countries});
          });
        }

}
 function initMap() 
 {
    var lat = parseFloat(document.getElementById('lat').value);
    var lng = parseFloat(document.getElementById('lon').value);

    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: lat,
            lng: lng
        },
        zoom: 13,
        mapTypeId: 'roadmap'
    });
     var latlng = new google.maps.LatLng(lat,lng);
         var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
     
   });

    google.maps.event.addListener(marker, 'dragend', function (event) {
    document.getElementById("lat").value = this.getPosition().lat();
    document.getElementById("lon").value = this.getPosition().lng();
    getAddress();
  });
}
function getAddress()
{
   var lat=$("#lat").val();
   var lon=$("#lon").val();

    $.ajax({
            type:"post",
            cache:false,
            url:"<?php echo site_url(); ?>/Users/getAddress",
            data:{lat:lat,lon:lon},
            beforeSend:function(){},
            success:function(returndata)
            {   
              var obj=jQuery.parseJSON(returndata);
               $("#location").val(obj.address);
            }
        });
}



</script>




