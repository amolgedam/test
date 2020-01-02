<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Users extends CI_Controller {

    function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Users_model');
       // $this->load->model('Currency_city_model');
         $this->load->library(array('session','form_validation','image_lib'));
    }

    public function getUserData()
    {
      $empid = $this->input->post('emp');
      // $empid2 = $this->input->post('emp2');
      // $empid = 4;

      if($empid == 0)
      {
        $data = $this->Crud_model->GetData('users','','','','','','');
      }
      else
      {
         $data = $this->Crud_model->GetData('users','',"executive_id ='".$empid."' && empnew_id = '0' ",'','','','');
      }
// echo "<pre>"; print_r($data);
      echo json_encode($data);
    }

    public function index()
    {
        
        $header = array('page_title'=> 'Farmcartbiz.com');
        $data = array(
        'heading'=>'Manage Customers',
        'createAction'=>site_url('Users/create'),
        'changeAction'=>site_url('Users/changeStatus'),
        'deleteAction'=>site_url('Users/delete'),
    );
    //print_r($data);exit;

        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('users/list',$data);
  }

  public function ajax_manage_page()
  {
    $con="us.created_by='".$_SESSION['admin']['id']."' and us.is_delete='No'";
        $manageUser = $this->Users_model->get_datatables($con);
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
         if(empty($_POST['SearchData1']))
        {
            $client_ids = array();
        }else{
            $client_ids = explode(',', $_POST['SearchData1']);     
        }
          $data = array();        
          foreach ($manageUser as $user) 
          {
            

            $btn = anchor(site_url('Users/View/'.$user->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');  

             if($_SESSION['admin']['admin_type']=='admin_1')
            { 

            $btn .=  '&nbsp;|&nbsp;'.anchor(site_url('Users/update/'.$user->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');     

            $btn .= '&nbsp;|&nbsp;'.'<a href="#deleteData" data-toggle="modal" title="Delete" class="btn btn-danger btn-circle btn-xs" onclick="Delete('.$user->id.')"><i class="fa fa-trash-o"></i></a>';
            }
          
             $status=''; 

            if($_SESSION['admin']['admin_type']=='admin_1')
            { 

              if($user->status=='Active')
              {
                  $status='<span class="btn btn-xs btn-success" id="statusVal'.$user->id.'"  onClick="statuss('.$user->id.');" >'.$user->status.'</span>';
              }
              else
              {
                  $status='<span class="btn btn-xs btn-danger" id="statusVal'.$user->id.'"  onClick="statuss('.$user->id.');" >'.$user->status.'</span>';
              }
            }
            else
            {
               if($user->status=='Active')
              {
                  $status='<span class="btn btn-xs btn-success" id="statusVal'.$user->id.'">'.$user->status.'</span>';
              }
              else
              {
                  $status='<span class="btn btn-xs btn-danger" id="statusVal'.$user->id.'">'.$user->status.'</span>';
              }


            }



            if(file_exists('uploads/users/'.$user->image))
            {
                if(!empty($user->image))
                {
                    $images = '<img src="'.base_url('uploads/users/'.$user->image).'" height="60px" width="70px">';
                }
                else
                {
                    $images ='<img src="'.base_url('uploads/users/images.jpg').'" height="60px" width="70px">';
                }

             }
             else
             {
                  $images ='<img src="'.base_url('uploads/users/images.jpg').'" height="60px" width="70px">';
             }

             if(!empty($user->name)){ $name = $user->name; }else{  $name = "N/A"; }
             if(!empty($user->ename)){ $ename = $user->ename; }else{  $ename = "N/A"; }
             if(!empty($user->email)){ $email = $user->email; }else{  $email = "N/A"; }
             if(!empty($user->mobile)){ $mobile = $user->mobile; }else{  $mobile = "N/A"; }
             if(!empty($user->address)){ $address = $user->address; }else{  $address = "N/A"; }

             if($user->login_type=='Customer')
             {
                $login_type ='<span data-placement="right" title="Edit"  class="btn btn-success btn-circle btn-xs"  onclick="show_modalss('.$user->id.')" data-toggle="modal">'.$user->login_type.'</span>'; 
             }
             else
             {
                 $login_type ='<span data-placement="right" title="Edit"  class="btn btn-primary btn-circle btn-xs"  onclick="show_modalss('.$user->id.')" data-toggle="modal">'.$user->login_type.'</span>'; 
             }

             if(!empty($user->business_type))
             {
                $business_type ='<span class="btn btn-warning btn-xs">'.$user->business_type.'</span>';
             }
             else
             {
                $business_type ="N/A";
             }

             if($_POST['select_all']=="true")
            {
                $chked = "checked";
            }else if(in_array($user->id, $client_ids)){
                $chked = "checked";
            }else{

                $chked = "";
            }

             

             $chk = '<input type="checkbox" name="client_id" id="client_id_'.$user->id.'" '.$chked.' onchange="checkbox_all('.$user->id.');" class="client_id client_id_'.$user->id.'" value="'.$user->id.'">';
           


            $no++;
            $nestedData = array();
            $nestedData[] = $no;
                if($_SESSION['admin']['admin_type']=='admin_1')
            { 
              $nestedData[] = $chk;
            }
            $nestedData[] = $images;
            $nestedData[] = ucwords($ename);
            $nestedData[] = ucwords($name);
            $nestedData[] = $email;
            $nestedData[] = $mobile;
            // $nestedData[] = $business_type;
            // $nestedData[] = $login_type;
            $nestedData[] = $status."<input type='hidden' id='status".$user->id."' value='".$user->status."' />";   
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

         $filter = $this->Users_model->count_client_filtered($con);

            $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Users_model->count_all($con),
                    "recordsFiltered" => $this->Users_model->count_filtered($con),
                    "data" => $data,
                    "ids" => $filter->ids,
                );
        
            echo json_encode($output);
    }

        public function delete()
        {
           
            $data =array( 
              'is_delete'=>'Yes',
            );

            $this->Crud_model->SaveData("users",$data,"id='".$_POST['cid']."'");exit;          
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("users",$_POST,"id='".$_POST['id']."'");exit;
            }
        }

        public function sendMailSms()
        {
 
            $customer_id = $this->input->post('customer_id');
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $val = $this->input->post('val');

            $explode_ids=explode(",", $customer_id);

            if($val=='Msg')
            {
               foreach ($explode_ids as $id) 
              {
                 $data1 = array(
                        'customer_id'=>$id,
                        'subject'=>$subject,
                        'description'=>$description,
                        'type'=>'Msg',
                        'created'=>date('Y-m-d'),
                );

                $this->Crud_model->SaveData('mail_logs',$data1);
                
                $this->session->set_flashdata('message', 'Mesage / Mail send successfully');
                redirect('Users/index');



              }
            }
            else
            {
              foreach ($explode_ids as $id) 
              {

                $get_customer = $this->Crud_model->GetData('users','',"id='".$id."'",'','','','1');

                $subject=$title;
                $from = "malewar.ashok@gmail.com";
                $body = $description;
                $attachment="";
                $to=$get_customer->email;

                $data = array(
                        'customer_id'=>$id,
                        'subject'=>$subject,
                        'description'=>$description,
                        'type'=>'Mail',
                        'created'=>date('Y-m-d'),
                );
                
               // print_r($data);exit;

                $this->Crud_model->SaveData('mail_logs',$data);
                
                


                $this->CI =& get_instance();
                 $CI =& get_instance();
                //  $res= $this->custom->sendEmailSmtp($subject,$body,$to,$from);
                $CI->load->library('email');
                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;
                $config['charset']    = 'utf-8';
                $config['newline']    = "\r\n";
               $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE; // bool whether to validate email or not  
                $this->email->initialize($config);
                $CI->email->from($from, 'Farncartbiz');
                $CI->email->to($to);
                $CI->email->subject($subject);
                $CI->email->message($body);
                if (!empty($attachment)) 
                {
              $CI->email->attach($attachment);
            }
              /*if (!empty($attachment1))
              {
                $CI->email->attach($attachment1);
              }
              $CI->email->send();
              if(!empty($RemoveAttachment))
              {
                unlink($RemoveAttachment);
              }*/
            
              $CI->email->send();

            }

            $this->session->set_flashdata('message', 'Form submitted successfully');
             
            redirect('Users/index');

      }

         
        }



        public function create()
        {
            
            
            $header = array('page_title'=>'Gauganga.com');

            $getexecutive =   $this->Crud_model->GetData('employees','',"is_delete='No' and status='Active' and created_by='".$_SESSION['admin']['id']."'");
            $category = $this->Crud_model->GetData('categories','',"status='Active' and created_by='".$_SESSION['admin']['id']."'");
            $subcategory = $this->Crud_model->GetData('subcategories','',"status='Active' and created_by='".$_SESSION['admin']['id']."'");

            // echo "<pre>"; print_r($category); exit();
            $data = array(
                            'heading'=>'Add Customer',
                            'subheading'=>'Create Customer',
                            'button'=>'Create',
                            'action'=>site_url('Users/create_action'),
                            'name' =>set_value('name'),
                            'email' =>set_value('email'),
                            'mobile' =>set_value('mobile'),
                            'image' =>set_value('image'),
                            'shop_image' =>set_value('shop_image'),
                            'business_type' =>set_value('business_type'),
                            'id' =>set_value('id'),
                            'location'=>set_value('location'),
                            'latitude'=>set_value('latitude'),
                            'longitude'=>set_value('longitude'),
                            'password'=>set_value('password'),
                            'login_type'=>set_value('login_type'),
                            'executive_id'=>set_value('executive_id'),
                            'getexecutive'=>$getexecutive,
                            'category'=>$category,
                            'subcategory'=>$subcategory,
                            'pcat' => '',
                            'pid' => '',
                            'pliter' => '',
                            'total_amt'=>set_value('total_amt'),

          );
       // print_r($data);exit;
          $this->load->view('common/header',$header);
          $this->load->view('common/left_panel');
          $this->load->view('users/form',$data);
          $this->load->view('common/footer');
    }

    function check_default($post_string)
    {
      return $post_string == '0' ? FALSE : TRUE;
    }

        /*function for Create action department developed by */
    public function create_action()
    {

      //  print_r($_SESSION['admin']['id']);exit;

         $id = 0;
        $this->_rules($id);
        $con="id='".$id."'";

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|is_unique[users.mobile]');
        // $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        // $this->form_validation->set_rules('image', 'Image', 'trim|required');
        $this->form_validation->set_rules('executive_id', 'Employee', 'trim|required|callback_check_default');
        $this->form_validation->set_message('check_default', 'Select Employee Name');

        if ($this->form_validation->run() == FALSE) 
        {
        


            $this->create($id);
        } 
        else
          { 
        

              if( $_FILES['image']['name']!='' )
              {
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/users/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/users/';
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
                 }
                 else
                 {
                   $image  = "";
                 }

                 /*if($_POST['pliter']=='1')
                 {
                    $liter = "1";
                 }
                 else
                 {
                    $liter = "0.5";
                 }*/

                
                $data = array(
                            'name' =>$this->input->post('name',TRUE),
                            'created_by' =>$_SESSION['admin']['id'],
                            'email' =>$this->input->post('email',TRUE),
                            'mobile' =>$this->input->post('mobile',TRUE),
                            'address' =>$this->input->post('location',TRUE),
                            'latitude' =>$this->input->post('lat',TRUE),
                            'longitude' =>$this->input->post('lon',TRUE),
                            'password' =>$this->input->post('password',TRUE),
                            'executive_id' =>$this->input->post('executive_id',TRUE),
                            'image' => $image,
                            'pcat' =>$this->input->post('pcate',TRUE),
                            'pid' =>$this->input->post('psubcate',TRUE),
                            'pliter' =>$this->input->post('pliter',TRUE),
                            //'liter' =>$liter,
                           'pamt' =>$this->input->post('pamt',TRUE),
                            'total_amt' =>$this->input->post('total_amt',TRUE),
                            'created'=> date('Y-m-d H:i:s'),

                          );

            //print_r($data);exit;
            $this->Crud_model->SaveData('users',$data);

            $this->session->set_flashdata('message', 'Customer created successfully');
            redirect(site_url('Users'));      
    
    

    }

  }
    function getAddress()
{
    $latitude=$_POST['lat'];
    $longitude=$_POST['lon'];
    if(!empty($latitude) && !empty($longitude))
    { 
         $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&key=AIzaSyCMtDBsl6HlxFbLb4vlt1qWfPAAnfpF0hw&libraries=places&callback=initialize'); 

        $output = json_decode($geocodeFromLatLong);
        $status = $output->status;
        //Get address from json data
        $address = ($status=="OK")?$output->results[1]->formatted_address:'';
        
        if(!empty($address))
        {
            $dataKey['address']=$address;
        }    
        else
        {
            $dataKey['address']='';
        }    
       
    }
    else
    {
         $dataKey['address']='';
    }  
    echo json_encode($dataKey);exit;
}

    public function save_logintype()
    { 

      $type =$_POST['login_type'];
      $id =$_POST['id_enroll'];

      $data=array(
            'login_type'=>$type,
      );

        $con="id='".$id."'";

      $this->Crud_model->SaveData('users',$data,$con);
        redirect(site_url('Users'));
    }


    public function save_enrollment()
    { 

      
      $id =$_POST['login_type'];

      $data=array(
            'login_type'=>$_POST['login_type'],
      );

        $con="id='".$id."'";

      $this->Crud_model->SaveData('users',$data,$con);

       $getEmployees = $this->Crud_model->get_single('users',"id='".$id."'");


        $subject="Enrollment No";
        $from = "jvvcolombo@gmail.com";
         $body = "Hello".$getEmployees->first_name." Your Enrollment No is ".$_POST['entrollment_id'];
        $attachment="";
        $to=$getEmployees->email_id;


            $this->CI =& get_instance();
             $CI =& get_instance();
            //  $res= $this->custom->sendEmailSmtp($subject,$body,$to,$from);
            $CI->load->library('email');
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
           $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not  
            $this->email->initialize($config);
            $CI->email->from($from, 'JVV Colombo');
            $CI->email->to($to);
            $CI->email->subject($subject);
            $CI->email->message($body);
            if (!empty($attachment)) 
            {
          $CI->email->attach($attachment);
        }
            
          $CI->email->send();
          
          $to_jvv="jvvcolombo@gmail.com";
          
            $this->CI =& get_instance();
             $CI =& get_instance();
            //  $res= $this->custom->sendEmailSmtp($subject,$body,$to,$from);
            $CI->load->library('email');
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
           $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not  
            $this->email->initialize($config);
            $CI->email->from($from, 'JVV Colombo');
            $CI->email->to($to_jvv);
            $CI->email->subject($subject);
            $CI->email->message($body);
            if (!empty($attachment)) 
            {
          $CI->email->attach($attachment);
        }
        /*if (!empty($attachment1))
        {
          $CI->email->attach($attachment1);
        }
        $CI->email->send();
        if(!empty($RemoveAttachment))
        {
          unlink($RemoveAttachment);
        }*/
            
          $CI->email->send();



      $this->session->set_flashdata('message', 'Enrollment Id added successfully');
      redirect(site_url('Users'));
    }

     public function save_result()
    { 

      //print_r($_POST);exit;

      $id =$_POST['id_marks'];

      $data=array(
            'marks'=>$_POST['marks'],
            'remark'=>$_POST['remark'],
      );

        $con="id='".$id."'";

      $this->Crud_model->SaveData('users',$data,$con);

       $getEmployees = $this->Crud_model->get_single('users',"id='".$id."'");

        $subject="Enrollment No";
        $from = "jvvcolombo@gmail.com";
         $body = "Hello ".$getEmployees->first_name." Your Result is Out your marks is ".$_POST['marks']." and your Result is ".$_POST['remark'];
        $attachment="";
        $to=$getEmployees->email_id;


            $this->CI =& get_instance();
             $CI =& get_instance();
            //  $res= $this->custom->sendEmailSmtp($subject,$body,$to,$from);
            $CI->load->library('email');
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
           $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not  
            $this->email->initialize($config);
            $CI->email->from($from, 'JVV Colombo');
            $CI->email->to($to);
            $CI->email->subject($subject);
            $CI->email->message($body);
            if (!empty($attachment)) 
            {
          $CI->email->attach($attachment);
        }
       
            
          $CI->email->send();
          
          $to_jvv="jvvcolombo@gmail.com";
          
            $this->CI =& get_instance();
             $CI =& get_instance();
            //  $res= $this->custom->sendEmailSmtp($subject,$body,$to,$from);
            $CI->load->library('email');
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
           $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not  
            $this->email->initialize($config);
            $CI->email->from($from, 'JVV Colombo');
            $CI->email->to($to_jvv);
            $CI->email->subject($subject);
            $CI->email->message($body);
            if (!empty($attachment)) 
            {
          $CI->email->attach($attachment);
        }
        
        $CI->email->send();

        $this->session->set_flashdata('message', 'Result Added successfully');

      redirect(site_url('Users'));
    }

     public function returndata_user()
    { 

      $id = $_POST['id'];
      $getEmployees = $this->Crud_model->get_single('users',"id='".$id."'");
      echo $getEmployees->login_type;exit;

    }

    

     public function chck_enroll()
    { 

      
      $entrollment_id =$_POST['entrollment_id'];
      $id =$_POST['id_enroll'];

      $getenroll = $this->Crud_model->GetData('users','',"registration_code='".$entrollment_id."' and id!='".$id."'");

      if(!empty($getenroll))
      {
          echo "1";exit;
      }
      else
      {
          echo "2";exit;
      }

    }
    public function getdata_result()
    { 

    
      $id =$_POST['id'];
      $getEmployees = $this->Crud_model->get_single('users',"id='".$id."'");

     // print_r($getEmployees);exit;

      $data =array(
        'marks'=>$getEmployees->marks,
        'remark'=>$getEmployees->remark,
      );

        echo  json_encode($data);exit;

    }

     public function update($id)
    { 
        $header = array('page_title'=>'Farmcartbiz');

        $getCustomer = $this->Crud_model->get_single('users',"id='".$id."'");
        $getexecutive =   $this->Crud_model->GetData('employees','',"is_delete='No' and status='Active'and created_by='".$_SESSION['admin']['id']."'");
        //print_r($getCustomer);exit;
         $category = $this->Crud_model->GetData('categories','',"status='Active' and created_by='".$_SESSION['admin']['id']."'");
        $subcategory = $this->Crud_model->GetData('subcategories','',"status='Active' and created_by='".$_SESSION['admin']['id']."'");
        // print_r($subcategory);exit;

        $data = array(

                    'heading'=>'Update Customer',
                    'subheading'=>'Update Customer',
                    'button'=>'Update',
                    'action'=>site_url('Users/update_action'),
                     'name' =>set_value('name',$getCustomer->name),
                      'email' =>set_value('email',$getCustomer->email),
                      'mobile' =>set_value('mobile',$getCustomer->mobile),

                      'image' =>set_value('image',$getCustomer->image),

                      'pcat' =>set_value('pcat',$getCustomer->pcat),
                      'pid' =>set_value('pid',$getCustomer->pid),
                      'pliter' =>set_value('pliter',$getCustomer->pliter),
                    'total_amt' =>set_value('total_amt',$getCustomer->total_amt),
                      'shop_images' =>set_value('shop_images',$getCustomer->shop_images),
                      'location'=>set_value('address',$getCustomer->address),
                      'latitude'=>set_value('address',$getCustomer->latitude),
                      'longitude'=>set_value('address',$getCustomer->longitude),
                      'password'=>set_value('password',$getCustomer->password),
                     // 'business_type'=>set_value('business_type',$getCustomer->business_type),
                      'login_type'=>set_value('login_type',$getCustomer->login_type),
                      'executive_id'=>set_value('executive_id',$getCustomer->executive_id),
                      'getexecutive'=>$getexecutive,
                      'id' =>set_value('id',$id),

                       'category'=>$category,
                     'subcategory'=>$subcategory,
                );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('users/form',$data);
        $this->load->view('common/footer'); 
    }

/*function for update action developed by shubham */
    public function update_action()
    {
      
      //print_r($_POST);exit;

         $id = $_POST['id'];
        $this->_rules($id);
        $con="id='".$id."'";
        $this->form_validation->set_rules('name', 'Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->update($id);
        } 
        else
            { 
              if( $_FILES['image']['name']!='' )
              {
                  $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                  $config2['image_library'] = 'gd2';
                  $config2['source_image'] =  $_FILES['image']['tmp_name'];
                  $config2['new_image'] =   getcwd().'/uploads/users/'.$_POST['image'];
                  $config2['upload_path'] =  getcwd().'/uploads/users/';
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
                    unlink('/uploads/users/'.$_POST['image_old']);
                 }
                 else
                 {
                   $image  =$_POST['image_old'];
                 }
                 
                 
              //    if( $_FILES['shop_images']['name']!='' )
              // {
              //     $_POST['shop_images']= rand(0000,9999)."_".$_FILES['shop_images']['name'];
              //     $config2['image_library'] = 'gd2';
              //     $config2['source_image'] =  $_FILES['shop_images']['tmp_name'];
              //     $config2['new_image'] =   getcwd().'/uploads/shop_images/'.$_POST['shop_images'];
              //     $config2['upload_path'] =  getcwd().'/uploads/shop_images/';
              //     $config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
              //     $config2['maintain_ratio'] = FALSE;

              //     $this->image_lib->initialize($config2);
                
              //     if(!$this->image_lib->resize())
              //     {
              //         echo('<pre>');
              //         echo ($this->image_lib->display_errors());
              //         exit;
              //     }
                
              //     $shop_images  = $_POST['shop_images'];
              //     unlink('/uploads/users/'.$_POST['shop_images_old']);
                  
              //    }
              //    else
              //    {
              //      $shop_images  = $_POST['shop_images_old'];
              //    }
                 
                 
                /* if($_POST['pliter']=='1')
                 {
                    $liter = "1";
                 }
                 else
                 {
                    $liter = "0.5";
                 }*/

                $data = array(

                            'name' =>$this->input->post('name',TRUE),
                             'created_by' =>$_SESSION['admin']['id'],
                            'email' =>$this->input->post('email',TRUE),
                            'mobile' =>$this->input->post('mobile',TRUE),
                            'address' =>$this->input->post('location',TRUE),
                            'latitude' =>$this->input->post('lat',TRUE),
                            'longitude' =>$this->input->post('lon',TRUE),   
                            'password' =>$this->input->post('password',TRUE),          
                            'executive_id' =>$this->input->post('executive_id',TRUE),
                            'image' => $image,
                            'pcat' =>$this->input->post('pcate',TRUE),
                            'pid' =>$this->input->post('psubcate',TRUE),
                            'pliter' =>$this->input->post('pliter',TRUE),
                            //'liter' =>$liter,
                            'pamt' =>$this->input->post('pamt',TRUE),
                            'total_amt' =>$this->input->post('total_amt',TRUE),
                            'modified'=> date('Y-m-d H:i:s'),
                          );

             // echo "<pre>";  print_r($data);exit;

            $this->Crud_model->SaveData('users',$data,"id='".$id."'");

            $this->session->set_flashdata('message', 'Customer updated successfully');
            redirect(site_url('Users'));  

            }    
    
   
    }

     public function view($id)
    { 
        $header = array('page_title'=>'Gauganga');
        $cond="us.id='".$id."'";
        $getuser = $this->Users_model->GetuserViewData($cond);
        
        $data = array(

                    'heading'=>'View Customer',
                    'subheading'=>'View Customer',
                    'id' => set_value('id',$id),
                    'getuser' =>$getuser,
                );

        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('users/view',$data);
        $this->load->view('common/footer'); 
    }


           public function _rules($id) 
        {   

          $cond = "email='".$this->input->post('email',TRUE)."' and id!='".$id."' and is_delete='No'";

          $table = 'users';

          $row = $this->Crud_model->GetData($table,'',$cond);
          //print_r($row);exit;
          $count = count($row);
          if($count==0) 
          {
              $is_unique = "";
          }
          else 
          {
              $is_unique = "|is_unique[users.email]";

          }
                  $this->form_validation->set_rules('email', 'Email', 'trim|required'.$is_unique,
                    array(
                            'required'=> 'Please enter %s.',
                            'is_unique'=>'This Email already exist'
                        ));

         $cond2 = "mobile='".$this->input->post('mobile',TRUE)."' and id!='".$id."' and is_delete='No'";
        $row2 = $this->Crud_model->GetData($table,'',$cond2);
        $count2 = count($row2);
        if($count2==0)
        {
            $is_unique2 = "";
        }
        else 
        {
            $is_unique2 = "|is_unique[users.mobile]";

        }

        $this->form_validation->set_rules('mobile', 'Mobile', 'trim'.$is_unique2,
                    array(
                            'is_unique'=>'%s already exist',
                            'is_unique'=>'This Mobile already exist',
                        ));     

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }







}?>