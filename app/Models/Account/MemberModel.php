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
        $sql = "SELECT * FROM tbl_provinces ORDER BY sortby ASC, name_th ASC";
        $query = $this->db->query($sql);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    public function getProvinceById($id)
    {        
        $sql = "SELECT * FROM tbl_provinces  WHERE id = ?";
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
    public function getContactByDealercode($code)
    {
        $sql = "SELECT * FROM tbl_member_contact WHERE dealer_code = ?";
        $query = $this->db->query($sql, $code);
        if($query){
            return $query->getResult();
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
        
        if($data['txt_map']!=''){
            $info = [
                'name' => $data['txt_mainperson'],
                'lastname' => $lastname,
                'email' => $data['txt_email'],
                'phone' => $data['txt_mainphone'],
                'company_phone' => $data['txt_companyphone'],
                'company' => $data['txt_company'],
                'about' => strip_tags($data['txt_ac_about']),
                'website' => urlencode($data['txt_website']),
                'map' => $data['txt_map'],
                'employee' => $data['ddl_employee']
            ];
        }else{
            
            $info = [
                'name' => $data['txt_mainperson'],
                'lastname' => $lastname,
                'email' => $data['txt_email'],
                'phone' => $data['txt_mainphone'],
                'company_phone' => $data['txt_companyphone'],
                'company' => $data['txt_company'],
                'about' => strip_tags($data['txt_ac_about']),
                'website' => urlencode($data['txt_website']),
                'employee' => $data['ddl_employee']
            ];
        }
        $builder = $this->db->table('tbl_member');
        $builder->where('id', $data['hd_id']);
        $builder->update($info);
        
        $this->updateAddress($data);
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
                'address' => strip_tags($data['txt_address']),
                'updated_at' => $datetime
            ];
            $builder->where('member_id', $data['hd_id']);
            $builder->update($info);
        }else{
            $info = [
                'member_id' => $data['hd_id'],
                'province_id' => $data['ddl_province'],
                'amphure_id' => $data['ddl_amphure'],
                'district_id' => $data['ddl_district'],
                'zipcode' => $data['txt_zipcode'],
                'address' => strip_tags($data['txt_address']),
                'created_at' => $datetime,
                'updated_at' => $datetime
            ];
            $builder->insert($info);
        }

        $this->updateBusiness($data);
    }

    public function updateBusiness($data)
    {
        $datetime = new Time('now');
        $builder = $this->db->table('tbl_member_business');
        $builder->where('member_id', $data['hd_id']);        
        $info = $builder->get()->getRowArray();
        
        if($data['ddl_productcate']){            
            $pdata = '';
            $arr = explode(',',$info['product']);
            foreach ($arr as $item){
                if($item){
                    $pdata .= $item.',';
                }
            }
            $pdata = substr($pdata,0,-1);
            $product = count($data['ddl_productcate']);
            echo $pdata.'<br>';
            for ($i=0; $i < $product; $i++) {
                $sb = ',';
                if($pdata){
                    $pdata .= $sb.$data['ddl_productcate'][$i];
                }else{
                    $pdata .= $data['ddl_productcate'][$i];
                }
            }
            if($info){
                $update_data = [
                    'product' => $pdata,
                    'updated_at' => $datetime
                ];
                $builder->where('member_id', $data['hd_id']);
                $builder->update($update_data);
            }else{
                $update_data = [
                    'member_id' => $data['hd_id'],
                    'product' => $pdata,
                    'created_at' => $datetime,
                    'updated_at' => $datetime
                ];
                $builder->insert($update_data);
            }
        }        

        $this->updateBusinessType($data);
    }

    public function updateBusinessType($data)
    {
        $datetime = new Time('now');
        $builder = $this->db->table('tbl_member_business');
        $builder->where('member_id', $data['hd_id']);        
        $info = $builder->get()->getRowArray();                

        if($data['ddl_business']){
            $bdata = '';
            $arr = explode(',',$info['business']);
            foreach ($arr as $item){
                if($item){
                    $bdata .= $item.',';
                }
            }
            $bdata = substr($bdata,0,-1);
            $business = count($data['ddl_business']);
            echo $bdata.'1<br>';
            for ($i=0; $i < $business; $i++) {
                $sb = ',';
                if($bdata){
                    $bdata .= $sb.$data['ddl_business'][$i];
                }else{
                    $bdata .= $data['ddl_business'][$i];
                }
            }

            if($info){
                $update_data = [
                    'business' => $bdata,
                    'updated_at' => $datetime
                ];
                $builder->where('member_id', $data['hd_id']);
                $builder->update($update_data);
            }else{            
                $update_data = [
                    'member_id' => $data['hd_id'],
                    'business' => $bdata,
                    'created_at' => $datetime,
                    'updated_at' => $datetime
                ];
                $builder->insert($update_data);
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
        
        if($member->member_id){
            $info = [
                'line' => $data['txt_line'],
                'facebook' => $data['txt_facebook'],
                'instagram' => $data['txt_instagram'],
                'linkein' => $data['txt_linkein'],
                'youtube' => $data['txt_youtube'],
                //'wechat' => $data['txt_wechat'],
                'whatsapp' => $data['txt_whatsapp'],
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
                //'wechat' => $data['txt_wechat'],
                'whatsapp' => $data['txt_whatsapp'],
                'created_at' => $datetime,
                'updated_at' => $datetime
            ];
            $query = $builder->insert($info);
        }
        
        // if($query){
        //     $this->updateContact($data);
        // }else{
        //     return false;
        // }

        $this->updateContact($data);
    }

    public function updateContact($data)
    {
        $builder = $this->db->table('tbl_member_contact');
        $datetime = new Time('now');

        $name = '';
        $lastname = '';
        $phone = '';
        
        if($data['txt_person']){
            $count = count($data['txt_person']);
            for ($i=0; $i < $count; $i++) {
                $phone = $data['txt_personphone'][$i];
                $info = [
                    'member_id' => $data['hd_id'],
                    'name' => $data['txt_person'][$i],
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