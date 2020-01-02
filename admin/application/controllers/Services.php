<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Services extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Services_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
      { 
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Manage Services',
            'createAction'=>site_url('Services/create'),
            'changeAction'=>site_url('Services/changeStatus'),
            'deleteAction'=>site_url('Services/delete'),
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('services/list',$data);
        $this->load->view('common/footer'); 
      }
    public function ajax_manage_page(){
        $Services = $this->Services_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Services as $ser) 
        {
            
            $btn = anchor(site_url('Services/View/'.$ser->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Services/update/'.$ser->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            if(!empty($ser->title)){ $title = ucwords($ser->title); }else{ $title = "N/A"; }
           
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($ser->type);
            $nestedData[] = ucwords($ser->title);
            $nestedData[] = $status."<input type='hidden' id='status".$ser->id."' value='".$ser->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Services_model->count_all(),
                    "recordsFiltered" => $this->Services_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function delete()
        {
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("services","id='".$_POST['id']."'");exit();
            }
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("services",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
        public function create()
        {
          $header = array('page_title'=>'WPES');  
          $data = array('heading'=>'Add Services',
            'subheading'=>'Create new Services',
            'button'=>'Create',
                    'action'=>site_url('Services/create_action'),
                    'title' =>set_value('title'),
                    'type' =>set_value('type'),
                    'id' =>set_value('id'),   
          );
       
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
      $this->load->view('services/form',$data);
    }

    public function create_action()
    {
        $header = array('page_title'=>'WPES');
        $id = 0;
         $this->_rules($id);
        
        if ($this->form_validation->run() == FALSE) {
            
            $this->create();
        } 
        else 
        {    
            $data = array(
                        'title' => $this->input->post('title',TRUE),
                        'type' => $this->input->post('type',TRUE),
                        'created'=> date('Y-m-d H:i:s'),
            );
            //print_r($data);exit();
            $this->Crud_model->SaveData('services',$data);
            $this->session->set_flashdata('message', 'Customer created successfully');
            redirect(site_url('Services'));      
        }
    

    }
 

    public function _rules($id) 
    {   
        $table ='services';
        $cond2 = "title='".$this->input->post('title',TRUE)."'";
        $row2 = $this->Crud_model->get_single($table, $cond2);
        //print_r($row);exit;
        
        if(empty($row2))
        {
            $is_unique2 = "";
        }
        else {
            $is_unique2 = "|is_unique[services.title]";

        }
        $this->form_validation->set_rules('title', 'title id', 'trim'.$is_unique2,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
       
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }
    public function update($id)
    { 
      $header = array('page_title'=>'Bapat CRM');
        $getservice = $this->Crud_model->get_single('services',"id='".$id."'");
       
        $data = array('heading'=>'Update Services',
                    'subheading'=>'Update Services',
                    'button'=>'Update',
                    'action'=>site_url('Services/update_action'),
                    'title' => set_value('title',$getservice->title),
                    'type' => set_value('type',$getservice->type),
                    'id' => set_value('id',$id),
                );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('services/form',$data);
        $this->load->view('common/footer'); 
    }

    public function update_action()
    {
        /*$id = $this->input->post('id');*/
       $id=$_POST['id'];
        $this->_rules($id);
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } 
        else
            {
            $data = array(
                        'title' => $this->input->post('title',TRUE),
                        'type' => $this->input->post('type',TRUE),
                        'modified'=> date('Y-m-d H:i:s'),
                    );
            //print_r($data);exit;
            $this->Crud_model->SaveData('services',$data,"id='".$id."'");
            $this->session->set_flashdata('message', 'Services updated successfully');
            redirect(site_url('Services'));
        }      
    }

    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
  
        $row = $this->Crud_model->get_single("services","id='".$id."'");
        $data =array(
          'type'=>$row->type,
          'title'=>$row->title,
          'status'=>$row->status,
        );
         $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('services/view',$data);
        $this->load->view('common/footer'); 

    }
}
?>