<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
     public function GetData($table,$field='',$condition='',$group='',$order='',$limit='',$result='')
    {
        if($field != '')
        $this->db->select($field);
        if($condition != '')
        $this->db->where($condition);
        if($order != '')
        $this->db->order_by($order);
        if($limit != '')
        $this->db->limit($limit);
        if($group != '')
        $this->db->group_by($group);
        if($result != '')
        {
            $return =  $this->db->get($table)->row();
        }else{
            $return =  $this->db->get($table)->result();
        }
        return $return;
    }
    public function get_single_record($table,$cond)
    {
        $this->db->select($table);
        if($cond !='')
        {
            $this->db->where($cond);
        }
         $return =  $this->db->get($table)->row();
    }
    public function get_single_recordAdmin($cond)
    {
        $this->db->select('u.*');
        $this->db->from('users u');
        if($cond !='')
        {
            $this->db->where($cond);
        }
        $query = $this->db->get();
        return $query->row();
    }

    public function GetDataArr($table,$field='',$condition='',$group='',$order='',$limit='',$result='')
    {
        if($field != '')
        $this->db->select($field);
        if($condition != '')
        $this->db->where($condition);
        if($order != '')
        $this->db->order_by($order);
        if($limit != '')
        $this->db->limit($limit);
        if($group != '')
        $this->db->group_by($group);
        if($result != '')
        {
            $return =  $this->db->get($table)->row_array();
        }else{
            $return =  $this->db->get($table)->result_array();
        }
        return $return;
    }

    public function SaveData($table,$data,$condition='')
    {
        $DataArray = array();
        if(!empty($data))
        {
            $data['created']=date("Y-m-d H:i:s");
            $data['modified']=date("Y-m-d H:i:s");
        }
        $table_fields = $this->db->list_fields($table);
        foreach($data as $field=>$value)
        {
            if(in_array($field,$table_fields))
            {
                $DataArray[$field]= $value;
            }
        }
       
        if($condition != '')
        {
            $this->db->where($condition);
            return $this->db->update($table, $DataArray);
        }else{
            return $this->db->insert($table, $DataArray);
        }
    }

    public function DeleteData($table,$condition='',$limit='')
    {
       if($condition != '')
        $this->db->where($condition);
        if($limit != '')
        $this->db->limit($limit);
        return $this->db->delete($table);
    }
    
     public function Getcartdata($cond)
    {
        $this->db->select('cart.*,subcategories.id as sub_cat_id,subcategories.subcat_name,subcategories.image,subcategories.quantity_in_kg,subcategories.price_per_kg,subcategories.minimum_kg,subcategories.maximum_kg');
        $this->db->from('cart');
        $this->db->join('subcategories','subcategories.id=cart.product_id','left');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->result();
    }
    public function Getserviceorderdetails($cond)
    {
        $this->db->select('service_orders_details.*,subcategories.id as sub_cat_id,subcategories.subcat_name,subcategories.image,subcategories.quantity_in_kg,subcategories.price_per_kg,subcategories.minimum_kg,subcategories.maximum_kg');
        $this->db->from('service_orders_details');
        $this->db->join('subcategories','subcategories.id=service_orders_details.product_id','left');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->result();
    }
    public function getloadmoredata($cond,$page)
    {
        $offset = $page;
        $limit = 10;
        /*$sql = "select * from cart limit $offset ,$limit";
        $result = $this->db->query($sql)->result();
        return $result;*/
        
         $this->db->select('cart.*,subcategories.id as sub_cat_id,subcategories.subcat_name,subcategories.image,subcategories.quantity_in_kg,subcategories.price_per_kg,subcategories.minimum_kg,subcategories.maximum_kg');
        $this->db->from('cart');
        $this->db->join('subcategories','subcategories.id=cart.product_id','left');
        $this->db->where($cond);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
        
        
        
    }
    public function getloadmoreProductdata($cond,$page)
    {
        $offset = $page;
        $limit = 10;
        $this->db->select('sub.*');
        $this->db->from('subcategories sub');
        $this->db->where($cond);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();


    }
    

   

}
?>