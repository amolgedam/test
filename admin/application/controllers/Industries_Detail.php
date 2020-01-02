<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Industries_Detail extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Industries_Detail_model');
       
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Industries',
        'createAction'=>site_url('Industries_Detail/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('industries_Detail/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Industries_Detail_model->get_datatables();
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            $btn = anchor(site_url('Industries_Detail/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Industries_Detail/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            if (strlen($row->description)>100) 
            {
              $description=substr($row->description,0,100).'...';
            }
            else{
              $description=$row->description;
            }

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $row->heading;
            $nestedData[] = $description;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Industries_Detail_model->count_all(),
                    "recordsFiltered" => $this->Industries_Detail_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {
    $header = array('page_title'=>'WPES'); 
    $titleData = $this->Crud_model->GetData('industries',"*","status='Active'");
   // print_r($titleData);exit;
    $data = array(
      'heading'=>'Add Industries',
      'subheading'=>'Create Industries',
      'button'=>'Create',
              'action'=>site_url('Industries_Detail/create_action'),
              'industry_type' =>set_value('industry_type'),
              'heading' =>set_value('heading'),
              'image' =>set_value('image'),
              'description' =>set_value('description'),
              'id' =>set_value('id'),
              'titleData' =>$titleData,
    );
   // print_r($data);exit;
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('industries_Detail/form',$data);
       
  }

  public function create_action()
  {
    
    $id = '0';
    $this->_rules($id);
    if($this->form_validation->run() == FALSE) 
    {  
      $this->create();
    } 
    else
    {  
      
      $data=array(
        'industry_type' => $_POST['type'],
        'industries_id' => $_POST['title'],
        'heading' => $_POST['heading'],
      
        'description' => $_POST['description'],
        'created'=>date('Y-m-d H:i:s'),
      );
      $this->Crud_model->SaveData('industries_detail',$data);

      $last_id=$this->db->insert_id();

      $count=count(array_filter($_FILES['image']['name']));

      for ($j=0; $j < $count; $j++) 
      { 
         if($_FILES['image']['name'][$j]!='')
        {  
             $src = $_FILES['image']['tmp_name'][$j];
              $filEnc = time();
              $avatar= rand(0000,9999)."_".$_FILES['image']['name'][$j];
              $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
              $dest =getcwd().'/uploads/industries/'.$avatar1;
            
            if(move_uploaded_file($src,$dest))
            {
                    $image  = $avatar1;                
            }
        }
        else
        {
            $image  =""; 
        }

        $log = array(
          'industries_detail_id' =>$last_id, 
          'image' =>$image, 
        );

        $this->Crud_model->SaveData('industries_images',$log);
      }



      $this->session->set_flashdata('message', 'Industries Details created successfully');
      redirect("Industries_Detail");
    }
  }
  public function update($id)
   {
      $header = array('page_title'=>'WPES');
      $insdustrydata = $this->Crud_model->get_single("industries_detail","id='".$id."'");
      $titleData = $this->Crud_model->GetData('industries',"title,id","id ='".$insdustrydata->industries_id."' and status='Active'","","","","1"); 
      $imageData = $this->Crud_model->GetData('industries_images',"image,id","industries_detail_id ='".$insdustrydata->id."'","","","","");
      $data = array(
                'heading' => 'Update Industries',
                'subheading' => 'Update Industries',
                'button' => 'Update',
                'action' => site_url('Industries_Detail/update_action/'.$id),
                'industry_type' => $insdustrydata->industry_type,
                'title' => $insdustrydata->industries_id,
                'heading' => $insdustrydata->heading,
                'description' => $insdustrydata->description,
                'image' => $imageData,
                //'description' => $insdustrydata->image,
                'id' =>$id,
                'titleData' =>$titleData->title,
                'titleDataid' =>$titleData->id,
      );
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('industries_Detail/form',$data);
         
    }
  public function update_action($id)
  {
      $id=$id;
      $this->_rules($id);
    if ($this->form_validation->run() == FALSE)
    {          
      $this->update($id);
    }
    else 
    {  
      $imageData = $this->Crud_model->GetData('industries_images',"id,image,industries_detail_id","industries_detail_id ='".$insdustrydata->id."'","","","","");
      $data=array(
          'industry_type'=>$_POST['type'],
          'industries_id'=>$_POST['title'],
          'heading'=>$_POST['heading'],
          'description'=>$_POST['description'],
          'image'=>$imageData,
          'modified'=>date('Y-m-d H:i:s'),
      );
      //print_r($data);exit;
      $this->Crud_model->SaveData('industries_detail',$data,"id='".$id."'");
      $last_id = $id;
      //print_r($last_id);exit;
      $count=count(array_filter($_FILES['image']['name']));

      for ($j=0; $j < $count; $j++) 
      { 
         if($_FILES['image']['name'][$j]!='')
        {  
             $src = $_FILES['image']['tmp_name'][$j];
              $filEnc = time();
              $avatar= rand(0000,9999)."_".$_FILES['image']['name'][$j];
              $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
              $dest =getcwd().'/uploads/industries/'.$avatar1;
            
            if(move_uploaded_file($src,$dest))
            {
                    $image  = $avatar1;                
            }
        }
        else
        {
            $image  =""; 
        }

        $log = array(
          'industries_detail_id' =>$last_id, 
          'image' =>$image, 
        );

        $this->Crud_model->SaveData('industries_images',$log);
      }
      $this->session->set_flashdata('message', 'Industries Details updated successfully');
      redirect("Industries_Detail");
    }
  }


      public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("industries_detail",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
      $data=$this->Crud_model->GetData('industries_images','image,id',"industries_detail_id='".$_POST['cid']."'","","","","");
      foreach ($data as $row) 
      {
        unlink('uploads/industries/'.$row->image);
        $this->Common_model->delete('industries_images',"id='".$row->id."'");
      }
      
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('industries_detail',"id='".$_POST['cid']."'");
           
        }
    }
    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $insdustrydata = $this->Crud_model->get_single("industries_detail","id='".$id."'");
        $titleData = $this->Crud_model->GetData('industries',"title","id ='".$insdustrydata->industries_id."' and status='Active'","","","","1");
        $imageData = $this->Crud_model->GetData('industries_images',"id,image,industries_detail_id","industries_detail_id ='".$insdustrydata->id."'","","","","");
         if ($insdustrydata->industry_type=='Product_Engineering') 
          {
              $pp='Product Engineering';
          }
          else
          {
              $pp=$insdustrydata->industry_type;
          }
        $data =array(
          'type'=>$pp,
          'heading'=>$insdustrydata->heading,
          'titleData'=>$titleData->title,
          'image'=>$imageData,
          'description'=>$insdustrydata->description,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('industries_Detail/view',$data);
        $this->load->view('common/footer');
    }
        
   public function get_type()
    {                      
        $id = $this->input->post('id');
        $data = $this->Crud_model->GetData('industries',"*","status='Active' and type = '".$id."'");
        $html = "<option value=''>Select title</option>";
        foreach ($data as $row_data) 
        {
            $html .= "<br><option value='".$row_data->id."'>".ucfirst($row_data->title)."</option>";
        }
        echo $html;
    }
    
 public function _rules($id) 
    {   

      $cond = "heading='".$this->input->post('heading',TRUE)."' and id!='".$id."'";
      $row = $this->Crud_model->GetData("industries_detail","", $cond);
      $count = count($row);
      if($count==0) 
      {
          $is_unique = "";
      }
      else 
      {
          $is_unique = "|is_unique[industries_detail.heading]";

      }
        $this->form_validation->set_rules('heading', 'heading is', 'trim|required'.$is_unique,
        array(
                'required'=> 'Please enter %s.',
                'is_unique'=>'This %s already exist'
            ));
        
    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
}

    public function img_delete()
    {
      $data=$this->Crud_model->GetData('industries_images','image',"id='".$_POST['cid']."'","","","","1");
      if(!empty($data->image)){
         unlink('uploads/industries/'.$data->image);
      }
        if(isset($_POST['cid']))
        {
            $this->Common_model->delete('industries_images',"id='".$_POST['cid']."'"); 
        }
    }
}
?>