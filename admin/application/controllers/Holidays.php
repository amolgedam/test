<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Holidays extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
        $this->load->model('Holidays_model');
       // $this->load->model('Currency_city_model');
         $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
  {
        
    $header = array('page_title'=> 'BAPAT CRM');
        $data = array(
        'heading'=>'Holiday',
        'createAction'=>site_url('Holidays/create'),
        'changeAction'=>site_url('Holidays/changeStatus'),
        'deleteAction'=>site_url('Holidays/delete'),
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('holidays/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page()
    {
        $StatesData = $this->Holidays_model->get_datatables('holidays');
        //print_r($StatesData);exit;
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($StatesData as $country) 
        {
            if($country->date < date('Y-m-d'))
            {
                 $btn ="";
            }
            else
            {
                $btn = anchor(site_url('Holidays/update/'.$country->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
            }
            
           
            /*$assign = anchor(site_url('Countries/assign_city/'.$country->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs">Assign City</button>');*/
            //$checkExist = $this->Crud_model->GetData('states',"country_id='".$country->id."'",'','','1');
            

            /*if(empty($checkExist))
            {

            

               $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$country->id.')"><i class="fa fa-trash-o"></i></span>';
            }
            else
            {
                $btn.= '&nbsp;|&nbsp;'.anchor(site_url('Countries/delete/'.$country->id),"<button class='btn btn-danger btn-circle btn-xs' disabled><i class='fa fa-trash-o'></i></button>");
                  
            }       */
         
        $status='';            
            if($country->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$country->id.'"  onClick="statuss('.$country->id.');" >'.$country->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$country->id.'"  onClick="statuss('.$country->id.');" >'.$country->status.'</span>';
            }

             if(!empty($country->currency_image))
          {
            
            if(!file_exists("uploads/currency/".$country->currency_image))
              {  //print_r("hii");
                $img ='<img height="100px" width="100px" class="img-thumbnail img-responsive" src="'.base_url('uploads/no_image.png').'">';
              }
            else
              { 
                 //print_r("bbii");
               $img ='<a href="'.base_url('uploads/currency/'.$country->currency_image).'" data-lightbox="roadtrip"><img height="100px" width="100px" class="img-thumbnail img-responsive"src="'.base_url('uploads/currency/'.$country->currency_image).'" style="height:100px;width:100px"><a>';
              }
          }

          else
          { //print_r("ccii");
            $img ='<img height="100px" width="100px" class="img-thumbnail img-responsive" src="'.base_url('uploads/no_image.png').'">';
          }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($country->title);
            $nestedData[] = date('d-m-Y',strtotime($country->date));
            //$nestedData[] = $img;
            //$nestedData[] = $country->sort_by;  
            $nestedData[] = $status."<input type='hidden' id='status".$country->id."' value='".$country->status."' />";;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Holidays_model->count_all('holidays'),
                    "recordsFiltered" => $this->Holidays_model->count_filtered('holidays'),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
  public function create(){

      $header = array('page_title'=>'RemitOut');  
    $data = array('heading'=>'Add Holiday',
                'subheading'=>'Create Holiday',
                'button'=>'Create',
                'action'=>site_url('Holidays/create_action'),
                'title' =>set_value('title'),
                'date' =>set_value('date'),
                'status'=>set_value('status'),
                //'sort_by'=>set_value('sort_by'),
                'id' =>set_value('id'),
          );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
   $this->load->view('holidays/form',$data);
        //$this->load->view('common/footer');
    }

  

/*function for Create action department developed by Akash Z */
    public function create_action(){
        
      
      $id = 0;
      $this->_rules($id);
        $con="id='".$id."'";
        if ($this->form_validation->run() == FALSE) {
            $this->create( $id );
        } 
        else
            {
                  $expDate =explode('/', $_POST['date']);
                  
                 
                  $data = array(
                        'title' => ucfirst($this->input->post('title',TRUE)),
                        'date' => date('Y-m-d',strtotime($_POST['date'])),
                        'h_month' =>$expDate[0],
                        'created'=> date('Y-m-d H:i:s'),
                            );
           //print_r($data);exit;
           //print_r($_POST);exit;
            $this->Crud_model->SaveData('holidays',$data);

            $this->session->set_flashdata('message', 'Holiday has been created successfully');
            redirect(site_url('Holidays'));      
    }
  }
    /*function for update department developed by shubham */
    public function update($id)
    { 
      $header = array('page_title'=>'RemitOut');
    
        $getEmployees = $this->Crud_model->get_single('holidays',"id='".$id."'");
        $data = array('heading'=>'Update Holiday',
                    'subheading'=>'Update Holiday',
                    'button'=>'Update',
                    'action'=>site_url('Holidays/update_action'),
                    'title' => $getEmployees->title,
                    'date' => $getEmployees->date,
                   'id' => $id,
                );
       // print_r($data);exit;  
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('holidays/form',$data);
        //$this->load->view('common/footer'); 
    }

/*function for update action developed by shubham */
    public function update_action(){

        $id = $this->input->post('id');
        $this->_rules($id);
        $con="id='".$id."'";
        if ($this->form_validation->run() == FALSE) 
        {
            $this->update($this->input->post('id', TRUE));
        } 
        else
            {
                
                 
                 $expDate =explode('/', $_POST['date']);
                 
                 // print_r($expDate[0]);exit;
                  
                  
            $data = array(
                        'title' => ucfirst($this->input->post('title',TRUE)),
                        'date' => date('Y-m-d',strtotime($_POST['date'])),
                        "h_month"=>$expDate[0],
                        'modified'=> date('Y-m-d H:i:s'),
                            );
            
            $this->Crud_model->SaveData('holidays',$data,$con);
            $this->session->set_flashdata('message', 'Holiday has been updated successfully');
            redirect(site_url('Holidays'));
}      
    }



    public function delete()
    {
        if(isset($_POST['cid']))
        {
            $row = $this->Crud_model->get_single('countries',"id='".$_POST['cid']."'",'','','1');

            $checkExist = $this->Crud_model->get_single('states',"country_id='".$row->id."'",'','','1');

            if(empty($checkExist))
            {

                if($row) 
                { 
                    $_POST['is_delete']='Yes';

                    $this->Crud_model->SaveData("countries",$_POST,"id='".$_POST['cid']."'");
                    exit;
                } 
            }  

        }
    }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("holidays",$_POST,"id='".$_POST['id']."'");exit;
            }
        }

/*function for check the validation and duplication during create and update department developed by shubham*/
    public function _rules($id) 
        {   

        $cond = "title='".$this->input->post('title',TRUE)."' and id!='".$id."'";
        $table = 'holidays';
        $row = $this->Crud_model->GetData($table,'',$cond);
        //print_r($row);exit;
        $count = count($row);
        if($count==0)
        {
            $is_unique = "";
        }
        else {
            $is_unique = "|is_unique[holidays.title]";

        }
        $this->form_validation->set_rules('title', 'Title', 'trim|required'.$is_unique,
        array(
                'required'=> 'Please enter %s',
                'is_unique'=>' %s already exist'
            ));
        $cond1 = "date='".date('Y-m-d',strtotime($_POST['date']))."' and id!='".$id."'";
        $row1 = $this->Crud_model->GetData($table,'',$cond1);
        //print_r($row);exit;
        $count1 = count($row1);
        if($count1==0)
        {
            $is_unique1 = "";
        }
        else {
            $is_unique1 = "|is_unique[holidays.date]";

        }
        $this->form_validation->set_rules('date', 'Date', 'trim|required'.$is_unique1,
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

}



?>