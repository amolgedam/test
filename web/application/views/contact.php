<?php $this->load->view('common/header.php');?>
<div class="page-header" id="home">
        <div class="header-caption">
            <div class="header-caption-contant">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="header-caption-inner">
                                <p><a href="<?php echo site_url('Welcome/index'); ?>">Home </a> >
                                </p><br><br>
                                <h1>Contact Us</h1>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="contact-area inner-padding6">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <div class="form-area-row foo" data-sr='enter'>
                        <div class="form-area-title">
                            <h2>Get In Touch <span style="color: red;">With Us</span></h2>
                           <?php echo $this->session->flashdata('message');?>
                        </div>
                        <div class="form-area">
                            <div class="cf-msg"></div>
                            <form action="<?php echo site_url('Welcome/contact_action') ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <ul class="contact-form">
                                        <li class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label>First Name<span style="color:red;">* </span><span style="color:red" id="name_error"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" id="name" name="name"  class="form-control" placeholder="Write First name">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Last Name<span style="color:red;">* </span><span style="color:red" id="last_name_error"> </span></label>
                                                
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </li>

                                        <li class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Your Email id<span style="color:red;">* </span><span style="color:red" id="email_error"> </span></label>
                                                
                                                
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Write Your email id">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Please Tell Us More<span style="color:red;">* </span><span style="color:red" id="tell_me_error"> </span></label>
                                                
                                                <div class="input-group">
                                                    <textarea class="form-control" col="3" id="tell_me" name="tell_me" placeholder="Ex: What Can we Do your You?"></textarea>
                                                    
                                                </div>
                                            </div>
                                        </li>
                                         
                                       
                                        
                                       
                                    </ul>
                                    <div class="col-xs-12 text-center">
                                        <button type="submit" class="btn btn-default btn-form" onclick="return validation()">SUBMIT</button>
                                    </div>
                                    
                                </div>
                                <h2 style="color: red;">Contact Emails:</h2>
                                <a href="#" style="color: black;">contact@worldplanetesolution.com</a><br>
                               <a href="#" style="color: black;"> hrd@worldplanetesolution.com</a><br>
                                <a href="#" style="color: black;">info@worldplanetesolution.com</a><br>
                                <a href="#" style="color: black;">marketing@worldplanetesolution.com</a>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="container margintop-130">
    <div class="row">   
        
         <div class="col-sm-12 col-md-4 col-lg-4 frame-padding"> 
           <div class="span8">
           <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3767.606621545473!2d72.8704515!3d19.2123766!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b73798cfffff%3A0x3b8b6f4f2716f59a!2sWorld+Planet+E+Solutions+Pvt.+Ltd!5e0!3m2!1sen!2sin!4v1565264229420!5m2!1sen!2sin"frameborder="0" style="border:0;width:100%;"  allowfullscreen></iframe>
        </div>
        
        <div class="span4">
            <h2>India (Mumbai)</h2>
            <address>
               <b>HEAD OFFICE</b><br>
                A/2AViccroy court, <br>
               Opp. Dominos Pizza,<br>
              Thakur Village, Kandiwali ,<br>
               (E)Mumbai-400101<br> 
                
                <abbr title="Phone">Phone No:</abbr>  +91 9821304242</br>
                <abbr title="Phone">Phone No:</abbr>  +91 8169527971 
            </address>
        </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 frame-padding"> 
 <div class="span8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3539.018750936467!2d153.0431111!3d-27.4997923!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd839aa8a2f2708c3!2sBrow+Mantra!5e0!3m2!1sen!2sin!4v1565261817662!5m2!1sen!2sin"  frameborder="0"style="border:0;width:100%;"  allowfullscreen></iframe>
        </div>
        
        <div class="span4">
             <h2>Australia</h2>
            <address>
                <b>Branch</b><br>
               
                2/380 Logan Road,Stones<br>
                Corner,Greenslopes<br>
                Australia,QLD-4120<br>
                
                
                <abbr title="Phone">Phone No:</abbr>  +61-408035994
            </address>
        </div>
        </div>
         <div class="col-sm-12 col-md-4 col-lg-4 frame-padding"> 
           <div class="span8">
           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.988476592727!2d79.05203151493407!3d21.113025585952776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4bf85e417f2eb%3A0x4976a6146b49d2af!2sShubh+Shagun+Apartment%2C+Ring+Rd%2C+Khamla%2C+Nagpur%2C+Maharashtra+440022!5e0!3m2!1sen!2sin!4v1565263993515!5m2!1sen!2sin" frameborder="0"style="border:0;width:100%;" allowfullscreen></iframe>
        </div>
        
        <div class="span4">
            <h2>India(Nagpur)</h2>
            <address>
               <b>Branch</b><br>
                Plot no -177, <br>
              Shubh-Shagun ,<br>
              Appartment vidyha-Vihar  ,<br>
              Pratap Nagar<br>
              Ring Road,<br>
               Nagpur-440024<br> 
                
                <abbr title="Phone">Phone No:</abbr>  +91-7387065009 </br>
               
            </address>
        </div>
        </div>

    </div>
    <div class="row">   
        <div class="col-sm-12 col-md-4 col-lg-4 frame-padding"> 
 <div class="span8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1943.5987838651224!2d77.556018688693!3d13.023087254293053!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3d635d3a392f%3A0xc50dcbf51eb617ba!2s5th+Cross+Rd+%26+Mathikere+Main+Rd%2C+Kamla+Nehru.+Extension%2C+Yeswanthpur%2C+Bengaluru%2C+Karnataka+560022!5e0!3m2!1sen!2sin!4v1565264523461!5m2!1sen!2sin"frameborder="0" style="border:0;width:100%;"  allowfullscreen></iframe>
        </div>
        
        <div class="span4">
            <h2>India (Bangalore)</h2>
            <address>
               <b>Branch</b><br>
               No329 Mainjaly house, <br>
             5th cross,<br>
              1st main gokula,1st stage 2nd phase,<br>
              Yesvanthpur, Bangalore-560022<br>
             
                
                <abbr title="Phone">Phone No:</abbr>  +91 9821304242 </br>
                 <abbr title="Phone">Phone No:</abbr>  +91 8169527971 </br>
               
            </address>
        </div>
        </div>
         <div class="col-sm-12 col-md-4 col-lg-4 frame-padding"> 
           <div class="span8">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d242123.99562960572!2d73.8567437!3d18.5204303!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2bf12d5676ddb%3A0x5d005730bd9c62a!2sWorld+Planet+E+Solutions+Pvt.+Ltd.!5e0!3m2!1sen!2sin!4v1565264585056!5m2!1sen!2sin"frameborder="0" style="border:0;width:100%;"  allowfullscreen></iframe>
        </div>
        
        <div class="span4">
            <h2>India(Pune)</h2>
            <address>
               <b>Branch</b><br>
                Gate No.3,Abhimanshree<br>
                Society,Behind<br>
               Volkaswagan Showroom,<br>
               University Pashan Road,<br>
               Pashan Pune, 411008<br>
                <abbr title="Phone">Phone No:</abbr> +91 9890050987 
            </address>
        </div>
        </div>
         <div class="col-sm-12 col-md-4 col-lg-4 frame-padding"> 
           <div class="span8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3749.6295442453243!2d73.8006736143346!3d19.982075886574595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bddebcebc84211b%3A0x4b8f5e8f30c8cf26!2ssiddhamuni+apartments!5e0!3m2!1sen!2sin!4v1565265565998!5m2!1sen!2sin" frameborder="0"style="border:0;width:100%;"  allowfullscreen></iframe>
        </div>
        
        <div class="span4">
            <h2>India(Nashik)</h2>
            <address>
                <b>Branch</b><br>
                Siddhamuni -A<br>
                Ganeshbaba Ngr<br>
                B/H Hotel Kamat's Siddarth<br>
                Opp. Suvichar Hospital<br>
                Off Pune Road<br>
                Nashik-422011<br>
                <abbr title="Phone">Phone No:</abbr>9665165685
            </address>
        </div>
        </div>

    </div>
    <div class="row">   
        <div class="col-sm-12 col-md-4 col-lg-4 frame-padding"> 
            <div class="span8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.599683365527!2d72.85881751432137!3d19.29976728695993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b030502f91a3%3A0x53bd754fa95523e5!2sVardhaman+Complex%2C+Endar+Rd%2C+Bhayandar%2C+Sonam+Sagar%2C+Indira+Nagar%2C+Bhayandar+East%2C+Mira+Bhayandar%2C+Maharashtra+401105!5e0!3m2!1sen!2sin!4v1565267517124!5m2!1sen!2sin"frameborder="0" style="border:0;width:100%;"  allowfullscreen></iframe>
        </div>
        
        <div class="span4">
            <h2>India (Mumbai)</h2>
            <address>
               <b>Branch</b><br>
               Shop No.7, <br>
             Vardhman Building No.2,<br>
              New Golden Nest<br>
               Gas Godown Galli,<br>
                Near Hanuman Mandir<br>
              Bhayander East<br>
               
            </address>
        </div>
    </div>
         
    </div>
