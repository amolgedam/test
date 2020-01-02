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
         $emp_name = $_POST['SearchData5']; 
          $cond="1=1"; 
      if($_SESSION['SESSION_NAME']['designation']=='PHP DEVELOPER')
        {
            if($flag=='today_task')
            {
          $cond .=" and t.emp_id='".$_SESSION['SESSION_NAME']['id']."' and t.date='".date('Y-m-d')."'";
                        
            }
            else{
               $cond .=" and t.emp_id='".$_SESSION['SESSION_NAME']['id']."'";
            }
               
           
    }
    else{
      if($flag=='today_task')
            {
            $cond .=" and t.date='".date('Y-m-d')."'"; 
            }
      /*else{
        $cond .=" and t.emp_id='".$_SESSION['SESSION_NAME']['id']."'";
      }*/
       }
        if($emp_name!='')
                {

                    $cond .=" and t.emp_id='".$emp_name."'";
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
             $btn="";
            if($_SESSION['SESSION_NAME']['designation']=='admin')
          {

            $btn = anchor(site_url('Taskassign/update/'.$row->id),'<button title="Edit" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
            
            $btn.= '&nbsp|&nbsp'.anchor(site_url('Taskassign/view/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');
            
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash-o"></i></span>';      
        }
         if($_SESSION['SESSION_NAME']['designation']=='PHP DEVELOPER'|| $_SESSION['SESSION_NAME']['designation']=='Android Developer')
            {
                 $btn.=anchor(site_url('Taskassign/view/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');
            }
            $status='';            
            
            if($row->status=='Pending')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->id.'"  onClick="status('.$row->id.');" >'.$row->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$row->id.'"  onClick="status('.$row->id.');" >'.$row->status.'</span>';
            }

            if(!empty($row->image))
          {
            $allowed =  array('gif','png' ,'jpg' ,'PNG' ,'JPG','jpeg');
               $file = $row->image;
               $ext = pathinfo($file, PATHINFO_EXTENSION);
           if(in_array($ext,$allowed) ) 
               {
            if(!file_exists("uploads/task_image/".$row->image))
              { 
                $img ='<img height="100px" width="100px" class="img-thumbnail img-responsive" src="'.base_url('uploads/No_Image_Available.jpg').'">';
              }
            else
              { 
             
               $img ='<a href="'.base_url('uploads/task_image/'.$row->image).'" data-lightbox="roadtrip"><img height="100px" width="100px" class="img-thumbnail img-responsive"src="'.base_url('uploads/task_image/'.$row->image).'" style="height:100px;width:100px"><a>';
              }
          }
           else
          { 

              if(file_exists('uploads/task_image/'.$row->image)) 
              {  
               $img= '<a href="'.base_url('uploads/task_image/'.$row->image).'" data-lightbox="roadtrip"><img src="'.base_url('uploads/pdf.png').'" height="100px" width="100px"></a>';
           }
              else
              { 
                $img ='<img src="'.base_url('uploads/No_Image_Available.jpg').'" height="100px" width="100px">';
           } 

          }
       }

          else
          { 
            $img ='<img height="100px" width="100px" class="img-thumbnail img-responsive" src="'.base_url('uploads/No_Image_Available.jpg').'">';
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
            $nestedData[] = $img;
            $nestedData[] = $date;
            $nestedData[] = ucwords($row->tasks);
            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."' />";
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
      $get_employee = $this->Crud_model->GetData('admin','',"status='Active' and designation_id='8'or designation_id='10'");

      $sub_heading=array('page_title'=>'Add Tasks');
      $data=array(
        'header'=>'Assign Tasks',
        'sub_heading'=>'Assign Tasks',
        'action'=>site_url('Taskassign/create_action'),
        'emp_id'=>set_value('emp_id'),
        'tasks'=>set_value('tasks'),
         'image'=>set_value('image'),
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
       $count = count($this->input->post('tasks'));
         for ($i=0; $i < $count; $i++)
        {

        
            if($_FILES['image']['name'][$i]!='')
            { 
                 $src = $_FILES['image']['tmp_name'][$i];
                  $filEnc = time();
                  $avatar= rand(0000,9999)."_".$_FILES['image']['name'][$i];
                  $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                  $dest =getcwd().'/uploads/task_image/'.$avatar1;
               
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
                   'tasks'=>$_POST['tasks'][$i],
                    'emp_id'=>$_POST['emp_id'],
                     'date'=>date('Y-m-d'),
                    'image'=>$image,
                   
                );
              
              $this->Crud_model->SaveData('multiple_task',$log);

           }
            $this->session->set_flashdata('message', 'Task created successfully');
        redirect('Taskassign');
    }

      public function update($id)
      {
        $update_task=$this->Crud_model->get_single('multiple_task',"id='".$id."'");
      $get_employee = $this->Crud_model->GetData('admin','',"status='Active' and designation_id='8'or designation_id='10'");
    $get_multiple_task=$this->Crud_model->GetData('multiple_task','',"id='".$id."'");
      $sub_heading=array('page_title'=>'Update Tasks');
      

      $data=array(
        'header'=>'Assign Tasks',
        'sub_heading'=>'Assign Tasks',
        'action'=>site_url('Taskassign/update_action'),
        'emp_id'=>set_value('emp_id',$update_task->emp_id),
        'tasks'=>set_value('tasks'),
         'image'=>set_value('image'),
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
       $count = count($this->input->post('tasks'));
          for ($i=0; $i < $count; $i++)
        {
            if($_FILES['image']['name'][$i]!='')
            { 
                 $src = $_FILES['image']['tmp_name'][$i];
                  $filEnc = time();
                  $avatar= rand(0000,9999)."_".$_FILES['image']['name'][$i];
                  $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                  $dest =getcwd().'/uploads/task_image/'.$avatar1;
               
                if(move_uploaded_file($src,$dest))
                {
                        $image  = $avatar1;               
                }
                else{
                  @unlink('uploads/task_image/'.$_POST['old_image'][$i]);
                  $image  = $_POST['image'][$i];  
                }
            }
            else
            {
                //$image  = $_POST['old_document'][$i];
                 $image=$_POST['old_image'][$i];
            }
                $log = array(
                  'tasks'=>$_POST['tasks'][$i],
                    'emp_id'=>$_POST['emp_id'],
                     'date'=>date('Y-m-d'),
                    'image'=>$image,
                   
                );

             $this->Crud_model->SaveData('multiple_task',$log,"id='".$id."'");

           }
            $this->session->set_flashdata('message', 'Task Updated successfully');
        redirect('Taskassign');
    }

        public function delete()
        {
            
            if(isset($_POST['id']))
            {
              $this->Crud_model->DeleteData("multiple_task","id='".$_POST['id']."'");
            }
        }

    public function view($id)
    {
       $con="t.id='".$id."'";
       $view_task=$this->Taskassign_model->view_task($con);

        $data = array(
                      'header'=>'Appear Tasks Assign',
                      'name'=>$view_task->name,
                    'tasks'=>$view_task->tasks,
                      'image'=>$view_task->image,
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


  
  