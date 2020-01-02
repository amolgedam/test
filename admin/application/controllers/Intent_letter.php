<?php

  defined('BASEPATH') OR exit('No direct script access allowed');
  error_reporting(0);
  class Intent_letter extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Intent_letter_model');
      $this->load->library(array('session','form_validation','image_lib','Custom','email'));
        $this->load->helper("file");
       
    }
    public function index()
  {
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Intent Letter',
        'createAction'=>site_url('Intent_letter/create'),
        'changeAction'=>site_url('Intent_letter/changeStatus'),
       'deleteAction'=>site_url('Intent_letter/delete'),
        
    );
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('Intent_letter/list',$data);
    $this->load->view('common/footer'); 
  }

 public function ajax_manage_page(){
     $letter = $this->Intent_letter_model->get_datatables();
    // print_r($letter); exit();
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($letter as $row) 
        {         

     $btn ='&nbsp;&nbsp;'.anchor(site_url('Intent_letter/view/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');
      $btn .='&nbsp;&nbsp;'.anchor(site_url('Intent_letter/update/'.$row->id),'<button title="Edit" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
       $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash-o"></i></span>';

  $btn .='&nbsp;&nbsp;'.anchor(site_url('Intent_letter/print/'.$row->id),'<button title="Print" class="btn btn-info btn-circle btn-xs"><i class="fa fa-print"></i></button>');

    $btn .='&nbsp;|&nbsp;'.anchor(site_url('Intent_letter/pdf_download/'.$row->id),'<button title="Pdf" class="btn btn-info btn-circle btn-xs"><i class="fa fa-file-pdf-o"></i></button>');
    
  $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Send Mail"  class="btn btn-success btn-circle btn-xs" data-toggle="modal" data-target="#mail" onclick="mail('.$row->id.')">
                                        <i class="fa fa-envelope"></i></span>';

            $status='';            
            if($row->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }  
           if(strlen($row->description)>100)
            {
              $desc=substr($row->description,0,100).'...';
            }
            else{
              $desc=$row->description;
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucfirst($row->name);
            $nestedData[] = $row->mobile;
            $nestedData[] = ucfirst($row->designation_name);
            $nestedData[] = $row->email;
            $nestedData[] = date('d-m-Y',strtotime($row->date));
             $nestedData[] = $desc;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Intent_letter_model->count_all(),
                    "recordsFiltered" => $this->Intent_letter_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }


 public function create()
 {
  $certificate=$this->Crud_model->GetData("certificates","description,id","certificate_type_id='7'","","","","1");
  $designation_name=$this->Crud_model->GetData("designation","","id!='4' and id!='5'","","","","");

    $header = array('page_title'=>'WPES');  
    $data = array('heading'=>'Add Intent Letter',
      'subheading'=>'Create Intent Letter',
      'button'=>'Create',
              'action'=>site_url('Intent_letter/create_action'),
             'name' =>set_value('name'),
             'mobile' =>set_value('mobile'),
             'email' =>set_value('email'),
             'date' =>set_value('date'),
             'designation_id' =>set_value('designation_id'),
             'address' =>set_value('address'),
             'certificate_id' =>set_value('certificate_id'),
              'id' =>set_value('id'),
            'description' =>$certificate->description,
            'designation_name' =>$designation_name,
    );
   
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('Intent_letter/form',$data);
       
  }

 public function create_action()
  {
   
    $data=array(
        'name' => $_POST['name'],
        'mobile' => $_POST['mobile'],
        'email' => $_POST['email'],
        'date' => date('Y-m-d',strtotime($_POST['date'])),
        'address' => $_POST['address'],
        'designation_id' => $_POST['designation_id'],
        'certificate_id' => $_POST['certificate_id'],
        'created'=>date('Y-m-d H:i:s'),
    );
    $this->Crud_model->SaveData('intent_letter',$data);
    $this->session->set_flashdata('message', 'Intent Letter created successfully');
    redirect("Intent_letter");
 
  }


  public function update($id)
   {
     $designation_name=$this->Crud_model->GetData("designation","","id!='4' and id!='5'","","","","");
      $intent_letter = $this->Crud_model->get_single("intent_letter","id='".$id."'"); 
      $header = array('page_title'=>'WPES'); 
     
      $data = array(
                'heading' => 'Update Intent Letter',
                'subheading' => 'Update Intent Letter',
                'button' => 'Update',
                'action' => site_url('Intent_letter/update_action/'.$id),
                'name' => $intent_letter->name,
               'designation_id' => $intent_letter->designation_id,
                'mobile' => $intent_letter->mobile,
                'email' => $intent_letter->email,
                'date' => date('Y-m-d',strtotime($intent_letter->date)),
                'address' => $intent_letter->address,
               'description' =>$intent_letter->certificate_id,
                'designation_name' => $designation_name,
              
                'id' =>$id,
      );
    
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('Intent_letter/form',$data);
         
    }

     public function update_action($id)
    {
      $id=$id;
     /* $this->_rules($id);
    if ($this->form_validation->run() == FALSE)
    {          
      $this->update($id);
    }
    else 
    {  */
      $data=array(
         'name' => $_POST['name'],
        'mobile' => $_POST['mobile'],
        'email' => $_POST['email'],
        'date' => date('Y-m-d',strtotime($_POST['date'])),
        'address' => $_POST['address'],
        'designation_id' => $_POST['designation_id'],
        'certificate_id' => $_POST['certificate_id'],
        'modified'=>date('Y-m-d H:i:s'),
      );
    
      $this->Crud_model->SaveData('intent_letter',$data,"id='".$id."'");
    /*}*/
      $this->session->set_flashdata('message', 'Intent Letter updated successfully');
      redirect("Intent_letter");

    }


public function print($id,$pdf='')
{
  $con="i.id='".$id."'";

  $certificate_name=$this->Crud_model->GetData('certificate_type',"","id='7'","","","","1");
  $settings=$this->Crud_model->GetData('settings',"","","","","","1");
  $intent=$this->Intent_letter_model->get_letter_data($con);
  
   $pdf_data =array(
            'title'=>$certificate_name->title,
            'certificate_id'=>$intent->certificate_id,
            'name'=>$intent->name,
            'address_1'=>$intent->address,
            'address'=>$settings->address,
            'mobile'=>$settings->mobile,
            'alternate_mobile'=>$settings->alternate_mobile,
            'logo'=>$settings->logo,
            'email'=>$settings->email,
        
            'head_office'=>$settings->head_office,
           'website'=>$settings->website,
          'designation_name'=>$intent->designation_name,
            'site_name'=>$settings->site_name,
     );
  
            if(!empty($pdf))
          {
           return $this->load->view('Intent_letter/print_letter/intent_letter',$pdf_data,true);
         }
         else
          {
            $this->load->view('Intent_letter/print_letter/intent_letter',$pdf_data);
          }
    
}

public function pdf_download($id)
{
    
     $settings=$this->Crud_model->GetData('settings',"","","","","","1");
    
        $pdf="pdf";
        $body_pdf = $this->print($id,$pdf);

         $pnlname = date('d-m-Y'); 
        $rand=rand(0000,9999);
        $pnlname1 = date('d-m-Y').'_'.time(); 
        $fileName = '/uploads/pdf_download/'.$pnlname.'_wpes_'.$rand.'.pdf';

        $file = getcwd().$fileName;
        $pdfFilePath = $file;
        $this->load->library('m_pdf');
        ///////////////////////////WATERMARK CODE//////////////////////////////////////////////////
        $mpdf=new mPDF('c'); 
          
          $mpdf->SetDisplayMode('fullpage');
          $mpdf->SetWatermarkText('World Planet Technologies Pvt. Ltd.');
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
            $mpdf->defaultfooterline = 1;       /* 1 to include line below header/above footer */
            $mpdf->SetHTMLFooter('<div style="text-align:center; background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;"> <strong> Head Office:</strong> '.$settings->head_office.'</div>','O'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $mpdf->SetHTMLFooter('<div style="text-align:center; background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;"> <strong> Head Office:</strong>'.$settings->head_office.'</div>','E'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $body =  $mpdf->WriteHTML($body_pdf);
            $mpdf->SetDisplayMode('fullpage');
            //download it D save F.
            fopen($pdfFilePath,'wb');
            $mpdf->Output($pdfFilePath, "D");
            $mpdf->Output($pdfFilePath, "F");        

       // redirect(site_url('Intent_letter'));

  
}

    public function send_mail()
   {
        $data=array('description'=>$_POST['description'],
    );
     $this->Crud_model->SaveData('intent_letter',$data,"id='".$_POST['id']."'");
       $settings=$this->Crud_model->GetData('settings',"","","","","","1");
       
        $id = $_POST['id'];
       
        $pdf="pdf";
        $body_pdf = $this->print($id,$pdf);
        
       
        $pnlname = date('d-m-Y'); 
        $rand=rand(0000,9999);
        $pnlname1 = date('d-m-Y').'_'.time(); 
        $fileName = '/uploads/pdf_download/'.$pnlname.'_wpes_'.$rand.'.pdf';

        $file = getcwd().$fileName;
        $pdfFilePath = $file;
        $this->load->library('m_pdf');
        ///////////////////////////WATERMARK CODE//////////////////////////////////////////////////
        $mpdf=new mPDF('c'); 
            
          $mpdf->SetDisplayMode('fullpage');
          $mpdf->SetWatermarkText('World Planet Technologies pvt.ltd.');
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
            $mpdf->SetHTMLFooter('<div style="text-align:center; background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;"> <strong> Head Office:</strong>'.$settings->head_office.'</div>','O'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $mpdf->SetHTMLFooter('<div style="text-align:center; background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;"> <strong> Head Office:</strong>'.$settings->head_office.'</div>','E'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $body =  $mpdf->WriteHTML($body_pdf);
        
            $mpdf->SetDisplayMode('fullpage');
            //download it D save F.
            fopen($pdfFilePath,'wb');
            // $mpdf->Output($pdfFilePath, "D");
            $mpdf->Output($pdfFilePath, "F");
        $attachment = base_url().$fileName;
 
	       if(!empty($_POST['id'])){
          $get_intent_letter=$this->Crud_model->GetData("intent_letter","","id='".$_POST['id']."' and status='Active'","","","","1");
         $email=$get_intent_letter->email;
      }
      else{
          $email="";
      }
	        
	        $subject = $this->input->post('subject');
	        $description = $this->input->post('description');
	        $from =$_POST['from_mail']; 

	        if(empty($subject))
	        {
	            $subject1="Intent Letter";
	        }
	        else{
	            $subject1 =  $subject;
	        }
	        if(empty($description))
	        {
	            $body1="...";
	        }
	        else
	        {
	            $body1 = $description;
	        }
              
        $sendCustomerEmail=$email; 

        $res= $this->custom->sendEmailSmtp_web($from,$subject1,$body1,$sendCustomerEmail,$attachment);
        $this->session->set_flashdata('message', 'Mail send successfully');
        redirect(site_url('Intent_letter'));

}

    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $con="i.id='".$id."'";
    
       $intent=$this->Intent_letter_model->get_letter_data($con);;
         
        $data =array(

            'name'=>$intent->name,
            'mobile'=>$intent->mobile,
            'email'=>$intent->email,
            'address'=>$intent->address,
          'designation_name'=>$intent->designation_name,
            'created'=>$intent->created,   
            'description'=>$intent->description,   
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Intent_letter/view',$data);
        $this->load->view('common/footer');
    }
public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("intent_letter",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('intent_letter',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
    }



}