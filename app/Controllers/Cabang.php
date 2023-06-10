<?php

namespace App\Controllers;

use App\Models\CabangModel;
use App\Models\GuestModel;
use App\Models\RuanganModel;

class Cabang extends BaseController
{

    public function __construct()
    {
        $this->cabangModel = new CabangModel();
    }

    public function index()
    {
        //generet kode cabang random 3 digit pertama
        $angka_kode1 = range(0, 9);
        shuffle($angka_kode1);
        $ambilKode1 = array_rand($angka_kode1, 3);
        $generetKode1 = implode('', $ambilKode1);
        // generate kode cabang random 3 digit kedua
        $angka_kode2 = range(0, 9);
        shuffle($angka_kode2);
        $ambilKode2 = array_rand($angka_kode2, 3);
        $generetKode2 = implode('', $ambilKode2);
        // kode cabang yang sudah di random
        $kode_cabang = 'CB-' . $generetKode1 . $generetKode2;

        // get data cabang
        $data_cabang = $this->cabangModel->findAll();

        $data = [
            'tittle' => 'Cabang',
            'kode_cabang' => $kode_cabang,
            'cabang' => $data_cabang,
            'validation' => \Config\Services::validation()
        ];
        return view('cabang/index', $data);
    }


    public function proses_input()
    {
        // validasi form cabang
        if (!$this->validate([
            'kode_cabang' => [
                'rules' => 'required|is_unique[cabang.kode_cabang]',
                'errors' => [
                    'required' => 'Kode Cabang Harus Di Lengkapi!',
                    'is_unique' => 'Kode Cabang Sudah Terdaftar!'
                ]
            ],
            'nama_cabang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Cabang Harus Di Lengkapi!'
                ]
            ],
            'kota_cabang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kota Cabang Harus Di Lengkapi!'
                ]
            ],
            'telpon_cabang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'telpon Cabang Harus Di Lengkapi!'
                ]
            ],
            'alamat_cabang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Cabang Harus Di Lengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/cabang'))->withInput();
        } else {
            // insert data cabang kedalam table cabang
            $this->cabangModel->save([
                'kode_cabang' => $this->request->getVar('kode_cabang'),
                'nama_cabang' => $this->request->getVar('nama_cabang'),
                'kota_cabang' => $this->request->getVar('kota_cabang'),
                'alamat_cabang' => $this->request->getVar('alamat_cabang'),
                'telpon_cabang' => $this->request->getVar('telpon_cabang'),
            ]);


            session()->setFlashdata('pesan', 'Data Cabang Berhasil di Tambah!');
            return redirect()->to(base_url('/admin/cabang'))->withInput();
        }
    }


    public function update_cabang($kode_cabang)
    {
        $kodeCabang = base64_decode($kode_cabang);

        $data_cabang = $this->cabangModel->where('kode_cabang', $kodeCabang)->first();

        $data = [
            'tittle' => 'Update Cabang',
            'data_cabang' => $data_cabang,
            'validation' => \Config\Services::validation()
        ];

        return view('cabang/update', $data);
    }


    public function proses_update($kode_cabang)
    {
        $kodeCabang = base64_decode($kode_cabang);

        // ambil id cabang
        $id  = $this->cabangModel->where('kode_cabang', $kodeCabang)->first();

        // validasi form update cabang
        if (!$this->validate([
            'kode_cabang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode Cabang Harus Di Lengkapi!'
                ]
            ],
            'nama_cabang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Cabang Harus Di Lengkapi!'
                ]
            ],
            'kota_cabang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kota Cabang Harus Di Lengkapi!'
                ]
            ],
            'telpon_cabang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'telpon Cabang Harus Di Lengkapi!'
                ]
            ],
            'alamat_cabang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Cabang Harus Di Lengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/update-cabang/' . $kode_cabang))->withInput();
        } else {
            // update data cabang
            $this->cabangModel->save([
                'id' => $id['id'],
                'kode_cabang' => $this->request->getVar('kode_cabang'),
                'nama_cabang' => $this->request->getVar('nama_cabang'),
                'kota_cabang' => $this->request->getVar('kota_cabang'),
                'alamat_cabang' => $this->request->getVar('alamat_cabang'),
                'telpon_cabang' => $this->request->getVar('telpon_cabang'),
            ]);

            session()->setFlashdata('pesan', 'Data Cabang Berhasil di Update!');
            return redirect()->to(base_url('/admin/cabang'))->withInput();
        }
    }


    public function hapus($kode_cabang)
    {
        $kodeCabang = base64_decode($kode_cabang);

        // get id data cabang
        $data_cabang = $this->cabangModel->where('kode_cabang', $kodeCabang)->first();
        $id = $data_cabang['id'];

        // delete cabang
        $this->cabangModel->delete($id);
        session()->setFlashdata('pesan', 'Data Cabang Berhasil di Hapus!');
        return redirect()->to(base_url('/admin/cabang'))->withInput();
    }
}
