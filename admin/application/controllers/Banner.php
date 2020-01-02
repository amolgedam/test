<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Banner extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
        $this->load->model('Banner_model');
       // $this->load->model('Currency_city_model');
         $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
  {
    //print_r("expression");exit;
        
    $header = array('page_title'=> 'Manage Banner');
        $data = array(
        'heading'=>'Manage Banner',
        'createAction'=>site_url('Banner/create'),
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('banners/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page()
    {
        $GetData = $this->Banner_model->get_datatables();

        //print_r($GetData);exit;
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($GetData as $row) 
        {
            

            $btn = anchor(site_url('Banner/update/'.$row->id),'<button title="Edit" class="btn btn-warning btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
             $btn .='&nbsp|&nbsp'.anchor(site_url('Banner/view/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .= '&nbsp|&nbsp'.anchor(site_url('Banner/delete/'.$row->id),'<button title="Delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button>');
           


         
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
            
            if(!file_exists("uploads/banners/".$row->image))
              {  //print_r("hii");
                $img ='<img height="100px" width="100px" class="img-thumbnail img-responsive" src="'.base_url('uploads/no_image.png').'">';
              }
            else
              { 
                 //print_r("bbii");
               $img ='<a href="'.base_url('uploads/banners/'.$row->image).'" data-lightbox="roadtrip"><img height="100px" width="100px" class="img-thumbnail img-responsive"src="'.base_url('uploads/banners/'.$row->image).'" style="height:100px;width:100px"><a>';
              }
          }

          else
          { //print_r("ccii");
            $img ='<img height="100px" width="100px" class="img-thumbnail img-responsive" src="'.base_url('uploads/no_image.png').'">';
          }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
           
            $nestedData[] = $img;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Banner_model->count_all(),
                    "recordsFiltered" => $this->Banner_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
  public function create()
  {

      $header = array('page_title'=>'Manage Banner');  
      $data = array('heading'=>'Add ',
                'subheading'=>'Create Banner',
                'button'=>'Create',
                'action'=>site_url('Banner/create_action'),
                


                'image'=>set_value('image'),
                'id' =>set_value('id'),
          );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
         $this->load->view('banners/form',$data);
    }

  

/*function for Create action department developed by Akash Z */
    public function create_action()
    {

              if( $_FILES['image']['name']!='' )
              {
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/banners/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/banners/';
                  $config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
                  $config2['maintain_ratio'] = FALSE;

                  $this->image_lib->initialize($config2);
                
                  if(!$this->image_lib->resize())
                  {
                      echo('<pre>');
                      echo ($this->image_lib->display_errors());
                      exit;
                  }
                
                  $image  = $_POST['image'];
                 }else
                 {
                   $image  = "";
                 }
            $data = array(
                        
                   'image'=>$image,
                        'created'=> date('Y-m-d H:i:s'),
                            );
           
            $this->Crud_model->SaveData('banners',$data);
     
            $this->session->set_flashdata('message', 'Banners created successfully');
            redirect(site_url('Banner'));      

    }

    public function update($id)
    { 
     
    
        $getEmployees = $this->Crud_model->get_single('banners',"id='".$id."'",'','','','1');
/*        print_r($getEmployees);exit;
*/        $data = array('heading'=>'Update Banners',
                    'subheading'=>'Update Banners',
                    'button'=>'Update',
                    'action'=>site_url('Banner/update_action'),
                   
                    'image' => $getEmployees->image,
                     'id' => $id,                   
                );
       /*print_r($data);exit;*/  
        $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('banners/form',$data);
        $this->load->view('common/footer'); 
    }

    public function update_action(){

       
        $id = $this->input->post('id');

                
                 if($_FILES['image']['name']!='' )
                {
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/banners/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/banners/';
                  $config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
                  $config2['maintain_ratio'] = FALSE;

                  $this->image_lib->initialize($config2);
                
                  if(!$this->image_lib->resize())
                  {
                      echo('<pre>');
                      echo ($this->image_lib->display_errors());
                      exit;
                  }
                
                  
                  else{
                       $image  = $_POST['image'];
                      @unlink('uploads/banners/'.$_POST['old_image']);

                  }                  
    }
                 else
                 {
                   $image  = $_POST['old_image'];
                 } 
            $data = array(
                        

                        'image' => $image,
                        'modified'=> date('Y-m-d H:i:s'),
                            );
            
            $con="id='".$id."'";
            $this->Crud_model->SaveData('banners',$data,$con);
            $this->session->set_flashdata('message', 'Banners updated successfully');
            redirect(site_url('Banner'));
     
    }



         public function delete($id)
        {
         // print_r($id);exit;
           $this->Crud_model->DeleteData('banners',"id='".$id."'");
          redirect('Banner');
        
        }



public function view($id)

{

 $getEmployees = $this->Crud_model->get_single('banners',"id='".$id."'",'','','','1');
     //  print_r($getEmployees);exit;
        $data = array('heading'=>'View Banners',
                    'subheading'=>'View Banners',
                    'button'=>'View',
                  'action'=>site_url('Banner/update_action'),
                   

                    'image' => $getEmployees->image,
                     'id' => $id,                   
                );
       /*print_r($data);exit;*/  
        $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('banners/view',$data);
        $this->load->view('common/footer'); 
    }







      /*  public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("banners",$_POST,"id='".$_POST['id']."'");exit;
            }
        }


*/
}



?>