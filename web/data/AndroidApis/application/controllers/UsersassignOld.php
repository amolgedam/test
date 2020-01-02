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
        $emp =   $this->Crud_model->GetData('employees','',"is_delete='No' and status='Active'");
        // echo "<pre>"; print_r($emp); exit();
        $header = array('page_title'=> 'Farmcartbiz.com');
        $data = array(
            'heading'=>'Customers Assign',
            'action' => site_url('Usersassign/create'),
            'button'=>'Create',
            'emp' => $emp
        );

        $this->load->view('common/header',$header);
          $this->load->view('common/left_panel');
           $this->load->view('usersassign/create',$data);
          $this->load->view('common/footer');
    }

    public function create()
    {
      // echo "<pre>"; print_r($_POST); //exit();

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
                            'empold_id' => $this->input->post('empfrom'),
                            'empstatus' => $this->input->post('assignstatus'),
                            'datefrom' => $datefrom,
                            'dateto' => $dateto
                      );

      // echo "<pre>"; print_r($data); 
            
            $this->Crud_model->SaveData('users',$data,"id='".$this->input->post('userid')[$i]."'");
          }
          // exit();

          // Add Helper to Assign users
          // assigncustomer($countUsers);

          // Check Assign users Expiry
          $this->checkAssignUsers();

          $this->session->set_flashdata('message', 'Customers Assign successfully');
            redirect(site_url('Users'));  

          
          
          
      }

    }


    public function checkAssignUsers()
  {
    $now = strtotime("now");

        $users = $this->Crud_model->GetData('users','','','','','','');
    
    foreach ($users as $key => $value) {
    
      $start_date = strtotime('0 day', strtotime($value->datefrom));

      $end_date = strtotime($value->dateto);



      if($value->empstatus == 'tmp')
      {
        if(($now > $start_date) && ($now < $end_date))
        {
          $data = array(
                  'id' => $value->id,
                  'executive_id' => $value->empnew_id,
                );

          // echo "Between Dates <pre>"; print_r($data);
                $this->Crud_model->SaveData('users',$data,"id='".$value->id."'");
          
        }
        else
        {
          
          $data = array(
                  // 'id' => $value->id,
                  'executive_id' => $value->empold_id,
                  'empold_id' => 0,
                  'empnew_id' => 0,
                  'empstatus' => '',
                );
          // echo "Between Dates <pre>"; print_r($data);
          
          $this->Crud_model->SaveData('users',$data,"id='".$value->id."'");
          
        }
      }
      else if($value->empstatus == 'per')
      {
        
        $data = array(
                // 'id' => $value->id,
                'executive_id' => $value->empnew_id,
              );
        
        $this->Crud_model->SaveData('users',$data,"id='".$value->id."'");
        
      }
    }

    // exit();

  }








}?>