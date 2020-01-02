<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_GST extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Invoice_GST_model');
        $this->load->library(array('session','form_validation','image_lib','Custom','email'));
        $this->load->helper("file");   
    }
    public function index()
    {
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'GST Invoice Master',
            'create'=>site_url('Invoice_GST/create'),
            
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('invoice_gst/list',$data);
        
    }

    public function ajax_manage_page(){
        $invoiceData = $this->Invoice_GST_model->get_datatables();
       
    //   echo "<pre>"; print_r($invoiceData); exit;
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($invoiceData as $custData) 
        {
            
            $btn = anchor(site_url('Invoice_GST/View/'.$custData->id),'<button title="View" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye"></i></button>');
            
            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Invoice_GST/update/'.$custData->id),'<button title="Edit" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-edit"></i></button>');


            $btn .=" | ".anchor(site_url('Invoice_GST/create_print/'.$custData->id),'<button title="Print" class="btn btn-info btn-circle btn-sm"><i class="fa fa-print"></i></button>');
            
            $btn .=" | ".anchor(site_url('Invoice_GST/Openpdf/'.$custData->id),'<button title="Send Mails" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-envelope-o"></i></button>');

           
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
            
            $gst = $custData->gst_amt;
            $dis = $custData->discount;
            
            $amt = $custData->amount;
            
            $tot_amt = $amt+$gst;
            
            // $gstData = $this->Crud_model->GetData("invoice_gst_log","SUM('price') as t_p","invoice_id='".$custData->id."'");
            // echo "<pre>"; print_r($gstData); exit;
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $customer_name;
            $nestedData[] = $amt;
            $nestedData[] = $gst;
            $nestedData[] = $dis;
            $nestedData[] = $tot_amt;
            $nestedData[] = $status."<input type='hidden' id='status".$custData->id."' value='".$custData->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Invoice_GST_model->count_all(),
                    "recordsFiltered" => $this->Invoice_GST_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }

    public function create()
    {
        $cms = $this->Crud_model->get_single('cms',"slug='term-&-conditions'");
        $customer = $this->Crud_model->GetData('customer_master');
        $data = array(
                'terms'=>$cms->content,
                'customer' => $customer,
                'header' => 'Create Invoice',
                'header1' => 'Create Invoice',
                "actionUrl"=>site_url("Invoice_GST/create_invoice"),

                 );
        $this->load->view('invoice_gst/form',$data);
    }
    public function create_invoice()
    {   
        // echo "<pre>"; print_r($_POST); exit;
        
        $customer_id = $_POST['customer_name'];
        $itemCount = count($_POST['item']);
        $total_amount = 0;
        $amount = 0;
        $total_gst = 0;
        $total_discount = 0;
        
        for($i=0;$i<$itemCount;$i++)
        {
            $rate = $_POST['rate'][$i];
            $gst = intval($_POST['cgst'][$i])+intval($_POST['sgst'][$i]);
            $discountPer = $_POST['discount'][$i];
            
            $discount = $rate * $discountPer / 100;
            $tot = $rate - $discount;
            $gst_amt = $tot * $gst / 100;
            
            $amount += $rate;
            
            $total_discount += $discount;
            $total_gst += $gst;
            $tot_gstamt += $gst_amt;
            $total_amount += $tot+$tot_gstamt; 
            
            
            // $total_gst += intval($rate)*intval($gst)/100;
            // $total_discount += intval(intval($rate+intval($rate)*intval($gst)/100)*intval($discount)/100);
            // $total_amount += intval(intval($rate+intval($rate)*intval($gst)/100)- intval($rate+intval($rate)*intval($gst)/100)*intval($discount)/100);
        }
        
        $data = array(
                    'terms' =>$this->input->post('terms'),
                    'customer_id' =>$customer_id,
                    'amount' =>$amount,
                    // Rate - discount
                    'total_amount' =>$total_amount,
                    'discount' =>$total_discount,
                    'gst' =>$total_gst,
                    'gst_amt'=> $tot_gstamt,
                    'status' =>"Pending",
                    'created' =>date('Y-m-d H:i:s'),
        );
        
        // echo "<pre>"; print_r($data); exit;
        
        $this->Crud_model->SaveData('invoice_with',$data);
        $last_id = $this->db->insert_id();
        // $last_id = 1;
        
        
        for($i=0;$i<$itemCount;$i++)
        {
            $rate = $_POST['rate'][$i];
            $discountPer = $_POST['discount'][$i];
            
            $discount = $rate * $discountPer / 100;
            
            $amt = $rate - $discount;
            
            $cgst = $_POST['cgst'][$i];
            $sgst = $_POST['sgst'][$i];
            
            $cgst_value = intval($amt)*intval($cgst)/100;
            $sgst_value = intval($amt)*intval($sgst)/100;
            
            // $amount = intval($rate) + intval($cgst_value + $sgst_value);
            
            $discount_amount = intval($amount)*intval($discount)/100;
            $total_amount = intval($amount) - intval($discount_amount);
            
            $data1 = array(
                        'invoice_id' =>$last_id,
                        'customer_id' =>$customer_id,
                        'product_name' =>$_POST['item'][$i],
                        'des'=>$_POST['desc'][$i],
                        'unit' =>'1',
                        'price' =>$rate,
                        'amount' =>$amt,
                        'cgst' =>$cgst,
                        'sgst' =>$sgst,
                        'cgst_value' =>$cgst_value,
                        'sgst_value' =>$sgst_value,
                        'discount' =>$discountPer,
                        'discount_value' =>$discount,
                        'total_amount' =>$rate+$cgst_value+$sgst_value,
                        'created' =>date('Y-m-d H:i:s'),
            );
            
            // echo "<pre>"; print_r($data1);
            
            $this->Crud_model->SaveData('invoice_gst_log',$data1);
        }
        
        // exit;
        
        
        $this->session->set_flashdata('message', 'Product Sold.');
        
        $invoiceData = $this->Crud_model->get_single("invoice_with","id='".$last_id."'");
        $logData = $this->Crud_model->GetData("invoice_gst_log","","invoice_id='".$last_id."'");
        $customerData = $this->Crud_model->get_single('customer_master',"id='".$invoiceData->customer_id."'");
        $countd = count($logData);
        $data2=array(
            'invoiceData' =>$invoiceData,
            'logData' =>$logData,
            'customerData' =>$customerData,
            'countd' =>$countd,
            );
        $this->load->view('invoice_gst/invoice_gst_print',$data2);
    }
    
    public function update()
    { 
        $id = $this->uri->segment(3);
        // echo $id; exit();
        $cms = $this->Crud_model->get_single('cms',"slug='term-&-conditions'");
        $customer = $this->Crud_model->GetData('customer_master');

          //$customer = $this->Crud_model->GetData('invoice_with');
        $invoice_data = $this->Crud_model->GetData("invoice_with","","id='".$id."'",'','','','1'); 

        $invoice_gst_data = $this->Crud_model->GetData("invoice_gst_log","","invoice_id='".$invoice_data->id."'"); 

        $customer_data = $this->Crud_model->GetData("customer_master","","id='".$invoice_data->customer_id."'",'','','','1'); 

        $data = array(
                'terms'=>$cms->content,
                'customer' =>$customer,

                'customer_id' =>$invoice_data->customer_id,
                'customer_gst'=>$customer_data->gst_no,
                'customer_email'=>$customer_data->email,
                'customer_mobile'=>$customer_data->mobile_no,
                'customer_address'=>$customer_data->address,
                'invoice_gst_data'=>$invoice_gst_data,

                'header' => 'Create Invoice',
                'header1' => 'Create Invoice',
                "actionUrl"=>site_url("Invoice_GST/update_invoice"),
                'id' =>$id,
                 );

       // echo "<pre>"; print_r($invoice_gst_data); exit;
        $this->load->view('invoice_gst/form',$data);
    }


    public function update_invoice()
    {
        // echo "<pre>"; print_r($_POST);
        $customer_id = $_POST['customer_name'];
        $itemCount = count($_POST['item']);
        $total_amount = 0;
        $amount = 0;
        $total_gst = 0;
        $total_discount = 0;
        
        for($i=0;$i<$itemCount;$i++)
        {
            $rate = $_POST['rate'][$i];
            $gst = intval($_POST['cgst'][$i])+intval($_POST['sgst'][$i]);
            $discountPer = $_POST['discount'][$i];
            
            $discount = $rate * $discountPer / 100;
            $tot = $rate - $discount;
            $gst_amt = $tot * $gst / 100;
            
            $amount += $rate;
            // $total_amount += $tot; 
            $total_discount += $discount;
            $total_gst += $gst;
            $tot_gstamt += $gst_amt;

            $total_amount += $tot+$tot_gstamt; 

            
            
            // $total_gst += intval($rate)*intval($gst)/100;
            // $total_discount += intval(intval($rate+intval($rate)*intval($gst)/100)*intval($discount)/100);
            // $total_amount += intval(intval($rate+intval($rate)*intval($gst)/100)- intval($rate+intval($rate)*intval($gst)/100)*intval($discount)/100);
        }
        
        $data = array(
                    'terms' =>$this->input->post('terms'),
                    'customer_id' =>$customer_id,
                    'amount' =>$amount,
                    // Rate - discount
                    'total_amount' =>$total_amount,
                    'discount' =>$total_discount,
                    'gst' =>$total_gst,
                    'gst_amt'=> $tot_gstamt,
                    'status' =>"Pending",
                   
        );

        $id=$_POST['id'];
        $con="id='".$id."'";
        $this->Crud_model->SaveData('invoice_with',$data, $con);

        $this->Common_model->delete('invoice_gst_log',"invoice_id='".$id."'");
           
        for($i=0;$i<$itemCount;$i++)
        {
            $rate = $_POST['rate'][$i];
            $discountPer = $_POST['discount'][$i];
            
            $discount = $rate * $discountPer / 100;
            
            $amt = $rate - $discount;
            
            $cgst = $_POST['cgst'][$i];
            $sgst = $_POST['sgst'][$i];
            
            $cgst_value = intval($amt)*intval($cgst)/100;
            $sgst_value = intval($amt)*intval($sgst)/100;
            
            // $amount = intval($rate) + intval($cgst_value + $sgst_value);
            
            $discount_amount = intval($amount)*intval($discount)/100;
            $total_amount = intval($amount) - intval($discount_amount);
            
            $data1 = array(
                        'invoice_id' =>$id,
                        'customer_id' =>$customer_id,
                        'product_name' =>$_POST['item'][$i],
                        'des'=>$_POST['desc'][$i],
                        'unit' =>'1',
                        'price' =>$rate,
                        'amount' =>$amt,
                        'cgst' =>$cgst,
                        'sgst' =>$sgst,
                        'cgst_value' =>$cgst_value,
                        'sgst_value' =>$sgst_value,
                        'discount' =>$discountPer,
                        'discount_value' =>$discount,
                        'total_amount' =>$rate+$cgst_value+$sgst_value,
                        'created' =>date('Y-m-d H:i:s'),
            );
            
            // echo "<pre>"; print_r($data1);
            $this->Crud_model->SaveData('invoice_gst_log',$data1);
        }

// exit();

        $this->session->set_flashdata('message', 'Product Sold.');
        
        $invoiceData = $this->Crud_model->get_single("invoice_with","id='".$id."'");
        $logData = $this->Crud_model->GetData("invoice_gst_log","","invoice_id='".$id."'");
        $customerData = $this->Crud_model->get_single('customer_master',"id='".$invoiceData->customer_id."'");
        $countd = count($logData);
        $data2=array(
            'invoiceData' =>$invoiceData,
            'logData' =>$logData,
            'customerData' =>$customerData,
            'countd' =>$countd,
            );
        $this->load->view('invoice_gst/invoice_gst_print',$data2);
// echo $con;
// echo "<pre>"; print_r($data);
        // exit();
    }
    
    
    public function get_customer()
    {
        $id = $this->input->post('id');
        $customer = $this->Crud_model->get_single('customer_master',"status='Active' and id = '".$id."'");
        $data =array(
          'gst_no'=>$customer->gst_no,
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
            $this->Crud_model->SaveData("invoice_with",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $cond="id='".$id."'";
        $invoiceData = $this->Crud_model->get_single('invoice_with',$cond);
        $Getcustomerdata = $this->Crud_model->get_single("customer_master","id='".$invoiceData->customer_id."'");
        $getlogdata = $this->Crud_model->GetData("invoice_gst_log","","invoice_id='".$id."'");
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
        $this->load->view('invoice_gst/view_gst',$data);
        $this->load->view('common/footer'); 
    }

    public function create_print($id)
    {
        $invoiceData = $this->Crud_model->get_single("invoice_with","id='".$id."'");
        $logData = $this->Crud_model->GetData("invoice_gst_log","","invoice_id='".$id."'");
        $customerData = $this->Crud_model->get_single('customer_master',"id='".$invoiceData->customer_id."'");
        $countd = count($logData);
        $data2=array(
            'invoiceData' =>$invoiceData,
            'logData' =>$logData,
            'customerData' =>$customerData,
            'countd' =>$countd,
            );
        $this->load->view('invoice_gst/invoice_gst_print',$data2);
    }

    public function create_print_pdf($id)
    {   
        $invoiceData = $this->Crud_model->get_single("invoice_with","id='".$id."'");
        $logData = $this->Crud_model->GetData("invoice_gst_log","","invoice_id='".$id."'");
        $customerData = $this->Crud_model->get_single('customer_master',"id='".$invoiceData->customer_id."'");
        $countd = count($logData);
        $data2=array(
            'invoiceData' =>$invoiceData,
            'logData' =>$logData,
            'customerData' =>$customerData,
            'countd' =>$countd,
            );

        return $this->load->view('invoice_gst/gst_pdf',$data2,true);
    }

    public function Openpdf($id)
    {
        
        $flag="pdf";
        $body_pdf = $this->create_print_pdf($id);
        $pnlname = date('d-m-Y'); 
        $rand=rand(0000,9999);
        $pnlname1 = date('d-m-Y').'_'.time(); 
        $fileName = '/uploads/invoice_gst/'.$pnlname.'_wpes_'.$rand.'.pdf';

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
            $mpdf->SetDisplayMode('fullpage');
            //download it D save F.
            fopen($pdfFilePath,'wb');
            $mpdf->Output($pdfFilePath, "D");
            $mpdf->Output($pdfFilePath, "F");

        $invoice = $this->Crud_model->get_single('invoice_with',"id='".$id."'");
        $customer = $this->Crud_model->get_single('customer_master',"id='".$invoice->customer_id."'");
        $attachment = base_url().$fileName;  
        $subject1="Invoice";
        // $body1=$mail_body->mail_body;
        $sendCustomerEmail=$customer->email; 
        $res= $this->custom->sendEmailSmtp_web($subject1,"",$sendCustomerEmail,$attachment);
        $this->session->set_flashdata('message', 'Mail send successfully');
        redirect(site_url('Invoice_GST'));
    }
}