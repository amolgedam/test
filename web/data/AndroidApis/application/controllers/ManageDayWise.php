<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class ManageDayWise extends CI_Controller {

    function __construct()
    {

    parent::__construct();    
    $this->load->database();
    //$this->load->model('Affilation_center_model');
    $this->load->model('ManageDayWise_model');
       // $this->load->model('Currency_city_model');
    $this->load->library(array('session','form_validation','image_lib'));

    }
    public function index($flag='')
  {

      $header = array('page_title'=> 'Manage Employees Days');

      $get_employee = $this->Crud_model->GetData('employees','id,name',"created_by='".$_SESSION['admin']['id']."' and is_delete='No' and status='Active'");

      $data = array(
      'heading'=>"Manage Employees Days",
      'createAction'=>site_url('ManageCashOrder/create'),
      'changeAction'=>site_url('ManageCashOrder/changeStatus'),
      'deleteAction'=>site_url('ManageCashOrder/delete'),
      'get_employee'=>$get_employee,
      'flag'=>$flag,
       
    );

    //print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('managedaywise/list',$data);
    
  }
  public function ajax_manage_page()
    {

    	   $Filter = $_POST['SearchData4'];
        $emp_id = $_POST['SearchData5'];

        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }

        $data = array(); 


        $cond="e.is_delete='No' and e.status='Active' and e.created_by='".$_SESSION['admin']['id']."'";

        if(!empty($emp_id))
        {
            $cond.=" and e.id='".$emp_id."'";
        }
        //print_r($cond);exit;
        
	     $ManageData = $this->ManageDayWise_model->get_datatables($cond);
        
        foreach ($ManageData as $row) 
        {
            /*$btn = anchor(site_url('ManageCashOrder/Invoice/'.$row->id),'<button title="Invoice" target="_blank" class="btn btn-warning btn-circle btn-xs"><i class="fa fa-eye"></i></button>');
            
            $btn.= '&nbsp;|&nbsp;'.anchor(site_url('ManageCashOrder/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

             $btn.= '&nbsp;|&nbsp;'.'<a href="#deleteData" data-toggle="modal" title="Delete" class="btn btn-danger btn-circle btn-xs" onclick="Delete('.$row->id.')"><i class="fa fa-trash-o"></i></a>';*/

             if(!empty($Filter))
              {
                  $date = $Filter;
              }
              else
              {
                $date =date('Y-m-d');
              }

                  $cond_new ="(executive_id='".$row->id."' || empnew_id='".$row->id."') and status='Active' and is_delete='No'"; 
                  $get_lister = $this->Crud_model->GetData('users','sum(pliter) as total_liter',$cond_new,'','','','1');  

                  $total_milk ="<span class='badge' style='background-color:#3973ac;'>".number_format($get_lister->total_liter,1)."</span>";

                  $get_quantity = $this->Crud_model->GetData('milk_day_wise_assign_emp','',"emp_id='".$row->id."' and date='".$date."'",'','','','1');

                  if(!empty($get_quantity)){ $m_qua =  number_format($get_quantity->quantity,1);}else{ $m_qua =  "0";}

                  $milk_assign ='<a onclick="get_employee_day_work('.$row->id.')" class="badge" style="background-color:#ac7339;">'.$m_qua.'</a>';

                  $get_deliver_today = $this->Crud_model->GetData('days_wise_deliverys','sum(quantity) as total_quantity',"emp_id='".$row->id."' and date='".$date."'",'','','','1'); 

                  $deliverd_milk ="<span class='badge' style='background-color:#009900;'>".number_format($get_deliver_today->total_quantity,1)."</span>";

                  $a = number_format($get_deliver_today->total_quantity,1);

                  $b_milk = $m_qua - $a;

                  $balance_milk ="<span class='badge' style='background-color:#ac3939;'>".number_format($b_milk,1)."</span>";

             
            
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] =  ucfirst($row->name);
            $nestedData[] = date('d-m-Y',strtotime($date));
            $nestedData[] = $total_milk;
            $nestedData[] = $milk_assign;
            $nestedData[] = $deliverd_milk;
            $nestedData[] = $balance_milk;
           /* $nestedData[] = $btn;*/
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->ManageDayWise_model->count_all($cond),
                    "recordsFiltered" => $this->ManageDayWise_model->count_filtered($cond),
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
                'stateData'=>"",
                'stateData_id'=>"",
                 'courses'=>"",
                 'Mcourse->id'=>"",
                 'Mcourse->course_nam'=>"",
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

        //exit;
          foreach ($courses as $key)
          {
            $coure_array[]= $key->main_course_id;
          }

       
       // print_r($coure_array);exit;

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
                    'stateData'=>$stateData->state_name,
                    'stateData_id'=>$stateData->id,
                    'cityData'=>$cityData,
                    'image'=>$affilationData->image,
                    'description'=>$affilationData->description,
                    'MasterCourse' =>$MasterCourse,
                    'Country' =>$Country,
                    'courses' =>$coure_array,
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

              $this->Crud_model->DeleteData("affilation_courses","affilation_centers_id='".$id."'");

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


    public function getOrderLog_data()
    {
      //print_r($_POST);exit;
      $order_id = $_POST['id'];
      $customer_id = $_POST['customer_id'];

      $get_orderlog = $this->Crud_model->GetData('order_logs','',"customer_id='".$customer_id."' and orders_id='".$order_id."'");

      $data = array(
                  'get_orderlog'=>$get_orderlog,
      );

      $logData['log'] =  $this->load->view('managecashorder/logdata',$data,true);

      echo json_encode($logData); return false;
    }



    public function View($id)
    {  
        $header = array('page_title'=>'Kundalifal');

        $cond="so.id='".$id."'";
        $getorderdata = $this->ManageCashOrder_model->get_orderdetails($cond);

        //print_r($getorderdata);exit;


        $condition ="sod.service_orders_id='".$id."'";
        $getorderdetails = $this->ManageCashOrder_model->get_orderdatadetails($condition);

        $get_orderlog = $this->Crud_model->GetData('order_logs','',"customer_id='".$getorderdata->customer_id."' and orders_id='".$id."'");
   
       // print_r($getorderdetails);exit;

        $data =array(
                      'heading'=>"Manage ".$getorderdata->payment_type." Order View",
                      'total_product'=>$getorderdata->total_product,
                      'total_quantity'=>$getorderdata->total_quantity,
                      'final_amount'=>$getorderdata->final_amount,
                      'payment_status'=>$getorderdata->payment_status,
                      'discount'=>$getorderdata->discount,
                      'booking_date'=>$getorderdata->booking_date,
                      'payment_type'=>$getorderdata->payment_type,
                      'name'=>$getorderdata->u_name,
                      'email'=>$getorderdata->u_email,
                      'mobile'=>$getorderdata->u_mobile,
                      'address'=>$getorderdata->u_address,
                      'username'=>$getorderdata->u_name,
                      'getorderdetails'=>$getorderdetails,
                      'customer_id'=>$getorderdata->customer_id,
                      'sub_total'=>$getorderdata->sub_total,
                      'extra_charges'=>$getorderdata->extra_charges,
                      'description'=>$getorderdata->description,
                      'reason'=>$getorderdata->reason,
                      'order_id'=>$id,
                      'get_orderlog'=>$get_orderlog,


                    );

          $this->load->view('common/header',$header);
          $this->load->view('common/left_panel');
          $this->load->view('managecashorder/view',$data);
          $this->load->view('common/footer'); 

    }
    public function Invoice($id)
    {  
        $header = array('page_title'=>'Farmcartbiz.com');

        $cond="so.id='".$id."'";
        $getorderdata = $this->ManageCashOrder_model->get_orderdetails($cond);

        $setting = $this->Crud_model->GetData('settings');

       

        $condition ="sod.service_orders_id='".$id."'";
        $getorderdetails = $this->ManageCashOrder_model->get_orderdatadetails($condition);

           //print_r($getorderdetails);exit;

        $get_orderlog = $this->Crud_model->GetData('order_logs','',"customer_id='".$getorderdata->customer_id."' and orders_id='".$id."'");
   
       // print_r($getorderdetails);exit;

        $data =array(
                      'heading'=>"Manage ".$getorderdata->payment_type." Order View",
                      'total_product'=>$getorderdata->total_product,
                      'total_quantity'=>$getorderdata->total_quantity,
                      'final_amount'=>$getorderdata->final_amount,
                      'payment_status'=>$getorderdata->payment_status,
                      'order_no'=>$getorderdata->order_no,
                      'discount'=>$getorderdata->discount,
                      'created'=>$getorderdata->created,
                      'booking_date'=>$getorderdata->booking_date,
                      'payment_type'=>$getorderdata->payment_type,
                      'name'=>$getorderdata->u_name,
                      'email'=>$getorderdata->u_email,
                      'mobile'=>$getorderdata->u_mobile,
                      'address'=>$getorderdata->u_address,
                      'username'=>$getorderdata->u_name,
                      'order_status'=>$getorderdata->order_status,
                      'getorderdetails'=>$getorderdetails,
                      'customer_id'=>$getorderdata->customer_id,
                      'sub_total'=>$getorderdata->sub_total,
                      'extra_charges'=>$getorderdata->extra_charges,
                      'description'=>$getorderdata->description,
                      'reason'=>$getorderdata->reason,
                      'order_id'=>$id,
                      'get_orderlog'=>$get_orderlog,
                      'setting'=>$setting,
                      'id'=>$id,


                    );

         /* $this->load->view('common/header',$header);
          $this->load->view('common/left_panel');*/
          $this->load->view('managecashorder/invoice',$data);
         /* $this->load->view('common/footer'); */

    }

     public function updatedOrderProcess()
    {
        //print_r($_POST);exit;

        $data = array(
          'customer_id'=>$_POST['customer_id'],
          'orders_id'=>$_POST['order_id'],
          'order_status'=>$_POST['order_process'],
          'request_from'=>'Admin',
          'order_date'=>date('Y-m-d H:i:s'),
        );

          $this->Crud_model->SaveData('order_logs',$data);

          if($_POST['order_process']=='Order Cancelled')
          {

             $data1 = array(
            'order_status'=>'Cancel',);

              $this->Crud_model->SaveData('service_orders',$data1,"id='".$_POST['order_id']."'");
          }

            echo '1';exit;
    }





    public function getpaymentstatus()
    {
      $id =$_POST['id'];
      $service_order = $this->Crud_model->get_single('service_orders',"id='".$id."'");
      echo $service_order->payment_status;exit;
    }

     public function getorderstatus()
    {
      $id =$_POST['id'];
      $service_order = $this->Crud_model->get_single('service_orders',"id='".$id."'");

      $data = array(
              'order_status'=>$service_order->order_status,
              'reason'=>$service_order->reason,
              'description'=>$service_order->description,
      );
      echo json_encode($data);exit;
    }

     public function save_payment_data()
    {

      $status= $_POST['payment_status'];
      $id= $_POST['id_order'];

      $data = array('payment_status' =>$status,);


      $this->Crud_model->SaveData('service_orders',$data,"id='".$id."'");
     
      $service_order = $this->Crud_model->get_single('service_orders',"id='".$id."'");

      redirect(site_url('ManageCashOrder/index/'.$service_order->payment_type));
    }

     public function save_order_data()
    {
          
      $status= $_POST['order_status_data'];
      $id= $_POST['id_order_data'];
      $customer_id = $_POST['customer_id'];
      $description = $_POST['description'];

      if(isset($_POST['reason']))
      {
        $reason = $_POST['reason']; 
      }
      else
      {
          $reason ="";
      }

      $customer_id = $_POST['customer_id'];

      $data = array(
        'order_status' =>$status,
        'reason' =>$reason,
        'description' =>$description,
      );

      $this->Crud_model->SaveData('service_orders',$data,"id='".$id."'");

      if($_POST['order_status_data']=='Cancel')
      {
          $data1 = array(
                'customer_id'=>$customer_id,
                'orders_id'=>$_POST['id_order_data'],
                'order_status'=>'Order Cancel',
                'order_date'=>date('Y-m-d H:i:s'),
                'request_from'=>'Admin',
          );

        $this->Crud_model->SaveData('order_logs',$data1);
      }

     
      $service_order = $this->Crud_model->get_single('service_orders',"id='".$id."'");


      redirect(site_url('ManageCashOrder/index/'.$service_order->payment_type));
    }

    public function save_paymentstatus()
    {
     
      $json_data = json_encode($_POST);
      $PaymentLog = array(
        'transaction_id' => $_POST['TXNID'],
        'bank_transaction_id' => $_POST['BANKTXNID'],
        'isPayment' => "Yes",
        'payment_mode' => 'card',
        'json_data' => $json_data,
        'payment_date' => $full_date,
        'modified' => $full_date,
       );
          $update_payment_logs = $this->Crud_model->SaveData("payment_logs",$PaymentLog, "orderId='".$_POST['ORDERID']."'");

        $service_order = $this->Crud_model->get_single('service_orders',"id='".$id."'");

        redirect(site_url('ManageCashOrder/index/'.$service_order->payment_type));
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
            $data = array('is_delete' =>'Yes');
           $this->Crud_model->SaveData("service_orders",$data,"id='".$_POST['cid']."'");
           exit;

        }
    }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("affilation_centers",$_POST,"id='".$_POST['id']."'");exit;
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

   public function export()
  {

  

    $con="so.is_delete='No'"; 

    if(!empty($_POST['flag']))  
    {
      $con .=" and so.payment_type='".$_POST['flag']."'";
    } 

      if($_POST['datepicker']!='')
      {
          $con .=" and so.booking_date = '".$_POST['datepicker']."'";
      }

     $report_data = $this->ManageCashOrder_model->GetOrderExport($con);

    //print_r($report_data);exit;

    $FileTitle='Order Report';
    $this->load->library('excel');
    //activate worksheet number 1
    $this->excel->setActiveSheetIndex(0);
    //name the worksheet
    $this->excel->getActiveSheet()->setTitle('Report');
    //set cell A1 content with some text
    $this->excel->getActiveSheet()->setCellValue('A1', 'Order Report');
    $this->excel->getActiveSheet()->setCellValue('A3','Sr No');
    $this->excel->getActiveSheet()->setCellValue('B3', 'Order No');
    $this->excel->getActiveSheet()->setCellValue('C3', 'Customer name');
    $this->excel->getActiveSheet()->setCellValue('D3', 'Customer No');
    $this->excel->getActiveSheet()->setCellValue('E3', 'Total Product');
    $this->excel->getActiveSheet()->setCellValue('F3', 'Total Quantity');
    $this->excel->getActiveSheet()->setCellValue('G3', 'Order Status');
    $this->excel->getActiveSheet()->setCellValue('H3', 'Payment Status');
    $this->excel->getActiveSheet()->setCellValue('I3', 'Payment Mode');
    $this->excel->getActiveSheet()->setCellValue('J3', 'Booking Date');
    /*$this->excel->getActiveSheet()->setCellValue('K3', 'Product List');*/
    $this->excel->getActiveSheet()->setCellValue('K3', 'Sub Total');
    $this->excel->getActiveSheet()->setCellValue('L3', 'Service Charges');
    $this->excel->getActiveSheet()->setCellValue('M3', 'Final Amount');
   
    $a='4';         
    $sr_no=1;
    foreach ($report_data as $report) { 

      $this->excel->getActiveSheet()->setCellValue('A'.$a, $sr_no);
      $this->excel->getActiveSheet()->setCellValue('B'.$a, $report->order_no);
      $this->excel->getActiveSheet()->setCellValue('C'.$a, $report->u_name);
      $this->excel->getActiveSheet()->setCellValue('D'.$a, $report->u_mobile);
      $this->excel->getActiveSheet()->setCellValue('E'.$a, $report->total_product);
      $this->excel->getActiveSheet()->setCellValue('F'.$a, $report->total_quantity);
      $this->excel->getActiveSheet()->setCellValue('G'.$a, $report->order_status);
      $this->excel->getActiveSheet()->setCellValue('H'.$a, $report->payment_status);
      $this->excel->getActiveSheet()->setCellValue('I'.$a, $report->payment_type);
      $this->excel->getActiveSheet()->setCellValue('j'.$a, $report->booking_date);
      /*$this->excel->getActiveSheet()->setCellValue('k'.$a, $report->payment_type);*/
      $this->excel->getActiveSheet()->setCellValue('K'.$a, $report->sub_total);
      $this->excel->getActiveSheet()->setCellValue('L'.$a, $report->extra_charges);
      $this->excel->getActiveSheet()->setCellValue('M'.$a, $report->final_amount);
     $a++;

      $cond ="sod.service_orders_id='".$report->id."'"; 
      $purchase_order_details = $this->ManageCashOrder_model->GetOrderDetails($cond);

            $a++; 
            $this->excel->getActiveSheet()->setCellValue('B'.$a, 'Sr No');
            $this->excel->getActiveSheet()->setCellValue('C'.$a, 'Product Name');
            $this->excel->getActiveSheet()->setCellValue('D'.$a, 'Product Price');
            $this->excel->getActiveSheet()->setCellValue('E'.$a, 'Qty In Kg');
            $this->excel->getActiveSheet()->setCellValue('F'.$a, 'Total Amount');
           /* $this->excel->getActiveSheet()->setCellValue('G'.$a, 'Price(in Rs.)');*/
            $this->excel->getActiveSheet()->getStyle('B'.$a)->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('C'.$a)->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('D'.$a)->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('E'.$a)->getFont()->setSize(11);
            $this->excel->getActiveSheet()->getStyle('F'.$a)->getFont()->setSize(11);
            /*$this->excel->getActiveSheet()->getStyle('G'.$a)->getFont()->setSize(11);*/
            $this->excel->getActiveSheet()->getStyle('B'.$a.':G'.$a)->applyFromArray(
                  array(
                      'fill' => array(
                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
                          'color' => array('rgb' => 'e0d1e2')
                      )
                  )
              );

            $sr_order_detail=1; foreach ($purchase_order_details as $order_detail)
            {
              $a++;
              $this->excel->getActiveSheet()->setCellValue('B'.$a, $sr_order_detail);
              $this->excel->getActiveSheet()->setCellValue('C'.$a, ucwords($order_detail->subcat_name));
              $this->excel->getActiveSheet()->setCellValue('D'.$a, $order_detail->price);
              $this->excel->getActiveSheet()->setCellValue('E'.$a, $order_detail->quantity);
              $this->excel->getActiveSheet()->setCellValue('F'.$a, $order_detail->total);      
             /* $this->excel->getActiveSheet()->setCellValue('G'.$a, $order_detail->total);  */
              $this->excel->getActiveSheet()->getStyle('C'.$a)->getFont()->setBold(true);
              $sr_order_detail++;
             } 
                $a++;
             
            $this->excel->getActiveSheet()->getStyle('A'.$a.':M'.$a)->applyFromArray(
                  array(
                      'fill' => array(
                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
                          /*'color' => array('rgb' => 'e0d1e2')*/
                      )
                  )
              );
             
             
             
      $a++;$sr_no++;
    }
  
    //change the font size
    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);

    $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('C3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('D3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('E3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('F3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('G3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('H3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('I3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('J3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('K3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('L3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('M3')->getFont()->setSize(11);
   
    //make the font become bold
    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

    $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('G3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('H3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('J3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('K3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('L3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('M3')->getFont()->setBold(true);
   
    
    $this->excel->getActiveSheet()->mergeCells('A1:M1');
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    /*FOR SET BACKGROUND COLOR*/
    
    $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray(
          array(
              'fill' => array(
                  'type' => PHPExcel_Style_Fill::FILL_SOLID,
                  'color' => array('rgb' => 'EED86C')
              )
          )
      );
      $this->excel->getActiveSheet()->getStyle('A3:M3')->applyFromArray(
          array(
              'fill' => array(
                  'type' => PHPExcel_Style_Fill::FILL_SOLID,
                  'color' => array('rgb' => 'c3e0de')
              )
          )
      );
      //print_r($report_data);exit;
      /*FOR SET AUTO WIDTH*/
      foreach(range('B','M') as $columnID)
      {
          $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
      }

    $filename='Report '.$FileTitle.'.xls'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache
                 
    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
    //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');
}

public function GetProductList()
{
    
    
    //$getorder_data = $this->Crud_model->GetData('service_orders','',"booking_date='".$_POST['date_list']."'");
    $getorder_data = $this->Crud_model->GetData('service_orders','',"booking_date='".$_POST['date_list']."' and  is_delete='No' and order_status='Done'");

  if(!empty($getorder_data))
  {

    $FileTitle='Order Report';
    $this->load->library('excel');
    //activate worksheet number 1
    $this->excel->setActiveSheetIndex(0);
    //name the worksheet
    $this->excel->getActiveSheet()->setTitle('Report');
    //set cell A1 content with some text
    $this->excel->getActiveSheet()->setCellValue('A1', 'Order Report');
    $this->excel->getActiveSheet()->setCellValue('A3','Sr No');
    $this->excel->getActiveSheet()->setCellValue('B3', 'Product Name');
    $this->excel->getActiveSheet()->setCellValue('C3', 'Required Product');
    $this->excel->getActiveSheet()->setCellValue('D3', 'Availabel Product');
    $this->excel->getActiveSheet()->setCellValue('E3', 'Purchase Product');
    $this->excel->getActiveSheet()->setCellValue('F3', 'Final Stock');
    /*$this->excel->getActiveSheet()->setCellValue('G3', 'Order Status');
    $this->excel->getActiveSheet()->setCellValue('H3', 'Payment Status');
    $this->excel->getActiveSheet()->setCellValue('I3', 'Payment Mode');
    $this->excel->getActiveSheet()->setCellValue('J3', 'Booking Date');
    $this->excel->getActiveSheet()->setCellValue('K3', 'Product List');
    $this->excel->getActiveSheet()->setCellValue('L3', 'Sub Total');
    $this->excel->getActiveSheet()->setCellValue('M3', 'Service Charges');
    $this->excel->getActiveSheet()->setCellValue('N3', 'Final Amount');*/
   
    $a='4';         
    $sr_no=1;



  //$getorder_data = $this->Crud_model->GetData('service_orders','',"booking_date='".$_POST['date_list']."'");
  foreach ($getorder_data as $orderdata) 
  {

    $ids[] = $orderdata->id;
    $imp_id = implode(",", $ids);

  }

    $getorder_Details = $this->Crud_model->GetData('service_orders_details','product_id,sum(quantity) as sum',"service_orders_id IN (".$imp_id.")","product_id");


    $a='4'; $sr_no=1; foreach ($getorder_Details as $data) 
  {

    $getorder_data = $this->Crud_model->GetData('subcategories','subcat_name,quantity_in_kg',"id='".$data->product_id."'",'','','','1');
    
   // print_r($getorder_data);exit;
    $product_name = $getorder_data->subcat_name;
    $available_quantity = $getorder_data->quantity_in_kg;
    $required_quantity = $data->sum;

    if($required_quantity > $available_quantity)
    {
        $purchase = $required_quantity - $available_quantity;

        $final_stock = "0";
    }
    else
    {
        $purchase ="0";
        $final_stock = $available_quantity - $required_quantity;

    }


      $this->excel->getActiveSheet()->setCellValue('A'.$a, $sr_no);
      $this->excel->getActiveSheet()->setCellValue('B'.$a, ucfirst($product_name));
      $this->excel->getActiveSheet()->setCellValue('C'.$a, $required_quantity);
      $this->excel->getActiveSheet()->setCellValue('D'.$a, $available_quantity);
      $this->excel->getActiveSheet()->setCellValue('E'.$a, $purchase);
      $this->excel->getActiveSheet()->setCellValue('F'.$a, $final_stock);
     /* $this->excel->getActiveSheet()->setCellValue('G'.$a, $report->order_status);
      $this->excel->getActiveSheet()->setCellValue('H'.$a, $report->payment_status);
      $this->excel->getActiveSheet()->setCellValue('I'.$a, $report->payment_type);
      $this->excel->getActiveSheet()->setCellValue('j'.$a, $report->booking_date);
      $this->excel->getActiveSheet()->setCellValue('k'.$a, $report->payment_type);
      $this->excel->getActiveSheet()->setCellValue('L'.$a, $report->sub_total);
      $this->excel->getActiveSheet()->setCellValue('M'.$a, $report->extra_charges);
      $this->excel->getActiveSheet()->setCellValue('N'.$a, $report->final_amount);*/
        
      $a++;$sr_no++;
  }


   //change the font size
    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);

    $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('C3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('D3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('E3')->getFont()->setSize(11);
    $this->excel->getActiveSheet()->getStyle('F3')->getFont()->setSize(11);
   
    //make the font become bold
    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

    $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('C3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('E3')->getFont()->setBold(true);
    $this->excel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
   
    
    $this->excel->getActiveSheet()->mergeCells('A1:F1');
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    /*FOR SET BACKGROUND COLOR*/
    $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray(
          array(
              'fill' => array(
                  'type' => PHPExcel_Style_Fill::FILL_SOLID,
                  'color' => array('rgb' => 'EED86C')
              )
          )
      );
      $this->excel->getActiveSheet()->getStyle('A3:F3')->applyFromArray(
          array(
              'fill' => array(
                  'type' => PHPExcel_Style_Fill::FILL_SOLID,
                  'color' => array('rgb' => 'c3e0de')
              )
          )
      );
      //print_r($report_data);exit;
      /*FOR SET AUTO WIDTH*/
      foreach(range('B','F') as $columnID)
      {
          $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
      }

    $filename='Report '.$FileTitle.'.xls'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache
                 
    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
    //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');
    
    }
  else
  {
      $this->session->set_flashdata('message', 'Report Not available');
      redirect('ManageCashOrder/index/Cash');

  }
  

}






}





?>