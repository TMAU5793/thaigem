<?php

namespace App\Validation;
use App\Models\Account\AccountModel;

class CustomRules
{
	// public function custom_rule(): bool
	// {
	// 	return true;
	// }

	public function memberPassword(string $str, string $fields, array $data){
		$model = new AccountModel();
		$password = $model->where('account', $data['txt_username'])->first();
	
		if(!$password){
		  	return false;
		}else{
			return password_verify($data['txt_password'], $password['password']);
		}
	}

	public function memberAccount(string $str, string $fields, array $data){
		$model = new AccountModel();
		$email = $model->where('account', $data['txt_username'])->first();
	
		if(!$email){
		  	return false;
		}else{
			return true;
		}		
	}

	public function memberStatus(string $str, string $fields, array $data){
		$model = new AccountModel();
		$status = $model->where(['account'=>$data['txt_username'],'status >'=>'0'])->first();
	
		if(!$status){
		  	return false;
		}else{
			return true;
		}		
	}
}
