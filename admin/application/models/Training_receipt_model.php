<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Training_receipt_model extends CI_Model
{

  var $column_order = array(null,'a.trainee_name',null);
 /*   var $order = array('a.id' => 'DESC'); */

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query()
  {
        $this->db->select('a.*');
        $this->db->from('training a');
     /*   $this->db->join('designation d',"d.id = a.designation_id","left");
        $this->db->join('states s',"s.id = a.state_id","left");
        $this->db->join('cities c',"c.id = a.city_id","left");*/
  
       /* $this->db->where($condition);*/
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  a.trainee_name LIKE '%".trim($show_string)."%' ";
               
                    $cond.=" OR  a.status LIKE '%".trim($show_string)."%') ";
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

   function get_customerdata()
    {
        $this->db->select('a.*,');
        $this->db->from('training a');
     /*   $this->db->join('designation d',"d.id = a.designation_id","left");
        $this->db->join('states s',"s.id = a.state_id","left");
        $this->db->join('cities c',"c.id = a.city_id","left");
        $this->db->join('document doc',"doc.admin_id = a.id","left");
*/

        $this->db->where();
       	return $this->db->get()->row();
    } 


}