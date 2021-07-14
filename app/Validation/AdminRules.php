<?php

namespace App\Validation;
use App\Models\UserModel;

class AdminRules
{
	// public function custom_rule(): bool
	// {
	// 	return true;
	// }

	public function checkedPassword(string $str, string $fields, array $data){
		$model = new UserModel();
		$password = $model->where('account', $data['adminEmail'])->first();
	
		if(!$password){
		  	return false;
		}else{
			return password_verify($data['adminPassword'], $password['password']);
		}
	}

	public function checkedEmail(string $str, string $fields, array $data){
		$model = new UserModel();
		$email = $model->where('account', $data['adminEmail'])->first();
	
		if(!$email){
		  	return false;
		}else{
			return true;
		}		
	}

	public function checkedStatus(string $str, string $fields, array $data){
		$model = new UserModel();
		$status = $model->where(['account'=>$data['adminEmail'],'status'=>'1'])->first();
	
		if(!$status){
		  	return false;
		}else{
			return true;
		}		
	}
}
