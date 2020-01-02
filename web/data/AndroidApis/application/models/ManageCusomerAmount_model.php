<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class ManageCusomerAmount_model extends CI_Model
{

	var $column_order = array(null,'u.date',null); //set column field database 
   
    var $order = array('u.id' =>'desc'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query($con)
	{
		$this->db->select('dwd.*,u.name');
        $this->db->from('days_wise_deliverys dwd');
        $this->db->join('users u','u.id=dwd.customer_id','left');
        $this->db->order_by('dwd.id desc');
        $this->db->group_by('dwd.customer_id');
        $this->db->where($con);
    
		$i = 0;

        if($_POST['search']['value']) // if datatable send POST for search
        {
            $explode_string = explode(' ', $_POST['search']['value']);
            foreach ($explode_string as $show_string) {
                $cond  = " ";
                $cond.=" (dwd.emp_id LIKE '%".$show_string."%' "; 
                $cond.=" OR dwd.date LIKE '%".$show_string."%')";
                $this->db->where($cond);      
            }

        } 
    
    }

	function get_datatables($con)
    {
        $this->_get_datatables_query($con);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

	 public function count_all($con)
    {    
        $this->_get_datatables_query($con);
        return $this->db->count_all_results();
    }


	function count_filtered($con)
    {
        $this->_get_datatables_query($con);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_customerslist($con)
    {
        $this->db->select('dwd.*,u.name');
        $this->db->from('days_wise_deliverys dwd');
        $this->db->join('users u','u.id=dwd.customer_id','left');
        $this->db->where($con);
        $query =  $this->db->get();
        return $query->result();
    }


    
}