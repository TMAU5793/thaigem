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
        $builder->select('*,a.id as m_id,a.status as approve');
        $builder->join('tbl_address AS b','b.member_id=a.id');
		$builder->where('a.type','dealer');
        if($status!=null){
            $builder->where('a.status',$status);
        }
        if($keyword!=''){
            $builder->like('a.company',$keyword);
        }
		if($perPage!=null){
			$builder->limit($perPage, $offset);
		}
        $builder->orderBy('a.status DESC');
		$result = $builder->get()->getResultArray();
		
		if(!$result){
			$builder->select('*,a.id as m_id,a.status as approve');
			$builder->where('a.type','dealer');
			if($status!=null){
				$builder->where('a.status',$status);
			}
			if($keyword!=''){
				$builder->like('a.company',$keyword);
			}
			if($perPage!=null){
				$builder->limit($perPage, $offset);
			}
			$builder->orderBy('a.status DESC');
			$result = $builder->get()->getResultArray();
		}
        return $result;
	}

	public function getMember($keyword=null,$perPage=null,$offset=null)
	{
		$db      = db_connect();
        $builder = $db->table('tbl_member');
		$builder->where('type','member');
        if($keyword!=''){
            $builder->like('name',$keyword);
			$builder->orLike('lastname',$keyword);
        }
		if($perPage!=null){
			$builder->limit($perPage, $offset);
		}
        $builder->orderBy('status DESC');
        return $builder->get()->getResultArray();
	}

	public function searchMember($data,$perPage=null,$offset=null)
	{
		$db      = db_connect();
        $builder = $db->table('tbl_member AS a');
        $builder->select('*,a.id as m_id,a.status as approve');
        $builder->join('tbl_address AS b','b.member_id=a.id');
		$builder->join('tbl_member_business AS c','c.member_id=a.id');
		$builder->where(['a.type'=>'dealer','a.status'=>'2']);
		
		if($data['province']!=''){
            $builder->where('b.province_id',$data['province']);
        }
		if($data['duration']!=''){
			if($data['duration']!='10up'){
				$duration = explode('-',$data['duration']);
				$start = $duration['0'];
				$end = $duration['1'];
				if($start=='1'){
					$start = '0';
				}
				
				$builder->where('member_start >= DATE_SUB(NOW(),INTERVAL '.$end.' YEAR)');
				$builder->where('member_start < DATE_SUB(NOW(),INTERVAL '.$start.' YEAR)');
			}else{
				$builder->where('member_start < DATE_SUB(NOW(),INTERVAL 10 YEAR)');
			}
        }
		if($data['employee']!=''){
            $builder->where('a.employee',$data['employee']);
        }
        if($data['keyword']!=''){
            $builder->like('a.company',$data['keyword']);
        }
        if($data['product']!=''){
            $builder->like('c.product',$data['product']);
        }
		if($data['business']!=''){
            $builder->like('c.business',$data['business']);
        }		
		if($perPage!=null){
			$builder->limit($perPage, $offset);
		}
        $builder->orderBy('a.updated_at DESC');

		$result = $builder->get()->getResultArray();
		if(!$result){
			$builder2 = $db->table('tbl_member AS a');
			$builder2->select('*,a.id as m_id,a.status as approve');
			$builder2->where(['a.type'=>'dealer','a.status'=>'2']);
			if($data['duration']!=''){
				if($data['duration']!='10up'){
					$duration = explode('-',$data['duration']);
					$start = $duration['0'];
					$end = $duration['1'];
					if($start=='1'){
						$start = '0';
					}
					
					$builder2->where('a.member_start >= DATE_SUB(NOW(),INTERVAL '.$end.' YEAR)');
					$builder2->where('a.member_start < DATE_SUB(NOW(),INTERVAL '.$start.' YEAR)');
				}else{
					$builder2->where('a.member_start < DATE_SUB(NOW(),INTERVAL 10 YEAR)');
				}
			}
			if($data['employee']!=''){
				$builder2->where('a.employee',$data['employee']);
			}
			if($data['keyword']!=''){
				$builder2->like('a.company',$data['keyword']);
			}
					
			if($perPage!=null){
				$builder2->limit($perPage, $offset);
			}
			$builder2->orderBy('a.updated_at DESC');
			$result = $builder2->get()->getResultArray();
		}
        return $result;
		//return $builder->where('DATEDIFF(member_start,"'.$now.'")');		
	}

	public function filterMember($id,$perPage=null,$offset=null)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tbl_member AS a');
		$builder2 = $db->table('tbl_productcategory');

		$cate = $builder2->select('name_th')->where('maincate_id',$id)->get()->getResultArray();
		$query = [];
		$id_arr = [];
		foreach($cate as $row){
			$builder->join('tbl_member_business as b', 'a.id = b.member_id')
						->where(['a.type'=>'dealer','a.status'=>'2'])
						->like('b.product',$row['name_th']);
			if($perPage!=null){
				$builder->limit($perPage, $offset);
			}
			$arr = $builder->get()->getResultArray();
			foreach ($arr as $item){
				if(!in_array($item['id'], $id_arr)){
					$id_arr[] = $item['id'];
					$query[] = $item;
				}
			}
		}

        return $query;
	}
}
