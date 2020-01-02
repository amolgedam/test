<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Our_Service_model extends CI_Model
{
    

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query($cond="")
  {
        $this->db->select('s.*');
        $this->db->from('ourservice s');
        if ($cond!="") 
        {
           $this->db->where($cond);
        }
        $this->db->order_by('s.id','desc');
        
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  s.heading LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  s.status LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  s.description LIKE '%".trim($show_string)."%') ";
                   
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
        $this->db->from('ourservice s');
        if ($cond!="") 
        {
           $this->db->where($cond);
        }
        $this->db->order_by('s.id','desc');
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
     $this->db->select('s.*');
        $this->db->from('ourservice s');
        if ($cond!="") 
        {
           $this->db->where($cond);
        }
        $this->db->order_by('s.id','desc');
         $query = $this->db->get();
        return $query->result();
}

}