<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('pesan'); ?>
            <?php foreach ($donasi as $d) { ?>
                <form action="<?= base_url('donasi'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?php echo $d['id']; ?>"> 
                        <input type="text"  class="form-control form-control-user" id="nm_projek" name="nm_projek" placeholder="Masukkan Nama Projek" value="<?= $d['nm_projek']; ?>">
                    </div>
                    <div class="form-group">
                        <select name="id_kategori" class="formcontrol form-control-user">
                            <option value="">Jenis Kategori Projek</option>
                            <?php foreach ($kategori as $k) { ?>
                                <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="tempat" name="tempat" placeholder="Masukkan Nama Tempat" value="<?= $d['tempat']; ?>">
                    </div>
                    
                    <div class="form-group">
                        <select name="tahun" class="form-control form-control-user">
                            <option value="<?= $d['waktu']; ?>"><?= $d['waktu']; ?></option>
                            <?php
                            for ($i = date('Y'); $i > 1000; $i--) { ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="jml_dana" name="jml_dana" placeholder="Masukkan Nominal Jumlah Dana Donasi " value="<?= $d['jml_dana']; ?>">
                    </div>
                    <div class="custom-file">
                        <?php
                        if (isset($d['image'])) { ?>
                            <input type="hidden" name="old_pict" id="old_pict" value="<?= $d['image']; ?>">
                            
                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<? base_url('assets/img/upload/') . $d['image']; ?>"
                            </picture>
                        <?php } ?>
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Foto Projek</label>
                    </div>
                    <div class="form-group">
                        <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Batal" onclick="window.history.go(-1)"></input>
                        <input type="submit" class="form-control form-control-user btn btn-warning col-lg-3 mt-3" value="Ubah"></input>
                    </div>
                </form>
            <?php } ?>
        </div>  
    </div>
</div>