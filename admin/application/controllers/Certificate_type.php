<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Certificate_type extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Certificate_type_model');
       
    }
    public function index()
  {
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Certificate Type',
        'createAction'=>site_url('Certificate_type/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('certificate_type/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Certificate_type_model->get_datatables();
     
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            

            $btn ='&nbsp;&nbsp;'.anchor(site_url('Certificate_type/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            $nestedData[] = ucfirst($row->title);
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Certificate_type_model->count_all(),
                    "recordsFiltered" => $this->Certificate_type_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {
    $header = array('page_title'=>'WPES');  
    $data = array('heading'=>'Add Certificate Type',
      'subheading'=>'Create Certificate Type',
      'button'=>'Create',
              'action'=>site_url('Certificate_type/create_action'),
             'title' =>set_value('title'),
              'id' =>set_value('id'),
    );
   // print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('certificate_type/form',$data);
       
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
    $this->Crud_model->SaveData('certificate_type',$data);
    $this->session->set_flashdata('message', 'Certificate Type created successfully');
    redirect("Certificate_type");
  }
  }
  public function update($id)
   {
      $header = array('page_title'=>'WPES'); 
      $insdustrydata = $this->Crud_model->get_single("certificate_type","id='".$id."'"); 
      $data = array(
                'heading' => 'Update Certificate Type',
                'subheading' => 'Update Certificate Type',
                'button' => 'Update',
                'action' => site_url('Certificate_type/update_action/'.$id),
                'title' => $insdustrydata->title,
                'id' =>$id,
      );
     // print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('certificate_type/form',$data);
         
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
      $this->Crud_model->SaveData('certificate_type',$data,"id='".$id."'");
    }
      $this->session->set_flashdata('message', 'Certificate Type updated successfully');
      redirect("Certificate_type");

    }

    	public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("certificate_type",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('certificate_type',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
    }
    
        
   public function _rules($id) 
    {   

      $cond = "title='".$this->input->post('title',TRUE)."' and id!='".$id."'";
      $row = $this->Crud_model->GetData("certificate_type","", $cond);
      $count = count($row);
      if($count==0) 
      {
          $is_unique = "";
      }
      else 
      {
          $is_unique = "|is_unique[certificate_type.title]";

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