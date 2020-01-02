<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Countries extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
        $this->load->model('Countries_model');
       // $this->load->model('Currency_city_model');
         $this->load->library(array('session','form_validation','image_lib'));
    }
    public function index()
  {
        
    $header = array('page_title'=> 'AdarshDriving');
        $data = array(
        'heading'=>'Country',
        'createAction'=>site_url('Countries/create'),
        'changeAction'=>site_url('Countries/changeStatus'),
        'deleteAction'=>site_url('Countries/delete'),
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('countries/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page()
    {
        $StatesData = $this->Countries_model->get_datatables('countries');
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($StatesData as $country) 
        {
            

            $btn = anchor(site_url('Countries/update/'.$country->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
            $assign = anchor(site_url('Countries/assign_city/'.$country->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs">Assign City</button>');
            $checkExist = $this->Crud_model->GetData('states',"country_id='".$country->id."'",'','','1');
            

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
            $nestedData[] = ucwords($country->country_name); 
            $nestedData[] = $status."<input type='hidden' id='status".$country->id."' value='".$country->status."' />";;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Countries_model->count_all('countries'),
                    "recordsFiltered" => $this->Countries_model->count_filtered('countries'),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
  public function create(){

      $header = array('page_title'=>'RemitOut');  
    $data = array('heading'=>'Add Country',
                'subheading'=>'Create Country',
                'button'=>'Create',
                'action'=>site_url('Countries/create_action'),
                'country_name' =>set_value('country_name'),
                'country_code' =>set_value('country_code'),
                'currency_image'=>set_value('currency_image'),
                'sort_by'=>set_value('sort_by'),
                'id' =>set_value('id'),
          );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
   $this->load->view('countries/form',$data);
        //$this->load->view('common/footer');
    }

  

/*function for Create action department developed by Akash Z */
    public function create_action(){
//print_r($_POST);exit;
      //$header = array('page_title'=>'Country');
      $id = 0;
      $this->_rules($id);
        $con="id='".$id."'";

        $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required|is_unique[countries.country_name]');

        if ($this->form_validation->run() == FALSE) {
            $this->create( $id );
        } 
        else
            {
             
            $data = array(
                        'country_name' => ucfirst($this->input->post('country_name',TRUE)),
                        'created'=> date('Y-m-d H:i:s'),
                            ); 
           
            $this->Crud_model->SaveData('countries',$data);

            $this->session->set_flashdata('message', 'Country created successfully');
            redirect(site_url('Countries'));      
      
    }

    }
/*function for update department developed by shubham */
    public function update($id)
    { 
      $header = array('page_title'=>'RemitOut');
    
        $getEmployees = $this->Crud_model->get_single('countries',"id='".$id."'");
        $data = array('heading'=>'Update Country',
                    'subheading'=>'Update Country',
                    'button'=>'Update',
                    'action'=>site_url('Countries/update_action'),
                    'country_name' => $getEmployees->country_name,
                    'id' => $id,
                );
       // print_r($data);exit;  
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('countries/form',$data);
        $this->load->view('common/footer'); 
    }

/*function for update action developed by shubham */
    public function update_action(){

        $id = $this->input->post('id');
        $this->_rules($id);
        $con="id='".$id."'";

        $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } 
        else
            {
                
                 
            $data = array(
                        'country_name' => ucfirst($this->input->post('country_name',TRUE)),
                        'modified'=> date('Y-m-d H:i:s'),
                            );
            
            $this->Crud_model->SaveData('countries',$data,$con);
            $this->session->set_flashdata('message', 'Country updated successfully');
            redirect(site_url('Countries'));
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
                $this->Crud_model->SaveData("countries",$_POST,"id='".$_POST['id']."'");exit;
            }
        }

/*function for check the validation and duplication during create and update department developed by shubham*/
    public function _rules($id) 
        {   

        $cond = "country_name='".$this->input->post('country_name',TRUE)."' and id!='".$id."'";
        $table = 'countries';
        $row = $this->Crud_model->get_single($table, $cond);
        //print_r($row);exit;
        $count = count($row);
        if($count==0)
        {
            $is_unique = "";
        }
        else {
            $is_unique = "|is_unique[countries.country_name]";

        }
        $this->form_validation->set_rules('country_name', 'Country name', 'trim|required'.$is_unique,
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