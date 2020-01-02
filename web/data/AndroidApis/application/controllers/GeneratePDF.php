<?php

  defined('BASEPATH') OR exit('No direct script access allowed');
  error_reporting(0);
  class GeneratePDF extends CI_Controller {

    function __construct()
    {

    parent::__construct();    
    $this->load->database();
    //$this->load->model('Affilation_center_model');
    $this->load->model('ManageCashOrder_model');
       // $this->load->model('Currency_city_model');
    $this->load->library(array('session','form_validation','image_lib'));

  }

   public function Invoice($id,$flag='')
    {  

         
        //print_r("expression");exit;
        $header = array('page_title'=>'Farmcartbiz.com');

        $cond="so.id='".$id."'";
        $getorderdata = $this->ManageCashOrder_model->get_orderdetails($cond);

        $setting = $this->Crud_model->GetData('settings');

       

        $condition ="sod.service_orders_id='".$id."'";
        $getorderdetails = $this->ManageCashOrder_model->get_orderdatadetails($condition);

           //print_r($getorderdetails);exit;

        $get_orderlog = $this->Crud_model->GetData('order_logs','',"customer_id='".$getorderdata->customer_id."' and orders_id='".$id."'");
   
       // print_r($getorderdetails);exit;

        $data =array(
                      'heading'=>"Manage ".$getorderdata->payment_type." Order View",
                      'total_product'=>$getorderdata->total_product,
                      'total_quantity'=>$getorderdata->total_quantity,
                      'final_amount'=>$getorderdata->final_amount,
                      'payment_status'=>$getorderdata->payment_status,
                      'order_no'=>$getorderdata->order_no,
                      'discount'=>$getorderdata->discount,
                      'booking_date'=>$getorderdata->booking_date,
                      'created'=>$getorderdata->created,
                      'payment_type'=>$getorderdata->payment_type,
                      'name'=>$getorderdata->u_name,
                      'email'=>$getorderdata->u_email,
                      'mobile'=>$getorderdata->u_mobile,
                      'address'=>$getorderdata->u_address,
                      'username'=>$getorderdata->u_name,
                      'order_status'=>$getorderdata->order_status,
                      'getorderdetails'=>$getorderdetails,
                      'customer_id'=>$getorderdata->customer_id,
                      'sub_total'=>$getorderdata->sub_total,
                      'extra_charges'=>$getorderdata->extra_charges,
                      'description'=>$getorderdata->description,
                      'reason'=>$getorderdata->reason,
                      'order_id'=>$id,
                      'get_orderlog'=>$get_orderlog,
                      'setting'=>$setting,
                      'id'=>$id,


                    );

         /* $this->load->view('common/header',$header);
          $this->load->view('common/left_panel');*/

          
        return $this->load->view('managecashorder/invoice',$data,true);
          

    }


   
    public function Openpdfss($id)
    {
      $flag="pdf";

      $callPDF  = array('pdf' => 'pdf', );
      $html = $this->Invoice($id,$flag);

      $rand=rand(0000,9999);
      $pnlname = date('d-m-Y'); 
      $fileName = '/uploads/documents/'.$pnlname.'_farm'.$rand.'.pdf';
      $file = getcwd().$fileName;
      $pdfFilePath = $file;
      $this->load->library('m_pdf');
      $this->m_pdf->pdf->WriteHTML($html);
      fopen($pdfFilePath,'wb');
      $this->m_pdf->pdf->Output($pdfFilePath, "D"); 
      @unlink($pdfFilePath); 

    }
  public function Openpdf($id)
  {

      
      $flag="pdf";

      $body_pdf = $this->Invoice($id,$flag);

      //print_r($body_pdf);exit;
      
      $pnlname = date('d-m-Y'); 
      $rand=rand(0000,9999);
      $pnlname1 = date('d-m-Y').'_'.time(); 
      $fileName = 'admin/uploads/documents/'.$pnlname.'_farm'.$rand.'.pdf';
      
      //print_r($fileName);exit;

      $file = getcwd().$fileName;
      $pdfFilePath = $file;



      $this->load->library('m_pdf');

      ///////////////////////////WATERMARK CODE//////////////////////////////////////////////////
      $mpdf=new mPDF('c'); 

      $mpdf->SetDisplayMode('fullpage');
      $mpdf->SetWatermarkText('Farmcartbiz');
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



      // $mpdf->Output('/document/'.$fileName.'.pdf', "F");
      $mpdf->Output($pdfFilePath, "D");

      //$attachment = base_url().$fileName;  

  }







}

?>