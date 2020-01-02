<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class New_employee extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('New_employee_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
      { 
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'New Employee',
           
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('New_employees/list',$data);
        $this->load->view('common/footer'); 
      }
    public function ajax_manage_page()
    {
   
        if ($_SESSION['SESSION_NAME']['designation']=='admin') 
        {
            //$condition="d.designation_name!='admin'";
            $Employees = $this->New_employee_model->get_datatables();
            
        }
         elseif ($_SESSION['SESSION_NAME']['designation']=='developer') {
            //$condition="a.created_by='".$_SESSION['SESSION_NAME']['id']."'";
            $Employees = $this->New_employee_model->get_datatables();
        
        }

        //print_r($this->db->last_query());exit;
        
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Employees as $custData) 
        {
            
            $btn = anchor(site_url('New_employee/View/'.$custData->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            /*$btn .='&nbsp;|&nbsp;'.anchor(site_url('Employees/update/'.$custData->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');*/
           
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$custData->id.')"><i class="fa fa-trash-o"></i></span>';
           
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
            $nestedData[] = ucfirst($custData->first_name.''.' '.$custData->middle_name.''.' '.$custData->last_name);
             $nestedData[] = ucfirst($custData->designation_name);
            $nestedData[] = $custData->email_id;
            $nestedData[] = $custData->mobile_no;
            $nestedData[] = $status."<input type='hidden' id='status".$custData->id."' value='".$custData->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->New_employee_model->count_all(),
                    "recordsFiltered" => $this->New_employee_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function delete()
        {
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("employee_data","id='".$_POST['id']."'");exit();
            }
        }

  public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $cond="a.id='".$id."'";
        $Getcustomerdata = $this->New_employee_model->get_customerdata($cond);

        $data_emp =array(
          'heading'=>'Manage Employee',
          'Getcustomerdata'=>$Getcustomerdata,
        );
        //print_r($data_emp); exit;
         $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('New_employees/view',$data_emp);
        $this->load->view('common/footer'); 

    }





    }
    ?>