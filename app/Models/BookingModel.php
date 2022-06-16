<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_booking';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = false;

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public function getBooking($status=null,$file=null,$pay=null,$keyword=null,$perPage=null,$offset=null)
	{
		$db      = db_connect();
        $builder = $db->table('tbl_booking AS a');
        $builder->select('*,a.id as b_id, a.status AS bstatus');
        $builder->join('tbl_member AS b','b.id=a.member_id');
        if($status!=''){
            $builder->where('a.status',$status);
        }
        if($file!=''){
            $builder->where('a.file_status',$file);
        }
        if($pay!=''){
            $builder->where('a.payment',$pay);
        }
        if($keyword!=''){
            $builder->like('b.company',$keyword);
            $builder->orLike('a.booking_no',$keyword);
        }
		if($perPage!=null){
			$builder->limit($perPage, $offset);
		}
        $builder->orderBy('a.status DESC');
        return $builder->get()->getResultArray();
	}
}
