<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Certificates extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Certificates_model');
       
    }
    public function index()
  {
    $header = array('page_title'=> 'AQUA');
        $data = array(
        'heading'=>'Manage Certificates',
        'createAction'=>site_url('Certificates/create'),
        
    );
   

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('certificates/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Certificates_model->get_datatables();
      
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            $btn = anchor(site_url('Certificates/view/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Certificates/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
           
            $nestedData[] = ucfirst($row->title);
           
            
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Certificates_model->count_all(),
                    "recordsFiltered" => $this->Certificates_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {
      $header = array('page_title'=>'AQUA'); 
      $type = $this->Crud_model->GetData('certificate_type',"","status='Active'");
     
      $data = array('heading'=>'Add Certificates',
      'subheading'=>'Create Certificates',
      'button'=>'Create',
       'button1'=>'Save & Print',
              'action'=>site_url('Certificates/create_action'),
              'certificate_type_id' =>set_value('certificate_type_id'),
                'description' =>set_value('description'),
                 'description1' =>set_value('description1'),
                'description2' =>set_value('description2'),
                'description3' =>set_value('description3'),
                'id' =>set_value('id'),
                   'type'=>$type,
                   
              );
       
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('certificates/form',$data);
       
  }
  public function create_action()
  {  
          $data=array(
             
              'certificate_type_id' =>$_POST['certificate_type_id'],
               'description' =>$_POST['description'],
                'description1' =>$_POST['description1'],
               'description2' =>$_POST['description2'],
               'description3' =>$_POST['description3'],
                'created'=>date('Y-m-d H:i:s'),
    );
    $this->Crud_model->SaveData('certificates',$data);
    $this->session->set_flashdata('message', 'Certificates created successfully');
    redirect("Certificates");
   
    
  }
  public function update($id)
   {
      $header = array('page_title'=>'AQUA'); 
     $insdustrydata = $this->Crud_model->get_single("certificates","id='".$id."'");
       $type = $this->Crud_model->GetData('certificate_type',"","status='Active'");
      $employee = $this->Crud_model->GetData('admin',"","status='Active'");

      $data = array(
                'heading' => 'Update Certificates',
                'subheading' => 'Update Certificates',
                'button' => 'Update',
                'button1'=>'Save & Print',
                'action' => site_url('Certificates/update_action/'.$id),

                'type'=>$type,
               'certificate_type_id' => $insdustrydata->certificate_type_id,
               'description' => $insdustrydata->description,
                'description1' => $insdustrydata->description1,
               'description2' => $insdustrydata->description2,
               'description3' => $insdustrydata->description3,
                'id' =>$id,
      );
     //print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('certificates/form',$data);
         
    }
  public function update_action($id)
    {
       $id=$_POST['id'];
          $data=array(
            
              'certificate_type_id' =>$_POST['certificate_type_id'],
              'description' =>$_POST['description'],
               'description1' =>$_POST['description1'],
               'description2' =>$_POST['description2'],
               'description3' =>$_POST['description3'],
               'modified'=>date('Y-m-d H:i:s'),
               'id'=>$_POST['id'],
    );
         
    $this->Crud_model->SaveData('certificates',$data,"id='".$id."'");
/*  }*/
    $this->session->set_flashdata('message', 'Certificates Updated successfully');
    redirect("Certificates");
   }

  public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("certificates",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

  public function delete()
    {
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('certificates',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
    }
   public function View($id)
    {  
      $getcustomerdata=$this->Certificates_model->view_certificate("j.id='".$id."'");
       if($getcustomerdata->title=='salary slip'){
        /*$header = array('page_title'=>'AQUA');*/
       // $insdustrydata = $this->Crud_model->get_single("customer","id='".$id."'");
        /*$getcustomerdata=$this->Certificates_model->view_certificate("j.id='".$id."'");
       
      
        $data =array(
                
                'certificate_type_id' => $getcustomerdata->title,
                'description' => $getcustomerdata->description,
       
      );*/
        $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('certificates/salary_slip');
        $this->load->view('common/footer'); 
}
else if($getcustomerdata->title=='experience letter')
{
    $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('certificates/experience');
        $this->load->view('common/footer'); 
 
}
else if($getcustomerdata->title=='Intent letter')
{
    $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('certificates/intent_certificate');
        $this->load->view('common/footer'); 
 
}
else if($getcustomerdata->title=='joining letter')
{
    $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('certificates/joining_letter');
        $this->load->view('common/footer'); 
 
}
else if($getcustomerdata->title=='relieving letter')
{
    $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('certificates/reliving_letter');
        $this->load->view('common/footer'); 
 
}
else if($getcustomerdata->title=='appointment letter')
{
    $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('certificates/appointment_letter');
        $this->load->view('common/footer'); 
 
}
else if($getcustomerdata->title=='acknowledgement letter')
{
    $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('certificates/acknowledgement_letter');
        $this->load->view('common/footer'); 
 
}
else if($getcustomerdata->title=='increment letter')
{
    $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('certificates/increment_letter');
        $this->load->view('common/footer'); 
 
}
else if($getcustomerdata->title=='offer letter')
{
    $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('certificates/offer_letter');
        $this->load->view('common/footer'); 
 
}
else if($getcustomerdata->title=='termination letter')
{
    $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('certificates/terminate_letter');
        $this->load->view('common/footer'); 
 
}
else if($getcustomerdata->title=='warning letter')
{
    $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('certificates/warning_letter');
        $this->load->view('common/footer'); 
 
}



    }

}
?>  