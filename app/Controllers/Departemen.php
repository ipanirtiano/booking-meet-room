<?php

namespace App\Controllers;

use App\Models\DepartemenModel;

class Departemen extends BaseController
{

    public function __construct()
    {
        $this->departemenModel = new DepartemenModel();
    }

    public function index()
    {
        //generet kode dept random 3 digit pertama
        $angka_kode1 = range(0, 9);
        shuffle($angka_kode1);
        $ambilKode1 = array_rand($angka_kode1, 3);
        $generetKode1 = implode('', $ambilKode1);
        // generate kode dept random 3 digit kedua
        $angka_kode2 = range(0, 9);
        shuffle($angka_kode2);
        $ambilKode2 = array_rand($angka_kode2, 3);
        $generetKode2 = implode('', $ambilKode2);
        // kode dept yang sudah di random
        $kode_dept = 'Dept-' . $generetKode1 . $generetKode2;

        // select data dari table departemen
        $departemen = $this->departemenModel->findAll();

        $data = [
            'tittle' => 'Departemen',
            'kode_dept' => $kode_dept,
            'validation' => \Config\Services::validation(),
            'departemen' => $departemen
        ];
        return view('Departemen/index', $data);
    }

    public function proses_input()
    {
        // validasi form input departemen
        if (!$this->validate([
            'kode_dept' => [
                'rules' => 'required|is_unique[departemen.kode_dept]',
                'errors' => [
                    'required' => 'Kode Departemen Harus Di Lengkapi!',
                    'is_unique' => 'Kode Departemen Sudah Terdaftar!'
                ]
            ],
            'nama_dept' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Departemen Harus Di Lengkapi!'
                ]
            ],
        ])) {

            return redirect()->to(base_url('/admin/departemen'))->withInput();
        } else {
            // insert data kedalam table departemen
            $this->departemenModel->save([
                'kode_dept' => $this->request->getVar('kode_dept'),
                'nama_departemen' => $this->request->getVar('nama_dept')
            ]);


            session()->setFlashdata('pesan', 'Data Departemen Berhasil di Tambah!');
            return redirect()->to(base_url('/admin/departemen'))->withInput();
        }
    }

    public function update_dept($kode_dept)
    {
        // data kode dept yang di decrypt
        $kode_departemen = base64_decode($kode_dept);
        // select kedalam table departemen
        $data_dept = $this->departemenModel->where('kode_dept', $kode_departemen)->first();


        $data = [
            'tittle' => 'Edit Dept',
            'departemen_upd' => $data_dept,
            'validation' => \Config\Services::validation(),
        ];

        return view('Departemen/update', $data);
    }

    public function proses_update($kode_dept)
    {
        // get kode_dept encript
        $kodeDept = base64_decode($kode_dept);
        // validasi form update
        if (!$this->validate([
            'kode_dept' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode Departemen Harus Di Lengkapi!',
                    'is_unique' => 'Kode Departemen Sudah Terdaftar!'
                ]
            ],
            'nama_dept' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Departemen Harus Di Lengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/update-dept/' . $kode_dept));
        } else {
            // get id dari data table departemen
            $id = $this->departemenModel->where('kode_dept', $kodeDept)->first();

            // update data table departement
            $this->departemenModel->save([
                'id' => $id['id'],
                'kode_dept' => $this->request->getVar('kode_dept'),
                'nama_departemen' => $this->request->getVar('nama_dept')
            ]);
            session()->setFlashdata('pesan', 'Data Departemen Berhasil di Update!');
            return redirect()->to(base_url('/admin/departemen'))->withInput();
        }
    }

    public function hapus($kode_dept)
    {
        // enkripsi kode departemen
        $kodeDept = base64_decode($kode_dept);

        // get data departemen by kode departemen
        $data_dept = $this->departemenModel->where('kode_dept', $kodeDept)->first();
        // hapus data departemen dari table departemen
        $id_dept = $data_dept['id'];
        $this->departemenModel->delete($id_dept);

        session()->setFlashdata('pesan', 'Data Departemen Berhasil di Hapus!');
        return redirect()->to(base_url('/admin/departemen'))->withInput();
    }
}
