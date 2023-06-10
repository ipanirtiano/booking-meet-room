<?= $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">


        <div class="row">
            <div class="col">
                <h1 class="mt-4">Update Data</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Users</li>
                    <li class="breadcrumb-item active">Update</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-user mr-2" aria-hidden="true"></i> Update Data User
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <?php $kodeUser = base64_encode($data_user['kode_guest']); ?>
                                <form action="<?= base_url(); ?>/guest/proses_update/<?= $kodeUser; ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Kode User</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm <?= ($validation->hasError('kode_user') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kode_user" value="<?= $data_user['kode_guest'] ?>" readonly>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('kode_user'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Nama</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control <?= ($validation->hasError('nama') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="nama" value="<?= $data_user['nama_lengkap'] ?>">
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('nama'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control <?= ($validation->hasError('email') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="email" value="<?= $data_user['email'] ?>" placeholder="Email">
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('email'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Phone</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control form-control <?= ($validation->hasError('phone') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="phone" value="<?= $data_user['phone'] ?>" placeholder="Phone">
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('phone'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Departemen</label>
                                        <div class="col-md-9">
                                            <select class="form-control form-control mb-2 <?= ($validation->hasError('departemen') ? 'is-invalid' : ''); ?>" name="departemen">
                                                <option selected="selected" value=" ">Departemen</option>
                                                <?php foreach ($departemen as $data) : ?>
                                                    <option value="<?= $data['nama_departemen']; ?>" <?= ($data_user['departemen'] == $data['nama_departemen'] ? 'selected' : ''); ?>><?= $data['nama_departemen']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('departemen'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Level</label>
                                        <div class="col-sm-9">
                                            <div class="form-check form-check-inline mt-1">
                                                <input class="form-check-input <?= ($validation->hasError('level') ? 'is-invalid' : ''); ?>" type="radio" name="level" id="inlineRadio1" value="guest" <?= $level['level'] == 'guest' ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="inlineRadio1" style="font-size:14px;">Guest</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input <?= ($validation->hasError('level') ? 'is-invalid' : ''); ?>" type="radio" name="level" id="inlineRadio2" value="admin" <?= $level['level'] == 'admin' ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="inlineRadio2" style="font-size:14px;">Admin</label>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-info">Update</button>
                                    <a href="<?= base_url(); ?>/admin/users" class="btn btn-sm btn-danger">Cancel</a>
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