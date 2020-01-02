<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Countries_model extends CI_Model
{

	var $column_order = array(null,'countries.country_name','countries.country_code','countries.currency_name','countries.sort_by','countries.status',null); //set column field database for datatable orderable
   // var $column_search = array(' countries.country_name',' countries.status'); //set column field database for datatable searchable 
    var $order = array('id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query()
	{
		$this->db->select('countries.*');
       $this->db->where('countries.is_delete="No"');
        $this->db->from('countries');
        $this->db->order_by('id desc');
		
		$i = 0;
     
        /*if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" ( countries.country_name  LIKE '%".trim($show_string)."%' ";
                   
                    $cond.=" OR  countries.status LIKE '%".trim($show_string)."%') ";
                    $this->db->where($cond);
                }
            }
        $i++;*/

        if($_POST['search']['value']) // if datatable send POST for search
        {
            $explode_string = explode(' ', $_POST['search']['value']);
            foreach ($explode_string as $show_string) {
                $cond  = " ";
                $cond.=" (countries.country_name LIKE '%".$show_string."%' ";
                $cond.=" OR countries.country_code LIKE '%".$show_string."%' ";
                $cond.=" OR countries.currency_name LIKE '%".$show_string."%' ";
                $cond.=" OR countries.sort_by LIKE '%".$show_string."%' ";
         
                $cond.=" OR countries.status LIKE '%".$show_string."%')";
                $this->db->where($cond);


                
            }

        } 
         
        
        //if(isset($_POST['order'])) // here order processing
        // {
        //     //print_r($this->column_order);exit;
        //     $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        // } 
        // else if(isset($this->order))
        // {
        //     $order = $this->order;
        //     $this->db->order_by(key($order), $order[key($order)]);
        // }
    }

	function get_datatables($table)
    {
        $this->_get_datatables_query($table);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

	 public function count_all()
    {    
        $this->db->select('countries.*');
       $this->db->where('countries.is_delete="No"');
        $this->db->from('countries');
        return $this->db->count_all_results();
    }


	function count_filtered($table)
    {
        $this->_get_datatables_query($table);
        $query = $this->db->get();
        return $query->num_rows();
    }

    


}