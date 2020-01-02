
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends CI_Controller 
{
	 function __construct()
    {
        parent::__construct();    
        $this->load->database();
        $this->load->model('Common_model');
        // $this->load->library(array('session','form_validation','image_lib'));
    }

	public function aboutus_data()
	{
		$aboutus = $this->Common_model->GetData("aboutus","","","","","","1");
            //print_r($aboutus);exit;

            if (!empty($aboutus)) 
            {
              $aboutus = $aboutus;
            }
            else
            {
              $aboutus ="";
            }

            $data =array( 
          'aboutus'=>$aboutus,
        );
   		$this->load->view('aboutus/aboutus_detail',$data);
   	}
	
}
?>