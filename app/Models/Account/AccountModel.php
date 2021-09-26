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
	protected $protectFields        = true;
	protected $allowedFields        = ["account","password","name","lastname","email","phone","social_type","social_id","last_login"];

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

        $info=[
            'account' => $data['txt_username'],
            'name' => $name,
			'lastname' => $lastname,
            'email' => $data['txt_username'],
            'password' => password_hash($data['txt_password'], PASSWORD_DEFAULT),
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
            'account' => $data['id'],
            'name' => $name,
			'lastname' => $lastname,
            'email' => $data['email'],
            'social_type' => $data['type'],
			'social_id' => $data['id'],
			'last_login' => $datetime
        ];

		if($this->save($info)){
			return true;
		}else{
			return false;
		}
	}
}
