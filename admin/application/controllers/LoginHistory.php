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
       
            if($_SESSION['SESSION_NAME']['designation']!='admin')
          {
              $attendenceHistory= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."'",'','date DESC');
          }
          else
          {
            $attendenceHistory = "";
          }
            

           

           $get_employee_list = $this->Crud_model->GetData('admin','id,designation_id,name',"designation_id!='4' and designation_id!='5' and status='Active'" );
            //print_r($get_employee_list);exit;
           //print_r($this->db->last_query()); exit;
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
  
    $attendenceHistory = $this->Crud_model->GetData('attendence','',"emp_id='".$_POST['id']."' and LEFT(date,7)='".$date."'",'','date DESC');

    $totAttendence= $this->Crud_model->GetData('attendence','',"emp_id='".$_POST['id']."' and LEFT(date,7)='".$date."' and status='Present'",'','date DESC','','');
    $AbsentAttendence= $this->Crud_model->GetData('attendence','',"emp_id='".$_POST['id']."' and LEFT(date,7)='".$date."' and status='Absent'",'','','','');

     $totlm= $this->Crud_model->GetData('attendence','late_time',"emp_id='".$_POST['id']."' and LEFT(date,7)='".$date."' and late_time='1'",'','','','');

     $latemark_halfday= $this->Crud_model->GetData('attendence','latemark_halfday',"emp_id='".$_POST['id']."' and LEFT(date,7)='".$date."' and latemark_halfday='1'",'','','','');
     $latemarkAbs= $this->Crud_model->GetData('attendence','',"latemark_absent='1' and emp_id='".$_POST['id']."' and LEFT(date,7)='".$date."'");
     $tot_halfday= $this->Crud_model->GetData('attendence','halfday',"emp_id='".$_POST['id']."' and LEFT(date,7)='".$date."' and halfday='1'",'','','','');

     $actualPresentDays=count($totAttendence)-count($latemarkAbs)-(count($tot_halfday)*0.5)-(count($latemark_halfday)*0.5);

    
    /* functionality done by praful */
    $holidays =$this->Crud_model->GetData('holidays','',"h_month='".date('m')."' and status='Active'");
    /* Holidays in month*/
    $allotedHolidays =$this->Crud_model->GetData('admin','',"id='".$_POST['id']."'");

        /**************** total working days ********************/
          $currentMonth= date('m');
          $currentYear= date('Y');
          $date1 = "$currentYear-$currentMonth-01";
          
          $first_day = date('N',strtotime($date1));
          $first_day = 7 - $first_day + 1;
          $last_day =  date('t',strtotime($date1));
          
          $days = array();
          for($i=$first_day; $i<=$last_day; $i=$i+7 ){
              $days[] = $i;
          }
            $totalSundays = count($days);
            $countHolidays = count($holidays);


            /*********************** current month sundays**************/
            $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

            $nonWorkingDays = ($totalSundays) + ($countHolidays) ;
            $workingDays = ($totalDaysInMonth) - ($nonWorkingDays);

      $data=array(
        'attendenceHistory'=>$attendenceHistory,
        "totalDaysInMonth"=>$totalDaysInMonth,
        'holidays'=>$holidays,
        "totalSundays"=>$totalSundays,
        "allotedHolidays"=>$allotedHolidays[0],
        "workingDays"=>$workingDays,
        'monthly_attendence'=>count($totAttendence),
        "AbsentAttendence"=>$AbsentAttendence,
        'monthly_latemarks'=>count($totlm),
        'latemarkhalfday'=>count($latemark_halfday),
        'latemark_Abs'=>count($latemarkAbs),
        'halfday'=>count($tot_halfday),
        'actual_PresentDays'=>$actualPresentDays,
        'empId' =>$_POST['id'],
      );

      $this->load->view('loginhistory/employee_list',$data);

  }
    public function getRemark()
  {
    
    $check = $this->Crud_model->get_single('attendence',"id='".$_POST['id']."'");

    if(!empty($check))
    {
        $data = array(
          'remark'=>$check->remark,
        );

       echo json_encode($data);
    }  
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

    public function appendPageHistory()
    {
      //print_r($_POST);exit;

      if($_POST['monthap1'] < 10){ $_POST['monthap1']='0'.$_POST['monthap1'];}else{$_POST['monthap1'];}

      $dt =$_POST['yearap1'].'-'.$_POST['monthap1'];

      $attendenceHistory = $this->Crud_model->GetData('attendence','',"emp_id='".$_POST['empId']."' and LEFT(date,7)='".$dt."'",'','date DESC');

      $totAttendence= $this->Crud_model->GetData('attendence','',"emp_id='".$_POST['empId']."' and LEFT(date,7)='".$dt."' and status='Present'",'','date DESC','','');
      $AbsentAttendence= $this->Crud_model->GetData('attendence','',"emp_id='".$_POST['empId']."' and LEFT(date,7)='".$dt."' and status='Absent'",'','','','');

      $totlm= $this->Crud_model->GetData('attendence','late_time',"emp_id='".$_POST['empId']."' and LEFT(date,7)='".$dt."' and late_time='1'",'','','','');

      $latemark_halfday= $this->Crud_model->GetData('attendence','latemark_halfday',"emp_id='".$_POST['empId']."' and LEFT(date,7)='".$dt."' and latemark_halfday='1'",'','','','');

      $latemarkAbs= $this->Crud_model->GetData('attendence','',"latemark_absent='1' and emp_id='".$_POST['empId']."' and LEFT(date,7)='".$dt."'");

      $tot_halfday= $this->Crud_model->GetData('attendence','halfday',"emp_id='".$_POST['empId']."' and LEFT(date,7)='".$dt."' and halfday='1'",'','','','');

      $actualPresentDays=count($totAttendence)-count($latemarkAbs)-(count($tot_halfday)*0.5)-(count($latemark_halfday)*0.5);

      /* functionality done by praful */
    $holidays =$this->Crud_model->GetData('holidays','',"h_month='".$_POST['monthap1']."' and status='Active'");
    /* Holidays in month*/
    $allotedHolidays =$this->Crud_model->GetData('admin','',"id='".$_POST['empId']."'");

        /**************** total working days ********************/
          $currentMonth= $_POST['monthap1'];
          $currentYear= $_POST['yearap1'];
          $date1 = "$currentYear-$currentMonth-01";
          
          $first_day = date('N',strtotime($date1));
          $first_day = 7 - $first_day + 1;
          $last_day =  date('t',strtotime($date1));
          
          $days = array();
          for($i=$first_day; $i<=$last_day; $i=$i+7 ){
              $days[] = $i;
          }
            $totalSundays = count($days);
            $countHolidays = count($holidays);


            /*********************** current month sundays**************/
            $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

            $nonWorkingDays = ($totalSundays) + ($countHolidays) ;
            $workingDays = ($totalDaysInMonth) - ($nonWorkingDays);

            /* count salary of the month */
            $totalSalary = $allotedHolidays[0]->salary;

            if($actualPresentDays && $totalSalary && ($dt <> date('Y-m')))
            {
              //$actualPresentDays ='20.5';

              if($allotedHolidays[0]->alloted_status=='Yes')
              {
                if($actualPresentDays <> $workingDays){
                    $inc_actualPresentDays = $actualPresentDays + 1;
                }
                else
                {
                    $inc_actualPresentDays = $actualPresentDays;
                }

                 
              }
              else
              {
                $inc_actualPresentDays =$actualPresentDays;
              }

              $noOfAbsentDaysOfSalary= ($workingDays) - ($inc_actualPresentDays);
              //print_r($noOfAbsentDaysOfSalary);//exit;//6
              
              $getPerDaySalary = ($totalSalary)/31;
             
              /* get salary of employee in Rs */
              $getEmpAbsentDaySalaryInRs = ($getPerDaySalary) * ($noOfAbsentDaysOfSalary);
              $getSal = ($totalSalary) - ($getEmpAbsentDaySalaryInRs);
              //print_r($getSal);//exit;
            }else
            {
              $getSal = '00';
            }

        $data=array(
        'attendenceHistory'=>$attendenceHistory,
        "totalDaysInMonth"=>$totalDaysInMonth,
        'holidays'=>$holidays,
        "totalSundays"=>$totalSundays,
        "allotedHolidays"=>$allotedHolidays[0],
        "workingDays"=>$workingDays,
        'monthly_attendence'=>count($totAttendence),
        "AbsentAttendence"=>$AbsentAttendence,
        'monthly_latemarks'=>count($totlm),
        'latemarkhalfday'=>count($latemark_halfday),
        'latemark_Abs'=>count($latemarkAbs),
        'halfday'=>count($tot_halfday),
        'actual_PresentDays'=>$actualPresentDays,
        'empId' =>$_POST['empId'],
        'getSal'=>$getSal,
        );
        $this->load->view('loginhistory/append_emp_login_details',$data);
    }

   public function task_details_list()
    {

    //  print_r($_POST);exit;
            $attendenceHistory= $this->Crud_model->GetData('attendence','',"emp_id='".$_POST['empId']."'",'','date DESC');
            //print_r($attendenceHistory); exit();
      $data=array(
         'attendenceHistory'=>$attendenceHistory,
      );

        $this->load->view('loginhistory/task_details_list',$data);
      
    }

}
?>