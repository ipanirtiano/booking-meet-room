<?= $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Cabang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Master</li>
            <li class="breadcrumb-item active">Cabang</li>
        </ol>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-sm btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Cabang</button>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        DataTable Cabang
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
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Cabang</th>
                                        <th>Nama Cabang</th>
                                        <th>Kota Cabang</th>
                                        <th>Alamat Cabang</th>
                                        <th>Telpon Cabang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach ($cabang as $data) : ?>
                                        <?php $i++ ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $data['kode_cabang']; ?></td>
                                            <td><?= $data['nama_cabang']; ?></td>
                                            <td><?= $data['kota_cabang']; ?></td>
                                            <td><?= $data['alamat_cabang']; ?></td>
                                            <td><?= $data['telpon_cabang']; ?></td>
                                            <td>
                                                <?php $kodeCabang = base64_encode($data['kode_cabang']) ?>
                                                <a href="<?= base_url(); ?>/admin/update-cabang/<?= $kodeCabang; ?>" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="<?= base_url(); ?>/admin/delete-cabang/<?= $kodeCabang; ?>" class=" btn btn-sm btn-danger tombol-hapus">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-server mr-2" aria-hidden="true"></i>Tambah Cabang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url(); ?>/cabang/proses_input" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Kode Cabang</label>
                                <input type="text" class="form-control col-5 <?= ($validation->hasError('kode_cabang') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" readonly value="<?= $kode_cabang; ?>" name="kode_cabang">
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('kode_cabang'); ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Cabang</label>
                                <input type="text" class="form-control col-5 <?= ($validation->hasError('nama_cabang') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" name="nama_cabang" onkeyup="this.value = this.value.toUpperCase();" placeholder="Nama Cabang" value="<?= old('nama_cabang'); ?>">
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('nama_cabang'); ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Kota Cabang</label>
                                <input type="text" class="form-control col-5 <?= ($validation->hasError('kota_cabang') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" name="kota_cabang" onkeyup="this.value = this.value.toUpperCase();" placeholder="Kota Cabang" value="<?= old('kota_cabang'); ?>">
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('kota_cabang'); ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Telpon Cabang</label>
                                <input type="number" class="form-control col-5 <?= ($validation->hasError('telpon_cabang') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" name="telpon_cabang" placeholder="Telpon Cabang" value="<?= old('telpon_cabang'); ?>">
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('telpon_cabang'); ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Alamat Cabang</label>
                                <textarea class="form-control <?= ($validation->hasError('alamat_cabang') ? 'is-invalid' : ''); ?>" placeholder="Alamat" id="floatingTextarea2" style="height: 100px" name="alamat_cabang"><?= old('alamat_cabang'); ?></textarea>
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('alamat_cabang'); ?>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Input</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $this->endSection() ?>