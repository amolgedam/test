<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LLP_company_data_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 var $column_order = array(null,'lp.state','lp.company_name','lp.address','lp.email','lp.description',null);
 var $order = array('lp.id' => 'ASC'); 
 private function _get_datatables_query($cond)
  {
        $this->db->select('lp.*,a.name');
        $this->db->from('llp_company_data lp');
        $this->db->join('admin a','a.id=lp.assign_id','left');
    
        $this->db->where($cond);
         
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  lp.state LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  lp.company_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  lp.address LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  lp.email LIKE '%".trim($show_string)."%'";
                    $cond.=" OR  lp.description LIKE '%".trim($show_string)."%') ";
                   
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
    

  }