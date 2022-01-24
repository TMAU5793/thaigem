<?php

namespace App\Models;

use CodeIgniter\Model;

class FunctionModel extends Model
{
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

    public function getProvinceAll()
    {
        $sql = "SELECT * FROM tbl_provinces ORDER BY sortby ASC, name_th ASC";
        $query = $this->db->query($sql);
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }

    
}