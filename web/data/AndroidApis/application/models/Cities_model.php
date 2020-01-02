<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cities_model extends CI_Model
{

    var $column_order = array(null,'ms.country_name','md.state_name','mc.city_name','mc.city_code','mc.sort_by','mc.status',null); //set column field database for datatable orderable
   // var $column_search = array('ms.country_name','md.state_name','mc.city_name','mc.status'); //set column field database for datatable searchable 
    var $order = array('mc.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
    
    private function _get_datatables_query()
    {
        $this->db->select('mc.*,ms.country_name,md.state_name');
        $this->db->from('cities mc');
        $this->db->join("countries ms","ms.id = mc.country_id","left");
        $this->db->join("states md","md.id = mc.state_id","left");
        
        $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  ms.country_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  md.state_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.city_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.status LIKE '%".trim($show_string)."%') ";
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
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }


    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    


}