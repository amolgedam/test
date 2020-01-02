<?php

  defined('BASEPATH') OR exit('No direct script access allowed');
  //error_reporting(0);
  class Training extends CI_Controller {

  function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Training_receipt_model');
     /*   $this->load->library(array('session','form_validation','image_lib'));*/
     
    }
    public function index()
      { 
       /* $designation = $this->Crud_model->GetData('Demo_details',"","status='Active'");*/
       
      
        // print_r($product_data); exit;
        $header = array('page_title'=> 'WPES');
            $data = array(
            'heading'=>'Traning Details',
           'createAction'=>site_url('Training/create'),

           
        );
            //print_r($data); exit;
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('training/list',$data);
        $this->load->view('common/footer'); 
      }
 public function ajax_manage_page()
    {
    $trainee_receipt = $this->Training_receipt_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($trainee_receipt as $custData) 
        {
            
            $btn = anchor(site_url('Training/View/'.$custData->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Training/update/'.$custData->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$custData->id.')"><i class="fa fa-trash-o"></i></span>';
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
            $nestedData[] = $custData->trainee_name;
            $nestedData[] = $custData->date;
            $nestedData[] = $custData->training_duration.' '.'Month';
            $nestedData[] = $custData->training_amount;
            $nestedData[] = $custData->advance;
            $nestedData[] = $custData->balance_amount;
          
            $nestedData[] = $status."<input type='hidden' id='status".$custData->id."' value='".$custData->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Training_receipt_model->count_all(),
                    "recordsFiltered" => $this->Training_receipt_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function delete()

        {
          //print_r($_POST['id']); exit
            if(isset($_POST['id']))
            {
                $this->Crud_model->DeleteData("training","id='".$_POST['id']."'");exit();
            }
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
                $this->Crud_model->SaveData("training",$_POST,"id='".$_POST['id']."'");exit;
            }
        }



public function create()
        {
             
          $header = array('page_title'=>'WPES');  
          $data = array('heading'=>'Add Receipt',
            'subheading'=>'Create new Receipt',
                    'button'=>'Create',
                    'action'=>site_url('Training/create_action'),
                    'trainee_name' =>set_value('trainee_name'),
                    'date' =>set_value('date'),
                    'training_duration' =>set_value('training_duration'),
                    'training_amount' =>set_value('training_amount'),
                    'advance' =>set_value('advance'),
                    'balance_amount' =>set_value('balance_amount'),
                    'id'=>set_value('id'),
                 
          );
       
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
      $this->load->view('training/form',$data);
    }

          public function create_action()
    {  
    
            $data = array(
                        //'type' =>$this->input->post('type',TRUE),
                        
                        'trainee_name' =>ucfirst($this->input->post('trainee_name',TRUE)),
                        'date' =>$this->input->post('date',TRUE),
                        'training_duration' =>$this->input->post('training_duration',TRUE),
                        'training_amount' =>$this->input->post('training_amount',TRUE),
                        'advance' =>$this->input->post('advance',TRUE),
                        'balance_amount' =>$this->input->post('balance_amount',TRUE),
                       
                        
                        'created'=> date('Y-m-d H:i:s'),
                            );
         
            $this->Crud_model->SaveData('training',$data);
            $this->session->set_flashdata('message', 'Receipt  created successfully');
            redirect(site_url('Training/index'));      
       
    

    }
     public function update($id)
    { 
      $header = array('page_title'=>'WPES');
        $training = $this->Crud_model->get_single('training',"id='".$id."'");
      // print_r($this->db->last_query()); exit;
   
      
        $data = array('heading'=>'Update Receipts Details',
                    'subheading'=>'Update Receipts Details',
                    'button'=>'Update',
                    'action'=>site_url('Training/update_action/'.$id),
                    'trainee_name' =>set_value('trainee_name',$training->trainee_name),
                    'date' =>set_value('date',$training->date),
                    'training_duration' =>set_value('training_duration',$training->training_duration),
                    'training_amount' => set_value('training_amount',$training->training_amount),
                    'advance' => set_value('advance',$training->advance),
                    'balance_amount' => set_value('balance_amount',$training->balance_amount),
                    'id' => set_value('id',$id),
                );
        //print_r(expression)
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('training/form',$data);
      
    }

    public function update_action()
    {
        //print_r($_POST); exit;
        $id = $this->input->post('id');
          $data = array(
                      
                        //'type' =>$this->input->post('type',TRUE),
                        'trainee_name' =>$this->input->post('trainee_name',TRUE),
                        'date' => $this->input->post('date',TRUE),
                        'training_duration' => $this->input->post('training_duration',TRUE),
                        'training_amount' => $this->input->post('training_amount',TRUE),
                        'advance'=>$this->input->post('advance',TRUE),
                        'balance_amount'=>$this->input->post('balance_amount',TRUE),
                        'modified'=> date('Y-m-d H:i:s'),
                    );
            //print_r($data); exit;   
            $this->Crud_model->SaveData('training',$data,"id='".$id."'");
            $this->session->set_flashdata('message', 'Receipt updated successfully');
            redirect(site_url('Training'));
        //}      
    }

     public function View($id)
    {  
        $header = array('page_title'=>'WPES');
      
        $Getcustomerdata = $this->Crud_model->get_single("training","id='".$id."'");
        $data =array(
          'heading'=>"Trainee Receipt",
     
           'Getcustomerdata'=>$Getcustomerdata,
          
        );
  
        
        $this->load->view('training/view',$data);
      
    }


    }
    ?>