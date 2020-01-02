<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 * 
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function _construct()
	{
		parent::_construct();
		//$this->load->helper('url');
		//$this->load->model('Crud_model');
		 //$this->load->();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('image_lib');
		$this->load->library('uploads');

	}
	public function index()
	{
		$data = array(
				'email_id' =>"email_id",
				'password'=>"password", 
				"actionUrl"=>site_url("Welcome/actionLogin"),
			);
		//print_r($data);exit;
		$this->load->view('index',$data);
	}
	public function _rules()
	{
		$this->form_validation->set_rules('email_id', 'Email_id','required');
		$this->form_validation->set_rules('password', 'Password', 'required',
                array('required' => 'please enter correct %s.'));
		$this->form_validation->set_error_delimiters('<p>', '</p>');
        $this->form_validation->setSuccessDelimiters('<p style="color: green">', '</p>');
	}
	public function actionLogin()
	{   

		$cond = "email='".$_POST['email_id']."' and password='".$_POST['password']."'";
		$checkLoginUser = $this->Crud_model->get_single("admin",$cond);

		//print_r($this->db->last_query());exit();

		if (!empty($checkLoginUser)) 
		{
			$_SESSION['admin'] =array(
					"id"=>$checkLoginUser->id,
					"name"=>$checkLoginUser->name,
					"email_id"=>$checkLoginUser->email,
					"status"=>$checkLoginUser->status,
					"admin_type"=>$checkLoginUser->admin_type,
					);

			$session_id = $this->session->userdata($_SESSION);
			redirect('Welcome/dashboard');
			//print_r($_SESSION['avinash']['id']);exit();
		}else{
		
			$this->session->set_flashdata('message', '<div class="alert alert-block alert-danger text-center">Email and Password not matched</div>');
				redirect(site_url('Welcome/index'));
		}
	}
	public function dashboard()
	{
		
		if(empty($_SESSION['admin']['id']))
		{
			redirect('welcome/index');
		}
		
		// Check Assign users Expiry
		$this->checkAssignUsers();
		$GetCustomers = $this->Crud_model->GetData('users','',"status='Active' and  is_delete='No'");
		$GetEmployees = $this->Crud_model->GetData('employees','',"status='Active' and  is_delete='No'");
		$GetOrders = $this->Crud_model->GetData('service_orders','',"status='Active' and  is_delete='No'");
		$GetProducts = $this->Crud_model->GetData('subcategories','',"status='Active' and  is_delete='No'");
		$GetTodaysOrders = $this->Crud_model->GetData('service_orders','',"status='Active' and  is_delete='No' and booking_date='".date('Y-m-d')."'");
		$GettotalPayments = $this->Crud_model->GetData('service_orders','sum(final_amount) as sum',"status='Active' and  is_delete='No' and (payment_status='Done' or payment_status='Pending')",'','','','1');
		$GettotalTodayPayments = $this->Crud_model->GetData('service_orders','sum(final_amount) as sum',"status='Active' and  is_delete='No' and payment_status='Done'",'','','','1');
		$PendingPayments = $this->Crud_model->GetData('service_orders','sum(final_amount) as sum',"status='Active' and  is_delete='No' and payment_status='Pending'",'','','','1');

		$GetCancelOrders = $this->Crud_model->GetData('service_orders','',"status='Active' and  is_delete='No'  and order_status='Cancel'");

		$GetTodaypayment = $this->Crud_model->GetData('service_orders','sum(final_amount) as sum',"status='Active' and  is_delete='No' and booking_date='".date('Y-m-d')."' and (payment_status='Done' or payment_status='Pending') and (order_status='Done' or order_status='Pending')",'','','','1');


		$GetTodayEarn = $this->Crud_model->GetData('service_orders','sum(final_amount) as sum',"status='Active' and  is_delete='No' and booking_date='".date('Y-m-d')."' and payment_status='Done'");

		$emp_data = $this->Crud_model->GetData('employees','id,name',"is_delete='No' and status='Active' and created_by='".$_SESSION['admin']['id']."'");

		//print_r($emp_data);exit;


		$data  = array(
						'logout' =>site_url("Welcome/logOut"),
						'GetCustomers' =>count($GetCustomers),
						'GetEmployees' =>count($GetEmployees),
						'GetOrders' =>count($GetOrders),
						'GetProducts' =>count($GetProducts),
						'GetTodaysOrders' =>count($GetTodaysOrders),
						'GettotalPayments' =>$GettotalPayments->sum,
						'GettotalTodayPayments' =>$GettotalTodayPayments->sum,
						'PendingPayments' =>$PendingPayments->sum,
						'GetCancelOrders' =>count($GetCancelOrders),
						'GetTodaypayment' =>$GetTodaypayment->sum,
						'GetTodayEarn' =>$GetTodayEarn,
						'emp_data' =>$emp_data,
					);
		$this->load->view('dashboard',$data);
	} 
	public function logOut()
	{
		session_destroy();
		redirect('welcome/index');
	}
	public function profile()
	{
		//print_r($_SESSION);exit;

		$user_id = $_SESSION['admin']['id'];
		$con = "id='".$user_id."'";	
		$userData = $this->Crud_model->get_single('admin',$con);
		//print_r($userData);//exit();
		if (!empty($userData)) 
		{
			//print_r("hii");exit();
			if (file_exists('uploads/adminlog/'.$userData->profile)) 
			{
			    if (!empty($userData->profile)) 
			    {
			      $imageProfile = base_url('uploads/adminlog/'.$userData->profile);
			    }
			    else
			    {
			      $imageProfile = base_url('uploads/adminlog/default1.png');
			    }
			  }
			  else
			  {
			    $imageProfile = base_url('uploads/adminlog/default1.png');
			  }

			$data =array(
							'actionProfile'=>site_url('Welcome/actionProfile'),
							'actionPassword'=>site_url('Welcome/actionPassword'),
							'name'=>$userData->name,
							'email'=>$userData->email,
							'user_type'=>$userData->admin_type,
							'profilePhoto'=>$imageProfile,
							'profile'=>$userData->profile,
						);
			$this->load->view('login/profile',$data);
		}else{
			//print_r("byy");exit();
			redirect('Welcome/index');
		}
	}
	public function actionProfile()
	{

		//print_r($_FILES);exit;

		$user_id = $_SESSION['admin']['id'];
		$con = "id='".$user_id."'";
		$userData = $this->Crud_model->get_single('admin',$con);
		if (!empty($userData)) 
		{

			 	if($_FILES['image']['name']!='')
                {  
                     $src = $_FILES['image']['tmp_name'];
                      $filEnc = time();
                      $avatar= rand(0000,9999)."_".$_FILES['image']['name'];
                      $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                      $dest =getcwd().'/uploads/adminlog/'.$avatar1;
                    
	                if(move_uploaded_file($src,$dest))
	                {
	                        $img  = $avatar1; 
	                        unlink('/uploads/adminlog/'.$_POST['old_image']);        
	                }
                }
                else
                {
                    $img = $_POST['old_image'];
                }

			$data = array(
				'name' => $_POST['name'], 
				'email' => $_POST['email'], 
				'profile' =>$img, 
				);

			//print_r($data);exit;


			$save = $this->Crud_model->SaveData('admin',$data,$con);
			//print_r($this->db->last_query());exit;
			redirect("Welcome/profile");
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
				//print_r("if");exit();
				if ($newPass==$confPass) {
					//print_r("check");exit();
					$data = array(
						'password' => md5($_POST['newPass']),  
					);
					$save = $this->Crud_model->SaveData('users',$data,$con);
					//print_r($this->db->last_query());exit;
					session_destroy();
					redirect("Welcome/index");
				}else{
					//new and old password wrong
					//print_r("new and confirm password wrong");exit();
					redirect("Welcome/profile");
				}
				
			}else{
				//print_r("false");exit();
				redirect('Welcome/profile');
			}
		}else{
			//logout session
			redirect('Welcome/index');
		}
		
	}

	public function checkAssignUsers()
	{
		//$now = strtotime("now");

      	$users = $this->Crud_model->GetData('users','id,name,datefrom,dateto',"is_delete='No' and status='Active' and user_hold='Customer_Hold' and dateto < '".date('Y-m-d')."'");

    	//print_r($users);exit;

	     foreach ($users as $key)
	    {

          	$data=array(
	            'datefrom'=>'0000-00-00',
	            'dateto'=>'0000-00-00',
	            'user_hold'=>"Customer_Regular",
          	);

          	$this->Crud_model->SaveData('users',$data,"id='".$key->id."'");
	    }

	   	$users_join = $this->Crud_model->GetData('users','id,name,datefrom,dateto',"is_delete='No' and status='Active' and user_status='Customer_Join' and dateto < '".date('Y-m-d')."'");

	     foreach ($users_join as $row)
	    {

          	$data=array(
	            'datefrom'=>'0000-00-00',
	            'dateto'=>'0000-00-00',
	            'user_hold'=>"Customer_Regular",
          	);

          	$this->Crud_model->SaveData('users',$data,"id='".$row->id."'");
	    }
    
      

	}

	public function assign_today_milk()
	{
	
		if(!empty($_POST))
		{

			$check_today = $this->Crud_model->GetData('milk_day_wise_assign_emp','',"emp_id='".$_POST['emp_id']."' and date='".date('Y-m-d')."'");

			if(empty($check_today))
			{
				$data=array(
				'emp_id'=>$_POST['emp_id'],
				'quantity'=>$_POST['milk_qua'],
				'date'=>date('Y-m-d'),
				);

				$this->Crud_model->SaveData('milk_day_wise_assign_emp',$data);

				redirect('Welcome/dashboard');

			}
			else
			{
				$data=array(
				'emp_id'=>$_POST['emp_id'],
				'quantity'=>$_POST['milk_qua'],
				'date'=>date('Y-m-d'),
				);

				$this->Crud_model->SaveData('milk_day_wise_assign_emp',$data,"emp_id='".$_POST['emp_id']."' and date='".date('Y-m-d')."'");

				redirect('Welcome/dashboard');
			}
	
		}
		else
		{
			redirect('Welcome/dashboard');
		}


	}


}
