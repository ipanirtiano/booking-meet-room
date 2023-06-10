<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\CancelBookingModel;
use App\Models\GuestModel;
use App\Models\RuanganModel;

class Dashboard extends BaseController
{

    public function __construct()
    {
        $this->guestModel = new GuestModel();
        $this->ruanganModel = new RuanganModel();
        $this->bookingModel = new BookingModel();
        $this->cancelBooking = new CancelBookingModel();
    }

    public function index()
    {
        // tanggal 
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('d-m-Y');

        // get nums rows
        $pengguna = $this->guestModel->getNumRows();
        $ruangan = $this->ruanganModel->getNumRows();
        $booking_today = $this->bookingModel->getNumRows_today($tanggal);
        $cancelBooking = $this->cancelBooking->getNumRows_today($tanggal);


        $data = [
            'tittle' => 'Dashboard | Home',
            'pengguna' => $pengguna,
            'ruangan' => $ruangan,
            'booking_today' => $booking_today,
            'cancel_booking' => $cancelBooking
        ];
        return view('Dashboard/index', $data);
    }
}
