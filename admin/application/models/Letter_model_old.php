<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Letter_model extends CI_Model
{

  var $column_order = array(null,'ct.title','el.status',null);
    var $order = array('el.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
  
  public function _get_datatables_query($con)
  {
        $this->db->select('el.*,ct.title');
        $this->db->from('employee_letters el');
        $this->db->join('certificate_type ct',"ct.id = el.certificate_id",'left');
      
       $this->db->where($con);
        
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = " ";
                    $cond.=" (  el.status LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  ct.title LIKE '%".trim($show_string)."%' ";
                  //  $cond.=" OR  a.name LIKE '%".trim($show_string)."%' ";
                  /*  $cond.=" OR  mc.email LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.mobile_no LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  mc.status LIKE '%".trim($show_string)."%') ";*/
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
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

   public function count_all($con)
    {    
        $this->db->select('el.*,ct.title');
       
        $this->db->from('employee_letters el');
        $this->db->join('certificate_type ct',"ct.id = el.id");
      //  $this->db->join('admin a',"a.id = el.id");
        return $this->db->count_all_results();
    }


  function count_filtered($con)
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

  function get_letter_data($con)
    {
        $this->db->select('el.*,ct.title');
        $this->db->from('employee_letters el');
        $this->db->join('certificate_type ct',"ct.id=el.certificate_id",'left');
     /*   $this->db->join('admin a',"a.id=el.id",'join');
        $this->db->join('designation d',"d.id=el.id",'join');
        $this->db->join('settings s',"s.id=el.id",'join');*/
        
        $this->db->where($con);
       return $this->db->get()->row();
       
    } 

   


}