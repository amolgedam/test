<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class LoginHistory extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        //$this->load->model('Employees_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
      { 

            $attendenceHistory= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."'");

            $get_employee_list = $this->Crud_model->GetData('admin','id,designation_id,name',"designation_id!='4' and designation_id!='5' and status='Active'");
           // print_r($this->db->last_query()); exit;
            $data=array(
              'attendenceHistory'=>$attendenceHistory,
              'get_employee_list'=>$get_employee_list,
            );


            //$this->load->view('Attendence/attendence_history',$data);
            $this->load->view('loginhistory/employee_history',$data);
      }
  
public function makeattendence()
  {
    //print_r("expression"); exit;
   /* $count = count($_POST['rec_id']);

    for ($i=0; $i < $count; $i++) 
    {*/  
        
        $check = $this->Crud_model->GetData('attendence',"","emp_id='".$_SESSION['SESSION_NAME']['id']."' and date='".date('Y-m-d')."'",'','','','1');
        //print_r($this->db->last_query()); exit;
        if (empty($check)) 
        {   
          $stdTime="10:00:00";
         // $stdTime="18:31:59";
            if(date('H:i:s')>$stdTime)
            {
              $latemark='1';
            }
            else
            {
              $latemark='0';
            }
            $data=array(
                'emp_id'=>$_SESSION['SESSION_NAME']['id'],
                'date'=>date('Y-m-d'),
                'in_time'=>date('H:i:s'),
                'late_time'=>$latemark,
                'status'=>'Present',
                //'created_by'=>$_SESSION['SESSION_NAME']['id'],
                'created'=>date('Y-m-d H:i:s'),

            );
            $this->Crud_model->SaveData('attendence',$data);
            $checktime = $this->Crud_model->GetData('attendence',"","emp_id='".$_SESSION['SESSION_NAME']['id']."' and date='".date('Y-m-d')."'",'','','','1');
            $inTime=date("g:i a", strtotime($checktime->in_time)); 


            $data = array(
                'inTime'=>$inTime,
                'msg'=>'Login Time',
            );
           
        echo json_encode($data);
        }
  }


  public function get_empdata()
  {
    if(!empty($_POST['date']))
    {
      $date = date('Y-m',strtotime($_POST['date']));
    }
    else
    {
      $date = date('Y-m');
    }
  
    $attendenceHistory = $this->Crud_model->GetData('attendence','',"emp_id='".$_POST['id']."' and LEFT(date,7)='".$date."'");

    //print_r($this->db->last_query());exit;

      $data=array(
        'attendenceHistory'=>$attendenceHistory,
      );

      $this->load->view('loginhistory/employee_list',$data);

  }
    

       
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $cond="ac.id='".$id."'";

        $Getcustomerdata = $this->Employees_model->get_customerdata($cond);
        $citydata = $this->Crud_model->get_single("cities","id='".$Getcustomerdata->city_id."'");
        $data =array(
          'customer_name'=>$Getcustomerdata->customer_name,
          'address'=>$Getcustomerdata->address,
          'city_id'=>$citydata->city_name,
          'pin_code'=>$Getcustomerdata->pin_code,
          'mobile_no'=>$Getcustomerdata->mobile_no,
          'email'=>$Getcustomerdata->email,
          'status'=>$Getcustomerdata->status,
        );
         $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Employees/view',$data);
        $this->load->view('common/footer'); 

    }

  
}
?>