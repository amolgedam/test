<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subcategory_model extends CI_Model
{

  var $column_order = array(null,'categories.cat_name','subcategories.subcat_name','subcategories.one_liter_price','subcategories.half_liter_price','subcategories.status',null); //set column field database for datatable
    var $order = array('subcategories.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query($cond)
  {
        $this->db->select('subcategories.*,categories.cat_name');
        $this->db->from('subcategories');
        $this->db->join('categories','categories.id=subcategories.categories_id','left');
        $this->db->where($cond);
        
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" ( categories.cat_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR subcategories.subcat_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR subcategories.one_liter_price LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR subcategories.half_liter_price LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR subcategories.status LIKE '%".trim($show_string)."%') ";
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