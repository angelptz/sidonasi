<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- row ux-->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-black textuppercase mb-1">Jumlah Admin</div>
                            <div class="h1 mb-0 font-weight-bold text-black"><?= $this->ModelUser->getUserWhere(['role_id' => 1])->num_rows(); ?></div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('user/anggota'); ?>"><i class="fas fa-users fa-3x text-warning"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 bgwarning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-black textuppercase mb-1">Jumlah Donasi</div>
                            <div class="h1 mb-0 font-weight-bold text-black">
                                <?php
                                $where = ['jml_dana != 0'];
                                $totaljml_dana = $this->ModelDonasi->total(
                                    'jml_dana',
                                    $where
                                );
                                echo $totaljml_dana;
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('donasi'); ?>"><i class="fas fabook fa-3x text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- end row ux-->
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- row table-->
    <div class="row">
        <div class="table-responsive table-bordered col-sm-10 ml-auto mr-auto mt-2">
            <div class="page-header">
                <span class="fas fa-users text-warning mt-2 "> Data Admin</span>
            </div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Admin</th>
                        <th>Email</th>
                        <th>Role ID</th>
                        <th>Aktif</th>
                        <th>Admin Sejak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($anggota as $a) { ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $a['nama']; ?></td>
                            <td><?= $a['email']; ?></td>
                            <td><?= $a['role_id']; ?></td>
                            <td><?= $a['is_active']; ?></td>
                            <td><?= date('Y', $a['tanggal_input']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>    
        </div>
        <div class="table-responsive table-bordered col-sm-10 ml-auto mr-auto mt-2">
            <div class="page-header">
                <span class="fas fa-book text-warning mt-2"> Data Donasi</span>
            </div>
            <div class="table-responsive">
                <table class="table mt-3" id="table-datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Projek</th>
                            <th>Tempat</th>
                            <th>Waktu</th>
                            <th>Jumlah Dana</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($donasi as $d) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $d['nm_projek']; ?></td>
                                <td><?= $d['tempat']; ?></td>

                                <td><?= $d['waktu']; ?></td>

                                <td><?= $d['jml_dana']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end of row table-->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->