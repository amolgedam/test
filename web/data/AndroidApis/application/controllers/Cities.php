<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Cities extends CI_Controller {

    function __construct()
    {
        parent::__construct();      
        $this->load->database();
        $this->load->model('Crud_model');
        $this->load->model('Cities_model');
    }
    public function index()
    {
        
        $header = array('page_title'=> 'RemitOut');
        $data = array(
        'heading'=>'City',
        'createAction'=>site_url('Cities/create'),
        'changeAction'=>site_url('Cities/changeStatus'),
        'deleteAction'=>site_url('Cities/delete'),
        );

        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('cities/list',$data);
        $this->load->view('common/footer'); 
    }
    public function ajax_manage_page()
    {
        $CitiesData = $this->Cities_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($CitiesData as $empData) 
        {
            

            $btn = anchor(site_url('Cities/update/'.$empData->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           

             $status='';            
            if($empData->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$empData->id.'"  onClick="statuss('.$empData->id.');" >'.$empData->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$empData->id.'"  onClick="statuss('.$empData->id.');" >'.$empData->status.'</span>';
            }
            if(!empty($empData->city_code)){ $city_code = $empData->city_code; }else{ $city_code = "N/A"; }   

             if(!empty($empData->country_name)){ $country_name = ucwords($empData->country_name); }else{ $country_name = "N/A"; }
        
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $country_name;
            $nestedData[] = ucwords($empData->state_name);
            $nestedData[] = ucwords($empData->city_name);
            $nestedData[] = $status."<input type='hidden' id='status".$empData->id."' value='".$empData->status."' />";        
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Cities_model->count_all(),
                    "recordsFiltered" => $this->Cities_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
    public function create(){

        $States = $this->Crud_model->GetData('states',"*","status='Active'");
        $Countries = $this->Crud_model->GetData('countries',"*","status='Active'");

        $header = array('page_title'=>'RemitOut');  
        $data = array('heading'=>'Add City',
                    'subheading'=>'Create City',
                    'button'=>'Create',
                    'action'=>site_url('Cities/create_action'),
                    'city_name' =>set_value('city_name'),
                    'state_id' =>set_value('state_id'),
                    'country_id' =>set_value('country_id'),
                    'id' =>set_value('id'),
                    'show_on_web'=>set_value('show_on_web'),
                    'States'=>$States,
                    'Countries'=>$Countries,
                );
       // print_r($data);exit;
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('cities/form',$data);
        $this->load->view('common/footer');
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

    function check_default($post_string)
    {
      return $post_string == '' ? FALSE : TRUE;
    }

    function check_default1($post_string)
    {
      return $post_string == '' ? FALSE : TRUE;
    }

/*function for Create action department developed by shubham */
    public function create_action()
    {

        $header = array('page_title'=>'RemitOut');
      
        $id = 0;
         // $this->_rules($id);
        
        $this->form_validation->set_rules('country_id', 'Country', 'trim|required|callback_check_default');
        $this->form_validation->set_message('check_default', 'Select Country');

        $this->form_validation->set_rules('state_id', 'State', 'trim|required|callback_check_default1');
        $this->form_validation->set_message('check_default1', 'Select Country');

        $this->form_validation->set_rules('city_name', 'City Name', 'trim|required|is_unique[cities.city_name]');


        if ($this->form_validation->run() == FALSE) {
           
            $this->create($_POST);
        } 
        else 
        {
            $data = array(
                        
                        'city_name' => ucfirst($this->input->post('city_name',TRUE)),
                        'state_id' => ucfirst($this->input->post('state_id',TRUE)),
                        'country_id' => ucfirst($this->input->post('country_id',TRUE)),
                        'created'=> date('Y-m-d H:i:s'),
                            );
           // print_r($data);exit;
            $this->Crud_model->SaveData('cities',$data);
            //print_r($this->db->last_query());exit;

            $this->session->set_flashdata('message', 'City created successfully');
            redirect(site_url('Cities'));      
        }
        

    }
/*function for update department developed by shubham */
    public function update($id)
    {   
        $header = array('page_title'=>'RemitOut');
        $Countries = $this->Crud_model->GetData('countries',"*","status='Active'");
        $getEmployees = $this->Crud_model->get_single('cities',"id='".$id."'");
        $States = $this->Crud_model->GetData('states',"*","status='Active' and id='".$getEmployees->state_id."'");
       
   
        $data = array('heading'=>'Update City',
                    'subheading'=>'Update City',
                    'button'=>'Update',
                    'action'=>site_url('Cities/update_action'),
                    'city_name' => set_value('city_name',$getEmployees->city_name),
                    'state_id' => set_value('state_id',$getEmployees->state_id),
                    'country_id' => set_value('country_id',$getEmployees->country_id),
                    'id' => set_value('id',$id),
                    'Countries'=>$Countries,
                    'States'=>$States,
                );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('cities/form',$data);
        $this->load->view('common/footer'); 
    }

/*function for update action developed by Ashok */
    public function update_action()
    {
        // echo "<pre>"; print_r($_POST); exit();
        
        $id = $this->input->post('id');
        // $this->_rules($id);
        $con="id='".$id."'";

         $this->form_validation->set_rules('country_id', 'Country', 'trim|required|callback_check_default');
        $this->form_validation->set_message('check_default', 'Select Country');

        $this->form_validation->set_rules('state_id', 'State', 'trim|required|callback_check_default1');
        $this->form_validation->set_message('check_default1', 'Select Country');

        $this->form_validation->set_rules('city_name', 'City Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } 
        else
            {
            
            $data = array(
                        'city_name' => ucfirst($this->input->post('city_name',TRUE)),
                        'state_id' => ucfirst($this->input->post('state_id',TRUE)),
                        'country_id' => ucfirst($this->input->post('country_id',TRUE)),
                        'modified'=> date('Y-m-d H:i:s'),
                    );
            
            $this->Crud_model->SaveData('cities',$data,$con);
            $this->session->set_flashdata('message', 'City updated successfully');
            redirect(site_url('Cities'));
}      
    }


  public function delete()
        {
            if(isset($_POST['cid']))
            {
                $_POST['is_delete']='Yes';
                //$_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("cities",$_POST,"id='".$_POST['cid']."'");exit;
            }
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("cities",$_POST,"id='".$_POST['id']."'");exit;
            }
        }


            
/*function for check the validation and duplication during create and update department developed by Ashok */
        public function _rules($id) 
        {   

            $cond = "city_name='".$this->input->post('city_name',TRUE)."' and id!='".$id."' and is_delete='No'";
            $table = 'cities';
            $row = $this->Crud_model->get_single($table, $cond);
            //print_r($row);exit;
            $count = count($row);
            if($count==0)
            {
                $is_unique = "";
            }
            else {
                $is_unique = "|is_unique[cities.city_name]";

            }
              $this->form_validation->set_rules('city_name', 'city name', 'trim|required'.$is_unique,
                array(
                        'required'=> 'Please enter %s.',
                        'is_unique'=>'This city name already exist'
                    ));
            $this->form_validation->set_rules('id', 'id', 'trim');
            $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
        }
}

?>