    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <?= $this->session->flashdata('message');  ?>

        <?php
        if ($dt_bim) {
            $val_npm_mhs  = $dt_bim['npm_mhs'];
            $val_nama_mhs = $dt_bim['nama_mhs'];
            $val_nik_dsn  = $dt_bim['nik_dsn'];
            $val_nama_dsn = $dt_bim['nama_dsn'];
            $readonly = "readonly";
        } else {
            $val_npm_mhs  = "";
            $val_nama_mhs = "";
            $val_nik_dsn  = "";
            $val_nama_dsn = "";
            $readonly = "";
        }
        ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3"></div>
            <div class="card-body">
                <?= form_open_multipart('mahasiswa/uploadFileMhs') ?>
                <form action="<?= base_url('mahasiswa/uploadFileMhs'); ?>" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>NPM</label>
                            <input type="text" class="form-control" name="npm_mhs" value="<?= $val_npm_mhs ?>" <?= $readonly ?> />
                        </div>
                        <div class="form-group col-md-10">
                            <label>Nama Mahasiswa</label>
                            <input type="text" class="form-control" name="nama_mhs" value="<?= $val_nama_mhs ?>" <?= $readonly ?> />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>NIK</label>
                            <input type="text" class="form-control" name="nik_dsn" value="<?= $val_nik_dsn ?>" <?= $readonly ?> />
                        </div>
                        <div class="form-group col-md-10">
                            <label>Nama Dosen Pembimbing</label>
                            <input type="text" class="form-control" name="nama_dsn" value="<?= $val_nama_dsn ?>" <?= $readonly ?> />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Topik Bimbingan</label>
                            <textarea type="text" class="form-control" name="topik"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Upload Laporan PKL</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="laporanPKL" accept=".pdf">
                            <label class="custom-file-label">Pilih File</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-file-upload"></i>&nbsp;&nbsp;Upload</button>
                </form>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->