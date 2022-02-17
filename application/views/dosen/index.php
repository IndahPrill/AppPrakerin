    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Bio Data
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-fluid rounded-start" height="200px" width="200px" style="padding: 10px;">
                        </div>
                        <hr style="border-top: 1px black solid">
                        <form>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Nama</label>
                                <input type="text" readonly class="col-sm-8 form-control-plaintext" value="<?= $user['name']; ?>">
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">NPM</label>
                                <input type="text" readonly class="col-sm-8 form-control-plaintext" value="<?= $user['nik']; ?>">
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Email</label>
                                <input type="text" readonly class="col-sm-8 form-control-plaintext" value="<?= $user['email']; ?>">
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Program Studi</label>
                                <input type="text" readonly class="col-sm-8 form-control-plaintext" value="<?= $user['prodi']; ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            List Data Bimbingan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <th>NPM</th>
                                        <th>Nama</th>
                                        <th>Program Studi</th>
                                        <th>Kelas</th>
                                        <th>Total Bimbingan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($mhsBim as $mb) { ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $mb['npm_mhs']; ?></td>
                                            <td><?= $mb['nama_mhs']; ?></td>
                                            <td><?= $mb['prodi_mhs']; ?></td>
                                            <td><?= $mb['kelas_mhs']; ?></td>
                                            <td><?= $mb['tot_bim']; ?></td>
                                        </tr>
                                    <?php $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->