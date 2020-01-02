<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quotation_model extends CI_Model
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
                    $cond.=" OR  c.email_id LIKE '%".trim($show_string)."%') ";
                   
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
       $this->db->select('q.*,c.customer_name,c.email,c.mobile_no');
        $this->db->from('quotation q');
        $this->db->join('customer_master c','c.id=q.customer_id','left');
        return $this->db->count_all_results();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
     function count_client_filtered($con)
    {
        $this->db->simple_query('SET SESSION group_concat_max_len=1000000000');
        $this->_get_datatables_query($con);
        $this->db->select('count(*) as total_count,group_concat(id) as ids');   
        //$this->db->where($con);
        $query = $this->db->get();
        return $query->row();     }
     function customer_detail($con)
    {
        $this->db->select('cm.customer_name,cm.email,cm.address,cm.pin_code,s.state_name,c.country_name,ct.city_name');
        $this->db->from('customer_master cm');
        $this->db->join('states s','s.id=cm.state_id', 'left'); 
        $this->db->join('cities ct','ct.id=cm.city_id ', 'left'); 
        $this->db->join('countries c','c.id=cm.country_id', 'left'); 
        $this->db->where($con);
       return $this->db->get()->row();
     } 
     
     function quotation_view($con)
    {
        $this->db->select('q.*,cm.customer_name,cm.email,cm.mobile_no,cm.address');
        $this->db->from('quotation q');
        $this->db->join('customer_master cm','cm.id=q.customer_id','left'); 
        $this->db->where($con);
       return $this->db->get()->row();
    } 
}