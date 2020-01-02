<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	$product_details = $this->Common_model->get_single('products_details',"product_type='Retail_Management'");
    $industries_details = $this->Common_model->get_single('industries_detail',"industry_type='Product_Engineering'");
    $service_detail = $this->Common_model->get_single('service_detail',"service_type='Application_Development'");
     $hardware_detail = $this->Common_model->get_single('hardware_detail',"heading='POS Terminals'");
     $client_image=$this->Common_model->GetData('slider_image',"*","status='Active'");
     $bannerdata = $this->Common_model->GetData('banners','',"status='Active'","","","","");
     $setting=$this->Common_model->GetData('settings',"*","","","","","1");
     $data=array(
      'product_type'=>$product_details->product_type,
      'product_description'=>strip_tags($product_details->description),
      'product_id'=>$product_details->id,
       'industry_type'=>$industries_details->industry_type,
      'industry_description'=>$industries_details->description,
      'industry_id'=>$industries_details->industries_id,
       'service_type'=>$service_detail->service_type,
      'service_description'=>$service_detail->description,
      'service_id'=>$service_detail->service_id,
     'heading'=>$hardware_detail->heading,
      'hardware_description'=>$hardware_detail->description,
      'hardware_id'=>$hardware_detail->hardware_id,
      'client_image'=>$client_image,
       'banners'=>$bannerdata,
       'setting'=>$setting,
  );
		$this->load->view('index',$data);
	}
	public function contact()
	{
		
		$this->load->view('contact');
		$this->load->view('common/footer');
	}
	public function contact_action()
	{
		$data=array(
        'name' => $_POST['name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'tell_me' => $_POST['tell_me'],
        'created'=>date('Y-m-d H:i:s'),
      );
      $this->Common_model->SaveData('contact',$data);
      $this->session->set_flashdata('message', 'Thank you for the message !!! We will contact you Shortly...');
      redirect("Welcome/contact");
  }
  public function employee()
  {
      $state=$this->Common_model->GetData('states',"*","status='Active'");
         $designation=$this->Common_model->GetData('designation',"*","status='Active'");
         $cities = $this->Common_model->GetData('cities',""," status='Active' and state_id='7'");
  
       $data2=array(

                    'home_state' =>$state,
                    'present_state' =>$state,
                    'home_city' =>$cities,
                    'present_city' =>$cities,
                    'designation' =>$designation,
       );
     $this->load->view('common/header');
    $this->load->view('employee', $data2);
    
  }
/*  Suresh Code*/
  
  public function employee_create()
  {
    $employee = $this->Common_model->GetData('employee_data',"","status='Active' and email_id = '".$_POST['email_id']."' || mobile_no='".$_POST['mobile_no']."'");
 
    $count =count($employee); 
   
    if(!empty($count))
    {
       $this->session->set_flashdata('message', 'Mobile Or Email Id Already Exist Please Do not Register if you already filled the form.' );
      redirect("Welcome/employee");
    }
    else
    {
     
    $data1=array(
        'first_name' => $_POST['first_name'],
        'middle_name' => $_POST['middle_name'],
        'last_name' => $_POST['last_name'],
        'birthday_date' => $_POST['birthday_date'],
        'guardian' => $_POST['guardian'],
        'birthday_date' => $_POST['birthday_date'],
        'gender' => $_POST['gender'],
      /*  'medical' => $_POST['medical'],
        'character' => $_POST['character'],*/
        'height' => $_POST['height'],
        'caste' => $_POST['caste'],
        'religion' => $_POST['religion'],
        'home_state' => $_POST['home_state'],
        
        'home_city' => $_POST['home_city'],
        'blood_group' => $_POST['blood_group'],
        'designation' => $_POST['designation'],
        'current_office' => $_POST['current_office'],
        'present_address' => $_POST['present_address'],
        'present_state' => $_POST['present_state'],
        'district' => $_POST['district'],
        'pin_code' => $_POST['pin_code'],
        'mobile_no' => $_POST['mobile_no'],
        'email_id' => $_POST['email_id'],
        'guardian_type' => $_POST['guardian_type'],
        'gmobile_no' => $_POST['gmobile_no'],
        'appointment' => $_POST['appointment'],
        'office_name' => $_POST['office_name'],
        'office_join' => $_POST['office_join'],
        'initial_deg' => $_POST['initial_deg'],
        'basic_salary' => $_POST['basic_salary'],
        'created'=>date('Y-m-d H:i:s'),
      );
      $this->Common_model->SaveData('employee_data',$data1);
      $data_admin= array(
         'name' => $_POST['first_name'],
          'email' => $_POST['email_id'],
         'designation_id' => $_POST['designation'],
         'mobile_no' => $_POST['mobile_no'],
        );
      //print_r($data_admin); exit;
    $this->Common_model->SaveData('admin',$data_admin);
  


      $this->session->set_flashdata('message', 'Thank you for the all your Information. Welcome to WPES...');
      }
      redirect("Welcome/employee");
  }
public function get_city()
    {  
        $id = $this->input->post('id');

        $cityData = $this->Common_model->GetData('cities',"*","status='Active' and state_id = '".$id."'");

        $html = "<option value='0'>Select city</option>";
        foreach ($cityData as $row_data) 
        {
            $html .= "<br><option value='".$row_data->id."'>".ucfirst($row_data->city_name)."</option>";
        }
        echo $html;
    }
 /*   Suresh Code End Here*/
}
