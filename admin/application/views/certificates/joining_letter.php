<div class="content-wrapper">
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
              <div class="panel-body">


    <center>
    <table  cellpadding="5px" cellspacing="10px" style="border:0px solid black;" width="850px;">
        <tr>
        <?php if(!empty($logo)) {?>
        <td><img src="<?php echo base_url('uploads/logo/'.$logo) ?>" style="width:300px;height:200px;"></td>
        <?php }?>
        <td style="padding:0px;margin:0px;">
          <table style="padding:0px;margin:0px; margin-left:400px;" width="608px;" cellspacing="10px">
            <tr>
              <td style="float:right;">
                <address style=" width:400px; margin-left:400px; font-size:20px;"><?php if(!empty($address)){ echo $address;}?>
                </address>
              </td>
            </tr>
            <tr>
              <td>
                <span style="margin-left:400px;font-size:20px; "><b>M: -<?php if(!empty($mobile)){ echo $mobile.','.$alternate_mobile;}?></b></span>
              </td>
            </tr>
            <tr>
              <td>
                <span style="margin-left:400px;font-size:20px;color:blue; ">E-mail: -<?php if(!empty($email)){ echo $email;}?></span>
              </td>
            </tr>
            <tr>
              <td>
                <span style=" margin-left:400px;color:blue;font-size:20px;"> Website: -<?php if(!empty($website)){ echo $website;}?></span>
              </td>
            </tr> 
          </table>
        </td>
        </tr>
        
        <tr>
          <td colspan="2">
          <div ><hr style="color:blue;width:100%"></div>
          </td>
        </tr>
        
        <br>
      <tr>
       <td colspan="2">
        <center><h1 style="color:#66ccff;"><u><?php if(!empty($title)) { 
          echo ucfirst($title);  } ?></u></h1></center>
      </td>
      </tr>
      <br><br>

      <tr>
         <td>
          <p><b style="margin-left: 0px; font-size:25px;">Date:&nbsp;<?php echo date('d-M-Y')?></b></p>
        </td>
      </tr>
      
      <tr>
        <td colspan="2">
            <p style="margin-left: 0px; font-size:25px;">WP/PHP/MAR/2019/50</p>
            <br>
            <p style="margin-left: 0px; font-size:25px;">To ,</p>
            <p style="margin-left: 0px; font-size:25px;"><?php echo $name;?>,</p>
        </td>
    </tr>
    <tr>
        <td>
         <p style="margin-left: 0px; font-size:25px;">Dear&nbsp;<b><?php echo $name;?> ,</b></p>
         
        </td>
    </tr>
        

      
        <tr>
        <td  colspan="2">
             <span style="margin-left: 20px; margin-right: 10px;">With reference to our letter of intent dated 15/02/2019 and your subsequent acceptance of it, you are hereby appointed in our organization at <b>World Planet E-Solution Pvt. Ltd.</b> with effect from <b>20/02/2019 </b>on the following:</p>
          </span>
          <br>
          <span style="text-align: center;"><b>TERMS AND CONDITIONS</b></span>
    
    <ul style="text-align: justify; font-size:20px;">
        <li style="margin-left: 0px; "><b><u>Probation</u>:</b> You will be on probation for an initial period of Three Months. This period may be extended at the absolute discretion of the company. During probation or at any time before confirmation, your services shall be liable to be terminated without notice and without assigning any reason whatsoever. You shall be confirmed only by an express order in writing.</li>
        <li style="margin-left: 0px; "><b><u>Designation</u> </b>: PHP Developer.</li>

        <li style="margin-left: 0px; "><b><u>Salary</u>:</b> During the probation period, you will be entitled to fixed salary of 1.44 per annum.</li>
        <li style="margin-left: 0px; "><b>Transfer:</b> Your Services can be transferred from one job to another, one department to another or from one branch to another anywhere in India whether existing at present or to be setup in future. Whether situated in the same city or outside, in any office under the supervision and control of our organization or in any of our affiliated or sister concerns, without any extra allowance.</li>
        <li style="margin-left: 0px; "><b><u>Termination of Services</u>:</b> 
            The management reserves the right to terminate your services subsequent to confirmation on giving you two-month notice or payment of salary in lieu thereof. Similarly, you will be at liberty to resign from the service upon one month’s notice or payment of salary in lieu thereof.                             
            <br>(i) If any information/representation made by you in your application/application form is found to be untrue or false or if facts come to our notice which have been either concealed or suppressed by you, the Management reserves the right to dispenses with your services without giving any notice or compensation in lieu thereof.
            <br>(ii) Your services can also be terminated prior to attaining the age of 60 years of account of physical or mental disability or infirmity or for continued ill-health if so certified by a doctor nominated by the company. In such case the Management has the rights to terminate your services by serving upon you one month’s notice in writing or by payment of salary in lieu thereof.</li>


            <li style="margin-left: 0px; "><b><u>Leave</u></b>: Casual, Medical and privilege leave will be as per company’s service rules.</li>

            <li style="margin-left: 0px; "><b><u>Provident Fund</u></b>: You will be entitled to the benefits of provident funds Scheme,as per rules.</li>

            <li style="margin-left: 0px; "><b><u>Medical Fitness</u></b>: Your appointment will be subject to your being found fit by a doctor nominated by the company or a Medical officer of not less than the rank of a D.M.O.</li>

          
            <li style="margin-left: 0px; "><b><u>Other Conditions</u></b>:
              You will not engage yourself directly or indirectly in any services or be concerned in any manner in any business other than that of the company and shall not associate yourself not let your work, name, or personality be used by any other media organization operating in India without the express consent of the management in writing.
              You will Observe and adhere to the rules and regulations, settlements or office orders of the company as may be applicable.<br>
              You will maintain all information/documents/material gathered by you during the course of your employment in strict confidence. You will not copy or make notes of such information/documents except in conjunction with your work for the company. You will not divulge to anyone outside the company or use any of the information/documents/material gathered during the course of your
              employment for your own or anyone else’s benefit, either during or after the term of your employment with the company. The aforesaid obligation shall also apply to proprietary/confidential information/documents of third parties received by you or the company in the normal courses of your employment with the company.</li>

              <li style="margin-left: 0px; "><b><u>Retirement</u>:</b> you will be automatically retired from the service on attaining the age of 58 Years.</li>

              <li style="margin-left: 0px; "><b><u> Confidentiality & Exclusivity</u>:</b>
              You shall observe strict secrecy as to the affair, dealings and concerns of the company or its affiliates and either during the continuance of this engagement or thereafter without the prior written consent of the Board of Directors of the Company. <br>
              You will not divulge to any third party, and use all reasonable endeavors to prevent the publication or disclosure of any Confidential information, any information concerning the business accounts or financial plans or strategies of the company or its affiliates, or of any customer or service provider of the company or its affiliates, or any confidential report or research commissioned by or on behalf of the company or its affiliates or any of their portfolio companies in connection with the business or affairs of the company or its affiliates, or any trade secrets of the company or its affiliates including know-how and confidential transaction received by you, 
              maid know to you, or which you become aware of in the course of your relationship with the company.</li>

                <br>
                <span style="text-align: center;"><b><u>While maintaining secrecy and confidentially you assure the underneath</u>:</b></span>
                <br>
                <span style="text-align:justify; ">
                You acknowledge that you may gain access to or possession of confidential information relating to company during the term of your employment.
                You shall refrain from divulging to any outside persons or concerns any information and secrets connected with Technologies that you may come across during the performance of your duties.
                <br>
                You will treat all matters relating to company in strict confidence and not disclose it to outsiders except with the prior written authorization of company. In particular, you are accepted to maintain complete confidentiality in respect of work methods at our company, system developed/modified by company for its clients and/or any software developed or modified or acquired by the company.
                <br>
                You are prohibited to copy or sell company’s software packages, outside without company’s prior permission. You acknowledge that conditions of this appointment are reasonable and necessary to protect disclosure of confidential information belonging to the company and any disclosure thereof will cause irreparable damage, hardship and injury to
                You are aware that your obligations relating to confidentially survive the termination of your employment and you will be liable to pay damages and be subject to injunctive or other reliefs or any breach of aforesaid obligation.</li>

                Intellectual Property Rights (IPRs) such as copyrights, patents, trademarks, secrets, etc. with respect to any software product including any solutions developed by you while in the employment of company shall remain in the exclusive ownership of the company and you shall have no right, title or interest in respect of such IPRs.

                Confidential information includes all IPRs, information regarding quality control, business, financial information, places, customers, list, marketing data and any other information that are generally not known to the public.</li>
                You will treat all client information as confidential and not disclose them to outsiders except when authorized.

                In the course of your association with us, you may come across information that is of a vital and confidential nature, pertaining to our industry. It is, therefore, expressly agreed, as an important component of this appointment, that you will not associate yourself, either directly or indirectly, either during your association with us or for a period of two years thereafter, with any industry of a competitive nature

                Any information or data made available to you by the company or by the customers or by any other party, or any innovation or improvement in process, design, etc. effected in the course of your association with us will be kept by you in strict confidence and will not be used by you to the detriment of the company interest at any time.
                Given the nature of the business, you agree, acknowledge, accept and confirm that you shall have no proprietary interest in any idea, invention, design, technical or business innovation, computer program and related documentation, or any other works product developed, conceived, or used by you, in whole or in part that arises out of your relationship with the Company, or that are otherwise made through the use of the company’s time or materials. During the course of employment or thereafter you, with any intentions, will not do any acts, than the company shall have the right to sue you under relevant laws and seek redressed.

                Sexual Harassment and Other Discriminatory Harassment
            
                Sexual harassment and other discriminatory harassment are illegal and violate Company policies. Actions or words of a sexual nature that harass or intimidate others are prohibited. Similarly, actions  
                or words that harass or intimidate based on race, color, religion, gender, sexual orientation, age, national origin, disability, covered veteran status, marital status or any other unlawful basis are also
                prohibited.
                </span>
                
              <p style="margin-left: 10px; margin-right: 10px;">
                This is a computer generated letter please concern with our franchisee branch with the print and duly take signature on your appointment.
              </p>
            
              <br>
              <center><b>Misuse of Company resources and conduct in violation of Company policy will result in disciplinary action in accordance with the Company policy, up to and including immediate termination.<br><br></b></center>
            </td>
          </tr>
          <br><br>
          <tr>
          <td>
            <p style="font-size:25px; margin-left:50px;"> ____________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Signature</b><br>
              <b>Yours Faithfully </b></p>
          </td>
         
          <td>
            <p style="font-size:25px; margin-left:450px;"> ____________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Signature</b><br>
              <b> Managing Director</b></p>
          </td>
        </tr>
        </table>
        </center>
    <br>
  
    <footer>
      <center>
        <p style="background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;">
        <strong> Head Office:</strong> 
         <?php if(!empty($head_office)){ echo $head_office;}?>
        </p>
      </center>
     </footer>
          
                </div>  <!-- end panel -->
            </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script> setTimeout(function(){ $(".errid").fadeOut(); },3000); </script>