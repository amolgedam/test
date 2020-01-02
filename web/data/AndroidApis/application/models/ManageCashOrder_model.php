<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class ManageCashOrder_model extends CI_Model
{

	var $column_order = array(null,'u.name','e.name','dwd.quantity','dwd.date','dwd.time',null); //set column field database 
   
    var $order = array('dwd.id' =>'desc'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query($cond)
	{
		$this->db->select('dwd.*,u.name as cust_name,e.name as emp_name,u.mobile as cust_mobile,e.mobile as emp_mobile,u.address');
        $this->db->from('days_wise_deliverys dwd'); 
        $this->db->join('users u','u.id=dwd.customer_id','left');
        $this->db->join('employees e','e.id=dwd.emp_id','left');
        $this->db->order_by('dwd.id desc');
        $this->db->where($cond);
        
		
		$i = 0;

        if($_POST['search']['value']) // if datatable send POST for search
        {
            $explode_string = explode(' ', $_POST['search']['value']);
            foreach ($explode_string as $show_string) {
                $cond  = " ";
                $cond.=" (u.name LIKE '%".$show_string."%' ";
                $cond.=" OR e.name LIKE '%".$show_string."%' ";       
                $cond.=" OR dwd.quantity LIKE '%".$show_string."%' ";       
                $cond.=" OR dwd.date LIKE '%".$show_string."%' ";       
                $cond.=" OR dwd.time LIKE '%".$show_string."%')";
                $this->db->where($cond);      
            }

        } 
    
    }

	function get_datatables($cond)
    {
        $this->_get_datatables_query($cond);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

	 public function count_all($cond)
    {    
        $this->_get_datatables_query($cond);
        return $this->db->count_all_results();
    }


	function count_filtered($cond)
    {
        $this->_get_datatables_query($cond);
        $query = $this->db->get();
        return $query->num_rows();
    }


    
}