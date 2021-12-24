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

    public function getProvinceById($id)
    {        
        $sql = "SELECT * FROM tbl_provinces  WHERE id >= ?";
        $query = $this->db->query($sql,[$id]);
        if($query){
            return $query->getRow();
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

    public function getAmphureById($id)
    {        
        $sql = "SELECT * FROM tbl_amphures  WHERE id >= ?";
        $query = $this->db->query($sql,[$id]);
        if($query){
            return $query->getRow();
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

    public function getDistrictById($id)
    {        
        $sql = "SELECT * FROM tbl_districts  WHERE id >= ?";
        $query = $this->db->query($sql,[$id]);
        if($query){
            return $query->getRow();
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

    public function getAddressById($id)
    {        
        $sql = "SELECT * FROM tbl_address WHERE member_id = ?";
        $query = $this->db->query($sql, [$id]);
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

    public function getSocialById($id)
    {        
        $sql = "SELECT * FROM tbl_social WHERE member_id = ?";
        $query = $this->db->query($sql, [$id]);
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

    public function getMemberContactById($id)
    {        
        $sql = "SELECT * FROM tbl_member_contact WHERE member_id = ?";
        $query = $this->db->query($sql, [$id]);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    public function getMemberBusiness()
    {        
        $sql = "SELECT * FROM tbl_member_business WHERE member_id = ?";
        $query = $this->db->query($sql, [$this->member_id]);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    public function getMemberBusinessById($id)
    {        
        $sql = "SELECT * FROM tbl_member_business WHERE member_id = ?";
        $query = $this->db->query($sql, [$id]);
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
        echo count($ws);
        if(count($ws) > 1){
            $ws = $data['txt_website'];
        }else{
            $ws = 'http://'.$data['txt_website'];
        }
        //echo $ws;
        
        $info = [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $data['txt_email'],
            'phone' => $data['txt_mainphone'],
            'company_phone' => $data['txt_companyphone'],
            'company' => $data['txt_company'],
            'about' => $data['txt_ac_about'],
            'website' => urlencode($ws),
            'map' => $data['txt_map'],
            'employee' => $data['ddl_employee']
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
            $builder->where('member_id', $data['hd_id']);
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
            $this->updateBusiness($data);
        }else{
            return false;
        }
    }

    public function updateBusiness($data)
    {
        $datetime = new Time('now');
        $builder = $this->db->table('tbl_member_business');
        $builder->where('member_id', $data['hd_id']);
        $member = $builder->get()->getRow();        
        
        if(isset($data['ddl_productcate'])){
            $product = count($data['ddl_productcate']);
            $pdata = '';
            for ($i=0; $i < $product; $i++) {
                $sb = '';
                if($i>0){
                    $sb = ', ';
                }
                $pdata .= $sb.$data['ddl_productcate'][$i];
            }
            //echo $pdata;
            if($member->member_id){
                $info = [
                    'product' => $pdata,
                    'updated_at' => $datetime
                ];
                $builder->where('member_id', $data['hd_id']);
                $builder->update($info);
            }else{
                $info = [
                    'member_id' => $data['hd_id'],
                    'product' => $pdata,
                    'created_at' => $datetime,
                    'updated_at' => $datetime
                ];
                $builder->insert($info);
            }
        }

        if(isset($data['ddl_business'])){
            $business = count($data['ddl_business']);
            $bdata = '';
            for ($i=0; $i < $business; $i++) {
                $sb = '';
                if($i>0){
                    $sb = ', ';
                }
                $bdata .= $sb.$data['ddl_business'][$i];
            }

            if($member->member_id){
                $info = [
                    'business' => $bdata,
                    'updated_at' => $datetime
                ];
                $builder->where('member_id', $data['hd_id']);
                $builder->update($info);
            }else{
                $info = [
                    'member_id' => $data['hd_id'],
                    'business' => $bdata,
                    'created_at' => $datetime,
                    'updated_at' => $datetime
                ];
                $builder->insert($info);
            }
        }

        $this->updateSocial($data);
    }

    public function updateSocial($data)
    {
        $builder = $this->db->table('tbl_social');
        $builder->where('member_id', $data['hd_id']);
        $member = $builder->get()->getRow();
        $datetime = new Time('now');
        
        $facebook = explode('//',$data['txt_facebook']);
        if(count($facebook) > 1){
            $facebook = $data['txt_facebook'];
        }else{
            $facebook = 'https://www.facebook.com/'.$data['txt_facebook'];
        }

        $instagram = explode('//',$data['txt_instagram']);
        if(count($instagram) > 1){
            $instagram = $data['txt_instagram'];
        }else{
            $instagram = 'https://www.instagram.com/'.$data['txt_instagram'];
        }

        $linkedin = explode('//',$data['txt_linkein']);
        if(count($linkedin) > 1){
            $linkedin = $data['txt_linkein'];
        }else{
            $linkedin = 'https://www.linkedin.com/in/'.$data['txt_linkein'];
        }

        $linkedin = explode('//',$data['txt_youtube']);
        if(count($linkedin) > 1){
            $linkedin = $data['txt_youtube'];
        }else{
            $linkedin = 'https://www.youtube.com/'.$data['txt_youtube'];
        }

        if($member->member_id){
            $info = [
                'line' => $data['txt_line'],
                'facebook' => $data['txt_facebook'],
                'instagram' => $data['txt_instagram'],
                'linkein' => $data['txt_linkein'],
                'youtube' => $data['txt_youtube'],
                'updated_at' => $datetime
            ];
            $builder->where('member_id', $data['hd_id']);
            $query = $builder->update($info);
        }else{
            $info = [
                'member_id' => $data['hd_id'],
                'line' => $data['txt_line'],
                'facebook' => $data['txt_facebook'],
                'instagram' => $data['txt_instagram'],
                'linkein' => $data['txt_linkein'],
                'youtube' => $data['txt_youtube'],
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
        
        if(isset($data['txt_person'])){
            $count = count($data['txt_person']);
            for ($i=0; $i < $count; $i++) {
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
                $builder->insert($info);
            }
        }
        return true;
    }

    public function notiDealer($data)
    {
        $builder = $this->db->table('tbl_notification');
        $date = date('Y-m-d H:i:s');
        $data_arr = [
            'member_id' => $data['id'],
            'type' => 'register',
            'title_th' => 'ฟอร์มสมาชิกร้านค้า',
            'desc_th' => 'กรุณาดาวน์โหลดฟอร์มสมาชิกร้านค้า ที่เมนูดาวน์โหลด และอัพโหลดไฟล์กลับมาเมื่อกรอกข้อมูลเรียบร้อย',
            'title_en' => 'Store membership form',
            'desc_en' => 'Please download the store membership form. at the download menu and upload the file back once the information is complete',
            'created_at' => $date,
            'updated_at' => $date
        ];
        $builder->insert($data_arr);
    }

    public function notification($data)
    {
        $builder = $this->db->table('tbl_notification');
        $date = date('Y-m-d H:i:s');
        $data_arr = [
            'member_id' => $data['member_id'],
            'type' => $data['type'],
            'title_th' => $data['title_th'],
            'desc_th' => $data['desc_th'],
            'title_en' => $data['title_en'],
            'desc_en' => $data['desc_en'],
            'created_at' => $date,
            'updated_at' => $date
        ];
        $builder->insert($data_arr);
    }

    public function updateNoti($id)
    {
        $builder = $this->db->table('tbl_notification');
        $date = date('Y-m-d H:i:s');
        $data_arr = [
            'status' => '1',
            'updated_at' => $date
        ];
        $builder->where('member_id',$id);
        $builder->update($data_arr);
    }
}