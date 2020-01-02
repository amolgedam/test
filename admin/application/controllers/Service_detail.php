<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Service_detail extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Service_detail_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
      { 
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Manage Service_detail',
            'createAction'=>site_url('Service_detail/create'),
            'changeAction'=>site_url('Service_detail/changeStatus'),
            'deleteAction'=>site_url('Service_detail/delete'),
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('service_detail/list',$data);
        $this->load->view('common/footer'); 
      }
    public function ajax_manage_page(){
        $Service_detail = $this->Service_detail_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Service_detail as $ser) 
        {
            
            $btn = anchor(site_url('Service_detail/View/'.$ser->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Service_detail/update/'.$ser->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$ser->id.')"><i class="fa fa-trash-o"></i></span>';
           
             $status='';            
            if($ser->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$ser->id.'"  onClick="statuss('.$ser->id.');" >'.$ser->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$ser->id.'"  onClick="statuss('.$ser->id.');" >'.$ser->status.'</span>';
            }
          
          /*if(!empty($ser->image))
            {
                $image = '<img src="'.base_url("uploads/service/".$ser->image).'" width=100px" height="100px"> ';
            }
           else
            {
                $image = "<img src='".base_url('uploads/No_Image_Available.jpg')."' width='100px' height='100px'> "; 
            }*/

            if(strlen($ser->description) > 100)
            {
                $description=substr($ser->description, 0,80).'...';
            }
            else{
                $description=$ser->description;
            }
            
             if(strlen($ser->heading) > 50)
            {
                $heading=substr($ser->heading, 0,50).'...';
            }
            else{
                $heading=$ser->heading;
            }
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $heading;
            $nestedData[] = $description;
            $nestedData[] = $status."<input type='hidden' id='status".$ser->id."' value='".$ser->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Service_detail_model->count_all(),
                    "recordsFiltered" => $this->Service_detail_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
        public function create()
        {
          $header = array('page_title'=>'WPES');
            $data = array(
                            'heading'=>'Add Service_detail',
                            'subheading'=>'Create new Service_detail',
                            'button'=>'Create',
                            'action'=>site_url('Service_detail/create_action'),
                            'service_type' =>set_value('service_type'),
                            'service_id' =>set_value('service_id'),
                            'heading' =>set_value('heading'),
                            'description' =>set_value('description'),
                            'image' =>set_value('image'),
                            'id' =>set_value('id'), 
                      
                        );
       
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('service_detail/form',$data);
    }

     public function create_action()
     {
        $id='0';
      $this->_rules($id);
        // $con="id='".$id."'";
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } 
        else
        {
            $data = array(
                        'service_type' => $this->input->post('type'),
                        'service_id' => $this->input->post('title'),
                        'heading' => ucfirst($this->input->post('heading',TRUE)),
                        'description' => ucfirst($this->input->post('description',TRUE)), 
                        'created'=> date('Y-m-d H:i:s'),
            );
            $this->Crud_model->SaveData('service_detail',$data,$con);

            $last_id=$this->db->insert_id();

        $count=count(array_filter($_FILES['image']['name'])); //multipath uppload images code

      for ($j=0; $j < $count; $j++) 
      { 
         if($_FILES['image']['name'][$j]!='')
        {  
             $src = $_FILES['image']['tmp_name'][$j];
              $filEnc = time();
              $avatar= rand(0000,9999)."_".$_FILES['image']['name'][$j];
              $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
              $dest =getcwd().'/uploads/service/'.$avatar1;
            
            if(move_uploaded_file($src,$dest))
            {
                    $image  = $avatar1;                
            }
        }
        else
        {
            $image  =""; 
        }

        $log = array(
          'service_detail_id' =>$last_id, 
          'image' =>$image, 
        );

        $this->Crud_model->SaveData('service_images',$log);
      } 
            $this->session->set_flashdata('message', 'Services created successfully');
            redirect(site_url('Service_detail'));      
      
    }

    }
 

    public function _rules($id) 
    {   
        $table ='service_detail';
        $cond2 = "heading='".$this->input->post('heading')."' and id!='".$id."'";
        $row2 = $this->Crud_model->get_single($table, $cond2);
        //print_r($row);exit;
        
        if(empty($row2))
        {
            $is_unique2 = "";
        }
        else {
            $is_unique2 = "|is_unique[service_detail.heading]";

        }
        $this->form_validation->set_rules('heading', 'heading id', 'trim'.$is_unique2,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
       
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }
    public function update($id)
    { 
        
        $getservice = $this->Crud_model->get_single('service_detail',"id='".$id."'");
        $gettitle = $this->Crud_model->GetData('services', "id,title","id='".$getservice->service_id."'","","","","1");
        $image = $this->Crud_model->GetData("service_images","id,image,service_detail_id","service_detail_id='".$getservice->id."'","","","","");

        $data = array('heading'=>'Update Service_detail',
                    'subheading'=>'Update Service_detail',
                    'button'=>'Update',
                    'action'=>site_url('Service_detail/update_action'),
                    'service_type' => $getservice->service_type,
                    'service_id' => $getservice->service_id,
                    'heading' => set_value('heading',$getservice->heading),
                    'description' => set_value('description',$getservice->description),
                    'image' => $image,
                    'id' => set_value('id',$id),
                    'gettitle' =>$gettitle->title,
                    'getid' =>$gettitle->id,
                    

                );
        $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('service_detail/form',$data);
       
    }

    public function update_action()
    {

       $id=$_POST['id'];
        $this->_rules($id);
    if ($this->form_validation->run() == FALSE)
    {          
      $this->update($id);
    }
    else 
    {  
          $data = array(
                    'service_type' => $this->input->post('type',TRUE),
                    'service_id' => $this->input->post('title',TRUE),
                    'heading' => $this->input->post('heading',TRUE),
                    'description' => $this->input->post('description',TRUE),
                    'modified'=> date('Y-m-d H:i:s'),
                    );

            $this->Crud_model->SaveData('service_detail',$data,"id='".$id."'");

            $last_id = $id;

            $counts = count(array_filter($_FILES['image']['name'])); //multipath uppload images code

            if(!empty($counts))
            {

              for ($j=0; $j < $counts; $j++) 
              { 
                 if($_FILES['image']['name'][$j]!='')
                {  
                     $src = $_FILES['image']['tmp_name'][$j];
                      $filEnc = time();
                      $avatar= rand(0000,9999)."_".$_FILES['image']['name'][$j];
                      $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                      $dest =getcwd().'/uploads/service/'.$avatar1;
                    
                    if(move_uploaded_file($src,$dest))
                    {
                            $image  = $avatar1;                
                    }
                }
                else
                {
                    $image  =""; 
                }

                $log = array(
                  'service_detail_id' =>$last_id, 
                  'image' =>$image, 
                );

                $this->Crud_model->SaveData('service_images',$log);
              }
            }
          
            $this->session->set_flashdata('message', 'Service_detail updated successfully');
            redirect(site_url('Service_detail'));
        
    } 
}

    public function View($id)
    {  
       $header = array('page_title'=>'WPES');
        
        
        $row = $this->Crud_model->get_single("service_detail","id='".$id."'");
        $service = $this->Crud_model->get_single("services","id='".$row->service_id."'");
        $row1 = $this->Crud_model->GetData("service_images","id,image,service_detail_id","service_detail_id='".$row->id."'","","","","");

        $data =array(
            'service_type' => $row->service_type,
            'title' => $service->title,
            'heading'=>$row->heading,
            'description'=>$row->description,
            'row1'=>$row1,
        );
        
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('service_detail/view',$data);
        $this->load->view('common/footer'); 

    }

    public function delete()
        {
           $serviceData = $this->Crud_model->GetData('service_images',"image,id","service_detail_id='".$_POST['id']."'");
           foreach ($serviceData as $key)
            {
                unlink('uploads/service/'.$key->image);
                $this->Crud_model->DeleteData("service_images","id='".$key->id."'");
           }
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("service_detail","id='".$_POST['id']."'");exit();
            }
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("Service_detail",$_POST,"id='".$_POST['id']."'");exit;
            }
        }

     public function get_service()
    {  
        $type = $this->input->post('type');

        $serviceData = $this->Crud_model->GetData('services',"*","status='Active' and type='".$type."'");
        $html = "<option value='0'>Select Title</option>";
        foreach ($serviceData as $row_data) 
        {
            $html .= "<br><option value='".$row_data->id."'>".ucfirst($row_data->title)."</option>";
        }
        echo $html;
    }
     public function img_delete()
    {
        if(isset($_POST['cid']))
        {
            $this->Common_model->delete('service_images',"id='".$_POST['cid']."'");
            
        }
    }
}
?>