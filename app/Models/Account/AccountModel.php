<?php

namespace App\Models\Account;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class AccountModel extends Model
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

    public function register($data)
    {
		$arr = explode(" ",$data['txt_name']);
		$name = $arr[0];
		$lastname = $arr[1];
		$datetime = new Time('now');
		$str_rand = random_string('alnum', 11);
        $info=[
            'account' => $data['txt_username'],
			'code' => $str_rand,
            'name' => $name,
			'lastname' => $lastname,
            'email' => $data['txt_username'],
            'password' => password_hash($data['txt_password'], PASSWORD_DEFAULT),
			'type' => $data['rd_member'],
			'member_start' => $datetime,
			'last_login' => $datetime
        ];

		if($this->save($info)){
			return $this->getInsertID();
		}else{
			return false;
		}
    }

	public function socialSignin($data)
	{
		$arr = explode(" ",$data['name']);
		$name = $arr[0];
		$lastname = $arr[1];
		$datetime = new Time('now');
        $info=[
			'code' => $data['code'],
            'account' => $data['account'],
            'name' => $name,
			'lastname' => $lastname,
            'email' => $data['email'],
			'profile' => $data['profile_pic'],
			'type' => 'member',
            'social_type' => $data['type'],
			'social_id' => $data['account'],
			'last_login' => $datetime
        ];

		if($this->save($info)){
			return $this->getInsertID();
		}else{
			return false;
		}
	}
}
