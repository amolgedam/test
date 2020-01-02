<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class States_model extends CI_Model
{

	var $column_order = array(null,'c.country_name','s.state_name','s.state_code','s.status',null); //set column field database for datatable orderable
    //var $column_search = array('c.country_name','s.district_name',' s.status'); //set column field database for datatable searchable 
    var $order = array('s.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query()
	{
		$this->db->select('s.*,c.country_name');
        $this->db->from('states s');
        $this->db->where('s.is_delete="No"');
        $this->db->join("countries c","c.id = s.country_id","left");
		
		$i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  c.country_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  s.state_name LIKE '%".trim($show_string)."%' ";
                     $cond.=" OR  s.state_code LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  s.status LIKE '%".trim($show_string)."%') ";
                    $this->db->where($cond);
                }
            }
        $i++;
        
        if(isset($_POST['order'])) // here order processing
        {
            //print_r($this->column_order);exit;
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

	function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

	 public function count_all()
    {    
       $this->db->select('s.*,c.country_name');
        
        $this->db->from('states s');
        $this->db->where('s.is_delete="No"');
        $this->db->join("countries c","c.id = s.country_id","left");
        return $this->db->count_all_results();
    }


	function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    


}