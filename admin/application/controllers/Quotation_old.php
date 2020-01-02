<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Quotation extends CI_Controller {

    function __construct()
    {
        parent::__construct();      
        $this->load->model('Quotation_model');
        $this->load->model('Quotation_report_model');
        $this->load->library(array('session','form_validation','image_lib','Custom','email'));
        $this->load->helper("file");
    }
    public function index()
    {        
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Manage Quotation',
            'createAction'=>site_url('Quotation/create'),
            
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('quotation/list',$data);
    }

    public function ajax_manage_page()
    {
        $Quotation = $this->Quotation_model->get_datatables();
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Quotation as $Quotations) 
        {
            $btn = anchor(site_url('Quotation/View/'.$Quotations->id),'<button title="View" class="btn btn-info btn-circle btn-sm"><i class="fa fa-eye"></i></button>');

            $btn .=" | ".anchor(site_url('Quotation/update/'.$Quotations->id),'<button title="Edit" class="btn btn-success btn-circle btn-sm"><i class="fa fa-pencil"></i></button>');
            $btn .=" | ".anchor(site_url('Quotation/create_print/'.$Quotations->id),'<button title="Print" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-print"></i></button>');
            
            $btn .=" | ".anchor(site_url('Quotation/Openpdf/'.$Quotations->id),'<button title="Download Pdf" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-download" aria-hidden="true"></i></button>');
            
            $btn .=' | '.'<button title="Send Mails" class="btn btn-success btn-circle btn-sm" 
            onclick="show_model('.$Quotations->id.','."'$Quotations->email'".')"><i class="fa fa-envelope-o" aria-hidden="true"></i></button>';

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($Quotations->customer_name);
            $nestedData[] = $Quotations->email;
            $nestedData[] = 'Rs. '.number_format(round($Quotations->total_amount),2);
            $nestedData[] = date('d-m-Y',strtotime($Quotations->quotation_date));
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 
        
        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Quotation_model->count_all(),
                    "recordsFiltered" => $this->Quotation_model->count_filtered(),
                    "data" => $data,
        );
        echo json_encode($output);
}

public function create()
{   
    $customer = $this->Crud_model->GetData('customer_master');
    $cms = $this->Crud_model->get_single('cms',"slug='term-&-conditions'");

    //print_r($cms);exit;
    $data = array(
            'quot_id'=>set_value('quot_id'),
            'terms'=>$cms->content,
            'customer' => $customer,
            'header' => 'Create Quotation',
            'header1' => 'Create Quotation',
            'button' => 'Create',
            "actionUrl"=>site_url("Quotation/save_quotation"),
             );
    $this->load->view('quotation/form',$data);
}

