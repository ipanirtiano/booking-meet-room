<?= $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">


        <div class="row">
            <div class="col">
                <h1 class="mt-4">Update Data</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Departemen</li>
                    <li class="breadcrumb-item active">Update</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-users mr-2" aria-hidden="true"></i> Update Data Departemen
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-5">
                                <?php $kodeDept = base64_encode($departemen_upd['kode_dept']); ?>
                                <form action="<?= base_url(); ?>/departemen/proses_update/<?= $kodeDept; ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Kode Departemen</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('kode_dept') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" readonly value="<?= $departemen_upd['kode_dept']; ?>" name="kode_dept">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('kode_dept'); ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Departemen</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_dept') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" name="nama_dept" onkeyup="this.value = this.value.toUpperCase();" value="<?= $departemen_upd['nama_departemen']; ?>">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('nama_dept'); ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info">Update</button>
                                    <a href="<?= base_url(); ?>/admin/departemen" class="btn btn-danger">Cancel</a>
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