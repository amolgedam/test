<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

class Students_model extends CI_Model
{   
	var $column_order = array(null,'students.name',null); //set column field database for datatable 
   
    var $order = array('students.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query($con)
  {
        $this->db->select('students.*');
        $this->db->from('students');
        $this->db->where($con);
        $i = 0;
        if($_POST['search']['value']) // if datatable send POST for search
            {
            $explode_string = explode(' ', $_POST['search']['value']);
            foreach ($explode_string as $show_string) 
            {  
            $cond  = " ";
            $cond.=" ( students.name LIKE '%".trim($show_string)."%' ";    
            $cond.=" OR  students.status LIKE '%".trim($show_string)."%') ";
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
}
?>