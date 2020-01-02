<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        /*keep this code for start session*/
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('form', 'url', 'html'));
        $this->load->model('Email_model');
        $this->load->model('Common_model');
        $this->load->database();
        
    }


    public function index()
    {   
        $breadcrum="<ol class='breadcrumb'>
            <li><a href='".site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id'])."'><i class='fa fa-dashboard'></i>Dashboard</a></li>
            <li class='active'>Manage Email</li>
            </ol>";

        $data=array('breadcrum' => $breadcrum,'title'=>'Manage Email','sub_title'=>'Manage Email', );
        $this->load->view('emails/list',$data);
    }

    public function ajax_list()
    { 
        $con = "e.is_delete='No'";
        $email = $this->Email_model->get_datatables($con);
       // print_r($orders_data);exit;
        $data = array();
        $no = $_POST['start'];

        foreach ($email as $row) 
        {
           /* $btn = ' '.anchor(site_url('Carriers/view/'.$row->id),'<span class="btn btn-info btn-xs" data-placement="right" title="View">View</span>');  

            $btn .= ' '.anchor(site_url('Carriers/update/'.$row->id),'<span class="btn btn-primary btn-xs"  data-placement="right" title="Edit">Edit</span>');  
                    
            $btn .= ' <button data-placement="right" title="Delete" class="btn btn-danger btn-xs" type="button" onclick="Delete(this,'.$row->id.')">Delete</button>';*/

            $btn = ''.anchor(site_url('Email/view/'.$row->id),'<span title="View" class="btn btn-info btn-circle btn-xs"  data-placement="right" title="View"><i class="fa fa-eye"></i></span>'); 
           $btn .= '&nbsp;|&nbsp; '.anchor(site_url('Email/update/'.$row->id),'<span title="Edit" class="btn btn-primary btn-circle btn-xs"  data-placement="right" title="Edit"><i class="fa fa-edit"></i></span>'); 
                    
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash-o"></i></span>';

           $status='';            
            if($row->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }

            if(strlen($row->description)>50)
            {
                $desc = substr($row->description, 0,50).'...';
            } else {
                $desc = $row->description;                
            }

            $title= str_replace("_"," ",$row->title);
    
            $no++;
            $nestedData = array();
             $nestedData[] = $no;
            $nestedData[] = $title;
            $nestedData[] = $row->subject;
           // $nestedData[] = $desc;
           // $nestedData[] = $status."<span class='btn btn-primary btn-xs'>".$row->type."</span>";
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        }

        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Email_model->count_all($con),
                "recordsFiltered" => $this->Email_model->count_filtered($con),
                "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

      


        public function delete()
        {
            if(isset($_POST['cid']))
            {
                $_POST['is_delete']='Yes';
                //$_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("email",$_POST,"id='".$_POST['cid']."'");exit;
            }
        }


        public function change_status()
        {
            if(isset($_POST['statusupdate']))
            {
                $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Common_model->SaveData("email",$_POST,"id='".$_POST['id']."'");exit;
            }
        }

        public function view($id)
        {
            $breadcrum="<ol class='breadcrumb'>
                <li><a href='".site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id'])."'><i class='fa fa-dashboard'></i>Dashboard</a></li>
                <li><a href='".site_url('Email/index')."'></i>Manage Email</a></li>
                <li class='active'>View Email</li>
                </ol>";

            $row = $this->Crud_model->GetData("email","id='".$id."'",'','','','1');

            $data=array(
                'breadcrum'=>$breadcrum,
                'title1'=>'View Email',
                'button'=>'Update',
                'action' => site_url('Email/update_action/'.$id),                
                'row'=>$row,
                );
            $this->load->view('emails/view',$data);
        }

        public function create()
        {
            $breadcrum="<ol class='breadcrumb'>
                <li><a href='".site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id'])."'><i class='fa fa-dashboard'></i>Dashboard</a></li>
                <li><a href='".site_url('Email/index')."'></i>Manage Email</a></li>
                <li class='active'>Add Email</li>
                </ol>";
            $data=array(
                'breadcrum'=>$breadcrum,
                'title1'=>'Add Email',
                'button'=>'Submit',
                'action' => site_url('Email/create_action'),
                'id' => set_value('id'),
                'title' => set_value('title'),
                'subject' => set_value('subject'),
                'description' => set_value('description'),
                
                );
            $this->load->view('emails/form',$data);
        }


        public function create_action()
        {
                    //print_r($_POST);exit;
                   
                   $data = array(
                            'title' => ucfirst($this->input->post('title',TRUE)),
                            'subject' => ucwords($this->input->post('subject',TRUE)),
                            'description' => $_POST['description'],
                            'created'=> date('Y-m-d H:i:s'),
                            );
                //print_r($data);exit;
           
            $this->Crud_model->SaveData('email',$data);
            $this->session->set_flashdata('message', 'Email created successfully');
            redirect(site_url('Email')); 
        }

        public function update($id)
        {
            $breadcrum="<ol class='breadcrumb'>
                <li><a href='".site_url('Welcome/dashboard/'.$_SESSION['SESSION_NAME']['id'])."'><i class='fa fa-dashboard'></i>Dashboard</a></li>
                <li><a href='".site_url('Email/index')."'></i>Manage Email</a></li>
                <li class='active'>Update Email</li>
                </ol>";

            $select = $this->Crud_model->GetData("email","","id='".$id."'",'','','','1');
            //print_r($select);exit;
            //print_r($select);exit;
            $data=array(
                'breadcrum'=>$breadcrum,
                'title1'=>'Update Email',
                'button'=>'Update',
                'action' => site_url('Email/update_action/'.$id),                
                'title'=>$select->title,
                'subject'=>$select->subject,
                'description'=>$select->description,
                'id'=>$select->id,
               
                );
            //print_r($data);exit;
            $this->load->view('emails/form',$data);
        }

       /* public function update_action($id)
        {
            
            $con="id='".$id."'";
            $data = array(
                        'title' => ucfirst($this->input->post('title',TRUE)),
                        'subject' => ucwords($this->input->post('subject',TRUE)),
                        
                        'description' => ucwords($this->input->post('description',TRUE)),
                        'created'=> date('Y-m-d H:i:s'),
                        );
           
            $this->Crud_model->SaveData('email',$data,$con);
            
            //print_r($this->db->last_query());exit;
            $this->session->set_flashdata('message', 'Email updated successfully');
            redirect(site_url('Email'));          
        }*/

        public function update_action($id)
        {
   $this->Crud_model->SaveData('email',$_POST,"id='".$id."'");
    $this->session->set_flashdata('message','Email has been updated successfully');
    redirect(site_url('Email/index'));
    }


        
}