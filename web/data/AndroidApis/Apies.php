<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Apies extends REST_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('Api_model');
    }
		
	/*for user registration*/
	function register_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$employeeDetails=json_decode($this->_request, true);
	  	if(!empty($employeeDetails))
	  	{
	  		$chk_email = $this->Crud_model->GetData('users',"id","email='".$employeeDetails['email']."'",'','',"","1");
			if(!empty($chk_email))
  			{
  				$result= array('success' =>0, "Data" =>"Email already exist!");
	  			$this->response($result, REST_Controller::HTTP_OK);
  			}
  			else
  			{		
	  			if($employeeDetails['image']!='')
			    {
              		$image = base64_decode($employeeDetails['image']);
                    $image_name = $employeeDetails['image'];
                    $path_parts = pathinfo($image_name);
                  	$ext = 'png';
                    $attachment = time().'_'.rand(100,999).'.'.$ext;
                    $path = FCPATH."/uploads/users/".$attachment;
                    file_put_contents($path,$image);
                    $image=$attachment;
              	}      
	            else
	            {
	                $image= '';
	            }
				$data = array(
	                    	'name'=>$employeeDetails['name'],
	                        'email'=>$employeeDetails['email'],
	                       	'password'=>md5($employeeDetails['password']),
	                       	'show_password'=>$employeeDetails['password'],
	                       	'gender'=>$employeeDetails['gender'],
	                       	'image'=>$image,
	                       	'created'=>date('Y-m-d'),
	            );
		        $this->Crud_model->SaveData("users",$data);
		        $result= array('success' =>1, "Data" =>"Users created successfully!");
		        $this->response($result, REST_Controller::HTTP_OK);
			}  	
			 	
		}
	  	else
	  	{
	  		$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  		$this->response($result, REST_Controller::HTTP_OK);
	  	}	
	}

	/*for user login*/	
	function login_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$this->_request=json_decode($this->_request, true);
	  	if(!empty($_REQUEST['email']) and !empty($_REQUEST['password']))
	    {
	    	$cond = "email='".$_REQUEST['email']."' && password='".md5($_REQUEST['password'])."'";
	    	$chk_login = $this->Api_model->GetData("users",'',$cond,'','','','1');
		    if(!empty($chk_login))
		    {  
		        $data = array(
		                  'id' => $chk_login->id,
		                  'user_name'=>$chk_login->name,
		                  'user_email'=>$chk_login->email,
		                  );  

				$response['success'] = '1';
		        $response['message'] = "Logged in successfully";
		        $this->response($response, REST_Controller::HTTP_OK);
		    }
		    else
		    {
		        $result= array('success' =>0, "message" => "Login credentials are wrong. Please try again!");
		        $this->response($result, REST_Controller::HTTP_OK);
		    }
	  	}
	  	else
	  	{
	     	$result = array('success' => 0,"message" => "Unsupported or invalid parameters, or missing required parameters.");
	     	$this->response($result, REST_Controller::HTTP_BAD_REQUEST);
	    }
	}

}