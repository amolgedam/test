<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Aboutus extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Aboutus_model');  
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Aboutus',
        'createAction'=>site_url('Aboutus/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('aboutus/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Aboutus_model->get_datatables();
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

            $btn = anchor(site_url('Aboutus/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Aboutus/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            $nestedData[] = $row->heading;
            $nestedData[] = $row->description;
            //$nestedData[] = $row->image;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Aboutus_model->count_all(),
                    "recordsFiltered" => $this->Aboutus_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {
    $header = array('page_title'=>'WPES');  
    $data = array('heading'=>'Add Blog',
      'subheading'=>'Create Blog',
      'button'=>'Create',
              'action'=>site_url('Aboutus/create_action'),
              'heading' =>set_value('heading'),
              'description' =>set_value('description'),
              'id' =>set_value('id'),
    );
   //print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('aboutus/form',$data);
       
  }
  public function create_action()
  {
    $data=array(
        'heading' => $_POST['heading'],
        'description' => $_POST['description'],
        'created'=>date('Y-m-d H:i:s'),
    );
    $this->Crud_model->SaveData('aboutus',$data);
    $this->session->set_flashdata('message', 'About Us created successfully');
    redirect("Aboutus");
  }
  public function update($id)
   {
      $header = array('page_title'=>'WPES'); 
      $aboutusdata = $this->Crud_model->get_single("aboutus","id='".$id."'");
      $data = array(
                'heading' => 'Update Aboutus',
                'subheading' => 'Update Aboutus',
                'button' => 'Update',
                'action' => site_url('Aboutus/update_action/'.$id),
                'heading' => $aboutusdata->heading,
                'description' => $aboutusdata->description,
                'id' =>$id,
      );
     // print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('aboutus/form',$data);
         
    }
  public function update_action($id)
    {
      
      $data=array(
          'heading'=>$_POST['heading'],
          'description'=>$_POST['description'],
          'image'=>$_POST['image'],
          'modified'=>date('Y-m-d H:i:s'),
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('aboutus',$data,"id='".$id."'");
      $this->session->set_flashdata('message', 'Aboutus updated successfully');
      redirect("Aboutus");
    }

    	public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("aboutus",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('aboutus',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
    }
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $aboutusdata = $this->Crud_model->get_single("aboutus","id='".$id."'");
        //print_r($blogdata);exit;
        $data =array(
          'heading'=>$aboutusdata->heading,
          'description'=>$aboutusdata->description,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('aboutus/view',$data);
        $this->load->view('common/footer'); 

    }
        
   
}
?>