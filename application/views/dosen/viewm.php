    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="card shadow mb-4">
            <?php
            if ($user['role_id'] == 1) { ?>
                <div class="card-header py-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newDataMhs"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
                </div>
            <?php } ?>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <?php if ($user['role_id'] == 1) { ?>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                <?php } else { ?>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Kelas</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamt Perusahaan</th>
                                    <th>Nama Pembimbing</th>
                                    <th>No Telepon</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_mhs as $dm) { ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <?php if ($user['role_id'] == 1) { ?>
                                        <td><?= $dm['npm_mhs']; ?></td>
                                        <td><?= $dm['nama_mhs']; ?></td>
                                        <td><?= $dm['prodi_mhs']; ?></td>
                                        <td><?= $dm['kelas_mhs']; ?></td>
                                        <td>
                                            <?php
                                            if ($dm['status_mhs'] == 1) {
                                                echo '<span class="badge badge-info">Aktif</span>';
                                            } else {
                                                echo '<span class="badge badge-danger">Non Aktif</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editDataMhs<?= $dm['id_mhs'] ?>"><i class="far fa-edit"></i>&nbsp;Edit</button>
                                            <a href="<?= base_url('dosen/deleteMhs/') . $dm['id_mhs']; ?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i>&nbsp;Delete</a>
                                        </td>
                                    <?php } else { ?>
                                        <td><?= $dm['npm_mhs']; ?></td>
                                        <td><?= $dm['nama_mhs']; ?></td>
                                        <td><?= $dm['prodi_mhs']; ?></td>
                                        <td><?= $dm['kelas_mhs']; ?></td>
                                        <td><?= $dm['nama_perusahaan']; ?></td>
                                        <td><?= $dm['alamat_lks']; ?></td>
                                        <td><?= $dm['dsn_eksternal']; ?></td>
                                        <td><?= $dm['no_tlp_dsn_eksternal']; ?></td>
                                    <?php } ?>
                                </tr>
                            <?php
                                $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Modal add -->
    <div class="modal fade" id="newDataMhs" tabindex="-1" role="dialog" aria-labelledby="newDataMhsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newDataMhsLabel">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dosen/addMhs'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="npm_mhs" placeholder="NPM">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama_mhs" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="prodi_mhs" placeholder="Program Studi">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="kelas_mhs" placeholder="Kelas">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="status_mhs" checked>
                                <label class="form-check-label" for="status_mhs ">
                                    Active ?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal edit -->
    <?php
    foreach ($data_mhs as $dm) {
        if ($user['role_id'] == 1) {
    ?>
        <div class="modal fade" id="editDataMhs<?= $dm['id_mhs'] ?>" tabindex="-1" role="dialog" aria-labelledby="editDataMhsLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataMhsLabel">Edit Data Mahasiswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('dosen/editMhs'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="npm_mhs" value="<?= $dm['npm_mhs'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama_mhs" value="<?= $dm['nama_mhs'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="prodi_mhs" value="<?= $dm['prodi_mhs'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kelas_mhs" value="<?= $dm['kelas_mhs'] ?>">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?= $dm['status_mhs'] ?>" name="status_mhs" checked>
                                    <label class="form-check-label" for="status_mhs ">
                                        Active ?
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="id_mhs" value="<?= $dm['id_mhs'] ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } 
}?>