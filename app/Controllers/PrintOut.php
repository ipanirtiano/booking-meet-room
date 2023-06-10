<?php

namespace App\Controllers;

use TCPDF;

use CodeIgniter\Config\Config;
use App\Models\BookingModel;
use CodeIgniter\HTTP\Request;

class PrintOut extends BaseController
{
    public function __construct()
    {
        $this->bookingModel = new BookingModel();
    }

    public function index()
    {
        $tanggal_mulai = '';
        $tanggal_selesai = '';
        if ($this->request->getVar('tanggal_mulai') && $this->request->getVar('tanggal_selesai')) {
            $tanggal_mulai = $this->request->getVar('tanggal_mulai');
            $tanggal_selesai = $this->request->getVar('tanggal_selesai');
        }

        $data_booking = $this->bookingModel->findAll();

        $data = [
            'tittle' => 'Report',
            'data_booking' => $data_booking,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'validation' => \Config\Services::validation()
        ];


        return view('report/index', $data);
    }

    // Function print out
    public function print($tanggal_mulai = 'null', $tanggal_selesai = 'null')
    {
        $data_booking = $this->bookingModel->findAll();

        $data = [
            'data_booking' => $data_booking,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai
        ];

        $html = view('print_data_booking', $data);


        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPageOrientation('L');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');

        $pdf->Output('Data Booking.pdf', 'I');
    }
}
