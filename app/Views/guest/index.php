<?= $this->extend('layout/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Master</li>
            <li class="breadcrumb-item active">Users </li>
        </ol>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-sm btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Users</button>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        DataTable Users
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
                                        <th>Kode Users</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Departemen</th>
                                        <th>Level</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // koneksi database manual
                                    $conn = mysqli_connect('localhost', 'root', '', 'booking_meet_room');
                                    ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($guest as $data) : ?>
                                        <?php
                                        // create number
                                        $i++;
                                        // get kode guest dari model guest
                                        $kode_guest = $data['kode_guest'];
                                        // query manual ke table users by kode guest
                                        $query = mysqli_query($conn, "SELECT * FROM users WHERE id_users = '$kode_guest'");
                                        // konversi ke array
                                        $data_query = mysqli_fetch_assoc($query);
                                        // get level
                                        $level = $data_query['level'];
                                        ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $kode_guest; ?></td>
                                            <td><?= $data['nama_lengkap']; ?></td>
                                            <td><?= $data['email']; ?></td>
                                            <td><?= $data['phone']; ?></td>
                                            <td><?= $data['departemen']; ?></td>
                                            <td><?= $level; ?></td>
                                            <td>
                                                <?php $kodeGuest = base64_encode($data['kode_guest']) ?>
                                                <a href="<?= base_url(); ?>/admin/update-user/<?= $kodeGuest; ?>" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="<?= base_url(); ?>/admin/delete-user/<?= $kodeGuest; ?>" class=" btn btn-sm btn-danger tombol-hapus">Hapus</a>
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
            <div class="modal-dialog modal-dialog-centered 	modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-user mr-2" aria-hidden="true"></i>Tambah Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url(); ?>/guest/proses_input" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Kode User</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('kode_user') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kode_user" value="<?= $kode_users ?>" readonly>
                                    <div class="invalid-feedback" style="font-size: small">
                                        <?= $validation->getError('kode_user'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Nama</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control <?= ($validation->hasError('nama') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="nama" value="<?= old('nama'); ?>" placeholder="Nama Lengkap">
                                    <div class="invalid-feedback" style="font-size: small">
                                        <?= $validation->getError('nama'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control <?= ($validation->hasError('email') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="email" value="<?= old('email'); ?>" placeholder="Email">
                                    <div class="invalid-feedback" style="font-size: small">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Phone</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control form-control <?= ($validation->hasError('phone') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="phone" value="<?= old('phone'); ?>" placeholder="Phone">
                                    <div class="invalid-feedback" style="font-size: small">
                                        <?= $validation->getError('phone'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Departemen</label>
                                <div class="col-md-9">
                                    <select class="form-control form-control mb-2 <?= ($validation->hasError('departemen') ? 'is-invalid' : ''); ?>" name="departemen">
                                        <option selected="selected" value=" ">Departemen</option>
                                        <?php foreach ($departemen as $data) : ?>
                                            <option value="<?= $data['nama_departemen']; ?>" <?= (old('departemen') == $data['nama_departemen'] ? 'selected' : ''); ?>><?= $data['nama_departemen']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="font-size: small">
                                        <?= $validation->getError('departemen'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Level</label>
                                <div class="col-sm-9">
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input <?= ($validation->hasError('level') ? 'is-invalid' : ''); ?>" type="radio" name="level" id="inlineRadio1" value="guest" <?= (old('level') == 'guest' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="inlineRadio1" style="font-size:14px;">Guest</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input <?= ($validation->hasError('level') ? 'is-invalid' : ''); ?>" type="radio" name="level" id="inlineRadio2" value="admin" <?= (old('level') == 'admin' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="inlineRadio2" style="font-size:14px;">Admin</label>
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