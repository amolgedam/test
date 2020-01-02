<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  
  public function index()
  {

     $id=$_SESSION['SESSION_NAME']['id'];

    $row = $this->Crud_model->GetData('admin','',"id='".$id."'",'','','','1');
   //print_r($row); exit;
 
    $doc = $this->Crud_model->GetData('document','',"admin_id='".$row->id."'",'','','','1');

    $designation = $this->Crud_model->GetData('designation','',"id='".$row->designation_id."'",'','','','1');

if(!empty($row))
    {
        $profile=$row->profile;
   }
   else 
   {
      $profile="";
   }
    if(!empty($doc))
    {
        $adhar=$doc->adhar;
        $degree=$doc->degree;
        $pan=$doc->pan;
        $final=$doc->final;
        $experience_cer=$doc->experience_cer;
        $relieving_cer=$doc->relieving_cer;
        $payment_slip=$doc->payment_slip;
        $final_marksheet=$doc->final_marksheet;
        $final_degree=$doc->final_degree;
        $final_adhar=$doc->final_adhar;
        $final_pan=$doc->final_pan;
    }
    else
    {
      $adhar="";
      $degree="";
      $final="";
      $pan="";
      $experience_cer="";
      $relieving_cer="";
      $payment_slip="";
      $final_marksheet="";
      $final_degree="";
      $final_adhar="";
      $final_pan="";
    }
  
   
   	$data = array(
      'heading'=>'Manage Settings',
      'button'=>'Update',
      'action'=>site_url('Profile/update_profile'),
      'action1'=>site_url('Profile/update_bank'),
      'action2'=>site_url('Profile/document_details'),
       'id'=>$row->id,
      'name' =>$row->name,
     'profile' =>$profile,
      'mobile_no' =>$row->mobile_no,
      'email' =>$row->email,
      'password' =>$row->show_password,
      'birthday' =>$row->birthday,
      'designation_name' =>$designation->designation_name,
      'email' =>$row->email,
      'salary' =>$row->salary,
      'joining_date' =>$row->joining_date,
      'address' =>$row->address,
      'account' =>$row->account,
      'bank_name' =>$row->bank_name,
      'ifsc' =>$row->ifsc,
     'doc' =>$doc,
      'adhar' =>$adhar,
      'final' =>$final,
      'degree' =>$degree,
      'pan' =>$pan,
      'experience_cer' =>$experience_cer,
      'relieving_cer' =>$relieving_cer,
      'payment_slip' =>$payment_slip,
      'final_marksheet' =>$final_marksheet,
      'final_degree' =>$final_degree,
      'final_adhar' =>$final_adhar,
      'final_pan' =>$final_pan,
    
      'heading'=>'Manage Profile',
     ); 
 //print_r($data); exit;
    $this->load->view('profile/form',$data);
  }
