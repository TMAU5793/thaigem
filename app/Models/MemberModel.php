<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_member';
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

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public function getDealer($status=null,$keyword=null,$perPage=null,$offset=null)
	{
		$db      = db_connect();
        $builder = $db->table('tbl_member AS a');
        $builder->select('*,a.status as approve');
        $builder->join('tbl_address AS b','b.member_id=a.id');
		$builder->where('a.type','dealer');
        if($status!=''){
            $builder->where('a.status',$status);
        }
        if($keyword!=''){
            $builder->like('a.company',$keyword);
        }
		if($perPage!=null){
			$builder->limit($perPage, $offset);
		}
        $builder->orderBy('a.status DESC');
        return $builder->get()->getResultArray();
	}

	public function getMember($status=null,$keyword=null,$perPage=null,$offset=null)
	{
		$db      = db_connect();
        $builder = $db->table('tbl_member AS a');
        $builder->select('*,a.status as approve');
        $builder->join('tbl_address AS b','b.member_id=a.id');
		$builder->where('a.type','member');
        if($status!=''){
            $builder->where('a.status',$status);
        }
        if($keyword!=''){
            $builder->like('a.company',$keyword);
        }
		if($perPage!=null){
			$builder->limit($perPage, $offset);
		}
        $builder->orderBy('a.status DESC');
        return $builder->get()->getResultArray();
	}
}
