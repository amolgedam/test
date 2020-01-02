<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_Category extends CI_Controller {

	function __construct()
   	{
		parent::__construct();		
		$this->load->database();
        $this->load->model('Sub_Category_model');
        $this->load->model('Common_model');
        $this->load->database();
        
   	}
	public function index()
	{
		$cat = $this->Crud_model->GetData('categories','','status="Active"');
		$data = array(
				// 'create_action' => site_url('Executive/create'),
				'header' => 'Manage Sub Category',
				'header1' => 'Manage Sub Category',
				'category'=>$cat,
				 );
		$this->load->view('subCategory/list',$data);
	}

	public function ajax_manage_page()
    {
        $subCategory = $this->Sub_Category_model->get_datatables();
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($subCategory as $subcategories) 
        {
        
            $btn = ''.'<span title="Edit" class="btn btn-primary btn-circle btn-xs" data-toggle="modal" data-target="#editModal" onclick="getValue('.$subcategories->id.')" data-placement="right" title="Edit"><i class="fa fa-edit"></i></span>';  
                    
            $btn .= '&nbsp;|&nbsp;'.''.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$subcategories->id.')"><i class="fa fa-trash-o"></i></span>';

             $status='';            
            if($subcategories->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$subcategories->id.'"  onClick="statuss('.$subcategories->id.');" >'.$subcategories->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$subcategories->id.'"  onClick="statuss('.$subcategories->id.');" >'.$subcategories->status.'</span>';
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($subcategories->category_name);
            $nestedData[] = ucwords($subcategories->subCategory_name);
            $nestedData[] = $status."<input type='hidden' id='status".$subcategories->id."' value='".$subcategories->status."' />";    
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Sub_Category_model->count_all(),
                    "recordsFiltered" => $this->Sub_Category_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }


	public function create_subcategory()
	{
	    $subcat_data=$this->Common_model->get_single_record('subcategory',"subCategory_name='".$_POST['subcat_name']."'");
	    if(empty($subcat_data))
	    {
	      $data=array(
	      			'category_id'=>$_POST['category_id'],
	      			'subCategory_name'=>$_POST['subcat_name'],
	      );
	      $this->Common_model->SaveData('subcategory',$data);
	      $this->session->set_flashdata('message', 'Sub-Category created successfully');
	      echo "1";exit;
	    }
	    else
	    {
	      echo "0";exit;
	    }
	}
         
	public function get_subcategory()
	{
		$subcat_data=$this->Sub_Category_model->getcategory("sc.id='".$_POST['id']."'");
		$data=array(
			'subcat_id'=>$subcat_data->id,
			'subcat_name'=>$subcat_data->subCategory_name,
			'cat_id'=>$subcat_data->category_id,
		);
		echo json_encode($data);exit;
	}

	public function update_subcategory()
	{
		$subcat_data=$this->Common_model->get_single_record('subcategory',"subCategory_name='".$_POST['subcat_name']."' and id!='".$_POST['subcat_id']."'");
	    if(empty($subcat_data))
	    {
	      $data=array(
	      'subCategory_name'=>$_POST['subcat_name'],
	      'category_id'=>$_POST['category_id'],
	      );
	      $this->Common_model->SaveData('subcategory',$data,"id='".$_POST['subcat_id']."'");
	      $this->session->set_flashdata('message', 'Sub-Category created successfully');
	      echo "1";exit;
	    }
	    else
	    {
	      echo "0";exit;
	    }
	}

	
	public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("subcategory",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

   

    public function delete()
    {
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('subcategory',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
        }
    }
 
}?>