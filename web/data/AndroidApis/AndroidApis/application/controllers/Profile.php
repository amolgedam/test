<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Profile extends REST_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Api_model');
	}

	function GetProfile_post()
	{

		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);

	  	if(!empty($jsonDecode['customer_id']))
	  	{
	  		$getProfile = $this->Crud_model->GetData('users','',"id='".$jsonDecode['customer_id']."'",'','','','1');

	  		if(!empty($getProfile))
	  		{
	  			if(!empty($getProfile->image))
	  			{
	  				$image = base_url('../admin/uploads/users/'.$getProfile->image);
	  			}
	  			else
	  			{
	  				$image = base_url('../admin/uploads/users/no_image.png');
	  			}

	  			if(!empty($getProfile->shop_images))
	  			{
	  				$shop_images = base_url('../admin/uploads/shop_images/'.$getProfile->shop_images);
	  			}
	  			else
	  			{
	  				$shop_images = base_url('../admin/uploads/users/no_image.png');
	  			}	

	  			$data = array(
	  				'name'=>$getProfile->name,
	  				'email'=>$getProfile->email,
	  				'mobile'=>$getProfile->mobile,
	  				'password'=>$getProfile->password,
	  				'address'=>$getProfile->address,
	  				'business_type'=>$getProfile->business_type,
	  				'login_type'=>$getProfile->login_type,
	  				'shop_images'=>$shop_images,
	  				'image'=>$image,
	  			);

	  			$result['success'] ="1";		
	  			$result['status'] ="true";		
	  			$result['Data'] =$data;		
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

	function UpdateProfile_post()
	{

		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);
	  	
	  	//print_r($_REQUEST);exit;

		 if(!empty($jsonDecode['customer_id']) and !empty($jsonDecode['name']) and !empty($jsonDecode['email']) and !empty($jsonDecode['mobile']))
	  	{

	  		$chk_email = $this->Crud_model->GetData('users',"id","email='".$jsonDecode['email']."' and id!='".$jsonDecode['customer_id']."' and is_delete='No'",'','',"","1");
			if(!empty($chk_email))
  			{
  				$result= array('success' =>0, "Data" =>"Email already exist!");
	  			
  			}
  			else
  			{
  				$chk_mobile = $this->Crud_model->GetData('users',"id","mobile='".$jsonDecode['mobile']."' and id!='".$jsonDecode['customer_id']."' and is_delete='No'",'','',"","1");

  				if(!empty($chk_mobile))
  				{
  					$result= array('success' =>0, "Data" =>"Mobile No already exist!");
  				}
  				else
  				{
  					$getProfile = $this->Crud_model->GetData('users','',"id='".$jsonDecode['customer_id']."'",'','','','1');

  						if($jsonDecode['shop_images']!='')
		              {
		              	/*	$image = base64_decode($jsonDecode['shop_images']);
	                        $image_name = $jsonDecode['shop_images'];
	                        $path_parts = pathinfo($image_name);
	                        $ext = 'png';
	                        $attachment = time().'_'.rand(100,999).'.'.$ext;
	                        $path = FCPATH."../admin/uploads/shop_images/".$attachment;
	                        file_put_contents($path,$image);
	                        $shop_images=$attachment;*/
	                        
	                        $image = base64_decode($jsonDecode['shop_images']);
                            $image_name = $jsonDecode['shop_images'];
                            $path_parts = pathinfo($image_name);
                          	$ext = 'png';
                            $attachment = time().'_'.rand(100,999).'.'.$ext;
                            $path = FCPATH."../admin/uploads/shop_images/".$attachment;
                            file_put_contents($path,$image);
                            $shop_images=$attachment;
	                       
		              }      
		              else
		              {
		                $shop_images= $getProfile->shop_images;
		              } 


  						if($jsonDecode['image']!='')
		              {
		              	   /*$image = base64_decode($jsonDecode['image']);
	                        $image_name = $jsonDecode['image'];
	                        $path_parts = pathinfo($image_name);
	                        $ext = 'png';
	                        $attachment = time().'_'.rand(100,999).'.'.$ext;
	                        $path = FCPATH."../admin/uploads/users/".$attachment;
	                        file_put_contents($path,$image);
	                        $image=$attachment;*/
	                        
	                        $image = base64_decode($jsonDecode['image']);
                            $image_name = $jsonDecode['image'];
                            $path_parts = pathinfo($image_name);
                          	$ext = 'png';
                            $attachment = time().'_'.rand(100,999).'.'.$ext;
                            $path = FCPATH."../admin/uploads/users/".$attachment;
                            file_put_contents($path,$image);
                            $image=$attachment;
		              }      
		              else
		              {
		                	$image= $getProfile->image;
		              } 

		              $data = array(
					  				'name'=>$jsonDecode['name'],
					  				'email'=>$jsonDecode['email'],
					  				'mobile'=>$jsonDecode['mobile'],
					  				'password'=>$jsonDecode['password'],
					  				'address'=>$jsonDecode['address'],
					  				'business_type'=>$jsonDecode['business_type'],
					  				'shop_images'=>$shop_images,
					  				'image'=>$image,
	  							);
	  							
	  					//print_r($data);exit;
	  					
	  				$this->Crud_model->SaveData("users",$data,"id='".$jsonDecode['customer_id']."'");
	  				
	  				

		              $result['success']="1";
		              $result['status']="true";
		              $result['message']="Profile updated successfully";

  				}


  			}
  		}
  		else
  		{
  			$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
  		}

  		$this->response($result, REST_Controller::HTTP_OK);
  	}
  	
  	function UpdateOrderStatus_post()
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
	
   
	/*for user registration*/
	function register_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);

	  	if(!empty($jsonDecode))
	  	{
	  		$chk_email = $this->Crud_model->GetData('users',"id","email='".$jsonDecode['email']."'",'','',"","1");
			if(!empty($chk_email))
  			{
  				$result= array('success' =>0, "Data" =>"Email already exist!");
	  			
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
                        $attachment = time().'_'.rand(100,999).'_'.$path_parts['filename'].'.'.$ext;
                        $path = FCPATH."../admin/uploads/users/".$attachment;
                        file_put_contents($path,$image);
                        $image=$attachment;
	              }      
	              else
	              {
	                $image= '';
	              }

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
	
	function sendNotification_post()
    {

    	$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);

	  	if(!empty($jsonDecode['subject']) and !empty($jsonDecode['body']) and !empty($jsonDecode['appId']))
	  	{

	  		$appId = $jsonDecode['appId'];
	  		$body = $jsonDecode['body'];
	  		$subject = $jsonDecode['subject'];

	  		//$app_id ="4de71a5c-00b1-495b-ab18-569e2cb3f4e5";
	  		$app_id ="2a586beb-c338-4460-9b2e-cfe6f8821f0b";

	        $AppID[]=$appId;
	        $Notification_title[]='Booking Request';
	        $notification_type[]='Booking';
	        //$notification_logo[]=$image_path;
	        
	        $hashes_array = array();
	        array_push($hashes_array, array(
	            "id" => "like-button",
	            "text" => "Like",
	          //  "icon" => $image_path,
	        ));
	        
	        $headings = array(
	            "en" => $subject
	        );
	        $content = array(
	            "en" => $body
	        ); 
	        $fields = array(
	            'app_id' =>$app_id,
	            'include_player_ids' => $AppID,
	            'data' => array("type"=> $notification_type,),
	            'contents' => $content,
	            'headings' => $headings,
	            //'small_icon' => $image_path,
	            'web_buttons' => $hashes_array);    
	        $fields = json_encode($fields);
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
	                                                   'Authorization: Basic NDM3MjAwNzQtMzk0Ni00YTU5LWFmZjQtNWMwNzQ2YjEyNGMz'));
	                                                   /*'Authorization: Basic ZGYwNGIxNDYtZTZjNy00OTQ2LTliMTAtOWFjNzQ5OGYzZWNi'));*/
	        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
	        curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
	        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 2);
	        $result = curl_exec($ch);

	        $result= array('success' =>1, "Data" =>"Massege Send successfully");
	  	}
	  	else
	  	{
	  		$result= array('success' =>0, "Data" =>"Data not found. Please try again!");
	  	}

	  	$this->response($result, REST_Controller::HTTP_OK);
    }
     function getloadmoredata_post()
    {

    	$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode=json_decode($this->_request, true);
	  	
	  	/*if($jsonDecode['page'])
	  	{*/
	  		$page = $jsonDecode['page'];
	  		$cond = "cart.customer_id='".$jsonDecode['user_id']."'";
	  		$GetcartData = $this->Crud_model->getloadmoredata($cond,$page);
            $settings = $this->Crud_model->GetData('settings');
	  		

	  		if(!empty($GetcartData))
	  		{
	  		    
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
    
     public function GetproductList_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode = json_decode($this->_request, true);

	  	if(!empty($jsonDecode['cat_id']))
	  	{
	  		$page=$jsonDecode['page'];
	  		$cond="sub.status='Active' and sub.categories_id='".$jsonDecode['cat_id']."' and sub.is_delete='No'";
	  		$GetSubcat = $this->Crud_model->getloadmoreProductdata($cond,$page);

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
		  				$data['status']=$cat->status;
		  				$data['image']= $image;
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

	  	if(!empty($jsonDecode['id']) and !empty($jsonDecode['product']))
	  	{
	  		
	  		//print_r($jsonDecode['product']);exit;
	  		    foreach($jsonDecode['product'] as $product)
	  		{
	  		    //print_r($product);exit;
	  			$get_catdata = $this->Crud_model->GetData('subcategories','',"id='".$product['subcat_id']."'",'','','','1');
	  			
	  			$check_cartData = $this->Crud_model->GetData('cart','',"product_id='".$product['subcat_id']."' and customer_id='".$jsonDecode['id']."'",'','','','1');

	  			if(!empty($check_cartData))
	  			{
                    
	  				$total_quantity = $product['qty'];

	  				$total_amount = $total_quantity * $get_catdata->price_per_kg;

	  				$data = array(
	  				'customer_id'=>$jsonDecode['id'],
	  				'product_id'=>$product['subcat_id'],
	  				'quantity'=>$total_quantity,
	  				'price'=>$get_catdata->price_per_kg,
	  				'total'=>$total_amount,
	  				);
	  				
	  				$this->Crud_model->SaveData('cart',$data,"id='".$check_cartData->id."'");
	  				
	  				
	  			}
	  			else
	  			{
	  			    
	  			    
	  				$total_amount = $get_catdata->price_per_kg * $product['qty'];

	  				$data = array(
	  				'customer_id'=>$jsonDecode['id'],
	  				'product_id'=>$product['subcat_id'],
	  				'quantity'=>$product['qty'],
	  				'price'=>$get_catdata->price_per_kg,
	  				'total'=>$total_amount,
	  				);
	  				
	  				$this->Crud_model->SaveData('cart',$data);
	  			}

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
	 public function GetCustomerCount_post()
	{
		$this->_request = file_get_contents("php://input");
	  	header("Content-type: application/json");
      	$this->_request=implode("",explode("\\",$this->_request));
	  	$jsonDecode = json_decode($this->_request, true);

	  	if(!empty($jsonDecode['customer_id']))
	  	{
	  			$getCartData = $this->Crud_model->GetData('cart','',"customer_id='".$jsonDecode['customer_id']."'");

	  			$response['success']="1";
	  			$response['status']=TRUE;
	  			$response['Total_cart_count']=count($getCartData);
	  	}
	  	else
	  	{
	  		$response= array('success' =>0, "Data" =>"Data not found. Please try again!");

	  	}

	  	$this->response($response, REST_Controller::HTTP_OK);

	 }


	

	





}