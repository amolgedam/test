 <?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Dashboard extends CI_Controller {

    function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Dashboard_model');
       // $this->load->model('Currency_city_model');
         $this->load->library(array('session','form_validation','image_lib'));
    }
    public function todays_joinings()
  {
        //print_r("expression");exit;

        $getTodaysJoiningdata = $this->Crud_model->GetData('enquiry','',"enquiry_date='".date('Y-m-d')."' and is_delete='No'");

        //print_r($getTodaysJoiningdata);exit;
            $header = array('page_title'=> 'AdarshDriving');
            $data = array(
                        'getTodaysJoiningdata'=> $getTodaysJoiningdata,
                        'header'              => $header,
                        'action'              => site_url('Dashboard/create_action'),

                    );
        
                    $this->load->view('common/header',$header);
                    $this->load->view('common/left_panel');
                    $this->load->view('dashboard/list',$data);
                    
    
  }
  
  public function todays_enquiry()
  {
        //print_r("expression");exit;

        $getTodaysJoiningdata = $this->Crud_model->GetData('enquiry','',"enquiry_date='".date('Y-m-d')."' and is_delete='No'");

        //print_r($getTodaysJoiningdata);exit;
        $header = array('page_title'=> 'AdarshDriving');
        $data = array(
                    'getTodaysJoiningdata'=> $getTodaysJoiningdata,
                    'header'              => $header,
                    'action'              => site_url('Dashboard/create_action'),
                );

        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('dashboard/todays_enq_list',$data);
                    
    
  }
  public function ajax_manage_page_today_enq()
  {

        //print_r("expression");exit;
        $con="mc.enquiry_date='".date('Y-m-d')."' and mc.is_delete='No'";
        $Getjoinigdata = $this->Dashboard_model->get_datatables($con);

        //print_r($Getjoinigdata);exit;
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Getjoinigdata as $empData) 
        {
            
            $btn="";

            $btn .= '<button title="Edit" class="btn btn-primary btn-circle btn-xs" onclick="check_modal('.$empData->id.')"><i class="fa fa-edit"></i></button>';

             $status='';            
            if($empData->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$empData->id.'"  onClick="statuss('.$empData->id.');" >'.$empData->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$empData->id.'"  onClick="statuss('.$empData->id.');" >'.$empData->status.'</span>';
            }  

             if(!empty($empData->enq_code)){ $enq_code = ucwords($empData->enq_code); }else{ $enq_code = "N/A"; }
             if(!empty($empData->name)){ $name = ucwords($empData->name); }else{ $name = "N/A"; }
             if(!empty($empData->mobile_no)){ $mobile_no = ucwords($empData->mobile_no); }else{ $mobile_no = "N/A"; }
             if(!empty($empData->email_id)){ $email_id = ucwords($empData->email_id); }else{ $email_id = "N/A"; }
             if(!empty($empData->joining_plan)){ $joining_plan = ucwords($empData->joining_plan); }else{ $joining_plan = "N/A"; }
        
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $enq_code;
            $nestedData[] = $name;
            $nestedData[] = $mobile_no;
            $nestedData[] = $email_id;
            $nestedData[] = date("jS M Y",strtotime($empData->enquiry_date));
            $nestedData[] = $empData->city;
            $nestedData[] = $empData->profession;
            $nestedData[] = $empData->joining_plan;
            $nestedData[] = $status."<input type='hidden' id='status".$empData->id."' value='".$empData->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Dashboard_model->count_all($con),
                    "recordsFiltered" => $this->Dashboard_model->count_filtered($con),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function ajax_manage_page()
  {

        //print_r("expression");exit;
        $con="mc.joining_plan='".date('Y-m-d')."' and mc.is_delete='No'";
        $Getjoinigdata = $this->Dashboard_model->get_datatables($con);

        //print_r($Getjoinigdata);exit;
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Getjoinigdata as $empData) 
        {
            
            $btn="";

            $btn .= '<button title="Edit" class="btn btn-primary btn-circle btn-xs" onclick="check_modal('.$empData->id.')"><i class="fa fa-edit"></i></button>';

            /*$btn .= anchor(site_url('EnquiryForm/update/'.$empData->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs" data-toggle="modal" data-target="#myModal" onclick="check_modal()"><i class="fa fa-edit"></i></button>');*/

             /*<td> <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal"><span class="fa fa-eye"></span></button></td>*/



            /* $btn .= anchor(site_url('EnquiryForm/view/'.$empData->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');
              $btn .= anchor(site_url('EnquiryForm/delete/'.$empData->id),'<button title="delete" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-times"></i></button>');*/
           
          /* $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$empData->id.')"><i class="fa fa-trash-o"></i></span>';*/
            /*$checkExist = $this->Crud_model->GetData('instructors',"mst_city_id='".$empData->id."'",'','','1');
            if(empty($checkExist))
            {*/
                //$btn .='&nbsp;|&nbsp;'.'<a href="#deleteData" data-toggle="modal" title="Delete" class="btn btn-danger btn-circle btn-xs" onclick="checkStatus('.$empData->id.')"><i class="fa fa-trash-o"></i></a>';
           /* }
            else
            {
                $btn.= '&nbsp;|&nbsp;'.anchor(site_url('Cities/delete/'.$empData->id),"<button class='btn btn-danger btn-circle btn-sm' disabled><i class='fa fa-trash-o'></i></button>");
            }*/       
            
           /* if($empData->status=='Active')
            {
                $status =  "<a href='#checkStatus' data-toggle='modal' class='label-success label' style='border-radius:0.15em !important;font-size:100% !important' onclick='checkStatus(".$empData->id.")'> Active </a>";            
            }
            else
            {
                $status =  "<a href='#checkStatus' data-toggle='modal'  class='label-danger label' style='border-radius:0.15em !important;font-size:100% !important' onclick='checkStatus(".$empData->id.")'> Inactive </a>";
            }*/

             $status='';            
            if($empData->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$empData->id.'"  onClick="statuss('.$empData->id.');" >'.$empData->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$empData->id.'"  onClick="statuss('.$empData->id.');" >'.$empData->status.'</span>';
            }  

             if(!empty($empData->enq_code)){ $enq_code = ucwords($empData->enq_code); }else{ $enq_code = "N/A"; }
             if(!empty($empData->name)){ $name = ucwords($empData->name); }else{ $name = "N/A"; }
             if(!empty($empData->mobile_no)){ $mobile_no = ucwords($empData->mobile_no); }else{ $mobile_no = "N/A"; }
             if(!empty($empData->email_id)){ $email_id = ucwords($empData->email_id); }else{ $email_id = "N/A"; }
             if(!empty($empData->joining_plan)){ $joining_plan = ucwords($empData->joining_plan); }else{ $joining_plan = "N/A"; }
        
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $enq_code;
            $nestedData[] = $name;
            $nestedData[] = $mobile_no;
            $nestedData[] = $email_id;
            $nestedData[] = date("jS M Y",strtotime($empData->enquiry_date));
            $nestedData[] = $empData->city;
            $nestedData[] = $empData->profession;
            $nestedData[] = $empData->joining_plan;
            $nestedData[] = $status."<input type='hidden' id='status".$empData->id."' value='".$empData->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Dashboard_model->count_all($con),
                    "recordsFiltered" => $this->Dashboard_model->count_filtered($con),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
        public function delete($id)
        {
            if(!empty($id))
            {
               $data=array(
                'is_delete'=>'Yes',
               );
                $this->Crud_model->SaveData("enquiry",$data,"id='".$id."'");

                $this->session->set_flashdata('message', 'Record deleted successfully');
               redirect(site_url('EnquiryForm'));
            }
        }
         public function view($id)
        {

            $header = array('page_title'=>'Enquiry view');
            $getalldata = $this->Crud_model->GetData('enquiry','',"id='".$id."'",'','','','1');
           // print_r($getalldata);exit;

            $data=array(
                            'enq_code'      => $getalldata->enq_code,
                            'name'          => $getalldata->name,
                            'dob'           => $getalldata->dob,
                            'mobile_no'     => $getalldata->mobile_no,
                            'whatsapp'      => $getalldata->whatsapp,
                            'email_id'      => $getalldata->email_id,
                            'profession'    => $getalldata->profession,
                            'address'       => $getalldata->address,
                            'city'          => $getalldata->city,
                            'pin_code'      => $getalldata->pin_code,
                            'is_vehicle'    => $getalldata->is_vehicle,
                            'vehicle_type'  => $getalldata->vehicle_type,
                            'enquiry_for'   => $getalldata->enquiry_for,
                            'how_u_know'    => $getalldata->how_u_know,
                            'joining_plan'  => $getalldata->joining_plan,
                            'feedback'      => $getalldata->feedback,
                            'enquiry_date'  => $getalldata->enquiry_date,
                            'remark'  => $getalldata->remark,
            );

        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('enquires/view',$data);
        $this->load->view('common/footer');

             
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("appointment_LLR",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
        public function create()
        {
            $header = array('page_title'=>'AdarshDriving');

            $data = array(
                'heading'          =>   'Add LLR Appointment',
                'subheading'       =>   'Create LLR Appointment',
                'button'           =>   'Create',
                'action'           =>   site_url('EnquiryForm/create_action'),
                'registration_no'  =>   set_value('registration_no'),
                'appointment_date' =>   set_value('appointment_date'),
                'first_name'       =>   set_value('first_name'),
                'middle_name'      =>   set_value('middle_name'),
                'last_name'        =>   set_value('last_name'),
                'camp'             =>   set_value('camp'),
                'sms_status'       =>   set_value('sms_status'),
                'id'               =>   set_value('id'),
          );
       //print_r($data);exit;
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('enquires/form',$data);
        $this->load->view('common/footer');
    }
        /*function for Create action department developed by Avinash */
    public function create_action()
    {
           // print_r($_SESSION['SESSION_NAME']['id']);exit();
            $data = array(
                'joining_plan'  => $this->input->post('joining_plan',TRUE),
                'remark'        => $this->input->post('remark',TRUE),
                'updated_by'    => $_SESSION['SESSION_NAME']['id'],
                'created'       => date('Y-m-d H:i:s'),
            );
           //print_r($data);exit;
            $this->Crud_model->SaveData('enquiry',$data,"id='".$_POST['id']."'");
            $this->session->set_flashdata('message', 'Record updated successfully');
            redirect(site_url('Dashboard/todays_joinings'));      
        }
    

    //}
        
     public function update($id)
    { 


        $header = array('page_title'=>'AdarshDriving');
        $getEmployees = $this->Crud_model->get_single('enquiry',"id='".$id."'"); 

        //print_r($getEmployees);exit;

        $data = array(
                    'heading'      => 'Update LLR Appointment',
                    'subheading'   => 'Update LLR Appointment',
                    'button'       => 'Update',
                    'action'       => site_url('EnquiryForm/update_action'),
                    'enq_code'     => set_value('enq_code',$getEmployees->enq_code),
                    'name'         => set_value('name',$getEmployees->name),
                    'dob'          => set_value('dob',$getEmployees->dob),
                    'mobile_no'    => set_value('mobile_no',$getEmployees->mobile_no),
                    'whatsapp'     => set_value('whatsapp',$getEmployees->whatsapp),
                    'profession'   => set_value('profession',$getEmployees->profession),
                    'address'      => set_value('address',$getEmployees->address),
                    'city'         => set_value('city',$getEmployees->city),
                    'pin_code'     => set_value('pin_code',$getEmployees->pin_code),
                    'is_vehicle'   => set_value('is_vehicle',$getEmployees->is_vehicle),
                    'vehicle_type' => set_value('vehicle_type',$getEmployees->vehicle_type),
                    'enquiry_for'  => set_value('enquiry_for',$getEmployees->enquiry_for),
                    'how_u_know'   => set_value('how_u_know',$getEmployees->how_u_know),
                    'joining_plan' => set_value('joining_plan',$getEmployees->joining_plan),
                    'feedback'     => set_value('feedback',$getEmployees->feedback),
                    'enquiry_date' => set_value('enquiry_date',$getEmployees->enquiry_date),
                    'status'       => set_value('status',$getEmployees->status),
                    'email_id'     => set_value('email_id',$getEmployees->email_id),
                    'remark'     => set_value('remark',$getEmployees->remark),
                    'id'           => set_value('id',$id),
                );

       // print_r($data);exit;


        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('enquires/form',$data);
        //$this->load->view('common/footer'); 
    }

/*function for update action developed by Avinash */
    public function update_action()
    {
       // print_r($_POST);exit;

            $id = $this->input->post('id');
            $email = $this->input->post('email_id',TRUE);

            $email_check = $this->Crud_model->get_single('enquiry',"email_id='".$email."' and id!='".$id."'");

            //print_r($this->db->last_query());exit;

            if (empty($email_check)) 
            {
                $email_id =$email;
            }
            else
            {
               $this->session->set_flashdata('message', 'Email already exist');
               redirect(site_url('EnquiryForm/update/'.$id));
            }

            $mobile = $this->input->post('mobile_no',TRUE);

            $mobile_check = $this->Crud_model->get_single('enquiry',"mobile_no='".$mobile."' and id!='".$id."'");

            if (empty($mobile_check)) 
            {
                $mobile_no =$mobile;
            }
            else
            {
               $this->session->set_flashdata('message', 'Mobile no already exist');
               redirect(site_url('EnquiryForm/update/'.$id));
            }

            $data = array(

                        'enq_code'      => $this->input->post('enq_code',TRUE),
                        'name'          => $this->input->post('name',TRUE),
                        'email_id'      => $this->input->post('email_id',TRUE),
                        'mobile_no'     => $this->input->post('mobile_no',TRUE),
                        'dob'           => $this->input->post('dob',TRUE),
                        'whatsapp'      => $this->input->post('whatsapp',TRUE),
                        'profession'    => $this->input->post('profession',TRUE),
                        'city'          => $this->input->post('city',TRUE),
                        'pin_code'      => $this->input->post('pin_code',TRUE),
                        'is_vehicle'    => $this->input->post('is_vehicle',TRUE),
                        'vehicle_type'  => $this->input->post('vehicle_type',TRUE),
                        'enquiry_for'   => $this->input->post('enquiry_for',TRUE),
                        'how_u_know'    => $this->input->post('how_u_know',TRUE),
                        'joining_plan'  => $this->input->post('joining_plan',TRUE),
                        'feedback'      => $this->input->post('feedback',TRUE),
                        'enquiry_date'  => $this->input->post('enquiry_date',TRUE),
                        'address'       => $this->input->post('address',TRUE),
                        'remark'       => $this->input->post('remark',TRUE),
                        'modified'      => date('Y-m-d H:i:s'),
                    );
            
            $this->Crud_model->SaveData('enquiry',$data,"id='".$id."'");
            $this->session->set_flashdata('message','Enquiry Updated successfully');
            redirect(site_url('EnquiryForm'));
//}  
}    
        

        public function _rules($id) 
        {   

          $cond = "registration_no='".$this->input->post('registration_no',TRUE)."' and id!='".$id."' and is_delete='No'";
          $table = 'appointment_LLR';
          $row = $this->Crud_model->get_single($table, $cond);
          //print_r($row);exit;
          $count = count($row);
          if($count==0) 
          {
              $is_unique = "";
          }
          else {
              $is_unique = "|is_unique[appointment_LLR.registration_no]";

          }
          $this->form_validation->set_rules('registration_no', 'regitration no', 'trim|required'.$is_unique,
            array(
                    'required'=> 'Please enter %s.',
                    'is_unique'=>'This %s already exist'
                ));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }








}?>