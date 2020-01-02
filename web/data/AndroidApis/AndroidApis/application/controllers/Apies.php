<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Apies extends REST_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Api_model');
	}
	
	
	 public function ordersave_post()
    {
        $this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);
	  	
	  	$emp_id =$jsonDecode['emp_id'];
	  	$customer_id =$jsonDecode['customer_id'];
	  	$quantity =$jsonDecode['quantity'];
	  	$product_type =$jsonDecode['product_type'];
	  	$emp_latitude =$jsonDecode['emp_latitude'];
	  	$emp_logitude =$jsonDecode['emp_logitude'];
	  	
	  	
	  	
	  	 if(!empty($emp_id) && !empty($customer_id) && !empty($quantity) && !empty($product_type) && !empty($emp_latitude) && !empty($emp_logitude))
        {
            $get_day = $this->Crud_model->GetData('days_wise_deliverys','',"date='".date('Y-m-d')."' and customer_id='".$customer_id."'",'','','','1'); 
            
                if(empty($get_day))
                {
                
                        $data = array(
                            'emp_id'=>$emp_id,
                            'customer_id'=>$customer_id,
                            'date'=>date('Y-m-d'),
                            'time'=>date('H:i:s'),
                            'quantity'=>$quantity,
                            'product_type'=>$product_type,
                            'emp_latitude'=>$emp_latitude,
                            'emp_longitude'=>$emp_logitude,
                            );
                            
                    $this->Crud_model->SaveData('days_wise_deliverys',$data);    
                    $result= array('success' =>1, "Data" =>"Save Data Successfully");  
                            
                }
                else
                {
                    $result= array('success' =>0, "Data" =>"Today Milk Deliverd");
                }
        }
        else
        {
            $result= array('success' =>0, "Data" =>"Field Required");
        }
        
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function getcustomers_post()
    {
        $this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);
	  	
	  	$employee_id =$jsonDecode['employee_id']; 
        
        if(!empty($employee_id))
        {
            $cond ="(u.executive_id='".$employee_id."' || u.empnew_id='".$employee_id."') and u.status='Active' and u.is_delete='No'";
           $customerData =$this->Api_model->getCustomerData($cond);
           
           
           $get_employee = $this->Crud_model->GetData('employees','id,name,mobile,',"id='".$employee_id."' and status='Active'",'','','','1');
           $cond_new ="(executive_id='".$employee_id."' || empnew_id='".$employee_id."') and status='Active' and is_delete='No'"; 
           $get_lister = $this->Crud_model->GetData('users','sum(pliter) as total_liter',$cond_new,'','','','1');
            
           if(!empty($customerData))
           {
               
                $result['employee_id'] =$get_employee->id;
                $result['employee_name'] =$get_employee->name;
                $result['employee_mobile'] =$get_employee->mobile;
                $result['total_liter'] =$get_lister->total_liter;
                $result['customers'] = array();
              foreach ($customerData as $row) 
	  		 {
	  		     
	  		     $get_day = $this->Crud_model->GetData('days_wise_deliverys','',"date='".date('Y-m-d')."' and customer_id='".$row->id."'",'','','','1');
	  		     
	  		     if(!empty($get_day))
	  		     {
	  		         $deliverd = "Yes";
	  		     }
	  		     else
	  		     {
	  		         $deliverd = "No";
	  		     }
	  		     
	  		   //  print_r($get_day);exit;
	  		     
	  		     
	  		        if(!empty($row->image))
		  			{
		  				if(file_exists('../uploads/users/'.$row->image))
	  		 			{

		  					$image= base_url('../uploads/users/'.$row->image);
		  				}
		  				else
		  				{
		  					$image = base_url('../uploads/users/images.jpg');
		  				}
		  			}
		  			else
		  			{
		  				$image = base_url('../uploads/users/images.jpg');
		  			}
	  			
	  		/*	if($row->pliter=='1')
	  			{
	  			    $get_price =$row->one_liter_price;
	  			    $liter ="One Liter";
	  			}
	  			else if($row->pliter=='2')
	  			{
	  			     $get_price =$row->half_liter_price;
	  			     $liter ="Half Liter";
	  			}
	  			else
	  			{
	  			    $get_price ="";
                    $liter ="0";
	  			}*/
	  			
	  				$data['custmer_id']=$row->id;
	  				$data['name']=ucfirst($row->name);
	  				$data['mobile']=$row->mobile;
	  				$data['latitude']=$row->latitude;
	  				$data['longitude']=$row->longitude;
	  				$data['address']=$row->address;
	  				$data['product_type']=$row->cat_name;
	  				$data['product_name']=$row->subcat_name;
	  				$data['liter']=$row->pliter;
	  				$data['price']=$row->total_amt;
	  				$data['deliverd']=$deliverd;
	  				$data['image']=$image;
	  				array_push($result['customers'], $data);
	  			}

           }
           else
           {
               $result= array('success' =>0, "Data" =>"No Customers Assign");
           }
           
        }
        else
        {
            $result= array('success' =>0, "Data" =>"Field Required");
        }
        
        $this->response($result, REST_Controller::HTTP_OK);
        
    }

    public function emplogin_post()
	{
		$this->_request = file_get_contents("php://input");
		header("Content-type: application/json");
		$this->_request=implode("",explode("\\",$this->_request));
		$jsonDecode=json_decode($this->_request, true);
		$login=$this->Crud_model->GetData('employees',"","email='".$jsonDecode['email']."' and password='".$jsonDecode['password']."' and status='Active' and is_delete='No'","","","","1");
		if(!empty($login))
		{
		    $image=base_url('../uploads/employees/'.$login->image);
			$result= array('success' =>1, "Data" =>"Your Login Successfully!","data"=>$login,'image'=>$image);
		}
		else
		{
			$result= array('success' =>0, "Data" =>"Invalid credential!");
		}
		$this->response($result, REST_Controller::HTTP_OK);
	}

	public function empupdate_post()
	{
		$this->_request = file_get_contents("php://input");
		header("Content-type: application/json");
		$this->_request=implode("",explode("\\",$this->_request));
		$jsonDecode=json_decode($this->_request, true);
		if(!empty($jsonDecode['id']) and !empty($jsonDecode['mobile']) and !empty($jsonDecode['email']) and !empty($jsonDecode['addhar_card_no']))
		{
			$chkemail=$this->Crud_model->GetData('employees',"id,email","email='".$jsonDecode['email']."' and status='Active'  and is_delete='No' and id!='".$jsonDecode['id']."'","","","","1");
			if(!empty($chkemail))
			{
				$result= array('success' =>0, "Data" =>"Email already exist!");
			}
			else  
			{
				$chkmobile=$this->Crud_model->GetData('employees',"id,mobile","mobile='".$jsonDecode['mobile']."' and status='Active'  and is_delete='No' and id!='".$jsonDecode['id']."'","","","","1");
				if(!empty($chkmobile))
				{
					$result= array('success' =>0, "Data" =>"Mobile Number already exist!");
				}
				else  
				{
					$image_data=$this->Crud_model->GetData('employees',"id,image,addhar_card","","","","","1");
					if($jsonDecode['image']!='')
					{
						$image = base64_decode($jsonDecode['image']);
						$image_name = $jsonDecode['image'];
						$path_parts = pathinfo($image_name);
						$ext = 'png';
						$attachment = time().'_'.rand(100,999).'.'.$ext;
						$path = FCPATH."../uploads/employees/".$attachment;
						file_put_contents($path,$image);
						$image=$attachment;

						@unlink('../uploads/employees/'.$image_data->image);  
					}      
					else
					{
						$image= $image_data->image;
					}
					if($jsonDecode['addhar_card']!='')
					{
						$addhar_card = base64_decode($jsonDecode['addhar_card']);
						$image_name = $jsonDecode['addhar_card'];
						$path_parts = pathinfo($image_name);
						$ext = 'png';
						$attachment = time().'_'.rand(100,999).'.'.$ext;
						$path = FCPATH."../uploads/employees/employees_addhar_image/".$attachment;
						file_put_contents($path,$addhar_card);
						$addhar_card=$attachment;
						@unlink('../uploads/employees/employees_addhar_image/'.$image_data->addhar_card);  
					}      
					else
					{
						$addhar_card= $image_data->addhar_card;
					}
					$data=array(
						'name'=>$jsonDecode['name'],
						'email'=>$jsonDecode['email'],
						'mobile'=>$jsonDecode['mobile'],
						'image'=>$image,
						'address'=>$jsonDecode['address'],
						'addhar_card'=>$addhar_card,
						'addhar_card_no'=>$jsonDecode['addhar_card_no'],
					);
					$this->Crud_model->SaveData('employees',$data,"id='".$jsonDecode['id']."'");
					$result= array('success' =>1, "Data" =>"Your Data update Successfully!","data"=>$data);
				}
			}
		}
		else
		{
			$result= array('success' =>0, "Data" =>"no update Successfully!");
		}
		$this->response($result, REST_Controller::HTTP_OK);
	}
	
	public function getemployee_post()
	{
		$this->_request = file_get_contents("php://input");
		header("Content-type: application/json");
		$this->_request=implode("",explode("\\",$this->_request));
		$jsonDecode=json_decode($this->_request, true);
		$id_data=$this->Crud_model->GetData('employees',"","id='".$jsonDecode['id']."'","","","","1");
		if(!empty($id_data))
		{
			$image= base_url('../uploads/employees/'.$id_data->image);
			$addhar_card=base_url('../uploads/employees/employees_addhar_image/'.$id_data->addhar_card);
			$result= array('success' =>1, "Data" =>"Show Data Successfully!","data"=>$id_data,"image"=>$image,"addhar_image"=>$addhar_card);
		}
		else
		{
			$result= array('success' =>0, "Data" =>"No Data found!");
		}
		$this->response($result, REST_Controller::HTTP_OK);
	}
	public function savecustomerdata_post()
	{
		$this->_request = file_get_contents("php://input");
		header("Content-type: application/json");
		$this->_request=implode("",explode("\\",$this->_request));
		$jsonDecode=json_decode($this->_request, true);
 if(!empty($jsonDecode))
 {
 	 $chk_mobile = $this->Crud_model->GetData('users',"id,mobile","mobile='".$jsonDecode['mobile']."' and status='Active'",'','',"","1");
 	if(!empty($chk_mobile))
  			{
  		        $response= array('success' =>0, "Data" =>"Mobile Number already exist!","id"=>$chk_mobile->id);
	  			
  			}
  			else
  			{	
 	                if($jsonDecode['image']!='')
	              {
	              		$image = base64_decode($jsonDecode['image']);
                        $image_name = $jsonDecode['image'];
                        $path_parts = pathinfo($image_name);
                      //  $ext = $path_parts['extension'];
                        $ext = 'png';
                        $attachment = time().'_'.rand(100,999).'_'.$path_parts['filename'].'.'.$ext;
                        $path = FCPATH."../uploads/users/".$attachment;
                        file_put_contents($path,$image);
                        $image=$attachment;
	              }      
	              else
	              {
	                $image= '';
	              }
	              
	              $get_emp = $this->Crud_model->GetData('employees','',"id='".$jsonDecode['emp_id']."'",'','','','1');
	              
	              $created_by_id =$get_emp->created_by; 
	              
	              $get_product = $this->Crud_model->GetData('subcategories','id,categories_id,subcat_name,one_liter_price',"id='1'",'','','','1');
	              //print_r($get_product); exit();
	              
	              $total_amount=$jsonDecode['qty']*$get_product->one_liter_price;

	              $data = array(
	  		    	'name'=>$jsonDecode['name'],
	  				'created_by'=>$created_by_id,
	  				'executive_id'=>$jsonDecode['emp_id'],
	  				'mobile'=>$jsonDecode['mobile'],
	  				'address'=>$jsonDecode['address'],
	  				'pcat'=>$get_product->categories_id,
	  				'pid'=>$get_product->id,
	  				'pamt'=>$get_product->one_liter_price,
	  				'total_amt'=>$total_amount,
	  				'pliter'=>$jsonDecode['qty'],
	  				'latitude'=>$jsonDecode['lat'],
	  				'longitude'=>$jsonDecode['lon'],
	  				'image'=>$image,
	  			);

	  			$this->Crud_model->SaveData('users',$data);
	  	$response= array('success' =>1, "Data" =>"Customer Created Successfully!");	
	  	}	
 }
		else
	  	{
	  		$response= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  	}

		

		$this->response($response, REST_Controller::HTTP_OK);

	}
	
	 public function getcategorydata_post()
	{
		$this->_request = file_get_contents("php://input");
		header("Content-type: application/json");
		$this->_request=implode("",explode("\\",$this->_request));
		$jsonDecode=json_decode($this->_request, true);
	$get_categories=$this->Crud_model->GetData('categories',"id,cat_name","status='Active'","","","","");
	
	if(!empty($get_categories))
 { 			
	  	$response= array('success' =>1, "data"=>$get_categories);	
	  	}	
 
		else
	  	{
	  		$response= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  	}

		$this->response($response, REST_Controller::HTTP_OK);
	}
	
	public function getproductdata_post()
	{
		$this->_request = file_get_contents("php://input");
		header("Content-type: application/json");
		$this->_request=implode("",explode("\\",$this->_request));
		$jsonDecode=json_decode($this->_request, true);

		$category_id = $jsonDecode['category_id'];

		if(!empty($category_id))
		{
			$get_subcat =$this->Crud_model->GetData('subcategories',"","categories_id='".$category_id."' and status='Active'");
	
			if(!empty($get_subcat))
	       {
	 		 	$response['success']="1";

	 		 	$response['product'] = array();

	 		 	foreach ($get_subcat as $product) 
	 		 	{
	 		 		$data['product'] = $product->subcat_name;
	 		 		$data['product_price'] = $product->one_liter_price;
	 		 		array_push($response['product'],$data);
	 		 	}

		  	}	
			else
		  	{
		  		$response= array('success' =>0, "Data" =>"Data not found. Please try again!");
		  	}
	   }
	   else
	   {
	  	  $response= array('success' =>0, "Data" =>" Category id Required!");
	   }

		$this->response($response, REST_Controller::HTTP_OK);

	}

}