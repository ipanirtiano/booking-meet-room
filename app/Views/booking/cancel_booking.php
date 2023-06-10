<?= $this->extend('layout/template') ?>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">


        <div class="row">
            <div class="col">
                <h1 class="mt-4">Cancel Booking Room</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Cancel Booking Room</li>
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
                                <form action="<?= base_url(); ?>/booking/save_cancel_booking/<?= $kodeBooking; ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Kode Booking</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control form-control-sm <?= ($validation->hasError('kode_booking') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kode_booking" value="<?= $booking['kode_booking'] ?>" readonly>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('kode_booking'); ?>
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
                                    <button type="submit" class="btn btn-sm btn-danger">Cancel Booking</button>
                                    <a href="<?= base_url(); ?>/views/my-booking/<?= $kode_guest; ?>" class="btn btn-sm btn-info">Kembali</a>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Tanggal Booking</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control datepicker form-control-sm <?= ($validation->hasError('tanggal_booking') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="tanggal_booking" placeholder="dd-mm-yyyy" value="<?php if ($booking['tanggal_meeting']) {
                                                                                                                                                                                                                                                                    echo $booking['tanggal_meeting'];
                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                    echo date('d-m-Y');
                                                                                                                                                                                                                                                                } ?>" readonly>
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('tanggal_booking'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Jam Mulai </label>
                                    <div class="col-md-8">
                                        <input type="time" class="form-control form-control-sm <?= ($validation->hasError('jam_mulai') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="jam_mulai" placeholder="00:00" value="<?= $booking['jam_mulai']; ?>" readonly>
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('jam_mulai'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Jam Selesai </label>
                                    <div class="col-md-8">
                                        <input type="time" class="form-control form-control-sm <?= ($validation->hasError('jam_selesai') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="jam_selesai" placeholder="00:00" onkeyup="Waktumasuk();" value="<?= $booking['jam_akhir']; ?>" readonly>
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('jam_selesai'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label"><b>Topik Meeting</b> </label>
                                        <textarea class="form-control <?= ($validation->hasError('topik') ? 'is-invalid' : ''); ?>" id="exampleFormControlTextarea1" rows="3" name="topik" readonly><?= $booking['topik']; ?></textarea>
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('topik'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label"><b>Alasan Cancel</b> </label>
                                        <textarea class="form-control <?= ($validation->hasError('alasan_cancel') ? 'is-invalid' : ''); ?>" id="exampleFormControlTextarea1" rows="3" name="alasan_cancel"></textarea>
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('alasan_cancel'); ?>
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