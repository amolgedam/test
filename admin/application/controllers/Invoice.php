<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// error_reporting(0);

class Invoice extends CI_Controller {
    function __construct()
    {
        parent::__construct();      
        $this->load->model('Invoice_model');
        $this->load->library(array('session','form_validation','image_lib','Custom','email'));
        $this->load->helper("file"); 
    }
   
    public function index()
    {
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Invoice Master',
            'create'=>site_url('Invoice/create'),
            
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('invoice/list',$data); 
    }

    public function ajax_manage_page(){
        $invoiceData = $this->Invoice_model->get_datatables();
        // print_r($this->db->last_query());exit;
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($invoiceData as $custData) 
        {
            
            $btn = anchor(site_url('Invoice/View/'.$custData->id),'<button title="View" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye"></i></button>');

            $btn .=" | ".anchor(site_url('Invoice/create_print/'.$custData->id),'<button title="Print" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-print"></i></button>');
            
            $btn .=" | ".anchor(site_url('Invoice/Openpdf/'.$custData->id),'<button title="Send Mails" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-envelope-o"></i></button>');

             $status='';            
            if($custData->status=='Completed')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$custData->id.'"  onClick="statuss('.$custData->id.');" >'.$custData->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$custData->id.'"  onClick="statuss('.$custData->id.');" >'.$custData->status.'</span>';
            }
            if(!empty($custData->customer_name)){ $customer_name = ucwords($custData->customer_name); }else{ $customer_name = "N/A"; }
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $customer_name;
            $nestedData[] = $custData->amount;
            $nestedData[] = $custData->discount_amount;
            $nestedData[] = $custData->total_amount;
            $nestedData[] = $status."<input type='hidden' id='status".$custData->id."' value='".$custData->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Invoice_model->count_all(),
                    "recordsFiltered" => $this->Invoice_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }

     public function create()
    {
        $cms = $this->Crud_model->get_single('cms',"slug='term-&-conditions'");
        
       // print_r($cms);exit;
        $customer = $this->Crud_model->GetData('customer_master');
        $data = array(
                'terms'=>$cms->content,
                'customer' => $customer,
                'header' => 'Create Invoice',
                'header1' => 'Create Invoice',
                "actionUrl"=>site_url("Invoice/create_invoice"),
                 );
        $this->load->view('invoice/form',$data);
    }

