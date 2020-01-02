<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_salaries_model extends CI_Model
{

  var $column_order = array(null,'a.name','a.status',null);
    var $order = array('a.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query($condition)
  {
        $this->db->select('es.*,a.name,a.salary,med.working_days,med.actual_working_days,d.designation_name');
        $this->db->from('emp_salary es');
        $this->db->join('admin a',"a.id = es.emp_id","left");
        $this->db->join('monthwise_emp_details med',"med.emp_id = a.id","left");
        $this->db->join('designation d',"d.id = a.designation_id","left");
       
        $this->db->where($condition);
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  a.name LIKE '%".trim($show_string)."%' )";
                    
                    $this->db->where($cond);
                }
            }
        $i++;
        
        if(isset($_POST['order'])) // here order processing
        {
            
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

  function get_datatables($condition)
    {
        $this->_get_datatables_query($condition);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

   public function count_all($condition)
    {    
        $this->_get_datatables_query($condition);
        return $this->db->count_all_results();
    }


  function count_filtered($condition)
    {
        $this->_get_datatables_query($condition);
        $query = $this->db->get();
        return $query->num_rows();
    }

   function get_customerdata($con)
    {
        $this->db->select('a.*,s.state_name,c.city_name,d.designation_name,a.designation_id');
        $this->db->from('admin a');
        $this->db->join('designation d',"d.id = a.designation_id","left");
        $this->db->join('states s',"s.id = a.state_id","left");
        $this->db->join('cities c',"c.id = a.city_id","left");
        $this->db->where($con);
       	return $this->db->get()->row();
    } 


}