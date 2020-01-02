<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  
  public function index()
  {
    $row = $this->Crud_model->GetData('settings','','','','','','1');
   
   	$data = array(
      'heading'=>'Manage Settings',
      'button'=>'Update',
       'id'=>$row->id,
      'site_name' =>$row->site_name,
      'mobile' =>$row->mobile,
      'email' =>$row->email,
      'alternate_mobile' =>$row->alternate_mobile,
      'alternate_email' =>$row->alternate_email,
      'copyright' =>$row->copyright,
      'logo' =>$row->logo,
      'address' =>$row->address,
      'favicon' =>$row->favicon,
      'terms_and_condition' =>$row->terms_and_condition,
      'account_no' =>$row->account_no,
      'ifsc_code' =>$row->ifsc_code,
      'gst_no' =>$row->gst_no,
      'pan_no' =>$row->pan_no,
      'action'=>site_url('Settings/update_action'),
      'heading'=>'Manage Settings',
     ); 
    $this->load->view('settings/form',$data);
  }
public function update_action()
{
        if($_FILES['logo']['name']!='')
        {
            $_POST['logo']= rand(0000,9999)."_".$_FILES['logo']['name'];
            $config2['image_library'] = 'gd2';
            $config2['source_image'] =  $_FILES['logo']['tmp_name'];
            $config2['new_image'] =   getcwd().'/uploads/logo/'.$_POST['logo'];
            $config2['allowed_types'] = 'JPG|PNG|jpg|png|gif|GIF|JPEG|jpeg';
            
            $config2['maintain_ratio'] = FALSE;
       
            $this->image_lib->initialize($config2);
            if(!$this->image_lib->resize())
            {
                $this->session->set_flashdata('image_error', 'This file type is not allowed');
                $this->index();
                return;
            }
           else
            {
                
                 unlink('uploads/logo/'.$_POST['old']);
                 $logo  = $_POST['logo'];
            }
        }
        else
        {
           $logo  = $_POST['old'];
        }
        if($_FILES['favicon']['name']!='')
        {
            $_POST['favicon']= rand(0000,9999)."_".$_FILES['favicon']['name'];
            $config2['image_library'] = 'gd2';
            $config2['source_image'] =  $_FILES['favicon']['tmp_name'];
            $config2['new_image'] =   getcwd().'/uploads/logo/'.$_POST['favicon'];
            $config2['allowed_types'] = 'JPG|PNG|jpg|png|gif|GIF|JPEG|jpeg|ico';
            $config2['width'] = '16px';
            $config2['height'] = '16px';
            $config2['maintain_ratio'] = FALSE;
       
            $this->image_lib->initialize($config2);
            if(!$this->image_lib->resize())
            {
                $this->session->set_flashdata('image_error', 'This file type is not allowed');
                $this->index();
                return;
            }
           else
            {
                 unlink('uploads/logo/'.$_POST['old_favicon']);
                 $favicon  = $_POST['favicon'];
            }
        }
        else
        {
           $favicon  = $_POST['old_favicon'];
        }
        
    $data = array(
          'site_name' => ucwords($this->input->post('site_name')),
          'mobile' => $this->input->post('mobile'),
          'email' => $this->input->post('email'),
          'copyright' => $this->input->post('copyright'),
          'address' => $this->input->post('address'),
          'alternate_mobile' => $this->input->post('alternate_mobile'),
          'alternate_email' => $this->input->post('alternate_email'),
          'terms_and_condition' => $this->input->post('terms_and_condition'),
          'account_no' => $this->input->post('account_no'),
          'ifsc_code' => $this->input->post('ifsc_code'),
          'gst_no' => $this->input->post('gst_no'),
          'pan_no' => $this->input->post('pan_no'),
          'logo' => $logo,
          'favicon' => $favicon,
          'extra_pincode_charges' => $this->input->post('extra_pincode_charges'),
          'modified' => date("Y-m-d h:i:s"),
      );  
    $id=$this->input->post('id');
    $this->Crud_model->SaveData("settings",$data,"id='".$id."'");   
  
    $this->session->set_flashdata('message', 'Settings has been updated successfully');
    redirect('Settings/index');
}

}
