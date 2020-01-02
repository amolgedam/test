<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct()
   	{
		parent::__construct();		
		$this->load->database();
        $this->load->model('Category_model');
        $this->load->model('Common_model');
        $this->load->database();
        
   	}
	public function index()
	{
		$data = array(
				'create_action' => site_url('Executive/create'),
				'header' => 'Manage Executives',
				'header1' => 'Manage Executives',
				 );
		$this->load->view('category/list',$data);
	}

	public function ajax_manage_page()
    {
        $Category = $this->Category_model->get_datatables();
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($Category as $categories) 
        {
        
            $btn = ''.'<span title="Edit" class="btn btn-primary btn-circle btn-xs" data-toggle="modal" data-target="#editModal" onclick="getValue('.$categories->id.')" data-placement="right" title="Edit"><i class="fa fa-edit"></i></span>';  
                    
            $btn .= '&nbsp;|&nbsp;'.''.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$categories->id.')"><i class="fa fa-trash-o"></i></span>';

             $status='';            
            if($categories->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$categories->id.'"  onClick="statuss('.$categories->id.');" >'.$categories->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$categories->id.'"  onClick="statuss('.$categories->id.');" >'.$categories->status.'</span>';
            }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($categories->category_name);
            $nestedData[] = $status."<input type='hidden' id='status".$categories->id."' value='".$categories->status."' />";    
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Category_model->count_all(),
                    "recordsFiltered" => $this->Category_model->count_filtered(),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }


	public function create_category()
	{
	    $cat_data=$this->Common_model->get_single_record('categories',"category_name='".$_POST['cat_name']."'");
	    if(empty($cat_data))
	    {
	      $data=array(
	      'category_name'=>$_POST['cat_name'],
	      );
	      $this->Common_model->SaveData('categories',$data);
	      $this->session->set_flashdata('message', 'Category created successfully');
	      echo "1";exit;
	    }
	    else
	    {
	      echo "0";exit;
	    }
	}
         
	public function get_category()
	{
		$cat_data=$this->Common_model->get_single_record('categories',"id='".$_POST['id']."'");
		$data=array(
			'cat_id'=>$cat_data->id,
			'cat_name'=>$cat_data->category_name,
		);
		echo json_encode($data);exit;
	}

	public function update_category()
	{
		$cat_data=$this->Common_model->get_single_record('categories',"category_name='".$_POST['cat_name']."' and id!='".$_POST['cat_id']."'");
	    if(empty($cat_data))
	    {
	      $data=array(
	      'category_name'=>$_POST['cat_name'],
	      );
	      $this->Common_model->SaveData('categories',$data,"id='".$_POST['cat_id']."'");
	      $this->session->set_flashdata('message', 'Category created successfully');
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
            $this->Crud_model->SaveData("categories",$_POST,"id='".$_POST['id']."'");exit;
        }
    }

   

    public function delete()
    {
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('categories',"id='".$_POST['cid']."'");
           $this->db->last_query();exit;
           exit;
        }
    }
 
}?>