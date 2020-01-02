<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cms extends CI_Controller {
  function __construct()
  {
    parent::__construct();
    $this->load->model('Cms_model');
    $this->load->database();
  }
  public function index()
  {
    $data=array(
      'heading' => 'Manage Cms',
      'heading1' => 'Add Cms',
      'createAction' => site_url('Cms/create'),
     );
    $this->load->view('cms/list',$data);
}
public function ajax_manage_page()
{ 
  $getData = $this->Cms_model->get_datatables();
  $data = array();    
   if(empty($_POST['start']))
    {
      $no =0;   
    }
    else
    {
      $no =$_POST['start'];
    }
  foreach ($getData as $Data) 
  {    
      $btn =anchor(site_url('Cms/update/'.$Data->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');

     // $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete" class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$Data->id.')"><i class="fa fa-trash"></i></span>';
      $status='';            
      if($Data->status=='Active')
      {
        $status='<span class="btn btn-xs btn-success" id="statusVal'.$Data->id.'"  onClick="statuss('.$Data->id.');" >'.$Data->status.'</span>';
      }
      else
      {
        $status='<span class="btn btn-xs btn-danger" id="statusVal'.$Data->id.'"  onClick="statuss('.$Data->id.');" >'.$Data->status.'</span>';
      }
     $no++;
    $nestedData = array();
    $nestedData[] = $no;
    $nestedData[] = ucwords($Data->title);
    $nestedData[] = $status."<input type='hidden' id='status".$Data->id."' value='".$Data->status."' />";
    $nestedData[] = $btn;
    $data[] = $nestedData;
  }

  $condition="";
  $output = array(
    "draw" => $_POST['draw'],
    "recordsTotal" => $this->Cms_model->count_all('cms',$condition),
    "recordsFiltered" => $this->Cms_model->count_filtered('cms',$condition),
    "data" => $data,
  );
//output to json format
  echo json_encode($output);
}
public function change_status()
  {
    if(isset($_POST['statusupdate']))
    {
      $this->Crud_model->SaveData("cms",$_POST,"id='".$_POST['id']."'");exit;
    }
  }
  public function delete()
  {  
    if(isset($_POST['id']))
    { 
        $row = $this->Crud_model->GetData('cms','image',"id='".$_POST['id']."'",'','','','1');
        if(!empty($row))
        {  
          unlink('uploads/cms/'.$row->image);
        } 
        $this->Crud_model->DeleteData("cms","id='".$_POST['id']."'");exit();
    }
  } 
public function create()
{  

  $data = array(
    'header'=>'Create Cms',
    'heading'=>'Create Cms',
    'button'=>'Create',
    'canBtn'=>'Cancel',
    'actionUrl'=>site_url('Cms/create_action'),
    'back'=>site_url('Cms/index'),
    'title' =>set_value('title'),
    'content' =>set_value('content'),
    'slug' =>set_value('slug'),
    'id' =>set_value('id'),
    'image' =>set_value('image'),
  );
  $this->load->view('cms/form',$data);
}
public function create_action() 
{ 

  //print_r($_FILES);exit;
  $id = '0';
  $this->_rules($id);
  if($this->form_validation->run() == FALSE) 
  {  
    $this->create();
  } 
  else
  {  
    if($_FILES['image']['name']!='')
    {  
        $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
        $config1['image_library'] = 'gd2';
        $config1['source_image'] =  $_FILES['image']['tmp_name'];
        $config1['new_image'] =   getcwd().'/uploads/cms/'.$_POST['image'];
        $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
        $config1['maintain_ratio'] = TRUE;
        $config1['width']     = 420;
        $config1['height']   = 453;
        $this->image_lib->initialize($config1);
        if(!$this->image_lib->resize())
        { 
          $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
          $this->create();
          return;
        }
        else 
        {   
          $image  = $_POST['image'];   
        }
      }
      else
      {
         $image='';
      }
      $data = array(
        'title' => ucwords($_POST['title']),                              
        'content' => $_POST['content'],                               
        'slug' => $this->input->post('slug',TRUE),
        'image'=>$image,                               
        'created' => date("Y-m-d H:i:s"),
      );    

    $this->Crud_model->SaveData("cms",$data);
  $this->session->set_flashdata('message', 'Cms has been created successfully');
    redirect('Cms/index');
  }
}
public function update($id)
{ 
  if(!empty($id))
  {  
   
    $table = 'cms';
    $cond = "id='".$id."'";
    $row = $this->Crud_model->GetData($table,'',$cond,'','','','1');

    if(!empty($row))
    {  
      $breadcrumbs="<ol class='breadcrumb'>
      <li><a href='".site_url('Dashboard')."'><i class='ace-icon fa fa-home home-icon'></i>Dashboard</a></li>
      <li><a href='".site_url('Cms/index')."'>Manage Cms</a></li>
      <li class='active'>Update Cms</li>
      </ol>";
      $data = array(
        'heading'=>'Update Cms',
        'button'=>'Update',
        'breadcrumbs'=>$breadcrumbs,
        'canBtn'=>'Cancel',
        'actionUrl'=>site_url('Cms/update_action/'.$id),
         'back'=>site_url('Cms/index'),
        'id' =>set_value('id',$row->id),
        'title' =>set_value('title',$row->title),
        'content' =>set_value('content',$row->content),
        'slug' =>set_value('slug',$row->slug),
        'image' =>set_value('image',$row->image),
      ); 
      $this->load->view('cms/form',$data);
    }
    else
    {
      redirect('Cms');
    }
  }
  else
  {
    redirect('Cms');
  }
}
public function update_action($id)
{
  $this->_rules($id);
  if ($this->form_validation->run() == FALSE)
  {  
    $this->update($id);
  }
  else 
  {  
      if($_FILES['image']['name']!='')
            {  
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['image']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/cms/'.$_POST['image'];
                  $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
                  $config1['maintain_ratio'] = TRUE;
                  $config1['width']     = 420;
                  $config1['height']   = 453;
                  $this->image_lib->initialize($config1);
                  if(!$this->image_lib->resize())
                  { 
                    $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
                    $this->create();
                    return;
                  }
                  else 
                  {   
                    unlink('uploads/cms/'.$_POST['old_image']);
                    $image  = $_POST['image'];   
                  }
            }
            else
            {
               $image=$this->input->post('old_image');
            }


      $data = array(
        'title' => ucwords($_POST['title']),                           
        'content' => $_POST['content'],                               
        'slug' => $this->input->post('slug',TRUE), 
         'image'=>$image,                                
        'modified'=> date('Y-m-d H:i:s'),
      );  
  }
  $tablename = "cms";
  $cond = "id='".$id."'";
  $this->Crud_model->SaveData($tablename,$data,$cond);   
  $this->session->set_flashdata('message', 'Cms has been updated successfully');
  redirect(site_url('Cms/index'));   
}
public function _rules($id) 
{   
  $table = 'cms';
  $cond = "title='".$this->input->post('title',TRUE)."' and id!='".$id."' ";
  $row = $this->Crud_model->GetData($table,'',$cond,'','','','1');   
  $count = count($row); 

  if($count==0)
  {
    $is_unique = "";
  }
  else {
    $is_unique = "|is_unique[cms.title]";

  }
  $this->form_validation->set_rules('title', 'title', 'trim|required'.$is_unique,
    array(
      'required'      => 'Required',
      'is_unique'     => 'Already exists',
    ));

  $this->form_validation->set_rules('content', ' content', 'trim|required',
    array(
      'required'      => 'Required',
    ));
  $this->form_validation->set_rules('id', 'id', 'trim');
  $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
}  
}