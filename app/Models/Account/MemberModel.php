<?php

namespace App\Models\Account;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class MemberModel extends Model
{
    protected $db;
    protected $member_id;

    public function __construct() {
        $this->db = \Config\Database::connect();
        $sess = session()->get('userdata');
        if($sess){
            $this->udata = $sess;
            $this->member_id = $sess['id'];
        }
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

    public function getSubCategory()
    {        
        $sql = "SELECT * FROM tbl_productcategory WHERE maincate_id >= ? AND status = ? ORDER BY maincate_id ASC";
        $query = $this->db->query($sql, [1,'1']);
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

    public function getSubBusiness()
    {        
        $sql = "SELECT * FROM tbl_business WHERE main_type >= ? AND status = ? ORDER BY main_type ASC";
        $query = $this->db->query($sql, [1,'1']);
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

    public function getAmphure()
    {        
        $sql = "SELECT * FROM tbl_amphures";
        $query = $this->db->query($sql);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    public function getDistrict()
    {        
        $sql = "SELECT * FROM tbl_districts";
        $query = $this->db->query($sql);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    public function getAddress()
    {        
        $sql = "SELECT * FROM tbl_address WHERE member_id = ?";
        $query = $this->db->query($sql, [$this->member_id]);
        if($query){
            return $query->getRow();
        }else{
            return false;
        }
    }

    public function getSocial()
    {        
        $sql = "SELECT * FROM tbl_social WHERE member_id = ?";
        $query = $this->db->query($sql, [$this->member_id]);
        if($query){
            return $query->getRow();
        }else{
            return false;
        }
    }

    public function getMemberContact()
    {        
        $sql = "SELECT * FROM tbl_member_contact WHERE member_id = ?";
        $query = $this->db->query($sql, [$this->member_id]);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    public function updateProfile($data)
    {
        $arr = explode(" ",$data['txt_mainperson']);
		$name = $arr[0];
		$lastname = $arr[1];
        $ws = explode('//',$data['txt_website']);
        if(count($ws) > 1){
            $ws = $data['txt_website'];
        }else{
            $ws = 'http://'.$data['txt_website'];
        }
        $info = [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $data['txt_email'],
            'phone' => $data['txt_mainphone'],
            'company_phone' => $data['txt_companyphone'],
            'company' => $data['txt_company'],
            'about' => $data['txt_ac_about'],
            'website' => urlencode($ws)
        ];
        $builder = $this->db->table('tbl_member');
        $builder->where('id', $data['hd_id']);
        $query = $builder->update($info);
        if($query){
            $this->updateAddress($data);
        }else{
            return false;
        }
    }

    public function updateAddress($data)
    {
        $datetime = new Time('now');   
        $builder = $this->db->table('tbl_address');
        $builder->where('member_id', $data['hd_id']);
        $member = $builder->get()->getRow();
        
        if($member->member_id){
            $info = [
                'province_id' => $data['ddl_province'],
                'amphure_id' => $data['ddl_amphure'],
                'district_id' => $data['ddl_district'],
                'zipcode' => $data['txt_zipcode'],
                'address' => $data['txt_address'],
                'updated_at' => $datetime
            ];
            $query = $builder->update($info);
        }else{
            $info = [
                'member_id' => $data['hd_id'],
                'province_id' => $data['ddl_province'],
                'amphure_id' => $data['ddl_amphure'],
                'district_id' => $data['ddl_district'],
                'zipcode' => $data['txt_zipcode'],
                'address' => $data['txt_address'],
                'created_at' => $datetime,
                'updated_at' => $datetime
            ];
            $query = $builder->insert($info);
        }
        
        if($query){
            $this->updateSocial($data);
        }else{
            return false;
        }
    }

    public function updateSocial($data)
    {
        $builder = $this->db->table('tbl_social');
        $builder->where('member_id', $data['hd_id']);
        $member = $builder->get()->getRow();
        $datetime = new Time('now');
        
        if($member->member_id){
            $info = [
                'line' => $data['txt_line'],
                'facebook' => $data['txt_facebook'],
                'instagram' => $data['txt_instagram'],
                'updated_at' => $datetime
            ];
            $query = $builder->update($info);
        }else{
            $info = [
                'member_id' => $data['hd_id'],
                'line' => $data['txt_line'],
                'facebook' => $data['txt_facebook'],
                'instagram' => $data['txt_instagram'],
                'created_at' => $datetime,
                'updated_at' => $datetime
            ];
            $query = $builder->insert($info);
        }
        
        if($query){
            $this->updateContact($data);
        }else{
            return false;
        }
    }

    public function updateContact($data)
    {
        $builder = $this->db->table('tbl_member_contact');
        $datetime = new Time('now');

        $name = '';
        $lastname = '';
        $phone = '';
        foreach ($data['txt_person'] as $value) {
            $arr = explode(" ",$value);
            $name = $arr[0];
            $lastname = $arr[1];
        }
        foreach ($data['txt_personphone'] as $phone) {
            $phone = $phone;
        }
        
        for ($i=0; $i < count($data['txt_person']); $i++) {
            $arr = explode(" ",$data['txt_person'][$i]);
            $name = $arr[0];
            $lastname = $arr[1];
            $phone = $data['txt_personphone'][$i];
            $info = [
                'member_id' => $data['hd_id'],
                'name' => $name,
                'lastname' => $lastname,
                'phone' => $phone,
                'created_at' => $datetime,
                'updated_at' => $datetime
            ];
            $query = $builder->insert($info);
        }
        
        if($query){
            return true;
        }else{
            return false;
        }
    }
}