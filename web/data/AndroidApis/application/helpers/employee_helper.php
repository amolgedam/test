<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	function assigncustomer($num1='')
    {           
    	// Get a reference to the controller object
	    $CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
	    $CI->load->model('Crud_model');


	     $now = strtotime("now");

        $users = $CI->Crud_model->GetData('users','','','','','','');
	    
	    foreach ($users as $key => $value) {
	    
	      $start_date = strtotime('-1 day', strtotime($value->datefrom));

	      $end_date = strtotime($value->dateto);

	      if($value->empstatus == 'tmp')
	      {
	        if(($now > $start_date) && ($now < $end_date))
	        {
	          $data = array(
	                  'id' => $value->id,
	                  'executive_id' => $value->empnew_id,
	                );

	                
	            $query =  $CI->Crud_model->SaveData('users',$data,"id='".$value->id."'");
	          	
	        	return $query;

	        }
	        else
	        {
	          
	          $data = array(
	                  // 'id' => $value->id,
	                  'executive_id' => $value->empold_id,
	                  'empold_id' => 0,
	                  'empnew_id' => 0,
	                  'empstatus' => '',
	                );
	            $query =    $CI->Crud_model->SaveData('users',$data,"id='".$value->id."'");
	          
	        	return $query;

	        }
	      }
	      else if($value->empstatus == 'per')
	      {
	        
	        $data = array(
	                // 'id' => $value->id,
	                'executive_id' => $value->empnew_id,
	              );
	            
	            $query =  $CI->Crud_model->SaveData('users',$data,"id='".$value->id."'");
	        	
	        	return $query;
	      }

	    }
    }



?>