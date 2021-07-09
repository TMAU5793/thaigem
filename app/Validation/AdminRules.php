<?php

namespace App\Validation;
use App\Models\UserModel;

class AdminRules
{
	// public function custom_rule(): bool
	// {
	// 	return true;
	// }

	public function validateAdmin(string $str, string $fields, array $data){
		$model = new UserModel();
		$admin = $model->where('account', $data['adminEmail'])->first();
	
		if(!$admin)
		  return false;
	
		return password_verify($data['adminPassword'], $admin['password']);
	  }
}
