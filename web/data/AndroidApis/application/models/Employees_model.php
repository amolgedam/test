<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employees_model extends CI_Model
{

  var $column_order = array(null,'emp.name','emp.email','emp.mobile','emp.address','emp.status',null); //set column field database for datatable orderable
   // var $column_search = array('ms.country_name','md.state_name','mc.city_name','mc.status'); //set column field database for datatable searchable 
    var $order = array('emp.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query($con)
  {
        $this->db->select('emp.*');
        $this->db->from('employees emp');
        $this->db->where($con);
        
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = "";
                    $cond.=" ( emp.name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR emp.email LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR emp.mobile LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR emp.address LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  emp.status LIKE '%".trim($show_string)."%') ";
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
       $this->_get_datatables_query($con);
        return $this->db->count_all_results();
    }


    function count_filtered($con)
    {
       
        $this->_get_datatables_query($con);
        $query = $this->db->get();
        return $query->num_rows();
    }

     public function getCustomerData($cond)
    {
        $this->db->select('u.id,u.name,u.mobile,u.email,u.latitude,u.longitude,u.image,u.address,c.cat_name,sc.subcat_name,sc.one_liter_price,sc.half_liter_price,u.pliter,u.empnew_id,u.user_status,u.executive_id,u.user_hold');
        $this->db->from('users u');
        $this->db->join('categories c','c.id=u.pcat','left');
        $this->db->join('subcategories sc','sc.id=u.pid','left');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->result();
    }

    


}