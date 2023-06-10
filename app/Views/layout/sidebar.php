<div id="layoutSidenav">
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <!-- jika yang login adalah admin -->
                    <?php if (session('level') == 'admin') : ?>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="<?= base_url('/views'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fas fa-tasks icon-label" aria-hidden="true"></i></div>
                            Master
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= base_url(); ?>/admin/departemen">
                                    <div class="sb-nav-link-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                                    Master Departemen
                                </a>
                                <a class="nav-link" href="<?= base_url(); ?>/admin/users">
                                    <div class="sb-nav-link-icon"><i class="fa fa-user mr-1" aria-hidden="true"></i></div>
                                    Master Users
                                </a>
                                <a class="nav-link" href="<?= base_url(); ?>/admin/cabang">
                                    <div class="sb-nav-link-icon"><i class="fa fa-server mr-1" aria-hidden="true"></i></div>
                                    Master Cabang
                                </a>
                                <a class="nav-link" href="<?= base_url(); ?>/views/ruang-meeting">
                                    <div class="sb-nav-link-icon"><i class="fa fa-building mr-1" aria-hidden="true"></i></div>
                                    Master Ruangan
                                </a>
                            </nav>
                        </div>

                        <?php $tanggal = date('d-m-Y'); ?>
                        <?php $date_encode = base64_encode($tanggal); ?>
                        <a class="nav-link" href="<?= base_url(); ?>/views/list-booking/<?= $date_encode; ?>">
                            <div class="sb-nav-link-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                            Pesan Ruangan
                        </a>

                        <?php $kode_guest = base64_encode(session('kode_guest')) ?>
                        <a class="nav-link" href="<?= base_url(); ?>/views/my-booking/<?= $kode_guest; ?>">
                            <div class="sb-nav-link-icon"><i class="fa fa-clipboard mr-1" aria-hidden="true"></i></div>
                            My Booking
                        </a>

                        <a class="nav-link" href="<?= base_url(); ?>/admin/resepsionis">
                            <div class="sb-nav-link-icon"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                            Resepsionis
                        </a>

                        <a class="nav-link" href="<?= base_url(); ?>/admin/report">
                            <div class="sb-nav-link-icon"><i class="fa fa-print" aria-hidden="true"></i></div>
                            Report
                        </a>
                    <?php endif; ?>
                    <!-- akhir sidebar admin -->

                    <!-- jika yang login adalah guest -->
                    <?php if (session('level') == 'guest') : ?>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="<?= base_url('/views'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <?php $tanggal = date('d-m-Y'); ?>
                        <?php $date_encode = base64_encode($tanggal); ?>
                        <a class="nav-link" href="<?= base_url(); ?>/views/list-booking/<?= $date_encode; ?>">
                            <div class="sb-nav-link-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                            Pesan Ruangan
                        </a>

                        <?php $kode_guest = base64_encode(session('kode_guest')) ?>
                        <a class="nav-link" href="<?= base_url(); ?>/views/my-booking/<?= $kode_guest; ?>">
                            <div class="sb-nav-link-icon"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                            My Booking
                        </a>
                    <?php endif; ?>
                    <!-- akhir sidebar guest -->

                    <a class="nav-link tombol-logout" href="<?= base_url('auth/logout'); ?>">
                        <div class="sb-nav-link-icon"><i class="fa fa-power-off icon-label" aria-hidden="true"></i></div>
                        Logout
                    </a>


                </div>
            </div>
        </nav>
    </div>

    <?= $this->renderSection('content'); ?>

</div>