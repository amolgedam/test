<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Contact extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Contact_model');
       
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Contact',
        
    );
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('Contact/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Contact_model->get_datatables();
        //print_r($getAllData);exit;
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            $btn = anchor(site_url('Contact/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');
           
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
            

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $row->name;
            $nestedData[] = $row->last_name;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Contact_model->count_all(),
                    "recordsFiltered" => $this->Contact_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }

 
      public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("contact",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
       
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('contact',"id='".$_POST['cid']."'");
           
        }
    }
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $carrerdata = $this->Crud_model->get_single("contact","id='".$id."'");
        //print_r($carrerdata->resume);exit;
         
        $data =array(
          'name'=>$carrerdata->name,
          'last_name'=>$carrerdata->last_name,
          'email'=>$carrerdata->email,
          'tell_me'=>$carrerdata->tell_me,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Contact/view',$data);
        $this->load->view('common/footer');
    }
        
 

   
}
?>