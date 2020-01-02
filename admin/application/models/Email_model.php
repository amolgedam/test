<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_Model
{
	var $column_order = array(null,'e.title','e.subject','e.description','e.status',null); 
	var $column_search = array('e.title','e.subject','e.description','e.status'); 
	var $order = array('e.id' => 'DESC');
	

    function __construct()
    {
        parent::__construct();
    }

   	private function _get_datatables_query($con)
	{
		$this->db->select("e.*");
		$this->db->from('email e');
		$this->db->where($con);

		$i = 0;
		
		 if($_POST['search']['value']) // if datatable send POST for search
        {
            $explode_string = explode(' ', $_POST['search']['value']);
            foreach ($explode_string as $show_string) {
                $cond  = " ";
                $cond.=" (e.title LIKE '%".$show_string."%' ";
                $cond.=" OR e.subject LIKE '%".$show_string."%' ";
                $cond.=" OR e.description LIKE '%".$show_string."%' )";
               // $cond.=" OR t.status LIKE '%".$show_string."%'";
                $this->db->where($cond);


                
            }

        } 
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
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
		$this->db->select("e.*");
		$this->db->from('email e');
		$this->db->where($con);
		return $this->db->count_all_results();
	}

	function count_filtered($con)
    {
    	$this->_get_datatables_query($con);
        $query = $this->db->get();
        return $query->num_rows();
    }

	

    public function GetData($table,$field='',$condition='',$group='',$order='',$limit='')
    {
        if($field != '')
        $this->db->select($field);
        if($condition != '')
        $this->db->where($condition);
        if($order != '')
        $this->db->order_by($order);
        if($limit != '')
        $this->db->limit($limit);
        if($group != '')
        $this->db->group_by($group);
        return $this->db->get($table)->result();
    }

}