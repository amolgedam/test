<style>
@page {
   size: 7in 9.25in;
   margin: 27mm 16mm 27mm 16mm;
}
div.chapter, div.appendix {
    page-break-after: always;
}
body
{
  size: 7in 9.25in;
   margin: 27mm 16mm 27mm 16mm;
    /*margin:0px;*/
    background-color: black;
    font-family: 'Open Sans' Sans-serif;
}
@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese");
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font: inherit;
  font-size: 100%;
  vertical-align: baseline;
}
html {
  line-height: 1;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}
ol li{
  padding-bottom: 5px;
}
caption, th, td {
  text-align: left;
  font-weight: normal;
  vertical-align: middle;
}

q, blockquote {
  quotes: none;
}
q:before, q:after, blockquote:before, blockquote:after {
  content: "";
  content: none;
}

a img {
  border: none;
}

article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
  display: block;
}
.clearfix {
  display: block;
  clear: both;
}
#main
{
    margin:auto;
    height:900px;
    width:700px;
    background-color: #F7EDEB;
}

#container {
  font: normal 13px/1.4em 'Open Sans', Sans-serif;
  margin: 0 auto;
  min-height: 1158px;
  background: #F7EDEB url("<?php echo base_url() ?>assets/img/bg.png") 0 0 no-repeat;
  background-size: 100% 100%;
  color: #5B6165;
  position: relative;
}


#memo {
  padding-top: 50px;
  margin: 0 60px 0 60px;
  border-bottom: 1px solid #ddd;
  height: 115px;
}
#memo .logo {
  float: left;
  margin-right: 20px;
}
#memo .logo img {
  width: 150px;
  height: 100px;
}
#memo .company-info {
  float: right;
  text-align: right;
}
#memo .company-info > div:first-child {
  line-height: 1em;
  font-weight: bold;
  font-size: 20px;
  color: #0F4F91;
}
#memo .company-info span {
  font-size: 12px;
  display: inline-block;
  min-width: 20px;
}
#memo:after {
  content: '';
  display: block;
  clear: both;
}

#invoice-title-number {
  font-weight: bold;
  margin: 30px 0;
}
#invoice-title-number span {
  line-height: 0.88em;
  display: inline-block;
  min-width: 20px;
}
#invoice-title-number #title {
    text-transform: uppercase;
    padding: 4px 10px 3px 58px;
    font-size: 18px;
    background: #0F4F91;
    color: white;
    margin-top: -15px;
}
#invoice-title-number #number {
  margin-left: 10px;
  font-size: 35px;
  position: relative;
  top: -5px;
}

#client-info {
  float: left;
  margin-left: 60px;
  min-width: 220px;
}
#client-info > div {
  margin-bottom: 3px;
  min-width: 20px;
}
#client-info span {
  display: block;
  min-width: 20px;
}
#client-info > span {
  text-transform: uppercase;
}

table {
  table-layout: fixed;
}
table th, table td {
  vertical-align: top;
  word-break: keep-all;
  word-wrap: break-word;
}
#items {
  margin: 25px 30px 0 30px;
  height: 500px;
}
#items .first-cell, #items table th:first-child, #items table td:first-child {
  /*width: 25px !important;*/
  padding-left: 0 !important;
  padding-right: 0 !important;
  text-align: right;
}
#items table {
  border-collapse: separate;
  width: 100%;
  border: 1px solid #969696;
  height:100%;
  font-size: 13px !important;
}
#items table th {
  font-weight: bold;
  /*font-size: 12px;*/
  padding: 5px 8px;
  text-align: right;
  background: #0F4F91 !important;
  color: white;
  text-transform: uppercase;
}
#items table th:nth-child(2) {
  width: 30%;
  text-align: left;
}
#items table th:last-child {
  text-align: right;
}
#items table td {
  padding: 9px 9px;
  text-align: right;
  border-left: 1px solid #969696;
  /*border-right: 1px solid #ddd;*/
}
#items table td:nth-child(2) {
  text-align: left;
}


#sums {
  margin:25px 30px 0 0;
  background: url("<?php echo base_url() ?>assets/img/invoice.png") right bottom no-repeat;
}
#sums table {
  float: right;
}
#sums table tr th, #sums table tr td {
  min-width: 100px;
  padding: 5px 8px;
  text-align: right;
}
#sums table tr th {
  font-weight: bold;
  text-align: left;
  padding-right: 35px;
}
#sums table tr td.last {
  min-width: 0 !important;
  max-width: 0 !important;
  width: 0 !important;
  padding: 0 !important;
  border: none !important;
}
#sums table tr.amount-total th {
  text-transform: uppercase;
}
#sums table tr.amount-total th, #sums table tr.amount-total td {
  font-size: 15px;
  font-weight: bold;
}
#sums table tr:last-child th {
  text-transform: uppercase;
}
#sums table tr:last-child th, #sums table tr:last-child td {
  font-size: 15px;
  font-weight: bold;
  color: white;
}


#invoice-info {
  float: left;
  margin: 20px 35px 10px 30px;
}
#invoice-info > div > span {
  display: inline-block;
  min-width: 20px;
  min-height: 18px;
  margin-bottom: 3px;
}
#invoice-info > div > span:first-child {
  color: black;
}
#invoice-info > div > span:last-child {
  color: #aaa;
}
#invoice-info:after {
  content: '';
  display: block;
  clear: both;
}

#terms {
  float: left;
  margin-top: 50px;
}
#terms .notes {
  float: right;
  min-height: 30px;
  min-width: 50px;
  color: #B32C39;
  margin-top: -30px;
}
#terms .payment-info div {
  margin-bottom: 3px;
  min-width: 20px;
}

