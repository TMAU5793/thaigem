<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class ProductCategoryModel extends Model
{
    protected $DBGroup              = 'default';
	protected $table                = 'tbl_productcategory';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = false;
	protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

    public function productCategory($data)
    {
        $info=[
            'maincate_id' => $data['ddl_cate'],
            'name_th' => $data['txt_name'],
            'name_en' => $data['txt_name_en'],
			'sortby' => $data['sortby'],
            'status' => $data['ddl_status']
        ];
        if($data['hd_id']==""){
            $result = $this->insert($info);
            $return = $this->getInsertID();
        }else{
            $result = $this->update($data['hd_id'],$info);
            $return = $data['hd_id'];
        }
        if($result){
            return $return;
        }else{
            return false;
        }
    }
}