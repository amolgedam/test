<?php 
defined('BASEPATH')  OR exit('No direct script are allowed');
 class Taskassign extends CI_Controller {

    function __construct()
    {
      parent::__construct();    
      $this->load->database();
      $this->load->model('Taskassign_model');
    }
    
    public function index($flag='')
    {
      $sub_heading=array(
        'page_title'=>'Tasks Assign'
      );
      $data=array(
       'header'=>'Tasks Assign',  
       'action'=>site_url('Taskassign/create'),
       'flag'=>$flag,
     );

      $this->load->view('common/header',$sub_heading);
      $this->load->view('common/left_panel');
      $this->load->view('taskassign/list',$data);
      $this->load->view('common/footer');
      
    }

    public function ajax_manage_page($flag='')   
    {
        //$cond='';
      if($_SESSION['SESSION_NAME']['designation']=='PHP DEVELOPER')
        {
            if($flag=='today_task')
            {
            $cond ="t.emp_id='".$_SESSION['SESSION_NAME']['id']."' and t.date='".date('Y-m-d')."'";  
            }
            else
            {
                $cond="1=1"; 
            }
             
    }
    else{
      if($flag=='today_task')
            {
            $cond ="t.date='".date('Y-m-d')."'";  
            }
            else
            {
                $cond="1=1"; 
            }
    }

        $get_task = $this->Taskassign_model->get_datatables($cond);


        if(empty($_POST['start']))
        {

          $no=0;
        }
       else
        {
             $no =$_POST['start'];
        }

        $data = array();        
        foreach ($get_task as $row) 
        {

            $btn = anchor(site_url('Taskassign/update/'.$row->id),'<button title="Edit" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
            
           $btn.= '&nbsp|&nbsp'.anchor(site_url('Taskassign/view/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');
            
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash-o"></i></span>';      
            $status='';            
            
             if($row->task_status=='Pending')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->mul_id.'"  onClick="status('.$row->mul_id.');" >'.$row->task_status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$row->mul_id.'"  onClick="status('.$row->mul_id.');" >'.$row->task_status.'</span>';
            }


          /*if(strlen($row->description) > 200)
          {

            $desc = substr($row->description,0,200).'---';
          }
          else
          {
            $desc =$row->description;
          }*/
             if($row->date=='0000-00-00')
          {

            $date = "N/A";
          }
          else
          {
            $date =date('d-m-Y',strtotime($row->date));
          }
            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = ucwords($row->name);
            $nestedData[] = $date;
            $nestedData[] = ucwords($row->tasks);
            $nestedData[] = $status."<input type='hidden' id='status".$row->mul_id."' value='".$row->task_status."' />";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Taskassign_model->count_all($cond),
            "recordsFiltered" => $this->Taskassign_model->count_filtered($cond),
            "data" => $data,
            );      
        echo json_encode($output);
    }

    public function create()
    {
      $get_employee = $this->Crud_model->GetData('admin','',"status='Active' and designation_id='8'");

      $sub_heading=array('page_title'=>'Add Tasks');
      $data=array(
        'header'=>'Assign Tasks',
        'sub_heading'=>'Assign Tasks',
        'action'=>site_url('Taskassign/create_action'),
        'emp_id'=>set_value('emp_id'),
        //'tasks'=>set_value('tasks'),
        // 'description'=>set_value('description'),
        'id'=>set_value('id'),
        
        'button'=>"Create",
        'get_employee'=>$get_employee,
      );

      $this->load->view('common/header',$sub_heading);
      $this->load->view('common/left_panel');
      $this->load->view('taskassign/form',$data);
      $this->load->view('common/footer');
      
    }

    public function create_action()
    {
       
        $data=array(

          'emp_id'=>$_POST['emp_id'],
          'date'=>date('Y-m-d'),  
        );


        $this->Crud_model->SaveData('taskassign',$data);
       $last_id=$this->db->insert_id();
       $count = count($this->input->post('tasks'));
        for ($i=0; $i < $count; $i++) 
           { 
                $log = array(
                    'task_id'=>$last_id,
                    'tasks'=>$_POST['tasks'][$i],
                   
                );

              $this->Crud_model->SaveData('multiple_task',$log);

           }
        redirect('Taskassign');
    }

      public function update($id)
      {
        $update_task=$this->Crud_model->get_single('taskassign',"id='".$id."'");
      $get_employee = $this->Crud_model->GetData('admin','',"status='Active' and designation_id='8'");
    $get_multiple_task=$this->Crud_model->GetData('multiple_task','',"status='Active' and task_id='".$id."'");
      $sub_heading=array('page_title'=>'Update Tasks');
      

      $data=array(
        'header'=>'Assign Tasks',
        'sub_heading'=>'Assign Tasks',
        'action'=>site_url('Taskassign/update_action'),
        'emp_id'=>set_value('emp_id',$update_task->emp_id),
        //'tasks'=>set_value('tasks'),
        
        'id'=>$id,
        
        'button'=>"Update",
        'get_employee'=>$get_employee,
        'get_multiple_task'=>$get_multiple_task,
      );

      $this->load->view('common/header',$sub_heading);
      $this->load->view('common/left_panel');
      $this->load->view('taskassign/form',$data);
      $this->load->view('common/footer');
      }
 public function update_action()
    {
       $id=$_POST['id'];
        $data=array(

          'emp_id'=>$_POST['emp_id'],  
        );


        $this->Crud_model->SaveData('taskassign',$data,"id='".$id."'");
       $last_id=$id;
        $this->Crud_model->DeleteData('multiple_task',"task_id='".$last_id."'");
       $count = count($this->input->post('tasks'));
        for ($i=0; $i < $count; $i++) 
           { 
                $log = array(
                    'task_id'=>$last_id,
                    'tasks'=>$_POST['tasks'][$i],
                   
                );

              $this->Crud_model->SaveData('multiple_task',$log);

           }
        redirect('Taskassign');
    }

        public function delete()
        {
            
            if(isset($_POST['id']))
            {
              $this->Crud_model->DeleteData("taskassign","id='".$_POST['id']."'");
            }
        }

  

     public function view($id)
    {
       $con="t.id='".$id."'";
       $view_task=$this->Taskassign_model->view_task($con);
       $view_multiple_task=$this->Crud_model->GetData('multiple_task','',"task_id='".$view_task->id."'");

        $data = array(
                      'header'=>'Appear Tasks Assign',
                      'view_multiple_task'=>$view_multiple_task,
                      'name'=>$view_task->name,
                      'date'=>date('d-m-Y',strtotime($view_task->date)) , 
                    
            );
        
        $this->load->view('common/header');
        $this->load->view('common/left_panel');
        $this->load->view('taskassign/view',$data);
        $this->load->view('common/footer');

    }

    public function change_status()
    {
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("multiple_task",$_POST,"id='".$_POST['id']."'");
            exit;
        }
    }

  }
?>


  
  