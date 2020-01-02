<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Countries_model extends CI_Model
{

	var $column_order = array(null,'countries.country_name','countries.status',null);

    var $order = array('id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query()
	{
		$this->db->select('countries.*');
        $this->db->from('countries');
        $this->db->order_by('id desc');
		
		$i = 0;

        if($_POST['search']['value']) // if datatable send POST for search
        {
            $explode_string = explode(' ', $_POST['search']['value']);
            foreach ($explode_string as $show_string) {
                $cond  = " ";
                $cond.=" (countries.country_name LIKE '%".$show_string."%' ";
                $cond.=" OR countries.status LIKE '%".$show_string."%')";
                $this->db->where($cond);   
            }
        }
    }

	function get_datatables($table)
    {
        $this->_get_datatables_query($table);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

	public function count_all($table)
    {    
        $this->_get_datatables_query($table);
        return $this->db->count_all_results();
    }


	function count_filtered($table)
    {
        $this->_get_datatables_query($table);
        $query = $this->db->get();
        return $query->num_rows();
    }

    


}