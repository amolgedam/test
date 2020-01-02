<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industries extends CI_Controller {

	public function indeustry_detail($id)
	{
		$insdustry = $this->Common_model->GetData('industries',"*","id='".$id."' and status='Active'","","","","1");
		
		if(!empty($insdustry))
		{
			$insdustrydetail = $this->Common_model->GetData('industries_detail',"*","industries_id='".$id."' and status='Active'","","","","1");

			if(!empty($insdustrydetail))
			{
				$insdustryimage = $this->Common_model->GetData('industries_images',"*","industries_detail_id='".$insdustrydetail->id."'","","","","");
      //print_r($insdustryimage);exit;
				if(!empty($insdustryimage))
				{
					$insdustry_service = $this->Common_model->GetData('industries_services',"*","industries_detail_id='".$insdustrydetail->id."' and status='Active'","","","","1");
					//print_r($insdustry_service);exit;
					if(!empty($insdustry_service))
					{
						$industries_list = $this->Common_model->GetData('industries_list',"*","industries_services_id='".$insdustry_service->id."' and status='Active'","","","","");
						//print_r($industries_list);exit;
					}
					else
					{
							$industries_list = "";
					}
					$insdustry_blog = $this->Common_model->GetData('industrial_blog',"*","industries_detail_id='".$insdustrydetail->id."' and status='Active'","","","","1");
					
					//print_r($insdustry_blog);exit;
					if(!empty($insdustry_blog))
					{
						$industries_blog_list = $this->Common_model->GetData('industrial_blog_list',"*","industries_services_id='".$insdustry_blog->id."' and status='Active'","","","","");
					
					   
					}
					else
					{
							$industries_blog_list = "";
					
					}
					
				}
				else
				{
					$insdustry_service ="";
					$industries_list = "";
			
				}
			}
			else
			{
				$insdustryimage ="";
				$insdustry_service ="";
				$industries_list = "";
		
			}
		}
		else
		{
			$insdustrydetail ="";
			$insdustryimage ="";
			$insdustry_service ="";
			$industries_list = "";
		
		}
 $client_image=$this->Common_model->GetData('slider_image',"*","status='Active'");
		$data=array(
			'insdustry'=>$insdustry,
			'insdustrydetail'=>$insdustrydetail,
			'insdustryimage'=>$insdustryimage,
			'insdustry_service'=>$insdustry_service,
			'industries_list'=>$industries_list,
			'insdustry_blog'=>$insdustry_blog,
			'industries_blog_list'=>$industries_blog_list,
			'client_image'=>$client_image,

		);
		$this->load->view('Industries/industrial_view',$data);
	}
	public function career()
	{
		$this->load->view('Industries/career');
	}
	public function career_action()
	{
		$id = '0';
	    $this->_rules($id);
	    if($this->form_validation->run() == FALSE) 
	    {  
	      $this->career();
	    } 
	    else
	    {  	
	    	$random = rand(0000,9999);

			$targetDir = FCPATH."uploads/resume";

	         if(!empty($_FILES["resume"]["name"]))
	         {
	            if(is_array($_FILES))
	            {
	              if(is_uploaded_file($_FILES['resume']['tmp_name']))
	              {
	                if(move_uploaded_file($_FILES['resume']['tmp_name'],"$targetDir/".$random.$_FILES['resume']['name']))
	                {
	                    $image=$random.$_FILES['resume']['name'];
	                }
	              }
	            }
	         }
	         else
	         {
	            $image ="";
	         }

		$data=array(
        'name' => $_POST['name'],
        'skill' => $_POST['skill'],
        'email' => $_POST['email'],
        'apply_for' => $_POST['apply_for'],
        'address' => $_POST['address'],
        'date' => $_POST['date'],
        'mobile' => $_POST['mobile'],
        'resume' => $image,
        'created'=>date('Y-m-d H:i:s'),
      );
      $this->Common_model->SaveData('career',$data);
      $this->session->set_flashdata('message', 'Application submited successfull!!! We will contact you Shortly...');
      redirect("Industries/career");
  }
}
public function _rules($id) 
    {   

      $cond = "email='".$this->input->post('email',TRUE)."' and id!='".$id."'";
      $row = $this->Common_model->GetData("career","", $cond);
      $count = count($row);
      if($count==0) 
      {
          $is_unique = "";
      }
      else 
      {
          $is_unique = "|is_unique[career.email]";

      }
        $this->form_validation->set_rules('email', 'Email is', 'trim|required'.$is_unique,
        array(
                'required'=> 'Please enter %s.',
                'is_unique'=>'This %s already exist'
            ));
        
    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span style="color: red">', '</span>');
}
}
?>