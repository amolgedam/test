<?php 
  
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Service_work_detail extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('ServiceWork_detail_model'); 
       
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Our Services Work list',
        'createAction'=>site_url('Service_work_detail/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('Service_work_detail/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->ServiceWork_detail_model->get_datatables();
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

            $btn = anchor(site_url('Service_work_detail/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Service_work_detail/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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

            if(!empty($row->image))
            {
                $image = '<img src="'.base_url("uploads/service/".$row->image).'" width=100px" height="100px"> ';
            }
           else
            {
                $image = "<img src='".base_url('uploads/No_Image_Available.jpg')."' width='100px' height='100px'> "; 
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
            $nestedData[] = $description;
            $nestedData[] = $image;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->ServiceWork_detail_model->count_all(),
                    "recordsFiltered" => $this->ServiceWork_detail_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {
    $header = array('page_title'=>'WPES');
    $serHeading = $this->Crud_model->GetData('service_work',"heading,id","","","","","");
    //print_r($serHeading);exit;
    $data = array(
      'headinggg'=>'Add Services',
      'subheading'=>'Create service list',
      'button'=>'Create',
      'action'=>site_url('Service_work_detail/create_action'),
      'heading' =>set_value('heading'),
      'description' =>set_value('description'),
      'image' =>set_value('image'),
      'id' =>set_value('id'),
      'page_heading_id' =>set_value('page_heading_id'),
      'serHeading' =>$serHeading,
    );
   // print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('Service_work_detail/form',$data);
       
  }

  public function create_action()
  {
       if($_FILES['image']['name']!='')
            {  
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] =  $_FILES['image']['tmp_name'];
                  $config1['new_image'] =   getcwd().'/uploads/service/'.$_POST['image'];
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
        'heading' => $_POST['heading'],
        'description' => $_POST['description'],
        'image' => $image,
        'work_service_id' => $_POST['ser_heading'],
        'created'=>date('Y-m-d H:i:s'),
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('service_work_detail',$data);
      $this->session->set_flashdata('message', 'Services work List created successfully');
      redirect("Service_work_detail");
    
  }
  public function update($id)
   {
      $header = array('page_title'=>'WPES');
      $servicedata = $this->Crud_model->get_single("service_work_detail","id='".$id."'");
      $pageHeading = $this->Crud_model->GetData('service_work',"heading,id","","","","","");
      //print_r($insdustrydata->service_detail_id);exit;
      $titleData = $this->Crud_model->GetData('service_work',"heading,id","id ='".$servicedata->work_service_id."'","","","","1");   
      //print_r($titleData);exit;
      $data = array(
                'headinggg'=>'Add Services',
                'subheading'=>'Create service list',
                'button' => 'Update',
                'action' => site_url('Service_work_detail/update_action/'.$id),
                'heading' => $servicedata->heading,
                'description' => $servicedata->description,
                'image' => $servicedata->image,
                'serHeading' =>$pageHeading,
                'page_heading_id' => $titleData->id,
                'id' =>$id,
      );
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('Service_work_detail/form',$data);
         
    }
  public function update_action($id)
  {
      $id=$id;
      
       if( $_FILES['image']['name']!='' )
        {
            $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
            $config2['image_library'] = 'gd2';
            $config2['source_image'] =  $_FILES['image']['tmp_name'];
            $config2['new_image'] =   getcwd().'/uploads/service/'.$_POST['image'];
            $config2['upload_path'] =  getcwd().'/uploads/service/';
            $config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
            $config2['maintain_ratio'] = FALSE;

            $this->image_lib->initialize($config2);

            if(!$this->image_lib->resize())
            {
                echo('<pre>');
                echo ($this->image_lib->display_errors());
                exit;
            }
            unlink('uploads/service/'.$_POST['old_image']);
            $image  = $_POST['image'];
        }
        else
        {
            $image  =$_POST['old_image'];
        }

      $data=array(
          'heading'=>$_POST['heading'],
          'description'=>$_POST['description'],
          'image'=>$image,
          'our_services_id'=>$_POST['ser_heading'],
          'modified'=>date('Y-m-d H:i:s'),
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('service_work_detail',$data,"id='".$id."'");
      $this->session->set_flashdata('message', 'service work detail updated successfully');
      redirect("Service_work_detail");
    }
 

      public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("service_work_detail",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
      
        if(isset($_POST['id']))
        {
           $this->Common_model->delete('service_work_detail',"id='".$_POST['id']."'");
           
        }
    }
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $insdustrydata = $this->Crud_model->get_single("service_work_detail","id='".$id."'");
       // print_r($insdustrydata);exit;
        $headingdata = $this->Crud_model->GetData('service_work',"","id = '".$insdustrydata->work_service_id."'","","","","1");
       // print_r($headingdata);exit;
        $data =array(
          'heading'=>$insdustrydata->heading,
          'description'=>$insdustrydata->description, 
          'image'=>$insdustrydata->image,
          'page_heading'=>$headingdata->heading,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Service_work_detail/view',$data);
        $this->load->view('common/footer');
    }
  
}
?>