<?php

  defined('BASEPATH') OR exit('No direct script access allowed');
  ini_set('max_execution_time', 0);
  class LLP_company_data extends CI_Controller {

  function __construct()
    {
    parent::__construct();    
    $this->load->database();
    $this->load->model('LLP_company_data_model');
       $this->load->library(array('session','form_validation','image_lib','Custom','email'));
        $this->load->helper("file");    
    }
    public function index($flag='')
  {
        
    $header = array('page_title'=> 'WPES');
        $data = array(
        'heading'=>'LLP Company Data',
        'flag'=>$flag,
    );
    $this->load->view('common/header',$header);
    $this->load->view('common/left_panel');
    $this->load->view('LLP_company_data/list',$data);
    $this->load->view('common/footer'); 
  }

   public function ajax_manage_page($flag='')
   {

        if($_SESSION['SESSION_NAME']['designation']=='marketing')
        {
          $cond = "lp.assign_id='".$_SESSION['SESSION_NAME']['id']."'";

        }
        else if($flag=='LLP_today_followup')
        {
          $cond="lp.follow_date='".date('Y-m-d')."' ";  
        }
         else if($flag=='total_assign_data')
        {
          $cond="lp.assign_id!='0' ";  
        }
        else
        {
          $cond = "1=1";
        }


        $getAllData = $this->LLP_company_data_model->get_datatables($cond);

        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        if(empty($_POST['SearchData1']))
        {
            $client_ids = array();
        }else{
            $client_ids = explode(',', $_POST['SearchData1']);     
        }
        $data = array();        
        foreach ($getAllData as $row) 
        {

           $btn = anchor(site_url('LLP_company_data/View/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .='&nbsp;|&nbsp;'.'<button title="Follow Date" class="btn btn-success btn-xs" data-toggle="modal" data-target="#follow_date" onclick="follow_date('.$row->id.')">Follow Date</button>';
             $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs"  onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash-o"></i></span>';
             $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Send Mail"  class="btn btn-info btn-circle btn-xs" data-toggle="modal" data-target="#mail" 
                    onclick="mail('.$row->id.','."'".$row->email."'".')"> <i class="fa fa-envelope"></i></span>';
            if(strlen($row->address)>50){
            $address=substr($row->address,0,50).'...';
           }
           else{
             $address=$row->address;
           } 

           if($row->lead_type=='Onprocess')
            {
             $view_desc ='<a title="View"  onclick="get_view_description('.$row->id.','."'".$row->required_product."'".')" class="btn btn-primary btn-circle btn-xs">'.$row->lead_type.'</a>';   
            }
            else if($row->lead_type=='Complete') 
            {
                $view_desc ='<a title="View"  onclick="get_view_description('.$row->id.','."'".$row->required_product."'".')" class="btn btn-success btn-circle btn-xs">'.$row->lead_type.'</a>';
            }
            else if($row->lead_type=='Reject')
            {
                 $view_desc ='<a title="View"  onclick="get_view_description('.$row->id.','."'".$row->required_product."'".')" class="btn btn-danger btn-circle btn-xs">'.$row->lead_type.'</a>';
            }
            else if($row->lead_type=='Fake')
            {
                 $view_desc ='<a title="View"  onclick="get_view_description('.$row->id.','."'".$row->required_product."'".')" class="btn btn-warning btn-circle btn-xs">'.$row->lead_type.'</a>';
            }
             else if($row->lead_type=='Visit_interested')
            {
                 $view_desc ='<a title="View"  onclick="get_view_description('.$row->id.','."'".$row->required_product."'".')" class="btn btn-info btn-circle btn-xs">'.$row->lead_type.'</a>';
            }
        else if($row->lead_type=='Visit_not_interested')
            {
                 $view_desc ='<a title="View"  onclick="get_view_description('.$row->id.','."'".$row->required_product."'".')" class="btn btn-danger btn-circle btn-xs" style="background:#ff3300;color:white;">
                 '.$row->lead_type.'</a>';
            }
        else if($row->lead_type=='Visit_not_mate')
            {
                 $view_desc ='<a title="View"  onclick="get_view_description('.$row->id.','."'".$row->required_product."'".')" class="btn btn-primary btn-circle btn-xs" style="background:#333399;color:white;">
                 '.$row->lead_type.'</a>';
            }
            else
            {
                $view_desc="";
            }

        if($_POST['select_all']=="true")
            {
                $chked = "checked";
            }else if(in_array($row->id, $client_ids)){
                $chked = "checked";
            }else{

                $chked = "";
            }

         $chk = '<input type="checkbox" name="client_id" id="client_id_'.$row->id.'" '.$chked.' onchange="checkbox_all('.$row->id.');" class="client_id client_id_'.$row->id.'" value="'.$row->id.'">';

          if(!empty($row->name))
          {
            $name = $row->name;
          }
          else
          {
            $name = "N/A";
          }
          if(!empty($row->follow_date=='0000-00-00'))
    {
      $follow_date="N/A";
    }
    else{
      $follow_date=date('d-m-Y',strtotime($row->follow_date));
    }

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $chk;
            $nestedData[] = $name;
            $nestedData[] = $row->email;
            $nestedData[] = $row->company_name;
            $nestedData[] = $view_desc;
            $nestedData[] = $row->state; 
            $nestedData[] = $row->district; 
            $nestedData[] = $address; 
            $nestedData[] = $follow_date; 
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->LLP_company_data_model->count_all($cond),
                    "recordsFiltered" => $this->LLP_company_data_model->count_filtered($cond),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }
  public function import_excel()
  {
      $file = $_FILES['excel_file']['tmp_name'];
        $this->load->library('excel');
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true);
        $arrayCount = count($allDataInSheet);
        $i = 3;

        foreach ($allDataInSheet as $val)
        {
            if ($i <= 3)
            {
               
            }
            else
            {
                $fields_fun[] = $val;
            }
            $i++;
        }
        $removed = array_shift($fields_fun);

        if(!isset($fields_fun))
        {
            $this->session->set_flashdata('message', '<span class="label label-danger text-center" style="margin-bottom:0px">Excel Sheet is blank</span>');
            redirect(site_url('LLP_company_data/index'));           
        }


        $data = $fields_fun;
       
            $exists = 0;
            foreach ($data as $val)
            { 
                if($val[0] !='Code' || $val[1] !='Product Name')
                {   
                if(($val[0]!=''))
                {
                      if($val[1]!='')
                      {
                  $getCategories= $this->Crud_model->GetData('llp_company_data','company_code',"company_code='".$val[0]."'",'','','','single');
                        /*for already exist check*/
                       
                        if(empty($getCategories))
                        {
                            if(!empty($val[13]))
                             {
                              $email =$val[13];
                             }
                             else
                             {
                               $email ="";
                             }
                             if(!empty($val[12]))
                             {
                              $address =$val[12];
                             }
                             else
                             {
                               $address ="";
                             }

                            if(!empty($val[11]))
                             {
                              $district=$val[11];
                             }
                             else
                             {
                               $district="";
                             }


                            if(!empty($val[10]))
                             {
                              $state=$val[10];
                             }
                             else
                             {
                               $state="";
                             }
                            
                             if(!empty($val[6]))
                             {
                              $description=$val[6];
                             }
                             else
                             {
                               $description="";
                             }
                             if(!empty($val[1]))
                             {
                              $company_name=$val[1];
                             }
                             else
                             {
                               $company_name="";
                             }
                             if(!empty($val[0]))
                             {
                              $company_code=$val[0];
                             }
                             else
                             {
                               $company_code="";
                             }
             // $stringDate = \PHPExcel_Style_NumberFormat::toFormattedString($date_reg, 'Y-m-d');
                        
                           $data = array(
                                          'company_code' => $company_code,
                                          'company_name' => $company_name,
                                          'description' =>$description,
                                         'state' =>$state,
                                         'district' =>$district,
                                         'address' =>$address,
                                          'email' =>$email,
                                          'created'=> date('Y-m-d H:i:s'),
                                          );

                            $SaveAssets = $this->Crud_model->SaveData('llp_company_data',$data);
                        }
                        else
                        {
                            $existAssets[]=array($val[1],'Company Name already exist');
                        }
                  
                      }
                      else
                      {
                          $existAssets[]=array($val[1],'Mandatory fields empty');
                      }
                }
                }
            }
         
        if(empty($existAssets))
        {
            $this->session->set_flashdata('message', '<span class="label label-success text-center" style="margin-bottom:0px">Product has been imported successfully</span>');
            redirect('LLP_company_data/index');
        }
        else{
            $data = array('existAssets' => $existAssets);
            $this->load->view('LLP_company_data/duplicateCat',$data);
        } 
}

public function delete()
    {
      
        if(isset($_POST['cid']))
        {
           $this->Common_model->delete('llp_company_data',"id='".$_POST['cid']."'");
           
        }
    }

        public function send_mail()
   {
       $id = $_POST['id'];
       $email = $_POST['email'];
        if(empty($email))
          {
              $email_id="";
          }
          else{
              $email_id =  $email;
          }
       /* if(!empty($id)){
      $get_company_data=$this->Crud_model->GetData("company_data","","id='".$id."'","","","","1");
       
         $email=$get_company_data->email;
      }
      else{
          $email="";
      }*/
     
       $subject = $this->input->post('subject');
       $description = $this->input->post('description');
        $from =$_POST['from_mail']; 

          if(empty($subject))
          {
              $subject1="";
          }
          else{
              $subject1 =  $subject;
          }
          if(empty($description))
          {
              $body1="...";
          }
          else
          {
              $body1 = $description;
          }
          // $attachment='N/A';   
        $sendCustomerEmail=$email_id;
        $res= $this->custom->sendEmailSmtp_web($from,$subject1,$body1,$sendCustomerEmail);
        $this->session->set_flashdata('message', 'Mail send successfully');
        redirect(site_url('LLP_company_data'));
   }
    public function View($id,$flag='')
    {  
        $header = array('page_title'=>'WPES');
        $companydata = $this->Crud_model->get_single("llp_company_data","id='".$id."'");
      $follow_data = $this->Crud_model->GetData("LLP_follop_date","","LLP_id='".$id."'"); 
       if(!empty($companydata->delivery_date=='0000-00-00'))
    {
      $delivery_date="N/A";
    }
    else{
      $delivery_date=date('d-m-Y',strtotime($companydata->delivery_date));
    }
        $data =array(
          'company_code'=>$companydata->company_code,
          'company_name'=>$companydata->company_name,
          'description'=>$companydata->description,
          'state'=>$companydata->state,
          'district'=>$companydata->district,
          'email'=>$companydata->email,
          'address'=>$companydata->address, 
          'required_product'=>$companydata->required_product,   
          'delivery_date'=>$delivery_date,   
          'lead_remark'=>$companydata->lead_remark,
          'follow_data'=>$follow_data, 
          'flag'=>$flag,
        );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('LLP_company_data/view',$data);
        $this->load->view('common/footer');
    }

    public function assign_data()
{
    
   $assign_to=$_POST['assign_id'];
   $selected_client =$_POST['client_id'];
   $explode_ids =explode(",", $selected_client);
 
   foreach ($explode_ids as $id) 
  {
      $data=array(
          'assign_id'=>$assign_to,
        );
  
    $this->Crud_model->SaveData('llp_company_data',$data,"id='".$id."'");
  }

  echo "1";exit;


}

public function follow_id_insert()
{
    $assign_data=$this->Crud_model->get_single('llp_company_data',"id='".$_POST['id']."'");
  
    $data=array(
      'id'=>$assign_data->id,
  );
   echo json_encode($data);exit;
}

    public function follow_date_insert()
{
  
    $log = array(
        'follow_date'=>date('Y-m-d',strtotime($_POST['follop_date'])),
         'follow_remark'=>$_POST['remark'],
        );

    $this->Crud_model->SaveData('llp_company_data',$log,"id='".$_POST['company_data_id']."'");
     $data=array(
        'follop_date'=>date('Y-m-d',strtotime($_POST['follop_date'])),
        'remark'=>$_POST['remark'],
        'LLP_id'=>$_POST['LLP_id'],
        );    
        
        $this->Crud_model->SaveData('LLP_follop_date',$data);
        $this->session->set_flashdata('message', 'Followup data created successfully');

}

public function order()
    {
      

        $log = array(
            'lead_type'=>$_POST['lead_type'],
            'lead_remark'=>$_POST['lead_remark'],
        );
        
        $this->Crud_model->SaveData('llp_company_data',$log,"id='".$_POST['lead_id']."'");
 
        $get_lead = $this->Crud_model->GetData(' llp_company_data','',"id='".$_POST['lead_id']."'",'','','','1');

                $data = array(                         
                   'email'  =>$get_lead->email,
                   'address'  =>$get_lead->address,
                   'required_product'  =>$this->input->post('required_product'),
                   'lead_type'  =>$this->input->post('lead_type'),
                   'delivery_date'  =>date('Y-m-d',strtotime($this->input->post('delivery_date'))) ,     
                  // 'order_no'  => $this->input->post('order_no'),     
                   'lead_remark'  => $this->input->post('lead_remark'),     
                
                 );
             
            $this->Crud_model->SaveData(' llp_company_data',$data,"id='".$_POST['lead_id']."'");
      
             echo 1;exit;       
}

}