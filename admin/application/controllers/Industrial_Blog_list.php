<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Industrial_Blog_list extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Industrial_Blog_list_model');
    }

    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Industries Blog list',
        'createAction'=>site_url('Industrial_Blog_list/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('Industries_Blog_List/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Industrial_Blog_list_model->get_datatables();
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

            $btn = anchor(site_url('Industrial_Blog_list/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Industrial_Blog_list/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
                    "recordsTotal" => $this->Industrial_Blog_list_model->count_all(),
                    "recordsFiltered" => $this->Industrial_Blog_list_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {
    $header = array('page_title'=>'WPES');
    $serHeading = $this->Crud_model->GetData('industrial_blog',"heading,id","","","","","");
    //print_r($serHeading);exit;
    $data = array(
      'headinggg'=>'Add Industries Blog',
      'subheading'=>'Create Industries Blog',
      'button'=>'Create',
      'action'=>site_url('Industrial_Blog_list/create_action'),
      'heading' =>set_value('heading'),
      'description' =>set_value('description'),
      'id' =>set_value('id'),
      'page_heading_id' =>set_value('page_heading_id'),
      'serHeading' =>$serHeading,
    );
   // print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('Industries_Blog_List/form',$data);
       
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
      $titleData = $this->Crud_model->GetData('industries',"title,id","id ='".$insdustrydata->industries_id."' and status='Active'","","","","1");
      $data=array(
        'heading' => $_POST['heading'],
        'description' => $_POST['description'],
        'industries_services_id' => $_POST['ser_heading'],
        'created'=>date('Y-m-d H:i:s'),
      );
      $this->Crud_model->SaveData('industrial_blog_list',$data);
      $this->session->set_flashdata('message', 'Industries Blog List created successfully');
      redirect("Industrial_Blog_list");
    }
  }
  public function update($id)
   {
      $header = array('page_title'=>'WPES');
      $insdustrydata = $this->Crud_model->get_single("industrial_blog_list","id='".$id."'");
      $pageHeading = $this->Crud_model->GetData('industrial_blog',"heading,id","","","","","");
      //print_r($insdustrydata->industries_services_id);exit;
      $titleData = $this->Crud_model->GetData('industrial_blog',"heading,id","id ='".$insdustrydata->industries_services_id."'","","","","1");  
      //print_r($titleData);exit;
      $data = array(
                'headinggg' => 'Update Industries Blog',
                'subheading' => 'Update Industries Blog',
                'button' => 'Update',
                'action' => site_url('Industrial_Blog_list/update_action/'.$id),
                'heading' => $insdustrydata->heading,
                'description' => $insdustrydata->description,
                'serHeading' =>$pageHeading,
                'page_heading_id' => $titleData->id,
                'id' =>$id,
      );
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('Industries_Blog_List/form',$data);
         
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
          'industries_services_id'=>$_POST['ser_heading'],
          'modified'=>date('Y-m-d H:i:s'),
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('industrial_blog_list',$data,"id='".$id."'");
      }
      $this->session->set_flashdata('message', 'Industries Blog updated successfully');
      redirect("Industrial_Blog_list");
    }


      public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("industrial_blog_list",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
      
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('industrial_blog_list',"id='".$_POST['cid']."'");
           
        }
    }
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $insdustrydata = $this->Crud_model->get_single("industrial_blog_list","id='".$id."'");
        //print_r($insdustrydata);exit;
        $headingdata = $this->Crud_model->GetData('industrial_blog',"","id = '".$insdustrydata->industries_services_id."'","","","","1");
        //print_r($headingdata->heading);exit;
        $data =array(
          'heading'=>$insdustrydata->heading,
          'description'=>$insdustrydata->description,
          'page_heading'=>$headingdata->heading,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Industries_Blog_List/view',$data);
        $this->load->view('common/footer');
    }
        
   
 public function _rules($id) 
    {   

      $cond = "heading='".$this->input->post('heading',TRUE)."' and id!='".$id."'";
      $row = $this->Crud_model->GetData("industrial_blog_list","", $cond);
      $count = count($row);
      if($count==0) 
      {
          $is_unique = "";
      }
      else 
      {
          $is_unique = "|is_unique[industrial_blog_list.heading]";

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