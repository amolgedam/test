<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Subcategory extends CI_Controller 
  {

    function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Subcategory_model');
        $this->load->library(array('session','form_validation','image_lib'));
    }


    public function getData()
    {
        $cid = $this->input->post('pcat');
        // $cid = 1;
        if($cid == 0)
        {
          $data = $this->Crud_model->GetData('subcategories','','','','','','');
        }
        else
        {
           $data = $this->Crud_model->GetData('subcategories','',"categories_id='".$cid."'",'','','','');

        }

       // echo "<pre>"; print_r($data); exit();
       echo json_encode($data);
    }

    public function getDataByid()
    {
        $id = $this->input->post('productid');
        // $cid = 1;
       $data = $this->Crud_model->GetData('subcategories','',"id='".$id."'",'','','','1');
       // echo "<pre>"; print_r($data); exit();
       echo json_encode($data);
    }

    public function index()
    {
        
      $cotegory =  $this->Crud_model->GetData('categories','',"status='Active' and created_by='".$_SESSION['admin']['id']."'");
      
   
        $header = array(
          'page_title'=> 'Farmcartbiz.com'
        );


        $data = array(
        'heading'=>'Product Master',
        'createAction'=>site_url('Subcategory/create'),
        'changeAction'=>site_url('Subcategory/changeStatus'),
        'deleteAction'=>site_url('Subcategory/delete'),
        'StatusActive'=>site_url('Subcategory/StatusActive'),
        'StatusInactive'=>site_url('Subcategory/StatusInactive'),
        'cotegory'=>$cotegory,


    );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('subcategory/list',$data);
        $this->load->view('common/footer'); 
  }

  public function ajax_manage_page()
  {
      $Filter = $_POST['SearchData4'];

      $cond = "1=1 and subcategories.is_delete='No'";
      
      if(!empty($Filter))
      {
        if($Filter!='All')
        {
          $cond .=" and subcategories.categories_id='".$Filter."'";
        }
      }
     $cond="subcategories.created_by='".$_SESSION['admin']['id']."' and subcategories.is_delete='No'";
      $getsubCategory = $this->Subcategory_model->get_datatables($cond);
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
        $data = array();        
        foreach ($getsubCategory as $category) 
        {

            $btn = anchor(site_url('Subcategory/view/'.$category->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

            $btn .=  '&nbsp;|&nbsp;'.anchor(site_url('Subcategory/update/'.$category->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');

            $btn.= '&nbsp;|&nbsp;'.'<a href="#deleteData" data-toggle="modal" title="Delete" class="btn btn-danger btn-circle btn-xs" onclick="Delete('.$category->id.')"><i class="fa fa-trash-o"></i></a>';

             $status='';            
            if($category->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$category->id.'"  onClick="statuss('.$category->id.');" >'.$category->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$category->id.'"  onClick="statuss('.$category->id.');" >'.$category->status.'</span>';
            }


            if(file_exists('uploads/subcategory/'.$category->image))
            {
                 if(!empty($category->image))
              {
                  $images = '<img src="'.base_url('uploads/subcategory/'.$category->image).'" height="60px" width="70px">';
              }
              else
              {
                  $images ='<img src="'.base_url('uploads/subcategory/default_banner.jpg').'" height="60px" width="70px">';
              }
            }
            else
            {
                 $images ='<img src="'.base_url('uploads/subcategory/default_banner.jpg').'" height="60px" width="70px">';
            }

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            $nestedData[] = $images;
            $nestedData[] = $category->cat_name;
            $nestedData[] = $category->subcat_name;
            $nestedData[] = 'Rs. '.number_format(round($category->one_liter_price),2);
            $nestedData[] = 'Rs. '.number_format(round($category->half_liter_price),2);
            $nestedData[] = $status."<input type='hidden' id='status".$category->id."' value='".$category->status."' />";   
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Subcategory_model->count_all($cond),
                    "recordsFiltered" => $this->Subcategory_model->count_filtered($cond),
                    "data" => $data,
                );
        
        echo json_encode($output);
    }

        public function delete()
        {
            $get_image = $this->Crud_model->GetData('subcategories','image',"id='".$_POST['cid']."'",'','','','1');

            unlink('uploads/subcategory/'.$get_image->image);
            
            $this->Crud_model->DeleteData("subcategories","id='".$_POST['cid']."'");exit;
        }

        public function change_status()
        {

            if(isset($_POST['statusupdate']))
            {
               // $_POST['modified_by']=$_SESSION[SESSION_NAME]['emp_id'];
                $this->Crud_model->SaveData("subcategories",$_POST,"id='".$_POST['id']."'");exit;
            }
        }
        
         public function StatusInactive()
        {

            $get_subcategories = $this->Crud_model->GetData('subcategories','',"is_delete='No'");

            foreach ($get_subcategories as $sub) 
            {
                  $data=array('status'=>'Inactive',);

                $this->Crud_model->SaveData("subcategories",$data,"id='".$sub->id."'");

            }
            redirect(site_url('Subcategory'));  
           
        }
        public function StatusActive()
        {

            $get_subcategories = $this->Crud_model->GetData('subcategories','',"is_delete='No'");

            foreach ($get_subcategories as $sub) 
            {
                  $data=array('status'=>'Active',);

                $this->Crud_model->SaveData("subcategories",$data,"id='".$sub->id."'");


            }
            redirect(site_url('Subcategory'));  

           
        }
        
        

        public function create()
        {
            $header = array('page_title'=>'Farmcartbiz.com');  

            $getcat =  $this->Crud_model->GetData('categories','',"status='Active' and created_by='".$_SESSION['admin']['id']."'");

            $data = array(
                            'heading'=>'Add Product',
                            'subheading'=>'Create Product',
                            'button'=>'Create',
                            'action'=>site_url('Subcategory/create_action'),
                            'cat_name' =>set_value('cat_name'),
                            'half_liter_price' =>set_value('half_liter_price'),
                            'one_liter_price' =>set_value('one_liter_price'),
                            'subcat_name' =>set_value('subcat_name'),
                            'categories_id' =>set_value('categories_id'),
                            'id' =>set_value('id'),
                            'image'=>set_value('image'),
                            'getcat'=>$getcat,
          );
       // print_r($data);exit;
          $this->load->view('common/header',$header);
          $this->load->view('common/left_panel');
          $this->load->view('subcategory/form',$data);
          $this->load->view('common/footer'); 
    }
        /*function for Create action department developed by shubham */
    public function create_action()
    {

       $id = 0;
        $this->_rules($id);
        $con="id='".$id."'";


        $this->form_validation->set_rules('subcat_name', 'Product Name', 'trim|required|is_unique[subcategories.subcat_name]');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->create($id);
        } 
        else
            {
              $header = array('page_title'=>'Gauganga.com');
          
              if($_FILES['image']['name']!='')
                {  
                     $src = $_FILES['image']['tmp_name'];
                      $filEnc = time();
                      $avatar= rand(0000,9999)."_".$_FILES['image']['name'];
                      $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                      $dest =getcwd().'/uploads/subcategory/'.$avatar1;
                    
                    if(move_uploaded_file($src,$dest))
                    {
                            $image  = $avatar1;                
                    }
                }
                else
                {
                    $image =""; 
                }


                $data = array
                (
                            'categories_id' =>$this->input->post('categories_id',TRUE),
                            'created_by' =>$_SESSION['admin']['id'],
                            'subcat_name' =>$this->input->post('subcat_name',TRUE),
                            'one_liter_price' =>$this->input->post('one_liter_price',TRUE),
                            'half_liter_price' =>$this->input->post('half_liter_price',TRUE),
                            'image' => $image,
                            'created'=> date('Y-m-d H:i:s'),
                                );

            $this->Crud_model->SaveData('subcategories',$data);

            $this->session->set_flashdata('message', 'SubCategory created successfully');
            redirect(site_url('Subcategory'));      
    
    }

    }
   

     public function update($id)
    { 
        $header = array('page_title'=>'Farmcartbiz.com');

        $getcat = $this->Crud_model->GetData('categories','',"status='Active' and created_by='".$_SESSION['admin']['id']."'");
        $getEmployees = $this->Crud_model->get_single('subcategories',"id='".$id."'");

        $data = array('heading'=>'Update Product',
                    'subheading'=>'Update Product',
                    'button'=>'Update',
                    'action'=>site_url('Subcategory/update_action'),
                    'categories_id' => set_value('categories_id',$getEmployees->categories_id),
                    'subcat_name' => set_value('subcat_name',$getEmployees->subcat_name),
                    'one_liter_price' =>set_value('one_liter_price',$getEmployees->one_liter_price),
                    'half_liter_price' =>set_value('half_liter_price',$getEmployees->half_liter_price),
                    'image' => set_value('image',$getEmployees->image),
                    'id' => set_value('id',$id),
                    'getcat' =>$getcat,
                );
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('subcategory/form',$data);
        $this->load->view('common/footer'); 
    }

/*function for update action developed by shubham */
    public function update_action()
    {
       $id = $this->input->post('id');
        $id = $id;
        $this->_rules($id);
        $con="id='".$id."'";

        $this->form_validation->set_rules('subcat_name', 'Product Name', 'trim|required');


        if ($this->form_validation->run() == FALSE) 
        {
            $this->update($id);
        } 
        else
            {        
     
              if($_FILES['image']['name']!='')
                {  
                     $src = $_FILES['image']['tmp_name'];
                      $filEnc = time();
                      $avatar= rand(0000,9999)."_".$_FILES['image']['name'];
                      $avatar1 = str_replace(array( '(', ')',' '), '', $avatar);
                      $dest =getcwd().'/uploads/subcategory/'.$avatar1;
                    
                    if(move_uploaded_file($src,$dest))
                    {
                        unlink('uploads/subcategory/'.$_POST['old_image']);
                            $image  = $avatar1;                
                    }
                }
                else
                {
                    $image =$_POST['old_image']; 
                }

                $data = array(
                       'categories_id' =>$this->input->post('categories_id',TRUE),
                      'created_by' =>$_SESSION['admin']['id'],
                        'subcat_name' =>$this->input->post('subcat_name',TRUE),
                        'one_liter_price' =>$this->input->post('one_liter_price',TRUE),
                        'half_liter_price' =>$this->input->post('half_liter_price',TRUE),
                        'image' => $image,
                        'modified'=> date('Y-m-d H:i:s'),
                  );

               
              $con="id='".$id."'";
             $this->Crud_model->SaveData('subcategories',$data,$con);
            $this->session->set_flashdata('message', 'Subcategory updated successfully');
            redirect(site_url('Subcategory'));

          }
   
    }

    public function minusStock()
    {
        //print_r($_POST);exit;

        $getproductId = $this->Crud_model->GetData('subcategories','',"id='".$this->input->post('id')."'",'','','','1');

        if(!empty($getproductId))
        {
           $getquantity = $getproductId->quantity_in_kg - $this->input->post('minus_stock');

          $data1 = array(
                        'quantity_in_kg'=>$getquantity,
          );

          $this->Crud_model->SaveData('subcategories',$data1,"id='".$this->input->post('id')."'");

           $data = array(
                'product_id'=>$this->input->post('id'),
                'last_quantity'=>$this->input->post('quantity_in_kg'),
                'quantity'=>$this->input->post('minus_stock'),
                'total_quantity'=>$this->input->post('quantity_in_kg') - $this->input->post('minus_stock'),
                'status'=>'Minus',
                'description'=>$this->input->post('minus_stock').'-'.'quantity minus from product',
                'date'=>date('Y-m-d'),
                'created'=>date('Y-m-d H:i:s')
        );

          $this->Crud_model->SaveData('product_stock_log',$data);

          echo '1';exit;

        }
        else
        {
          echo '2';exit;
        }

    }
    public function addStock()
    {

       $getproductId = $this->Crud_model->GetData('subcategories','',"id='".$this->input->post('id')."'",'','','','1');

        if(!empty($getproductId))
        {
           $getquantity = $getproductId->quantity_in_kg + $this->input->post('add_stock');

          $data1 = array(
                        'quantity_in_kg'=>$getquantity,
          );

          $this->Crud_model->SaveData('subcategories',$data1,"id='".$this->input->post('id')."'");

           $data = array(
                'product_id'=>$this->input->post('id'),
                'last_quantity'=>$this->input->post('quantity_in_kg'),
                'quantity'=>$this->input->post('add_stock'),
                'total_quantity'=>$this->input->post('quantity_in_kg') + $this->input->post('add_stock'),
                'status'=>'Add',
                'description'=>$this->input->post('add_stock').'+'.'quantity Added in product',
                'date'=>date('Y-m-d'),
                'created'=>date('Y-m-d H:i:s')
        );

          $this->Crud_model->SaveData('product_stock_log',$data);

          echo '1';exit;

        }
        else
        {
          echo '2';exit;
        }

    }

    public function view($id)
    {

      $get_productdata = $this->Crud_model->GetData('subcategories','',"id='".$id."'",'','','','1');
      $header = array('page_title'=>'Farmcartbiz.com');
       
     // $get_productlog = $this->Crud_model->GetData('product_stock_log','',"product_id='".$id."'");

     // print_r($get_productlog);exit;

      $data = array(
                    'heading'=>"Manage Product View",
                    'get_productdata'=>$get_productdata,
                    'image'=>$get_productdata->image,
                    'subcat_name'=>$get_productdata->subcat_name,
                    'one_liter_price'=>$get_productdata->one_liter_price,
                    'half_liter_price'=>$get_productdata->half_liter_price,
                    //'get_productlog'=>$get_productlog,
                  );

        
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('subcategory/view',$data);
        $this->load->view('common/footer'); 

    }


          public function _rules($id) 
        {   

          $cond = "subcat_name='".$this->input->post('subcat_name',TRUE)."' and id!='".$id."' and   categories_id='".$this->input->post('categories_id')."'";

          $table = 'subcategories';
          $row = $this->Crud_model->get_single($table, $cond);
          //print_r($row);exit;
          $count = count($row);
          if($count==0) 
          {
              $is_unique = "";
          }
          else {
              $is_unique = "|is_unique[subcategories.subcat_name]";

          }
                  $this->form_validation->set_rules('subcat_name', 'SubCategory', 'trim|required'.$is_unique,
                    array(
                            'required'=> 'Please enter %s.',
                            'is_unique'=>'This SubCategory already exist'
                        ));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
        
    }







}?>