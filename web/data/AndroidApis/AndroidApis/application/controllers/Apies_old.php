<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
	  	$jsonDecode=json_decode($this->_request, true);

	  	if(!empty($jsonDecode))
	  	{
	  		$chk_email = $this->Crud_model->GetData('users',"id","email='".$jsonDecode['email']."'  and login_type='Guest' and is_delete='No'",'','',"","1");
			if(!empty($chk_email))
  			{
  				$result= array('success' =>0, "Data" =>"Email already exist!","id"=>$chk_email->id,);
	  			
  			}
  			else
  			{	
  				/*$chk_mobile = $this->Crud_model->GetData('users',"id","mobile='".$jsonDecode['mobile']."'",'','',"","1");

  				if(!empty($chk_mobile))
  				{
  					$result= array('success' =>0, "Data" =>"Mobile No already exist!");
  				}
  				else
  				{*/

				if($jsonDecode['image']!='')
	              {
	              		$image = base64_decode($jsonDecode['image']);
                        $image_name = $jsonDecode['image_name'];
                        $path_parts = pathinfo($image_name);
                        $ext = $path_parts['extension'];
                        $attachment = time().'_'.rand(100,999).'_'.$path_parts['filename'].'.'.'png';
                        $path = FCPATH."../admin/uploads/users/".$attachment;
                        file_put_contents($path,$image);
                        $image=$attachment;
	              }      
	              else
	              {
	                $image= '';
	              }

	             /* if($assetDetails['shop_images']!='')
	              {
	              		$image = base64_decode($assetDetails['shop_images']);
                        $image_name = $assetDetails['image_name'];
                        $path_parts = pathinfo($image_name);
                        $ext = $path_parts['extension'];
                        $attachment = time().'_'.rand(100,999).'_'.$path_parts['filename'].'.'.$ext;
                        $path = FCPATH."../admin/uploads/shop_images/".$attachment;
                        file_put_contents($path,$image);
                        $shop_images=$attachment;
	              }      
	              else
	              {
	                $shop_images= '';
	              }*/


					$data = array(
		                    	'name'=>$jsonDecode['name'],
		                        'email'=>$jsonDecode['email'],
		                        'image'=>$image,
		                        'login_type'=>'Guest',
		                       // 'shop_images'=>$shop_images,
		                       	'created'=>date('Y-m-d'),
		            );

			        $this->Crud_model->SaveData("users",$data);

			        $result= array('success' =>1, "Data" =>"Guest registration successfully!");
		       
			//}  	
		}
			 	
		}
	  	else
	  	{
	  		$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  		
	  	}	

	  	$this->response($result, REST_Controller::HTTP_OK);
	}
	function loginGuest_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode = json_decode($this->_request, true);

	  	if(!empty($jsonDecode['userid']))
	    {
	    	$cond = "(mobile='".$jsonDecode['userid']."' or email='".$jsonDecode['userid']."') and password='".$jsonDecode['password']."' and login_type='Guest'";

	    	$chk_login = $this->Crud_model->GetData("users",'',$cond,'','','','1');

	    	//print_r($chk_login);exit;

		    if(!empty($chk_login))
		    {  
		        $data = array(
		                  'id' => $chk_login->id,
		                  'name' => $chk_login->name,
		                  'email'=>$chk_login->email,
		                  'mobile'=>$chk_login->mobile,
		                  'address'=>$chk_login->address,
		                  );  

				$response['success'] = '1';
		        $response['message'] = "Logged in successfully";
		        $response['data'] = $data;
		        $response['login_type'] =$chk_login->login_type;
		    }
		    else
		    {
		        $response= array('success' =>0, "message" => "Login credentials are wrong. Please try again!");
		       
		    }
	  	}
	  	else
	  	{
	     	$response = array('success' => 0,"message" => "Your not registered please try rigistration.");
	     	
	    }

	    $this->response($response, REST_Controller::HTTP_OK);
	}

	/*for user login*/	
    function login_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode = json_decode($this->_request, true);

	  	if(!empty($jsonDecode['userid']))
	    {
    	    	$cond = "(mobile='".$jsonDecode['userid']."' or email='".$jsonDecode['userid']."') and password='".$jsonDecode['password']."' and login_type='Customer'";

	    	$chk_login = $this->Crud_model->GetData("users",'',$cond,'','','','1');

	    	//print_r($chk_login);exit;

		    if(!empty($chk_login))
		    {  
		        $data = array(
		                  'id' => $chk_login->id,
		                  'name' => $chk_login->name,
		                  'email'=>$chk_login->email,
		                  'mobile'=>$chk_login->mobile,
		                  'address'=>$chk_login->address,
		                  
		                  );  

				$response['success'] = '1';
		        $response['message'] = "Logged in successfully";
		        $response['data'] = $data;
		        $response['login_type'] =$chk_login->login_type;
		    }
		    else
		    {
		        $response= array('success' =>0, "message" => "Login credentials are wrong. Please try again!");
		       
		    }
	  	}
	  	else
	  	{
	     	$response = array('success' => 0,"message" => "Your not registered please try rigistration.");
	     	
	    }

	    $this->response($response, REST_Controller::HTTP_OK);
	}

	public function GetCategory_post()
	{
		/*$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode = json_decode($this->_request, true);*/

	  	$Getcat = $this->Crud_model->GetData('categories','',"status='Active'",'','id desc');

	  	if(!empty($Getcat))
	  	{	
	  		$response['success'] = "1";
	  		$response['status'] = "TRUE";
	  		$response['message'] = "success";
	  		$response['category']=array();
	  		
	  		foreach ($Getcat as $cat) 
	  		{
	  			if(!empty($cat->image))
	  			{
	  				$image= base_url('../admin/uploads/categories/'.$cat->image);
	  			}
	  			else
	  			{
	  				$image = base_url('../admin/uploads/categories/index.jpg');
	  			}

	  				$data['cat_id']=$cat->id;
	  				$data['cat_name']=ucfirst($cat->cat_name);
	  				$data['image']= $image;
	  				array_push($response['category'], $data);
	  		}
	  	}
	  	else
	  	{
	  		$response= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  	}

	  	$this->response($response, REST_Controller::HTTP_OK);
	 }


	 public function GetSubCategory_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode = json_decode($this->_request, true);

	  	if(!empty($jsonDecode['cat_id']))
	  	{
	  		$GetSubcat = $this->Crud_model->GetData('subcategories','',"categories_id='".$jsonDecode['cat_id']."' and is_delete='No'",'','id desc');

	  		if(!empty($GetSubcat))
	  		{	
	  			$response['success'] = "1";
	  			$response['status'] = "TRUE";
	  			$response['message'] = "success";
	  			$response['subcategory']=array();

	  			foreach ($GetSubcat as $cat) 
	  			{
		  			if(!empty($cat->image))
		  			{
		  				$image= base_url('../admin/uploads/subcategory/'.$cat->image);
		  			}
		  			else
		  			{
		  				$image = base_url('../admin/uploads/categories/index.jpg');
		  			}

		  				$data['subcat_id']=$cat->id;
		  				$data['subcat_name']=ucfirst($cat->subcat_name);
		  				$data['quantity_in_kg']=$cat->quantity_in_kg;
		  				$data['price_per_kg']= $cat->price_per_kg;
		  				$data['minimum_kg']= $cat->minimum_kg;
		  				$data['maximum_kg']=$cat->maximum_kg;
		  				$data['image']= $image;
		  				$data['statusActive']=$cat->status;
		  				array_push($response['subcategory'], $data);
	  			}

	  		}
	  		else
	  		{
	  			$response= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  		}
	  	}
	  	else
	  	{
	  		$response= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  	}

	  	$this->response($response, REST_Controller::HTTP_OK);
	 }
	 
	  public function SaveproductData_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode = json_decode($this->_request, true);

	  //	print_r($jsonDecode);exit;

	  	if(!empty($jsonDecode['id']) and !empty($jsonDecode['subcat_id']) and !empty($jsonDecode['qty']))
	  	{
	  				
	  			$get_catdata = $this->Crud_model->GetData('subcategories','',"id='".$jsonDecode['subcat_id']."'",'','','','1');

	  			$check_cartData = $this->Crud_model->GetData('cart','',"product_id='".$jsonDecode['subcat_id']."' and customer_id='".$jsonDecode['id']."'",'','','','1');

	  			if(!empty($check_cartData))
	  			{

	  				$total_quantity = $jsonDecode['qty'];

	  				$total_amount = $total_quantity * $get_catdata->price_per_kg;

	  				$data = array(
	  				'customer_id'=>$jsonDecode['id'],
	  				'product_id'=>$jsonDecode['subcat_id'],
	  				'quantity'=>$total_quantity,
	  				'price'=>$get_catdata->price_per_kg,
	  				'total'=>$total_amount,
	  			);

	  			$this->Crud_model->SaveData('cart',$data,"id='".$check_cartData->id."'");

	  			}
	  			else
	  			{
	  				$total_amount = $get_catdata->price_per_kg * $jsonDecode['qty'];

	  				$data = array(
	  				'customer_id'=>$jsonDecode['id'],
	  				'product_id'=>$jsonDecode['subcat_id'],
	  				'quantity'=>$jsonDecode['qty'],
	  				'price'=>$get_catdata->price_per_kg,
	  				'total'=>$total_amount,
	  			);

	  			$this->Crud_model->SaveData('cart',$data);

	  			}

	  			$getCartData = $this->Crud_model->GetData('cart','',"customer_id='".$jsonDecode['id']."'");

	  	

	  		$response['success']="1";
	  		$response['status']=TRUE;
	  		$response['Total_cart_count']=count($getCartData);
	  		$response['message']="Products added in cart";

	  	}
	  	else
	  	{
	  		$response= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  	}

		

		$this->response($response, REST_Controller::HTTP_OK);

	}
	 
	 
	 
	 

	/*For Question Bank*/
	public function questionBank_post()
	{
		$this->_request = file_get_contents("php://input");
		header("Content-type: application/json");
		$this->_request=implode("",explode("\\",$this->_request));
		$this->_request=json_decode($this->_request, true);

		$cond="status='Active' and is_delete='No'";
		$questionDetails=$this->Crud_model->GetData('question_master','',$cond);

		if(!empty($questionDetails))
		{
			$temp_question=array();
			$answer='';            
			$option=array();   
			foreach($questionDetails as $question)
			{
				$temp_data['question']=$question->question;
				$temp_data['image']=$question->question_img;

				/*for get option*/
				$cond="question_master_id='".$question->id."'";
				$options=$this->Crud_model->GetData('answer_question_master','',$cond);

				 $temp_data1=array(); 
				foreach ($options as $option) 
				{  
					if($option->is_answer=='Yes')
					{
						$answer=strip_tags($option->options);
					}
					else
					{
						$answer="";
					}
					$option=strip_tags($option->options);
					array_push($temp_data1, $option);
					
					$temp_data['option']= $temp_data1;
					$temp_data['answer']= $answer;
				}
					
				array_push($temp_question, $temp_data);
				
			}
			$questionimage_path=base_url('../admin/uploads/questions/');
			$result= array('success' =>1, "Data" => $temp_question,  "questionimage_path"=>$questionimage_path);
			$this->response($result, REST_Controller::HTTP_OK);
		}
		else
		{
			$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
			$this->response($result, REST_Controller::HTTP_OK);
		}  		
	}
	/*For Fees Detail*/
	public function feesDetails_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$this->_request=json_decode($this->_request, true);
	  	$user_id=$this->_request['user_id'];
	  	if(!empty($user_id))
	  	{
	  		$users=$this->Crud_model->GetData('users','advance_amt,total_pay,bal_amt,adv_amt_date',"id='".$user_id."'",'','','','1');
	  		if(!empty($users))
	  		{	
	  			$data['advance_amt']=$users->advance_amt;
				$data['total_pay']=$users->total_pay;
				$data['bal_amt']=$users->bal_amt;
				$data['date']=date('Y-m-d',strtotime($users->adv_amt_date ));


				$feesDetails=$this->Crud_model->GetData('payment_collection','amount,collect_date',"user_id ='".$user_id."'");


				 $temp_data1=array(); 
				  
				foreach ($feesDetails as $detail) 
				{  
					$detail1['collect_date']= date('Y-m-d',strtotime($detail->collect_date));
					$detail1['amount']= $detail->amount;

					array_push($temp_data1, $detail1);
				}
					
				//array_push($data, $temp_data1);

	  			$result= array('success' =>1, "Data" =>$data,"details" =>$temp_data1);
		  		$this->response($result, REST_Controller::HTTP_OK);
		  	}	
		  	else
		  	{
		  		$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
		  		$this->response($result, REST_Controller::HTTP_OK);
		  	}
	  	}
	  	else
	  	{
	  		$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  		$this->response($result, REST_Controller::HTTP_OK);
	  	}
	}
	
	/*For add quantity*/
	function addProductQty_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);
	  	if(!empty($jsonDecode))
	  	{
	  		foreach($jsonDecode['list'] as $data)
	  		{
	  			
	  			$qtyData=array(
	  				'quantity'=>$data['qty'],
	  			);
	  			$this->Crud_model->SaveData('cart',$qtyData,"product_id='".$data['product_id']."' and customer_id='".$jsonDecode['customer_id']."'");
	  		}
	  		$result= array('success' =>1, "Data" =>"Quantity added successfully");
		  	$this->response($result, REST_Controller::HTTP_OK);
	  	}
	  	else
	  	{
	  		$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  		$this->response($result, REST_Controller::HTTP_OK);
	  	}
	}
	
    function addOrderData_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);
	  	
	  //	print_r($jsonDecode);exit;

	  	if(!empty($jsonDecode['customer_id']))
	  	{

	  		$this->Crud_model->DeleteData('cart',"customer_id='".$jsonDecode['customer_id']."'");
	  		
	  		


	  		foreach ($jsonDecode['list'] as $list) 
	  		{
			
	  			    $get_catdata = $this->Crud_model->GetData('subcategories','',"id='".$list['product_id']."'",'','','','1');
	  			
	  				$total_quantity = $list['qty'];

	  				$total_amount = $total_quantity * $get_catdata->price_per_kg;

	  				$data = array(
	  				'customer_id'=>$jsonDecode['customer_id'],
	  				'product_id'=>$list['product_id'],
	  				'quantity'=>$total_quantity,
	  				'price'=>$get_catdata->price_per_kg,
	  				'total'=>$total_amount,
	  			);

	  			$this->Crud_model->SaveData('cart',$data);

	  			
	  		}

	  		$getcartData = $this->Crud_model->GetData('cart','',"customer_id='".$jsonDecode['customer_id']."'");

	  		$cart = $this->Crud_model->GetData('cart','SUM(total) as amount_total',"customer_id='".$jsonDecode['customer_id']."'",'','','','1');
	  		
	  		//print_r($cart);exit;

	  		$getquantity = $this->Crud_model->GetData('cart','SUM(quantity) as total_quamtity',"customer_id='".$jsonDecode['customer_id']."'",'','','','1');
	  		
	  		$settings = $this->Crud_model->GetData('settings');
	  		
	  		//print_r($settings);exit;

	  		$final_total = $cart->amount_total + $settings[8]->details;
	  		
	  	//	print_r($getquantity);exit;

        	  	$data =array(
        	  					'customer_id'=>$jsonDecode['customer_id'],
        	  					'total_product'=>count($getcartData),
        	  					'total_quantity'=>$getquantity->total_quamtity,
        	  					'final_amount'=>$final_total,
        	  					'sub_total'=>$cart->amount_total,
        	  					'extra_charges'=>$settings[8]->details,
        	  					'payment_status'=>'Pending',
        	  					'order_status'=>'Pending',
        	  					'booking_date'=>date('Y-m-d'),
        	  					'payment_type'=>'Cash',
        	  		);

	  		$this->Crud_model->SaveData('service_orders',$data);

	  		$last_id = $this->db->insert_id();


	  		$data1 =array(
	  						'order_no'=>'FARM'.$last_id,
	  					);
	  				
	  		$this->Crud_model->SaveData('service_orders',$data1,"id='".$last_id."'");


	  		foreach($getcartData as $cart)
	  		{

	  			$qtyData=array(
	  				'service_orders_id'=>$last_id,
	  				'customer_id'=>$jsonDecode['customer_id'],
	  				'product_id'=>$cart->product_id,
	  				'price'=>$cart->price,
	  				'quantity'=>$cart->quantity,
	  				'total'=>$cart->total,
	  			);
	  			
	  			$this->Crud_model->SaveData('service_orders_details',$qtyData);
	  		}


	  		$this->Crud_model->DeleteData('cart',"customer_id='".$jsonDecode['customer_id']."'");

	  		$result= array('success' =>1, "Data" =>"Order Book successfully");
		  	
	  	}
	  	else
	  	{
	  		$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  		
	  	}

	  	$this->response($result, REST_Controller::HTTP_OK);

	}
	public function Getcartdata_post()
	{

		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode = json_decode($this->_request, true);

	  	if(!empty($jsonDecode['user_id']))
	  	{

	  		$cond = "cart.customer_id='".$jsonDecode['user_id']."'";
	  		$GetcartData = $this->Crud_model->Getcartdata($cond);
	  		$settings = $this->Crud_model->GetData('settings');

	  		
	  	//	print_r($GetcartData);exit;

	  			$response['success'] = "1";
	  			$response['status'] = "TRUE";
	  			$response['message'] = "success";
	  			$response['required_kg'] =$settings[11]->details;
	  			$response['service_charges'] =$settings[8]->details;
	  			$response['mycart']=array();

	  			foreach ($GetcartData as $cat) 
	  			{
		  			if(!empty($cat->image))
		  			{
		  				$image= base_url('../admin/uploads/subcategory/'.$cat->image);

		  			}
		  			else
		  			{
		  				$image = base_url('../admin/uploads/categories/index.jpg');
		  			}

		  				$data['subcat_id']=$cat->sub_cat_id;
		  				$data['subcat_name']=ucfirst($cat->subcat_name);
		  				$data['quantity_in_kg']=$cat->quantity_in_kg;
		  				$data['price_per_kg']= $cat->price_per_kg;
		  				$data['minimum_kg']= $cat->minimum_kg;
		  				$data['maximum_kg']=$cat->maximum_kg;
		  				$data['image']= $image;
		  				$data['total']= $cat->total;
		  				$data['quantity']= $cat->quantity;
		  				array_push($response['mycart'], $data);
	  			}




	  	}
	  	else
	  	{
	  		$response= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  	}

	  	$this->response($response, REST_Controller::HTTP_OK);

	}
	 public function DeleteproductData_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode = json_decode($this->_request, true);

	  //	print_r($jsonDecode);exit;

	  	if(!empty($jsonDecode['id']) and !empty($jsonDecode['subcat_id']))
	  	{


	  		if(empty($jsonDecode['qty']))
	  		{
	  			$this->Crud_model->DeleteData('cart',"customer_id='".$jsonDecode['id']."' and product_id='".$jsonDecode['subcat_id']."'");
	  			
	  			$response= array('success' =>1, "Data" =>"Data Remove Successfully");
	  		}
	  		else
	  		{
	  				
	  			$get_catdata = $this->Crud_model->GetData('subcategories','',"id='".$jsonDecode['subcat_id']."'",'','','','1');

	  			$check_cartData = $this->Crud_model->GetData('cart','',"product_id='".$jsonDecode['subcat_id']."' and customer_id='".$jsonDecode['id']."'",'','','','1');

	  			if(!empty($check_cartData))
	  			{

	  				$total_quantity = $jsonDecode['qty'];

	  				$total_amount = $total_quantity * $get_catdata->price_per_kg;

	  				$data = array(
	  				'customer_id'=>$jsonDecode['id'],
	  				'product_id'=>$jsonDecode['subcat_id'],
	  				'quantity'=>$total_quantity,
	  				'price'=>$get_catdata->price_per_kg,
	  				'total'=>$total_amount,
	  			);

	  			$this->Crud_model->SaveData('cart',$data,"id='".$check_cartData->id."'");

	  			}
	  			else
	  			{
	  				$total_amount = $get_catdata->price_per_kg * $jsonDecode['qty'];

	  				$data = array(
	  				'customer_id'=>$jsonDecode['id'],
	  				'product_id'=>$jsonDecode['subcat_id'],
	  				'quantity'=>$jsonDecode['qty'],
	  				'price'=>$get_catdata->price_per_kg,
	  				'total'=>$total_amount,
	  			);

	  			$this->Crud_model->SaveData('cart',$data);

	  			}

	  			$getCartData = $this->Crud_model->GetData('cart','',"customer_id='".$jsonDecode['id']."'");

	  	

	  		$response['success']="1";
	  		$response['status']="TRUE";
	  		$response['Total_cart_count']=count($getCartData);
	  		$response['message']="Products remove from cart";

	  	}
	  }
	  	else
	  	{
	  		$response= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  	}

		

		$this->response($response, REST_Controller::HTTP_OK);

	}

	
	
	
	
	
	/*For delete cart data*/
	function deleteCartItem_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);
	  	if(!empty($jsonDecode))
	  	{
	  		$this->Crud_model->DeleteData('cart',"customer_id='".$jsonDecode['user_id']."'");
	  		$result= array('success' =>1, "Data" =>"Cart deleted successfully");
		  	$this->response($result, REST_Controller::HTTP_OK);
	  	}
	  	else
	  	{
	  		$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  		$this->response($result, REST_Controller::HTTP_OK);
	  	}
	}
	public function GetOrderList_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);

	  	if(!empty($jsonDecode['customer_id']))
	  	{

	  		$Getorderlist = $this->Crud_model->GetData('service_orders','',"customer_id='".$jsonDecode['customer_id']."' and status='Active' and is_delete='No'",'','id desc');

	  		if(!empty($Getorderlist))
	  		{

	  			$result['success'] ='1'; 
	  			$result['status'] ='TRUE'; 
	  			$result['data'] =array();

	  			foreach ($Getorderlist as $list) 
	  			{
	  					$data['order_id']=$list->id; 
	  					$data['order_no']=$list->order_no; 
	  					$data['order_status']=$list->order_status; 
	  					$data['booking_date']=date('d-m-Y',strtotime($list->booking_date)); 
	  					$data['payment_type']=$list->payment_type; 
	  					array_push($result['data'], $data);
	  			} 

	  		}
	  		else
	  		{
	  			$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  		}
	  	}
	  	else
	  	{
	  		$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  	}


	  		$this->response($result, REST_Controller::HTTP_OK);
	}
	
	public function GetOrderlog_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);

	  	if(!empty($jsonDecode['customer_id']) and !empty($jsonDecode['order_id']))
	  	{

	  		$getorderdata = $this->Crud_model->GetData('service_orders','',"id='".$jsonDecode['order_id']."'",'','','','1');

	  		if(!empty($getorderdata))
	  		{

	  			$result['success'] = "1";
	  			$result['message'] = "success";
	  			$result['order_status'] =$getorderdata->order_status;
	  			$result['order_date'] =date('d-m-Y',strtotime($getorderdata->booking_date));
	  			$result['order_no'] =$getorderdata->order_no;
	  			$result['final_amount'] =$getorderdata->final_amount;
	  			$result['sub_total'] =$getorderdata->sub_total;
	  			$result['extra_charges'] =$getorderdata->extra_charges;
	  			$result['invoice_url'] =site_url('../admin/index.php/ManageCashOrder/Invoice/'.$getorderdata->id);
	  		
	  			$cond = "service_orders_details.customer_id='".$jsonDecode['customer_id']."' and service_orders_id='".$jsonDecode['order_id']."'";
	  			$GetcartData = $this->Crud_model->Getserviceorderdetails($cond); 

	  			if(!empty($GetcartData)) 	
	  			{
	  				$result['mycart']=array();

		  			foreach ($GetcartData as $cat) 
		  			{
			  			if(!empty($cat->image))
			  			{
			  				$image= base_url('../admin/uploads/subcategory/'.$cat->image);

			  			}
			  			else
			  			{
			  				$image = base_url('../admin/uploads/categories/index.jpg');
			  			}

		  				$data['subcat_id']=$cat->sub_cat_id;
		  				$data['subcat_name']=ucfirst($cat->subcat_name);
		  				$data['quantity_in_kg']=$cat->quantity_in_kg;
		  				$data['price_per_kg']= $cat->price_per_kg;
		  				$data['minimum_kg']= $cat->minimum_kg;
		  				$data['maximum_kg']=$cat->maximum_kg;
		  				$data['image']= $image;
		  				$data['total']= $cat->total;
		  				$data['quantity']= $cat->quantity;
		  				array_push($result['mycart'], $data);
	  				}

	  			}
	  			else
	  			{	
	  				$result['mycart']="Data Not found";
	  			}

	  			$Getorderlog = $this->Crud_model->GetData('order_logs','',"customer_id='".$jsonDecode['customer_id']."' and orders_id='".$jsonDecode['order_id']."'",'','id asc');

		  		if(!empty($Getorderlog))
		  		{

		  			$result['data'] =array();

		  			foreach ($Getorderlog as $list) 
		  			{
		  					$data1['order_log_id']=$list->id; 
		  					$data1['order_status']=$list->order_status; 
		  					$data1['order_date']=date('h:i A',strtotime($list->order_date)); 
		  					array_push($result['data'], $data1);
		  			}
		  		}
		  		else
		  		{
		  			$result['data'] ="data not found";
		  		} 

	  		}
	  		else
	  		{
	  			$result= array('success' =>0, "Data" =>"No log Faund");
	  		}
	  	}
	  	else
	  	{
	  		$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  	}


	  		$this->response($result, REST_Controller::HTTP_OK);
	}
	
	public function updateStatus_post()
	{
    	$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);
	  	
	  	if(!empty($jsonDecode['order_id']) and !empty($jsonDecode['customer_id']) and !empty($jsonDecode['description']))
	  	{
	  		$data = array(
	  			'description'=>$jsonDecode['description'],
	  			'order_status'=>'Cancel',
	  		);

	  		$this->Crud_model->SaveData("service_orders",$data,"id='".$jsonDecode['order_id']."'");

	  		$data1 = array(
	  				'customer_id'=>$jsonDecode['customer_id'],
	  				'orders_id'=>$jsonDecode['order_id'],
	  				'order_status'=>'Order Cancel',
	  				'order_date'=>date('Y-m-d H:i:s'),
	  				'request_from'=>'Customer',
	  		);

	  			$this->Crud_model->SaveData("order_logs",$data1);

		  		$result['success']="1";
		  		$result['status']="True";
		  		$result['message']="Order Cancel successfully";

	  	}	
	  	else
	  	{
	  		$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  	}

	  	$this->response($result, REST_Controller::HTTP_OK);

	}
	
	
	
	
	
	
}