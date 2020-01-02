<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Designation extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Designation_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
      {  
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Manage Designation',
            'createAction'=>site_url('Designation/create'),
            'changeAction'=>site_url('Designation/changeStatus'),
            'deleteAction'=>site_url('Designation/delete'),
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Designation/list',$data);
        $this->load->view('common/footer'); 
      }
    public function ajax_manage_page(){
        $Designation = $this->Designation_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Designation as $ser) 
        {
            
            $btn = anchor(site_url('Designation/View/'.$ser->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Designation/update/'.$ser->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
            /*$btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$ser->id.')"><i class="fa fa-trash-o"></i></span>';*/
           
             $status='';            
            if($ser->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$ser->id.'"  onClick="statuss('.$ser->id.');" >'.$ser->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$ser->id.'"  onClick="statuss('.$ser->id.');" >'.$ser->status.'</span>';
            }
            if(!empty($ser->title)){ $title = ucwords($ser->title); }else{ $title = "N/A"; }
           
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($ser->designation_name);
            $nestedData[] = $status."<input type='hidden' id='status".$ser->id."' value='".$ser->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Designation_model->count_all(),
                    "recordsFiltered" => $this->Designation_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function delete()
        {
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("designation","id='".$_POST['id']."'");exit();
            }
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("designation",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
        public function create()
        {
          $header = array('page_title'=>'WPES');  
          $data = array('heading'=>'Add Designation',
            'subheading'=>'Create new Designation',
            'button'=>'Create',
                    'action'=>site_url('Designation/create_action'),
                    'title' =>set_value('title'),
                    'id' =>set_value('id'),   
          );
       
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
      $this->load->view('Designation/form',$data);
    }

    public function create_action()
    {
          
            $data = array(
                        'designation_name' => $this->input->post('title',TRUE),
                        'created'=> date('Y-m-d H:i:s'),
            );
            
            $this->Crud_model->SaveData('designation',$data);
            $this->session->set_flashdata('message', 'Designation created successfully');
            redirect(site_url('Designation'));      
        
    

    }
 
    public function update($id)
    { 
        $getservice = $this->Crud_model->get_single('designation',"id='".$id."'");
       
        $data = array('heading'=>'Update Designation',
                    'subheading'=>'Update Designation',
                    'button'=>'Update',
                    'action'=>site_url('Designation/update_action'),
                    'title' => set_value('designation_name',$getservice->designation_name),
                    'id' => set_value('id',$id),
                );
        $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('Designation/form',$data);
        $this->load->view('common/footer'); 
    }

    public function update_action()
    {
        
       $id=$_POST['id'];

            $data = array(
                        'designation_name' => $this->input->post('title',TRUE),
                        'modified'=> date('Y-m-d H:i:s'),
                    );
           
            $this->Crud_model->SaveData('designation',$data,"id='".$id."'");
            $this->session->set_flashdata('message', 'Designation updated successfully');
            redirect(site_url('Designation'));
              
    }

    public function View($id)
    {  
  
        $row = $this->Crud_model->get_single("designation","id='".$id."'");
        $data =array(
          'title'=>$row->designation_name,
          'status'=>$row->status,
        );
         $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('Designation/view',$data);
        $this->load->view('common/footer'); 

    }
}
?>