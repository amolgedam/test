<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller 
{
	 function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Common_model');
        // $this->load->library(array('session','form_validation','image_lib'));
    }

	public function service_type($id)
	{

	 $get_services =$this->Common_model->get_single("services","id='".$id."'");

      if(!empty($get_services))
      {
        $service_detail = $this->Common_model->get_single("service_detail","service_id='".$get_services->id."'");
        if(!empty($service_detail))
        {
          $service_detail=$service_detail;

          if(!empty($service_detail))
          {
          	$service_image = $this->Common_model->GetData("service_images",'',"service_detail_id='".$service_detail->id."'");

          	if(!empty($service_image))
          	{
          	
          		$service_image =$service_image;

          	}
          	else
          	{
          		$service_image ="";
          	}

            $service_article = $this->Common_model->GetData("service_article","","service_heading_id='".$service_detail->id."'","","","","1");
            

            if (!empty($service_article)) 
            {
              $service_article = $service_article;
            }
            else
            {
              $service_article ="";
            }
            $service_article = $this->Common_model->GetData("service_article","","service_heading_id='".$service_detail->id."'","","","","1");
           

            if (!empty($service_article)) 
            {
              $service_article = $service_article;
            }
            else
            {
              $service_article ="";
            }

            
             $ourservice = $this->Common_model->GetData("ourservice","","service_detail_id='".$service_detail->id."'","","","","1");
           
            if (!empty($ourservice)) 
            {
              $ourservice = $ourservice;
            }
            else
            {
              $ourservice ="";
            }

            $ourservicelist = $this->Common_model->GetData("ourservicelist","","our_services_id='".$ourservice->id."'","","","","");
           
            if (!empty($ourservicelist)) 
            {
              $ourservicelist = $ourservicelist;
            }
            else
            {
              $ourservicelist ="";
            }
            
             // service work upload code //
             $service_work = $this->Common_model->GetData("service_work","","service_detail_id='".$service_detail->id."'","","","","1");
             //print_r($service_work);exit;
            //print_r($ourservicelist);exit;

            if (!empty($service_work)) 
            {
              $service_work = $service_work;
              $service_work_detail = $this->Common_model->GetData("service_work_detail","","work_service_id='".$service_work->id."'","","","","");
              
               if (!empty($service_work_detail)) 
                {
                  $service_work_detail = $service_work_detail;
                }
                else
                {
                  $service_work_detail ="";
                }
            }
            else
            {
              $service_work ="";
              $service_work_detail ="";
            }
          }
          
        }

        else
        {
          $service_detail="";
          $service_image ="";
          $service_article="";
          $ourservice="";
          $ourservicelist="";
          $service_work="";
          $service_work_detail="";
        }

      }

      else
      {
        $get_services ="";
        $service_detail="";
        $service_image="";
        $service_article="";
        $ourservice="";
        $ourservicelist="";
        $service_work="";
        $service_work_detail="";
      }

     $client_image=$this->Common_model->GetData('slider_image',"*","status='Active'");
      $data =array( 
          'service_detail'=>$service_detail,
          'get_services'=>$get_services,
          'service_image'=>$service_image,
          'service_article'=>$service_article,
          'ourservice'=>$ourservice,
          'ourservicelist'=>$ourservicelist,
          'service_work' =>$service_work,
          'service_work_detail' =>$service_work_detail,
        'client_image'=>$client_image,
        );
   		$this->load->view('Services/services_detail',$data);
   	}

}
?>