<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\CancelBookingModel;
use App\Models\CabangModel;
use App\Models\GuestModel;
use App\Models\RuanganModel;
use CodeIgniter\Config\Config;

class Booking extends BaseController
{

    public function __construct()
    {
        $this->guestModel = new GuestModel();
        $this->ruanganModel = new RuanganModel();
        $this->bookingModel = new BookingModel();
        $this->cabangModel = new CabangModel();
        $this->cancelBooking = new CancelBookingModel();

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        // get nums rows
        $pengguna = $this->guestModel->getNumRows();
        $ruangan = $this->ruanganModel->getNumRows();

        $data = [
            'tittle' => 'Booking',
            'pengguna' => $pengguna,
            'ruangan' => $ruangan
        ];
        return view('booking/index', $data);
    }

    public function list_booking($tanggal)
    {
        // enkripsi tanggal
        $tgl = base64_decode($tanggal);

        // ruangan 
        $ruangan = $this->ruanganModel->findAll();

        //get tanggal list booking
        $tanggal_form = $this->request->getVar('tanggal');
        // cek tanggal pencarian
        if ($tanggal_form) {
            $booking = $this->bookingModel->where('tanggal_meeting', $tanggal_form)->findAll();
        } else {
            $booking =  $this->bookingModel->where('tanggal_meeting', $tgl)->findAll();
        }


        $data = [
            'tittle' => 'List Booking',
            'booking' => $booking,
            'ruangan' => $ruangan,
            'tanggal_list' => $tanggal_form,
            'validation' => \Config\Services::validation()
        ];

        return view('booking/booking_list', $data);
    }


    public function booking_room($kode_room, $kode_booking)
    {
        //generet kode booking random 3 digit pertama
        $angka_kode1 = range(0, 9);
        shuffle($angka_kode1);
        $ambilKode1 = array_rand($angka_kode1, 3);
        $generetKode1 = implode('', $ambilKode1);
        // generate booking dept random 3 digit kedua
        $angka_kode2 = range(0, 9);
        shuffle($angka_kode2);
        $ambilKode2 = array_rand($angka_kode2, 3);
        $generetKode2 = implode('', $ambilKode2);
        // kode booking yang sudah di random
        $kodeBook = 'BO-' . $generetKode1 . $generetKode2;

        // deksripsi kode room
        $kodeRoom = base64_decode($kode_room);
        $kodeBooking = base64_decode($kode_booking);

        // get data ruangan by kode ruangan
        $data_ruangan = $this->ruanganModel->where('kode_room', $kodeRoom)->first();

        // get data booking
        $booking = $this->bookingModel->where('kode_booking', $kodeBooking)->first();

        // get tanggal dan jam ruangan yang sudah di booking sebelum nya
        // ini masih wacana
        $cek_booking = $this->bookingModel->where('kode_room', $kodeRoom)->findAll();

        $data = [
            'tittle' => 'Booking Room',
            'booking_ruangan' => $data_ruangan,
            'booking' => $booking,
            'kode_booking' => $kodeBook,
            'kode_booking_back' => $kodeBooking,
            'cek_booking' => $cek_booking,
            'validation' => \Config\Services::validation()
        ];

        return view('booking/booking_room', $data);
    }

