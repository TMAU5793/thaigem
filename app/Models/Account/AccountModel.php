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
	protected $allowedFields        = ["account","password","name","email","phone"];

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
        $info=[
            'account' => $data['txt_username'],
            'name' => $data['txt_name'],
            'email' => $data['txt_username'],
            'password' => $data['txt_password']

        ];

		if($this->save($info)){
			return true;
		}else{
			return false;
		}
    }
}
