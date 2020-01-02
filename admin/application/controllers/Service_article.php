<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Service_article extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Service_article_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
      { 
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Manage Service_article',
            'createAction'=>site_url('Service_article/create'),
            'changeAction'=>site_url('Service_article/changeStatus'),
            'deleteAction'=>site_url('Service_article/delete'),
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Service_article/list',$data);
        $this->load->view('common/footer'); 
      }
    public function ajax_manage_page(){
        $Service_article = $this->Service_article_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Service_article as $ser) 
        {
            
            $btn = anchor(site_url('Service_article/View/'.$ser->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Service_article/update/'.$ser->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$ser->id.')"><i class="fa fa-trash-o"></i></span>';
           
           $status='';            
            if($ser->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$ser->id.'"  onClick="statuss('.$ser->id.');" >'.$ser->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$ser->id.'"  onClick="statuss('.$ser->id.');" >'.$ser->status.'</span>';
            }
          
          if(!empty($ser->image))
            {
                $image = '<img src="'.base_url("uploads/ourservice/".$ser->image).'" width=100px" height="100px"> ';
            }
           else
            {
                $image = "<img src='".base_url('uploads/No_Image_Available.jpg')."' width='100px' height='100px'> "; 
            }

            if(strlen($ser->description) > 100)
            {
                $description=substr($ser->description, 0,80).'...';
            }
            else{
                $description=$ser->description;
            }
            
             if(strlen($ser->heading) > 100)
            {
                $heading=substr($ser->heading, 0,50).'...';
            }
            else{
                $heading=$ser->heading;
            }
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $heading;
            $nestedData[] = $description;
            $nestedData[] = $image;
            $nestedData[] = $status."<input type='hidden' id='status".$ser->id."' value='".$ser->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Service_article_model->count_all(),
                    "recordsFiltered" => $this->Service_article_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
        public function create()
        {
          $header = array('page_title'=>'WPES');
           $serviceheading = $this->Crud_model->GetData("service_detail","id,heading","","","","","","","");
           //print_r($serviceheading);exit;
            $data = array(
                            'heading'=>'Add Service_article',
                            'subheading'=>'Create new Service_article',
                            'button'=>'Create',
                            'action'=>site_url('Service_article/create_action'),
                            'service_heading_id' =>set_value('service_heading_id'),
                            'heading' =>set_value('heading'),
                            'description' =>set_value('description'),
                            'image' =>set_value('image'),
                            'id' =>set_value('id'), 
                            'serviceheading' =>$serviceheading,
                        );
        //print_r($data);exit();
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Service_article/form',$data);
    }

     public function create_action()
     {
        $id='0';
      $this->_rules($id);
        // $con="id='".$id."'";
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } 
        else
        {
            if($_FILES['image']['name']!='')
            {  
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['image']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/ourservice/'.$_POST['image'];
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
                        'service_heading_id' => ucfirst($this->input->post('service_heading_id',TRUE)),
                        'heading' => ucfirst($this->input->post('heading',TRUE)),
                        'description' => ucfirst($this->input->post('description',TRUE)), 
                        'image' => ucfirst($this->input->post('image',TRUE)), 
                        'created'=> date('Y-m-d H:i:s'),
            );
             //print_r($data);exit;
            $this->Crud_model->SaveData('service_article',$data);
            $this->session->set_flashdata('message', 'Services created successfully');
            redirect(site_url('Service_article'));       
        }

        }
 

    public function _rules($id) 
    {   
        $table ='service_article';
        $cond2 = "heading='".$this->input->post('heading')."' and id!='".$id."'";
        $row2 = $this->Crud_model->get_single($table, $cond2);
        //print_r($row);exit;
        
        if(empty($row2))
        {
            $is_unique2 = "";
        }
        else {
            $is_unique2 = "|is_unique[service_article.heading]";

        }
        $this->form_validation->set_rules('heading', 'heading id', 'trim'.$is_unique2,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
       
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }

     public function View($id)
    {  
       $header = array('page_title'=>'WPES');

        $row = $this->Crud_model->get_single("service_article","id='".$id."'");
        $data =array(
            'service_heading_id' => $row->service_heading_id,
            'heading'=>$row->heading,
            'description'=>$row->description,
            'image'=>$row->image,
        );
        
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Service_article/view',$data);
        $this->load->view('common/footer'); 

    }

    public function update($id)
    { 
        $serviceheading = $this->Crud_model->GetData("service_detail","id,heading","","","","","","","");
        $get_service_articles = $this->Crud_model->GetData('service_article',"id,service_heading_id,heading,image,description","id='".$id."'","","","","1");
        //print_r($gettitle);exit;
        $data = array('heading'=>'Update Service_article',
                    'subheading'=>'Update Service_article',
                    'button'=>'Update',
                    'action'=>site_url('Service_article/update_action'),
                    'service_heading_id' => set_value($get_service_articles->service_heading_id),
                    'heading' => set_value('heading',$get_service_articles->heading),
                    'description' => set_value('description',$get_service_articles->description),
                    'image' => $get_service_articles->image,
                    'id' => set_value('id',$id),
                    'service_heading_id' =>$get_service_articles->service_heading_id,
                    'serviceheading' =>$serviceheading,
                );
        //print_r($data);exit();
        $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('Service_article/form',$data);
       
    }

    public function update_action()
    {
        $id=$_POST['id'];
        $this->_rules($id);
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } 
        else
        {

        if( $_FILES['image']['name']!='' )
        {
            $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
            $config2['image_library'] = 'gd2';
            $config2['source_image'] =  $_FILES['image']['tmp_name'];
            $config2['new_image'] =   getcwd().'/uploads/ourservice/'.$_POST['image'];
            $config2['upload_path'] =  getcwd().'/uploads/ourservice/';
            $config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
            $config2['maintain_ratio'] = FALSE;

            $this->image_lib->initialize($config2);

            if(!$this->image_lib->resize())
            {
                echo('<pre>');
                echo ($this->image_lib->display_errors());
                exit;
            }
            unlink('uploads/ourservice/'.$_POST['old_image']);
            $image  = $_POST['image'];
        }
        else
        {
            $image  =$_POST['old_image'];
        }

            $data = array(
                        'service_heading_id' => $this->input->post('service_heading_id',TRUE),
                        'heading' => $this->input->post('heading',TRUE),
                        'description' => $this->input->post('description',TRUE),
                        'image' => $image,
                        'modified'=> date('Y-m-d H:i:s'),
                    );
            //print_r($data);exit();
            $this->Crud_model->SaveData('service_article',$data,"id='".$id."'");
            $this->session->set_flashdata('message', 'Services updated successfully');
            redirect(site_url('Service_article'));
        }     
}

    public function delete()
        {
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("service_article","id='".$_POST['id']."'");exit();
            }
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("service_article",$_POST,"id='".$_POST['id']."'");exit;
            }
        }

     public function get_service()
    {  
        $type = $this->input->post('type');

        $serviceData = $this->Crud_model->GetData('services',"*","status='Active' and type='".$type."'");
        $html = "<option value='0'>Select Title</option>";
        foreach ($serviceData as $row_data) 
        {
            $html .= "<br><option value='".$row_data->id."'>".ucfirst($row_data->title)."</option>";
        }
        echo $html;
    }
     public function img_delete()
    {
        if(isset($_POST['cid']))
        {
            $this->Common_model->delete('service_images',"id='".$_POST['cid']."'");
            
        }
    }
}
?>