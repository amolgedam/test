<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Software extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Software_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
      {  
            $data = array(
            'heading'=>'Manage Software',
            'createAction'=>site_url('Software/create'),
            'changeAction'=>site_url('Software/changeStatus'),
            'deleteAction'=>site_url('Software/delete'),
        );
        $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('software/list',$data);
        $this->load->view('common/footer'); 
      }
    public function ajax_manage_page()
    {
        $Software = $this->Software_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Software as $ser) 
        {
            
            $btn = ''.'<span title="Edit" class="btn btn-primary btn-circle btn-xs" onclick="showmodal('.$ser->id.')" data-placement="right" title="Edit"><i class="fa fa-edit"></i></span>'.'&nbsp;|&nbsp;'.'';  
                 
            $btn .='<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$ser->id.')"><i class="fa fa-trash"></i></span>';
           
            // $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$ser->id.')"><i class="fa fa-trash-o"></i></span>';
           
             $status='';            
            if($ser->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$ser->id.'"  onClick="statuss('.$ser->id.');" >'.$ser->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$ser->id.'"  onClick="statuss('.$ser->id.');" >'.$ser->status.'</span>';
            }
            // if(!empty($ser->title)){ $title = ucwords($ser->title); }else{ $title = "N/A"; }
           
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($ser->title);
            $nestedData[] = $status."<input type='hidden' id='status".$ser->id."' value='".$ser->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Software_model->count_all(),
                    "recordsFiltered" => $this->Software_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function delete()
        {
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("software","id='".$_POST['id']."'");exit();
            }
        }

        public function change_status()
        {
            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("software",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
        public function create()
        {
          $header = array('page_title'=>'WPES');  
          $data = array('heading'=>'Add Software',
            'subheading'=>'Create new Software',
            'button'=>'Create',
                    'action'=>site_url('Software/create_action'),
                    'title' =>set_value('title'),
                    'id' =>set_value('id'),   
          );
       // print_r($data);exit;
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
      $this->load->view('software/form',$data);
    }

    public function create_action()
    {
        $id = 0;

            $data = array(
                        'title' => $this->input->post('title',TRUE),
                         'created'=> date('Y-m-d H:i:s'),
            );
            //print_r($data);exit();
            $this->Crud_model->SaveData('software',$data);
            $this->session->set_flashdata('message', 'Software created successfully');
            redirect(site_url('Software'));      
        
    }

    public function update()
    {
         $update_data=$this->Crud_model->get_single('software',"id='".$_POST['id']."'"); 

          $data=array(
          'title'=>$update_data->title, 
          'id'=> $update_data->id,              
          ); 

          echo json_encode($data);exit;
          
             
    }
     public function update_action()
    {  
       $id=$this->input->post('id');    
        $updateData =$this->Crud_model->GetData('software','',"id='".$id."'");
         
           $data=array(
          'title'=> $this->input->post('e_title'),
          'id' => $this->input->post('id'),
          'modified' =>date('Y-m-d H:i:s'),
          );
          $this->Crud_model->SaveData('software',$data,"id='".$id."'");
          $this->session->set_flashdata('message', 'Software update successfully');
         
          
        // extract($_POST);
        // $update="UPDATE `software` SET `title`='$e_title' WHERE `id`='$id'";

        // if($this->db->query($update))
        // {
        //     echo "succes";

        // }
        // else{
        //     echo "failed";
        // }

    }

}
?>