public function save_quotation()
{
    $quotationdata = $this->Crud_model->GetData('quotation');
    if(!empty($quotationdata)){
        foreach ($quotationdata as $key) {
            $quot_id = $key->quotation_no;
        }
    }else
    {
        $quot_id = 2000;
    }
    $quot_id = $quot_id+1;
    $customer_id=$this->input->post('selected_client');
    $discount_percent=$this->input->post('discount_percent');
    $discount_rs=$this->input->post('discount_rs');
    $itemCount = count($_POST['item']);
    $customer_id = $_POST['customer_name'];
    $customerdata = $this->Crud_model->get_single("customer_master","id='".$customer_id."'");
    
    $data3 = array(
                'quotation_no' =>$quot_id,
                'terms' =>$this->input->post('terms'),
                'customer_id' =>$customer_id,
                'quotation_date' =>date('Y-m-d'),
                'status'=>'Active',
                'created'=>date('Y-m-d H:i:s'),
                'modified'=>date('Y-m-d H:i:s'),
    ); 
    $this->Crud_model->SaveData('quotation',$data3);
    $last_id = $this->db->insert_id();
    $sr=0; $total = 0;
    for ($j=0; $j < $itemCount ; $j++)
    { 
        $product_name=$_POST['item'][$j];
        $sr++;
        $rate=$_POST['rate'][$j];
        $desc=$_POST['description'][$j];
        $discount=$_POST['discount'][$j];
        $gst=$_POST['gst'][$j];
        $proVal = ($rate+$rate*$gst/100)-($rate+$rate*$gst/100)*$discount/100;
        $total+=($rate+$rate*$gst/100)-($rate+$rate*$gst/100)*$discount/100;
        
        $data2 = array(
                    'quotation_id' =>$last_id,
                    'product_name'=>$product_name,
                    'price'=>$rate,
                    'quantity'=>'1',
                    'gst'=>$gst,
                    'discount'=>$discount,
                    'total'=>intval($proVal),
                    'description'=>$desc,
                    'status'=>'Active',
                    'created'=>date('Y-m-d H:i:s'),
                    'modified'=>date('Y-m-d H:i:s'),
        ); 
        $this->Crud_model->SaveData('quotation_log',$data2);
    }
    $data1 = array(
            'total_amount' =>intval($total),
    ); 
    $con = "id='".$last_id."'";
    $this->Crud_model->SaveData('quotation',$data1,$con);

     $this->session->set_flashdata('message', 'Quotation Created successfully');
    redirect(site_url('Quotation'));

  /*  $invoiceData = $this->Crud_model->get_single("quotation","id='".$last_id."'");
    $logData = $this->Crud_model->GetData("quotation_log","","quotation_id='".$last_id."'");
    $customerData = $this->Crud_model->get_single('customer_master',"id='".$invoiceData->customer_id."'");
    $countd = count($logData);
    $data2=array(
                'invoiceData' =>$invoiceData,
                'logData' =>$logData,
                'customerData' =>$customerData,
                'countd' =>$countd,
    );
    $this->load->view('quotation/quotation_print',$data2);*/      
 }
 public function update($id)
 {
    $customer = $this->Crud_model->GetData('customer_master');
    $cond="q.id='".$id."'";
    $invoiceData = $this->Quotation_model->quotation_view($cond);

    $get_quotationlog = $this->Crud_model->GetData('quotation_log','',"quotation_id='".$id."'");

   //print_r($get_quotationlog);exit;

    $data = array(
            'quot_id'=>$id,
            'terms'=>$cms->description,
            'customer' => $customer,
            "actionUrl"=>site_url("Quotation/update_quotation"),
            'header' => 'Update Quotation',
            'header1' => 'Update Quotation',
            'button' => 'Update',
            'invoiceData' =>$invoiceData,
            'customer_id' =>$invoiceData->customer_id,
            'email' =>$invoiceData->email,
            'mobile_no' =>$invoiceData->mobile_no,
            'address' =>$invoiceData->address,
            'quotation_no' =>$invoiceData->quotation_no,
            'quotation_date' =>$invoiceData->quotation_date,
            'total_amount' =>$invoiceData->total_amount,
            'terms' =>$invoiceData->terms,
            'get_quotationlog' =>$get_quotationlog,
             );

    $this->load->view('quotation/form',$data);
 }
 public function update_quotation()
{
    $id = $this->input->post('quot_id');

    $quotationdata = $this->Crud_model->GetData('quotation');
    if(!empty($quotationdata)){
        foreach ($quotationdata as $key) {
            $quot_id = $key->quotation_no;
        }
    }else
    {
        $quot_id = 2000;
    }
    $quot_id = $quot_id+1;
   // $customer_id = $this->input->post('selected_client');
    $discount_percent=$this->input->post('discount_percent');
    $discount_rs=$this->input->post('discount_rs');
    $itemCount = count($_POST['item']);
    $customerdata = $this->Crud_model->get_single("customer_master","id='".$customer_id."'");
    $customer_id = $_POST['customer_name'];
    $data3 = array(
                'quotation_no' =>$quot_id,
                'terms' =>$this->input->post('terms'),
                'customer_id' =>$customer_id,
                'quotation_date' =>date('Y-m-d'),
                'status'=>'Active',
                'created'=>date('Y-m-d H:i:s'),
                'modified'=>date('Y-m-d H:i:s'),
    ); 
    $this->Crud_model->SaveData('quotation',$data3,"id='".$id."'");

    $this->Crud_model->DeleteData('quotation_log',"quotation_id='".$id."'");

    $last_id = $id;
    $sr=0; $total = 0;
    for ($j=0; $j < $itemCount ; $j++)
    { 
        $product_name=$_POST['item'][$j];
        $sr++;
        $rate=$_POST['rate'][$j];
        $desc=$_POST['description'][$j];
        $discount=$_POST['discount'][$j];
        $gst=$_POST['gst'][$j];
        $proVal = ($rate+$rate*$gst/100)-($rate+$rate*$gst/100)*$discount/100;
        $total+=($rate+$rate*$gst/100)-($rate+$rate*$gst/100)*$discount/100;
        
        $data2 = array(
                    'quotation_id' =>$last_id,
                    'product_name'=>$product_name,
                    'price'=>$rate,
                    'quantity'=>'1',
                    'gst'=>$gst,
                    'discount'=>$discount,
                    'total'=>intval($proVal),
                    'description'=>$desc,
                    'status'=>'Active',
                    'created'=>date('Y-m-d H:i:s'),
                    'modified'=>date('Y-m-d H:i:s'),
        ); 
        $this->Crud_model->SaveData('quotation_log',$data2);
    }
    $data1 = array(
            'total_amount' =>intval($total),
    ); 
    $con = "id='".$last_id."'";
    $this->Crud_model->SaveData('quotation',$data1,$con);

     $this->session->set_flashdata('message', 'Quotation Updated successfully');
    redirect(site_url('Quotation'));

  /*  $invoiceData = $this->Crud_model->get_single("quotation","id='".$last_id."'");
    $logData = $this->Crud_model->GetData("quotation_log","","quotation_id='".$last_id."'");
    $customerData = $this->Crud_model->get_single('customer_master',"id='".$invoiceData->customer_id."'");
    $countd = count($logData);
    $data2=array(
                'invoiceData' =>$invoiceData,
                'logData' =>$logData,
                'customerData' =>$customerData,
                'countd' =>$countd,
    );
    $this->load->view('quotation/quotation_print',$data2);*/      
 }

  public function get_customer()
    {
        $id = $this->input->post('id');
        $customer = $this->Crud_model->get_single('customer_master',"status='Active' and id = '".$id."'");
        $data =array(
          'email'=>$customer->email,
          'mobile_no'=>$customer->mobile_no,
          'address'=>$customer->address,
        );
        echo json_encode($data);exit;
    }
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $cond="id='".$id."'";
        $invoiceData = $this->Crud_model->get_single('quotation',$cond);
        $Getcustomerdata = $this->Crud_model->get_single("customer_master","id='".$invoiceData->customer_id."'");
        $getlogdata = $this->Crud_model->GetData("quotation_log","","quotation_id='".$id."'");
        $citydata = $this->Crud_model->get_single("cities","id='".$Getcustomerdata->city_id."'");

        $data =array(
          'customer_name'=>$Getcustomerdata->customer_name,
          'address'=>$Getcustomerdata->address,
          'city_id'=>$citydata->city_name,
          'pin_code'=>$Getcustomerdata->pin_code,
          'mobile_no'=>$Getcustomerdata->mobile_no,
          'email'=>$Getcustomerdata->email,
          'invoiceData' =>$invoiceData,
          'getlogdata' =>$getlogdata,
        );
         $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('quotation/view',$data);
        $this->load->view('common/footer'); 
    }

     public function manage_ajax_page(){
        $customerMaster = $this->Quotation_report_model->get_datatables();
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($customerMaster as $custData) 
        {
            
            $btn = anchor(site_url('Quotation/View/'.$custData->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$custData->id.')"><i class="fa fa-trash-o"></i></span>';
           
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $custData->customer_name;
            $nestedData[] = $custData->email;
            $nestedData[] = "<i class='fa fa-inr'></i> ".number_format($custData->total_amount);
            $nestedData[] = $custData->quotation_date;    
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Quotation_report_model->count_all(),
                    "recordsFiltered" => $this->Quotation_report_model->count_filtered(),
                    "data" => $data,
        );
        
        echo json_encode($output);
    }

    public function delete()
    {
        if(isset($_POST['id']))
        {
            $this->Crud_model->DeleteData("quotation","id='".$_POST['id']."'");
            $this->Crud_model->DeleteData("quotation_log","quotation_id='".$_POST['id']."'");exit();
        }
    }

    public function create_print($id)
    {
        $invoiceData = $this->Crud_model->get_single("quotation","id='".$id."'");
        $logData = $this->Crud_model->GetData("quotation_log","","quotation_id='".$id."'");
        $customerData = $this->Crud_model->get_single('customer_master',"id='".$invoiceData->customer_id."'");
        $settings = $this->Crud_model->GetData('settings','','','','','','1');
        $get_dec = $this->Crud_model->GetData('cms','content',"slug='declaration'",'','','','1');
        $countd = count($logData);
        $data2=array(
            'invoiceData' =>$invoiceData,
            'logData' =>$logData,
            'customerData' =>$customerData,
            'countd' =>$countd,
            'settings' =>$settings,
            'content' =>$get_dec->content,

            );
        $this->load->view('quotation/quatation_new',$data2);
    }

    public function create_print_pdf($id)
    {   
        $invoiceData = $this->Crud_model->get_single("quotation","id='".$id."'");
        $logData = $this->Crud_model->GetData("quotation_log","","quotation_id='".$id."'");
        $customerData = $this->Crud_model->get_single('customer_master',"id='".$invoiceData->customer_id."'");
        $settings = $this->Crud_model->GetData('settings','','','','','','1');
        $get_dec = $this->Crud_model->GetData('cms','content',"slug='declaration'",'','','','1');
        $countd = count($logData);
        $data2=array(
            'invoiceData' =>$invoiceData,
            'logData' =>$logData,
            'customerData' =>$customerData,
            'countd' =>$countd,
            'settings' =>$settings,
            'content' =>$get_dec->content,
            );

        return $this->load->view('quotation/quatation_new_pdf',$data2,true);
    }

    public function Openpdf($id)
    {
        $flag="pdf";
        $body_pdf = $this->create_print_pdf($id);


        $pnlname = date('d-m-Y'); 
        $rand=rand(0000,9999);
        $pnlname1 = date('d-m-Y').'_'.time(); 
        $fileName = '/uploads/quotation/'.$pnlname.'_wpes_'.$rand.'.pdf';

        $file = getcwd().$fileName;
        $pdfFilePath = $file;
        $this->load->library('m_pdf');
        ///////////////////////////WATERMARK CODE//////////////////////////////////////////////////
        $mpdf=new mPDF('c'); 
            
          $mpdf->SetDisplayMode('fullpage');
          $mpdf->SetWatermarkText('World Planet e-Solutions pvt.ltd.');
          $mpdf->watermark_font = 'DejaVuSansCondensed';
          $mpdf->watermarkTextAlpha = 0.1;
          $mpdf->showWatermarkText = true;
        ///////////////////////WATERMARK CODE//////////////////////////////////////////////////////
        ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
              $mpdf->mirrorMargins = 1;
              $mpdf->defaultPageNumStyle = '1';
              $mpdf->SetDisplayMode('fullpage','two');
            ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
            $mpdf->defaultfooterfontsize = 12;  /* in pts */
            $mpdf->defaultfooterfontstyle = B;  /* blank, B, I, or BI */
            $mpdf->defaultfooterline = 0;       /* 1 to include line below header/above footer */
            $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','O'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','E'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $body =  $mpdf->WriteHTML($body_pdf);

               
            $mpdf->SetDisplayMode('fullpage');
            //download it D save F.
            fopen($pdfFilePath,'wb');
            $mpdf->Output($pdfFilePath, "D");
            $mpdf->Output($pdfFilePath, "F");

              

        redirect(site_url('Quotation'));
    }

    public function send_mail()
    {   
        $id = $this->input->post('quot_id');  

            $random = rand('0000','9999');

                $targetDir = FCPATH."uploads/attachment";

                 if(!empty($_FILES["attachment"]["name"]))
                 {
                    if(is_array($_FILES))
                    {
                      if(is_uploaded_file($_FILES['attachment']['tmp_name']))
                      {
                        if(move_uploaded_file($_FILES['attachment']['tmp_name'],"$targetDir/". $random.$_FILES['attachment']['name']))
                        {
                            $attachment2= $random.$_FILES['attachment']['name'];
                        }
                      }
                    }
                 }
                 else
                 {
                    $attachment2 ="";
                 }

                 $data1=array(
                    'attachment'=>$attachment2
                 );

                 $con = "id='".$id."'";
                $this->Crud_model->SaveData('quotation',$data1,$con);
        
        $get_attachment2 = base_url('uploads/attachment/'.$attachment2);
        
        $flag="pdf";
        $body_pdf = $this->create_print_pdf($id);
        $pnlname = date('d-m-Y'); 
        $rand=rand(0000,9999);
        $pnlname1 = date('d-m-Y').'_'.time(); 
        $fileName = '/uploads/quotation/'.$pnlname.'_wpes_'.$rand.'.pdf';

        $file = getcwd().$fileName;
        $pdfFilePath = $file;
        $this->load->library('m_pdf');
        ///////////////////////////WATERMARK CODE//////////////////////////////////////////////////
        $mpdf=new mPDF('c'); 
            
          $mpdf->SetDisplayMode('fullpage');
          $mpdf->SetWatermarkText('World Planet e-Solutions pvt.ltd.');
          $mpdf->watermark_font = 'DejaVuSansCondensed';
          $mpdf->watermarkTextAlpha = 0.1;
          $mpdf->showWatermarkText = true;
        ///////////////////////WATERMARK CODE//////////////////////////////////////////////////////
        ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
              $mpdf->mirrorMargins = 1;
              $mpdf->defaultPageNumStyle = '1';
              $mpdf->SetDisplayMode('fullpage','two');
            ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
            $mpdf->defaultfooterfontsize = 12;  /* in pts */
            $mpdf->defaultfooterfontstyle = B;  /* blank, B, I, or BI */
            $mpdf->defaultfooterline = 0;       /* 1 to include line below header/above footer */
            $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','O'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','E'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $body =  $mpdf->WriteHTML($body_pdf);
        
            $mpdf->SetDisplayMode('fullpage');
            //download it D save F.
            fopen($pdfFilePath,'wb');
            // $mpdf->Output($pdfFilePath, "D");
            $mpdf->Output($pdfFilePath, "F");
        
        $attachment = base_url().$fileName;
        $invoice = $this->Crud_model->get_single('quotation',"id='".$id."'");
        $customer = $this->Crud_model->get_single('customer_master',"id='".$invoice->customer_id."'");
        
        $subject = $this->input->post('subject');
        $description = $this->input->post('description');
        $from = $this->input->post('from');
        if(empty($subject))
        {
            $subject1="Product Quotation";
        }
        else{
            $subject1 =  $subject;
        }
        if(empty($description))
        {
            $body1="...";
        }
        else{
            $body1 = $description;
        }
        $get_attachment2 = base_url('uploads/attachment/'.$attachment2);
        
        $sendCustomerEmail=$customer->email;
        $res= $this->custom->sendEmailSmtp_web($from,$subject1,$body1,$sendCustomerEmail,$attachment,$get_attachment2);
        $this->session->set_flashdata('message', 'Mail send successfully');
        redirect(site_url('Quotation'));
    }
    
}?>