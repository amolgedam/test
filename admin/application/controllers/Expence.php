<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Expence extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Expence_model');
       
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Expences',
        'createAction'=>site_url('Expence/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('expence/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Expence_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {
            
              $btn = anchor(site_url('Expence/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');
              $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash-o"></i></span>';
            
           /* $status='';            
            if($row->status=='Pending')
            {
                $status='<span class="btn btn-xs btn-warning" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            } */ 
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucfirst($row->expence_name);
            $nestedData[] = $row->amount;
            $nestedData[] = date('d-m-Y',strtotime($row->expence_date));
             $nestedData[] = $btn;
             //$nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Expence_model->count_all(),
                    "recordsFiltered" => $this->Expence_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {
    $header = array('page_title'=>'WPES');  
    $data = array('heading'=>'Add Expence',
      'subheading'=>'Create Expence',
      'button'=>'Create',
              'action'=>site_url('Expence/create_action'),
              'expence_name' =>set_value('expence_name'),
               'description' =>set_value('description'),
              'amount' =>set_value('amount'),
              'expence_date'=>set_value('expence_date'),
              'id' =>set_value('id'),
              'image' => set_value('image'),
    );
   // print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('expence/form',$data);
       
  }
  public function create_action()
  {
     if($_FILES['image']['name']!='')
    {  
        $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
        $config1['image_library'] = 'gd2';
        $config1['source_image'] =  $_FILES['image']['tmp_name'];
        $config1['new_image'] =   getcwd().'/uploads/expence/'.$_POST['image'];
        $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
        $config1['maintain_ratio'] = TRUE;
        $config1['width']     = 420;
        $config1['height']   = 453;
        $this->image_lib->initialize($config1);
        if(!$this->image_lib->resize())
        { 
          $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
          $this->create();
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
  
    $data=array(
        'expence_name' => $_POST['expence_name'],
        'description' => $_POST['description'],
        'amount' => $_POST['amount'],
        'expence_date' => date('Y-m-d',strtotime($_POST['expence_date'])),
        'image'=>$image,
        'created'=>date('Y-m-d H:i:s'),
    );
    $this->Crud_model->SaveData('expences',$data);
    $this->session->set_flashdata('message', 'Expence created successfully');
    redirect("Expence");
  }
  public function update($id)
   {
      $header = array('page_title'=>'Bapat Crm');  
      $data = array(
                'heading' => 'Update Expence',
                'subheading' => 'Update Expence',
                'button' => 'Update',
                'action' => site_url('Expence/update_action/'.$id),
                'expence_name' => $getexpence->expence_name,
                'description' => $getexpence->description,
                'amount' => $getexpence->amount,
                'expence_date' => $getexpence->expence_date,
                'image' => $getexpence->image,
                'status'=>$getexpence->status,
                'id' =>$id,
      );
     // print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('expence/form',$data);
         
    }
  public function update_action($id)
    {
      
       if($_FILES['image']['name']!='')
      {  
          $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
          $config1['image_library'] = 'gd2';
          $config1['source_image'] =  $_FILES['image']['tmp_name'];
          $config1['new_image'] =   getcwd().'/uploads/expence/'.$_POST['image'];
          $config1['allowed_types'] = 'JPG|PNG|jpg|png|JPEG|jpeg';
          $config1['maintain_ratio'] = TRUE;
          $config1['width']     = 420;
          $config1['height']   = 453;
          $this->image_lib->initialize($config1);
          if(!$this->image_lib->resize())
          { 
            $this->session->set_flashdata('image_error', '<span style="color:red">This file type is not allowed</span>');
            $this->create();
            return;
          }
          else 
          {   
            unlink('uploads/expence/'.$_POST['old_image']);
            $image  = $_POST['image'];   
          }
      }
      else
      {
        $image=$_POST['old_image'];
      }
      $data=array(
          'expence_name'=>$_POST['expence_name'],
            'description'=>$_POST['description'],
          'amount'=>$_POST['amount'],
          'expence_date'=>date('Y-m-d',strtotime($_POST['expence_date'])),
          'created_by' => $made_by,
          'image'=>$image,
          'modified'=>date('Y-m-d H:i:s'),
          'status'=>$_POST['status'],
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('expences',$data,"id='".$id."'");
      $this->session->set_flashdata('message', 'Expence updated successfully');
      redirect("Expence");
    }

    	public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("expences",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

   

    public function delete()
    {
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('expences',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
    }
    
    
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
      
        $Getcustomerdata = $this->Crud_model->get_single("expences","id='".$id."'");
      //print_r($Getcustomerdata);exit;
        $data =array(
          'heading'=>"Expence Details",
     
           'Getcustomerdata'=>$Getcustomerdata,
          
        );
  
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('expence/view',$data);
        $this->load->view('common/footer');
    }

        
   
}
?>