public function update_profile()
{
//print_r($_FILES); exit;
      $id=$_SESSION['SESSION_NAME']['id'];
 
if($_FILES['profile']['name']!='')
            {
                  $_POST['profile']= rand(0000,9999)."_".$_FILES['profile']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['profile']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/document/'.$_POST['profile'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
             
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  {
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else
                  { 
                    $profile  = $_POST['profile']; 
                  }
            }
            else
            {
               $profile= $_POST['profile_old'];
            }


  $data_profile = array(
        'name' => ucwords($this->input->post('name')),
        'profile' =>$profile,
        'mobile_no' => $this->input->post('mobile_no'),
        'email' => $this->input->post('email'),
        'password' => md5($this->input->post('password')),
        'show_password' => $this->input->post('password'),
        'designation_name' => $this->input->post('designation_name'),
        'birthday' => $this->input->post('birthday'),
        'address' => $this->input->post('address'),
        'salary' => $this->input->post('salary'),
        'joining_date' => $this->input->post('joining_date'),
        'id' => $this->input->post('id'),
        'modified' => date("Y-m-d h:i:s"), 

      );  
//print_r($data_profile); exit();
    $this->Crud_model->SaveData("admin",$data_profile,"id='".$id."'");   
    $this->session->set_flashdata('message', 'Profile has been updated successfully');
    redirect(site_url('Profile/index'));
}


public function update_bank()
{
      $id=$_SESSION['SESSION_NAME']['id'];
        $data1 = array(
          'button'=>'Update',
          'bank_name' => $this->input->post('bank_name'),
          'account' => $this->input->post('account'),
          'ifsc' => $this->input->post('ifsc'),
          'modified' => date("Y-m-d h:i:s"), 

      );  

    $this->Crud_model->SaveData("admin",$data1,"id='".$id."'");   
    $this->session->set_flashdata('message', 'Bank Detail has been updated successfully');
    redirect('Profile/index');
}


public function document_detail()
 {
 $id=$_SESSION['SESSION_NAME']['id'];
    // print_r($id); exit;
    //$row = $this->Crud_model->GetData('admin','',"id='".$id."'",'','','','1');
    $admin_id = $this->Crud_model->GetData('admin','',"",'','','','1');
    $row = $this->Crud_model->GetData('document','','','','','','1'); 

    $data2 = array( 
              'button'=>'Create',
              'action2'=>site_url('Profile/document_details'),
            
              'final' =>set_value('final'), 
              'degree' =>set_value('degree'), 
              'adhar' =>set_value('adhar'), 
              'pan' =>set_value('pan'), 
              'experience' =>set_value('experience'), 
              'experience_cer' =>set_value('experience_cer'), 
              'experience_cer' =>set_value('experience_cer'), 
              'relieving_cer' =>set_value('relieving_cer'), 
              'payment_slip' =>set_value('payment_slip'), 
              'final_marksheet' =>set_value('final_marksheet'), 
              'final_degree' =>set_value('final_degree'), 
              'final_adhar' =>set_value('final_adhar'), 
              'final_pan' =>set_value('final_pan'), 
             'id' =>set_value('id'),
            
    );
  
    $this->load->view('profile/form',$data);
       
  }

  public function document_details()
  {
    $id=$_SESSION['SESSION_NAME']['id'];
    $admin_id = $this->Crud_model->GetData('document','',"admin_id='".$id."'",'','','','1');

     if($_FILES['final']['name']!='')
            {
                  $_POST['final']= rand(0000,9999)."_".$_FILES['final']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['final']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/document/'.$_POST['final'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
             
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  {
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else
                  { 
                    $final  = $_POST['final']; 
                  }
            }
            else
            {
               $final= $_POST['final_old'];
            }

             if($_FILES['degree']['name']!='')
            {
                  $_POST['degree']= rand(0000,9999)."_".$_FILES['degree']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['degree']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/document/'.$_POST['degree'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
             
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  {
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else
                  { 
                    $degree  = $_POST['degree']; 
                  }
            }
            else
            {
               $degree = $_POST['degree_old'];
            }

              if($_FILES['adhar']['name']!='')
            {
                  $_POST['adhar']= rand(0000,9999)."_".$_FILES['adhar']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['adhar']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/document/'.$_POST['adhar'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
             
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  {
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else
                  { 
                    $adhar  = $_POST['adhar']; 
                  }
            }
            else
            {
               $adhar=$_POST['adhar_old'];
            }

              if($_FILES['relieving_cer']['name']!='')
            {
                  $_POST['relieving_cer']= rand(0000,9999)."_".$_FILES['relieving_cer']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['relieving_cer']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/document/'.$_POST['relieving_cer'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
             
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  {
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else
                  { 
                    $relieving_cer  = $_POST['relieving_cer']; 
                  }
            }
            else
            {
               $relieving_cer=$_POST['relieving_cer_old'];
            }




              if($_FILES['experience_cer']['name']!='')
            {
                  $_POST['experience_cer']= rand(0000,9999)."_".$_FILES['experience_cer']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['experience_cer']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/document/'.$_POST['experience_cer'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
             
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  {
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else
                  { 
                    $experience_cer  = $_POST['experience_cer']; 
                  }
            }
            else
            {
               $experience_cer=$_POST['experience_cer_old'];
            }




              if($_FILES['pan']['name']!='')
            {
                  $_POST['pan']= rand(0000,9999)."_".$_FILES['pan']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['pan']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/document/'.$_POST['pan'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
             
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  {
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else
                  { 
                    $pan  = $_POST['pan']; 
                  }
            }
            else
            {
               $pan=$_POST['pan_old']; 
            }
   
            if($_FILES['payment_slip']['name']!='')
            {
                  $_POST['payment_slip']= rand(0000,9999)."_".$_FILES['payment_slip']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['payment_slip']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/document/'.$_POST['payment_slip'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
             
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  {
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else
                  { 
                    $payment_slip  = $_POST['payment_slip']; 
                  }
            }
            else
            {
               $payment_slip=""; 
            }

if($_FILES['final_marksheet']['name']!='')
            {
                  $_POST['final_marksheet']= rand(0000,9999)."_".$_FILES['final_marksheet']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['final_marksheet']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/document/'.$_POST['final_marksheet'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
             
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  {
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else
                  { 
                    $final_marksheet  = $_POST['final_marksheet']; 
                  }
            }
            else
            {
               $final_marksheet='';
            }


if($_FILES['final_adhar']['name']!='')
            {
                  $_POST['final_adhar']= rand(0000,9999)."_".$_FILES['final_adhar']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['final_adhar']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/document/'.$_POST['final_adhar'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
             
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  {
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else
                  { 
                    $final_adhar  = $_POST['final_adhar']; 
                  }
            }
            else
            {
               $final_adhar='';
            }

            if($_FILES['final_pan']['name']!='')
            {
                  $_POST['final_pan']= rand(0000,9999)."_".$_FILES['final_pan']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['final_pan']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/document/'.$_POST['final_pan'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
             
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  {
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else
                  { 
                    $final_pan  = $_POST['final_pan']; 
                  }
            }
            else
            {
               $final_pan='';
            }



          $data = array(
          'admin_id' =>$id, 
          'final' =>$final, 
        'degree' =>$degree, 
        'candidate_type' =>$this->input->post('experience'), 
          'adhar' =>$adhar, 
          'pan' =>$pan, 
          'experience_cer' =>$experience_cer, 
          'relieving_cer' =>$relieving_cer, 
         'payment_slip' =>$payment_slip, 
          'final_marksheet' =>$final_marksheet, 
          'final_adhar' =>$final_adhar, 
          'final_pan' =>$final_pan, 
        
        );

 
      
     if(empty($admin_id))
     {
         $this->Crud_model->SaveData("document",$data);   
     }
     else
     {
      $this->Crud_model->SaveData("document",$data,"admin_id='".$id."'");   
     }
         $this->session->set_flashdata('message', 'Document has been updated successfully');
         redirect('Profile/index');

       
      }
  

}
