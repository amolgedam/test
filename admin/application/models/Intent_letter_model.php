<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Intent_letter_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query()
  {
        $this->db->select('i.*,d.designation_name');
        $this->db->from('intent_letter i');
         $this->db->join('designation d',"d.id = i.designation_id",'left'); 
        $this->db->order_by('i.id','desc');
        
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (i.name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  i.mobile LIKE '%".trim($show_string)."%') ";
                  
                   
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

/**************************************/
 function get_letter_data($con)
    {
        $this->db->select('i.*,d.designation_name');
        $this->db->from('intent_letter i');
         $this->db->join('designation d',"d.id = i.designation_id",'left'); 
    
        $this->db->where($con);
       return $this->db->get()->row();
       
    } 

}