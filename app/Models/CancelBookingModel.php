<?php

namespace App\Models;

use CodeIgniter\Model;

class CancelBookingModel extends Model
{
    protected $table = 'cancel_booking';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_booking', 'kode_cabang', 'kode_room', 'topik', 'tanggal_meeting', 'jam_mulai', 'jam_akhir', 'pemesan', 'status', 'alasan', 'created_at', 'updated_at'];

    public function getNumRows_today($tgl)
    {
        // $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
        // $query = mysqli_query($conn, "SELECT * FROM booking ");
        // $count = mysqli_num_rows($query);

        // return $count;

        $data_booking = $this->db->table('cancel_booking')
            ->where('tanggal_meeting', $tgl)
            ->get()->getResultArray();
        return $data_booking;
    }
}
