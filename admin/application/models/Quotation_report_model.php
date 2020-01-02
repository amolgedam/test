<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quotation_report_model extends CI_Model
{

    var $column_order = array(null,'c.customer_name','c.email','c.mobile_no','q.total_amount','q.quotation_date'); //set column field database for datatable orderable
    var $column_search = array('c.customer_name','c.email','c.mobile_no','q.total_amount','q.quotation_date'); //set column field database for datatable searchable 
    var $order = array('q.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
    
    private function _get_datatables_query()
    {
        $this->db->select('q.*,c.customer_name,c.email,c.mobile_no');
        $this->db->from('quotation q');
        $this->db->join('customer_master c','c.id=q.customer_id','left');
       
        $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  c.customer_name LIKE '%".trim($show_string)."%'  ";
                    $cond.=" OR c.mobile_no LIKE '%".trim($show_string)."%'  ";
                    // $cond.=" OR ql.product_name LIKE '%".trim($show_string)."%'  ";
                    $cond.=" OR  c.email LIKE '%".trim($show_string)."%') ";
                   
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
    
    function customer_detail($con)
    {
        $this->db->select('q.*,c.customer_name,c.email,c.mobile_no,ql.product_name,ql.price,ql.quantity,ql.total, ql.description,ql.gst,c.address,c.city_id,ql.discount');
        $this->db->from('quotation q');
        $this->db->join('quotation_log ql','ql.quotation_id=q.id','left');
        $this->db->join('customer_master c','c.id=q.customer_id','left');
        $this->db->where($con);
       return $this->db->get()->row();
     } 
}