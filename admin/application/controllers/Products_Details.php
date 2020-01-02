<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Products_Details extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('Products_Details_model');
     $this->load->model('Crud_model');  
     $this->load->model('Common_model');
    }
    public function index()
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'Products Details',
        'createAction'=>site_url('Products_Details/create'),
        
    );
    //print_r($data);exit;

    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('products/products_details/list',$data);
    $this->load->view('common/footer'); 
  }
  public function ajax_manage_page(){
        $getAllData = $this->Products_Details_model->get_datatables();
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

            $btn = anchor(site_url('Products_Details/View/'.$row->id),'<button title="View" class="btn btn-info btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.anchor(site_url('Products_Details/update/'.$row->id),'<button title="Edit" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
           
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
            $nestedData[] = $row->product_type;
          /*  $nestedData[] = $row->product_title;*/
            $nestedData[] = $row->heading;
            /*$nestedData[] = $description;*/
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Products_Details_model->count_all(),
                    "recordsFiltered" => $this->Products_Details_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
 public function create()
 {
    $header = array('page_title'=>'WPES'); 
    $product_title = $this->Crud_model->GetData('product',"*","status='Active'");
    
    $data = array(
      'heading'=>'Add Products Details',
      'subheading'=>'Create Products Details',
      'button'=>'Create',
              'action'=>site_url('Products_Details/create_action'),
              'product_type' =>set_value('product_type'),
              'heading' =>set_value('heading'),
              'image' =>set_value('image'),
              'description' =>set_value('description'),
              'id' =>set_value('id'),
              'product_title' =>$product_title,
    );
  
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('products/products_details/form',$data);
       
  }

  public function create_action()
  {
    
    $id = '0';
    $this->_rules($id);
    if($this->form_validation->run() == FALSE) 
    {  
      $this->create($id);
    } 
    else
    {  
      

      $data=array(
        'product_type' => $_POST['product_type'],
        'product_title' => $_POST['product_title'],
        'heading' => $_POST['heading'],
      
        'description' => $_POST['description'],
        //'created'=>date('Y-m-d H:i:s'),
      );
      $this->Crud_model->SaveData('products_details',$data);

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
              $dest =getcwd().'/uploads/products/'.$avatar1;
            
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
          'product_detail_id' =>$last_id, 
          'image' =>$image, 
        );

        $this->Crud_model->SaveData('product_image',$log);
      }

      
      $this->session->set_flashdata('message', 'Product Details created successfully');
      redirect("Products_Details");
    }
  }
  public function update($id)
   {
      $header = array('page_title'=>'WPES');
      $update_data = $this->Crud_model->get_single("products_details","id='".$id."'");

    
      $product = $this->Crud_model->GetData('product',"product_title,id","product_type ='".$update_data->product_type."' and status='Active'","","","",""); 

      $product_img = $this->Crud_model->GetData('product_image',"product_detail_id,image,id","product_detail_id ='".$update_data->id."'","","","",""); 


    //print_r($product_img);exit;
      $data = array(
                'heading' => 'Update Products Details ',
                'subheading' => 'Update Products Details',
                'button' => 'Update',
                'action' => site_url('Products_Details/update_action/'.$id),
                'product_type' => $update_data->product_type,
               // 'product_title' => $update_data->product_title,
                'heading' => $update_data->heading,
                'product_title' => $update_data->product_title,
                'image' => $update_data->image,
                'update_data' => $update_data->image,
                'id' =>$id,
                'product' =>$product,
                'description' =>$update_data->description,
                'product_img' =>$product_img,
            
      );
     // print_r($data);exit;
      $this->load->view('common/header',$header);
      $this->load->view('common/left_panel');
      $this->load->view('products/products_details/form',$data);
         
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
    
    /*if( $_FILES['image']['name']!='' )
    {
      $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
      $config2['image_library'] = 'gd2';
      $config2['source_image'] =  $_FILES['image']['tmp_name'];
      $config2['new_image'] =   getcwd().'/uploads/products/'.$_POST['image'];
      $config2['upload_path'] =  getcwd().'/uploads/products/';
      $config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
      $config2['maintain_ratio'] = FALSE;

      $this->image_lib->initialize($config2);

      if(!$this->image_lib->resize())
      {
        echo('<pre>');
        echo ($this->image_lib->display_errors());
        exit;
      }
      unlink('uploads/products/'.$_POST['old_image']);
      $image  = $_POST['image'];
    }
    else
    {
      $image  =$_POST['old_image'];
    }

  }*/

      $data=array(
          'product_type'=>$_POST['product_type'],
          'product_title'=>$_POST['product_title'],
          'heading'=>$_POST['heading'],
          'description'=>$_POST['description'],
          //'image'=>$image,
        //  'modified'=>date('Y-m-d H:i:s'),
      );
      
      $this->Crud_model->SaveData('products_details',$data,"id='".$id."'");

     $last_id=$id;
    
     
      $count=count(array_filter($_FILES['image']['name']));

      for ($j=0; $j < $count; $j++) 
      { 
         if($_FILES['image']['name'][$j]!='')
        {  
             $src = $_FILES['image']['tmp_name'][$j];
              $filEnc = time();
              $avatar= rand(0000,9999)."_".$_FILES['image']['name'][$j];
              $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
              $dest =getcwd().'/uploads/products/'.$avatar1;
            
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
          'product_detail_id' =>$last_id, 
          'image' =>$image, 
        );

        $this->Crud_model->SaveData('product_image',$log);
      }


      $this->session->set_flashdata('message', 'Products Details updated successfully');
      redirect("Products_Details");
    }
    }

   public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("products_details",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

    public function delete()
    {
      $data=$this->Crud_model->GetData('products_details','image',"id='".$_POST['cid']."'","","","","1");
      if(!empty($data->image)){
         unlink('uploads/products/'.$data->image);
      }
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('products_details',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
    }

 public function delete_img()
    {
      $data=$this->Crud_model->GetData('product_image','product_detail_id','image',"id='".$_POST['id']."'","","","","1");
      if(!empty($data->image)){
         unlink('uploads/products/'.$data->image);
      }
        if(isset($_POST['id']))
        {
           $this->Common_model->delete('product_image',"id='".$_POST['id']."'");
           $this->db->last_query();exit;
           exit;
        }
    }

    public function View($id)
    {  
        $header = array('page_title'=>'WPES');
        $retail_data = $this->Crud_model->get_single("products_details","id='".$id."'");
        $product_title = $this->Crud_model->GetData('product',"product_title","id ='".$retail_data->product_title."' and status='Active'","","","","1");
         $product_img = $this->Crud_model->GetData('product_image',"product_detail_id,image,id","product_detail_id ='".$retail_data->id."'","","","","");

         if ($retail_data->product_type=='Retail_Management') 
          {
              $pp='Retail Management';
          }
          else
          {
              $pp=$retail_data->product_type;
          }
         // print_r($retail_data->image);exit;
        $data =array(
          'product_type'=>$pp,
          'heading'=>$retail_data->heading,
          'product_title'=>$product_title->product_title,
          'image'=>$retail_data->image,
          'description'=>$retail_data->description,
          'product_img'=>$product_img,
         
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('products/products_details/view',$data);
        $this->load->view('common/footer');
    }
        
   public function get_type()
    {                      
        $id = $this->input->post('id');
        $data = $this->Crud_model->GetData('product',"*","status='Active' and product_type = '".$id."'");
        $html = "<option value=''>Select title</option>";
        foreach ($data as $row_data) 
        {
            $html .= "<br><option value='".$row_data->id."'>".ucfirst($row_data->product_title)."</option>";
        }
        echo $html;
    }
 public function _rules($id) 
    {   

      $cond = "heading='".$this->input->post('heading',TRUE)."' and id!='".$id."'";
      $row = $this->Crud_model->GetData("products_details","", $cond);
      $count = count($row);
      if($count==0) 
      {
          $is_unique = "";
      }
      else 
      {
          $is_unique = "|is_unique[products_details.heading]";

      }
        $this->form_validation->set_rules('heading', 'heading is', 'trim|required'.$is_unique,
        array(
                'required'=> 'Please enter %s.',
                'is_unique'=>'This %s already exist'
            ));
        
    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
}

}
?>