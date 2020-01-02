<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Products_Service_List extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Products_Service_List_model');
     $this->load->model('Crud_model');  
     $this->load->model('Common_model');
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Products Services List',
        'createAction'=>site_url('Products_Service_List/create'),
        
    );

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
  $this->load->view('products/product_service_list/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Products_Service_List_model->get_datatables();
     // print_r($getAllData);
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            $btn = anchor(site_url('Products_Service_List/View/'.$row->id),'<button title="View" class="btn btn-info btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Products_Service_List/update/'.$row->id),'<button title="Edit" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            $nestedData[] = $row->service_heading_list;
            $nestedData[] = $description;
           
           
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Products_Service_List_model->count_all(),
                    "recordsFiltered" => $this->Products_Service_List_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }

     public function create()
 {
    $header = array('page_title'=>'WPES');  
     $service_list = $this->Crud_model->GetData('products_services',"*","status='Active'"); 
    $data = array('heading'=>'Add Products Services List',
      'subheading'=>'Create Products Services List',
      'button'=>'Create',
              'action'=>site_url('Products_Service_List/create_action'),
              'service_heading_id' =>set_value('service_heading_id'),
              'service_heading_list' =>set_value('service_heading_list'),
              'description' =>set_value('description'),
              'id' =>set_value('id'),
             'service_list' =>$service_list,
    );
  
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('products/product_service_list/form',$data);
       
  }
// Insert Title Name in Products
  public function create_action()
  {
    
     $ip=$_SERVER['REMOTE_ADDR'];
    $data=array(
      'service_heading_id' => $_POST['service_heading_id'],
        'service_heading_list' => $_POST['service_heading_list'],
        'description' => $_POST['description'],
       
        'created_on_ip'=>$ip,
    );
    $this->Crud_model->SaveData('products_service_list',$data);
    $this->session->set_flashdata('message', 'Services Heading List created successfully');
    redirect("Products_Service_List");
  }

public function change_status()
{
    if(isset($_POST['statusupdate']))
    {
        $this->Crud_model->SaveData("products_service_list",$_POST,"id='".$_POST['id']."'");exit;
    }
}

public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $service_list_data = $this->Crud_model->get_single("products_service_list","id='".$id."'");

        $data =array(
          'service_heading_list'=>$service_list_data->service_heading_list,
         
          'description'=>$service_list_data->description,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('products/product_service_list/view',$data);
        $this->load->view('common/footer'); 

    }
    public function update($id)
   {
      $header = array('page_title'=>'WPES'); 
      $service_list = $this->Crud_model->GetData("products_services",'',"status='Active'");
      $update_data = $this->Crud_model->get_single("products_service_list","id='".$id."'"); 
      $data = array(
                'heading' => 'Update Products Services List',
                'subheading' => 'Update Products Services List',
                'button' => 'Update',
                'action' => site_url('Products_Service_List/update_action/'.$id),
                'service_heading_id'=>$update_data->service_heading_id,
                'service_heading_list' => $update_data->service_heading_list,
                'description' => $update_data->description,
                'id' =>$id,
              'service_list'=>$service_list,
      );
     // print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('products/product_service_list/form',$data);
         
    }
  public function update_action($id)
    {
      
      $data=array(
         'service_heading_id'=>$_POST['service_heading_id'],
          'service_heading_list'=>$_POST['service_heading_list'],
          'description'=>$_POST['description'],
          
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('products_service_list',$data,"id='".$id."'");
      $this->session->set_flashdata('message', 'Service List updated successfully');
      redirect("Products_Service_List");
    }

   public function delete()
{
  if(isset($_POST['cid']))
        {
           $this->Common_model->delete('products_service_list',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
}

}