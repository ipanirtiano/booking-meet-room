<?= $this->extend('layout/template') ?>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Booking List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Booking List</li>
        </ol>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-sm btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Pesan Ruangan</button>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        DataTable List Booking
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>


                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <?php $tanggal = date('d-m-Y'); ?>
                                    <?php $date_encode = base64_encode($tanggal); ?>
                                    <form action="<?= base_url(); ?>/views/list-booking/<?= $date_encode; ?>" method="post">
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Tanggal </label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control datepicker form-control-sm <?= ($validation->hasError('tanggal') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="tanggal" value="<?= $tanggal_list; ?>" placeholder="<?= date('d-m-Y'); ?>" autocomplete="off">
                                                <div class="invalid-feedback" style="font-size: small">
                                                    <?= $validation->getError('tanggal'); ?>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Booking</th>
                                        <th>Cabang</th>
                                        <th>Nama Ruangan</th>
                                        <th>Kapasitas</th>
                                        <th>Topik</th>
                                        <th>Tanggal</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Akhir</th>
                                        <th>Pemesan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // koneksi database manual
                                    $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
                                    ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($booking as $data) : ?>
                                        <!-- cek hanya status booking -->
                                        <?php if ($data['status'] == 'Booking' || $data['status'] == 'In') : ?>
                                            <?php
                                            // create number
                                            $i++;

                                            // kode room
                                            $kode_room = $data['kode_room'];
                                            // query manual
                                            $query = mysqli_query($conn, "SELECT * FROM ruangan WHERE kode_room = '$kode_room' ");
                                            // set baground row default
                                            $bg = ' ';
                                            // cek jika stasus in baground akan warna kuning
                                            if ($data['status'] == 'In') {
                                                $bg = "bg-warning";
                                            }


                                            // get data booking as array
                                            $data_booking = mysqli_fetch_assoc($query);

                                            // variable
                                            $kodeBooking = '-';
                                            $jam_mulai = '-';
                                            $jam_akhir = '-';
                                            $pemesan = '-';
                                            $status = 'Available';
                                            $btn = 'btn-sm btn-info';
                                            $title_btn = 'Booking Now';

                                            // cek apakah ruangan sudah dibooking?
                                            if ($data_booking) {
                                                $kodeBooking = $data['kode_booking'];
                                                $jam_mulai = $data['jam_mulai'];
                                                $jam_akhir = $data['jam_akhir'];

                                                // get nama pemesan
                                                $data_pemesan = $data['pemesan'];
                                                // query manual
                                                $query2 = mysqli_query($conn, "SELECT * FROM guest WHERE kode_guest = '$data_pemesan' ");
                                                // get data booking as array
                                                $data_nama_pemesan = mysqli_fetch_assoc($query2);
                                                // set pemesan
                                                $pemesan = $data_nama_pemesan['nama_lengkap'];

                                                $status = $data['status'];

                                                $btn = 'btn-sm btn-warning';
                                                $title_btn = 'Booking Later';


                                                // get nama cabang
                                                $data_cabang  = $data_booking['cabang'];
                                                // query manual
                                                $query2 = mysqli_query($conn, "SELECT * FROM cabang WHERE kode_cabang = '$data_cabang' ");
                                                // get data booking as array
                                                $data_nama_cabang = mysqli_fetch_assoc($query2);
                                                // set pemesan
                                                $cabang = $data_nama_cabang['nama_cabang'];
                                            }

                                            ?>
                                            <tr class="<?= $bg; ?>">
                                                <td><?= $i; ?></td>
                                                <td><?= $kodeBooking; ?></td>
                                                <td class="text-nowrap"><?= $cabang ?></td>
                                                <td class="text-nowrap"><?= $data_booking['nama_ruangan']; ?></td>
                                                <td class="text-nowrap"><?= $data_booking['kapasitas']; ?></td>
                                                <td class="text-nowrap"><?= $data['topik']; ?></td>
                                                <td class="text-nowrap"><?= $data['tanggal_meeting']; ?></td>
                                                <td><?= $jam_mulai; ?></td>
                                                <td><?= $jam_akhir; ?></td>
                                                <td class="text-nowrap"><?= $pemesan; ?></td>
                                                <td><?= $status; ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-server mr-2" aria-hidden="true"></i>List Ruangan Meeting</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= csrf_field() ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Room</th>
                                        <th>Nama Ruangan</th>
                                        <th>Cabang</th>
                                        <th>Kapasitas</th>
                                        <th>Fasilitas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // koneksi database manual
                                    $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
                                    ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($ruangan as $data) : ?>
                                        <?php
                                        // create number
                                        $i++;
                                        // get kode room dari model ruangan
                                        $kode_room = $data['kode_room'];

                                        $dataFasilitas = $data['fasilitas'];
                                        $data_fasilitas = json_decode($dataFasilitas);

                                        $fasilitas = implode(", ", $data_fasilitas);

                                        // get kode cabang
                                        $kode_cabang = $data['cabang'];
                                        // query manual
                                        $query = mysqli_query($conn, "SELECT * FROM cabang WHERE kode_cabang = '$kode_cabang'");
                                        // get data booking as array
                                        $nama_cabang = mysqli_fetch_assoc($query);

                                        // query manual
                                        $query_booking = mysqli_query($conn, "SELECT * FROM booking WHERE kode_room = '$kode_room' ");
                                        // get data booking as array
                                        $data_booking = mysqli_fetch_assoc($query);

                                        ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td class="text-nowrap"><?= $kode_room; ?></td>
                                            <td class="text-nowrap"><?= $data['nama_ruangan']; ?></td>
                                            <td class="text-nowrap"><?= $nama_cabang['nama_cabang'] ?></td>
                                            <td class="text-nowrap"><?= $data['kapasitas']; ?></td>
                                            <td><?= $fasilitas; ?></td>
                                            <td>
                                                <?php $kodeRoom = base64_encode($data['kode_room']) ?>
                                                <!-- variable kode booking -->
                                                <?php $kodeBook = 'NULL' ?>
                                                <!-- cek kode booking -->
                                                <?php if ($data_booking['kode_booking']) {
                                                    $kodeBook = $data_booking['kode_booking'];
                                                } else {
                                                    $kodeBook = 'NULL';
                                                } ?>

                                                <a href="<?= base_url(); ?>/views/booking-room/<?= $kodeRoom; ?>/<?= $kodeBook; ?>" class="btn btn-sm btn-info">Booking Now!</a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>