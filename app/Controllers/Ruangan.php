<?php

namespace App\Controllers;

use App\Models\CabangModel;
use App\Models\DepartemenModel;
use App\Models\RuanganModel;

class Ruangan extends BaseController
{

    public function __construct()
    {
        $this->ruanganModel = new RuanganModel();
        $this->cabangModel = new CabangModel();
    }

    public function index()
    {
        //generet ruangan dept random 3 digit pertama
        $angka_kode1 = range(0, 9);
        shuffle($angka_kode1);
        $ambilKode1 = array_rand($angka_kode1, 3);
        $generetKode1 = implode('', $ambilKode1);

        // kode ruangan yang sudah di random
        $kode_ruangan = 'ROOM-0' . $generetKode1;

        // get ruangan kedalam tabel ruangan
        $ruangan = $this->ruanganModel->findAll();

        // get data departemen dari table departemen
        $cabang = $this->cabangModel->findAll();


        $data = [
            'tittle' => 'Ruang Meeting',
            'ruangan' => $ruangan,
            'kode_ruangan' => $kode_ruangan,
            'cabang' => $cabang,
            'validation' => \Config\Services::validation()
        ];
        return view('ruang/index', $data);
    }

    public function proses_input()
    {
        // validasi form input ruangan
        if (!$this->validate([
            'kode_room' => [
                'rules' => 'required|is_unique[ruangan.kode_room]',
                'errors' => [
                    'required' => 'Kode Room Harus Di Lengkapi!',
                    'is_unique' => 'Kode Room Sudah Terdaftar!'
                ]
            ],
            'nama_ruangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Ruangan Harus Di Lengkapi!'
                ]
            ],
            'cabang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Cabang!'
                ]
            ],
            'kapasitas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Kapasitas Ruangan!'
                ]
            ]
        ])) {
            return redirect()->to(base_url('/views/ruang-meeting'))->withInput();
        } else {
            $fasilitas = '["null"]';
            // cek apakah fasilitas di ceklis?
            if ($this->request->getVar('fasilitas')) {

                $fasilitas = json_encode($this->request->getVar('fasilitas'));
            }

            // insert data ruangan kedalam table ruangan
            $this->ruanganModel->save([
                'kode_room' => $this->request->getVar('kode_room'),
                'nama_ruangan' => $this->request->getVar('nama_ruangan'),
                'cabang' => $this->request->getVar('cabang'),
                'kapasitas' => $this->request->getVar('kapasitas'),
                'fasilitas' => $fasilitas
            ]);

            session()->setFlashdata('pesan', 'Data Ruangan Berhasil di Tambah!');
            return redirect()->to(base_url('/views/ruang-meeting'))->withInput();
        }
    }

    public function update_room($kode_room)
    {
        // enkripsi data kode room
        $kodeRoom = base64_decode($kode_room);

        // get data room dari table room
        $data_room = $this->ruanganModel->where('kode_room', $kodeRoom)->first();
        // get data cabang
        $cabang = $this->cabangModel->findAll();

        $data = [
            'tittle' => 'Update Room',
            'data_room' => $data_room,
            'cabang' => $cabang,
            'validation' => \Config\Services::validation()
        ];

        return view('ruang/update', $data);
    }

    public function proses_update($kode_room)
    {
        // enkripsi data kode room
        $kodeRoom = base64_decode($kode_room);

        // validasi form update room
        if (!$this->validate([
            'kode_room' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode Room Harus Di Lengkapi!'
                ]
            ],
            'nama_ruangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Ruangan Harus Di Lengkapi!'
                ]
            ],
            'cabang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Cabang!'
                ]
            ],
            'kapasitas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Kapasitas Ruangan!'
                ]
            ]
        ])) {
            return redirect()->to(base_url('/admin/update-room/' . $kode_room))->withInput();
        } else {
            // get id data room untuk update
            $data_room = $this->ruanganModel->where('kode_room', $kodeRoom)->first();
            $id = $data_room['id'];

            $fasilitas = '["null"]';
            // cek apakah fasilitas di ceklis?
            if ($this->request->getVar('fasilitas')) {

                $fasilitas = json_encode($this->request->getVar('fasilitas'));
            }

            // update data room berdasarkan ID
            $this->ruanganModel->save([
                'id' => $id,
                'kode_room' => $this->request->getVar('kode_room'),
                'nama_ruangan' => $this->request->getVar('nama_ruangan'),
                'cabang' => $this->request->getVar('cabang'),
                'kapasitas' => $this->request->getVar('kapasitas'),
                'fasilitas' => $fasilitas
            ]);

            session()->setFlashdata('pesan', 'Data Ruangan Berhasil di Update!');
            return redirect()->to(base_url('/views/ruang-meeting'))->withInput();
        }
    }


    public function hapus($kode_room)
    {
        // enkripsi kode room
        $kodeRoom = base64_decode($kode_room);
        // get data room by kode room
        $data_room = $this->ruanganModel->where('kode_room', $kodeRoom)->first();
        // get id data room
        $id = $data_room['id'];

        // hapus data room by ID
        $this->ruanganModel->delete($id);

        session()->setFlashdata('pesan', 'Data Ruangan Berhasil di Hapus!');
        return redirect()->to(base_url('/views/ruang-meeting'))->withInput();
    }
}
