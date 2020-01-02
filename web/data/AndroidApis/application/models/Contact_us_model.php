<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_us_model extends CI_Model
{

	var $column_order = array(null,'contact_us.first_name','contact_us.last_name','contact_us.mobile_no','contact_us.email_id','contact_us.pin_code','affilation_centers.status',null); //set column field database for datatable orderable
   // var $column_search = array(' countries.country_name',' countries.status'); //set column field database for datatable searchable 
    var $order = array('contact_us.id' => 'desc'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query()
	{
		$this->db->select('contact_us.*,country.country_name,sta.state_name,ci.city_name');
       //$this->db->where('main_courses.is_delete="No"');
        $this->db->from('contact_us');
        $this->db->join('countries country','country.id=contact_us.country','left');
        $this->db->join('states sta','sta.id=contact_us.state','left');
        $this->db->join('cities ci','ci.id=contact_us.city','left');
        $this->db->order_by('id desc');
		
		$i = 0;

        if($_POST['search']['value']) // if datatable send POST for search
        {
            $explode_string = explode(' ', $_POST['search']['value']);
            foreach ($explode_string as $show_string) {
                $cond  = " ";
                $cond.=" (contact_us.first_name LIKE '%".$show_string."%' ";
                $cond.=" OR contact_us.last_name LIKE '%".$show_string."%' ";
                $cond.=" OR contact_us.mobile_no LIKE '%".$show_string."%' ";
                $cond.=" OR contact_us.email_id LIKE '%".$show_string."%' ";       
                $cond.=" OR contact_us.pin_code LIKE '%".$show_string."%' ";             
                $cond.=" OR contact_us.status LIKE '%".$show_string."%')";
                $this->db->where($cond);


                
            }

        } 
         
        
        //if(isset($_POST['order'])) // here order processing
        // {
        //     //print_r($this->column_order);exit;
        //     $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        // } 
        // else if(isset($this->order))
        // {
        //     $order = $this->order;
        //     $this->db->order_by(key($order), $order[key($order)]);
        // }
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
       $this->db->select('contact_us.*,country.country_name,sta.state_name,ci.city_name');
       //$this->db->where('main_courses.is_delete="No"');
        $this->db->from('contact_us');
        $this->db->join('countries country','country.id=contact_us.country','left');
        $this->db->join('states sta','sta.id=contact_us.state','left');
        $this->db->join('cities ci','ci.id=contact_us.city','left');
        //$this->db->where($cond);
        $this->db->order_by('id desc');
        return $this->db->count_all_results();
    }


	function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }



     function get_contact_view($con)
    {
         $this->db->select('contact_us.*,country.country_name,sta.state_name,ci.city_name');
       //$this->db->where('main_courses.is_delete="No"');
        $this->db->from('contact_us');
        $this->db->join('countries country','country.id=contact_us.country','left');
        $this->db->join('states sta','sta.id=contact_us.state','left');
        $this->db->join('cities ci','ci.id=contact_us.city','left');
        $this->db->where($con);
       return $this->db->get()->row();
        //return $this->db->get('affilation_centers ac')->row();
    }

     function get_coursesname($condition)
    {
        $this->db->select('ac.*,mc.course_name');
        $this->db->from('affilation_courses ac');
        $this->db->join('main_courses mc','mc.id=ac.main_course_id','left');
        $this->db->where($condition);
       return $this->db->get()->result();
        //return $this->db->get('affilation_centers ac')->row();
    }



    


}