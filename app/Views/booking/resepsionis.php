<?= $this->extend('layout/template') ?>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Resepsionis</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Resepsionis</li>
        </ol>
        <div class="row">
            <div class="col-md-8">
                <?php
                $kode_cabang = '';
                if (isset($_POST['cabang'])) {
                    $kode_cabang = base64_encode($_POST['cabang']);
                }
                ?>
                <form action="<?= base_url(); ?>/booking/resepsionis_info" method="post">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Cabang</label>
                        <div class="col-md-5">
                            <select class="form-control form-control mb-2" name="cabang" required>
                                <option selected="selected" value="">Cabang</option>
                                <?php foreach ($cabang as $data) : ?>
                                    <option value="<?= $data['kode_cabang']; ?>" <?= (old('cabang') == $data['kode_cabang'] ? 'selected' : '') ?>><?= $data['nama_cabang']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-sm btn-info" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>


</div>
</div>
<?php $this->endSection() ?>