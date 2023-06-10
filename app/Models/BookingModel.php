<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'booking';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_booking', 'kode_cabang', 'kode_room', 'topik', 'tanggal_meeting', 'jam_mulai', 'jam_akhir', 'pemesan', 'status', 'created_at', 'updated_at'];

    public function findByfindByTanggal($tanggal)
    {
        return $this->table('booking')->like('tanggal_meeting', $tanggal);
    }

    // public function joinTableWithRuangan($tgl)
    // {
    //     $data_booking = $this->db->table('jadwal')
    //         ->join('guru', 'guru.kode_guru = jadwal.guru_pengajar')
    //         ->where('kode_kelas', $kode_kelas)
    //         ->get()->getResultArray();
    //     return $data_jadwal;
    // }

    public function getNumRows_today($tgl)
    {
        // $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
        // $query = mysqli_query($conn, "SELECT * FROM booking ");
        // $count = mysqli_num_rows($query);

        // return $count;

        $data_booking = $this->db->table('booking')
            ->where('tanggal_meeting', $tgl)
            ->get()->getResultArray();
        return $data_booking;
    }

    public function getDataBooking($kode_cabang, $tgl)
    {
        $data_booking = $this->table('booking')
            ->where('kode_cabang', $kode_cabang)
            ->where('tanggal_meeting', $tgl)->get()->getResultArray();
        return $data_booking;
    }

    public function getDataBookingPrint($tanggal_mulai = 'Null', $tanggal_selesai = 'Null')
    {
        $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
        $query = mysqli_query($conn, "SELECT * FROM booking WHERE tanggal_booking = '$tanggal_mulai' ");
        $data = mysqli_fetch_assoc($query);
        return $data;
    }

    public function getDataMyBooking($kode_guest, $tgl)
    {
        $data_booking = $this->table('booking')
            ->where('pemesan', $kode_guest)
            ->where('tanggal_meeting', $tgl)->get()->getResultArray();
        return $data_booking;
    }
}
