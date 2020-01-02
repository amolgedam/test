<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Lead extends CI_Controller {

  function __construct() 
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Lead_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index($flag='')
      { 
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Manage Lead',
            'createAction'=>site_url('Lead/create'),
            'changeAction'=>site_url('Lead/changeStatus'),
            'deleteAction'=>site_url('Lead/delete'),
            'flag'=>$flag,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Lead/list',$data);
        
      }
    public function ajax_manage_page($flag='')
    {
        if($_SESSION['SESSION_NAME']['designation']=='marketing')
        {
            if($flag=='today')
            {
              $con="ml.created_by='".$_SESSION['SESSION_NAME']['id']."' and date='".date('Y-m-d')."'";  
            }
            else
            {
                $con="ml.created_by='".$_SESSION['SESSION_NAME']['id']."' || ml.assign_to='".$_SESSION['SESSION_NAME']['id']."'";  
            }
            
        }
        else if($_SESSION['SESSION_NAME']['designation']=='telecaller')
        {
             if($flag=='today')
            {
              $con="ml.created_by='".$_SESSION['SESSION_NAME']['id']."' and date='".date('Y-m-d')."'";  
            }
            else
            {
                $con="ml.created_by='".$_SESSION['SESSION_NAME']['id']."' || ml.assign_to='".$_SESSION['SESSION_NAME']['id']."'";  
            }
        }
        else{
          if($flag=='today')
            {
                $con="ml.date='".date('Y-m-d')."' ";  
            }

            else if($flag=='today_appointment')
            {

                $con="ml.appoint_date='".date('Y-m-d')."' ";  
            }
            
             else if($flag=='today_followup')
            {
              $con="ml.follop_date='".date('Y-m-d')."' ";  
            }

            else
            {
                $con="1=1"; 
            }

}
        $Lead = $this->Lead_model->get_datatables($con);
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Lead as $ser) 
        {

           
            $btn="";

            if($_SESSION['SESSION_NAME']['designation']=='admin')
            {

            $btn .='<button title="Assign To" class="btn btn-info btn-xs" data-toggle="modal" data-target="#add" onclick="update('.$ser->id.')">Assign To</button>';

            $btn .='&nbsp;|&nbsp;'.'<button title="Follow Date" class="btn btn-success btn-xs" data-toggle="modal" data-target="#follow_date" onclick="follow_date('.$ser->id.')">Follow Date</button>';
    
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$ser->id.')"><i class="fa fa-trash-o"></i></span>';
            }
            else if($_SESSION['SESSION_NAME']['designation']=='marketing')
            {
                $btn .='&nbsp;|&nbsp;'.'<button title="Follow Date" class="btn btn-success btn-xs" data-toggle="modal" data-target="#follow_date" onclick="follow_date('.$ser->id.')">Follow Date</button>';
            }

            $btn .= '&nbsp;|&nbsp;'.anchor(site_url('Lead/View/'.$ser->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Lead/update/'.$ser->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
             $status='';            
            if($ser->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$ser->id.'"  onClick="statuss('.$ser->id.');" >'.$ser->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$ser->id.'"  onClick="statuss('.$ser->id.');" >'.$ser->status.'</span>';
            }
            if(!empty($ser->title)){ $title = ucwords($ser->title); }else{ $title = "N/A"; }
           
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($ser->name);
            $nestedData[] = ucwords($ser->client_name);
            $nestedData[] = ucwords($ser->client_mobile);
         
            $nestedData[] = ucwords($ser->requred_product);
            $nestedData[] = ucwords($ser->date);
            $nestedData[] = ucwords($ser->follop_date);
            $nestedData[] = ucwords($ser->appoint_date);
          
            $nestedData[] = $status."<input type='hidden' id='status".$ser->id."' value='".$ser->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Lead_model->count_all($con),
                    "recordsFiltered" => $this->Lead_model->count_filtered($con),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function delete()
        {
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("manage_lead","id='".$_POST['id']."'");exit();
            }
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("manage_lead",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
        public function create()
        {
          $header = array('page_title'=>'WPES');

          $data = array('heading'=>'Add Lead',
            'subheading'=>'Create new Lead',
            'button'=>'Create',
                    'action'=>site_url('Lead/create_action'),
                    'client_name' =>set_value('client_name'),
                    'client_mobile' =>set_value('client_mobile'),
                    'email' =>set_value('email'),
                    'address' =>set_value('address'),
                    'requred_product' =>set_value('requred_product'),
                    'date' =>set_value('date'),
                    'follop_date' =>set_value('follop_date'),
                    'appoint_date' =>set_value('appoint_date'),
                    'alternet_no' =>set_value('alternet_no'),
                    'id' =>set_value('id'),   
          );
       
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
      $this->load->view('Lead/form',$data);
       $this->load->view('common/footer');      
    }

    public function create_action()
    {
        
        $header = array('page_title'=>'WPES');
        $session = $this->Crud_model->GetData("admin",'name',"status='Active'");
        // print_r($session);exit;
        $id = 0;
         $this->_rules($id);
        
        if ($this->form_validation->run() == FALSE) {
            
            $this->create();
        } 
        else 
        {    
            $data = array(              
                    'created_by'=>$_SESSION['SESSION_NAME']['id'],
                    'client_name' =>$this->input->post('client_name',TRUE),
                    'client_mobile' =>$this->input->post('client_mobile',TRUE),
                    'email' =>$this->input->post('email',TRUE),
                    'address' =>$this->input->post('address',TRUE),
                    'requred_product' =>$this->input->post('requred_product',TRUE),
                    'date' =>date('Y-m-d'),
                    'follop_date' =>$this->input->post('follop_date',TRUE),
                    'appoint_date' =>$this->input->post('appoint_date',TRUE),
                    'alternet_no' =>$this->input->post('alternet_no',TRUE),
                    'session' =>$this->input->post('session'),
                    'created'=> date('Y-m-d H:i:s'),
            );
            //print_r($data);exit();
            $this->Crud_model->SaveData('manage_lead',$data);
            $this->session->set_flashdata('message', 'Customer created successfully');
            redirect(site_url('Lead'));      
        }
    

    }
 

    public function _rules($id) 
    {   
        $table ='manage_lead';
        $cond2 = "email='".$this->input->post('email',TRUE)."'";
        $row2 = $this->Crud_model->get_single($table, $cond2);
        //print_r($row);exit;
        
        if(empty($row2))
        {
            $is_unique2 = "";
        }
        else {
            $is_unique2 = "|is_unique[manage_lead.email]";

        }
        $this->form_validation->set_rules('email', 'email id', 'trim'.$is_unique2,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
       
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }
    public function update($id)
    { 
        $getservice = $this->Crud_model->get_single('manage_lead',"id='".$id."'");
       
        $data = array('heading'=>'Update Lead',
                    'subheading'=>'Update Lead',
                    'button'=>'Update',
                    'action'=>site_url('Lead/update_action'),
                    'client_name' => set_value('client_name',$getservice->client_name),
                    'client_mobile' => set_value('client_mobile',$getservice->client_mobile),
                    'email' => set_value('email',$getservice->email),
                    'address' => set_value('address',$getservice->address),
                    'requred_product' => set_value('requred_product',$getservice->requred_product),
                    'date' => set_value('date',$getservice->date),
                    'follop_date' => set_value('follop_date',$getservice->follop_date),
                    'appoint_date' => set_value('appoint_date',$getservice->appoint_date),
                    'alternet_no' => set_value('alternet_no',$getservice->alternet_no),
                    'id' => set_value('id',$id),
                );
        $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('Lead/form',$data);
        $this->load->view('common/footer'); 
    }

    public function update_action()
    {
        /*$id = $this->input->post('id');*/
        $session = $this->Crud_model->GetData("admin",'name',"status='Active'");
       $id=$_POST['id'];

            $data = array(
                   // 'created_by'=>$_SESSION['SESSION_NAME']['id'],
                    'client_name' =>$this->input->post('client_name',TRUE),
                    'client_mobile' =>$this->input->post('client_mobile',TRUE),
                    'email' =>$this->input->post('email',TRUE),
                    'address' =>$this->input->post('address',TRUE),
                    'requred_product' =>$this->input->post('requred_product',TRUE),
                    'date' =>$this->input->post('date',TRUE),
                    'follop_date' =>$this->input->post('follop_date',TRUE),
                    'appoint_date' =>$this->input->post('appoint_date',TRUE),
                    'alternet_no' =>$this->input->post('alternet_no',TRUE),
                        'modified'=> date('Y-m-d H:i:s'),
                    );
            //print_r($data);exit;
            $this->Crud_model->SaveData('manage_lead',$data,"id='".$id."'");
            $this->session->set_flashdata('message', 'Lead updated successfully');
            redirect(site_url('Lead'));
             
    }

    public function View($id)
    {  
  
        $row = $this->Crud_model->get_single("manage_lead","id='".$id."'");
          $follow_data = $this->Crud_model->GetData("lead_folloup","","manage_lead_id='".$id."'");
     
          $get_assign_name = $this->Crud_model->GetData("admin",'name',"id='".$row->assign_to."'",'','','','1');
          //print_r($get_assign_name); exit();
    
        $data =array(
          'client_name'=>$row->client_name,
          'client_mobile'=>$row->client_mobile,
          'email'=>$row->email,
          'address'=>$row->address,
          'requred_product'=>$row->requred_product,
          'date'=>$row->date,
          'follop_date'=>$row->follop_date,
          'appoint_date'=>$row->appoint_date,
          'alternet_no'=>$row->alternet_no,
          'status'=>$row->status,
          'follow_data'=>$follow_data,
          'get_assign_name'=>$get_assign_name,
        );
         $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('Lead/view',$data);
        $this->load->view('common/footer'); 

    }

    //Assign Modal Update

public function assign_to()
{
            
    $query="select id,name from admin where designation_id=3";
    $data=$this->db->query($query);
    $result =$data->result_array();
   
    echo json_encode($result); exit();
}


 public function get_manage_lead()
  {
    $assign_data=$this->Crud_model->get_single('manage_lead',"id='".$_POST['id']."'");
  
    $data=array(
      'id'=>$assign_data->id,
      'client_name'=>$assign_data->client_name,
      'requred_product'=>$assign_data->requred_product,
      'assign_to'=>$assign_data->assign_to,
    
      'description'=>$assign_data->description,
    );
    echo json_encode($data);exit;
  }

 public function update_manage()
  {
    
      extract($_POST);
      $update_query="UPDATE `manage_lead` SET `assign_to`='$assign_to',`description`='$description' WHERE `id`='$id'";
      if($this->db->query($update_query))
      {
        echo "success";
      }
      else{
        echo "unsuccess";
      }
  }

    //End Assign Modal

public function follow_id_insert()
{
    $assign_data=$this->Crud_model->get_single('manage_lead',"id='".$_POST['id']."'");
  
    $data=array(
      'id'=>$assign_data->id,
  );
   echo json_encode($data);exit;
}


//Add Follow data Insert
public function follow_date_insert()
{

     // $manage_lead_id = $this->Crud_model->GetData('manage_lead',"id","","","","","");

   // print_r($manage_lead_id); exit();
     
        $data=array(
        'date'=>$_POST['date'],
        'remark'=>$_POST['remark'],

       'manage_lead_id'=>$_POST['manage_lead_id'],
        );
        $this->Crud_model->SaveData('lead_folloup',$data);
        $this->session->set_flashdata('message', 'Followup data created successfully');
       

}

  //End Follow data
}
?>