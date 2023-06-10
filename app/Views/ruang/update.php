<?= $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">


        <div class="row">
            <div class="col">
                <h1 class="mt-4">Update Ruangan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Ruangan</li>
                    <li class="breadcrumb-item active">Update Ruangan</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-building mr-2" aria-hidden="true"></i> Update Ruangan
                    </div>
                    <div class="card-body">
                        <?php $dataRoom = base64_encode($data_room['kode_room']) ?>
                        <form action="<?= base_url(); ?>/ruangan/proses_update/<?= $dataRoom; ?>" method="post">
                            <div class="row justify-content-center">
                                <div class="col-md-7">
                                    <?= csrf_field() ?>
                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Kode Room</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm <?= ($validation->hasError('kode_room') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kode_room" value="<?= $data_room['kode_room']; ?>" readonly>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('kode_room'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Nama Ruangan</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control <?= ($validation->hasError('nama_ruangan') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="nama_ruangan" value="<?= $data_room['nama_ruangan']; ?>" placeholder="Nama Ruangan">
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('nama_ruangan'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Cabang</label>
                                        <div class="col-md-9">
                                            <select class="form-control form-control mb-2 <?= ($validation->hasError('cabang') ? 'is-invalid' : ''); ?>" name="cabang">
                                                <option selected="selected" value=" ">Cabang</option>
                                                <?php foreach ($cabang as $data) : ?>
                                                    <option value="<?= $data['kode_cabang']; ?>" <?= ($data_room['cabang'] == $data['kode_cabang'] ? 'selected' : '') ?>><?= $data['nama_cabang']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('cabang'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Kapasitas</label>
                                        <div class="col-md-9">
                                            <select class="form-control form-control mb-2 <?= ($validation->hasError('kapasitas') ? 'is-invalid' : ''); ?>" name="kapasitas">
                                                <option selected="selected" value=" ">kapasitas</option>
                                                <option value="5 - 10 Orang" <?= ($data_room['kapasitas'] == '5 - 10 Orang' ? 'selected' : '') ?>>5 s/d 10 Orang</option>
                                                <option value="10 - 15 Orang" <?= ($data_room['kapasitas'] == '10 - 15 Orang' ? 'selected' : '') ?>>10 s/d 15 Orang</option>
                                                <option value="15 - 20 Orang" <?= ($data_room['kapasitas'] == '15 - 20 Orang' ? 'selected' : '') ?>>15 s/d 20 Orang</option>
                                                <option value="20 - 25 Orang" <?= ($data_room['kapasitas'] == '20 - 25 Orang' ? 'selected' : '') ?>>20 s/d 25 Orang</option>
                                                <option value="25 - 30 Orang" <?= ($data_room['kapasitas'] == '25 - 30 Orang' ? 'selected' : '') ?>> 25 s/d 30 Orang</option>
                                            </select>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('kapasitas'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <h6>Fasilitas</h6>
                                    <?php
                                    $data_fasilitas = json_decode($data_room['fasilitas']);
                                    ?>

                                    <div class="mb-1 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="Wifi" <?php foreach ($data_fasilitas as $fasilitas) : ?> <?= ($fasilitas == 'Wifi' ? 'checked' : '') ?> <?php endforeach; ?>>
                                        <label class="form-check-label" for="exampleCheck1">Wifi</label>
                                    </div>
                                    <div class="mb-1 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="In Focus" <?php foreach ($data_fasilitas as $fasilitas) : ?> <?= ($fasilitas == 'In Focus' ? 'checked' : '') ?> <?php endforeach; ?>>
                                        <label class="form-check-label" for="exampleCheck1">In Focus</label>
                                    </div>
                                    <div class="mb-1 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="White Board" <?php foreach ($data_fasilitas as $fasilitas) : ?> <?= ($fasilitas == 'White Board' ? 'checked' : '') ?> <?php endforeach; ?>>
                                        <label class="form-check-label" for="exampleCheck1">White Board </label>
                                    </div>
                                    <div class="mb-1 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="Monitor LED" <?php foreach ($data_fasilitas as $fasilitas) : ?> <?= ($fasilitas == 'Monitor LED' ? 'checked' : '') ?> <?php endforeach; ?>>
                                        <label class="form-check-label" for="exampleCheck1">Monitor LED </label>
                                    </div>
                                    <div class="mb-1 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="Sound System" <?php foreach ($data_fasilitas as $fasilitas) : ?> <?= ($fasilitas == 'Sound System' ? 'checked' : '') ?> <?php endforeach; ?>>
                                        <label class="form-check-label" for="exampleCheck1">Sound System</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="<?= base_url(); ?>/views/ruang-meeting" class="btn btn-danger" data-bs-dismiss="modal">Cancel</a>
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