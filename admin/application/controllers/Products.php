<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Products extends CI_Controller {

  function __construct()
    {
      parent::__construct();    
      $this->load->database();
        $this->load->model('Products_model');
        $this->load->model('Common_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
      {
            
          $header = array('page_title'=> 'Wpes');
            $data = array(
            'heading'=>'Products',
            'createAction'=>site_url('Products/create'),
          
        );
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('products/list',$data);
    $this->load->view('common/footer'); 
  }
    // Add Product Title
  public function create()
 {
    $header = array('page_title'=>'ebco');  
    $data = array('heading'=>'Add Products',
      'subheading'=>'Create Products',
      'button'=>'Create',
              'action'=>site_url('Products/create_action_1'),
              'product_type' =>set_value('product_type'),
              'product_title' =>set_value('product_title'),
              'id' =>set_value('id'),
    );
   // print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('Products/form',$data);
       
  }
// Insert Title Name in Products
  public function create_action_1()
  {
    print_r($_POST);
     $ip=$_SERVER['REMOTE_ADDR'];
    $data=array(
        'product_type' => $_POST['product_type'],
        'product_title' => $_POST['product_title'],
       
        'created_on_ip'=>$ip,
    );
    $this->Crud_model->SaveData('product',$data);
    $this->session->set_flashdata('message', 'Products created successfully');
    redirect("Products");
  }
  // Fetch Data in product

    public function ajax_manage_page()
    {
        $product = $this->Products_model->get_datatables();
     // print_r($product);exit();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($product as $row) 
        {

            $btn = anchor(site_url('Products/view/'.$row->id),'<button title="View" class="btn btn-info btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Products/update/'.$row->id),'<buttontitle="Edit" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash-o"></i></span>';
            $status='';            
            if($row->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }  
            if ($row->product_type=='Retail_Management') {
                  $pp='Retail Management';
            }
            else
            {
              $pp=$row->product_type;
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $pp;
            $nestedData[] = $row->product_title;
             $nestedData[] = $row->created_date;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Products_model->count_all(),
                    "recordsFiltered" => $this->Products_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
  

public function delete()
{
  if(isset($_POST['cid']))
        {
           $this->Common_model->delete('product',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
}

public function change_status()
{
    if(isset($_POST['statusupdate']))
    {
        $this->Crud_model->SaveData("products",$_POST,"id='".$_POST['id']."'");exit;
    }
}
      

public function create_action()
{
    if($_FILES['image']['name']!='')
    {  
      $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
      $config1['image_library'] = 'gd2';
      $config1['source_image'] =  $_FILES['image']['tmp_name'];
      $config1['new_image'] =   getcwd().'/uploads/products/'.$_POST['image'];
      $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
      $config1['maintain_ratio'] = TRUE;
      $config1['width']     = 420;
      $config1['height']   = 453;
      $this->image_lib->initialize($config1);
      if(!$this->image_lib->resize())
      { 
        $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
        $this->changeProductStatus();
        return;
      }
      else 
      {   
        $image  = $_POST['image'];   
      }
    }
    else
    {
        $image='';
    }
    $header = array('page_title'=>'EBCO');
    $data = array(
            'header' =>$header,
            'category_id' =>$this->input->post('category_id',TRUE),
            'subcategory_id' =>$this->input->post('subcategory_id',TRUE),
            'product_name' =>$this->input->post('product_name',TRUE),
            'model_no' =>$this->input->post('model_no',TRUE),
            'rate' => $this->input->post('rate',TRUE),
            'gst' => $this->input->post('gst',TRUE),
            'description' => $this->input->post('description',TRUE),
            'product_img' => $image,
            'status'=>'Active',
            'created'=> date('Y-m-d H:i:s'),
    );
   $this->Crud_model->SaveData('products',$data);
   $this->session->set_flashdata('message', 'Product created successfully');
   redirect(site_url('Products'));   
}

 public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $productdata = $this->Crud_model->get_single("product","id='".$id."'");

         if ($productdata->product_type=='Retail_Management') 
          {
              $pp='Retail Management';
          }
          else
          {
              $pp=$productdata->product_type;
          }

        $data =array(
          'product_type'=>$pp,
          'product_title'=>$productdata->product_title,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('products/view',$data);
        $this->load->view('common/footer'); 

    }

  
public function update($id)
   {
      $header = array('page_title'=>'WPES'); 
      $update_data = $this->Crud_model->get_single("product","id='".$id."'"); 
      $data = array(
                'heading' => 'Update Product',
                'subheading' => 'Update Product',
                'button' => 'Update',
                'action' => site_url('Products/update_action/'.$id),
                'product_type' => $update_data->product_type,
                'product_title' => $update_data->product_title,
                'id' =>$id,
      );
     // print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('products/form',$data);
         
    }
  public function update_action($id)
    {
      
      $data=array(
          'product_type'=>$_POST['product_type'],
          'product_title'=>$_POST['product_title'],
          
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('product',$data,"id='".$id."'");
      $this->session->set_flashdata('message', 'Products updated successfully');
      redirect("Products");
    }
}
?>