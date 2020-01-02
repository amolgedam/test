<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Api_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function getCustomerData($cond)
    {
        $this->db->select('u.id,u.name,u.mobile,u.latitude,u.longitude,u.image,u.address,u.total_amt,c.cat_name,sc.subcat_name,sc.one_liter_price,sc.half_liter_price,u.pliter');
        $this->db->from('users u');
        $this->db->join('categories c','c.id=u.pcat','left');
        $this->db->join('subcategories sc','sc.id=u.pid','left');
        $this->db->where($cond);
        $this->db->order_by("u.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    
    
    
}