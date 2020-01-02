<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

  var $column_order = array(null,'mc.enq_code','mc.name','mc.mobile_no','mc.email_id','mc.enquiry_date','mc.city','mc.profession','mc.joining_plan','mc.status',null); //set column field database for datatable orderable
   // var $column_search = array('ms.country_name','md.state_name','mc.city_name','mc.status'); //set column field database for datatable searchable 
    var $order = array('mc.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query($con)
  {
        $this->db->select('mc.*');
        $this->db->from('enquiry mc');
        $this->db->where($con);
        //$this->db->join('expence_master cm',"cm.id =mc.expence_master_id","left");
         $i = 0;
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  mc.enq_code LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.mobile_no LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.email_id LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.enquiry_date LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.city LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.profession LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.joining_plan LIKE '%".trim($show_string)."%' ";
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
         $this->db->select('mc.*');
        $this->db->from('enquiry mc');
        $this->db->where($con);
        //$this->db->join('expence_master cm',"cm.id =mc.expence_master_id","left");
        return $this->db->count_all_results();
    }


     function count_filtered($con)
    {
        $this->_get_datatables_query($con);
        $query = $this->db->get();
        return $query->num_rows();
    }

    


}