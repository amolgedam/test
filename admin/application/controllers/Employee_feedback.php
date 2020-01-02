<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Employee_feedback extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Employee_feedback_model');  
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Feedback',    
    );
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('employee_feedback/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){

    $cond="a.designation_id='3'";
        $get_feedback = $this->Employee_feedback_model->get_datatables($cond);
      
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($get_feedback as $row) 
        {
            $btn = anchor(site_url('Employee_feedback/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

          /*  $btn .='&nbsp;|&nbsp;'.anchor(site_url('Aboutus/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           /* $status='';            
            if($row->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }  */

            if(!empty($row->remark))
            {
            if(strlen($row->remark)>100)
            {
                $desc=substr($row->remark,0,100).'...';
            }
            else{
                $desc=$row->remark;
            }
        }
        else{
            $desc="N/A";
        }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($row->name);
            $nestedData[] = date('d-m-Y',strtotime($row->date));
            $nestedData[] = $row->in_time;
            $nestedData[] =$row->out_time;
            $nestedData[] = $desc;
           // $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Employee_feedback_model->count_all($cond),
                    "recordsFiltered" => $this->Employee_feedback_model->count_filtered($cond),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $con="at.id='".$id."'";
        $view_description = $this->Employee_feedback_model->view_feedback($con);
        $data =array(
          'name'=>$view_description->name,
          'date'=>date('d-m-Y',strtotime($view_description->date)),
          'in_time'=>$view_description->in_time,
          'out_time'=>$view_description->out_time,
          'status'=>$view_description->status,
          'remark'=>$view_description->remark,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('employee_feedback/view',$data);
        $this->load->view('common/footer'); 

    }
}