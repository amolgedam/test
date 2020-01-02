<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class CustomerMaster extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('CustomerMaster_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
      { 
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Customer Master',
            'createAction'=>site_url('CustomerMaster/create'),
            'changeAction'=>site_url('CustomerMaster/changeStatus'),
            'deleteAction'=>site_url('CustomerMaster/delete'),
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('customerMaster/list',$data);
        $this->load->view('common/footer'); 
      }
    public function ajax_manage_page(){
        $customerMaster = $this->CustomerMaster_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($customerMaster as $custData) 
        {
            
            $btn = anchor(site_url('CustomerMaster/View/'.$custData->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('CustomerMaster/update/'.$custData->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$custData->id.')"><i class="fa fa-trash-o"></i></span>';
           
             $status='';            
            if($custData->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$custData->id.'"  onClick="statuss('.$custData->id.');" >'.$custData->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$custData->id.'"  onClick="statuss('.$custData->id.');" >'.$custData->status.'</span>';
            }
            if(!empty($custData->customer_name)){ $customer_name = ucwords($custData->customer_name); }else{ $customer_name = "N/A"; }
            if(!empty($custData->city_name)){ $city_name = ucwords($custData->city_name); }else{ $city_name = "N/A"; }
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $customer_name;
            $nestedData[] = $custData->email;
            $nestedData[] = $custData->mobile_no;
            $nestedData[] = $status."<input type='hidden' id='status".$custData->id."' value='".$custData->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->CustomerMaster_model->count_all(),
                    "recordsFiltered" => $this->CustomerMaster_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function delete()
        {
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("customer_master","id='".$_POST['id']."'");exit();
            }
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("customer_master",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
        public function create()
        {
          $header = array('page_title'=>'WPES');  
          $states = $this->Crud_model->GetData('states',""," status='Active'");
          $cities = $this->Crud_model->GetData('cities',""," status='Active' and state_id='7'");
          $data = array('heading'=>'Add Customer',
            'subheading'=>'Create new Customer',
            'button'=>'Create',
                    'action'=>site_url('CustomerMaster/create_action'),
                    'customer_name' =>set_value('customer_name'),
                    'gst_no'=>set_value('gst_no'),
                    'city_id' =>set_value('city_id'),
                    'state_id' =>set_value('state_id'),
                    'email' =>set_value('email'),
                    'address' =>set_value('address'),
                    'mobile_no' =>set_value('mobile_no'),
                    'pin_code'=>set_value('pin_code'),
                    'id' =>set_value('id'),
                    'states'=>$states,
                    'cities'=>$cities,
          );
       
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
      $this->load->view('customerMaster/form',$data);
    }

    public function create_action()
    {
        $header = array('page_title'=>'WPES');
        $id = 0;
         $this->_rules($id);
        
        if ($this->form_validation->run() == FALSE) {
            
            $this->create();
        } 
        else 
        {    
            $data = array(
                        'city_id' =>$this->input->post('city_id',TRUE),
                        'state_id' =>$this->input->post('state_id',TRUE),
                        'customer_name' =>$this->input->post('customer_name',TRUE),
                        'gst_no' => $this->input->post('customer_gst_no',TRUE),
                        'email' => $this->input->post('email',TRUE),
                        'address' => $this->input->post('address',TRUE),
                        'mobile_no' => $this->input->post('mobile_no',TRUE),
                        'pin_code'=> $this->input->post('pin_code',TRUE),
                        'created'=> date('Y-m-d H:i:s'),
                            );
            // echo "<pre>"; print_r($_POST);
            // echo "<pre>"; print_r($data); exit;                
            
            $this->Crud_model->SaveData('customer_master',$data);
            $this->session->set_flashdata('message', 'Customer created successfully');
            redirect(site_url('CustomerMaster'));      
        }
    

    }
   
    public function get_city()
    {  
        $id = $this->input->post('id');
        $cityData = $this->Crud_model->GetData('cities',"*","status='Active' and   state_id = '".$id."'");

        $html = "<option value='0'>Select city</option>";
        foreach ($cityData as $row_data) 
        {
            $html .= "<br><option value='".$row_data->id."'>".ucfirst($row_data->city_name)."</option>";
        }
        echo $html;
    }

    public function _rules($id) 
    {   
        $table ='customer_master';
        $cond2 = "email='".$this->input->post('email',TRUE)."' and id!='".$id."'";
        $row2 = $this->Crud_model->get_single($table, $cond2);
        //print_r($row);exit;
        
        if(empty($row2))
        {
            $is_unique2 = "";
        }
        else {
            $is_unique2 = "|is_unique[customer_master.email]";

        }
        $this->form_validation->set_rules('email', 'email id', 'trim'.$is_unique2,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
        $cond3 = "mobile_no='".$this->input->post('mobile_no',TRUE)."' and id!='".$id."'";
        $row3 = $this->Crud_model->get_single($table, $cond3);
        //print_r($row);exit;
  
        if(empty($row3))
        {
            $is_unique3 = "";
        }
        else {
            $is_unique3 = "|is_unique[customer_master.mobile_no]";

        }
        $this->form_validation->set_rules('mobile_no', 'Contact 1', 'trim'.$is_unique3,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }
    public function update($id)
    { 
      $header = array('page_title'=>'Bapat CRM');
        $getCustomer = $this->Crud_model->get_single('customer_master',"id='".$id."'");
        $states =  $this->Crud_model->GetData('states',""," status='Active'");
        $cities =  $this->Crud_model->GetData('cities',""," status='Active' and state_id='".$getCustomer->state_id."'");
        $data = array('heading'=>'Update Customer',
                    'subheading'=>'Update Customer',
                    'button'=>'Update',
                    'action'=>site_url('CustomerMaster/update_action'),
                    'states'=>$states,
                    'cities'=>$cities,
                    'city_id' =>set_value('city_id',$getCustomer->city_id),
                    'state_id' =>set_value('state_id',$getCustomer->state_id),
                    'customer_name' => set_value('customer_name',$getCustomer->customer_name),
                    'gst_no' => set_value('customer_name',$getCustomer->gst_no),
                    'email' => set_value('email',$getCustomer->email),
                    'mobile_no' => set_value('mobile_no',$getCustomer->mobile_no),
                    'address' => set_value('address',$getCustomer->address),
                    'pin_code'=> set_value('pin_code',$getCustomer->pin_code),
                    'id' => set_value('id',$id),
                );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('customerMaster/form',$data);
        $this->load->view('common/footer'); 
    }

    public function update_action()
    {
        $id = $this->input->post('id');
        $this->_rules($id);
        $con="id='".$id."'";
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } 
        else
            {
            $data = array(
                        'city_id' =>$this->input->post('city_id',TRUE),
                        'state_id' =>$this->input->post('state_id',TRUE),
                        'customer_name' =>$this->input->post('customer_name',TRUE),
                        'gst_no' =>$this->input->post('customer_gst_no',TRUE),
                        'email' => $this->input->post('email',TRUE),
                        'address' => $this->input->post('address',TRUE),
                        'mobile_no' => $this->input->post('mobile_no',TRUE),
                        'pin_code'=>$this->input->post('pin_code',TRUE),
                        'modified'=> date('Y-m-d H:i:s'),
                    );
                    
            // echo "<pre>"; print_r($data); exit;
            
            $this->Crud_model->SaveData('customer_master',$data,$con);
            $this->session->set_flashdata('message', 'Customer Data updated successfully');
            redirect(site_url('CustomerMaster'));
        }      
    }

    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $cond="ac.id='".$id."'";

        $Getcustomerdata = $this->CustomerMaster_model->get_customerdata($cond);
        $citydata = $this->Crud_model->get_single("cities","id='".$Getcustomerdata->city_id."'");
        $data =array(
          'customer_name'=>$Getcustomerdata->customer_name,
          'address'=>$Getcustomerdata->address,
          'city_id'=>$citydata->city_name,
          'pin_code'=>$Getcustomerdata->pin_code,
          'mobile_no'=>$Getcustomerdata->mobile_no,
          'email'=>$Getcustomerdata->email,
          'status'=>$Getcustomerdata->status,
        );
         $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('customerMaster/view',$data);
        $this->load->view('common/footer'); 

    }
}
?>