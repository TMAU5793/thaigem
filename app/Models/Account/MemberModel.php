<?php

namespace App\Models\Account;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class MemberModel extends Model
{
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }
    public function getProductMainType()
    {        
        $sql = "SELECT * FROM tbl_productcategory WHERE maincate_id = ? AND status = ?";
        $query = $this->db->query($sql, [0,'1']);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    public function getProductType()
    {        
        $sql = "SELECT * FROM tbl_productcategory WHERE status = ? ORDER BY maincate_id ASC";
        $query = $this->db->query($sql, ['1']);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    public function getBusinessMainType()
    {        
        $sql = "SELECT * FROM tbl_business WHERE main_type = ? AND status = ?";
        $query = $this->db->query($sql, [0,'1']);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    public function getBusinessType()
    {        
        $sql = "SELECT * FROM tbl_business WHERE status = ? ORDER BY main_type ASC";
        $query = $this->db->query($sql, ['1']);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    public function getProvince()
    {        
        $sql = "SELECT * FROM tbl_provinces";
        $query = $this->db->query($sql);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    public function updateProfile($data)
    {
        $arr = explode(" ",$data['txt_name']);
		$name = $arr[0];
		$lastname = $arr[1];
        $info = [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $data['txt_email'],
            'phone' => $data['txt_phone'],
            'maincate_id' => $data['hd_maincate'],
            'product_type' => $data['ddl_product_type'],
            'business_type' => $data['ddl_business_type'],
            'company' => $data['txt_company'],
            'province' => $data['ddl_province']
        ];
        $builder = $this->db->table('tbl_member');
        $builder->where('id', $data['hd_id']);
        $query = $builder->update($info);
        if($query){
            return true;
        }else{
            return false;
        }
    }
}