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
	public function ajax_manage_page(){
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
            if(!empty($empData->city_code)){ $city_code = $empData->city_code; }else{ $city_code = "N/A"; }   

             if(!empty($empData->country_name)){ $country_name = ucwords($empData->country_name); }else{ $country_name = "N/A"; }
        
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $country_name;
            $nestedData[] = ucwords($empData->state_name);
            $nestedData[] = ucwords($empData->city_name);
            $nestedData[] = ucwords($city_code);
            $nestedData[] = $empData->sort_by;
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
                    'city_code' =>set_value('city_code'),
                    'sort_by' =>set_value('sort_by'),
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

/*function for Create action department developed by shubham */
    public function create_action()
    {
        //print_r($_POST);exit;

    	$header = array('page_title'=>'RemitOut');

        $id = 0;
         $this->_rules($id);
        
        if ($this->form_validation->run() == FALSE) {
            
            $this->create();
        } 
        else 
        {      
           //$show_on_web = implode(",",$_POST["show_on_web"]);
            if (isset($_POST['show_on_web'])) 
            {
               $show_on_web='Yes';
            }
            else
            {
                $show_on_web='No';
            }
            $data = array(
                        
                        'city_name' => ucfirst($this->input->post('city_name',TRUE)),
                        'state_id' => ucfirst($this->input->post('state_id',TRUE)),
                        'country_id' => ucfirst($this->input->post('country_id',TRUE)),
                        'city_code' => ucfirst($this->input->post('city_code',TRUE)),
                        'sort_by' => $this->input->post('sort_by',TRUE),
                        'show_on_web'=>$show_on_web,
                        'created'=> date('Y-m-d H:i:s'),
                            );
           //print_r($data);exit;
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
         $show_on_web_explode=$getEmployees->show_on_web;
        //print_r($Countries);exit;  
        $data = array('heading'=>'Update City',
                    'subheading'=>'Update City',
                    'button'=>'Update',
                    'action'=>site_url('Cities/update_action'),
                    'city_name' => set_value('city_name',$getEmployees->city_name),
                    'state_id' => set_value('state_id',$getEmployees->state_id),
                    'country_id' => set_value('country_id',$getEmployees->country_id),
                    'city_code' => set_value('city_code',$getEmployees->city_code),
                    'sort_by' => set_value('sort_by',$getEmployees->sort_by),
                    'id' => set_value('id',$id),
                    'Countries'=>$Countries,
                    'show_on_web_explode'=>$show_on_web_explode,
                    'States'=>$States,
                );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('cities/form',$data);
        $this->load->view('common/footer');	
    }

/*function for update action developed by shubham */
    public function update_action(){

//print_r($_POST);exit;
if(isset($_POST['show_on_web']))
{
    $show=$_POST['show_on_web'];
}
else
{
    $show='No';
}
//print_r($show);exit;
        $id = $this->input->post('id');
    	$this->_rules($id);
        $con="id='".$id."'";
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } 
        else
            {
            
            $data = array(
                        'city_name' => ucfirst($this->input->post('city_name',TRUE)),
                        'state_id' => ucfirst($this->input->post('state_id',TRUE)),
                        'country_id' => ucfirst($this->input->post('country_id',TRUE)),
                        'city_code' => ucfirst($this->input->post('city_code',TRUE)),
                        'sort_by' => $this->input->post('sort_by',TRUE),
                        'show_on_web'=>$show,
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

/*function for change status developed by shubham */
    /*public function changeStatus()
    {
        $getProject_tasks = $this->Crud_model->get_single('cities',"id='".$_POST['id']."'");

        if($getProject_tasks->status=='Active')
        {
            $this->Crud_model->SaveData('cities',array('status'=>'Inactive'),"id='".$_POST['id']."'");
        }
        else
        {
            $this->Crud_model->SaveData('cities',array('status'=>'Active'),"id='".$_POST['id']."'");
        }
        $this->session->set_flashdata('message', 'Status has been changed successfully');
        redirect(site_url('Cities'));
    }*/

/*function for delete department developed by shubham */
    /*public function delete() 
    {
        $row = $this->Crud_model->get_single('cities',"id='".$_POST['id']."'",'','','1');
       
    		if ($row) 
            {
                $this->Crud_model->DeleteData('cities',"id='".$_POST['id']."'");

    			$this->session->set_flashdata('message', 'City deleted successfully');
                redirect(site_url('Cities'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('Cities'));
            }
    }
*/
        
            
/*function for check the validation and duplication during create and update department developed by shubham */
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
         $cond2 = "sort_by='".$this->input->post('sort_by',TRUE)."' and id!='".$id."' and is_delete='No'";
        $row2 = $this->Crud_model->get_single($table, $cond2);
        //print_r($row);exit;
        $count2 = count($row2);
        if($count2==0)
        {
            $is_unique2 = "";
        }
        else {
            $is_unique2 = "|is_unique[cities.sort_by]";

        }
        $this->form_validation->set_rules('sort_by', 'This sort number', 'trim'.$is_unique2,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
		}
}

?>