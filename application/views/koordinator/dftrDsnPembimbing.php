    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tmbhDsnPembimbing"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
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
                                            <span class="badge badge-danger">Belum Siap Sidang</span>
                                        <?php } else { ?>
                                            <span class="badge badge-success">Proses Bimbingan</span>
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
                <form action="<?= base_url('koordinator/addDsnPembimbing'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Dosen</label>
                            <select class="form-control" name="nik_dsn">
                                <option value="">-- PILIH --</option>
                                <?php
                                foreach ($data_dsn as $dd) { ?>
                                    <option value="<?= $dd['nik_dsn'] ?>" data-content="" <?= ($dd['jmlh_dsn'] == "2") ? "disabled" : "" ?>><?= $dd['nik_dsn'] ?> - <?= $dd['nama_dsn'] ?> <?= ($dd['jmlh_dsn'] < "2") ? '' : '(FULL)' ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mahasiswa</label>
                            <select class="form-control" name="npm_mhs">
                                <option value="">-- PILIH --</option>
                                <?php
                                foreach ($data_mhs as $dm) { ?>
                                    <option value="<?= $dm['npm_mhs'] ?>" <?= ($dm['jmlh_mhs'] == "1") ? "disabled" : "" ?>><?= $dm['npm_mhs'] ?> - <?= $dm['nama_mhs'] ?> <?= ($dm['jmlh_mhs'] == "1") ? '(Sudah Ada)' : '(Belum Ada)' ?></option>
                                <?php
                                } ?>
                            </select>
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
                                <label>Dosen</label>
                                <select class="form-control" name="nik_dsn">
                                    <option value="">-- PILIH --</option>
                                    <?php
                                    foreach ($data_dsn as $dd) {
                                        if ($dd['status_dsn'] == '1') { ?>
                                            <option value="<?= $dd['nik_dsn'] ?>" <?= ($dd['nik_dsn'] == $dp['nik_dsn']) ? "selected" : "" ?>><?= $dd['nik_dsn'] ?> - <?= $dd['nama_dsn'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mahasiswa</label>
                                <select class="form-control" name="npm_mhs">
                                    <option value="">-- PILIH --</option>
                                    <?php
                                    foreach ($data_mhs as $dm) {
                                        if ($dm['status_mhs'] == '1') { ?>
                                            <option value="<?= $dm['npm_mhs'] ?>" <?= ($dm['npm_mhs'] == $dp['npm_mhs']) ? "selected" : "" ?>><?= $dm['npm_mhs'] ?> - <?= $dm['nama_mhs'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
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
    <?php } ?>