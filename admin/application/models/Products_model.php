<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products_model extends CI_Model
{

  var $column_order = array(null,'p.product_name','categories.category_name','p.rate','p.status','p.model_no',null); //set column field database for datatable orderable
    var $column_search = array('p.product_name','categories.category_name','p.rate','p.status','p.model_no'); //set column field database for datatable searchable 
    var $order = array('p.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query()
  {
        $this->db->select('i.*');
        $this->db->from('product i');
        
        $this->db->order_by('i.id','desc');
        
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  i.type LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  i.title LIKE '%".trim($show_string)."%') ";
                   
                    $this->db->where($cond);
                }
            }
        $i++;
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

   /* public function getProductData($con)
    {
         $this->db->select('p.*,categories.category_name,subcategory.subCategory_name');
         $this->db->from('products p');
         $this->db->join('categories','categories.id=p.category_id','left');
         $this->db->join('subcategory','subcategory.id=p.subcategory_id','left');
         $this->db->where($con);
         $query = $this->db->get();
         return $query->row();
    }   */
}