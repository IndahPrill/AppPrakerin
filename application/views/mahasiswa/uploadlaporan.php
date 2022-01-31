    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <?= $this->session->flashdata('message');  ?>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="<?= base_url('mahasiswa/uploadLaporan'); ?>" method="post">
                    <div class="form-group">
                        <label for="namaMHS">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="namaMHS" name="nama_mhs">
                    </div>
                    <div class="form-group">
                        <label for="NPM">NPM</label>
                        <input type="text" class="form-control" id="NPM" name="npm">
                    </div>
                    <div class="form-group">
                        <label for="jdlLaporan">Judul Laporan</label>
                        <input type="text" class="form-control" id="jdlLaporan" name="jdllaporan">
                    </div>
                    <div class="form-group">
                        <label for="formFile">Upload Laporan PKL</label>
                        <input type="file" class="form-control-file" id="formFile" name="">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->