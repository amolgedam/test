<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Designation_model extends CI_Model
{

    function __construct()
    {
        parent::__construct(); 
    }
  
  private function _get_datatables_query($cond="")
  {
        $this->db->from('designation md');
        if ($cond!="") 
        {
           $this->db->where($cond);
        }
        $this->db->order_by('md.id','desc');
        
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  md.designation_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  md.status LIKE '%".trim($show_string)."%') ";
                   
                    $this->db->where($cond);
                }
            }
        $i++;
        
       
    }

  function get_datatables($cond="")
    {
        $this->_get_datatables_query($cond);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

   public function count_all($cond="")
    {  
        $this->db->from('designation md');
        if ($cond!="") 
        {
           $this->db->where($cond);
        }
        $this->db->order_by('md.id','desc');
        return $this->db->count_all_results();
    }


  function count_filtered($cond="")
    {
        $this->_get_datatables_query($cond);
        $query = $this->db->get();
        return $query->num_rows();
    }

/**************************************/
public function expence_report($cond="")
{
     $this->db->select('md.*');
        $this->db->from('manage_designation md');
        if ($cond!="") 
        {
           $this->db->where($cond);
        }
        $this->db->order_by('md.id','desc');
         $query = $this->db->get();
        return $query->result();
}

}