    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php
                if ($user['role_id'] == 1) { ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newDataDsn"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
                <?php } ?>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Dosen Pembimbing</th>
                                <th>Program Studi</th>
                                <?php if ($user['role_id'] == 1) { ?>
                                    <th>Status</th>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_dsn as $dd) { ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $dd['nik_dsn']; ?></td>
                                    <td><?= $dd['nama_dsn']; ?></td>
                                    <td><?= $dd['prodi_dsn']; ?></td>
                                    <?php if ($user['role_id'] == 1) { ?>
                                        <td>
                                            <?php
                                            if ($dd['status_dsn'] == 1) {
                                                echo '<span class="badge badge-info">Aktif</span>';
                                            } else {
                                                echo '<span class="badge badge-danger">Non Aktif</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editDataDsn<?= $dd['id_dsn'] ?>"><i class="far fa-edit"></i>&nbsp;Edit</button>
                                            <a href="<?= base_url('mahasiswa/deleteDsn/') . $dd['id_dsn']; ?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i>&nbsp;Delete</a>
                                        </td>
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
    <div class="modal fade" id="newDataDsn" tabindex="-1" role="dialog" aria-labelledby="newDataDsnLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newDataDsnLabel">Tambah Data Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('mahasiswa/addDsn'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nik_dsn" placeholder="NIK">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama_dsn" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="prodi_dsn" placeholder="Program Studi">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="status_dsn" checked>
                                <label class="form-check-label" for="status_dsn ">
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
    foreach ($data_dsn as $dd) {
    ?>
        <div class="modal fade" id="editDataDsn<?= $dd['id_dsn'] ?>" tabindex="-1" role="dialog" aria-labelledby="editDataDsnLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataDsnLabel">Edit Data Dosen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('mahasiswa/editDsn'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nik_dsn" value="<?= $dd['nik_dsn'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama_dsn" value="<?= $dd['nama_dsn'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="prodi_dsn" value="<?= $dd['prodi_dsn'] ?>">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?= $dd['status_dsn'] ?>" name="status_dsn" checked>
                                    <label class="form-check-label" for="status_dsn ">
                                        Active ?
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="id_dsn" value="<?= $dd['id_dsn'] ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>