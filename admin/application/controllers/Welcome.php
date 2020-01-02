<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	function _construct()
	{
		parent::_construct();
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	public function index()
	{
           $currentMonth= date('m');
          $currentYear= date('Y');
          $date1 = "$currentYear-$currentMonth-01";
          
          $first_day = date('N',strtotime($date1));
          $first_day = 7 - $first_day + 1;
          $last_day =  date('t',strtotime($date1));
          $days = array();
          $sundays = array();
          $GETSUNDAY = array();
          for($i=$first_day; $i<=$last_day; $i=$i+7 )
          {
          		 $ii ="0";	
          		if($i < 10)
          		{
          			$ii ='0'.''.$i;
          		}
          		else
          		{
          			$ii = $i;
          		}
             $days[] =date('Y').'-'.date('m').'-'.$ii;
         
          }  
          
          $holidays =$this->Crud_model->GetData('holidays','date',"status='Active' and 'date'='".date('Y-m-d')."'",'','','','1');
         
         $chkSunday= in_array(date('Y-m-d'), $days);

        if(empty($holidays) && empty($chkSunday))
        {	
    
			$getEmp= $this->Crud_model->GetData('admin','',"id not in (select emp_id from attendence where date='".date('Y-m-d')."') and status='Active'");
			if(!empty($getEmp))
			{
				foreach ($getEmp as $EMP) 
				{
					
					$absentemp= array(
					'emp_id'=>$EMP->id,
					'date'=>date('Y-m-d'),
					'in_time'=>"00:00:00",
					'out_time'=>"00:00:00",
					'status'=>"Absent",
					'created'=>date('Y-m-d H:i:s')
				);
					if(date('H:i:s')>'17:00:00')
					{

				$this->Crud_model->SaveData('attendence',$absentemp);
					}
				}
			}
		}
		
		$data = array(
			'email_id' =>"email_id",
			'password'=>"password", 
			"actionUrl"=>site_url("Welcome/actionLogin"),
		);
		$this->load->view('index',$data);
	}

	public function actionLogin()
	{   
		$this->rules_login();
		if ($this->form_validation->run() == FALSE)
		{
			redirect();
		}
		else
		{ 
			$cond = "email='".$_POST['email_id']."' and password='".md5($_POST['password'])."' and a.status='Active'";
			$checkLoginUser = $this->Crud_model->getuserdata($cond);
			
			if(!empty($checkLoginUser)) 
			{
				$sess['SESSION_NAME'] =array(
					"id"=>$checkLoginUser->id,
					"name"=>$checkLoginUser->name,
					"email_id"=>$checkLoginUser->email,
					"designation"=>$checkLoginUser->designation_name,
					"status"=>$checkLoginUser->status,
				);

				$this->session->set_userdata($sess);
				redirect(site_url('Welcome/dashboard'));
			}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert alert-block alert-danger text-center">Email and Password not matched</div>');
				redirect(site_url('Welcome/index'));
			}
			}	
	}
	
	public function _rules(){
		$this->form_validation->set_rules('email_id', 'Email_id','required');
		$this->form_validation->set_rules('password', 'Password', 'required',
			array('required' => 'please enter correct %s.'));
		$this->form_validation->set_error_delimiters('<p>', '</p>');
		$this->form_validation->setSuccessDelimiters('<p style="color: green">', '</p>');
	}
	public function rules_login()
	{
		$this->form_validation->set_rules('email_id', 'Email id', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$this->form_validation->set_error_delimiters('<span class="text-danger">','</span>');
	}

	public function dashboard()
	{	
	  
	  if(!empty($_SESSION['SESSION_NAME']))
	  {
	      
		$get_employee = $this->Crud_model->GetData('admin',"","status='Active' and designation_id!='4' and designation_id!='5'");
		$count_emp = count($get_employee);

		$get_developer = $this->Crud_model->GetData('admin',"","status='Active' and designation_id='8'");
		$count_dev = count($get_developer);

		$get_telecoller = $this->Crud_model->GetData('admin',"","status='Active' and designation_id='2'");
		$count_tel = count($get_telecoller);

		$get_marketing = $this->Crud_model->GetData('admin',"","status='Active' and designation_id='3'");
		$count_mar = count($get_marketing);

		if($_SESSION['SESSION_NAME']['designation']!='admin') 
		{
			$t_cond = "status='Active' and assign_to='".$_SESSION['SESSION_NAME']['id']."'";
			$day_cond = "status='Active' and date='".date('Y-m-d')."' and created_by='".$_SESSION['SESSION_NAME']['id']."'";
			$follo_cond ="status='Active' and follop_date='".date('Y-m-d')."' and (created_by='".$_SESSION['SESSION_NAME']['id']."' || assign_to='".$_SESSION['SESSION_NAME']['id']."')";
		  $pvt_ltd_cond ="follow_date='".date('Y-m-d')."' and assign_id='".$_SESSION['SESSION_NAME']['id']."'";
			$LLP_cond ="follow_date='".date('Y-m-d')."' and assign_id='".$_SESSION['SESSION_NAME']['id']."'";
		$pvt_t_cond = "assign_id='".$_SESSION['SESSION_NAME']['id']."'";
		$LLP_total_assign = "assign_id='".$_SESSION['SESSION_NAME']['id']."'";
			$appo_cond="status='Active' and appoint_date='".date('Y-m-d')."' and created_by='".$_SESSION['SESSION_NAME']['id']."' and assign_to='".$_SESSION['SESSION_NAME']['id']."'";
			$required_cond ="status='Active' and employee_name='".$_SESSION['SESSION_NAME']['id']."'";
			$students_cond ="status='Active' and follop_date='".date('Y-m-d')."'";
			$today_task ="emp_id='".$_SESSION['SESSION_NAME']['id']."' and date='".date('Y-m-d')."'";
		}
		else
		{
			$t_cond = "status='Active'";	
			$day_cond = "status='Active' and date='".date('Y-m-d')."'";
			$follo_cond ="status='Active' and follop_date='".date('Y-m-d')."'";
			$students_cond ="status='Active' and follop_date='".date('Y-m-d')."'";
	    	$pvt_ltd_cond ="follow_date='".date('Y-m-d')."'";
			$LLP_cond ="follow_date='".date('Y-m-d')."'";
	     	$pvt_t_cond ="assign_id!='0'";
			$LLP_total_assign ="assign_id!='0'";
			$appo_cond ="status='Active' and appoint_date='".date('Y-m-d')."'";
			$required_cond ="status='Active'";
			$today_task ="date='".date('Y-m-d')."'";
		}
        //	$follo_cond ="status='Active' and follop_date='".date('Y-m-d')."' and created_by='".$_SESSION['SESSION_NAME']['id']."' and assign_to='".$_SESSION['SESSION_NAME']['id']."'";
		$total_lead = $this->Crud_model->GetData('manage_lead','',$t_cond);
		$count_lead = count($total_lead);
		$day_lead = $this->Crud_model->GetData('manage_lead','',$day_cond);
		$count_daylead = count($day_lead);

		$today_followup = $this->Crud_model->GetData('manage_lead','',$follo_cond);
		$count_foll = count($today_followup);
		$task_assign = $this->Crud_model->GetData('multiple_task','',$today_task);
        $count_pvt = $this->Crud_model->GetData('company_data','',$pvt_ltd_cond);
        $total_pvt = $this->Crud_model->GetData('company_data','',$pvt_t_cond);
		$count_LLP = $this->Crud_model->GetData('llp_company_data','',$pvt_ltd_cond);
		$total_LLP_count = $this->Crud_model->GetData('llp_company_data','',$LLP_total_assign);
		$today_appointment = $this->Crud_model->GetData('manage_lead','',$appo_cond);

		$count_app = count($today_appointment);

		$total_quotation = $this->Crud_model->GetData('quotation');
		$count_quo = count($total_quotation);

		$today_attendance = $this->Crud_model->GetData('attendence','',"status='Present' and date='".date('Y-m-d')."' and emp_id!='1' and emp_id!='5'");
		$count_attend = count($today_attendance);
		
		$today_req = $this->Crud_model->GetData('requirement','',$required_cond);

		$count_req = count($today_req);

		$employee_data = $this->Crud_model->GetData('employee_data','',"status='Active'");
	
		$customer = $this->Crud_model->GetData('customer_master','',"status='Active'");
		$products = $this->Crud_model->GetData('invoice_gst_log');
		$products1 = $this->Crud_model->GetData('invoice_wo_gst_log');

		$total_products = count($products)+count($products1);

		// filter search bar

		if(!empty($_POST['name_id']) || !empty($_POST['date']))
		{
			$cond ="a.status='Present' and ad.designation_id!='4' and ad.designation_id!='5'";
		}
		else
		{
			$cond ="a.date='".date('Y-m-d')."' and ad.designation_id!='4' and ad.designation_id!='5' and a.status='Present'";
		}

		if(!empty($_POST['name_id']))
		{
			$name_id =$_POST['name_id'];

			$cond.=" and a.emp_id='".$name_id."'";
		}

		if(!empty($_POST['date']))
		{
			$date = date('Y-m-d',strtotime($_POST['date']));

			$cond.=" and a.date='".$date."'";
		}

		$today_std = $this->Crud_model->GetData('students','',$students_cond);
	    $count_std = count($today_std);
    
		$get_empData = $this->Crud_model->get_employeedata($cond);
		
	//	print_r($get_empData);exit;
		
		$session_deg = $_SESSION['SESSION_NAME']['designation'];
		$get_empName = $this->Crud_model->GetData('designation',"","status='Active' and designation_name='".$session_deg."'","","","","1");
		$get_name = $this->Crud_model->GetData('admin','id,name',"status='Active' and designation_id!='4' and designation_id!='5'");
		//print_r($get_name);exit;

		$getdob = $this->Crud_model->GetData('admin','id,name',"status='Active' and RIGHT(birthday,'5')='".date('m-d')."'","","","","");
	   $get_holiday = $this->Crud_model->GetData('holidays','',"status='Active' and date >='".date('Y-m-d')."'","","","","");
	   $project_demo = $this->Crud_model->GetData('project_demo_details','',"status='Active'","","","","");
	    $total_expenses = $this->Crud_model->GetData('expences','',"","","","","");
		$total_expenses_sum = $this->Crud_model->GetData('expences','SUM(amount) as total_amount',"","","","","1");

		$data  = array(
			'logout' =>site_url("Welcome/logData"),
			'total_customer' =>count($customer),
			'total_products' =>$total_products,
			'get_marketing' =>count($get_marketing),
			'get_telecoller' =>count($get_telecoller),
			'get_developer' =>count($get_developer),
			'get_employee' =>count($get_employee),
			'total_lead' =>count($total_lead),
			'employee_data' =>count($employee_data),
			'day_lead' =>count($day_lead),
			'today_followup' =>count($today_followup),
			'today_appointment' =>count($today_appointment),
			'total_quotation' =>count($total_quotation),
			'today_attendance' =>count($today_attendance),
			'$today_req' =>count($today_req),
			'get_empData' =>$get_empData,
			'get_empName' =>$get_empName,
			'count_emp' =>$count_emp,
			'count_dev' =>$count_dev,
			'count_tel' =>$count_tel,
			'count_mar' =>$count_mar,
			'count_lead' =>$count_lead,
			'count_daylead' =>$count_daylead,
			'count_foll' =>$count_foll,
			'count_app' =>$count_app,
			'count_quo' =>$count_quo,
			'count_attend' => $count_attend,
			'get_name' => $get_name,
			'getdob' => count($getdob),
			'count_req' => $count_req,
			'count_std' => $count_std,
			'getdob' => count($getdob),
			'get_holiday' => count($get_holiday),
			'project_demo' => count($project_demo),
			'total_expenses_sum' => $total_expenses_sum,
			'count_pvt' => count($count_pvt),
			'count_LLP' => count($count_LLP),
			'total_pvt' => count($total_pvt),
			'total_LLP_count' => count($total_LLP_count),
			'task_assign' => count($task_assign),
		);
		$this->load->view('dashboard',$data);
		
	  }
	  else
	  {
	      redirect('Welcome');
	  }
	  
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
  
public function logData()
	{
		
		$check = $this->Crud_model->GetData('attendence',"","emp_id='".$_SESSION['SESSION_NAME']['id']."' and date='".date('Y-m-d')."'",'','','','1');

		if(!empty($check))
		{
			$data =array(
				'out_time'=>date('H:i:s'),
				'remark'=>$this->input->post('remark'),
				'created'=>date('Y-m-d H:i:s'),
	            'modified'=>date('Y-m-d H:i:s'),
			);
			$cond="emp_id='".$_SESSION['SESSION_NAME']['id']."' and date='".date('Y-m-d')."'";
         	$this->Crud_model->SaveData('attendence',$data,$cond);

		}
		
	}
	
	public function logOut()
	{
		session_destroy();
		redirect();
	}
	
	public function profile()
	{
		$user_id = $_SESSION['SESSION_NAME']['id'];
		$con = "id='".$user_id."'";
		$userData = $this->Crud_model->get_single('users',$con);
		if (!file_exists('uploads/'.$userData->profile)) 
		{
			if (!empty($userData->profile)) {
				$imageProfile = base_url('uploads/'.$userData->profile);
			}else{
				$imageProfile = base_url('uploads/default1.png');
			}
		}
		else
		{
			$imageProfile = base_url('uploads/default1.png');
		}
				
			$data =array(
				'actionProfile'=>site_url('Welcome/actionProfile'),
				'actionPassword'=>site_url('Welcome/actionPassword'),
				'row'=>$userData,
			);
			$this->load->view('login/profile',$data);
		}
		
	
	public function actionProfile()
	{
		$user_id = $_SESSION['SESSION_NAME']['id'];
		$con = "id='".$user_id."'";
		$userData = $this->Crud_model->get_single('users',$con);
		if(!empty($userData)) 
		{ 
			if( $_FILES['profile']['name']!='' )
			{
				$_POST['profile']= rand(0000,9999)."_".$_FILES['profile']['name'];
				$config2['image_library'] = 'gd2';
				$config2['source_image'] =  $_FILES['profile']['tmp_name'];
				$config2['new_image'] =   getcwd().'/uploads/profile/'.$_POST['profile'];
				$config2['upload_path'] =  getcwd().'/uploads/profile/';
				$config2['allowed_types'] = 'png|PNG';
				$config2['maintain_ratio'] = FALSE;
				$this->image_lib->initialize($config2);
				if(!$this->image_lib->resize())
				{
					echo('<pre>');
					echo ($this->image_lib->display_errors());
					exit;
				}
				$image  = $_POST['profile'];
				$data = array(
					'name' => ucwords($_POST['name']), 
					'email' => $_POST['email'], 
					'mobile_no' => $_POST['mobile'], 
					'profile'=>$image,
				);
				$save = $this->Crud_model->SaveData('users',$data,$con);
			}
			else
			{
				$data = array(
					'name' => ucwords($_POST['name']), 
					'email' => $_POST['email'], 
					'mobile_no' => $_POST['mobile'], 
				);
				$save = $this->Crud_model->SaveData('users',$data,$con);
			}
			$this->session->set_flashdata('message', 'Profile updated successfully');
			redirect('Welcome/profile');
		}
		else
		{
			redirect('Welcome/profile');
		}
		
		
	}
	public function actionPassword()
	{
		$user_id = $_SESSION['avinash']['id'];
		$con = "id='".$user_id."'";
		$userData = $this->Crud_model->get_single('users',$con);
		if (!empty($userData))
		{
			$oldPass = $_POST['oldPass'];
			$newPass = $_POST['newPass'];
			$confPass = $_POST['confPass'];
			if ($userData->password==md5($oldPass)) {

				if ($newPass==$confPass) {

					$data = array(
						'password' => md5($_POST['newPass']),  
					);
					$save = $this->Crud_model->SaveData('users',$data,$con);

					session_destroy();
					redirect("Welcome/index");
				}else{
					redirect("Welcome/profile");
				}

			}else{

				redirect('Welcome/profile');
			}
		}else{

			redirect('Welcome/index');
		}

	}
	public function change_password()
	{
		$data =array(
			'heading'=>'Change Password',
			'password'=>set_value('password'),
			'n_password'=>set_value('n_password'),
			'cn_password'=>set_value('cn_password'),
		);
		$this->load->view('login/change_password',$data);
	}
	public function change_password_action()
	{
		if($_SESSION['SESSION_NAME']['login_type']=='admin')
		{
			$condition="id='".$_SESSION['SESSION_NAME']['id']."'";
			$row=$this->Crud_model->GetData('users','',$condition,'','','','single');
			
			if(md5($this->input->post('cpassword'))==$row->password)
			{
				if($this->input->post('npassword')==$this->input->post('cnpassword'))
				{
					$password=md5($this->input->post('npassword'));
					$data=array('password'=>$password,'show_password'=>$this->input->post('cnpassword'));
					$this->Crud_model->SaveData('users',$data,$condition);
					session_destroy();
					
				}
				else
				{
					echo "1";exit;
					
				}
			}
			else
			{
				echo "2";exit;
				
			}
		}
		else
		{
			$condition="id='".$_SESSION['SESSION_NAME']['id']."'";
			$row=$this->Crud_model->GetData('employees','',$condition,'','','','single');

			if(md5($this->input->post('cpassword'))==$row->password)
			{
				if($this->input->post('npassword')==$this->input->post('cnpassword'))
				{
					$password=md5($this->input->post('npassword'));
					$data=array('password'=>$password);
					$this->Crud_model->SaveData('employees',$data,$condition);
					session_destroy();
					
				}
				else
				{
					echo "1";exit;
				}
			}
			else
			{
				echo "2";exit;
			}
		}		
	}
}
