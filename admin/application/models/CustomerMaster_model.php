<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CustomerMaster_model extends CI_Model
{

  var $column_order = array(null,'c.city_name','mc.customer_name','mc.email','mc.mobile_no','mc.status',null);
    var $order = array('mc.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query()
  {
        $this->db->select('mc.*,c.city_name');
        $this->db->from('customer_master mc');
        $this->db->join('cities c',"c.id = mc.city_id","left");
        
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  mc.customer_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  c.city_name LIKE '%".trim($show_string)."%' ";
                    //$cond.=" OR  b.branch_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.email LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.mobile_no LIKE '%".trim($show_string)."%' ";
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
        $this->db->select('mc.*,c.city_name');
        //$this->db->where('mc.is_delete="No"');
        $this->db->from('customer_master mc');
        $this->db->join('cities c',"c.id = mc.city_id","left");
        //$this->db->join('branch_master b',"b.id = mc.branch_id","left");
        return $this->db->count_all_results();
    }


  function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

   function get_customerdata($con)
    {
        $this->db->select('ac.*');
        $this->db->from('customer_master ac');
        
        $this->db->where($con);
       return $this->db->get()->row();
        //return $this->db->get('affilation_centers ac')->row();
    } 


}