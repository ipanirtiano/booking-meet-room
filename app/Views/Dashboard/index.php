<?= $this->extend('layout/template') ?>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php $this->section('content') ?>
<?php if (session('level') == 'admin') : ?>
    <div id="layoutSidenav_content">
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-3">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body" style="text-align:center"><i class="fa fa-user mb-2" aria-hidden="true" style="width: 80px; height: 80px"></i><br> Pengguna <br>
                            <small><?= $pengguna .  ' ' . 'User' ?></small></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url(); ?>/admin/users">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body" style="text-align:center"><i class="fa fa-building mb-2" aria-hidden="true" style="width: 80px; height: 80px"></i><br>Ruang Meeting <br>
                            <small><?= $ruangan .  ' ' . 'Room' ?></small> </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url(); ?>/views/ruang-meeting">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3">
                    <?php $tanggal = date('d-m-Y'); ?>
                    <?php $date_encode = base64_encode($tanggal); ?>
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body" style="text-align:center"><i class="fa fa-address-book mb-2" aria-hidden="true" style="width: 80px; height: 80px"></i><br>Pesanan Hari Ini
                            <?php $i = 0 ?>
                            <?php foreach ($booking_today as $today) : ?>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <br><small><?= $i .  ' ' . 'Booking' ?></small>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url(); ?>/views/list-booking/<?= $date_encode; ?>">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body" style="text-align:center"><i class="fa fa-times-circle mb-2" aria-hidden="true" style="width: 80px; height: 80px"></i><br>Cancel Booking
                            <?php $i = 0 ?>
                            <?php foreach ($cancel_booking as $cancel) : ?>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <br><small><?= $i .  ' ' . 'Cancel' ?></small>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url(); ?>/admin/list-cancel/<?= $date_encode; ?>">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar mr-1"></i>
                            Chart Booking Room
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="10%"></canvas></div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- jika yang login adalah guest -->
<?php if (session('level') == 'guest') : ?>
    <div id="layoutSidenav_content">
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            <div class="row">
                <div class="col-xl-3 col-md-3">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body" style="text-align:center"><i class="fa fa-building mb-2" aria-hidden="true" style="width: 80px; height: 80px"></i><br>Ruang Meeting <br>
                            <small><?= $ruangan .  ' ' . 'Room' ?></small> </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url(); ?>/views/ruang-meeting">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3">
                    <?php $tanggal = date('d-m-Y'); ?>
                    <?php $date_encode = base64_encode($tanggal); ?>
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body" style="text-align:center"><i class="fa fa-address-book mb-2" aria-hidden="true" style="width: 80px; height: 80px"></i><br>Pesanan Hari Ini
                            <?php $i = 0 ?>
                            <?php foreach ($booking_today as $today) : ?>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <br><small><?= $i .  ' ' . 'Booking' ?></small>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?= base_url(); ?>/views/list-booking/<?= $date_encode; ?>">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
<?php endif; ?>
<?php $this->endSection() ?>