<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class States extends CI_Controller {

	function __construct()
   	{
		parent::__construct();		
		$this->load->database();
        $this->load->model('Crud_model');
        $this->load->model('States_model');
    
   	}
   	public function index()
	{
        
		$header = array('page_title'=> 'AdarshDriving');
        $data = array(
		'heading'=>'State',
		'createAction'=>site_url('States/create'),
		'changeAction'=>site_url('States/changeStatus'),
		'deleteAction'=>site_url('States/delete'),
		);

        $this->load->view('common/header',$header);
		$this->load->view('common/left_panel');
		$this->load->view('states/list',$data);
		$this->load->view('common/footer');	
	}
	public function ajax_manage_page(){
        $DistrictData = $this->States_model->get_datatables();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($DistrictData as $empData) 
        {
            

            $btn = anchor(site_url('States/update/'.$empData->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
            $checkExist = $this->Crud_model->GetData('cities',"state_id='".$empData->id."'",'','','1');
          
        $status='';            
            if($empData->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$empData->id.'"  onClick="statuss('.$empData->id.');" >'.$empData->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$empData->id.'"  onClick="statuss('.$empData->id.');" >'.$empData->status.'</span>';
            }

            if(!empty($empData->state_code))
            {
                $code=ucwords($empData->state_code);
            }
            else
            {
                  $code='N/A';
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($empData->country_name);
            $nestedData[] = ucwords($empData->state_name);
            $nestedData[] = $code;
            $nestedData[] =  $status."<input type='hidden' id='status".$empData->id."' value='".$empData->status."' />";          
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->States_model->count_all(),
                    "recordsFiltered" => $this->States_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
	public function create(){
       
            $Countries = $this->Crud_model->GetData('countries','',"status='Active'");

       

    	$header = array('page_title'=>'RemitOut');	
		$data = array('heading'=>'Add State',
    				'subheading'=>'Create State',
    				'button'=>'Create',
                    'action'=>site_url('States/create_action'),
                    'state_name' =>set_value('state_name'),
                    'state_code' =>set_value('state_code'),
                    'country_id' =>set_value('country_id'),
    				'id' =>set_value('id'),
                    'Countries'=>$Countries,
    			);
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
		$this->load->view('states/form',$data);
        $this->load->view('common/footer');
    }

  

/*function for Create action department developed by Ashok M */
    public function create_action(){

    	$header = array('page_title'=>'State');

              $id = 0;
         $this->_rules($id);
        
        $this->form_validation->set_rules('state_name', 'State Name', 'trim|required|is_unique[states.state_name]');
        $this->form_validation->set_rules('state_code', 'State Code', 'trim|is_unique[states.state_code]');

        if ($this->form_validation->run() == FALSE) {
            
            $this->create();
        } 
        else 
        {      
            $data = array(
                        
                        'state_name' => ucfirst($this->input->post('state_name',TRUE)),
                        'country_id' => ucfirst($this->input->post('country_id',TRUE)),
                        'state_code' => ucfirst($this->input->post('state_code',TRUE)),
                        'created'=> date('Y-m-d H:i:s'),
                            );
           
            $this->Crud_model->SaveData('states',$data);
        

            $this->session->set_flashdata('message', 'State created successfully');
            redirect(site_url('States'));      
        }
		

    }
/*function for update department developed by Ashok M */
    public function update($id)
    {	
    	$header = array('page_title'=>'RemitOut');
		$Countries = $this->Crud_model->GetData('countries','',"status='Active'");
        $getEmployees = $this->Crud_model->get_single('states',"id='".$id."'");
        //print_r($getEmployees);exit;
        $data = array('heading'=>'Update State',
                    'subheading'=>'Update State',
                    'button'=>'Update',
                    'action'=>site_url('States/update_action'),
                    'state_name' => set_value('state_name',$getEmployees->state_name),
                    'state_code' => set_value('state_code',$getEmployees->state_code),
                    'country_id' => set_value('country_id',$getEmployees->country_id),
                    'id' => set_value('id',$id),
                    'Countries'=>$Countries,
                );
        //print_r($data);exit;
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('states/form',$data);
        $this->load->view('common/footer');	
    }

/*function for update action developed by Ashok M */
    public function update_action(){

        $id = $this->input->post('id');
    	$this->_rules($id);
        $con="id='".$id."'";

        $this->form_validation->set_rules('state_name', 'State Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } 
        else
            {
            
            $data = array(
                        'state_name' => ucfirst($this->input->post('state_name',TRUE)),
                        'state_code' => ucfirst($this->input->post('state_code',TRUE)),
                        'country_id' => ucfirst($this->input->post('country_id',TRUE)),
                        'modified'=> date('Y-m-d H:i:s'),
                            );
            
            $this->Crud_model->SaveData('states',$data,$con);
            $this->session->set_flashdata('message', 'State updated successfully');
            redirect(site_url('States'));
}      
    }

/*function for change status developed by Ashok */
    /*public function changeStatus(){
        $getProject_tasks = $this->Crud_model->get_single('states',"id='".$_POST['id']."'");

        if($getProject_tasks->status=='Active')
        {
            $this->Crud_model->SaveData('states',array('status'=>'Inactive'),"id='".$_POST['id']."'");
        }
        else
        {
            $this->Crud_model->SaveData('states',array('status'=>'Active'),"id='".$_POST['id']."'");
        }
        $this->session->set_flashdata('message', 'Status has been changed successfully');
        redirect(site_url('States'));
    }

/*function for delete department developed by Ashok */
    /*public function delete() {
        $row = $this->Crud_model->GetData('states',"id='".$_POST['id']."'",'','','1');
        $checkExist = $this->Crud_model->GetData('cities',"state_id='".$_POST['id']."'",'','','1');
        if(empty($checkExist))
        {

    		if ($row) 
            {
                $this->Crud_model->DeleteData('states',"id='".$_POST['id']."'");

    			$this->session->set_flashdata('message', 'State deleted successfully');
                redirect(site_url('States'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('States'));
            }
        }
        else
        {
            $this->session->set_flashdata('message', 'Cannot delete');
                redirect(site_url('States'));
        }
    }*/

 public function delete()
    {
        if(isset($_POST['cid']))
        {
            $row = $this->Crud_model->get_single('states',"id='".$_POST['cid']."'",'','','1');

            $checkExist = $this->Crud_model->get_single('cities',"state_id='".$row->id."'",'','','1');

            if(empty($checkExist))
            {

                if($row) 
                { 
                    $_POST['is_delete']='Yes';

                    $this->Crud_model->SaveData("states",$_POST,"id='".$_POST['cid']."'");
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
                $this->Crud_model->SaveData("states",$_POST,"id='".$_POST['id']."'");exit;
            }
        }       
            
/*function for check the validation and duplication during create and update department developed by Ashok */
    public function _rules($id) 
        {   

        $cond = "state_name='".$this->input->post('state_name',TRUE)."' and id!='".$id."' and is_delete='No'";
        $table = 'states';
        $row = $this->Crud_model->get_single($table, $cond);
       // print_r($this);exit;
        $count = count($row);
        if($count==0)
        {
            $is_unique = "";
        }
        else {
            $is_unique = "|is_unique[states.state_name]";

        }
                  $this->form_validation->set_rules('state_name', 'state name', 'trim|required'.$is_unique,
                    array(
                            'required'=> 'Please enter %s.',
                            'is_unique'=>'This state already exist'
                        ));

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
		}
}

?>