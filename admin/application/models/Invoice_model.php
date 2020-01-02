<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice_model extends CI_Model
{

    var $column_order = array(null,'c.customer_name','i.amount','i.discount_amount','i.total_amount','i.status');
    var $column_search = array('c.customer_name','i.amount','i.discount_amount','i.total_amount','i.status');
    var $order = array('i.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
    
    private function _get_datatables_query()
    {
        $this->db->select('i.*,c.customer_name');
        $this->db->from('invoice_wo i');
        $this->db->join('customer_master c','c.id=i.customer_id','left');
        $i = 0;
     
        if($_POST['search']['value'])
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  c.customer_name LIKE '%".trim($show_string)."%'  ";
                    $cond.=" OR i.amount LIKE '%".trim($show_string)."%'  ";
                    $cond.=" OR i.discount_amount LIKE '%".trim($show_string)."%'  ";
                    $cond.=" OR i.status LIKE '%".trim($show_string)."%'  ";
                    $cond.=" OR i.total_amount LIKE '%".trim($show_string)."%') ";
                   
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
        $this->db->select('i.*,c.customer_name');
        $this->db->from('invoice_wo i');
        $this->db->join('customer_master c','c.id=i.customer_id','left');
        return $this->db->count_all_results();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
}