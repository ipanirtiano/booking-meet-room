<?= $this->extend('layout/template') ?>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">


        <div class="row">
            <div class="col">
                <h1 class="mt-4">Edit Booking Room</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Edit Booking Room</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-book mr-2" aria-hidden="true"></i> Booking Room
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('pesan-gagal')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan-gagal'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-4">
                                <?php $kodeBooking = base64_encode($booking['kode_booking']) ?>
                                <form action="<?= base_url(); ?>/booking/save_edit_booking/<?= $kodeBooking; ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Kode Room</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control form-control-sm <?= ($validation->hasError('kode_room') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kode_room" value="<?= $booking['kode_room'] ?>" readonly>
                                            <input type="hidden" name="kode_booking" value="<?= $booking['kode_booking']; ?>">
                                            <input type="hidden" name="cabang" value="<?= $booking['kode_cabang']; ?>">
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('kode_room'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Ruangan</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control form-control <?= ($validation->hasError('nama_ruangan') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="nama_ruangan" value="<?= $nama_ruangan['nama_ruangan'] ?>" readonly>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('nama_ruangan'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Kapasitas</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control form-control <?= ($validation->hasError('kapasitas') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kapasitas" value="<?= $nama_ruangan['kapasitas'] ?>" readonly>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('kapasitas'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Fasilitas</label>
                                        <?php
                                        $data_fasilitas = json_decode($nama_ruangan['fasilitas']);
                                        ?>
                                        <div class="col-md-8">
                                            <div class="mb-1 form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="Wifi" <?php foreach ($data_fasilitas as $fasilitas) : ?> <?= ($fasilitas == 'Wifi' ? 'checked' : '') ?> <?php endforeach; ?> disabled>
                                                <label class="form-check-label" for=""></label>Wifi
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="In Focus" <?php foreach ($data_fasilitas as $fasilitas) : ?> <?= ($fasilitas == 'In Focus' ? 'checked' : '') ?> <?php endforeach; ?> disabled>
                                                <label class="form-check-label" for="exampleCheck1"></label>In Focus
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="White Board" <?php foreach ($data_fasilitas as $fasilitas) : ?> <?= ($fasilitas == 'White Board' ? 'checked' : '') ?> <?php endforeach; ?> disabled>
                                                <label class="form-check-label" for="exampleCheck1"> </label>White Board
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="Monitor LED" <?php foreach ($data_fasilitas as $fasilitas) : ?> <?= ($fasilitas == 'Monitor LED' ? 'checked' : '') ?> <?php endforeach; ?> disabled>
                                                <label class="form-check-label" for="exampleCheck1"> </label>Monitor LED
                                            </div>
                                            <div class="mb-1 form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="Sound System" <?php foreach ($data_fasilitas as $fasilitas) : ?> <?= ($fasilitas == 'Sound System' ? 'checked' : '') ?> <?php endforeach; ?> disabled>
                                                <label class="form-check-label" for="exampleCheck1"></label>Sound System
                                            </div>
                                        </div>
                                    </div>
                                    <?php $kode_guest = base64_encode(session('kode_guest')) ?>
                                    <button type="submit" class="btn btn-sm btn-warning">Edit Booking</button>
                                    <a href="<?= base_url(); ?>/views/my-booking/<?= $kode_guest; ?>" class="btn btn-sm btn-danger">Cancel</a>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Pemesan</label>
                                    <?php
                                    $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
                                    // get nama pemesan
                                    $data_pemesan = session('kode_guest');
                                    // query manual
                                    $query2 = mysqli_query($conn, "SELECT * FROM guest WHERE kode_guest = '$data_pemesan' ");
                                    // get data booking as array
                                    $data_nama_pemesan = mysqli_fetch_array($query2);
                                    $pemesan = '';

                                    ?>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('nama_pemesan') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="nana" placeholder="<?= session('nama'); ?>" readonly>
                                        <input type="hidden" name="nama_pemesan" value="<?= session('kode_guest'); ?>">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('nama_pemesan'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Email Pemesan</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('email_pemesan') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="email_pemesan" value="<?= session('email') ?>" readonly>
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('email_pemesan'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Phone / Ext</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('phone') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="phone" value="<?= session('phone') ?>" readonly>
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('phone'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label"><b>Topik Meeting</b> </label>
                                        <textarea class="form-control <?= ($validation->hasError('topik') ? 'is-invalid' : ''); ?>" id="exampleFormControlTextarea1" rows="3" name="topik"><?= $booking['topik']; ?></textarea>
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('topik'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tanggal Booking</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control datepicker form-control-sm <?= ($validation->hasError('tanggal_booking') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="tanggal_booking" placeholder="dd-mm-yyyy" value="<?php if ($booking['tanggal_meeting']) {
                                                                                                                                                                                                                                                                    echo $booking['tanggal_meeting'];
                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                    echo date('d-m-Y');
                                                                                                                                                                                                                                                                } ?>">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('tanggal_booking'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Jam Mulai </label>
                                    <div class="col-md-8">
                                        <input type="time" class="form-control form-control-sm <?= ($validation->hasError('jam_mulai') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="jam_mulai" placeholder="00:00" value="<?= $booking['jam_mulai']; ?>">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('jam_mulai'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Jam Selesai </label>
                                    <div class="col-md-8">
                                        <input type="time" class="form-control form-control-sm <?= ($validation->hasError('jam_selesai') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="jam_selesai" placeholder="00:00" onkeyup="Waktumasuk();" value="<?= $booking['jam_akhir']; ?>">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('jam_selesai'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>