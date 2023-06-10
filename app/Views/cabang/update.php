<?= $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">


        <div class="row">
            <div class="col">
                <h1 class="mt-4">Update Cabang</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Users</li>
                    <li class="breadcrumb-item active">Update Cabang</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-user mr-2" aria-hidden="true"></i> Update Cabang
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <?php $kodeCabang = base64_encode($data_cabang['kode_cabang']); ?>
                                <form action="<?= base_url(); ?>/cabang/proses_update/<?= $kodeCabang; ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Kode Cabang</label>
                                        <input type="text" class="form-control col-5 <?= ($validation->hasError('kode_cabang') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" readonly value="<?= $data_cabang['kode_cabang']; ?>" name="kode_cabang">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('kode_cabang'); ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Cabang</label>
                                        <input type="text" class="form-control col-5 <?= ($validation->hasError('nama_cabang') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" name="nama_cabang" onkeyup="this.value = this.value.toUpperCase();" placeholder="Nama Cabang" value="<?= $data_cabang['nama_cabang']; ?>">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('nama_cabang'); ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Kota Cabang</label>
                                        <input type="text" class="form-control col-5 <?= ($validation->hasError('kota_cabang') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" name="kota_cabang" onkeyup="this.value = this.value.toUpperCase();" placeholder="Kota Cabang" value="<?= $data_cabang['kota_cabang']; ?>">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('kota_cabang'); ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Telpon Cabang</label>
                                        <input type="number" class="form-control col-5 <?= ($validation->hasError('telpon_cabang') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" name="telpon_cabang" placeholder="Telpon Cabang" value="<?= $data_cabang['telpon_cabang']; ?>">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('telpon_cabang'); ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Alamat Cabang</label>
                                        <textarea class="form-control <?= ($validation->hasError('alamat_cabang') ? 'is-invalid' : ''); ?>" placeholder="Alamat" id="floatingTextarea2" style="height: 100px" name="alamat_cabang"><?= $data_cabang['alamat_cabang']; ?></textarea>
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('alamat_cabang'); ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-info">Update</button>
                                    <a href="<?= base_url(); ?>/admin/cabang" class="btn btn-sm btn-danger">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>