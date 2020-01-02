<?php

  defined('BASEPATH') OR exit('No direct script access allowed');
  error_reporting(0);
  class Requirement extends CI_Controller {

    
  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Requirement_model');
    $this->load->library(array('session','form_validation','image_lib','Custom','email','m_pdf'));
    $this->load->helper("file");
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Requirement',
        'createAction'=>site_url('Requirement/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('Requirement/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
      if($_SESSION['SESSION_NAME']['designation']=='admin')
      {
          
          $cond="i.id<>";
        
      }
      else
      {
      $cond="i.employee_name='".$_SESSION['SESSION_NAME']['id']."'";
      }
        $getAllData = $this->Requirement_model->get_datatables($cond);
        
      //print_r($this->db->last_query());exit;
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            $btn = anchor(site_url('Requirement/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Requirement/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash-o"></i></span>';

            $btn .=" | ".anchor(site_url('Requirement/create_print/'.$row->id),'<button title="Print" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-print"></i></button>');
            $btn .=" | ".anchor(site_url('Requirement/Openpdf/'.$row->id),'<button title="Download Pdf" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-download" aria-hidden="true"></i></button>');

            $status='';            
            if($row->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }  
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $row->requirement_no;
            $nestedData[] = $row->business_name;
            $nestedData[] = $row->owner_name;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Requirement_model->count_all($cond),
                    "recordsFiltered" => $this->Requirement_model->count_filtered($cond),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {
    $header = array('page_title'=>'WPES'); 
   
    $getemployee = $this->Crud_model->GetData("admin","name,id","","","","","");
   
    $data = array('heading'=>'Add Requirement',
      'subheading'=>'Create Requirement',
      'button'=>'Create',
              'action'=>site_url('Requirement/create_action'),
              'business_name' =>set_value('business_name'),
              'owner_name' =>set_value('owner_name'),
              'address' =>set_value('address'),
              'contact_info' =>set_value('contact_info'),
              'alter_info' =>set_value('alter_info'),
              'pan_number' =>set_value('pan_number'),
              'gst_number' =>set_value('gst_number'),
              'product_desc_number' =>set_value('product_desc_number'),
              'logo' =>set_value('logo'),
              'domain_name' =>set_value('domain_name'),
              'required_tab' =>set_value('required_tab'),
              'content' =>set_value('content'),
              'social_link' =>set_value('social_link'),
              'admin' =>set_value('admin'),
              'order_date' =>set_value('order_date'),
              'expected_date' =>set_value('expected_date'),
              'referred' =>set_value('referred'),
              'id' =>set_value('id'),
              'total_payment' =>set_value('total_payment'),
              'advance_payment' =>set_value('advance_payment'),
              'balance_payment' =>set_value('balance_payment'),
              'employee_name' =>$getemployee,
              'session_id' =>$_SESSION['SESSION_NAME']['id'],
    );
   // print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('Requirement/form',$data);
       
  }
  public function create_action()
  {
    $row = $this->Crud_model->GetData("requirement","requirement_no","","","requirement_no desc","1","1");
    if (!empty($row->requirement_no)) 
    {
      $last_req_no =$row->requirement_no;
      $inc_req_no = $last_req_no+1;
    }
    else
    {
     $inc_req_no=2000;
    }
    
    
    $order = date('Y-m-d', strtotime($_POST['order_date']));
    $expected = date('Y-m-d', strtotime($_POST['expected_date']));
    //print_r($_POST['employee']);exit;
    $data=array(
        'employee_name' => $_SESSION['SESSION_NAME']['id'],
        'business_name' => $_POST['business_name'],
        'owner_name' => $_POST['owner_name'],
        'address' => $_POST['address'],
        'contact_info' => $_POST['contact_info'],
        'contact_info' => $_POST['contact_info'],
        'alter_info' => $_POST['alter_info'],
        'pan_number' => $_POST['pan_number'],
        'gst_number' => $_POST['gst_number'],
        'product_desc_number' => $_POST['product_desc_number'],
        'logo' => $_POST['logo'],
        'domain_name' => $_POST['domain_name'],
        'required_tab' => $_POST['required_tab'],
        'content' => $_POST['content'],
        'social_link' => $_POST['social_link'],
        'admin' => $_POST['admin'],
        'order_date' => $order,
        'expected_date' => $expected,
        'referred' => $_POST['referred'],
        'created'=>date('Y-m-d H:i:s'),
        'requirement_no'=>$inc_req_no,
        'total_payment' => $_POST['total_payment'],
        'advance_payment' => $_POST['advance_payment'],
        'balance_payment' => $_POST['balance_payment'],
        'product_name' => $_POST['product_name'],
        'mode_of_payment' => $_POST['mode_of_payment'],
        'gstadd' => $_POST['gstadd'],
        'total_payment_gst' => $_POST['total_payment_gst'],
    );
    $this->Crud_model->SaveData('requirement',$data);
    $this->session->set_flashdata('message', 'Client Requirement created successfully');
    redirect("Requirement");
  }
  public function update($id)
   {
      $header = array('page_title'=>'WPES'); 
      $getemployee = $this->Crud_model->GetData("admin","name,id","","","","","");
      $redata = $this->Crud_model->get_single("requirement","id='".$id."'");
     // print_r($getemployee);exit; 
      $data = array(
                'heading' => 'Update Requirement',
                'subheading' => 'Update Requirement',
                'button' => 'Update',
                'action' => site_url('Requirement/update_action/'.$id),
                'employee_name' =>$getemployee,
                'business_name' => $redata->business_name,
                'owner_name' => $redata->owner_name,
                'address' => $redata->address,
                'contact_info' => $redata->contact_info,
                'alter_info' => $redata->alter_info,
                'pan_number' => $redata->pan_number,
                'gst_number' => $redata->gst_number,
                'product_desc_number' => $redata->product_desc_number,
                'logo' => $redata->logo,
                'domain_name' => $redata->domain_name,
                'required_tab' => $redata->required_tab,
                'content' => $redata->content,
                'social_link' => $redata->social_link,
                'admin' => $redata->admin,
                'order_date' => $redata->order_date,
                'expected_date' => $redata->expected_date,
                'referred' => $redata->referred,
                'total_payment' => $redata->total_payment,
                'advance_payment' => $redata->advance_payment,
                'balance_payment' => $redata->balance_payment,
                'employee_id' => $redata->employee_name,
                'product_name' => $redata->product_name,
                'mode_of_payment' => $redata->mode_of_payment,
                'gstadd' => $redata->gstadd,
                'total_payment_gst' => $redata->total_payment_gst,
                'id' =>$id,
                'session_id' =>$_SESSION['SESSION_NAME']['id'],
                
      );
     //print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('Requirement/form',$data);
         
    }
  public function update_action($id)
    {
      $order = date('Y-m-d', strtotime($_POST['order_date']));
      $expected = date('Y-m-d', strtotime($_POST['expected_date']));
      //print_r($_POST['admin']);exit;
      $data=array(
        
        'business_name' => $_POST['business_name'],
        'owner_name' => $_POST['owner_name'],
        'address' => $_POST['address'],
        'contact_info' => $_POST['contact_info'],
        'contact_info' => $_POST['contact_info'],
        'alter_info' => $_POST['alter_info'],
        'pan_number' => $_POST['pan_number'],
        'gst_number' => $_POST['gst_number'],
        'product_desc_number' => $_POST['product_desc_number'],
        'logo' => $_POST['logo'],
        'domain_name' => $_POST['domain_name'],
        'required_tab' => $_POST['required_tab'],
        'content' => $_POST['content'],
        'social_link' => $_POST['social_link'],
        'admin' => $_POST['admin'],
        'order_date' => $order,
        'expected_date' => $expected,
        'referred' => $_POST['referred'],
        'total_payment' => $_POST['total_payment'],
        'advance_payment' => $_POST['advance_payment'],
        'balance_payment' => $_POST['balance_payment'],
        'product_name' => $_POST['product_name'],
        'mode_of_payment' => $_POST['mode_of_payment'],
        'gstadd' => $_POST['gstadd'],
        'total_payment_gst' => $_POST['total_payment_gst'],
        'modified'=>date('Y-m-d H:i:s'),
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('requirement',$data,"id='".$id."'");
      $this->session->set_flashdata('message', 'Client Requirement updated successfully');
      redirect("Requirement");
    }

    	public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("requirement",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('requirement',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
    }
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $reqdata = $this->Crud_model->get_single("requirement","id='".$id."'");
       // print_r($reqdata);exit;
        $data =array(
          'requirement_no'=>$reqdata->requirement_no,
          'business_name'=>$reqdata->business_name,
          'owner_name'=>$reqdata->owner_name,
          'address'=>$reqdata->address,
          'contact_info'=>$reqdata->contact_info,
          'alter_info'=>$reqdata->alter_info,
          'pan_number'=>$reqdata->pan_number,
          'gst_number'=>$reqdata->gst_number,
          'product_desc_number'=>$reqdata->product_desc_number,
          'logo'=>$reqdata->logo,
          'domain_name'=>$reqdata->domain_name,
          'required_tab'=>$reqdata->required_tab,
          'content'=>$reqdata->content,
          'social_link'=>$reqdata->social_link,
          'admin'=>$reqdata->admin,
          'order_date'=>$reqdata->order_date,
          'expected_date'=>$reqdata->expected_date,
          'referred'=>$reqdata->referred,
          'total_payment'=>$reqdata->total_payment,
          'advance_payment'=>$reqdata->advance_payment,
          'balance_payment'=>$reqdata->balance_payment,
          'product_name'=>$reqdata->product_name,
          'mode_of_payment'=>$reqdata->mode_of_payment,
          'gstadd'=>$reqdata->gstadd,
          'total_payment_gst'=>$reqdata->total_payment_gst,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Requirement/view',$data);
        $this->load->view('common/footer'); 

    }
    public function  create_print($id)
    {
      $reqdata = $this->Crud_model->get_single("requirement","id='".$id."'");
       $data =array(
          'requirement_no'=>$reqdata->requirement_no,
          'business_name'=>$reqdata->business_name,
          'owner_name'=>$reqdata->owner_name,
          'address'=>$reqdata->address,
          'contact_info'=>$reqdata->contact_info,
          'alter_info'=>$reqdata->alter_info,
          'pan_number'=>$reqdata->pan_number,
          'gst_number'=>$reqdata->gst_number,
          'product_desc_number'=>$reqdata->product_desc_number,
          'logo'=>$reqdata->logo,
          'domain_name'=>$reqdata->domain_name,
          'required_tab'=>$reqdata->required_tab,
          'content'=>$reqdata->content,
          'social_link'=>$reqdata->social_link,
          'admin'=>$reqdata->admin,
          'order_date'=>$reqdata->order_date,
          'expected_date'=>$reqdata->expected_date,
          'referred'=>$reqdata->referred,
          'total_payment'=>$reqdata->total_payment,
          'advance_payment'=>$reqdata->advance_payment,
          'balance_payment'=>$reqdata->balance_payment,
          'product_name'=>$reqdata->product_name,
          'mode_of_payment'=>$reqdata->mode_of_payment,
          'gstadd'=>$reqdata->gstadd,
          'total_payment_gst'=>$reqdata->total_payment_gst,
        );
      $this->load->view('Requirement/requirement_print',$data);
    }   
    public function create_print_pdf($id)
    {   
        $reqdata = $this->Crud_model->get_single("requirement","id='".$id."'");
      
        $data2=array(
          'requirement_no'=>$reqdata->requirement_no,
          'business_name'=>$reqdata->business_name,
          'owner_name'=>$reqdata->owner_name,
          'address'=>$reqdata->address,
          'contact_info'=>$reqdata->contact_info,
          'alter_info'=>$reqdata->alter_info,
          'pan_number'=>$reqdata->pan_number,
          'gst_number'=>$reqdata->gst_number,
          'product_desc_number'=>$reqdata->product_desc_number,
          'logo'=>$reqdata->logo,
          'domain_name'=>$reqdata->domain_name,
          'required_tab'=>$reqdata->required_tab,
          'content'=>$reqdata->content,
          'social_link'=>$reqdata->social_link,
          'admin'=>$reqdata->admin,
          'order_date'=>$reqdata->order_date,
          'expected_date'=>$reqdata->expected_date,
          'referred'=>$reqdata->referred,
          'total_payment'=>$reqdata->total_payment,
          'advance_payment'=>$reqdata->advance_payment,
          'balance_payment'=>$reqdata->balance_payment,
          'product_name'=>$reqdata->product_name,
          'mode_of_payment'=>$reqdata->mode_of_payment,
          'gstadd'=>$reqdata->gstadd,
          'total_payment_gst'=>$reqdata->total_payment_gst,
          );

        return $this->load->view('Requirement/requirement_pdf',$data2,true);
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

              

        redirect(site_url('Requirement'));
    }
}
?>