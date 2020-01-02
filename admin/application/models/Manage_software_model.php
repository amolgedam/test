<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_software_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query($cond="")
  {
        
        $this->db->select('sd.*');
        $this->db->from('software_details sd');
        $this->db->order_by('sd.id','desc');
        $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  sd.software_details LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  sd.status LIKE '%".trim($show_string)."%') ";
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
        $this->_get_datatables_query($cond);
        return $this->db->count_all_results();
    }


  function count_filtered($cond="")
    {
        $this->_get_datatables_query($cond);
        $query = $this->db->get();
        return $query->num_rows();
    }

/**************************************/
public function view_software($cond="")
{
    $this->db->select('sd.*,s.title');
    $this->db->from('software_details sd');
    $this->db->join('software s','s.id=sd.software_title_id','left');
    $this->db->where($cond);
    return $this->db->get()->row();
}

}