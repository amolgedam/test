<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Employee_salaries extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Employee_salaries_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
      { 
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Customer Master',
            'createAction'=>site_url('Employee_salaries/create'),
            'changeAction'=>site_url('Employee_salaries/changeStatus'),
            'deleteAction'=>site_url('Employee_salaries/delete'),
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Employee_salaries/list',$data);
        $this->load->view('common/footer'); 
      }
    public function ajax_manage_page()
    {
   
        if ($_SESSION['SESSION_NAME']['designation']=='admin') 
        {
            $condition="d.designation_name!='admin'";
            $Employee_salaries = $this->Employee_salaries_model->get_datatables($condition);
            
        }
         elseif ($_SESSION['SESSION_NAME']['designation']=='developer') {
            $condition="a.created_by='".$_SESSION['SESSION_NAME']['id']."'";
            $Employee_salaries = $this->Employee_salaries_model->get_datatables($condition);
        
        }
         $Employee_salaries = $this->Employee_salaries_model->get_datatables($condition);
        //print_r($this->db->last_query());exit;
        
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Employee_salaries as $custData) 
        {
            
           /* $btn = anchor(site_url('Employee_salaries/View/'.$custData->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');*/

            $btn ='&nbsp;|&nbsp;'.anchor(site_url('Employee_salaries/update/'.$custData->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
           /* $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$custData->id.')"><i class="fa fa-trash-o"></i></span>';*/
           
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
            $nestedData[] = $custData->year.'-'.$custData->month;
            $nestedData[] = ucfirst($custData->name);
            $nestedData[] = $custData->working_days;
            $nestedData[] = $custData->actual_working_days;
            $nestedData[] = $custData->paid_leaves;
            $nestedData[] = $custData->acual_salary;
            $nestedData[] = $custData->paid_salary;
            $nestedData[] = $status."<input type='hidden' id='status".$custData->id."' value='".$custData->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Employee_salaries_model->count_all($condition),
                    "recordsFiltered" => $this->Employee_salaries_model->count_filtered($condition),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function delete()
        {
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("emp_salary","id='".$_POST['id']."'");exit();
            }
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("emp_salary",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
        public function create()
        {

          $header = array('page_title'=>'WPES');  
         
          $employee = $this->Crud_model->GetData('admin',"","status='Active' and designation_id in(select id from designation where designation_name='PHP DEVELOPER')");
         
          $data = array('heading'=>'Generate Employee salary',
            'subheading'=>'Create new Employee',
            'button'=>'Create',
                    'action'=>site_url('Employee_salaries/create_action'),
                    //'type' =>set_value('type'),
                    'emp_id' =>set_value('emp_id'),
                    'acual_salary' =>set_value('acual_salary'),
                    'paid_salary' =>set_value('paid_salary'),
                    'paid_salary' =>set_value('paid_salary'),
                    'id' =>set_value('id'),
                    'working_days' =>set_value('working_days'),
                    'paid_leaves' =>set_value('paid_leaves'),
                    'employee_id' =>set_value('employee_id'),
                    'employee'=>$employee,
                    'created_by'=>set_value('created_by'),
          );
       
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
      $this->load->view('Employee_salaries/form',$data);
    }

    public function create_action()
    {  
        $header = array('page_title'=>'WPES');
        $id = 0;
         $this->_rules($id);
        
        /*if ($this->form_validation->run() == FALSE) {
            
            $this->create();
        } 
        else 
        { */  
            $days_in_month=cal_days_in_month(CAL_GREGORIAN,$_POST['month'],$_POST['year']);
            //print_r($days_in_month); exit;
            $paid_days= $_POST['working_Days']+$_POST['paid_leaves'];
            $perDaySalary= $_POST['acual_salary']/31;
            $round= round($paid_days);
            $roundperda= round($perDaySalary);
            $paid_salary=$round*$roundperda;

            $data = array(
                       
                        'year' =>ucfirst($this->input->post('year',TRUE)),
                        'emp_id' =>ucfirst($this->input->post('emp_id',TRUE)),
                        'month' =>ucfirst($this->input->post('month',TRUE)),
                        'acual_salary' =>$this->input->post('acual_salary',TRUE),
                        'paid_leaves' =>$this->input->post('paid_leaves',TRUE),
                        'paid_salary' =>$paid_salary,
                        'created'=> date('Y-m-d H:i:s'),
                            );
             //print_r($data); exit;
            $this->Crud_model->SaveData('emp_salary',$data);
            $this->session->set_flashdata('message', 'Employee salary created successfully');
            redirect(site_url('Employee_salaries'));      
        //}
    

    }
   
    public function get_empsalary()
    {  
        $id = $this->input->post('id');
        $empData = $this->Crud_model->GetData('admin',"salary","id = '".$id."'",'','','','1');
        $salary=$empData->salary;
        echo $salary;
    }

     public function get_workingdays()
    {  
        $id = $this->input->post('id');
        $year_month=$_POST['year'].'-'.$_POST['month'];
           $yearmonth =date("Y-m", strtotime($year_month));

        $empworkingdays = $this->Crud_model->GetData('monthwise_emp_details',"actual_working_days","emp_id = '".$id."' and month_year='".$yearmonth."'",'','','','1');
       // print_r($this->db->last_query()); exit;
        $workingdays=$empworkingdays->actual_working_days;

        echo $workingdays;
    }

    public function _rules($id) 
    {   
        $table ='customer_master';
        $cond2 = "email='".$this->input->post('email',TRUE)."' and id!='".$id."'";
        $row2 = $this->Crud_model->get_single($table, $cond2);
        //print_r($row);exit;
        
        if(empty($row2))
        {
            $is_unique2 = "";
        }
        else {
            $is_unique2 = "|is_unique[customer_master.email]";

        }
        $this->form_validation->set_rules('email', 'email id', 'trim'.$is_unique2,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
        $cond3 = "mobile_no='".$this->input->post('mobile_no',TRUE)."' and id!='".$id."'";
        $row3 = $this->Crud_model->get_single($table, $cond3);
        //print_r($row);exit;
  
        if(empty($row3))
        {
            $is_unique3 = "";
        }
        else {
            $is_unique3 = "|is_unique[customer_master.mobile_no]";

        }
        $this->form_validation->set_rules('mobile_no', 'Contact 1', 'trim'.$is_unique3,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }
    public function update($id)
    { 
      $header = array('page_title'=>'WPES');
        $getCustomer = $this->Crud_model->get_single('emp_salary',"id='".$id."'");
        if(!empty($getCustomer)){
            $getworkingdays= $this->Crud_model->GetData('monthwise_emp_details','',"emp_id='".$getCustomer->emp_id."'",'','','','1');
       // print_r($this->db->last_query()); exit;
        }
        $employee = $this->Crud_model->GetData('admin',"","status='Active'");
        $designation = $this->Crud_model->GetData('designation',"","status='Active'");
        $states =  $this->Crud_model->GetData('states',""," status='Active'");
        //$cities =  $this->Crud_model->GetData('cities',""," status='Active' and state_id='".$getCustomer->state_id."'");
        $data = array('heading'=>'Update Employee Salaries',
                    'subheading'=>'Update Employee Salaries',
                    'button'=>'Update',
                    'action'=>site_url('Employee_salaries/update_action'),
                    'employee'=>$employee,
                    'designation'=>$designation,
                    'year' =>set_value('year',$getCustomer->year),
                    'months' =>set_value('month',$getCustomer->month),
                    'emp_id' => set_value('emp_id',$getCustomer->emp_id),
                    'paid_leaves' => set_value('paid_leaves',$getCustomer->paid_leaves),
                    'acual_salary' => set_value('acual_salary',$getCustomer->acual_salary),
                    'paid_salary' => set_value('paid_salary',$getCustomer->paid_salary),
                    'working_days' => set_value('working_days',$getworkingdays->working_days),
                    'id' => set_value('id',$id),
                );
       // print_r($data); exit;
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Employee_salaries/form',$data);
      
    }

    public function update_action()
    {
       // print_r($_POST); exit;
        $id = $this->input->post('id');

        $days_in_month=cal_days_in_month(CAL_GREGORIAN,$_POST['month'],$_POST['year']);
          
            $paid_days= $_POST['working_Days']+$_POST['paid_leaves'];
            $perDaySalary= $_POST['acual_salary']/31;
            $round= round($paid_days);
            $roundperda= round($perDaySalary);
            $paid_salary=$round*$roundperda;
        $this->_rules($id);
        $con="id='".$id."'";
        /*if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } 
        else
            {*/

            $data = array(
                        'year' =>$this->input->post('year',TRUE),
                        'emp_id' => $this->input->post('emp_id',TRUE),
                        'month' => $this->input->post('month',TRUE),
                        'acual_salary' => $this->input->post('acual_salary',TRUE),
                        'working_Days'=>$this->input->post('working_Days',TRUE),
                        'paid_leaves'=>$this->input->post('paid_leaves',TRUE),
                        'paid_salary'=> $paid_salary,
                        'modified'=> date('Y-m-d H:i:s'),
                    );
            //  print_r($data); exit;   
            $this->Crud_model->SaveData('emp_salary',$data,$con);
            $this->session->set_flashdata('message', 'Employee Salary updated successfully');
            redirect(site_url('Employee_salaries'));
        //}      
    }

    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $cond="a.id='".$id."'";
        $Getcustomerdata = $this->Employee_salaries_model->get_customerdata($cond);

        $data =array(
          'heading'=>'Manage Employee',
          'Getcustomerdata'=>$Getcustomerdata,
        );
         $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Employee_salaries/view',$data);
        $this->load->view('common/footer'); 

    }
}
?>