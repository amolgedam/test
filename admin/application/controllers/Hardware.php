<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Hardware extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Hardware_model');
       
    }
    public function index()
  {
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Hardware',
        'createAction'=>site_url('Hardware/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('hardware/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Hardware_model->get_datatables();
       ///print_r($getAllData);exit;
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            $btn = anchor(site_url('Hardware/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Hardware/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            $nestedData[] = $row->title;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Hardware_model->count_all(),
                    "recordsFiltered" => $this->Hardware_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {
    $header = array('page_title'=>'WPES');  
    $data = array('heading'=>'Add Industries',
      'subheading'=>'Create Industries',
      'button'=>'Create',
              'action'=>site_url('Hardware/create_action'),
              'type' =>set_value('type'),
              'title' =>set_value('title'),
              'id' =>set_value('id'),
    );
   // print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('hardware/form',$data);
       
  }
  public function create_action()
  {
   $id = '0';
    $this->_rules($id);
    if($this->form_validation->run() == FALSE) 
    {  
      $this->create();
    } 
    else{

    $data=array(
        'title' => $_POST['title'],
        'created'=>date('Y-m-d H:i:s'),
    );
    $this->Crud_model->SaveData('hardware',$data);
    $this->session->set_flashdata('message', 'Industries created successfully');
    redirect("Hardware");
  }
  }
  public function update($id)
   {
      $header = array('page_title'=>'WPES'); 
      $insdustrydata = $this->Crud_model->get_single("hardware","id='".$id."'"); 
      $data = array(
                'heading' => 'Update Industries',
                'subheading' => 'Update Industries',
                'button' => 'Update',
                'action' => site_url('Hardware/update_action/'.$id),
                'title' => $insdustrydata->title,
                'id' =>$id,
      );
     // print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('hardware/form',$data);
         
    }
  public function update_action($id)
    {
      $id=$id;
      $this->_rules($id);
    if ($this->form_validation->run() == FALSE)
    {          
      $this->update($id);
    }
    else 
    {  
      $data=array(
          'title'=>$_POST['title'],
          'modified'=>date('Y-m-d H:i:s'),
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('hardware',$data,"id='".$id."'");
    }
      $this->session->set_flashdata('message', 'Hardware updated successfully');
      redirect("Hardware");

    }

    	public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("hardware",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('hardware',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
    }
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $insdustrydata = $this->Crud_model->get_single("hardware","id='".$id."'");

        $data =array(
          'title'=>$insdustrydata->title,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('hardware/view',$data);
        $this->load->view('common/footer'); 

    }
        
   public function _rules($id) 
    {   

      $cond = "title='".$this->input->post('title',TRUE)."' and id!='".$id."'";
      $row = $this->Crud_model->GetData("hardware","", $cond);
      $count = count($row);
      if($count==0) 
      {
          $is_unique = "";
      }
      else 
      {
          $is_unique = "|is_unique[hardware.title]";

      }
        $this->form_validation->set_rules('title', 'title is', 'trim|required'.$is_unique,
        array(
                'required'=> 'Please enter %s.',
                'is_unique'=>'This %s already exist'
            ));
        
    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
}
}
?>