<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Manage_Software extends CI_Controller {

    function __construct()
    {

      parent::__construct();    
      $this->load->database();
      $this->load->model('Manage_software_model');
       
    }
    public function index()
  {
      $header = array('page_title'=> 'AQUA');

        $data = array(
        'heading'=>'Manage Software Details',
        'createAction'=>site_url('Manage_Software/create'),     
        
    );
    

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('manage_software/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page()
  {
        $getAllData = $this->Manage_software_model->get_datatables();

        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            /*$btn = anchor(site_url('Manage_Software/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');*/

            $btn = anchor(site_url('Manage_Software/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $row->software_details;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Manage_software_model->count_all(),
                    "recordsFiltered" => $this->Manage_software_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {

    $software = $this->Crud_model->GetData('software',"","status='Active'");
    $header = array('page_title'=>'AQUA');  
    $data = array('heading'=>'Add Software Detail',
              'subheading'=>'Create Software Detail',
              'button'=>'Create',
              'action'=>site_url('Manage_Software/create_action'),
              'software'=>$software,
              'software_details' =>set_value('software_details'),
              'id' =>set_value('id'),
    );
    
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('manage_software/form',$data);
       
  }
  public function create_action()
  {

          $id = 0;
         $this->_rules($id);
        
        if ($this->form_validation->run() == FALSE) 
        {
            
            $this->create();
        } 
        else 
        {

        $data=array(
        'software_details' => $_POST['software_details'],
        'created'=>date('Y-m-d H:i:s'),
    );
    
    

    $this->Crud_model->SaveData('software_details',$data);
    $this->session->set_flashdata('message', 'Software Details Created Successfully');
    redirect("Manage_Software");
  }
 
  }
  public function update($id)
   {


      $header = array('page_title'=>'AQUA'); 
 
      $insdustrydata = $this->Crud_model->get_single("software_details","id='".$id."'"); 
      $data = array(
                'heading' => 'Update Software Detail',
                'subheading' => 'Update Software Detail',
                'button' => 'Update',
                'action' => site_url('Manage_Software/update_action/'.$id),
                'software_details' =>$insdustrydata->software_details,
                'id' =>$id,
      );
     // print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('manage_software/form',$data);
         
    }
  public function update_action($id)
    {
        $id = $id;
         $this->_rules($id);
        
        if ($this->form_validation->run() == FALSE) 
        {
            
            $this->update($id);
        } 
        else 
        {

      $data=array( 
          'software_details' => $_POST['software_details'],
          'modified'=>date('Y-m-d H:i:s'),
      );

      $this->Crud_model->SaveData('software_details',$data,"id='".$id."'");

      $this->session->set_flashdata('message', 'Software Details updated successfully');
      redirect("Manage_Software");

    }

    }

      public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("software_details",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
        
        if(isset($_POST['id']))
        {
           $this->Common_model->delete('software_details',"id='".$_POST['id']."'");
           $this->db->last_query();exit;
           exit;
        }
    }
    public function View($id)
    {  
         $header = array('page_title'=>'WPES');
         $getcustomerdata =$this->Manage_software_model->view_software("sd.id='".$id."'");
    
         $data =array(      
                    'software' => $getcustomerdata->title,
                    'description' => $getcustomerdata->description,
                    'price' => $getcustomerdata->price,         
        );


        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('manage_software/view',$data);
        $this->load->view('common/footer'); 

    }

     public function _rules($id) 
    {   
        $table ='software_details';
        $cond2 = "software_details='".$this->input->post('software_details',TRUE)."' and id!='".$id."'";
        $row2 = $this->Crud_model->get_single($table, $cond2);
         
        if(empty($row2))
        {
            $is_unique2 = "";
        }
        else 
        {
            $is_unique2 = "|is_unique[software_details.software_details]";

        }

        $this->form_validation->set_rules('software_details', 'Software Details', 'trim'.$is_unique2,
                    array(
                            'is_unique'=>'%s already exist'
                        ));
       
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }
        
   
}
?>
