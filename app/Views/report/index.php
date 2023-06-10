<?= $this->extend('layout/template') ?>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Report Booking Room</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Report Booking</li>
        </ol>
        <div class="row">
            <div class="col-md-8">
                <form action="<?= base_url(); ?>/admin/report" method="post">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Tanggal Mulai</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control datepicker form-control-sm <?= ($validation->hasError('tanggal_booking') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="tanggal_mulai" placeholder="dd-mm-yyyy" autocomplete="off" value="<?= $tanggal_mulai; ?>" required>
                        </div>
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Tanggal Selesai</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control datepicker form-control-sm <?= ($validation->hasError('tanggal_booking') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="tanggal_selesai" placeholder="dd-mm-yyyy" autocomplete="off" value="<?= ($tanggal_selesai ? $tanggal_selesai : date('d-m-Y')) ?>" required>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-info" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <!-- cek variable tanggal mulai dan tanggal selesai -->
                    <?php
                    if ($tanggal_mulai != NULL && $tanggal_selesai != NULL) : ?>
                        <a href="<?= base_url(); ?>/admin/print/<?= $tanggal_mulai; ?>/<?= $tanggal_selesai; ?>" class="btn btn-sm btn-info mb-3 mt-2"><i class="fa fa-print mr-2" aria-hidden="true"></i>Print PDF</a>
                    <?php endif; ?>


                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Booking</th>
                                <th>Cabang</th>
                                <th>Nama Ruangan</th>
                                <th>Topik</th>
                                <th>Tanggal</th>
                                <th>Jam Mulai</th>
                                <th>Jam Akhir</th>
                                <th>Pemesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // koneksi database manual
                            $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
                            ?>
                            <?php $i = 0; ?>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM booking WHERE tanggal_meeting BETWEEN '$tanggal_mulai' AND '$tanggal_selesai' ORDER BY tanggal_meeting ASC");

                            ?>
                            <?php foreach ($query as $data) : ?>
                                <?php
                                $i++;

                                // get nama cabang
                                $kode_cabang = $data['kode_cabang'];
                                $query_cabang = mysqli_query($conn, "SELECT * FROM cabang WHERE kode_cabang = '$kode_cabang'");
                                $data_cabang = mysqli_fetch_assoc($query_cabang);

                                // get nama ruangan
                                $kode_ruangan = $data['kode_room'];
                                $query_ruangan = mysqli_query($conn, "SELECT * FROM ruangan WHERE kode_room = '$kode_ruangan'");
                                $data_ruangan = mysqli_fetch_assoc($query_ruangan);

                                // get nama pemesan
                                $kode_guest = $data['pemesan'];
                                $query_pemesan = mysqli_query($conn, "SELECT * FROM guest WHERE kode_guest = '$kode_guest'");
                                $data_pemesan = mysqli_fetch_assoc($query_pemesan);
                                ?>


                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $data['kode_booking']; ?></td>
                                    <td class="text-nowrap"><?= $data_cabang['nama_cabang'] ?></td>
                                    <td class="text-nowrap"><?= $data_ruangan['nama_ruangan']; ?></td>
                                    <td class="text-nowrap"><?= $data['topik']; ?></td>
                                    <td class="text-nowrap"><?= $data['tanggal_meeting']; ?></td>
                                    <td class="text-nowrap"><?= $data['jam_mulai']; ?></td>
                                    <td class="text-nowrap"><?= $data['jam_akhir']; ?></td>
                                    <td class="text-nowrap"><?= $data_pemesan['nama_lengkap'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>


</div>
</div>
<?php $this->endSection() ?>