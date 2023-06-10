<?= $this->extend('layout/template') ?>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php $this->section('content') ?>
<div id="layoutSidenav_content" class="bg-light">
    <div class="container-fluid">
        <h1 class="mt-4">Resepsionis</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Resepsionis</li>
        </ol>

        <div class="row">
            <div class="col">
                <!-- <button type="button" class="btn btn-sm btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Pesan Ruangan</button> -->
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
                                    <?php
                                    $date_encode = base64_encode($tanggal);
                                    $kode_cabang_encode = base64_encode($kode_cabang);
                                    ?>
                                    <form action="<?= base_url(); ?>/admin/resepsionis-list/<?= $kode_cabang_encode; ?>/<?= $date_encode; ?>" method="post">
                                        <div class="form-group row">
                                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Tanggal </label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control datepicker form-control-sm" id="colFormLabelSm" name="tanggal" value="<?= $tanggal_list; ?>" placeholder="<?= date('d-m-Y'); ?>" autocomplete="off">
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
                                        <th>Tanggal</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Akhir</th>
                                        <th>Pemesan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    // koneksi database manual
                                    $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
                                    ?>
                                    <?php foreach ($booking as $data) : ?>
                                        <?php if ($data['status'] == 'Booking' || $data['status'] == 'In') : ?>
                                            <?php $i++;
                                            // query data booking by kode cabang
                                            // get kode cabang
                                            $kode_cabang = $data['kode_cabang'];
                                            // get cabang
                                            $query_cabang = mysqli_query($conn, "SELECT * FROM cabang WHERE kode_cabang = '$kode_cabang' ");
                                            // get data cabang as array
                                            $data_nama_cabang = mysqli_fetch_assoc($query_cabang);
                                            // get nama cabang
                                            $cabang = $data_nama_cabang['nama_cabang'];

                                            // get nama ruangan 
                                            // get kode room
                                            $kode_room = $data['kode_room'];
                                            // query manual
                                            $query_ruangan = mysqli_query($conn, "SELECT * FROM ruangan WHERE kode_room = '$kode_room' ");
                                            // get data ruangan as array
                                            $data_ruangan = mysqli_fetch_assoc($query_ruangan);
                                            // get nama ruangan
                                            $ruangan = $data_ruangan['nama_ruangan'];
                                            // get kapasistas ruangan
                                            $kapasitas = $data_ruangan['kapasitas'];

                                            // get nama pemesan
                                            // get kode pemesan
                                            $kode_pemesan = $data['pemesan'];
                                            // query manual
                                            $query_pemesan = mysqli_query($conn, "SELECT * FROM guest WHERE kode_guest = '$kode_pemesan' ");
                                            // get data ruangan as array
                                            $data_pemesan = mysqli_fetch_assoc($query_pemesan);
                                            // get nama ruangan
                                            $pemesan = $data_pemesan['nama_lengkap'];

                                            // cek status booking
                                            $status_booking = $data['status'];
                                            // variable 
                                            $class = 'btn btn-sm btn-info';
                                            $button = 'In';
                                            $kode_booking = base64_encode($data['kode_booking']);
                                            $icon = '<i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>';
                                            $href = base_url() . '/admin/booking-in/' . $kode_cabang_encode . '/' . $date_encode . '/' . $kode_booking;
                                            $bg = '';
                                            if ($status_booking == 'In') {
                                                $class = 'btn btn-sm btn-danger';
                                                $button = 'Out';
                                                $icon = '<i class="fa fa-arrow-right mr-2" aria-hidden="true"></i>';
                                                $bg = 'bg-warning';
                                                $href = base_url() . '/admin/booking-out/' . $kode_cabang_encode . '/' . $date_encode . '/' . $kode_booking;
                                            }
                                            ?>
                                            <tr class="<?= $bg; ?>">
                                                <td><?= $i; ?></td>
                                                <td class="text-nowrap"><?= $data['kode_booking']; ?></td>
                                                <td class="text-nowrap"><?= $cabang ?></td>
                                                <td class="text-nowrap"><?= $ruangan; ?></td>
                                                <td class="text-nowrap"><?= $kapasitas; ?></td>
                                                <td class="text-nowrap"><?= $data['tanggal_meeting']; ?></td>
                                                <td class="text-nowrap"><?= $data['jam_mulai']; ?></td>
                                                <td class="text-nowrap"><?= $data['jam_akhir']; ?></td>
                                                <td class="text-nowrap"><?= $pemesan; ?></td>
                                                <td class="text-nowrap"><?= $status_booking ?></td>
                                                <td>
                                                    <?php
                                                    $tgl_awal = date_create(date('d-m-Y'));
                                                    $tgl_akhir = date_create($tanggal_list);
                                                    $diff = date_diff($tgl_awal, $tgl_akhir);

                                                    // cek selisih waktu
                                                    if ($diff->days == 0) { ?>
                                                        <a href="<?= $href; ?>" class="<?= $class; ?>"><?= $icon; ?><?= $button; ?></a>
                                                    <?php } else { ?>
                                                        <i class="fa fa-times mr-2" aria-hidden="true"></i>Close
                                                    <?php } ?>
                                                </td>
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


    </div>
</div>
<?php $this->endSection() ?>