    public function create_invoice()
    {   
        $customer_id = $_POST['customer_name'];
        $itemCount = count($_POST['item']);
        $total_amount = 0;
        $amount = 0;
        $total_discount = 0;
        for($i=0;$i<$itemCount;$i++)
        {
            $rate = $_POST['rate'][$i];
            $discount = $_POST['discount'][$i];
            $total_amount += intval($rate)- intval($rate)*intval($discount)/100;
            $amount += $rate;
            $total_discount += intval($rate)*intval($discount)/100;
        }
        $data = array(
                    'terms' =>$this->input->post('terms'),
                    'customer_id' =>$customer_id,
                    'amount' =>$amount,
                    'discount_amount' =>$total_discount,
                    'total_amount' =>$total_amount,
                    'status' =>"Pending",
                    'created' =>date('Y-m-d H:i:s'),
                    'itemCount' =>$itemCount,
        );
        $this->Crud_model->SaveData('invoice_wo',$data);
        $last_id = $this->db->insert_id();
        for($i=0;$i<$itemCount;$i++)
        {
            $rate = $_POST['rate'][$i];
            $discount = $_POST['discount'][$i];
            $discount_amount = intval($rate)*intval($discount)/100;
            $total_amount = intval($rate)- intval($rate)*intval($discount)/100;
            $data1 = array(
                        'invoice_id' =>$last_id,
                        'customer_id' =>$customer_id,
                        'product_name' =>$_POST['item'][$i],
                        'unit' =>'1',
                        'price' =>$rate,
                        'amount' =>$rate,
                        'discount' =>$discount,
                        'discount_amount' =>$discount_amount,
                        'total_amount' =>$total_amount,
                        'created' =>date('Y-m-d H:i:s'),
            );
            $this->Crud_model->SaveData('invoice_wo_gst_log',$data1);
        }
        $this->session->set_flashdata('message', 'Product Sold.');
        
        $invoiceData = $this->Crud_model->get_single("invoice_wo","id='".$last_id."'");
        $logData = $this->Crud_model->GetData("invoice_wo_gst_log","","invoice_id='".$last_id."'");
        $customerData = $this->Crud_model->get_single('customer_master',"id='".$invoiceData->customer_id."'");
        $countd = count($logData);
        $data2=array(
            'invoiceData' =>$invoiceData,
            'logData' =>$logData,
            'customerData' =>$customerData,
            'countd' =>$countd,
            );
        $this->load->view('invoice/invoice_print',$data2);
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
    public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("invoice_wo",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $cond="id='".$id."'";
        $invoiceData = $this->Crud_model->get_single('invoice_wo',$cond);
        $Getcustomerdata = $this->Crud_model->get_single("customer_master","id='".$invoiceData->customer_id."'");
        $getlogdata = $this->Crud_model->GetData("invoice_wo_gst_log","","invoice_id='".$id."'");
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
        $this->load->view('invoice/view',$data);
        $this->load->view('common/footer'); 
    }

    public function create_print($id)
    {
        $invoiceData = $this->Crud_model->get_single("invoice_wo","id='".$id."'");
        $logData = $this->Crud_model->GetData("invoice_wo_gst_log","","invoice_id='".$id."'");
        $customerData = $this->Crud_model->get_single('customer_master',"id='".$invoiceData->customer_id."'");
        $countd = count($logData);
        $data2=array(
            'invoiceData' =>$invoiceData,
            'logData' =>$logData,
            'customerData' =>$customerData,
            'countd' =>$countd,
            );
        $this->load->view('invoice/invoice_print',$data2);
    }

    public function create_print_pdf($id)
    {   
        $invoiceData = $this->Crud_model->get_single("invoice_wo","id='".$id."'");
        $logData = $this->Crud_model->GetData("invoice_wo_gst_log","","invoice_id='".$id."'");
        $customerData = $this->Crud_model->get_single('customer_master',"id='".$invoiceData->customer_id."'");
        $countd = count($logData);
        $data2=array(
            'invoiceData' =>$invoiceData,
            'logData' =>$logData,
            'customerData' =>$customerData,
            'countd' =>$countd,
            );

        return $this->load->view('invoice/invoice_pdf',$data2,true);
    }

    public function Openpdf($id)
    {
        $invoice = $this->Crud_model->get_single('invoice_wo',"id='".$id."'");
        $customer = $this->Crud_model->get_single('customer_master',"id='".$invoice->customer_id."'");
        $flag="pdf";
        $body_pdf = $this->create_print_pdf($id);
        $pnlname = date('d-m-Y'); 
        $rand=rand(0000,9999);
        $pnlname1 = date('d-m-Y').'_'.time(); 
        $fileName = '/uploads/invoice/'.$pnlname.'_wpes_'.$rand.'.pdf';

        $file = getcwd().$fileName;
        $pdfFilePath = $file;
        $this->load->library('m_pdf');
        ///////////////////////////WATERMARK CODE//////////////////////////////////////////////////
        $mpdf=new mPDF('c'); 
            
          $mpdf->SetDisplayMode('fullpage');
          $mpdf->SetWatermarkText('World Planet e-Solutions');
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
            $mpdf->defaultfooterline = 0;   /* 1 to include line below header/above footer */
            $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','O');    /* defines footer for Odd and Even Pages - placed at Outer margin */
            $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','E');    /* defines footer for Odd and Even Pages - placed at Outer margin */
            $body =  $mpdf->WriteHTML($body_pdf);
            // print_r($body);exit;
            $mpdf->SetDisplayMode('fullpage');
            //download it D save F.
            fopen($pdfFilePath,'wb');
            $mpdf->Output($pdfFilePath, "D");
            $mpdf->Output($pdfFilePath, "F");

        
        $attachment = base_url().$fileName;  
        $subject1="Invoice";
        // $body1=$mail_body->mail_body;
        $sendCustomerEmail=$customer->email;
        $res= $this->custom->sendEmailSmtp_web($subject1,"",$sendCustomerEmail,$attachment);
        $this->session->set_flashdata('message', 'Mail send successfully');
        redirect(site_url('Quotation'));
    }
}