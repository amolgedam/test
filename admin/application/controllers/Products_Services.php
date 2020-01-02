<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Products_Services extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Products_Services_model');
     $this->load->model('Crud_model');  
     $this->load->model('Common_model');
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Products Services',
        'createAction'=>site_url('Products_Services/create'),
        
    );

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
  $this->load->view('products/products_services/list',$data);
    $this->load->view('common/footer'); 
  }
 

   public function ajax_manage_page(){
        $getAllData = $this->Products_Services_model->get_datatables();
      
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            $btn = anchor(site_url('Products_Services/View/'.$row->id),'<button title="View" class="btn btn-info btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Products_Services/update/'.$row->id),'<button title="Edit" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            $nestedData[] = $row->service_heading;
            $nestedData[] = $description;
           
           
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Products_Services_model->count_all(),
                    "recordsFiltered" => $this->Products_Services_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }

    public function create()
 {
    $header = array('page_title'=>'WPES');
     $product_title = $this->Crud_model->GetData('products_details',"*","status='Active'");

    $data = array('heading'=>'Add Products Services',
      'subheading'=>'Create Products Services',
      'button'=>'Create',
              'action'=>site_url('Products_Services/create_action'),
              'service_id' =>set_value('service_id'),
              'service_heading' =>set_value('service_heading'),
              'description' =>set_value('description'),
              'id' =>set_value('id'),
              'product_title' =>$product_title,
    );
  
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('products/products_services/form',$data);
       
  }
// Insert Title Name in Products
  public function create_action()
  {
    
     $ip=$_SERVER['REMOTE_ADDR'];
    $data=array(
      'service_id' => $_POST['service_id'],
        'service_heading' => $_POST['service_heading'],
        'description' => $_POST['description'],
       
        'created_on_ip'=>$ip,
    );
    $this->Crud_model->SaveData('products_services',$data);
    $this->session->set_flashdata('message', 'Services created successfully');
    redirect("Products_Services");
  }

public function change_status()
{
    if(isset($_POST['statusupdate']))
    {
        $this->Crud_model->SaveData("products_services",$_POST,"id='".$_POST['id']."'");exit;
    }
}
public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $service_manage_data = $this->Crud_model->get_single("products_services","id='".$id."'");

        /* if ($productdata->product_type=='Retail_Management') 
          {
              $pp='Retail Management';
          }
          else
          {
              $pp=$productdata->product_type;
          }*/

        $data =array(
          'service_heading'=>$service_manage_data->service_heading,
         /* 'product_type'=>$pp,*/
          'description'=>$service_manage_data->description,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('products/products_services/view',$data);
        $this->load->view('common/footer'); 

    }
public function update($id)
   {
    
      $header = array('page_title'=>'WPES'); 
      $product_title = $this->Crud_model->GetData("products_details",'',"status='Active'");
      $get_product_service = $this->Crud_model->GetData('products_services',"","id='".$id."'","","","","1");
      
      $data = array(
                'heading' => 'Update Products Services',
                'subheading' => 'Update Products Services',
                'button' => 'Update',
                'action' => site_url('Products_Services/update_action/'.$id),
                'service_id' =>$get_product_service->service_id,
                'service_heading' => $get_product_service->service_heading,
                'description' => $get_product_service->description,
                'id' =>$id,
                'product_title' =>$product_title,
              
      );
     // print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('products/products_services/form',$data);
         
    }
  public function update_action($id)
    {
      
      $data=array(
        'service_id'=>$_POST['service_id'],
          'service_heading'=>$_POST['service_heading'],
          'description'=>$_POST['description'],
          
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('products_services',$data,"id='".$id."'");
      $this->session->set_flashdata('message', 'Service updated successfully');
      redirect("Products_Services");
    }

  public function delete()
{
  if(isset($_POST['cid']))
        {
           $this->Common_model->delete('products_services',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
}

}