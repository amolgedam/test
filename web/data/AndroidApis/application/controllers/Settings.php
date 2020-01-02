<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

  Public function __construct()
     {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('Settings_model');
         $this->load->library('upload');
        $this->load->library('image_lib');
     }
      

  public function index()
  {   
      $settingsData = $this->Common_model->get_data("settings");
      //$data = array('settingsData' => $settingsData , );

      $header = array('page_title'=> 'RemitOut');
        $data = array(
        'heading'=>'Setting',
        'createAction'=>site_url('Settings/create'),
        'changeAction'=>site_url('Settings/changeStatus'),
        'deleteAction'=>site_url('Settings/delete'),
        'settingsData' => $settingsData,
    );
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view("settings/list",$data);
      
       
  }

  /*public function update_setting()
  { 
    $id = $this->input->post('id');
    $value = $this->input->post('value');
    $data = array('details' => $value);
    $this->Common_model->SaveData('settings',$data,"id='".$id."'");
    $updata = $this->Common_model->get_single_record('settings',"id='".$id."'"); 
    echo $updata->details; exit;
  }*/


  public function ajax_manage_page()
    {
        $SettingsData = $this->Settings_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($SettingsData as $setting) 
        {
            

           
          $btn = '<span data-placement="right" title="Edit"  class="btn btn-primary btn-circle btn-xs"  onclick="show_modal('.$setting->id.')"><i class="fa fa-edit"></i></span>';


           
           $status='';            
            if($setting->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$setting->id.'"  onClick="statuss('.$setting->id.');" >'.$setting->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$setting->id.'"  onClick="statuss('.$setting->id.');" >'.$setting->status.'</span>';
            }
          
          if ($setting->extra_charge=='0') 
          {
            $value="-";
          }
          else
          {
            $value=$setting->extra_charge;
          }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($setting->title);
            $nestedData[] = ucwords($setting->details);
            $nestedData[] = $value;
            $nestedData[] = $status."<input type='hidden' id='status".$setting->id."' value='".$setting->status."' />";          
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Settings_model->count_all('countries'),
                    "recordsFiltered" => $this->Settings_model->count_filtered('countries'),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }


    public function showuserdata()
    {
      $getmessageData = $this->Crud_model->GetData('settings',"","id='".$_POST['id']."'",'','','1');
      //print_r($getmessageData);exit;

     if($getmessageData[0]->title == 'header_image' || $getmessageData[0]->title == 'footer_image')
      {
          $details = '<img src="'.base_url().'/uploads/settings/'.$getmessageData[0]->details.'" height="60px" width="100px">';

           $data = array(
          'id'=>$getmessageData[0]->id,
          'title'=>$getmessageData[0]->title,
          'details'=>$details,
          'old_image'=>$getmessageData[0]->details
          );

      }
     else if($getmessageData[0]->title == 'Logo')
      {
          $details = '<img src="'.base_url().'../assets/logo/'.$getmessageData[0]->details.'" height="60px" width="100px">';

           $data = array(
          'id'=>$getmessageData[0]->id,
          'title'=>$getmessageData[0]->title,
          'details'=>$details,
          'old_image'=>$getmessageData[0]->details
          );

      } 
     else if($getmessageData[0]->title == 'No Data Found Image')
      {
          $details = '<img src="'.base_url().'uploads/'.$getmessageData[0]->details.'" height="60px" width="100px">';

           $data = array(
          'id'=>$getmessageData[0]->id,
          'title'=>$getmessageData[0]->title,
          'details'=>$details,
          'old_image'=>$getmessageData[0]->details
          );

      }  
      else{

          $details = $getmessageData[0]->details;
           $data = array(
          'id'=>$getmessageData[0]->id,
          'title'=>$getmessageData[0]->title,
          'details'=>$details,
          'extra_charge'=>$getmessageData[0]->extra_charge,
          'old_image'=>'',
          );
      }
      //echo $details;exit;
    
      echo json_encode($data);exit;
      
    }


 
     /*public function changeStatus(){
       // print_r($_POST);exit();
        $getProject_tasks = $this->Crud_model->get_single('settings',"id='".$_POST['id']."'");

        if($getProject_tasks->status=='Active')
        {
            $this->Crud_model->SaveData('settings',array('status'=>'Inactive'),"id='".$_POST['id']."'");
        }
        else
        {
            $this->Crud_model->SaveData('settings',array('status'=>'Active'),"id='".$_POST['id']."'");
        }
        $this->session->set_flashdata('message', 'Status has been changed successfully');
        redirect(site_url('Settings'));
    }*/

public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("settings",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
    public function update_action()
    {

     // print_r($_POST);exit;

        

     if($_POST['description'] == '')
        {
             if( $_FILES['image']['name']!='' )
              {
                   $_POST['image_name']= rand(0000,9999)."_".$_FILES['image']['name'];

                  if($_POST['title'] == 'Logo')
                  {
                      $new_image = getcwd().'../../assets/logo/'.$_POST['image_name'];
                      $upload_path = getcwd().'../../assets/logo/';
                      $old_image = '../../assets/logo/'.$_POST['old_image_name'];
                  }
                   if($_POST['title'] == 'No Data Found Image')
                  {
                      $new_image = getcwd().'/uploads/'.$_POST['image_name'];
                      $upload_path = getcwd().'/uploads/';
                      $old_image = 'uploads/'.$_POST['old_image_name'];
                  }
                  else{
                      $new_image = getcwd().'/uploads/settings/'.$_POST['image_name'];
                      $upload_path = getcwd().'/uploads/settings/';
                      $old_image = 'uploads/settings/'.$_POST['old_image_name'];
                  }

                  //echo base_url()."".$old_image;exit;
                 
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   $new_image;
                  $config2['upload_path'] =  $upload_path;
                  $config2['allowed_types'] = 'JPG|PNG|jpg|png';
                  $config2['maintain_ratio'] = FALSE;

                 // print_r($config2);exit;
                  $this->image_lib->initialize($config2);
                
                  if(!$this->image_lib->resize())
                  {
                      echo('<pre>');
                      echo ($this->image_lib->display_errors());
                      exit;
                  }
                
                  $image = $_POST['image_name'];
                 
                 unlink($old_image);
               }else
               {
                 $image = "";
               }

           
              $details =  $image;
        }
        else{
            if($_POST['flag']=='flag')
            {
                $description= $this->input->post('description',TRUE);
               // print_r($details);exit;
                $exp = explode(":",$description);
                $hr = $exp[0];
                $minute = explode(" ",$exp[1]);
                $min = $minute[0];
                $details = $hr."".$min;
            }else{
                $details = $this->input->post('description',TRUE);
            }
        }

           // 

            $id = $this->input->post('id');
            $con="id='".$id."'";
            $data11 = array(
                        'details' => $details,
                        'extra_charge'=>$_POST['value'],
                        'modified'=> date('Y-m-d H:i:s'),
                    );
         // print_r($data11);exit;
            $this->Common_model->SaveData('settings',$data11,$con);
            //print_r($this->db->last_query());exit;
            $this->session->set_flashdata('message', 'Setting updated successfully');
            redirect(site_url('Settings/index'));
        
     
    }
      
     
  
  
  
  
}
