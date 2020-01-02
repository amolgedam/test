<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms_contents_model extends CI_Model
{

    public $table = 'cms_contents';
    public $id = 'id';
    //public $order = 'DESC';
    //datatables
    var $column_order = array(null,'cms_contents.title','cms.display_name','cms_contents.description','cms_contents.status',null); // custom order 
    var $column_search = array('cms_contents.title','cms.display_name','cms_contents.description','cms_contents.status'); //set column field database for datatable searchable 
    var $order = array('cms_contents.id' =>'DESC'); // default order 
    
    function __construct()
    {
        parent::__construct();
    }
    
    /*Data table server side*/
     private function _get_datatables_query($table,$condition='')
    {
        
        $this->db->select('cms_contents.*,cms.display_name');
        $this->db->from("cms_contents");
        $this->db->join("cms_types cms","cms.id=cms_contents.cms_type","left");

        $i = 0;
    
        if($_POST['search']['value']) // if datatable send POST for search
        {
            $explode_string = explode(' ', $_POST['search']['value']);
            foreach ($explode_string as $show_string) {
                $cond  = " ";
                $cond.=" (cms_contents.title LIKE '%".$show_string."%' ";
                $cond.=" OR  cms_contents.type LIKE '%".$show_string."%' ";
                $cond.=" OR cms_contents.status LIKE '%".$show_string."%')";
                $this->db->where($cond);


                
            }

        } 
        
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

    function get_datatables($table,$condition='')
    {
        if(!empty($condition))
        $this->db->where($condition);
        $this->_get_datatables_query($table,$condition);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all($table,$condition='')
    {    
         if(!empty($condition))
        $this->db->where($condition);
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    function count_filtered($table,$condition='')
    {
        if(!empty($condition))
        $this->db->where($condition);
        $this->_get_datatables_query($table,$condition);
        $query = $this->db->get();
        return $query->num_rows();
    }
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
   

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    public function viewCms($con)
    {

         $this->db->select('cms_contents.*,cms.display_name');
        $this->db->from("cms_contents");
        $this->db->join("cms_types cms","cms.id=cms_contents.cms_type","left");
        $this->db->where($con);
        $query = $this->db->get();
        return $query->row();
    }

}

