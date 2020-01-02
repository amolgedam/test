<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultancies extends CI_Controller {
	public function consultancy_services()
	{
		$this->load->view('consultancy_services');
	}
	
}
?>