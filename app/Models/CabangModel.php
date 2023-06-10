<?php

namespace App\Models;

use CodeIgniter\Model;

class CabangModel extends Model
{
    protected $table = 'cabang';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_cabang', 'nama_cabang', 'kota_cabang', 'alamat_cabang', 'telpon_cabang', 'created_at', 'updated_at'];
}
