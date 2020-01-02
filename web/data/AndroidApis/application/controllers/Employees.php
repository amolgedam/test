<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Employees extends CI_Controller {

    function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Employees_model');
       // $this->load->model('Currency_city_model');
         $this->load->library(array('session','form_validation','image_lib'));
    }

    public function getData()
    {
      $empid = $this->input->post('emp');

      if($empid == 0)
      {
        $data = $this->Crud_model->GetData('employees','','','','','','');
      }
      else
      {
         $data = $this->Crud_model->GetData('employees','',"id !='".$empid."'",'','','','');
      }

      echo json_encode($data);
    }

    public function index()
    {
        
        $header = array('page_title'=> 'Farmcartbiz.com');
        $data = array(
        'heading'=>'Manage Employees',
        'createAction'=>site_url('Employees/create'),
        'changeAction'=>site_url('Employees/changeStatus'),
        'deleteAction'=>site_url('Employees/delete'),
    );
    //print_r($data);exit;

        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('employees/list',$data);
         
  }

  public function ajax_manage_page()
  {
      $con="emp.created_by='".$_SESSION['admin']['id']."' and emp.is_delete='No'";
        $manageEmp = $this->Employees_model->get_datatables($con);

        //print_r($manageEmp);exit;
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($manageEmp as $user) 
        {
            
        	$getcustomerCount = $this->Crud_model->GetData('users','',"(executive_id='".$user->id."' || empnew_id='".$user->id."') and status='Active' and is_delete='No'");

            $btn = anchor(site_url('Employees/View/'.$user->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .= '&nbsp;|&nbsp;'.anchor(site_url('Employees/update/'.$user->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');    

            $btn .= '&nbsp;|&nbsp;'.'<a href="#deleteData" data-toggle="modal" title="Delete" class="btn btn-danger btn-circle btn-xs" onclick="Delete('.$user->id.')"><i class="fa fa-trash-o"></i></a>';
          
             $status='';            
            if($user->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$user->id.'"  onClick="statuss('.$user->id.');" >'.$user->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$user->id.'"  onClick="statuss('.$user->id.');" >'.$user->status.'</span>';
            }

            if(file_exists('uploads/employees/'.$user->image))
            {
                if(!empty($user->image))
                {
                  $images = '<img src="'.base_url('uploads/employees/'.$user->image).'" height="60px" width="70px">';
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

             if(!empty($user->name)) { $name = $user->name; }else { $name = "N/A";}
             if(!empty($user->email)) { $email = $user->email; }else { $email = "N/A";}
             if(!empty($user->mobile)) { $mobile = $user->mobile; }else { $mobile = "N/A";}
             if(!empty($user->address)) { $address = $user->address; }else { $address = "N/A";}
             //if(!empty($user->name)) { $name = $user->name; }else { $name = "N/A";}

              if(!empty($user->degination)) 
              { 
                $degination = '<span class="badge" style="background-color:#006666;">'.$user->degination.'</span>'; 
              }
              else 
              { 
                $degination = "N/A";
              }


              if(count($getcustomerCount)=='0')
              {
              		$customers = '<span class="badge">'.count($getcustomerCount).'</span>';
              }
              else
              {
              		$customers = '<a class="badge" style="background-color:#0066ff;color:white;" href="'.site_url('Employees/customerList/'.$user->id).'"><span>'.count($getcustomerCount).'</span></a>';
              }
              


            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $images;
            $nestedData[] = ucwords($name);
            $nestedData[] = $email;
            $nestedData[] = $mobile;
            // $nestedData[] = $degination;
            $nestedData[] = $address;
            $nestedData[] = $customers;
            $nestedData[] = $status."<input type='hidden' id='status".$user->id."' value='".$user->status."' />";   
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Employees_model->count_all($con),
                    "recordsFiltered" => $this->Employees_model->count_filtered($con),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }

        public function delete()
        {
           ///   print_r($_POST);exit;
            $data =array( 
              'is_delete'=>'Yes',
            );

            $this->Crud_model->SaveData("employees",$data,"id='".$_POST['cid']."'");exit;          
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("employees",$_POST,"id='".$_POST['id']."'");exit;
            }
        }

        public function create()
        {
            $header = array('page_title'=>'Farmcartbiz.com');  

            $data = array(
                            'heading'=>'Add Employees',
                            'subheading'=>'Create Employees',
                            'button'=>'Create',
                            'action'=>site_url('Employees/create_action'),
                            'id'=>set_value('id'),
                            'name'=>set_value('name'),
                            'email'=>set_value('email'),
                            'password'=>set_value('password'),
                            'mobile'=>set_value('mobile'),
                            'address'=>set_value('address'),
                            'image'=>set_value('image'),
                            'addhar_card'=>set_value('addhar_card'),
                            'addhar_card_no'=>set_value('addhar_card_no'),
                            'degination'=>set_value('degination'),
          );
       // print_r($data);exit;
          $this->load->view('common/header',$header);
          $this->load->view('common/left_panel');
          $this->load->view('employees/form',$data);
          $this->load->view('common/footer');
    }

    function check_default($post_string)
    {
      return $post_string == '0' ? FALSE : TRUE;
    }
        /*function for Create action department developed by shubham */
    public function create_action()
    { 
         $id = 0;
        $this->_rules($id);
        $con="id='".$id."'";


        if ($this->form_validation->run() == FALSE) 
        {
            $this->create($id);
        } 
        else
            {
            
        // echo "<pre>"; print_r($_POST); exit();
          
               if($_FILES['image']['name']!='')
                {  
                     $src = $_FILES['image']['tmp_name'];
                      $filEnc = time();
                      $avatar= rand(0000,9999)."_".$_FILES['image']['name'];
                      $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                      $dest =getcwd().'/uploads/employees/'.$avatar1;
                    
                    if(move_uploaded_file($src,$dest))
                    {
                            $image  = $avatar1;                
                    }
                }
                else
                {
                    $image =""; 
                }

                  if($_FILES['addhar_card']['name']!='')
                {  
                     $src = $_FILES['addhar_card']['tmp_name'];
                      $filEnc = time();
                      $avatar= rand(0000,9999)."_".$_FILES['addhar_card']['name'];
                      $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                      $dest =getcwd().'/uploads/addhar_card/'.$avatar1;
                    
                    if(move_uploaded_file($src,$dest))
                    {
                            $addhar_card  = $avatar1;                
                    }
                }
                else
                {
                    $addhar_card =""; 
                }


                $data = array(
                            'name' =>$this->input->post('name',TRUE),
                            'created_by' =>$_SESSION['admin']['id'],
                            'email' =>$this->input->post('email',TRUE),
                            'password' =>$this->input->post('password',TRUE),
                            'mobile' =>$this->input->post('mobile',TRUE),
                            'address' =>$this->input->post('address',TRUE),
                            'addhar_card_no' =>$this->input->post('addhar_card_no',TRUE),
                            // 'degination' =>$this->input->post('degination',TRUE),
                            'image' => $image,
                            'addhar_card' => $addhar_card,
                            'created'=> date('Y-m-d H:i:s'),
                                );

             // echo "<pre>";  print_r($data);exit;

            $this->Crud_model->SaveData('employees',$data);

            $this->session->set_flashdata('message', 'Employees created successfully');
            redirect(site_url('Employees'));      
        }
    }

     public function update($id)
    { 

         $id=$id;
        $getEmployees = $this->Crud_model->get_single('employees',"id='".$id."'");

        //print_r($getEmployees);exit;
          $header = array('page_title'=>'Farmcartbiz.com');
        $data = array('heading'=>'Update Employees',
                    'subheading'=>'Update Employees',
                    'button'=>'Update',
                    'action'=>site_url('Employees/update_action'),
                    'name' => set_value('name',$getEmployees->name),
                    'email' => set_value('email',$getEmployees->email),
                    'password' => set_value('email',$getEmployees->password),
                    'mobile' => set_value('mobile',$getEmployees->mobile),
                    'address' => set_value('address',$getEmployees->address),
                    'addhar_card' => set_value('addhar_card',$getEmployees->addhar_card),
                    'addhar_card_no' => set_value('addhar_card_no',$getEmployees->addhar_card_no),
                    'degination' => set_value('degination',$getEmployees->degination),
                    'image' => set_value('image',$getEmployees->image),
                    'id' => set_value('id',$id),
                );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('employees/form',$data);
        $this->load->view('common/footer'); 
    }

/*function for update action developed by shubham */
    public function update_action()
    {
       $id = $this->input->post('id');
        $id = $id;
        $this->_rules($id);
        $con="id='".$id."'";

        $this->form_validation->set_rules('name', 'Name', 'trim|required');

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
                      $dest =getcwd().'/uploads/employees/'.$avatar1;
                    
                    if(move_uploaded_file($src,$dest))
                    {
                          unlink('uploads/employees/'.$_POST['old_image']);
                            $image  = $avatar1;                
                    }
                }
                else
                {
                    $image = $_POST['old_image']; 
                }

                  if($_FILES['addhar_card']['name']!='')
                {  
                     $src = $_FILES['addhar_card']['tmp_name'];
                      $filEnc = time();
                      $avatar= rand(0000,9999)."_".$_FILES['addhar_card']['name'];
                      $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                      $dest =getcwd().'/uploads/addhar_card/'.$avatar1;
                    
                    if(move_uploaded_file($src,$dest))
                    {
                            $addhar_card  = $avatar1;     
                          unlink('uploads/addhar_card/'.$_POST['old_addhar_card']);           
                    }
                }
                else
                {
                    $addhar_card = $_POST['old_addhar_card']; 
                }


                $data = array(

                            'name' =>$this->input->post('name',TRUE),
                            'created_by' =>$_SESSION['admin']['id'],
                            'email' =>$this->input->post('email',TRUE),
                            'password' =>$this->input->post('password',TRUE),
                            'mobile' =>$this->input->post('mobile',TRUE),
                            'address' =>$this->input->post('address',TRUE),
                            'image' => $image,
                            'addhar_card' => $addhar_card,
                            'created'=> date('Y-m-d H:i:s'),
                                );
                 // print_r($data);exit;
               
              $con="id='".$id."'";
             $this->Crud_model->SaveData('employees',$data,$con);
            $this->session->set_flashdata('message', 'Employees updated successfully');
            redirect(site_url('Employees'));

          }
   
    }



    public function save_enrollment()
    { 

      
      $id =$_POST['id_enroll'];

      //print_r($id);exit;

      $data=array(
            'registration_code'=>$_POST['entrollment_id'],
      );

        $con="id='".$id."'";

      $this->Crud_model->SaveData('users',$data,$con);

      //print_r($this->db->last_query());exit;

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

      $id =$_POST['id'];
      $getEmployees = $this->Crud_model->get_single('users',"id='".$id."'");
      echo $getEmployees->registration_code;exit;

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


     public function view($id)
    { 
        $header = array('page_title'=>'Farmcartbiz.com');

        $getuser = $this->Crud_model->get_single('employees',"id='".$id."'");

       // print_r($getuser);exit;

        $data = array(

                    'heading'=>'View Employees',
                    'subheading'=>'View Employees',
                    //'title' => set_value('title',$getEmployees->title),
                    //'banner' => set_value('banner',$getEmployees->image),
                    'id' => set_value('id',$id),
                    'getuser' =>$getuser,
                );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('employees/view',$data);
        $this->load->view('common/footer'); 
    }

    public function customerList($id)
    { 
        $header = array('page_title'=>'Gauganga.com');

        $getuser = $this->Crud_model->get_single('employees',"id='".$id."'");
        $cond ="u.executive_id='".$id."' || u.empnew_id='".$id."' and u.status='Active' and u.is_delete='No'";
        $getcustomer =$this->Employees_model->getCustomerData($cond);

        
        $cond_new ="status='Active' and is_delete='No' and (executive_id='".$id."' || empnew_id='".$id."')"; 
        $get_lister = $this->Crud_model->GetData('users','sum(pliter) as total_liter',$cond_new,'','','','1');

        $data = array(

                    'heading'=>'View Employees Customer',
                    'subheading'=>'View Employees Customer',
                    'id' => set_value('id',$id),
                    'getuser' =>$getuser,
                    'getcustomer' =>$getcustomer,
                    'get_lister' =>$get_lister,
                    
                );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('employees/customer_list',$data);
        $this->load->view('common/footer'); 
    }


          public function _rules($id) 
        {   

          $cond = "email='".$this->input->post('email',TRUE)."' and id!='".$id."' and is_delete='No'";

          $table = 'employees';

          $row = $this->Crud_model->get_single($table, $cond);
          //print_r($row);exit;
          $count = count($row);
          if($count==0) 
          {
              $is_unique = "";
          }
          else {
              $is_unique = "|is_unique[employees.email]";

          }
                  $this->form_validation->set_rules('email', 'Email', 'trim|required'.$is_unique,
                    array(
                            'required'=> 'Please enter %s.',
                            'is_unique'=>'This Email already exist'
                        ));

         $cond2 = "mobile='".$this->input->post('mobile',TRUE)."' and id!='".$id."' and is_delete='No'";
        $row2 = $this->Crud_model->get_single($table, $cond2);
        $count2 = count($row2);
        if($count2==0)
        {
            $is_unique2 = "";
        }
        else 
        {
            $is_unique2 = "|is_unique[employees.mobile]";

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