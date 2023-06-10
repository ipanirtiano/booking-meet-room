<?= $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Booking Room</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Booking Room</li>
        </ol>
        <div class="row justify-content-center">
            <div class="col-xl-2 col-md-4">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body" style="text-align:center"><i class="fa fa-address-book mb-2" aria-hidden="true" style="width: 80px; height: 80px"></i><br>List Booking Hari Ini</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url(); ?>/admin/list-booking">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body" style="text-align:center"><i class="fa fa-calendar-check mb-2" aria-hidden="true" style="width: 80px; height: 80px"></i><br>List Booking Besok</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body" style="text-align:center"><i class="fa fa-align-left mb-2" aria-hidden="true" style="width: 80px; height: 80px"></i><br>Ruangan Tersedia</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>