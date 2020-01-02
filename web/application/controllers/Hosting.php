<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hosting extends CI_Controller {
	public function hosting_services()
	{
		$this->load->view('hosting_services');
	}
	
}
?>