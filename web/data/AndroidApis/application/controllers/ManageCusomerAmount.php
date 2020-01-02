<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class ManageCusomerAmount extends CI_Controller {

    function __construct()
    {

    parent::__construct();    
    $this->load->database();
    $this->load->model('ManageCusomerAmount_model');
    $this->load->library(array('session','form_validation','image_lib'));

    }
    public function index()
  { 
      if(isset($_POST['datepicker']))
      {
        $date = $_POST['datepicker'];

      }
      else
      {
          $date = "";
      }

      if(isset($_POST['cust_name']))
      {
        $cust_name = $_POST['cust_name'];

      }
      else
      {
          $cust_name = "";
      }
      
        $get_customer = $this->Crud_model->GetData('users','id,name',"status='Active' and is_delete='No' and created_by='".$_SESSION['admin']['id']."'");

        $header = array('page_title'=> 'View Affilation center');
        $data = array(
        'heading'=>"Manage Customer Amount",
        'createAction'=>site_url('ManageCashOrder/create'),
        'changeAction'=>site_url('ManageCashOrder/changeStatus'),
        'deleteAction'=>site_url('ManageCashOrder/delete'),   
        'get_customer'=>$get_customer,   
        'date'=>$date,   
        'cust_name'=>$cust_name,   
    );

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('managecusomeramount/list',$data);
    
  }
  public function ajax_manage_page()
    {
       $cust_name = $_POST['SearchData5'];
       $date = $_POST['SearchData4'];
 
        if(empty($_POST['start']))
        {
            $no =0;   
        }
        else
        {
             $no =$_POST['start'];
        }

        $data = array(); 

        if(!empty($date))
        {
          $month= date('Y-m',strtotime($date));
        }
        else
        {
          $month= date('Y-m');
        }

        $con ="LEFT(dwd.date,7)='".$month."'";

        if(!empty($cust_name))
        {
          $cust_id = $cust_name;

          $con.=" and dwd.customer_id='".$cust_id."'";
        }
        $con="u.created_by='".$_SESSION['admin']['id']."'";
	      $ManageData = $this->ManageCusomerAmount_model->get_datatables($con);

        foreach ($ManageData as $row) 
        {
     
            $getDays = $this->Crud_model->GetData('days_wise_deliverys','',"customer_id='".$row->customer_id."' and LEFT(date,7)='".$month."'");

            $getTotal_liter = $this->Crud_model->GetData('days_wise_deliverys','sum(quantity) as total_qun',"customer_id='".$row->customer_id."' and LEFT(date,7)='".$month."'",'','','','1');

            $get_product_rate = $this->Crud_model->GetData('users','id,pid',"id='".$row->customer_id."'",'','','','1');
           
           /* $btn = anchor(site_url('ManageCusomerAmount/Invoice/'.$row->id),'<button title="Invoice" target="_blank" class="btn btn-warning btn-circle btn-xs"><i class="fa fa-eye"></i></button>');*/
            
            $btn = anchor(site_url('ManageCusomerAmount/View/'.$row->customer_id.'/'.$month),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            /*$btn.= '&nbsp;|&nbsp;'.'<a href="#deleteData" data-toggle="modal" title="Delete" class="btn btn-danger btn-circle btn-xs" onclick="Delete('.$row->id.')"><i class="fa fa-trash-o"></i></a>';*/


     
            $check_customer = $this->Crud_model->GetData('customer_payments','',"LEFT(date,7)='".$month."' and  customer_id='".$row->customer_id."'");

            if(empty($check_customer))
            {
                $status='<span class="btn btn-xs btn-warning" id="statusVal'.$row->id.'"  onclick="payment('.$row->customer_id.','."'".$month."'".');" >'."Unpaid".'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->id.'">'."Paid".'</span>';
            } 

              
          
                
            if(!empty($getTotal_liter->total_qun))
            {
              $total_qun = $getTotal_liter->total_qun;
              $am = $total_qun*80;
              $amount = 'Rs. '.number_format(round($am),2);
            }
            else
            {
                 $total_qun ="00";
                 $amount = "00";
            }
     
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] =  ucfirst($row->name);
            $nestedData[] = $month;
            $nestedData[] = count($getDays).'-Days';
            $nestedData[] = $total_qun;
            $nestedData[] = $amount;
            $nestedData[] = $status;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->ManageCusomerAmount_model->count_all($con),
                    "recordsFiltered" => $this->ManageCusomerAmount_model->count_filtered($con),
                    "data" => $data,
                );
        
        echo json_encode($output);



    }

  
    public function View($id,$month)
    {  

        $header = array('page_title'=>'Gauganga.com');
        $cond="dwd.customer_id='".$id."'";
        $getorderdata = $this->Crud_model->GetData('days_wise_deliverys','',"customer_id='".$id."' and LEFT(date,7)='".$month."'");

        $get_payment = $this->Crud_model->GetData('customer_payments','',"customer_id='".$id."'");

        $data =array(
                      'heading'=>"Manage Customer List",
                      'id'=>$id,
                      'month'=>$month,
                      'getorderdata'=>$getorderdata,
                      'get_payment'=>$get_payment,
                      
                    );

          $this->load->view('common/header',$header);
          $this->load->view('common/left_panel');
          $this->load->view('managecusomeramount/view',$data);
          $this->load->view('common/footer'); 

    }
   

/*function for check the validation and duplication during create and update department developed by Ashok*/
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
      
          public function change_status_city()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("currency_city_mapping",$_POST,"id='".$_POST['id']."'");exit;
                  $this->session->set_flashdata('message', 'Status changed successfully');
            }
        }


         public function save_payment()
        {

          if(!empty($_POST))
          {



          $date = $_POST['month'].'-00';
    
          $data = array(
            'amount'=>$_POST['amount'],
            'date'=>$date,
            'payment_date'=>date('Y-m-d'),
            'customer_id'=>$_POST['customer_id'],
            'status'=>"Paid",
          );

          $this->Crud_model->SaveData("customer_payments",$data);
          echo 1;exit;
        }
        else
        {
            echo 2;exit;
        }

        }




}?>