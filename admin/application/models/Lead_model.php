<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lead_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    } 
  
  private function _get_datatables_query($con)
  {
        $this->db->select('ml.*,ad.id as created_by,ad.name,a.name as assign_to_name');
        $this->db->from('manage_lead ml');
        $this->db->join('admin ad','ad.id=ml.created_by','left');
        $this->db->join('admin a','a.id=ml.assign_to','left');
        $this->db->order_by('ml.id','desc');
        $this->db->where($con);
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  ad.name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  ml.client_name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  ml.client_mobile LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  ml.requred_product LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  ml.date LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  ml.follop_date LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  ml.appoint_date LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  ml.status LIKE '%".trim($show_string)."%') ";
                   
                    $this->db->where($cond);
                }
            }
        $i++;
        
       
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

/**************************************/
public function expence_report($cond="")
{
     $this->db->select('ml.*');
        $this->db->from('manage_lead ml');
        if ($cond!="") 
        {
           $this->db->where($cond);
        }
        $this->db->order_by('ml.id','desc');
         $query = $this->db->get();
        return $query->result();
}

}