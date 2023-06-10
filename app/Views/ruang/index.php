<?= $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Ruang Meeting</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Master</li>
            <li class="breadcrumb-item active">Ruang meeting </li>
        </ol>
        <div class="row">
            <div class="col">
                <?php if (session('level') == 'admin') : ?>
                    <button type="button" class="btn btn-sm btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Ruangan</button>
                <?php endif; ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        DataTable Ruang Meeting
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
                                        <th>Kode Room</th>
                                        <th>Nama Ruangan</th>
                                        <th>Cabang</th>
                                        <th>Kapasitas</th>
                                        <th>Fasilitas</th>
                                        <?php if (session('level') == 'admin') : ?>
                                            <th>Action</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // koneksi database manual
                                    $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
                                    ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($ruangan as $data) : ?>
                                        <?php
                                        // create number
                                        $i++;
                                        // get kode room dari model ruangan
                                        $kode_room = $data['kode_room'];

                                        $dataFasilitas = $data['fasilitas'];
                                        $data_fasilitas = json_decode($dataFasilitas);

                                        $fasilitas = implode(", ", $data_fasilitas);

                                        // get kode cabang
                                        $kode_cabang = $data['cabang'];
                                        // query manual
                                        $query = mysqli_query($conn, "SELECT * FROM cabang WHERE kode_cabang = '$kode_cabang'");
                                        // get data booking as array
                                        $nama_cabang = mysqli_fetch_assoc($query);

                                        ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td class="text-nowrap"><?= $kode_room; ?></td>
                                            <td class="text-nowrap"><?= $data['nama_ruangan']; ?></td>
                                            <td class="text-nowrap"><?= $nama_cabang['nama_cabang'] ?></td>
                                            <td class="text-nowrap"><?= $data['kapasitas']; ?></td>
                                            <td class="text-nowrap"><?= $fasilitas; ?></td>
                                            <?php if (session('level') == 'admin') : ?>
                                                <td class="text-nowrap">
                                                    <?php $kodeRoom = base64_encode($data['kode_room']) ?>
                                                    <a href="<?= base_url(); ?>/admin/update-room/<?= $kodeRoom; ?>" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="<?= base_url(); ?>/admin/delete-room/<?= $kodeRoom; ?>" class=" btn btn-sm btn-danger tombol-hapus">Hapus</a>
                                                </td>
                                            <?php endif; ?>
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
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-building mr-2" aria-hidden="true"></i>Tambah Ruangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7">
                                <form action="<?= base_url(); ?>/ruangan/proses_input" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Kode Room</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm <?= ($validation->hasError('kode_room') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kode_room" value="<?= $kode_ruangan; ?>" readonly>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('kode_room'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Nama Ruangan</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control <?= ($validation->hasError('nama_ruangan') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="nama_ruangan" value="<?= old('nama_ruangan'); ?>" placeholder="Nama Ruangan">
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
                                                    <option value="<?= $data['kode_cabang']; ?>" <?= (old('cabang') == $data['kode_cabang'] ? 'selected' : '') ?>><?= $data['nama_cabang']; ?></option>
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
                                                <option value="5 - 10 Orang" <?= (old('kapasitas') == '5 - 10 Orang' ? 'selected' : '') ?>>5 s/d 10 Orang</option>
                                                <option value="10 - 15 Orang" <?= (old('kapasitas') == '10 - 15 Orang' ? 'selected' : '') ?>>10 s/d 15 Orang</option>
                                                <option value="15 - 20 Orang" <?= (old('kapasitas') == '15 - 20 Orang' ? 'selected' : '') ?>>15 s/d 20 Orang</option>
                                                <option value="20 - 25 Orang" <?= (old('kapasitas') == '20 - 25 Orang' ? 'selected' : '') ?>>20 s/d 25 Orang</option>
                                                <option value="25 - 30 Orang" <?= (old('kapasitas') == '25 - 30 Orang' ? 'selected' : '') ?>> 25 s/d 30 Orang</option>
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
                                <div class="mb-1 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="Wifi">
                                    <label class="form-check-label" for="exampleCheck1">Wifi</label>
                                </div>
                                <div class="mb-1 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="In Focus">
                                    <label class="form-check-label" for="exampleCheck1">In Focus</label>
                                </div>
                                <div class="mb-1 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="White Board">
                                    <label class="form-check-label" for="exampleCheck1">White Board </label>
                                </div>
                                <div class="mb-1 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="Monitor LED">
                                    <label class="form-check-label" for="exampleCheck1">Monitor LED </label>
                                </div>
                                <div class="mb-1 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fasilitas[]" value="Sound System">
                                    <label class="form-check-label" for="exampleCheck1">Sound System</label>
                                </div>
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