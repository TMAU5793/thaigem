<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\API\ResponseTrait;

class LocationApi extends ResourcePresenter
{
    use ResponseTrait;

    public function getAmphure()
    {
        $request = service('request');
		$db = \Config\Database::connect();

        $id = $request->getPost('id');        
		$query   = $db->query('SELECT * FROM tbl_amphures WHERE province_id="'.$id.'"');
		$results = $query->getResultArray();
        return $this->respond($results);
    }

    public function getDistrict()
    {
        $request = service('request');
		$db = \Config\Database::connect();

        $amphure_id = $request->getPost('id');
		$query   = $db->query('SELECT * FROM tbl_districts WHERE amphure_id="'.$amphure_id.'"');
		$results = $query->getResultArray();
        return $this->respond($results);
    }

    // ...
}