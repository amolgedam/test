<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Usersassign extends CI_Controller {

    function __construct()
    {
        parent::__construct();    
        $this->load->database();

        $this->load->model('Crud_model');
        $this->load->helper('employee_helper');
    }

    public function index()
    {
        $emp =   $this->Crud_model->GetData('employees','',"is_delete='No' and status='Active' and created_by='".$_SESSION['admin']['id']."'");
       
        $header = array('page_title'=> 'Gauganga.com');
        $data = array(
            'heading'=>'Customers Assign',
            'action' => site_url('Usersassign/assign_customer'),
            'button'=>'Create',
            'emp' => $emp
        );

        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('usersassign/create_new',$data);
        $this->load->view('common/footer');
    }

    public function create()
    {
      // echo "<pre>"; print_r($_POST); exit();

      $this->form_validation->set_rules('empfrom', 'Employee From', 'trim|required');

      if($this->form_validation->run() == FALSE) 
      {
          $this->index();
      }
      else
      {

        $datefrom = '0000-00-00';
        $dateto = '0000-00-00';

          if($this->input->post('assignstatus') == 'tmp')
          {
            $this->form_validation->set_rules('datefrom', 'Assign Date From', 'required');

            $this->form_validation->set_rules('dateto', 'Assign Date To', 'required');

              if($this->form_validation->run() == FALSE) 
              {
                  $this->index();
              }
              else
              {
                $datefrom = $this->input->post('datefrom');
                $dateto = $this->input->post('dateto');
              }
          }

          $countUsers = count($this->input->post('userid'));
          // echo $countUsers;

          for ($i=0; $i < $countUsers; $i++) { 
              
              $data = array(
                            // 'id' => $this->input->post('userid')[$i],
                            // 'executive_id' => $this->input->post('empto'),
                            'empnew_id' => $this->input->post('empto'),
                            // 'empold_id' => $this->input->post('empfrom'),
                            'empstatus' => $this->input->post('assignstatus'),
                            'datefrom' => $datefrom,
                            'dateto' => $dateto
                      );

     
            
            $this->Crud_model->SaveData('users',$data,"id='".$this->input->post('userid')[$i]."'");
          }
        
          $this->checkAssignUsers();

          $this->session->set_flashdata('message', 'Customers Assign successfully');
            redirect(site_url('Usersassign'));  

      }

    }


    public function checkAssignUsers()
  {
    $now = strtotime("now");

        $users = $this->Crud_model->GetData('users','',"",'','','','');
    
    foreach ($users as $key => $value) {
    
      $start_date = strtotime('0 day', strtotime($value->datefrom));

      $end_date = strtotime($value->dateto);

        $datefrom = '0000-00-00';
        $dateto = '0000-00-00';

      if($value->empstatus == 'tmp')
      {
        if(($now > $start_date) && ($now < $end_date))
        {
            $data = array(
                  // 'id' => $value->id,
                  'empnew_id' => $value->empnew_id,
                );

          $this->Crud_model->SaveData('users',$data,"id='".$value->id."'");
          
        }
        else
        {
          
          $data = array(
                  // 'id' => $value->id,
                  // 'executive_id' => $value->empold_id,
                  // 'empold_id' => 0,
                  'empnew_id' => 0,
                  'empstatus' => '',
                  'datefrom' => $datefrom,
                  'dateto' => $dateto
                );
          // echo "Between Dates <pre>"; print_r($data);
          
          $this->Crud_model->SaveData('users',$data,"id='".$value->id."'");
          
        }
      }
      else if($value->empstatus=='per')
      {
        
        $data = array(
                // 'id' => $value->id,
                'empnew_id' => $value->empnew_id,
              );
        
        $this->Crud_model->SaveData('users',$data,"id='".$value->id."'");
        
      }
    }

    // exit();

  }

  public function get_list()
  {

      $get_customer = $this->Crud_model->GetData('users','',"(executive_id='".$_POST['val']."' || empnew_id='".$_POST['val']."') and status='Active' and is_delete='No'");

      $data = array(
        'get_customer'=>$get_customer,
      );

      $this->load->view('usersassign/list',$data);


  }

     public function assign_customer()
    {

      //echo "<pre>" ; print_r($_POST);exit;

        if(!empty($_POST))
        {

          if($_POST['customer_type']=='Assign_Employee')
          {

            if($_POST['assignstatus']=='per')
            {

              foreach ($_POST['cust_id'] as $cust_id) 
              {
                  $data=array(
                    'executive_id'=>"0",
                    'empnew_id'=>"0",
                  );

                  $this->Crud_model->SaveData('users',$data,"id='".$cust_id."'");

                  $log = array(
                    'executive_id'=>$_POST['empto'],
                  );

                $this->Crud_model->SaveData('users',$log,"id='".$cust_id."'");

              }

              redirect('Usersassign');

          }
          else
          {
             
              foreach ($_POST['cust_id'] as $cust_id) 
              {
                  $data=array(
                    'datefrom'=>$_POST['datefrom'],
                    'dateto'=>$_POST['dateto'],
                    'empnew_id'=>$_POST['empto'],
                    'user_status'=>"Customer_Join",
                  );

                  $this->Crud_model->SaveData('users',$data,"id='".$cust_id."'");

                   $log = array(
                    'datefrom'=>$_POST['datefrom'],
                    'dateto'=>$_POST['dateto'],
                    'executive_id'=>$_POST['empfrom'],
                    'user_hold'=>"Customer_Hold",
                  );

                  $this->Crud_model->SaveData('users',$log,"id='".$cust_id."'");

              }

              redirect('Usersassign');

          }


        }
        else
        {

          foreach ($_POST['cust_id'] as $cust_id) 
          {
                
            $log = array(
              'datefrom'=>$_POST['datefrom'],
              'dateto'=>$_POST['dateto'],
              'executive_id'=>$_POST['empfrom'],
              'user_hold'=>"Customer_Hold",
              'user_status'=>"Customer_Hold",
            );

            $this->Crud_model->SaveData('users',$log,"id='".$cust_id."'");

          }

          redirect('Usersassign');

        }

      }
      else
      {
        redirect('Usersassign');
      }



    }








}?>