</div>
<script type="text/javascript">
function validation()
{
    var name=$("#name").val().trim();
    var last_name=$("#last_name").val().trim();
    var email=$("#email").val().trim();
    var tell_me=$("#tell_me").val().trim();
    var email_pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

    if(name=="")
    {
        $("#name_error").fadeIn().html("Required").css('color','red');
        setTimeout(function(){$("#name_error").html("&nbsp;");},3000);
        $("#name").focus();
        return false;
    }
    if(last_name=="")
    {
        $("#last_name_error").fadeIn().html("Required").css('color','red');
        setTimeout(function(){$("#last_name_error").html("&nbsp;");},3000);
        $("#last_name").focus();
        return false;
    }
    if(email=="")
    {
        $("#email_error").fadeIn().html("Required").css('color','red');
        setTimeout(function(){$("#email_error").html("&nbsp;");},3000);
        $("#email").focus();
        return false;
    }
    if (!email_pattern.test(email))
    {
        $("#email_error").fadeIn().html("Invalid").css('color','red');
        setTimeout(function(){$("#email_error").html("&nbsp");},3000);
        $("#email").focus();
        return false;
    }
    if(tell_me=="")
    {
        $("#tell_me_error").fadeIn().html("Required").css('color','red');
        setTimeout(function(){$("#tell_me_error").html("&nbsp;");},3000);
        $("#tell_me").focus();
        return false;
    }
}
</script>  