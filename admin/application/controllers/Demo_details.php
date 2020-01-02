<?php

  defined('BASEPATH') OR exit('No direct script access allowed');
  //error_reporting(0);
  class Demo_details extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Demo_project_model');
     /*   $this->load->library(array('session','form_validation','image_lib'));*/
     
    }
    public function index()
      { 
       /* $designation = $this->Crud_model->GetData('Demo_details',"","status='Active'");*/
       
      
        // print_r($product_data); exit;
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Project Details',
           'createAction'=>site_url('Demo_details/create'),

           
        );
            //print_r($data); exit;
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('project_details/list',$data);
        $this->load->view('common/footer'); 
      }
 public function ajax_manage_page()
    {
   
        if ($_SESSION['SESSION_NAME']['designation']=='admin' || $_SESSION['SESSION_NAME']['designation']=='marketing' || $_SESSION['SESSION_NAME']['designation']=='telecaller') 
        {
            $condition="d.designation_name!='admin'";
           $product_detils = $this->Demo_project_model->get_datatables($condition);
            
        }
        /* elseif ($_SESSION['SESSION_NAME']['designation']=='developer') {
            $condition="a.created_by='".$_SESSION['SESSION_NAME']['id']."'";
            $Employees = $this->Employees_model->get_datatables($condition);
        
        }
*/
        //print_r($this->db->last_query());exit;
        
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($product_detils as $custData) 
        {
            
            $btn = anchor(site_url('Demo_details/View/'.$custData->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');
   if($_SESSION['SESSION_NAME']['designation']=='admin'){
            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Demo_details/update/'.$custData->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$custData->id.')"><i class="fa fa-trash-o"></i></span>';
   }
             $status='';            
            if($custData->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$custData->id.'"  onClick="statuss('.$custData->id.');" >'.$custData->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$custData->id.'"  onClick="statuss('.$custData->id.');" >'.$custData->status.'</span>';
            }
           
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $custData->project_name;
            $nestedData[] = $custData->price;
            $nestedData[] = '<a target="_blank" href="'.$custData->link.'" >'.$custData->link.'</a>';
            $nestedData[] = $custData->userid;
            $nestedData[] = $custData->password;
            $nestedData[] = $custData->description;
          
            $nestedData[] = $status."<input type='hidden' id='status".$custData->id."' value='".$custData->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Demo_project_model->count_all($condition),
                    "recordsFiltered" => $this->Demo_project_model->count_filtered($condition),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function delete()

        {
          //print_r($_POST['id']); exit
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("project_demo_details","id='".$_POST['id']."'");exit();
            }
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("project_demo_details",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
  public function create()
        {
             /* $product_data= $this->Crud_model->GetData('project_demo_details',"","status='Active'");*/
          $header = array('page_title'=>'WPES');  
      /*    $designation = $this->Crud_model->GetData('designation',"","status='Active'");
          $states = $this->Crud_model->GetData('states',""," status='Active'");
          $cities = $this->Crud_model->GetData('cities',""," status='Active' and state_id='7'");*/
          $data = array('heading'=>'Add Project',
            'subheading'=>'Create new Project',
                    'button'=>'Create',
                    'action'=>site_url('Demo_details/create_action'),
                
                    //'type' =>set_value('type'),
               
                   // 'project_name' =>set_value('project_name'),
                    'price' =>set_value('price'),
                    'project_name' =>set_value('project_name'),
                    'link' =>set_value('link'),
                    'userid' =>set_value('userid'),
                    'password' =>set_value('password'),
                  
                   'created_by'=>set_value('created_by'),
                   'id'=>set_value('id'),
                   'description'=>set_value('description'),
          );
       
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
      $this->load->view('project_details/form',$data);
    }
      public function create_action()
    {  
     
            $data = array(
                        //'type' =>$this->input->post('type',TRUE),
                        
                        'project_name' =>ucfirst($this->input->post('project_name',TRUE)),
                        'link' =>$this->input->post('link',TRUE),
                        'userid' =>$this->input->post('userid',TRUE),
                        'password' =>$this->input->post('password',TRUE),
                        'description' =>$this->input->post('description',TRUE),
                       
                        'created_by'=> $_SESSION['SESSION_NAME']['id'],
                        'created'=> date('Y-m-d H:i:s'),
                            );
         
            $this->Crud_model->SaveData('project_demo_details',$data);
            $this->session->set_flashdata('message', 'Project created successfully');
            redirect(site_url('Demo_details/index'));      
       
    

    }
      public function update($id)
    { 
      $header = array('page_title'=>'WPES');
        $project_name = $this->Crud_model->get_single('project_demo_details',"id='".$id."'");
      // print_r($this->db->last_query()); exit;
   
      
        $data = array('heading'=>'Update Project Details',
                    'subheading'=>'Update Project Details',
                    'button'=>'Update',
                    'action'=>site_url('Demo_details/update_action/'.$id),
                    'project_name' =>set_value('project_name',$project_name->project_name),
                    'price' =>set_value('price',$project_name->price),
                    'link' =>set_value('link',$project_name->link),
                    'userid' => set_value('userid',$project_name->userid),
                    'password' => set_value('password',$project_name->password),
                    'description' => set_value('description',$project_name->description),
                    'id' => set_value('id',$id),
                );
        //print_r( $data); exit;
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('project_details/form',$data);
      
    }

    public function update_action()
    {
        //print_r($_POST); exit;
        $id = $this->input->post('id');
          $data = array(
                      
                        //'type' =>$this->input->post('type',TRUE),
                        'project_name' =>$this->input->post('project_name',TRUE),
                        'price' => $this->input->post('price',TRUE),
                        'password' => $this->input->post('password',TRUE),
                        'userid' => $this->input->post('userid',TRUE),
                        'password'=>$this->input->post('password',TRUE),
                        'description'=>$this->input->post('description',TRUE),
                        'modified'=> date('Y-m-d H:i:s'),
                    );
            //print_r($data); exit;   
            $this->Crud_model->SaveData('project_demo_details',$data,"id='".$id."'");
            $this->session->set_flashdata('message', 'Project updated successfully');
            redirect(site_url('Demo_details'));
        //}      
    }
   public function View($id)
    {  
        $header = array('page_title'=>'WPES');
      
        $Getcustomerdata = $this->Crud_model->get_single("project_demo_details","id='".$id."'");
        $data =array(
          'heading'=>"Project Details",
     
           'Getcustomerdata'=>$Getcustomerdata,
          
        );
  
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('project_details/view',$data);
        $this->load->view('common/footer');
    }
        




    }
    ?>