<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Slider_image extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
   $this->load->model('Slider_image_model');
       
    }

     public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Client Image',
        'createAction'=>site_url('Slider_image/create'),
        
    );

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('slider_image/list',$data);
    $this->load->view('common/footer'); 
  }

public function ajax_manage_page(){
        $getAllData = $this->Slider_image_model->get_datatables();
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            $btn = anchor(site_url('Slider_image/View/'.$row->id),'<button title="View" class="btn btn-info btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Slider_image/update/'.$row->id),'<button title="Edit" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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

            $image='<img src="'.base_url('uploads/Client_image/'.$row->image).'" width="50px" height="50px">';

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
           $nestedData[] = $image;
            $nestedData[] = $row->created_by;
          //  $nestedData[] = $row->heading;
            /*$nestedData[] = $description;*/
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Slider_image_model->count_all(),
                    "recordsFiltered" => $this->Slider_image_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }





public function create()
 {
    $header = array('page_title'=>'WPES'); 
 
    
    $data = array(
      'heading'=>'Add Client Image',
      'subheading'=>'Create Client Image',
     'button'=>'Create',
              'action'=>site_url('Slider_image/create_action'),
              'image' =>set_value('image'), 
              'id' =>set_value('id'),
            
    );
  
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('slider_image/form',$data);
       
  }

 public function create_action()
  {
    
     $count=count(array_filter($_FILES['image']['name']));

      for ($j=0; $j < $count; $j++) 
      { 
         if($_FILES['image']['name'][$j]!='')
        {  
             $src = $_FILES['image']['tmp_name'][$j];
              $filEnc = time();
              $avatar= rand(0000,9999)."_".$_FILES['image']['name'][$j];
              $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
              $dest =getcwd().'/uploads/Client_image/'.$avatar1;
            
            if(move_uploaded_file($src,$dest))
            {
                    $image  = $avatar1;                
            }
        }
        else
        {
            $image  =""; 
        }

        $data = array(
          'image' =>$image, 
        );

        $this->Crud_model->SaveData('slider_image',$data);
      }
  
    $this->session->set_flashdata('message', 'Image created successfully');
    redirect("Slider_image");
  }

public function View($id)
    {  
        $header = array('page_title'=>'WPES');
       $slider_image = $this->Crud_model->GetData('slider_image',"image,id","id='".$id."'","","","","");

        $data =array(
          'slider_image'=>$slider_image,
      
         
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('slider_image/view',$data);
        $this->load->view('common/footer'); 

    }

 public function update($id)
   {
      $header = array('page_title'=>'WPES');
      $image_data = $this->Crud_model->GetData('slider_image',"image,id","id='".$id."'","","","","");

      $data = array(
                'heading' => 'Update Images ',
                'subheading' => 'Update Images',
                'button' => 'Update',
                'action' => site_url('Slider_image/update_action/'.$id),
                
             
                'image_data' => $image_data,
              
             
                'id' =>$id,
               
               
            
      );
     
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('slider_image/form',$data);
         
    }
public function update_action($id)
    {
    	$count=count(array_filter($_FILES['image']['name']));

      for ($j=0; $j < $count; $j++) 
      { 
         if($_FILES['image']['name'][$j]!='')
        {  
             $src = $_FILES['image']['tmp_name'][$j];
              $filEnc = time();
              $avatar= rand(0000,9999)."_".$_FILES['image']['name'][$j];
              $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
              $dest =getcwd().'/uploads/Client_image/'.$avatar1;
            
            if(move_uploaded_file($src,$dest))
            {
                    $image  = $avatar1;                
            }
        }
        else
        {
            $image  =""; 
        }

        $data = array(
          'image' =>$image, 
        );

        $this->Crud_model->SaveData('slider_image',$data,"id='".$id."'");
      }
  
    $this->session->set_flashdata('message', 'Image created successfully');
    redirect("Slider_image");

    }

public function delete()
    {
      $data=$this->Crud_model->GetData('slider_image','image',"id='".$_POST['cid']."'","","","","1");
      if(!empty($data->image)){
         unlink('uploads/Client_image/'.$data->image);
      }
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('slider_image',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
    }


public function change_status()
{
    if(isset($_POST['statusupdate']))
    {
        $this->Crud_model->SaveData("slider_image",$_POST,"id='".$_POST['id']."'");exit;
    }
}

}