<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class CategoryMaster extends CI_Controller {

    function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('CategoryMaster_model');
       // $this->load->model('Currency_city_model');
         $this->load->library(array('session','form_validation','image_lib'));
    }

    public function index()
    {
        
        $header = array('page_title'=> 'Farmcartbiz.com');
        $data = array(
        'heading'=>'Category Master',
        'createAction'=>site_url('CategoryMaster/create'),
        'changeAction'=>site_url('CategoryMaster/changeStatus'),
        'deleteAction'=>site_url('CategoryMaster/delete'),
    );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('category/list',$data);
        $this->load->view('common/footer'); 
  }

  public function ajax_manage_page()
  {
      $con="categories.created_by='".$_SESSION['admin']['id']."'";
        $getCategory = $this->CategoryMaster_model->get_datatables($con);
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getCategory as $category) 
        {
            

            $btn = anchor(site_url('CategoryMaster/update/'.$category->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');

            $btn.= '&nbsp;|&nbsp;'.'<a href="#deleteData" data-toggle="modal" title="Delete" class="btn btn-danger btn-circle btn-xs" onclick="Delete('.$category->id.')"><i class="fa fa-trash-o"></i></a>';

             $status='';            
            if($category->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$category->id.'"  onClick="statuss('.$category->id.');" >'.$category->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$category->id.'"  onClick="statuss('.$category->id.');" >'.$category->status.'</span>';
            }


            if(file_exists('uploads/categories/'.$category->image))
            {
                 if(!empty($category->image))
              {
                  $images = '<img src="'.base_url('uploads/categories/'.$category->image).'" height="60px" width="70px">';
              }
              else
              {
                  $images ='<img src="'.base_url('uploads/banners/default_banner.jpg').'" height="60px" width="70px">';
              }

            }
            else
            {
                 $images ='<img src="'.base_url('uploads/banners/default_banner.jpg').'" height="60px" width="70px">';
            }

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $category->cat_name;
            $nestedData[] = $images;
            $nestedData[] = $status."<input type='hidden' id='status".$category->id."' value='".$category->status."' />";   
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->CategoryMaster_model->count_all($con),
                    "recordsFiltered" => $this->CategoryMaster_model->count_filtered($con),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }

        public function delete()
        {

           $get_data = $this->Crud_model->get_single('categories',"id='".$_POST['cid']."'"); 
            unlink('uploads/categories/'.$get_data->image);
            $this->Crud_model->DeleteData("categories","id='".$_POST['cid']."'");exit;
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("categories",$_POST,"id='".$_POST['id']."'");exit;
            }
        }

        public function create()
        {
            $header = array('page_title'=>'Farmcartbiz.com');  

            $data = array(
                            'heading'=>'Add Category',
                            'subheading'=>'Create Category',
                            'button'=>'Create',
                            'action'=>site_url('CategoryMaster/create_action'),
                            'cat_name' =>set_value('cat_name'),
                            'id' =>set_value('id'),
                            'image'=>set_value('image'),
          );
       // print_r($data);exit;
          $this->load->view('common/header',$header);
          $this->load->view('common/left_panel');
          $this->load->view('category/form',$data);
          $this->load->view('common/footer');
    }
        /*function for Create action department developed by Ashok */
    public function create_action()
    {

       $id = 0;
        $this->_rules($id);
        $con="id='".$id."'";

        $this->form_validation->set_rules('cat_name', 'Category Name', 'trim|required|is_unique[categories.cat_name]');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->create($id);
        } 
        else
            {
              $header = array('page_title'=>'Gauganaga.com');
          
              if($_FILES['image']['name']!='')
                {  
                     $src = $_FILES['image']['tmp_name'];
                      $filEnc = time();
                      $avatar= rand(0000,9999)."_".$_FILES['image']['name'];
                      $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                      $dest =getcwd().'/uploads/categories/'.$avatar1;
                    
                    if(move_uploaded_file($src,$dest))
                    {
                            $image  = $avatar1;                
                    }
                }
                else
                {
                    $image =""; 
                }


                $data = array
                (
                            'cat_name' =>$this->input->post('cat_name',TRUE),
                           'created_by' =>$_SESSION['admin']['id'],
                            'image' => $image,
                            'created'=> date('Y-m-d H:i:s'),
                                );

            $this->Crud_model->SaveData('categories',$data);

            $this->session->set_flashdata('message', 'Category created successfully');
            redirect(site_url('CategoryMaster'));      
    
    }

    }
   

     public function update($id)
    { 
        $header = array('page_title'=>'Gauganaga.com');

        $getEmployees = $this->Crud_model->get_single('categories',"id='".$id."'");

        $data = array('heading'=>'Update Category',
                    'subheading'=>'Update Category',
                    'button'=>'Update',
                    'action'=>site_url('CategoryMaster/update_action'),
                    'cat_name' => set_value('cat_name',$getEmployees->cat_name),
                    'image' => set_value('image',$getEmployees->image),
                    'id' => set_value('id',$id),
                );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('category/form',$data);
        $this->load->view('common/footer'); 
    }

/*function for update action developed by Ashok */
    public function update_action()
    {
       $id = $this->input->post('id');
        $id = $id;
        $this->_rules($id);
        $con="id='".$id."'";
        if ($this->form_validation->run() == FALSE) 
        {
            $this->update($id);
        } 
        else
            {        
     
                if($_FILES['image']['name']!='')
                {  
                     $src = $_FILES['image']['tmp_name'];
                      $filEnc = time();
                      $avatar= rand(0000,9999)."_".$_FILES['image']['name'];
                      $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                      $dest =getcwd().'/uploads/categories/'.$avatar1;
                    
                    if(move_uploaded_file($src,$dest))
                    {
                        unlink('uploads/categories/'.$_POST['old_image']);
                        $image  = $avatar1;                
                    }
                }
                else
                {
                    $image =$_POST['old_image']; 
                }

                $data = array(
                      'cat_name' =>$this->input->post('cat_name',TRUE),
                     'created_by' =>$_SESSION['admin']['id'],
                      'image' => $image,
                      'modified'=> date('Y-m-d H:i:s'),
                  );

               
              $con="id='".$id."'";

             $this->Crud_model->SaveData('categories',$data,$con);
            $this->session->set_flashdata('message', 'category updated successfully');
            redirect(site_url('CategoryMaster'));

          }
   
    }


          public function _rules($id) 
        {   

          $cond = "cat_name='".$this->input->post('cat_name',TRUE)."' and id!='".$id."'";

          $table = 'categories';
          $row = $this->Crud_model->get_single($table, $cond);
          //print_r($row);exit;
          $count = count($row);
          if($count==0) 
          {
              $is_unique = "";
          }
          else {
              $is_unique = "|is_unique[categories.cat_name]";

          }
                  $this->form_validation->set_rules('cat_name', 'Category', 'trim|required'.$is_unique,
                    array(
                            'required'=> 'Please enter %s.',
                            'is_unique'=>'This Category already exist'
                        ));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }







}?>