.thank-you {
  margin: 10px 0 30px 0;
  display: inline-block;
  min-width: 20px;
  text-transform: uppercase;
  font-weight: bold;
  line-height: 0.88em;
  float: right;
  padding: 0px 30px 0px 2px;
  font-size: 50px;
  background: #F4846F;
  color: white;
}

.ib_bottom_row_commands {
  margin-left: 30px !important;
}

</style>
<!DOCTYPE html>
<html>
    <head>
        <title>invoice</title>
    </head>
    <body>
        <div id="main">
        <div id="container">
                <section id="memo">
                <div class="logo">
                  <img src="<?php echo base_url('uploads/logo96.png') ?>" />
                </div>
                
                <div class="company-info">
                  <div style="text-transform: uppercase;">World Planet E-Solutions Pvt. Ltd.</div>
                  <br />
                  <span style="text-align: center; padding-right: 15px; font-weight: bold">Mobile Applications (Android / iOS) | Website Designing |<br> Billing Software | ERP Management Software |<br> Digital Marketing |  Social Media | Cyber Security</span>
                </div>

              </section>

               <section id="invoice-title-number">
                <span id="title">invoice : <?= $invoice_no ?></span><br>
<span class="bdt" style="float: right; padding-right: 50px;">GSTIN : 27AACCW0199D1ZC</span><br>
<span class="bdt" style="float: right; padding-right: 50px;">PAN : AACCW0199D</span>
              </section>
              <div class="clearfix"></div>
      
              <section id="client-info">

                <span style="margin-top: -30px">To:</span>
                <div>
                  <span class="bold">______________________________ </span>
                </div>
                ______________________________<br>
                ______________________________<br>
                <!-- ______________________________<br> -->
              </section>
              <div class="clearfix"></div><!-- border: solid; border-width: 1px; border-color: #C0C0C0; -->
               <section id="items">
                <table cellpadding="0" cellspacing="0">
                
                  <tr style="height: 5%">
                    <th style="width: 7%; text-align: center;">SR.</th> 
                    <th style="width: 38%; text-align: center;">PRODUCT NAME</th>
                    <th style="width: 11%; text-align: center;">PRICE</th>
                    <th style="width: 11%; text-align: center;">CGST(%)</th>
                    <th style="width: 11%; text-align: center;">SGST(%)</th>
                    <th style="width: 11%; text-align: center;">DISC(%)</th> 
                    <th style="width: 11%; text-align: center;">TOTAL</th>
                  </tr>

                   <?php if($item != '') { $sr=0; $total = 0; for ($j=0; $j < $itemCount ; $j++)  { 
                        
                        $total+=($rate[$j]+$rate[$j]*($cgst[$j]+$sgst[$j])/100)-($rate[$j]+$rate[$j]*($cgst[$j]+$sgst[$j])/100)*$discount[$j]/100;
                    ?>
                  <tr data-iterate="item">
                    <td style="text-align: center;"><?= ++$sr; ?></td>
                    <td style="text-align: left;"><?= ucwords($item[$j]); ?></td>
                    <td><?= $rate[$j] ?></td>
                    <td><?= $cgst[$j].' %' ?></td>
                    <td><?= $sgst[$j].' %' ?></td>
                    <td><?= $discount[$j].' %' ?></td>
                    <td><?= intval(intval($rate[$j]+$rate[$j]*($cgst[$j]+$sgst[$j])/100)-intval($rate[$j]+$rate[$j]*($cgst[$j]+$sgst[$j])/100)*$discount[$j]/100); ?></td>
                  </tr>
                   <?php } $sr++; }?>
                </table>
              </section>

              <section id="sums">
                <table cellpadding="0" cellspacing="0">
                  
                  <tr data-hide-on-quote="true">
                    <th>Total Amount :</th>
                    <td>Rs. <?= intval($total) ?></td>
                  </tr>
                  
                </table>
          <div class="clearfix"></div>
          </section>
          <div>
               <section id="invoice-info">
            <div>
              <table cellpadding="0px" cellspacing="0px" width="100%" >
                <tr>
                  <td width="25%" style="font-weight: bold">Terms & Conditions :</td>
                  <td>
                    <ol style="text-align: justify;">
                      <li>Advance 50% must be released while placing the order and 50% at the time of</li>
                      <li>Prices includes 1 year free maintenance and after 1 year 30% per year will be charged.</li>
                      <li>Extra charge for domain and hosting will be added.</li>
                      <li>Payment gateway and Message gateway depends upon clients requirement.</li>
                    </ol>
                  </td>
                </tr>
              </table>
            </div>
          </section>
          </div>
          <div class="company-info">
            <table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid">
              <tr>
                <td style="padding-left: 40px;">
<pre style="font-family: sans-serif;font-size: 13px;">

<b style="font-weight: bold !important;">Head Office     :</b>    A/2A, Viceroy court, Opp. Domino’s Pizza, Thakur Village, Kandivali (E) Mumbai 400101
<b style="font-weight: bold !important;">Contact No      :</b>    +91 9561997500 / +91 9821304242
<b style="font-weight: bold !important;">website           :</b>     www.worldplanetesolution.com
<b style="font-weight: bold !important;">Our Branches  :    ● Mumbai   ● Nagpur   ● Pune   ● Nashik   ● Australia.</b></pre>
              </td></tr>
            </table>
              
          </div>
           <div class="clearfix"></div>
            <div class="clearfix"></div>
      </div>
    </div>
  <script type="text/javascript">
    // window.print();
  </script>
    </body>
</html>