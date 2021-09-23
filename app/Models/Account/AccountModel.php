<?php

namespace App\Models\Account;

use CodeIgniter\Model;

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
	protected $allowedFields        = ["account","password","name","lastname","email","phone"];

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
		print_r($arr);
		echo $lastname;
        $info=[
            'account' => $data['txt_username'],
            'name' => $name,
			'lastname' => $lastname,
            'email' => $data['txt_username'],
            'password' => password_hash($data['txt_password'], PASSWORD_DEFAULT)
        ];

		if($this->save($info)){
			return $this->getInsertID();
		}else{
			return false;
		}
    }
}
