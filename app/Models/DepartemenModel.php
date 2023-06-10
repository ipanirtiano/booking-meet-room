<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartemenModel extends Model
{
    protected $table = 'departemen';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_dept', 'nama_departemen', 'created_at', 'updated_at'];
}
