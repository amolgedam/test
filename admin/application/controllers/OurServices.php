<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class OurServices extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Our_Service_model');
       
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Our Services',
        'createAction'=>site_url('OurServices/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('OurServices/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Our_Service_model->get_datatables();
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            $btn = anchor(site_url('OurServices/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('OurServices/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            $nestedData[] = $row->heading;
            $nestedData[] = $row->description;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Our_Service_model->count_all(),
                    "recordsFiltered" => $this->Our_Service_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {
    $header = array('page_title'=>'WPES');
    $pageHeading = $this->Crud_model->GetData('service_detail',"heading,id","","","","","");
    //print_r($pageHeading);exit;
    $data = array(
      'headinggg'=>'Add Industries',
      'subheading'=>'Create Industries',
      'button'=>'Create',
      'action'=>site_url('OurServices/create_action'),
      'heading' =>set_value('heading'),
      'description' =>set_value('description'),
      'id' =>set_value('id'),
      'page_heading_id' =>set_value('page_heading_id'),
      'pageHeading' =>$pageHeading,
    );
   // print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('OurServices/form',$data);
       
  }

  public function create_action()
  {
    
    $id = '0';
    $this->_rules($id);
    if($this->form_validation->run() == FALSE) 
    {  
      $this->create();
    } 
    else
    {  
      $titleData = $this->Crud_model->GetData('services',"title,id","id ='".$insdustrydata->service_id."' and status='Active'","","","","1");
      $data=array(
        'heading' => $_POST['heading'],
        'description' => $_POST['description'],
        'service_detail_id' => $_POST['page_heading'],
        'created'=>date('Y-m-d H:i:s'),
      );
      $this->Crud_model->SaveData('ourservice',$data);
      $this->session->set_flashdata('message', 'Services Details created successfully');
      redirect("OurServices");
    }
  }
  public function update($id)
   {
      $header = array('page_title'=>'WPES');
      $insdustrydata = $this->Crud_model->get_single("ourservice","id='".$id."'");
      $pageHeading = $this->Crud_model->GetData('service_detail',"heading,id","","","","","");
      //print_r($insdustrydata);exit;
      $titleData = $this->Crud_model->GetData('service_detail',"heading,id","id ='".$insdustrydata->service_detail_id."' and status='Active'","","","","1"); 
      //print_r($titleData->heading);exit;
      $data = array(
                'headinggg' => 'Update Industries',
                'subheading' => 'Update Industries',
                'button' => 'Update',
                'action' => site_url('OurServices/update_action/'.$id),
                'heading' => $insdustrydata->heading,
                'description' => $insdustrydata->description,
                'pageHeading' =>$pageHeading,
                'page_heading_id' => $titleData->id,
                'id' =>$id,
      );
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('OurServices/form',$data);
         
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
          'heading'=>$_POST['heading'],
          'description'=>$_POST['description'],
          'service_detail_id'=>$_POST['page_heading'],
          'modified'=>date('Y-m-d H:i:s'),
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('ourservice',$data,"id='".$id."'");
      }
      $this->session->set_flashdata('message', 'Services updated successfully');
      redirect("OurServices");
    }


      public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("ourservice",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
      
        if(isset($_POST['id']))
        {
           $this->Common_model->delete('ourservice',"id='".$_POST['id']."'");
           
        }
    }
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $insdustrydata = $this->Crud_model->get_single("ourservice","id='".$id."'");
        //print_r($insdustrydata);exit;
        $headingdata = $this->Crud_model->GetData('service_detail',"","id = '".$insdustrydata->service_detail_id."'","","","","1");
        //print_r($headingdata->heading);exit;
        $data =array(
          'heading'=>$insdustrydata->heading,
          'description'=>$insdustrydata->description,
          'page_heading'=>$headingdata->heading,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('OurServices/view',$data);
        $this->load->view('common/footer');
    }
        
   
 public function _rules($id) 
    {   

      $cond = "heading='".$this->input->post('heading',TRUE)."' and id!='".$id."'";
      $row = $this->Crud_model->GetData("ourservice","", $cond);
      $count = count($row);
      if($count==0) 
      {
          $is_unique = "";
      }
      else 
      {
          $is_unique = "|is_unique[ourservice.heading]";

      }
        $this->form_validation->set_rules('heading', 'heading is', 'trim|required'.$is_unique,
        array(
                'required'=> 'Please enter %s.',
                'is_unique'=>'This %s already exist'
            ));
        
    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
}
}
?>