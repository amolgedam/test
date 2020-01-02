<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Contact_us extends CI_Controller {

    function __construct()
    {

    parent::__construct();    
    $this->load->database();
    $this->load->model('Contact_us_model');
       // $this->load->model('Currency_city_model');
    $this->load->library(array('session','form_validation','image_lib'));

    }
    public function index()
  {
        
    $header = array('page_title'=> 'View Contact Us');
        $data = array(
        'heading'=>'Affilation center',
        'createAction'=>site_url('Contact_us/create'),
        'changeAction'=>site_url('Contact_us/changeStatus'),
        'deleteAction'=>site_url('Contact_us/delete'),
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('contact_us/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page()
    {

        $cond="";
        $ContactUs = $this->Contact_us_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($ContactUs as $ConUs) 
        {
            
            $btn = anchor(site_url('Contact_us/View/'.$ConUs->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            /*$btn.='&nbsp;|&nbsp;'.anchor(site_url('Affilation_center/update/'.$ConUs->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');*/

            /*$btn.= '&nbsp;|&nbsp;'.anchor(site_url('Affilation_center/view/'.$ConUs->id),'<button title="view" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');*/

             $btn.= '&nbsp;|&nbsp;'.'<a href="#deleteData" data-toggle="modal" title="Delete" class="btn btn-danger btn-circle btn-xs" onclick="Delete('.$ConUs->id.')"><i class="fa fa-trash-o"></i></a>';
            
         
            $status='';            
            if($ConUs->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$ConUs->id.'"  onClick="statuss('.$ConUs->id.');" >'.$ConUs->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$ConUs->id.'"  onClick="statuss('.$ConUs->id.');" >'.$ConUs->status.'</span>';
            }

             
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $ConUs->first_name.' '.$ConUs->last_name;
            $nestedData[] = ucfirst($ConUs->mobile_no);
            $nestedData[] = $ConUs->email_id;
            $nestedData[] = $ConUs->country_name;
            $nestedData[] = $ConUs->state_name;
            $nestedData[] = $ConUs->city_name;
            $nestedData[] = $ConUs->pin_code;
            $nestedData[] = $status."<input type='hidden' id='status".$ConUs->id."' value='".$ConUs->status."' />";;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Contact_us_model->count_all(),
                    "recordsFiltered" => $this->Contact_us_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
  public function create()
  {

      $header = array('page_title'=>'JVV Colombo'); 

      $MasterCourse= $this->Crud_model->GetData('main_courses');
      $Country= $this->Crud_model->GetData('countries');

     // print_r($MasterCourse);exit;

      $data = array(
                'heading'=>'Add Affilation center',
                'subheading'=>'Create Affilation center',
                'button'=>'Create',
                'action'=>site_url('Affilation_center/create_action'),
                'affilation_center_name' =>set_value('affilation_center_name'),
                'center_head_name' =>set_value('center_head_name'),
                'website_email' =>set_value('website_email'),
                'email' =>set_value('email'),
                'mobile' =>set_value('mobile'),
                'address' =>set_value('address'),
                'syllabus'=>set_value('syllabus'),
                'country_id'=>set_value('country_id'),
                'state_id'=>set_value('state_id'),
                'city_id'=>set_value('city_id'),
                'course_id'=>set_value('course_id'),
                'image'=>set_value('image'),
                'description'=>set_value('description'),
                'id' =>set_value('id'),
                'MasterCourse' =>$MasterCourse,
                'Country' =>$Country,
          );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('affilation_center/form',$data);
        $this->load->view('common/footer');
    }

  

/*function for Create action department developed by Akash Z */
    public function create_action()
    {

     // print_r($_POST);exit;
      //$header = array('page_title'=>'Country');
      $id = 0;
      $this->_rules($id);
        $con="id='".$id."'";
        if ($this->form_validation->run() == FALSE) 
        {
            $this->create( $id );
        } 
        else
            {

                if($_FILES['image']['name']!='')
                {  
                     $src = $_FILES['image']['tmp_name'];
                      $filEnc = time();
                      $avatar= rand(0000,9999)."_".$_FILES['image']['name'];
                      $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                      $dest =getcwd().'/uploads/affilation_center/'.$avatar1;
                    
                    if(move_uploaded_file($src,$dest))
                    {
                            $image  = $avatar1;                
                    }
                }
                else
                {
                    $image =""; 
                }

            $data = array(

                      'affilation_center_name' => ucfirst($this->input->post('affilation_center_name',TRUE)),
                      'center_head_name' => ucfirst($this->input->post('center_head_name',TRUE)),
                      'website_email' => $this->input->post('website_email',TRUE),
                      'email' =>$this->input->post('email',TRUE),
                      'mobile' =>$this->input->post('mobile',TRUE),
                      'address' => ucfirst($this->input->post('address',TRUE)),
                      'country_id' =>$this->input->post('country_id',TRUE),
                      'state_id' =>$this->input->post('state_id',TRUE),
                      'city_id' =>$this->input->post('city_id',TRUE),
                      'description' =>ucfirst($this->input->post('description',TRUE)),
                      'image' => $image,
                      'created'=> date('Y-m-d H:i:s'),
                            );
         
            $this->Crud_model->SaveData('affilation_centers',$data);

            $last_id = $this->db->insert_id();


            $courses = count($_POST['course_id']);

            for ($i=0; $i < $courses ; $i++) 
            { 
                
                $data1 =array(
                        'affilation_centers_id'=>$last_id,
                        'main_course_id'=>$_POST['course_id'][$i],
                        'created'=> date('Y-m-d H:i:s'),
                );

                $this->Crud_model->SaveData('affilation_courses',$data1);
            }

            $this->session->set_flashdata('message', 'Affilation center created successfully');
            redirect(site_url('Affilation_center'));      
      
    }

    }
  /*function for update department developed by shubham */
    public function update($id)
    { 
          $header = array('page_title'=>'JVV Colombo');
          $MasterCourse= $this->Crud_model->GetData('main_courses');
          $Country= $this->Crud_model->GetData('countries');
          $affilationData= $this->Crud_model->get_single('affilation_centers',"id='".$id."'");
          $stateData= $this->Crud_model->get_single('states',"id='".$affilationData->state_id."'");
          $cityData= $this->Crud_model->get_single('cities',"id='".$affilationData->city_id."'");

          $courses= $this->Crud_model->GetData('affilation_courses','main_course_id',"affilation_centers_id='".$id."'");

       // print_r($courses);exit;//exit;
            //$imp = implode(",courses", $courses);
           //print_r($imp);exit;
        $data = array(
                    'heading'=>'Update Affilation center',
                    'subheading'=>'Update Affilation center',
                    'button'=>'Update',
                    'action'=>site_url('Affilation_center/update_action'),
                    'sort_by'=>set_value('sort_by'),
                    'affilation_center_name' =>$affilationData->affilation_center_name,
                    'center_head_name' =>$affilationData->center_head_name,
                    'website_email' =>$affilationData->website_email,
                    'email' =>$affilationData->email,
                    'mobile' =>$affilationData->mobile,
                    'address' =>$affilationData->address,
                    'country_id'=>$affilationData->country_id,
                    'stateData'=>$stateData,
                    'cityData'=>$cityData,
                    'image'=>$affilationData->image,
                    'description'=>$affilationData->description,
                    'MasterCourse' =>$MasterCourse,
                    'Country' =>$Country,
                    'courses' =>$courses,
                    'id' => $id,
                );

       // print_r($data);exit; 

        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('affilation_center/form',$data);
        $this->load->view('common/footer'); 
    }

/*function for update action developed by shubham */
    public function update_action()
    {

     // print_r($_POST);exit;

        $id = $this->input->post('id');
        $this->_rules($id);
        $con="id='".$id."'";
        if ($this->form_validation->run() == FALSE)
         {
            $this->update($this->input->post('id', TRUE));
          } 
          else
              {

               if($_FILES['image']['name']!='')
                {  
                     $src = $_FILES['image']['tmp_name'];
                      $filEnc = time();
                      $avatar= rand(0000,9999)."_".$_FILES['image']['name'];
                      $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                      $dest =getcwd().'/uploads/affilation_center/'.$avatar1;
                    
                    if(move_uploaded_file($src,$dest))
                    {
                            $image  = $avatar1; 
                          unlink('uploads/affilation_center/'.$_POST['old_image']);             
                    }
                }
                else
                {
                    $image =$_POST['old_image']; 
                }


               
              $data = array(               
                      'affilation_center_name' => ucfirst($this->input->post('affilation_center_name',TRUE)),
                      'center_head_name' => ucfirst($this->input->post('center_head_name',TRUE)),
                      'website_email' => $this->input->post('website_email',TRUE),
                      'email' =>$this->input->post('email',TRUE),
                      'mobile' =>$this->input->post('mobile',TRUE),
                      'address' => ucfirst($this->input->post('address',TRUE)),
                      'country_id' =>$this->input->post('country_id',TRUE),
                      'state_id' =>$this->input->post('state_id',TRUE),
                      'city_id' =>$this->input->post('city_id',TRUE),
                      'description' =>ucfirst($this->input->post('description',TRUE)),
                      'image' => $image,
                      'modified'=> date('Y-m-d H:i:s'),
                            );


              $this->Crud_model->SaveData('affilation_centers',$data,$con);

              $this->Crud_model->DeleteData("affilation_courses","id='".$id."'");

                  $courses = count($_POST['course_id']);

                for ($i=0; $i < $courses ; $i++) 
                { 
                    
                    $data1 =array(
                            'affilation_centers_id'=>$id,
                            'main_course_id'=>$_POST['course_id'][$i],
                            'created'=> date('Y-m-d H:i:s'),
                    );

                    $this->Crud_model->SaveData('affilation_courses',$data1);
                }

             // print_r($data);exit;
            
           
            $this->session->set_flashdata('message', 'Affilation updated successfully');
            redirect(site_url('Affilation_center'));
}      
}

    public function View($id)
    {  
        //print_r($id);exit;
        $header = array('page_title'=>'JVV Colombo');
        $cond="contact_us.id='".$id."'";

        $ContactUs = $this->Contact_us_model->get_contact_view($cond);

       // print_r($ContactUs);exit;

        $data =array(
          'first_name'=>$ContactUs->first_name,
          'last_name'=>$ContactUs->last_name,
         // 'email'=>$city_name->email,
          'mobile_no'=>$ContactUs->mobile_no,
          'email_id'=>$ContactUs->email_id,
          'pin_code'=>$ContactUs->pin_code,
          'message'=>$ContactUs->message,
          'country_name'=>$ContactUs->country_name,
          'state_name'=>$ContactUs->state_name,
          'city_name'=>$ContactUs->city_name,
        );

         $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('contact_us/view',$data);
        $this->load->view('common/footer'); 

    }

    public function get_states()
    {  

        $id = $this->input->post('id');
        $stateData = $this->Crud_model->GetData('states',"*","status='Active' and country_id = '".$id."'");

        $html = "<option value=''>Select State</option>";
        foreach ($stateData as $row_data) 
        {
            $html .= "<br><option value='".$row_data->id."'>".ucfirst($row_data->state_name)."</option>";
        }
        echo $html;
    }

     public function get_city()
    {  

        $id = $this->input->post('id');
        $cityData = $this->Crud_model->GetData('cities',"*","status='Active' and   state_id = '".$id."'");

        $html = "<option value=''>Select city</option>";
        foreach ($cityData as $row_data) 
        {
            $html .= "<br><option value='".$row_data->id."'>".ucfirst($row_data->city_name)."</option>";
        }
        echo $html;
    }




    public function delete()
    {
        if(isset($_POST['cid']))
        {

           $this->Crud_model->DeleteData("contact_us","id='".$_POST['cid']."'");

             
           exit;

        }
    }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("contact_us",$_POST,"id='".$_POST['id']."'");exit;
            }
        }

/*function for check the validation and duplication during create and update department developed by shubham*/
      public function _rules($id) 
        {   

        $cond = "affilation_center_name='".$this->input->post('affilation_center_name',TRUE)."' and id!='".$id."'";
        $table = 'affilation_centers';
        $row = $this->Crud_model->get_single($table, $cond);
        //print_r($row);exit;
        $count = count($row);
        if($count==0)
        {
            $is_unique = "";
        }
        else 
        {
            $is_unique = "|is_unique[affilation_centers.affilation_center_name]";

        }
        $this->form_validation->set_rules('affilation_center_name', 'Affilation center name', 'trim|required'.$is_unique,
        array(
                'required'=> 'Please enter %s',
                'is_unique'=>' %s already exist'
            ));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }
      public function delete_city()
        {
            if(isset($_POST['cid']))
            {
                $_POST['is_delete']='Yes';
                //$_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("currency_city_mapping",$_POST,"id='".$_POST['cid']."'");exit;
                  $this->session->set_flashdata('message', 'Record deleted successfully');
            }
        }
       
          public function change_status_city()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("currency_city_mapping",$_POST,"id='".$_POST['id']."'");exit;
                  $this->session->set_flashdata('message', 'Status changed successfully');
            }
        }

}



?>