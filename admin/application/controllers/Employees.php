<?php
   
  defined('BASEPATH') OR exit('No direct script access allowed');
    error_reporting(0);
  class Employees extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Employees_model');
        $this->load->model('Letter_model');
        $this->load->library(array('session','form_validation','image_lib','Custom','email'));
        $this->load->helper("file");
        //$this->load->library('M_pdf');
    }
    public function index()
      { 
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Customer Master',
            'createAction'=>site_url('Employees/create'),
            'changeAction'=>site_url('Employees/changeStatus'),
            'deleteAction'=>site_url('Employees/delete'),
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Employees/list',$data);
        $this->load->view('common/footer'); 
      }

    public function ajax_manage_page()
    {
   
        if ($_SESSION['SESSION_NAME']['designation']=='admin') 
        {
            $condition="d.designation_name!='admin'";
            $Employees = $this->Employees_model->get_datatables($condition);
            
        }
         elseif ($_SESSION['SESSION_NAME']['designation']=='developer') {
            $condition="a.created_by='".$_SESSION['SESSION_NAME']['id']."'";
            $Employees = $this->Employees_model->get_datatables($condition);
        
        }
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Employees as $custData) 
        {
            
            $btn = anchor(site_url('Employees/View/'.$custData->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Employees/update/'.$custData->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$custData->id.')"><i class="fa fa-trash-o"></i></span>';
            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Employees/add_list/'.$custData->id),'<button title="Add Certificate" class="btn btn-success btn-circle btn-xs"><i class="fa fa-plus"></i></button>');
           
             $status='';            
            if($custData->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$custData->id.'"  onClick="statuss('.$custData->id.');" >'.$custData->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$custData->id.'"  onClick="statuss('.$custData->id.');" >'.$custData->status.'</span>';
            }
           
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucfirst($custData->name);
            $nestedData[] = ucfirst($custData->designation_name);
            $nestedData[] = $custData->email;
            $nestedData[] = $custData->mobile_no;
            $nestedData[] = $status."<input type='hidden' id='status".$custData->id."' value='".$custData->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Employees_model->count_all($condition),
                    "recordsFiltered" => $this->Employees_model->count_filtered($condition),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function delete()
        {
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("admin","id='".$_POST['id']."'");exit();
            }
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("admin",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
        public function create()
        {

          $header = array('page_title'=>'WPES');  
          $designation = $this->Crud_model->GetData('designation',"","status='Active'");
          $states = $this->Crud_model->GetData('states',""," status='Active'");
          $cities = $this->Crud_model->GetData('cities',""," status='Active' and state_id='7'");
          $data = array('heading'=>'Add Employee',
            'subheading'=>'Create new Employee',
            'button'=>'Create',
                    'action'=>site_url('Employees/create_action'),
                    //'type' =>set_value('type'),
                    'designation_id' =>set_value('designation_id'),
                    'name' =>set_value('name'),
                    'email' =>set_value('email'),
                   'personal_email' =>set_value('personal_email'),
                    'password' =>set_value('password'),
                    'city_id' =>set_value('city_id'),
                    'state_id' =>set_value('state_id'),
                    'address' =>set_value('address'),
                    'mobile_no' =>set_value('mobile_no'),
                    'pin_code'=>set_value('pin_code'),
                    'id' =>set_value('id'),
                    'states'=>$states,
                    'cities'=>$cities,
                    'designation'=>$designation,
                    'desg_id'=>set_value('desg_id'),
                    'pincode'=>set_value('pincode'),
                    'created_by'=>set_value('created_by'),
          );
       
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
      $this->load->view('Employees/form',$data);
    }

    public function create_action()
    {  
        $header = array('page_title'=>'WPES');
        $id = 0;
         $this->_rules($id);
        
        /*if ($this->form_validation->run() == FALSE) {
            
            $this->create();
        } 
        else 
        { */  
             if(!empty($_POST['designation_id']))
             {
            $designation_id= $this->input->post('designation_id',TRUE);
             }
             else
             {
                $designation_id='';
             }
             if(!empty($_POST['designation_id']))
             {
            $designation_id= $this->input->post('designation_id',TRUE);
             }
             else
             {
                $designation_id='';
             }
            $data = array(
                        //'type' =>$this->input->post('type',TRUE),
                        'designation_id' =>$designation_id,
                        'name' =>ucfirst($this->input->post('name',TRUE)),
                        'email' =>$this->input->post('email',TRUE),
                         'personal_email' =>$this->input->post('personal_email',TRUE),
                        'password' =>md5($this->input->post('password',TRUE)),
                        'show_password' =>$this->input->post('password',TRUE),
                        'city_id' =>$this->input->post('city_id',TRUE),
                        'state_id' =>$this->input->post('state_id',TRUE),
                        'email' => $this->input->post('email',TRUE),
                        'address' => $this->input->post('address',TRUE),
                        'mobile_no' => $this->input->post('mobile_no',TRUE),
                        'pincode'=> $this->input->post('pin_code',TRUE),
                        'created_by'=> $_SESSION['SESSION_NAME']['id'],
                        'created'=> date('Y-m-d H:i:s'),
                            );
            // print_r($data); exit;
            $this->Crud_model->SaveData('admin',$data);
            $this->session->set_flashdata('message', 'Employee created successfully');
            redirect(site_url('Employees'));      
        //}
    

    }
   
    public function get_city()
    {  
        $id = $this->input->post('id');
        $cityData = $this->Crud_model->GetData('cities',"*","status='Active' and   state_id = '".$id."'");

        $html = "<option value='0'>Select city</option>";
        foreach ($cityData as $row_data) 
        {
            $html .= "<br><option value='".$row_data->id."'>".ucfirst($row_data->city_name)."</option>";
        }
        echo $html;
    }

    public function _rules($id) 
    {   
        $table ='customer_master';
        $cond2 = "email='".$this->input->post('email',TRUE)."' and id!='".$id."'";
        $row2 = $this->Crud_model->get_single($table, $cond2);
        //print_r($row);exit;
        
        if(empty($row2))
        {
            $is_unique2 = "";
        }
        else {
            $is_unique2 = "|is_unique[customer_master.email]";

        }
        $this->form_validation->set_rules('email', 'email id', 'trim'.$is_unique2,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
        $cond3 = "mobile_no='".$this->input->post('mobile_no',TRUE)."' and id!='".$id."'";
        $row3 = $this->Crud_model->get_single($table, $cond3);
        //print_r($row);exit;
  
        if(empty($row3))
        {
            $is_unique3 = "";
        }
        else {
            $is_unique3 = "|is_unique[customer_master.mobile_no]";

        }
        $this->form_validation->set_rules('mobile_no', 'Contact 1', 'trim'.$is_unique3,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }
    public function update($id)
    { 
      $header = array('page_title'=>'WPES');
        $getCustomer = $this->Crud_model->get_single('admin',"id='".$id."'");
        //print_r($getCustomer); exit;
        $designation = $this->Crud_model->GetData('designation',"","status='Active'");
        $states =  $this->Crud_model->GetData('states',""," status='Active'");
        $cities =  $this->Crud_model->GetData('cities',""," status='Active' and state_id='".$getCustomer->state_id."'");
        $data = array('heading'=>'Update Employees',
                    'subheading'=>'Update Employees',
                    'button'=>'Update',
                    'action'=>site_url('Employees/update_action'),
                    'states'=>$states,
                    'cities'=>$cities,
                    'designation'=>$designation,
                    'city_id' =>set_value('city_id',$getCustomer->city_id),
                    'state_id' =>set_value('state_id',$getCustomer->state_id),
                    'name' => set_value('name',$getCustomer->name),
                    'email' => set_value('email',$getCustomer->email),
                 'personal_email' => set_value('personal_email',$getCustomer->personal_email),
                    'mobile_no' => set_value('mobile_no',$getCustomer->mobile_no),
                    'salary' => set_value('salary',$getCustomer->salary),
                    'address' => set_value('address',$getCustomer->address),
                    'pincode'=> set_value('pincode',$getCustomer->pincode),
                    'password'=> set_value('password',$getCustomer->show_password),
                    'type'=> set_value('type',$getCustomer->type),
                    'desg_id'=> set_value('desg_id',$getCustomer->designation_id),
                    'city_id'=> set_value('city_id',$getCustomer->city_id),
                    'id' => set_value('id',$id),
                );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Employees/form',$data);
      
    }

    public function update_action()
    {
        //print_r($_POST); exit;
        $id = $this->input->post('id');
        if(!empty($_POST['designation_id'])){
            $designation_id= $_POST['designation_id'];
        }
         else
         {
            $designation_id='';
         }

        $this->_rules($id);
        $con="id='".$id."'";
        /*if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } 
        else
            {*/

            $data = array(
                        'designation_id' =>$designation_id,
                        //'type' =>$this->input->post('type',TRUE),
                        'name' =>$this->input->post('name',TRUE),
                        'email' => $this->input->post('email',TRUE),
                        'personal_email' => $this->input->post('personal_email',TRUE),
                        'password' => md5($this->input->post('password',TRUE)),
                        'show_password' => $this->input->post('password',TRUE),
                        'mobile_no' => $this->input->post('mobile_no',TRUE),
                        'salary' => $this->input->post('salary',TRUE),
                        'address'=>$this->input->post('address',TRUE),
                        'pincode'=>$this->input->post('pin_code',TRUE),
                        'city_id' =>$this->input->post('city_id',TRUE),
                        'state_id' =>$this->input->post('state_id',TRUE),
                        'designation_id' =>$this->input->post('designation_id',TRUE),
                        'modified'=> date('Y-m-d H:i:s'),
                    );
            //print_r($data); exit;   
            $this->Crud_model->SaveData('admin',$data,$con);
            $this->session->set_flashdata('message', 'Employee updated successfully');
            redirect(site_url('Employees'));
        //}      
    }

    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $cond="a.id='".$id."'";
        $Getcustomerdata = $this->Employees_model->get_customerdata($cond);

        $data =array(
          'heading'=>'Manage Employee',
          'Getcustomerdata'=>$Getcustomerdata,
        );
         $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Employees/view',$data);
        $this->load->view('common/footer'); 

    }

    //Add Certificate List
   public function add_list($id='')
      { 
        $header = array('page_title'=> 'WPES');
          $con="el.id='".$id."'";
        $letter_data = $this->Letter_model->get_letter_data($con);
            $data = array(
            'heading'=>'Customer Master',
            'create_certificate'=>site_url('Employees/add_certificate'),
            'changeAction'=>site_url('Employees/changeStatus'),
            'deleteAction'=>site_url('Employees/delete'),
            'title'=>$letter_data->title,
            'id'=>$id,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('Employees/certificate_list',$data);
        $this->load->view('common/footer'); 
      }

     public function ajax_certificate_list($id='')
     {
        $id=$id;
        $con ="el.employee_id='".$id."'";
        $letter = $this->Letter_model->get_datatables($con);

          if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($letter as $rows) 
        {
            
         $btn = anchor(site_url('Employees/view_certi/'.$rows->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

    $btn .='&nbsp;|&nbsp;'.anchor(site_url('Employees/print/'.$rows->id),'<button title="Print" class="btn btn-info btn-circle btn-xs"><i class="fa fa-print"></i></button>');
           
     $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$rows->id.')"><i class="fa fa-trash-o"></i></span>';

     $btn .='&nbsp;|&nbsp;'.anchor(site_url('Employees/pdf_download/'.$rows->id),'<button title="pdf" class="btn btn-info btn-circle btn-xs"><i class="fa fa-file-pdf-o"></i></button>');

     $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Send Mail"  class="btn btn-success btn-circle btn-xs" data-toggle="modal" data-target="#mail" onclick="mail('.$rows->id.')"><i class="fa fa-envelope"></i></span>';
           
             $status='';            
            if($rows->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$rows->id.'"  onClick="statuss('.$rows->id.');" >'.$rows->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$rows->id.'"  onClick="statuss('.$rows->id.');" >'.$rows->status.'</span>';
            }
           if(strlen($rows->description)>50){
            $desc=substr($rows->description,0,50).'...';
           }
           else{
             $desc=$rows->description;
           }
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
          //  $nestedData[] = $rows->name;
            $nestedData[] = ucfirst($rows->title);
            $nestedData[] = $desc;
            $nestedData[] = $status."<input type='hidden' id='status".$rows->id."' value='".$rows->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Letter_model->count_all($con),
                    "recordsFiltered" => $this->Letter_model->count_filtered($con),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }

     
 public function add_certificate($id='')
        {

          $header = array('page_title'=>'WPES');  
        
          $certificate = $this->Crud_model->GetData('certificate_type',"","status='Active'");
      
        
          $data = array('heading'=>'Add Employee',
            'subheading'=>'Create new Employee',
            'button'=>'Create',
                    'action'=>site_url('Employees/insert_data/'.$id),
                   
                    'certificate_id' =>set_value('certificate_id'),
                    'description' =>set_value('description'),
                    'description1' =>set_value('description1'),
                    'description2' =>set_value('description2'),
                    'description3' =>set_value('description3'),
                    
                     'id' =>$id,
                  'certificate'=>$certificate,
             
                  
          );
       
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
      $this->load->view('Employees/certificate_form',$data);
    }

public function insert_data($id='')
{
    
    $data=array(
        'certificate_id'=>$this->input->post('certificate_id'),
        'description'=>$this->input->post('description'),
        'description1'=>$this->input->post('description1'),
        'description2'=>$this->input->post('description2'),
        'description3'=>$this->input->post('description3'),
        'employee_id'=>$this->input->post('id'),

    );
    $this->Crud_model->SaveData('employee_letters',$data);
      $this->session->set_flashdata('message', 'Employee Certificate Sent successfully');
            redirect(site_url('Employees/add_list/'.$id));
}
 public function get_certificate()
 {
    
   $certifi = $this->Crud_model->GetData('certificates',"","status='Active' and certificate_type_id='".$_POST['certificate_id']."'","","","","1");
  
   if(!empty($certifi->description))
   {
 $data1=$certifi->description;
   }
   else{
    $data1="";
   }
   
  if(!empty($certifi->description1))
   {
 $data2=$certifi->description1;
   }
   else{
    $data2="";
   }
   if(!empty($certifi->description2))
   {
 $data3=$certifi->description2;
   }
   else{
    $data3="";
   }
   if(!empty($certifi->description3))
   {
 $data4=$certifi->description3;
   }
   else{
    $data4="";
   }

   $data=array(
 'data1'=>$data1,
 'data2'=>$data2,
 'data3'=>$data3,
 'data4'=>$data4,
   );
  echo json_encode($data);
 
 }
  public function change_status_certi()
        {

            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("employee_letters",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
         public function delete_certi()
        {
            if(isset($_POST['id']))
            {
                $row = $this->Crud_model->GetData('employee_letters','',"id='".$_POST['cid']."'",'','','','1');
        if(!empty($row))
        {
          unlink('uploads/pdf_download/'.$row->id);
        }
                $this->Crud_model->DeleteData("employee_letters","id='".$_POST['id']."'");exit();
            }
        }

         public function view_certi($id)
        {
             
        $con="el.id='".$id."'";
        $letter_data = $this->Letter_model->get_letter_data($con);
        $admin=$this->Crud_model->GetData('admin',"","status='Active'","","","","1");
        $designation=$this->Crud_model->GetData('designation',"","status='Active'","","","","1");
        $settings=$this->Crud_model->GetData('settings',"","","","","","1");

      
        $data=array(
            'title'=>$letter_data->title,
            'name'=>$admin->name,
            'address'=>$settings->address,
            'mobile'=>$settings->mobile,
            'alternate_mobile'=>$settings->alternate_mobile,
            'logo'=>$settings->logo,
            'email'=>$settings->email,
            'description'=>$letter_data->description,
            'description1'=>$letter_data->description1,
            'description2'=>$letter_data->description2,
            'description3'=>$letter_data->description3,
            'head_office'=>$settings->head_office,
            'website'=>$settings->website,
            'designation_name'=>$designation->designation_name,
            'site_name'=>$settings->site_name,
     );
 if($letter_data->title=='relieving letter')
       {
        $this->load->view('Employees/letter/reliving_letter',$data);
    }
     elseif($letter_data->title=='offer letter')
       {
        $this->load->view('Employees/letter/offer_letter',$data);
    }
    elseif($letter_data->title=='salary slip')
       {
        $this->load->view('Employees/letter/salary_slip',$data);
    }
     elseif($letter_data->title=='termination letter')
       {
        $this->load->view('Employees/letter/termination_letter',$data);
    }
 elseif($letter_data->title=='warning letter')
       {
        $this->load->view('Employees/letter/warning_letter',$data);
    }
    elseif($letter_data->title=='acknowledgement letter')
       {
        $this->load->view('Employees/letter/acknowlegement_letter',$data);
    }
     elseif($letter_data->title=='experience letter')
       {
        $this->load->view('Employees/letter/experience_letter',$data);
    }
     elseif($letter_data->title=='increment letter')
       {
        $this->load->view('Employees/letter/increment_letter',$data);
    }
       elseif($letter_data->title=='Intent letter')
       {
        $this->load->view('Employees/letter/intent_letter',$data);
    }
    elseif($letter_data->title=='joining letter')
       {
        $this->load->view('Employees/letter/joining_letter');
    }
    elseif($letter_data->title=='appointment letter')
       {
        $this->load->view('Employees/letter/appointment_letter');
    }
       
 }
 public function print($id,$pdf='')
 {
     
    
      // $id="el.employee_id='".$id."'";;
        $con="el.id='".$id."'";
       
        $letter_data = $this->Letter_model->get_letter_data($con);
        $designation=$this->Crud_model->GetData('designation',"","status='Active'","","","","1");
        $settings=$this->Crud_model->GetData('settings',"","","","","","1");

      
        $data =array(
            'title'=>$letter_data->title,
            'name'=>$letter_data->name,
            'address'=>$settings->address,
            'mobile'=>$settings->mobile,
            'alternate_mobile'=>$settings->alternate_mobile,
            'logo'=>$settings->logo,
            'email'=>$settings->email,
            'description'=>$letter_data->description,
            'description1'=>$letter_data->description1,
            'description2'=>$letter_data->description2,
            'description3'=>$letter_data->description3,
            'head_office'=>$settings->head_office,
            'website'=>$settings->website,
            'designation_name'=>$designation->designation_name,
            'site_name'=>$settings->site_name,
     	);

        if($letter_data->title=='relieving letter')
       {

       		if(!empty($pdf))
       		{
       			return $this->load->view('Employees/print_letter/reliving_letter',$data,true);
       		}
       		else
       		{
       			$this->load->view('Employees/print_letter/reliving_letter',$data);
       		}
   
       

       }

    elseif($letter_data->title=='offer letter')
       {

       		if(!empty($pdf))
       		{
       			return $this->load->view('Employees/print_letter/offer_letter',$data,true);
       		}
       		else
       		{
       			 $this->load->view('Employees/print_letter/offer_letter',$data);
       		}
       
    }
    elseif($letter_data->title=='salary slip')
       {

       		if(!empty($pdf))
       		{
       			return $this->load->view('Employees/print_letter/salary_slip',$data,true);
       		}
       		else
       		{
       			 $this->load->view('Employees/print_letter/salary_slip',$data);
       		}


        
    }
     elseif($letter_data->title=='termination letter')
       {

       		if(!empty($pdf))
       		{
       			return $this->load->view('Employees/print_letter/termination_letter',$data,true);
       		}
       		else
       		{
       			$this->load->view('Employees/print_letter/termination_letter',$data);
       		}

        
    }
 elseif($letter_data->title=='warning letter')
       {

       		if(!empty($pdf))
       		{
       			return $this->load->view('Employees/print_letter/warning_letter',$data,true);
       		}
       		else
       		{
       			$this->load->view('Employees/print_letter/warning_letter',$data);
       		}

        
    }
    elseif($letter_data->title=='acknowledgement letter')
       {

       		if(!empty($pdf))
       		{
       			return $this->load->view('Employees/print_letter/acknowlegement_letter',$data,true);
       		}
       		else
       		{
       			 $this->load->view('Employees/print_letter/acknowlegement_letter',$data);
       		}

       
    }
     elseif($letter_data->title=='experience letter')
       {	
       		if(!empty($pdf))
       		{
       			return $this->load->view('Employees/print_letter/experience_letter',$data,true);
       		}
       		else
       		{
       			$this->load->view('Employees/print_letter/experience_letter',$data);
       		}

    }
     elseif($letter_data->title=='increment letter')
       {

       		if(!empty($pdf))
       		{
       			return $this->load->view('Employees/print_letter/increment_letter',$data,true);
       		}
       		else
       		{
       			$this->load->view('Employees/print_letter/increment_letter',$data);
       		}

        
    }
       elseif($letter_data->title=='Intent letter')
       {
       		if(!empty($pdf))
       		{
       			return $this->load->view('Employees/print_letter/intent_letter',$data,true);
       		}
       		else
       		{
       			$this->load->view('Employees/print_letter/intent_letter',$data);
       		}

        
    }
    elseif($letter_data->title=='joining letter')
       {

       		if(!empty($pdf))
       		{
       			return $this->load->view('Employees/print_letter/joining_letter',$data,true);
       		}
       		else
       		{
       			$this->load->view('Employees/print_letter/joining_letter',$data);
       		}

        
    }
    elseif($letter_data->title=='appointment letter')
       {

       		if(!empty($pdf))
       		{
       			return $this->load->view('Employees/print_letter/appointment_letter',$data,true);
       		}
       		else
       		{
       			$this->load->view('Employees/print_letter/appointment_letter',$data);
       		}

    }
       
 }

public function pdf_download($id)
{
    $settings=$this->Crud_model->GetData('settings',"","","","","","1");
        $pdf="pdf";
        $body_pdf = $this->print($id,$pdf);

         $pnlname = date('d-m-Y'); 
        $rand=rand(0000,9999);
        $pnlname1 = date('d-m-Y').'_'.time(); 
        $fileName = '/uploads/pdf_download/'.$pnlname.'_wpes_'.$rand.'.pdf';

        $file = getcwd().$fileName;
        $pdfFilePath = $file;
        $this->load->library('m_pdf');
        ///////////////////////////WATERMARK CODE//////////////////////////////////////////////////
        $mpdf=new mPDF('c'); 
            
          $mpdf->SetDisplayMode('fullpage');
          $mpdf->SetWatermarkText('World Planet Technologies pvt.ltd.');
          $mpdf->watermark_font = 'DejaVuSansCondensed';
          $mpdf->watermarkTextAlpha = 0.1;
          $mpdf->showWatermarkText = true;
        ///////////////////////WATERMARK CODE//////////////////////////////////////////////////////
        ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
	      $mpdf->mirrorMargins = 1;
	      $mpdf->defaultPageNumStyle = '1';
	      $mpdf->SetDisplayMode('fullpage','two');
            ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
            $mpdf->defaultfooterfontsize = 12;  /* in pts */
            $mpdf->defaultfooterfontstyle = B;  /* blank, B, I, or BI */
            $mpdf->defaultfooterline = 0;       /* 1 to include line below header/above footer */
            $mpdf->SetHTMLFooter('<div style="background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;"> <strong> Head Office:</strong> '.$settings->head_office.'</div>','O'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $mpdf->SetHTMLFooter('<div style="background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;"> <strong> Head Office:</strong> '.$settings->head_office.'</div>','E'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $body =  $mpdf->WriteHTML($body_pdf);

               
            $mpdf->SetDisplayMode('fullpage');
            //download it D save F.
            fopen($pdfFilePath,'wb');
            $mpdf->Output($pdfFilePath, "D");
            $mpdf->Output($pdfFilePath, "F");        

        redirect(site_url('Employees'));

  
}
 public function send_mail()
{
    $settings=$this->Crud_model->GetData('settings',"","","","","","1");
       $id = $_POST['id'];
      if(!empty($_POST['id']))
      {
            $get_letter = $this->Crud_model->GetData('employee_letters','',"id='".$id."'",'','','','1');
          
            $get_admin=$this->Crud_model->GetData("admin","","id='".$get_letter->employee_id."' and status='Active'","","","","1");
            $personal_email=$get_admin->personal_email;
      }
      else{
          $personal_email="";
      }
     
 	    $pdf="pdf";
        $body_pdf = $this->print($id,$pdf);
     
       
        $pnlname = date('d-m-Y'); 
        $rand=rand(0000,9999);
        $pnlname1 = date('d-m-Y').'_'.time(); 
        $fileName = '/uploads/pdf_download/'.$pnlname.'_wpes_'.$rand.'.pdf';

        $file = getcwd().$fileName;
        $pdfFilePath = $file;
        $this->load->library('m_pdf');
        ///////////////////////////WATERMARK CODE//////////////////////////////////////////////////
        $mpdf=new mPDF('c'); 
            
          $mpdf->SetDisplayMode('fullpage');
          $mpdf->SetWatermarkText('World Planet Technologies pvt.ltd.');
          $mpdf->watermark_font = 'DejaVuSansCondensed';
          $mpdf->watermarkTextAlpha = 0.1;
          $mpdf->showWatermarkText = true;
        ///////////////////////WATERMARK CODE//////////////////////////////////////////////////////
        ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
              $mpdf->mirrorMargins = 1;
              $mpdf->defaultPageNumStyle = '1';
              $mpdf->SetDisplayMode('fullpage','two');
            ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
            $mpdf->defaultfooterfontsize = 12;  /* in pts */
            $mpdf->defaultfooterfontstyle = B;  /* blank, B, I, or BI */
            $mpdf->defaultfooterline = 0;       /* 1 to include line below header/above footer */
            $mpdf->SetHTMLFooter('<div style="text-align:center; background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;"> <strong> Head Office:</strong> '.$settings->head_office.'</div>','O'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $mpdf->SetHTMLFooter('<div style="text-align:center; background-color: #00264d ; margin-left: 10px; margin-right: 10px; color: white; padding: 10px;font-family: calibri;"> <strong> Head Office:</strong> '.$settings->head_office.'</div>','E'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $body =  $mpdf->WriteHTML($body_pdf);
        
            $mpdf->SetDisplayMode('fullpage');
            //download it D save F.
            fopen($pdfFilePath,'wb');
            // $mpdf->Output($pdfFilePath, "D");
            $mpdf->Output($pdfFilePath, "F");
        $attachment = base_url().$fileName;
 
	        $subject = $this->input->post('subject');
	        $description = $this->input->post('description');
	        $from =$_POST['from_mail'];

	        if(empty($subject))
	        {
	            $subject1="";
	        }
	        else{
	            $subject1 =  $subject;
	        }
	        if(empty($description))
	        {
	            $body1="...";
	        }
	        else
	        {
	            $body1 = $description;
	        }
              
        $sendCustomerEmail=$personal_email; 

        $res= $this->custom->sendEmailSmtp_web($from,$subject1,$body1,$sendCustomerEmail,$attachment);
        $this->session->set_flashdata('message', 'Mail send successfully');
        redirect(site_url('Employees'));

}

    
}
?>