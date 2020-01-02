<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

function __construct()
   	{
		parent::__construct();		
		
        $this->load->database();    
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Common_model') ;
   	}

   	public function retail_management($id)
   	{

   
      $get_product = $this->Common_model->GetData('product',"*","id='".$id."' and status='Active'","","","","1");
     

      if(!empty($get_product))
      {
       
        $retail_data = $this->Common_model->GetData('products_details',"*","product_title='".$get_product->id."' and status='Active'","","","","1");

       // print_r($retail_data);exit();
        if(!empty($retail_data))
        {
        
          $productimage = $this->Common_model->GetData('product_image',"*","product_detail_id='".$retail_data->id."'","","","","");
     


          if(!empty($productimage))
          {
          $product_service = $this->Common_model->GetData('products_services',"*","service_id='".$retail_data->id."' and status='Active'","","","","1");
          // print_r($this->db->last_query()); exit();
            
            
            if(!empty($product_service))
            {
              $product_list = $this->Common_model->GetData('products_service_list',"*","service_heading_id='".$product_service->id."' and status='Active'","","","","");

         
          if(!empty($product_list))
            {
              $product_blog = $this->Common_model->GetData('products_blog',"*","product_details_id='".$retail_data->id."' and status='Active'","","","","1");


              if(!empty($product_blog))
            {
              $product_blog_list = $this->Common_model->GetData('products_blog_list',"*","blog_heading_id='".$product_blog->id."' and status='Active'","","","","");
             
					}
            
         else{
            $product_blog_list="";
     
                 }
               }


        else{
         $product_blog="";
      $product_blog_list="";
   
          }
         } 
            else
            {
              $product_list = "";
              $product_blog="";
              $product_blog_list="";
            
            }
          }
          else
          {
            $product_service ="";
            $product_list = "";
           $product_blog = "";
           $product_blog_list="";
        
          }
        }
        else
        {
          $productimage ="";
          $product_service ="";
          $product_list = "";
          $product_blog = "";
          $product_blog_list="";
       
        }
      }
      else
      {
        $retail_data="";
        $productimage ="";
        $product_service ="";
        $product_list = "";
        $product_blog = "";
        $product_blog_list="";
     

      }

   $client_image=$this->Common_model->GetData('slider_image',"*","status='Active'");
      $data =array( 
          'retail_data'=>$retail_data,
          'get_product'=>$get_product,
         'productimage'=>$productimage,
      'product_service'=>$product_service,
      'product_list'=>$product_list,
     'product_blog'=>$product_blog,
     'product_blog_list'=>$product_blog_list,
    'client_image'=>$client_image,
       
        );
   		$this->load->view('products/retail_management/retail_management',$data);
   	}

   }

  ?>