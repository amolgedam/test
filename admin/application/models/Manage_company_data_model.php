<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_company_data_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 var $column_order = array(null,'c.state','c.company_data','c.address','c.email','c.active_description',null);
 var $order = array('c.id' => 'ASC'); 
 private function _get_datatables_query($cond)
  {
        $this->db->select('c.*,a.name');
        $this->db->from('company_data c');
       $this->db->join('admin a','a.id=c.assign_id','left');
        $this->db->where($cond);  
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  c.state LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  c.company_data LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  c.address LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  c.email LIKE '%".trim($show_string)."%'";
                    $cond.=" OR  c.active_description LIKE '%".trim($show_string)."%') ";
                   
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
    public function insert_excel($data)
    {
    	$this->db->insert_batch('company_data',$data);
    }

  }