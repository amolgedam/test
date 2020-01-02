<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hardware extends CI_Controller {

	public function indeustry_detail($id)
	{
		$insdustry = $this->Common_model->GetData('hardware',"*","id='".$id."' and status='Active'","","","","1");
		
		if(!empty($insdustry))
		{
			$insdustrydetail = $this->Common_model->GetData('hardware_detail',"*","hardware_id='".$id."' and status='Active'","","","","1");

			if(!empty($insdustrydetail))
			{
				$insdustryimage = $this->Common_model->GetData('hardware_image',"*","hardware_id='".$insdustrydetail->id."'","","","","");
      //print_r($insdustryimage);exit;
				if(!empty($insdustryimage))
				{
					$insdustry_service = $this->Common_model->GetData('hardware_service',"*","hardware_detail_id='".$insdustrydetail->id."' and status='Active'","","","","1");
					//print_r($insdustry_service);exit;
					if(!empty($insdustry_service))
					{
						$industries_list = $this->Common_model->GetData('hardware_list',"*","hardware_services_id='".$insdustry_service->id."' and status='Active'","","","","");
					}
						//print_r($industries_list);exit;
					if (!empty($industries_list)) 
					{
						$hardware_article = $this->Common_model->GetData("hardware_article","","hardware_detail_id='".$insdustrydetail->id."'","","","","1");

						
					}
					
				}

				 
				else
				{
					$insdustry_service ="";
					$industries_list = "";
					$hardware_article ="";
				}

			}
			else
			{
				$insdustryimage ="";
				$insdustry_service ="";
				$industries_list = "";
				$hardware_article ="";
			}
		}
		else
		{
			$insdustrydetail ="";
			$insdustryimage ="";
			$insdustry_service ="";
			$industries_list = "";
			$hardware_article ="";
		}
 $client_image=$this->Common_model->GetData('slider_image',"*","status='Active'");
		$data=array(
			'insdustry'=>$insdustry,
			'insdustrydetail'=>$insdustrydetail,
			'insdustryimage'=>$insdustryimage,
			'insdustry_service'=>$insdustry_service,
			'industries_list'=>$industries_list,
			'hardware_article'=>$hardware_article,
			 'client_image'=>$client_image,

		);
		$this->load->view('Hardware/hardware_view',$data);
	}

}
?>