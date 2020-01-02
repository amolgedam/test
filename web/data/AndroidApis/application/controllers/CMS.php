<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CMS extends CI_Controller
{
	function __construct()
   	 {
		parent::__construct();
		/*keep this code for load database*/
        $this->load->model('Cms_contents_model');
		$this->load->model('Common_model');
        $this->load->library(array('session','form_validation','image_lib'));
        /*keep this code for form data and load css and js or external page*/
        $this->load->helper(array('form', 'url', 'html'));
		$this->load->database();
   	 }

//function for list page develop by komal kurve
    public function index()
    {
        $breadcrum="<ol class='breadcrumb'>
                <li><a href='".site_url('Login/dashboard/index')."'><i class='fa fa-dashboard'></i>Dashboard</a></li>
                <li class='active'>Manage CMS</li>
                </ol>";

        $data=array('breadcrum' => $breadcrum,'title'=>'Manage CMS',
            'sub_title'=>'Manage CMS',
              'changeAction'=>site_url('CMS/change_status'),
            'deleteAction'=>site_url('CMS/delete'),
            );
        $this->load->view('cms/cms_contents_list',$data);
    }

  public function ajax_list()
    {
        $all_data = $this->Cms_contents_model->get_datatables('cms_contents');
        //print_r($this->db->last_query());exit;
        $data = array();
        $totalRecords = count($all_data);
        $no = $_POST['start'];

        foreach ($all_data as $row)
         {

            if(strlen($row->description)>100)
            {
                $desc=substr($row->description,0,100).'.......';
            }
            else
            {
                $desc=$row->description;
            }
                
                $btn='';
              
                $btn = anchor(site_url('CMS/read/'.$row->id),'<button title="View" class="btn btn-info btn-circle btn-xs"><i class="fa fa-eye"></i></button>');
            $btn .= '&nbsp;|&nbsp;'.anchor(site_url('CMS/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');     
                
              
     
      /*if($row->status=='Active')
            {
                $status =  "<a href='#checkStatus' data-toggle='modal' class='label-success label' style='border-radius:0.15em !important;font-size:100% !important' onclick='checkStatus(".$row->id.")'> Active </a>";            
            }
            else
            {
                $status =  "<a href='#checkStatus' data-toggle='modal'  class='label-danger label' style='border-radius:0.15em !important;font-size:100% !important' onclick='checkStatus(".$row->id.")'> Inactive </a>";
            }*/

            

            if(!empty($row->image))
          {

            if(!file_exists("uploads/cms_images/".$row->image))
            { 
            $img ='<img height="100px" width="100px"  class="img-thumbnail img-responsive" src="'.base_url('uploads/no_image.png').'">';
            }
            else
            {
               

                 $img ='<a href="'.base_url('uploads/cms_images/'.$row->image).'" data-lightbox="roadtrip"><img height="100px" width="100px" class="img-thumbnail img-responsive" src="'.base_url('uploads/cms_images/'.$row->image).'" style="height:100px;width:100px"></a>';
            }
          }
          else
          {
            $img ='<img height="100px" width="100px" class="img-thumbnail img-responsive" src="'.base_url('uploads/no_image.png').'">';
          }

            $status='';            
            if($row->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }
            $no ++;
           $nestedData=array();
             $nestedData[] = $no;
                $nestedData[] = ucfirst($row->title);
                $nestedData[] = ucfirst($row->display_name);
                $nestedData[] = $img;
                $nestedData[] = ucfirst($desc);
                $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
                $nestedData[] = $btn;
                $data[] = $nestedData;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Cms_contents_model->count_all('cms_contents'),
                        "recordsFiltered" => $this->Cms_contents_model->count_filtered('cms_contents'),
                        "data" => $data,
                );

        //output to json format
        echo json_encode($output);
    }

    public function update($id) 
    {
        $row = $this->Cms_contents_model->get_by_id($id);
		$cms_types = $this->Common_model->GetData("cms_types",'',"status='Active'");   
       
        if ($row) {
            $breadcrum="<ol class='breadcrumb'>
                 <li><a href='".site_url('Login/dashboard/index')."'><i class='fa fa-dashboard'></i>Dashboard</a></li>
                <li><a href='".site_url('CMS/index')."'>Manage CMS</a></li>
                <li class='active'>Update CMS</li>
            </ol>";
            $data = array(
                 'title1'=>'Update CMS',
                 'sub_title'=>'Update CMS',
                'breadcrum' =>$breadcrum,
                'button' => 'Update',
                'action' => site_url('CMS/update_action/'.$id),
                'id' => set_value('id', $row->id),
                'cms_type' => set_value('cms_type', $row->cms_type),
                'cms_types' =>$cms_types,
                'type' => set_value('type', $row->type),
                'title' => set_value('title', $row->title),
                'description' => set_value('description', $row->description),
                'image' => set_value('image', $row->image)
            );
            $this->load->view('cms/cms_contents_form', $data);
        }
        else 
        {
           /* $this->session->set_flashdata('message', '<div class="alert alert-block alert-success text-center" style="margin-bottom:0px;"><p>Record not found</p></div>');*/
            $this->session->set_flashdata('message','Record not found');

            redirect(site_url('CMS/index'));
        }
    }
    
   public function update_action($id)
    {
    	$this->_rules($id);
        if ($this->form_validation->run() == FALSE) 
        {
            $this->update($id);
        } 
        else 
        {
            //print_r($_POST);exit;
            if( $_FILES['image']['name']!='' )
            {
                $_POST['image']= rand(0000,9999)."_".$_FILES['image']['name'];
                $config2['image_library'] = 'gd2';
                $config2['source_image'] =  $_FILES['image']['tmp_name'];
                $config2['new_image'] =   getcwd().'/uploads/cms_images/'.$_POST['image'];
                $config2['upload_path'] =  getcwd().'/uploads/cms_images/';
                $config2['allowed_types'] = 'JPG|PNG|jpg|png';
                $config2['maintain_ratio'] = FALSE;
                $config2['width'] = "260";
                $config2['height'] = "220";
                $this->image_lib->initialize($config2);
              
                if(!$this->image_lib->resize())
                {
                    echo('<pre>');
                    echo ($this->image_lib->display_errors());
                    exit;
                }
              
                $image  = $_POST['image'];
                        
                unlink("uploads/cms_images/".$_POST['old_image']);
                        
                $data = array(
                    'image'=>$image,
                    'cms_type' => $this->input->post('cms_type',TRUE),
                    'title' => $this->input->post('title',TRUE),
                    'description' => $this->input->post('description',TRUE),
                    'modified_by'=>$_SESSION[SESSION_NAME]['id'],
                    'modified'=>date('Y-m-d H:i:s')
                    );
                        $this->Common_model->SaveData('cms_contents',$data,"id='".$id."'");
                        /*$this->session->set_flashdata('message', '<div class="alert alert-block alert-success text-center" style="margin-bottom:0px;"><p>Record has been updated successfully</p></div>');*/
                        $this->session->set_flashdata('message','Record has been updated successfully');
                        redirect(site_url('CMS/index'));
            }
            else
            {
                $image = ""; 
                $data = array(
                        'image'=>$this->input->post('old_image',TRUE),
                        'cms_type'=> $this->input->post('cms_type',TRUE),
                        //'type'=> $this->input->post('type',TRUE),
                        'title'=> $this->input->post('title',TRUE),
                        'description'=> $this->input->post('description',TRUE),
                        'modified_by'=>$_SESSION[SESSION_NAME]['id'],
                        'modified'=>date('Y-m-d H:i:s')
                        );
                         //print_r($data);exit;    
                        $this->Common_model->SaveData('cms_contents',$data,"id='".$id."'");
                        /*$this->session->set_flashdata('message', '<div class="alert alert-block alert-success text-center" style="margin-bottom:0px;"><p>Record has been updated successfully</p></div>');*/
                         $this->session->set_flashdata('message','CMS has been updated successfully');
                        redirect(site_url('CMS/index'));
            }   
            
        }
    }
    public function read($id){
       
         $breadcrum="<ol class='breadcrumb'>
                 <li><a href='".site_url('Login/dashboard/index')."'><i class='fa fa-dashboard'></i>Dashboard</a></li>
                <li><a href='".site_url('CMS/index')."'>Manage CMS</a></li>
                <li class='active'>View CMS</li>
            </ol>";

        $con="cms_contents.id='".$id."'";
        $row=$this->Cms_contents_model->viewCms($con);
        //print_r($this->db->last_query());exit;
        
       // $row=$row[0];
        $data = array(
            'title1'=>'View CMS',
            'sub_title'=>'View CMS',
           'breadcrum' =>$breadcrum,
            'title' =>ucfirst($row->title),
            'display_name' =>ucfirst($row->display_name),
            'description' =>$row->description,
            //'row'=>$row
            );
        $this->load->view('cms/cms_contents_read',$data);
    }

    public function change_status()
    {
        $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
        if(isset($_POST['statusupdate']))
        {
            $this->Common_model->SaveData('cms_contents',$_POST,"id='".$_POST['id']."'");exit;
        }
        
    }


  /* public function change_status()
  {

        $getData = $this->Crud_model->get_single('cms_contents',"id='".$_POST['id']."'");
        if($getData->status == 'Active')
        {
            $data = array('status' => 'Inactive',
                'modified_by'=>$_SESSION[SESSION_NAME]['emp_id'],
                );
        }
        else
        {
            $data = array('status' => 'Active',
                'modified_by'=>$_SESSION[SESSION_NAME]['emp_id'],
                );
        }
        $this->Common_model->SaveData('cms_contents',$data,'id="'.$_POST['id'].'"');
        $this->session->set_flashdata('message','Status changed successfully');
        redirect('CMS/index');
  }*/ 
    public function _rules($id) 
    {
        $table = 'cms_contents';
        $cond ="title='".$this->input->post('title',TRUE)."' and cms_type = '".$this->input->post('cms_type',TRUE)."' and type = '".$this->input->post('type',TRUE)."' and id!='".$id."'";
        $row =$this->Common_model->GetData($table,'',$cond);   
       
        $count = count($row); 
        if($count==0)
        {
            $is_unique = "";
        }
        else 
        {
             $is_unique = "";
        }
       
        $this->form_validation->set_rules('title', 'title', 'trim|required'.$is_unique,
        array(
                'required'      => 'Please enter %s',
                'regex_match'   =>'Please enter valid %s',
                'is_unique'     => 'This %s already exists',
                
            ));
        $this->form_validation->set_rules('cms_type', 'cms type', 'trim|required',
        array(
            'required'      => 'Please select  %s', 
        ));
       /* $this->form_validation->set_rules('type', 'for', 'trim|required',
        array(
            'required'      => 'Please select  %s', 
        ));*/


     $this->form_validation->set_rules('description', ' description', 'trim|required',
        array(
            'required'      => 'Please enter  %s', 
        ));



        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}