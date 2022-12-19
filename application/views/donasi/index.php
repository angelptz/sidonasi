<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('pesan'); ?>
            <a href="" class="btn btn-dark mb-3" data-toggle="modal" data-target="#donasiBaruModal"><i class="fas fa-filealt"></i> Laporan Baru</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Projek</th>
                        <th scope="col">Tempat</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Jumlah Dana</th>
                        <th scope="col">Foto Projek</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    foreach ($donasi as $d) { ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $d['nm_projek']; ?></td>
                            <td><?= $d['tempat']; ?></td>
                            
                            <td><?= $d['waktu']; ?></td>
                            
                            <td><?= $d['jml_dana']; ?></td>
                            
                            <td>
                                <picture>
                                    <source srcset="" type="image/svg+xml">
                                    <img src="<?= base_url('assets/img/upload/') . $d['image']; ?>" class="img-fluid img-thumbnail">
                                </picture>
                            </td>
                            <td>
                                <a href="<?= base_url('donasi/ubahDonasi/') . $d['id']; ?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                                <a href="<?= base_url('donasi/hapusDonasi/') . $d['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . '' . $d['nm_projek']; ?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Modal Tambah buku baru-->
<div class="modal fade" id="donasiBaruModal" tabindex="-1" role="dialog" aria-labelledby="donasiBaruModalLabel" ariahidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="donasiBaruModalLabel">Tambah Laporan</h5>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('donasi'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control formcontrol-user" id="nm_projek" name="nm_projek" placeholder="Masukkan Nama Projek">
                    </div>
                    <div class="form-group">
                        <select name="id_kategori" class="formcontrol form-control-user">
                            <option value="">Kategori Projek</option>
                            <?php foreach ($kategori as $k) { ?>
                                <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="tempat" name="tempat" placeholder="Masukkan Nama Tempat">
                    </div>
                    
                    <div class="form-group">
                        <select name="waktu" class="form-control form-control-user">
                            <option value="">Pilih Tahun</option>
                            <?php
                            for ($i = date('Y'); $i > 1000; $i--) { ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="jml_dana" name="jml_dana" placeholder="Masukkan Nominal Dana Donasi">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Foto Projek</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Tutup</button>
                    <button type="submit" class="btn btn-warning"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Mneu -->