    public function save_booking($kode_room, $kode_booking)
    {
        $kodeRoom = base64_decode($kode_room);
        // validasi form booking
        if (!$this->validate([
            'tanggal_booking' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Booking Tidak Boleh Kosong!'
                ]
            ],
            'jam_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Mulai Tidak Boleh Kosong!'
                ]
            ],
            'jam_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Selesai Tidak Boleh Kosong!'
                ]
            ],
            'topik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Topik Meeting Tidak Boleh Kosong!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/views/booking-room/' . $kode_room . '/' . $kode_booking))->withInput();
        } else {
            $kodeRoom = base64_decode($kode_room);
            // variable

            $jam_mulai = $this->request->getVar('jam_mulai');
            $jam_akhir = $this->request->getVar('jam_selesai');
            $tanggal_meeting = $this->request->getVar('tanggal_booking');
            // koneksi database manual
            $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
            // query manual
            $query = mysqli_query($conn, "SELECT * FROM booking WHERE kode_room = '$kodeRoom' AND tanggal_meeting = '$tanggal_meeting' AND jam_mulai = '$jam_mulai' AND jam_akhir = '$jam_akhir' AND status != 'Out' ");
            $data_booking = mysqli_fetch_assoc($query);

            if ($data_booking > 0) {

                session()->setFlashdata('pesan-gagal', 'Jam Booking Bentrok!');
                return redirect()->to(base_url('/views/booking-room/' . $kode_room . '/' . $kode_booking))->withInput();
            } else {
                // insert data booking kedalam table booking
                $this->bookingModel->save([
                    'kode_booking' => $this->request->getVar('kode_booking'),
                    'kode_cabang' => $this->request->getVar('cabang'),
                    'kode_room' => $this->request->getVar('kode_room'),
                    'topik' => $this->request->getVar('topik'),
                    'tanggal_meeting' => $tanggal_meeting,
                    'jam_mulai' => $jam_mulai,
                    'jam_akhir' => $jam_akhir,
                    'pemesan' => $this->request->getVar('nama_pemesan'),
                    'status' => 'Booking'
                ]);

                $tanggal = date('d-m-Y');
                $date_encode = base64_encode($tanggal);

                session()->setFlashdata('pesan', 'Data Booking Berhasil di Input!');
                return redirect()->to(base_url('/views/list-booking/' . $date_encode))->withInput();
            }
        }
    }

    public function bentrok($kode_room, $kode_booking)
    {
        session()->setFlashdata('pesan-gagal', 'Jam Booking Bentrok!');
        return redirect()->to(base_url('/views/booking-room/' . $kode_room . '/' . $kode_booking))->withInput();
    }


    public function resepsionis()
    {
        // get cabang
        $cabang = $this->cabangModel->findAll();

        // get kode cabang
        $kode_cabang = $this->request->getVar('cabang');

        $data = [
            'tittle' => 'Resepsionis',
            'cabang' => $cabang,
            'validation' => \Config\Services::validation()
        ];

        return view('booking/resepsionis', $data);
    }

    public function resepsionis_info()
    {
        // get kode cabang
        $kode_cabang = $this->request->getVar('cabang');
        // enkripsi kode cabang
        $kodeCabang = base64_encode($kode_cabang);
        // get tanggal hari ini
        $data_tanggal = date('d-m-Y');
        // enkripsi tanggal
        $tgl = base64_encode($data_tanggal);

        return redirect()->to(base_url('/admin/resepsionis-list/' . $kodeCabang . '/' . $tgl))->withInput();
    }

    public function resepsionis_list($kode_cabang, $tgl)
    {
        // dekripsi kode cabang
        $kodeCabang = base64_decode($kode_cabang);
        // dekripsi tanggal
        $tanggal_hari_ini = base64_decode($tgl);

        //get tanggal list booking
        $tanggal_form = $this->request->getVar('tanggal');

        // set tanggal
        $tanggal = $tanggal_hari_ini;
        // cek tanggal pencarian
        if ($tanggal_form) {
            $tanggal = $tanggal_form;
        }

        $data_booking = $this->bookingModel->getDataBooking($kodeCabang, $tanggal);

        $data = [
            'tittle' => 'Resepsionis',
            'kode_cabang' => $kode_cabang,
            'booking' => $data_booking,
            'tanggal_list' => $tanggal_form,
            'kode_cabang' => $kodeCabang
        ];

        return view('booking/resepsionis_list', $data);
    }


    public function booking_in($kode_cabang, $tgl, $kode_booking)
    {
        // dekripsi kode cabang
        $kodeCabang = base64_decode($kode_cabang);
        // dekripsi tanggal
        $tanggal_hari_ini = base64_decode($tgl);
        // deskripsi kode booking
        $kodeBooking = base64_decode($kode_booking);

        // get data booking
        $data_booking = $this->bookingModel->where('kode_booking', $kodeBooking)->first();
        // get id data booking
        $id = $data_booking['id'];

        // update status booking menjadi in
        $this->bookingModel->save([
            'id' => $id,
            'status' => 'In'
        ]);

        return redirect()->to(base_url('/admin/resepsionis-list/' . $kode_cabang . '/' . $tgl))->withInput();
    }

    public function booking_out($kode_cabang, $tgl, $kode_booking)
    {
        // dekripsi kode cabang
        $kodeCabang = base64_decode($kode_cabang);
        // dekripsi tanggal
        $tanggal_hari_ini = base64_decode($tgl);
        // deskripsi kode booking
        $kodeBooking = base64_decode($kode_booking);

        // get data booking
        $data_booking = $this->bookingModel->where('kode_booking', $kodeBooking)->first();
        // get id data booking
        $id = $data_booking['id'];

        // update status booking menjadi in
        $this->bookingModel->save([
            'id' => $id,
            'status' => 'Out'
        ]);

        return redirect()->to(base_url('/admin/resepsionis-list/' . $kode_cabang . '/' . $tgl))->withInput();
    }


    public function my_booking($kode_guest)
    {
        // deskripsi kode guest
        $kodeGuest = base64_decode($kode_guest);

        // dekripsi tanggal
        $tanggal_hari_ini = date('d-m-Y');

        //get tanggal list booking
        $tanggal_form = $this->request->getVar('tanggal');

        // set tanggal
        $tanggal = $tanggal_hari_ini;
        // cek tanggal pencarian
        if ($tanggal_form) {
            $tanggal = $tanggal_form;
        }

        // get data booking by kode guest
        $data_booking = $this->bookingModel->getDataMyBooking($kodeGuest, $tanggal);

        $data = [
            'tittle' => 'My Booking List',
            'booking' => $data_booking,
            'tanggal_list' => $tanggal_form,
            'validation' => \Config\Services::validation()
        ];

        return view('booking/my_booking', $data);
    }


    public function edit_booking($kode_booking)
    {
        // enkripsi kode booking
        $kodeBooking = base64_decode($kode_booking);
        // get data booking
        $data_booking = $this->bookingModel->where('kode_booking', $kodeBooking)->first();
        // get kode room
        $kode_room = $data_booking['kode_room'];
        // get nama ruangan
        $data_ruangan = $this->ruanganModel->where('kode_room', $kode_room)->first();


        $data = [
            'tittle' => 'Edit Booking',
            'booking' => $data_booking,
            'nama_ruangan' => $data_ruangan,
            'validation' => \Config\Services::validation()
        ];

        return view('booking/edit_booking', $data);
    }

    public function save_edit_booking($kode_booking)
    {
        // deskripsi kode booking
        $kodeBooking = base64_decode($kode_booking);

        // get data booking 
        $data_booking = $this->bookingModel->where('kode_booking', $kodeBooking)->first();
        // get kode_room
        $kode_room = $data_booking['kode_room'];

        // get pemesan
        $kode_guest = base64_encode($data_booking['pemesan']);
        // get id booking
        $id = $data_booking['id'];

        // validation 
        if (!$this->validate([
            'tanggal_booking' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Booking Tidak Boleh Kosong!'
                ]
            ],
            'jam_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Mulai Tidak Boleh Kosong!'
                ]
            ],
            'jam_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Selesai Tidak Boleh Kosong!'
                ]
            ],
            'topik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Topik Booking Tidak Boleh Kosong!'
                ]
            ],

        ])) {
            return redirect()->to(base_url('/views/edit-booking/' . $kode_booking))->withInput();
        } else {
            $kodeRoom = $kode_room;
            // variable
            $jam_mulai = $this->request->getVar('jam_mulai');
            $jam_akhir = $this->request->getVar('jam_selesai');
            $tanggal_meeting = $this->request->getVar('tanggal_booking');
            // koneksi database manual
            $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
            // query manual
            $query = mysqli_query($conn, "SELECT * FROM booking WHERE kode_room = '$kodeRoom' AND tanggal_meeting = '$tanggal_meeting' AND jam_mulai = '$jam_mulai' AND jam_akhir = '$jam_akhir' AND status != 'Out' ");
            $data_booking = mysqli_fetch_assoc($query);

            if ($data_booking > 0) {
                session()->setFlashdata('pesan-gagal', 'Jam Booking Bentrok!');
                return redirect()->to(base_url('/views/edit-booking/' . $kode_booking))->withInput();
            } else {
                // save edit booking
                $this->bookingModel->save([
                    'id' => $id,
                    'tanggal_meeting' => $this->request->getVar('tanggal_booking'),
                    'jam_mulai' => $this->request->getVar('jam_mulai'),
                    'jam_akhir' => $this->request->getVar('jam_selesai'),
                    'topik' => $this->request->getVar('topik')
                ]);

                session()->setFlashdata('pesan', 'Data Booking Berhasil di Edit!');
                return redirect()->to(base_url('/views/my-booking/' . $kode_guest))->withInput();
            }
        }
    }


    public function cancel_booking($kode_booking)
    {
        // deskripsi kode booking
        $kodeBooking = base64_decode($kode_booking);
        // get data booking 
        $data_booking = $this->bookingModel->where('kode_booking', $kodeBooking)->first();
        // get kode room
        $kode_room = $data_booking['kode_room'];
        // get nama ruangan
        $data_ruangan = $this->ruanganModel->where('kode_room', $kode_room)->first();

        $data = [
            'tittle' => 'Cancel Booking',
            'booking' => $data_booking,
            'nama_ruangan' => $data_ruangan,
            'validation' => \Config\Services::validation()
        ];

        return view('booking/cancel_booking', $data);
    }


    public function save_cancel_booking($kode_booking)
    {
        // enkripsi kode booking
        $kodeBooking = base64_decode($kode_booking);
        // get data booking by kode booking
        $data_booking = $this->bookingModel->where('kode_booking', $kodeBooking)->first();
        // get kode guest
        $pemesan = base64_encode($data_booking['pemesan']);

        // validasi form cancel booking
        if (!$this->validate([
            'alasan_cancel' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon di lengkapi alasan cancel booking!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/views/cancel-booking/' . $kode_booking))->withInput();
        } else {
            // insert data kedalam tabel cancel booking
            $this->cancelBooking->save([
                'kode_booking' => $data_booking['kode_booking'],
                'kode_cabang' => $data_booking['kode_cabang'],
                'kode_room' => $data_booking['kode_room'],
                'topik' => $data_booking['topik'],
                'tanggal_meeting' => $data_booking['tanggal_meeting'],
                'jam_mulai' => $data_booking['jam_mulai'],
                'jam_akhir' => $data_booking['jam_akhir'],
                'pemesan' => $data_booking['pemesan'],
                'status' => 'Booking Cancel',
                'alasan' => $this->request->getVar('alasan_cancel')
            ]);

            // setelah insert data booking kedalam tabel cancel booking hapus data booking dalam table booking
            // get id data booking
            $id = $data_booking['id'];
            $this->bookingModel->delete($id);

            session()->setFlashdata('pesan', 'Booking Room Cancel!');
            return redirect()->to(base_url('/views/my-booking/' . $pemesan))->withInput();
        }
    }


    public function list_cancel_booking($tanggal)
    {
        // deskripsi kode guest
        $tgl = base64_decode($tanggal);

        //get tanggal list booking
        $tanggal_form = $this->request->getVar('tanggal');

        // set tanggal
        $tanggal = $tgl;
        // cek tanggal pencarian
        if ($tanggal_form) {
            $tanggal = $tanggal_form;
        }

        // get data booking by kode guest
        $data_booking = $this->cancelBooking->where('tanggal_meeting', $tanggal)->findAll();


        $data = [
            'tittle' => 'Cancel Booking List',
            'booking' => $data_booking,
            'tanggal_list' => $tanggal_form,
            'validation' => \Config\Services::validation()
        ];

        return view('booking/list_cancel', $data);
    }
}
