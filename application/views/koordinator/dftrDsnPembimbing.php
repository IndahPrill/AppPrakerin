    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tmbhDsnPembimbing"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped table-hover datatabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama Dosen</th>
                                <th>NPM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Status Bimbingan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($dsnPembimbing as $dp) { ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $dp['nik_dsn']; ?></td>
                                    <td><?= $dp['nama_dsn']; ?></td>
                                    <td><?= $dp['npm_mhs']; ?></td>
                                    <td><?= $dp['nama_mhs']; ?></td>
                                    <td>
                                        <?php if ($dp['status_bimbingan'] == '1') { ?>
                                            <span class="badge badge-info">Siap Sidang</span>
                                        <?php } else if ($dp['status_bimbingan'] == '2') { ?>
                                            <span class="badge badge-info">Belum Siap Sidang</span>
                                        <?php } else { ?>
                                            <span class="badge badge-info">Proses Bimbingan</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editDsnPembimbing<?= $dp['id_bim'] ?>"><i class="far fa-edit"></i>&nbsp;Edit</button>
                                        <a href="<?= base_url('koordinator/editDsnPembimbing/') . $dp['id_bim']; ?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i>&nbsp;Delete</a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Modal Add -->
    <div class="modal fade" id="tmbhDsnPembimbing" tabindex="-1" role="dialog" aria-labelledby="tmbhDsnPembimbingLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tmbhDsnPembimbingLabel">Tambah Data Bimbingan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control" name="nik_dsn">
                        </div>
                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <input type="text" class="form-control" name="nama_dsn">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>NPM</label>
                                <input type="text" class="form-control" name="npm_mhs">
                            </div>
                            <div class="form-group col-md-9">
                                <label>Nama Mahasiswa</label>
                                <input type="text" class="form-control" name="nama_mhs">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <?php foreach ($dsnPembimbing as $dp) { ?>
        <div class="modal fade" id="editDsnPembimbing<?= $dp['id_bim'] ?>" tabindex="-1" role="dialog" aria-labelledby="editDsnPembimbingLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDsnPembimbingLabel">Ubah Data Bimbingan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('koordinator/editDsnPembimbing'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" class="form-control" name="nik_dsn" value="<?= $dp['nik_dsn'] ?>">
                                <input type="hidden" name="id_bim" value="<?= $dp['id_bim'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Dosen</label>
                                <input type="text" class="form-control" name="nama_dsn" value="<?= $dp['nama_dsn'] ?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>NPM</label>
                                    <input type="text" class="form-control" name="npm_mhs" value="<?= $dp['npm_mhs'] ?>">
                                </div>
                                <div class="form-group col-md-9">
                                    <label>Nama Mahasiswa</label>
                                    <input type="text" class="form-control" name="nama_mhs" value="<?= $dp['nama_mhs'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>