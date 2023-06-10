<?php

namespace App\Models;

use CodeIgniter\Model;

class RuanganModel extends Model
{
    protected $table = 'ruangan';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_room', 'nama_ruangan', 'cabang', 'kapasitas', 'fasilitas', 'created_at', 'updated_at'];

    public function getNumRows()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
        $query = mysqli_query($conn, "SELECT * FROM ruangan");
        $count = mysqli_num_rows($query);

        return $count;
    }

    public function joinTableWithRuangan()
    {
        $data_booking = $this->db->table('ruangan')
            ->join('booking', 'booking.kode_room = ruangan.kode_room')
            ->get()->getResultArray();
        return $data_booking;
    }
}
