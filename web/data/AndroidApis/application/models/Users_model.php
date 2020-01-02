<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

  var $column_order = array(null,'e.name','us.name','us.email','us.mobile','us.login_type','us.status',null); //set column field database for datatable orderable
   // var $column_search = array('ms.country_name','md.state_name','mc.city_name','mc.status'); //set column field database for datatable searchable 
    var $order = array('us.id' => 'desc'); 

    function __construct()
    {
        parent::__construct();
    }
  
  private function _get_datatables_query($con)
  {
        $this->db->select('us.*,e.name as ename');
        $this->db->from('users us');
        $this->db->join('employees e','e.id=us.executive_id','left');
        $this->db->where($con);
        $this->db->order_by('us.id desc');
        
    
    $i = 0;
     
        if($_POST['search']['value']) // if datatable send POST for search
            {
                $explode_string = explode(' ', $_POST['search']['value']);
                foreach ($explode_string as $show_string) 
                {  
                    $cond  = "";
                    $cond.=" ( e.name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR us.name LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR us.email LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR us.mobile LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR us.login_type LIKE '%".trim($show_string)."%' ";
                    $cond.=" OR  us.status LIKE '%".trim($show_string)."%') ";
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
     function count_client_filtered($con)
    {
        $this->db->simple_query('SET SESSION group_concat_max_len=1000000000');
        $this->_get_datatables_query($con);
        $this->db->select('count(*) as total_count,group_concat(us.id) as ids');   
        //$this->db->where($con);
        $query = $this->db->get();
        return $query->row();
    }

    function GetuserViewData($con)
    {
        $this->db->select('us.*,e.name as ename,sb.subcat_name');
        $this->db->from('users us');
        $this->db->join('employees e','e.id=us.executive_id','left');
        $this->db->join('subcategories sb','sb.id=us.pid','left');
        $this->db->where($con);
        $query = $this->db->get();
        return $query->row();



    }

    


}