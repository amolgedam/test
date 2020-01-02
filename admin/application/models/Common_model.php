<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
       
        $this->load->model('Common_model');
        /*keep this code for load database*/
        $this->load->database();
        $this->load->helper('security');
    }
    public function getbankDetail($condition)
{
    $this->db->select('bank_details.*,mst_bank.bank_name');
    $this->db->from('bank_details');
    $this->db->join('mst_bank','mst_bank.id=bank_details.bank_id','left');
    $this->db->where($condition);
    $query = $this->db->get();
    return $query->result();
}
    function convertDateFormat($date)
    {
        $replacedate = str_replace('/','-',$date);
        $converted_date = date('Y-m-d',strtotime($replacedate));
        return $converted_date;
    }

	//get save and update
    public function SaveData($table,$data,$condition='')
    {
        $DataArray = array();
        if(empty($condition))
        {
            $data['created']=date("Y-m-d H:i:s");
            $data['modified']=date("Y-m-d H:i:s");
        } else {
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
            $this->db->update($table, $DataArray);
        }else{
            $this->db->insert($table, $DataArray);
        }
    }

	//get data
	function get_data($table,$con='',$order='',$limit='',$group='')
	{
		if($con!='')
		$this->db->where($con);
		if($order != '')
		$this->db->order_by($order);
		if($limit != '')
        $this->db->limit($limit);
        if($group != '')
        $this->db->group_by($group);
        return $this->db->get($table)->result();
	}
	
     function get_multiple_record($table, $con='',$order='',$limit='',$group='')
    {   
        if($con != '')
        $this->db->where($con);
        if($order != '')
        $this->db->order_by($order);
        if($limit != '')
        $this->db->limit($limit);
        if($group != '')
        $this->db->group_by($group);
        return $this->db->get($table)->result();
    }
	// delete data
    function delete($table,$con)
    {
        $this->db->where($con);
        $this->db->delete($table);
    }
    /*get Criteria wise filter */
   function GetData($table,$select = '',$con='',$group='',$order='',$limit='',$record='')
    {
        if(empty($select))
        {
            $this->db->select("*");         
        }else{
            $this->db->select($select);     
        }
        if($con!='')
        $this->db->where($con);
        if($order != '')
        $this->db->order_by($order);
        if($limit != '')
        $this->db->limit($limit);
        if($group != '')
        $this->db->group_by($group);
        if(!empty($record))
        return $this->db->get($table)->row();
        else
        return $this->db->get($table)->result();
    }
    public function GetFieldData($table,$field='',$condition='',$group='',$order='',$limit='',$result='',$having='')
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
        if($having != '')
        $this->db->having($having);
        if($result != '')
        {
            $return =  $this->db->get($table)->row();
        }else{
            $return =  $this->db->get($table)->result();
        }
        return $return;
    } 
  

    function get_single_record($tablename,$condition)
    {
            $this->db->where($condition);   
            return $this->db->get($tablename)->row();
    }

    public function save($table,$data,$condition='')
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
          $this->db->update($table, $DataArray);
      }else{
          $this->db->insert($table, $DataArray);
      }
  }

    public function get_currencys($condition)
{
    $this->db->select('currency_city_mapping.*,countries.currency_name,countries.buy_rate,cities.city_name,countries.country_code');
    $this->db->from('currency_city_mapping');
    $this->db->join('countries','countries.id=currency_city_mapping.country_id','inner');
    $this->db->join('cities','cities.id=currency_city_mapping.city_id','inner');
    $this->db->where($condition);
     $this->db->order_by('countries.sort_by,cities.city_name ASC');
    //$this->db->group_by('countries.id');
    $query = $this->db->get();
    return $query->result();
}


public function get_currency()
{
    $this->db->select('currency_city_mapping.*,countries.currency_name,cities.city_name,countries.country_code,countries.buy_rate');
    $this->db->from('currency_city_mapping');
    $this->db->join('countries','countries.id=currency_city_mapping.country_id','inner');
    $this->db->join('cities','cities.id=currency_city_mapping.city_id','inner');
    $this->db->where("countries.status='Active' and countries.is_cash_currency='Yes' and currency_city_mapping.is_delete='No'");
    $this->db->order_by('countries.sort_by,cities.city_name ASC');
    $this->db->group_by('countries.id');
    $query = $this->db->get();
    return $query->result();
}

public function get_currency_city()
{
    $this->db->select('currency_city_mapping.*,countries.currency_name,countries.buy_rate,cities.city_name');
    $this->db->from('currency_city_mapping');
    $this->db->join('countries','countries.id=currency_city_mapping.country_id','inner');
    $this->db->join('cities','cities.id=currency_city_mapping.city_id','inner');
    $this->db->order_by('cities.id,cities.city_name ASC');
    $this->db->group_by('cities.id');
    $query = $this->db->get();
    return $query->result();
}

public function get_city($condition)
{
    $this->db->select('currency_city_mapping.*,countries.currency_name,countries.buy_rate,cities.city_name,countries.country_code');
    $this->db->from('currency_city_mapping');
    $this->db->join('countries','countries.id=currency_city_mapping.country_id','inner');
    $this->db->join('cities','cities.id=currency_city_mapping.city_id','inner');
    $this->db->order_by('cities.id,cities.city_name,countries.sort_by ASC');
    $this->db->where($condition);
    $query = $this->db->get();
    return $query->result();
}

   
   function GetPurchaseData($cond)
   {
    $this->db->select('pm.id,bill_date,sum(pd.quantity) as total_purchase');
    $this->db->from('purchase_master pm');
    $this->db->join('purchase_details pd','pd.purchase_id=pm.id','left');
    $this->db->where($cond);
    return $this->db->get()->row();
   }

   function GetSaleData($cond)
   {
    $this->db->select('bm.bill_no,billing_date,sum(bd.qty) as total_sale');
    $this->db->from('billing_master bm');
    $this->db->join('billing_details bd','bd.bill_no=bm.bill_no','left');
    $this->db->where($cond);
    return $this->db->get()->row();
   }
   
    public function GetTodaysAmc($cond)
    {
         $this->db->select('amc.customer_id,cm.customer_name,cm.contact1');
        $this->db->from('amc');
        $this->db->join('customer_master cm','cm.id=amc.customer_id','left');
        $this->db->where($cond);
        return $this->db->get()->result();
    }
}

?>
