<?php

namespace App\Models;

use CodeIgniter\Model;

class GuestModel extends Model
{
    protected $table = 'guest';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_guest', 'nama_lengkap', 'email', 'phone', 'departemen', 'created_at', 'updated_at'];

    public function getNumRows()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
        $query = mysqli_query($conn, "SELECT * FROM guest");
        $count = mysqli_num_rows($query);

        return $count;
    }
}
