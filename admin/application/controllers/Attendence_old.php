<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Attendence extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        //$this->load->model('Employees_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
      { 

          $attendenceHistory= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."'",'','id desc','','');
          $totAttendence= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."'",'','','','');
          $totlm= $this->Crud_model->GetData('attendence','late_time',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."' and late_time='1'",'','','','');
          //print_r($this->db->last_query()); exit;
          $tot_halfday= $this->Crud_model->GetData('attendence','halfday',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."' and halfday='1'",'','','','');
          $latemark_halfday= $this->Crud_model->GetData('attendence','latemark_halfday',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."' and latemark_halfday='1'",'','','','');
         
         
          $checklatemark= $this->Crud_model->GetData('attendence','',"latemark_halfday='1' and emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."'");

          $latemarkAbs= $this->Crud_model->GetData('attendence','',"latemark_absent='1' and emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."'");

          $actualPresentDays=count($totAttendence)-count($latemarkAbs)-(count($tot_halfday)*0.5)-(count($latemark_halfday)*0.5);

            $data=array(
              'attendenceHistory'=>$attendenceHistory,
              'monthly_attendence'=>count($totAttendence),
              'monthly_latemarks'=>count($totlm),
              'halfday'=>count($tot_halfday),
              'latemarkhalfday'=>count($latemark_halfday),
              'latemark_Abs'=>count($latemarkAbs),
              'actual_PresentDays'=>$actualPresentDays,
              
            );
            $this->load->view('Attendence/attendence_history',$data);
      }
  
public function makeattendence()
  {

        $check = $this->Crud_model->GetData('attendence',"","emp_id='".$_SESSION['SESSION_NAME']['id']."' and date='".date('Y-m-d')."'",'','','','1');
        if(empty($check)) 
        {  
          
          $stdTime="10:01:00";
          $markHalfDay="12:01:00";
          $markAbsent="17:00:00";
            if(date('H:i:s')>$markHalfDay)
            {  
              $halfday='1';
              $latemark='0';
            }
            else
            {
              
                if(date('H:i:s')>$stdTime)
                { 
                  $latemark='1';
                   $halfday='0';
                }
                else
                { 
                  $latemark='0';
                  $halfday='0';
                }
                
            }
            
            $data=array(
                'emp_id'=>$_SESSION['SESSION_NAME']['id'],
                'date'=>date('Y-m-d'),
                'in_time'=>date('H:i:s'),
                'late_time'=>$latemark,
                'late_time1'=>$latemark,
                'halfday'=>$halfday,
                'status'=>'Present',
                'created'=>date('Y-m-d H:i:s'),

            );
          
            $this->Crud_model->SaveData('attendence',$data);
            $last_id= $this->db->insert_id();
          
           $checklatemark= $this->Crud_model->GetData('attendence','',"late_time1='1' and emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."'");
           $checkhalfday= $this->Crud_model->GetData('attendence','',"late_time1='2' and emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."'");
            
            $counthalfday=count($checkhalfday);
            if($counthalfday==2)
            { 
             
              $late_abs= array(
                'latemark_absent'=>'1',
                'late_time1'=>'-1',
              );
               $this->Crud_model->SaveData('attendence',$late_abs,"id='".$last_id."'");

               foreach ($checkhalfday as $lateabs) 
              {
               $late_upd=array(
                           'late_time1'=>'-1',
                            'latemark_halfday'=>'0',
                        );
                    $this->Crud_model->SaveData('attendence',$late_upd,"id='".$lateabs->id."'");       
              } 
            }

           $latecount=count($checklatemark);
           if(count($checklatemark)==2)
           {
             $LateTime=array(
                'latemark_halfday'=>'1',
            );
            
            $this->Crud_model->SaveData('attendence',$LateTime,"id='".$last_id."'");
            foreach ($checklatemark as $late) 
            {
               $late_upd=array(
                           'late_time1'=>'2',
                        );
                    $this->Crud_model->SaveData('attendence',$late_upd,"id='".$late->id."'");
            }
           
          }
           }
           $MonthWiseDetails= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."'",'','','','');
         
           if(!empty($MonthWiseDetails))
           {
            $monthlyDetail= $this->Crud_model->GetData('monthwise_emp_details','',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and month_year='".date('Y-m')."'");

             $latemarkAbs= $this->Crud_model->GetData('attendence','latemark_absent',"latemark_absent='1' and emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."'");
            // print_r($this->db->last_query()); exit;

             $tot_halfday= $this->Crud_model->GetData('attendence','halfday',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."' and halfday='1'",'','','','');

              $latemark_halfday= $this->Crud_model->GetData('attendence','latemark_halfday',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."' and latemark_halfday='1'",'','','','');

              $getEmpSalary= $this->Crud_model->GetData('admin','salary',"id='".$_SESSION['SESSION_NAME']['id']."'",'','','','1');
              if(!empty($getEmpSalary))
              {

              $empsalary=$getEmpSalary->salary;
              $salary_perday= $empsalary/31;
              $totlabs=count($latemarkAbs)+(count($tot_halfday)*0.5)+(count($latemark_halfday)*0.5);
              $deducted_salary=(count($MonthWiseDetails)-$totlabs)*$salary_perday;
              $paysalary= $empsalary-$deducted_salary;
              
              $actualPresentDays=count($MonthWiseDetails)-count($latemarkAbs)-(count($tot_halfday)*0.5)-(count($latemark_halfday)*0.5);
              //print_r($this->db->last_query())
            if(empty($monthlyDetail))
            {
            $monthlyData= array(
              'emp_id'=>$_SESSION['SESSION_NAME']['id'],
              'month_year'=>date('Y-m'),
              'working_days'=>count($MonthWiseDetails), 
              'actual_working_days'=>$actualPresentDays,
              'created'=>date('Y-m-d H:i:s'),
            );
           
            $this->Crud_model->SaveData('monthwise_emp_details',$monthlyData);
            } else
            { 
               $monthlyData1= array(
              'month_year'=>date('Y-m'),
              'working_days'=>count($MonthWiseDetails), 
              'actual_working_days'=>$actualPresentDays,
              'pay_salary'=>$paysalary, 
              'modified'=>date('Y-m-d H:i:s'),
            );
              // print_r($monthlyData1); exit;
            $this->Crud_model->SaveData('monthwise_emp_details',$monthlyData1,"emp_id='".$_SESSION['SESSION_NAME']['id']."'");
            }
            }


           }
           
            $checktime = $this->Crud_model->GetData('attendence',"","emp_id='".$_SESSION['SESSION_NAME']['id']."' and date='".date('Y-m-d')."'",'','','','1');

            $inTime=date("g:i a", strtotime($checktime->in_time));
            $data = array(
                'inTime'=>$inTime,
                'msg'=>'Login Time',
            );
           
        echo json_encode($data);
       
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

  /* function for show salary details  with their counts */

  public function viewLogin()
  {
    /*$currentMonth= date('m');
    $currentYear= date('Y');
    $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
    /* for total days in month */
    /*$currentMonth= date('m');
    $currentYear= date('Y');

    $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear); 
    $data =  array("totalDaysInMonth"=>$totalDaysInMonth,*/
                  /*);*/
    //print_r($number);exit;
   /* $this->load->view('Attendence/view_login',$data);*/
   
   /*print_r($holidays);exit;*/

   $attendenceHistory= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."'  and LEFT(date,7)='".date('Y-m')."'",'','id desc','','');
          /* Present entries */
          $totAttendence= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."' and status='Present'",'','','','');
          /* Absent entries */
          $AbsentAttendence= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."' and status='Absent'",'','','','');

          //print_r($this->db->last_query());exit;
          $totlm= $this->Crud_model->GetData('attendence','late_time',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."' and late_time='1'",'','','','');
          //print_r($this->db->last_query()); exit;
          $tot_halfday= $this->Crud_model->GetData('attendence','halfday',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."' and halfday='1'",'','','','');
          $latemark_halfday= $this->Crud_model->GetData('attendence','latemark_halfday',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."' and latemark_halfday='1'",'','','','');
         
          $checklatemark= $this->Crud_model->GetData('attendence','',"latemark_halfday='1' and emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."'");

          $latemarkAbs= $this->Crud_model->GetData('attendence','',"latemark_absent='1' and emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."'");

          $actualPresentDays=count($totAttendence)-count($latemarkAbs)-(count($tot_halfday)*0.5)-(count($latemark_halfday)*0.5);

          /* Holidays in month*/
          $allotedHolidays =$this->Crud_model->GetData('admin','',"id='".$_SESSION['SESSION_NAME']['id']."'");
          //print_r($allotedHolidays);exit;
          $holidays =$this->Crud_model->GetData('holidays','',"h_month='".date('m')."' and status='Active'");
          /* current month sundays*/
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
            
            /* total working days */
            $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
            $nonWorkingDays = ($totalSundays) + ($countHolidays) ;
            $workingDays = ($totalDaysInMonth) - ($nonWorkingDays); 


            $data=array(
              'attendenceHistory'=>$attendenceHistory,
              'monthly_attendence'=>count($totAttendence),
              'monthly_latemarks'=>count($totlm),
              'halfday'=>count($tot_halfday),
              'latemarkhalfday'=>count($latemark_halfday),
              'latemark_Abs'=>count($latemarkAbs),
              'actual_PresentDays'=>$actualPresentDays,
              'holidays'=>$holidays,
              "totalSundays"=>$totalSundays,
              "workingDays"=>$workingDays,
              "allotedHolidays"=>$allotedHolidays[0],
              "totalDaysInMonth"=>$totalDaysInMonth,
              "AbsentAttendence"=>$AbsentAttendence,
            );
            $this->load->view('Attendence/view_login',$data);

    }

    public function appendPageHistory()
    {
      //$data= array("month"=>$_POST['monthap1'],"year"=>$_POST['yearap1']);
      if($_POST['monthap1'] < 10){ $_POST['monthap1']='0'.$_POST['monthap1'];}else{$_POST['monthap1'];}
      $dt =$_POST['yearap1'].'-'.$_POST['monthap1'];
      //print_r($dt);
      //print_r(date('Y-m'));//exit;
      $attendenceHistory= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."'",'','id desc','','');

          $totAttendence= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".$dt."' and status='Present'",'','','','');

          /*$totAttendence= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".date('Y-m')."' and status='Present'",'','','','');*/
          /* Absent entries */
          $AbsentAttendence= $this->Crud_model->GetData('attendence','',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".$dt."' and status='Absent'",'','','','');

          //print_r($this->db->last_query());exit;

          //print_r($this->db->last_query());exit;
          $totlm= $this->Crud_model->GetData('attendence','late_time',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".$dt."' and late_time='1'",'','','','');
          //print_r($this->db->last_query()); exit;
          $tot_halfday= $this->Crud_model->GetData('attendence','halfday',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".$dt."' and halfday='1'",'','','','');
          $latemark_halfday= $this->Crud_model->GetData('attendence','latemark_halfday',"emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".$dt."' and latemark_halfday='1'",'','','','');
         
          $checklatemark= $this->Crud_model->GetData('attendence','',"latemark_halfday='1' and emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".$dt."'");

          $latemarkAbs= $this->Crud_model->GetData('attendence','',"latemark_absent='1' and emp_id='".$_SESSION['SESSION_NAME']['id']."' and LEFT(date,7)='".$dt."'");

          $actualPresentDays=count($totAttendence)-count($latemarkAbs)-(count($tot_halfday)*0.5)-(count($latemark_halfday)*0.5);

          /* Holidays in month*/
          $allotedHolidays =$this->Crud_model->GetData('admin','',"id='".$_SESSION['SESSION_NAME']['id']."'");
          //print_r($allotedHolidays[0]->salary);//exit;
          $holidays =$this->Crud_model->GetData('holidays','',"h_month='".$_POST['monthap1']."' and status='Active'");
          /* current month sundays*/
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
            
            /* total working days */
            $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
            //print_r($totalDaysInMonth);exit;
            $nonWorkingDays = ($totalSundays) + ($countHolidays) ;
            $workingDays = ($totalDaysInMonth) - ($nonWorkingDays); 

            /* count salary of the month */
            $totalSalary = $allotedHolidays[0]->salary;

            if($actualPresentDays && $totalSalary && ($dt <> date('Y-m')))
            {
              //$actualPresentDays ='20.5';
              $noOfAbsentDaysOfSalary= ($workingDays) - ($actualPresentDays);
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
            
            //print_r($getEmpSalaryInRs);//exit;
              $data=array(
              'attendenceHistory'=>$attendenceHistory,
              'monthly_attendence'=>count($totAttendence),
              'monthly_latemarks'=>count($totlm),
              'halfday'=>count($tot_halfday),
              'latemarkhalfday'=>count($latemark_halfday),
              'latemark_Abs'=>count($latemarkAbs),
              'actual_PresentDays'=>$actualPresentDays,
              'holidays'=>$holidays,
              "totalSundays"=>$totalSundays,
              "workingDays"=>$workingDays,
              "allotedHolidays"=>$allotedHolidays[0],
              "totalDaysInMonth"=>$totalDaysInMonth,
              "totAttendence"=>$totAttendence,
              'getSal'=>$getSal,
              "AbsentAttendence"=>$AbsentAttendence,
            );

      $this->load->view("Attendence/appendpagehistory",$data);
    }
  
}
?>