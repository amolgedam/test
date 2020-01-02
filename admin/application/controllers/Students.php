<?php 
defined('BASEPATH')  OR exit('No direct script are allowed');
 class Students extends CI_Controller {

    function __construct()
    {
      parent::__construct();    
      $this->load->database();
      $this->load->model('Students_model');
    }
    
    public function index($flag='')
    {
      $sub_heading=array(
        'page_title'=>'Manage Students'
      );
      $data=array(
       'header'=>'Manage Students',
       'action'=>site_url('Students/create'),
       'flag'=>$flag,
     );

      $this->load->view('common/header',$sub_heading);
      $this->load->view('common/left_panel');
      $this->load->view('student/list',$data);
      $this->load->view('common/footer');
      
    }

       public function ajax_manage_page($flag='')   
    {
        
         if($flag=='today')
            {
            $con="students.follop_date='".date('Y-m-d')."'";  
            }
             else
            {
                $con="1=1"; 
            }
    
        $GetData = $this->Students_model->get_datatables($con);

        if(empty($_POST['start']))
        {

          $no=0;
        }
       else
        {
             $no =$_POST['start'];
        }

        $data = array();        
        foreach ($GetData as $row) 
        {

            $btn = anchor(site_url('Students/update/'.$row->id),'<button title="Edit" class="btn btn-warning btn-circle btn-xs"><i class="fa fa-edit"></i></button>');  
            $btn.= '&nbsp|&nbsp'.anchor(site_url('Students/view/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash-o"></i></span>';      
            $status='';            
            
            if($row->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->id.'"  onClick="status('.$row->id.');" >'.$row->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$row->id.'"  onClick="status('.$row->id.');" >'.$row->status.'</span>';
            }


          if(strlen($row->remark) > 100)
          {

            $rmk = substr($row->remark,0,100).'---';
          }
          else
          {
            $rmk =$row->remark;
          }

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($row->name);
            $nestedData[] = $row->mobno;
            $nestedData[] = $row->altno;
            $nestedData[] = $row->aptdate;
            $nestedData[] = $row->apttime;
            // $nestedData[] = $img;
            $nestedData[] = $rmk;
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";;
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Students_model->count_all($con),
            "recordsFiltered" => $this->Students_model->count_filtered($con),
            "data" => $data,
            );      
        echo json_encode($output);
    }

    public function create(){
      $sub_heading=array('page_title'=>'Add Students');
      $data=array(
        'header'=>'Add Students',
        'sub_heading'=>'Add Students',
        'action'=>site_url('Students/create_action'),
        'name'=>set_value('name'),
        'mobno'=>set_value('mobno'),
        'altno'=>set_value('altno'),
        'aptdate'=>set_value('aptdate'),
        'apttime'=>set_value('apttime'),
        'follop_date'=>set_value('follop_date'),
        'remark'=>set_value('remark'),
        'id'=>set_value('id'),
        
        'button'=>"Create",
      );

      $this->load->view('common/header',$sub_heading);
      $this->load->view('common/left_panel');
      $this->load->view('student/form',$data);
      $this->load->view('common/footer');
      
    }

    public function create_action()
    {
       
        $data=array(

          'name'=>$_POST['name'],
          'mobno'=>$_POST['mobno'],
          'altno'=>$_POST['altno'],
          'aptdate'=>date('Y-m-d',strtotime($_POST['aptdate'])),
          'apttime'=>$_POST['apttime'],
          'remark'=>$_POST['remark'],
          'follop_date'=>date('Y-m-d',strtotime($_POST['follop_date'])),
        );

        $this->Crud_model->SaveData('students',$data);
        redirect('Students');
    }


    public function update($id)
    {
     $getEmployees = $this->Crud_model->get_single('students',"id='".$id."'");

        $data = array(
                      'header'=>'Update Student Information',
                      'button'=>'Update',
                      'action'=>site_url('Students/update_action/'.$id),
                      'name'=>$getEmployees->name,
                      'mobno'=>$getEmployees->mobno,
                      'altno'=>$getEmployees->altno,
                      'aptdate'=>$getEmployees->aptdate,
                      'apttime'=>$getEmployees->apttime,
                      'remark'=>$getEmployees->remark,          
                      'follop_date'=>$getEmployees->follop_date,          
                      'id' =>$id,
              );
          $this->load->view('common/header');
          $this->load->view('common/left_panel');
          $this->load->view('student/form',$data);
          $this->load->view('common/footer');

    }

    public function update_action($id)
    {
        $id = $this->input->post('id');   
        
    $data = array(
                    'name'=>$_POST['name'],
                    'mobno'=>$_POST['mobno'],
                    'altno'=>$_POST['altno'],
                    'aptdate'=>date('Y-m-d', strtotime($_POST['aptdate'])),
                    'apttime'=>$_POST['apttime'],
                    'remark'=>$_POST['remark'],
                    'follop_date'=>date('Y-m-d',strtotime($_POST['follop_date'])),
                   // 'id'=>$id,                           
                    'modified'=>date('Y-m-d H:i:s'),
            );
 
        $con = "id='".$id."'";
        $this->Crud_model->SaveData('students',$data,$con);
        $this->session->set_flashdata('message','Student information  updated successfully');
        redirect(site_url('Students'));
    }

        public function delete()
        {
            if(isset($_POST['id']))
            {
     $this->Crud_model->DeleteData("students","id='".$_POST['id']."'");exit();
            }
        }

  

    public function view($id)
    {
       $getEmployees = $this->Crud_model->get_single('students',"id='".$id."'");
        if(!empty($getEmployees->follop_date)=='0000-00-00')
        {
          $follop_date="N/A";
        }
        else{
          $follop_date=date('d-m-Y',strtotime($getEmployees->follop_date));
        }
        $data = array(
                      'header'=>'Appear Sudent Information',
                      'button'=>'view',
                      'name'=>$getEmployees->name,
                      'mobno'=>$getEmployees->mobno,
                      'altno'=>$getEmployees->altno,
                      'aptdate'=>$getEmployees->aptdate,
                      'apttime'=>$getEmployees->apttime,
                      'remark'=>$getEmployees->remark,
                      'follop_date'=>$getEmployees->follop_date,
                    
            );
        
        $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('student/view',$data);
        $this->load->view('common/footer');

    }

    public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("students",$_POST,"id='" .$_POST['id']."'");
            exit;
        }
    }

  }
?>


  
  