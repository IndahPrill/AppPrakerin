    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <?= $this->session->flashdata('message');  ?>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="<?= base_url('mahasiswa/upFileLpr'); ?>" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Mahasiswa</label>
                            <input type="text" class="form-control" name="npm_mhs">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Dosen</label>
                            <input type="text" class="form-control" name="nik_dsn">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-9">
                            <label>Topik Bimbingan</label>
                            <textarea type="text" class="form-control" name="topik"></textarea>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Upload Laporan PKL</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="laporanPKL">
                                <label class="custom-file-label">Pilih File</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-file-upload"></i>&nbsp;&nbsp;Upload</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->