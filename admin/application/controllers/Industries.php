<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Industries extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Industries_model');
       
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Industries',
        'createAction'=>site_url('Industries/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('industries/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Industries_model->get_datatables();
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

            $btn = anchor(site_url('Industries/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Industries/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            if ($row->type=='Product_Engineering') {
                  $pp='Product Engineering';
            }
            else
            {
              $pp=$row->type;
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $pp;
            $nestedData[] = $row->title;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Industries_model->count_all(),
                    "recordsFiltered" => $this->Industries_model->count_filtered(),
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
              'action'=>site_url('Industries/create_action'),
              'type' =>set_value('type'),
              'title' =>set_value('title'),
              'id' =>set_value('id'),
    );
   // print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('industries/form',$data);
       
  }
  public function create_action()
  {
     
    $data=array(
        'type' => $_POST['type'],
        'title' => $_POST['title'],
        'created'=>date('Y-m-d H:i:s'),
    );
    $this->Crud_model->SaveData('industries',$data);
    $this->session->set_flashdata('message', 'Industries created successfully');
    redirect("Industries");
  }
  public function update($id)
   {
      $header = array('page_title'=>'WPES'); 
      $insdustrydata = $this->Crud_model->get_single("industries","id='".$id."'"); 
      $data = array(
                'heading' => 'Update Industries',
                'subheading' => 'Update Industries',
                'button' => 'Update',
                'action' => site_url('Industries/update_action/'.$id),
                'type' => $insdustrydata->type,
                'title' => $insdustrydata->title,
                'id' =>$id,
      );
     // print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('industries/form',$data);
         
    }
  public function update_action($id)
    {
      
      $data=array(
          'type'=>$_POST['type'],
          'title'=>$_POST['title'],
          'modified'=>date('Y-m-d H:i:s'),
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('industries',$data,"id='".$id."'");
      $this->session->set_flashdata('message', 'Industries updated successfully');
      redirect("Industries");
    }

    	public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("industries",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('industries',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
    }
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $insdustrydata = $this->Crud_model->get_single("industries","id='".$id."'");

         if ($insdustrydata->type=='Product_Engineering') 
          {
              $pp='Product Engineering';
          }
          else
          {
              $pp=$insdustrydata->type;
          }

        $data =array(
          'type'=>$pp,
          'title'=>$insdustrydata->title,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('industries/view',$data);
        $this->load->view('common/footer'); 

    }
        
   
}
?>