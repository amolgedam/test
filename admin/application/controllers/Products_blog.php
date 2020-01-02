<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Products_blog extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Products_blog_model');
     $this->load->model('Crud_model');  
     $this->load->model('Common_model');
    }

     public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Products Blog',
        'createAction'=>site_url('Products_blog/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('products/products_blog/list',$data);
    $this->load->view('common/footer'); 
  }

 public function ajax_manage_page(){
        $getAllData = $this->Products_blog_model->get_datatables();
       // print_r($getAllData); exit();
      
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            $btn = anchor(site_url('Products_blog/View/'.$row->id),'<button title="View" class="btn btn-info btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Products_blog/update/'.$row->id),'<button title="Edit" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            if (strlen($row->description)>100) 
            {
              $description=substr($row->description,0,100).'...';
            }
            else{
              $description=$row->description;
            }

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $row->blog_heading;
            $nestedData[] = $description;
           
           
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Products_blog_model->count_all(),
                    "recordsFiltered" => $this->Products_blog_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }


   public function create()
 {
    $header = array('page_title'=>'WPES'); 
    $product_title = $this->Crud_model->GetData('product',"*","status='Active'");
    
    $data = array(
      'heading'=>'Add Products Blog',
      'subheading'=>'Create Products Blog',
     'button'=>'Create',
              'action'=>site_url('Products_blog/create_action'),
              'product_details_id' =>set_value('product_details_id'),
              'blog_heading' =>set_value('blog_heading'),
              'description' =>set_value('description'),
              'id' =>set_value('id'),
              'product_title' =>$product_title,
    );
  
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('products/products_blog/form',$data);
       
  }

 public function create_action()
  {
    
    // $ip=$_SERVER['REMOTE_ADDR'];
    $data=array(
      'product_details_id' => $_POST['product_details_id'],
        'blog_heading' => $_POST['blog_heading'],
        'description' => $_POST['description'],
       
        //'created_on_ip'=>$ip,
    );
    $this->Crud_model->SaveData('products_blog',$data);
    $this->session->set_flashdata('message', 'Services created successfully');
    redirect("Products_blog");
  }

public function change_status()
{
    if(isset($_POST['statusupdate']))
    {
        $this->Crud_model->SaveData("products_blog",$_POST,"id='".$_POST['id']."'");exit;
    }
}

public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $blog_manage_data = $this->Crud_model->get_single("products_blog","id='".$id."'");

        $data =array(
          'blog_heading'=>$blog_manage_data->blog_heading,
         /* 'product_type'=>$pp,*/
          'description'=>$blog_manage_data->description,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('products/products_blog/view',$data);
        $this->load->view('common/footer'); 

    }

public function update($id)
   {
    
      $header = array('page_title'=>'WPES'); 
      $product_title = $this->Crud_model->GetData("product",'',"status='Active'");
      $get_product_blog = $this->Crud_model->GetData('products_blog',"","id='".$id."'","","","","1");
      
      $data = array(
                'heading' => 'Update Products Blog',
                'subheading' => 'Update Products Blog',
                'button' => 'Update',
                'action' => site_url('Products_blog/update_action/'.$id),
                'product_details_id' =>$get_product_blog->product_details_id,
                'blog_heading' => $get_product_blog->blog_heading,
                'description' => $get_product_blog->description,
                'id' =>$id,
                'product_title' =>$product_title,
              
      );
     // print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('products/products_blog/form',$data);
         
    }

    public function update_action($id)
    {
      
      $data=array(
        'product_details_id'=>$_POST['product_details_id'],
          'blog_heading'=>$_POST['blog_heading'],
          'description'=>$_POST['description'],
          
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('products_blog',$data,"id='".$id."'");
      $this->session->set_flashdata('message', ' Products Blog updated successfully');
      redirect("Products_blog");
    }



 public function delete()
{
  if(isset($_POST['cid']))
        {
           $this->Common_model->delete('products_blog',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
}


  }