    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            
        <div class="card shadow mb-4">
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <div class="table table-responsive">
                    <table class="table table-bordered" style="font-size: 90%;" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Total Bimbingan</th>
                                <th>Rincian Laporan</th>
                                <th>Status Dosen</th>
                                <th>Catatan Dosen</th>
                                <th>Status Koordinator</th>
                                <th>Catatan Koordinator</th>
                                <th>list Laporan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($subSidang as $ss) {?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $ss['npm_mhs']; ?></td>
                                    <td><?= $ss['nama_mhs']; ?></td>
                                    <td><?= $ss['prodi_mhs']; ?></td>
                                    <td><?= $ss['kelas_mhs']; ?></td>
                                    <td><?= $ss['tot_bim']; ?></td>
                                    <td>
                                        <?php 
                                        if ($ss['status_bimbingan'] == 0) { ?>
                                            <span class="badge badge-info">Proses Bimbingan</span>
                                        <?php } else if ($ss['status_bimbingan'] == 1) { ?>
                                            <span class="badge badge-success">Siap Sidang</span>
                                        <?php } else if ($ss['status_bimbingan'] == 2) { ?>
                                            <span class="badge badge-danger">Belum Siap Sidang</span>
                                        <?php } else if ($ss['status_bimbingan'] == 3) { ?>
                                            <span class="badge badge-warning">Penangguhan</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= $ss['catatan']; ?></td>
                                    <td>
                                        <?php 
                                        if ($ss['status_koor'] == 0) { ?>
                                            <span class="badge badge-info">Proses Bimbingan</span>
                                        <?php } else if ($ss['status_koor'] == 1) { ?>
                                            <span class="badge badge-success">Siap Sidang</span>
                                        <?php } else if ($ss['status_koor'] == 2) { ?>
                                            <span class="badge badge-danger">Belum Siap Sidang</span>
                                        <?php } else if ($ss['status_koor'] == 3) { ?>
                                            <span class="badge badge-warning">Penangguhan</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= $ss['catatan_koor']; ?></td>
                                    <td>
                                        <?php foreach ($fileLprn as $fl) {
                                            if ($ss['npm_mhs'] == $fl['npm_mhs']) { ?>
                                                <button type="button" class="btn btn-sm btn-success" style="font-size: 65%;" data-toggle="modal" data-target="#listLaporan<?= $fl['npm_mhs'] ?>"><i class="fas fa-edit"></i>&nbsp;&nbsp;View</button>
                                            <?php }
                                        } ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $role_id = $this->session->userdata('role_id');
                                        if ($role_id == "2") { ?>
                                            <button type="button" class="btn btn-sm btn-warning" style="font-size: 65%;" data-toggle="modal" data-target="#actionDSN<?= $ss['id_bim'] ?>"><i class="fas fa-edit"></i>&nbsp;&nbsp;Opsi</button>
                                        <?php } else if ($role_id == "4") { ?>
                                            <button type="button" class="btn btn-sm btn-warning" style="font-size: 65%;" data-toggle="modal" data-target="#actionKOOR<?= $ss['id_bim'] ?>"><i class="fas fa-edit"></i>&nbsp;&nbsp;Opsi</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php $no++; }
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


<!-- Modal Dosen -->
<?php foreach ($subSidang as $ss) {?>
    <div class="modal fade" id="actionDSN<?= $ss['id_bim'] ?>" tabindex="-1" role="dialog" aria-labelledby="actionDSNLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actionDSNLabel">Apakah anda yakin mahasiswa ini telah siap untuk sidang ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dosen/approveDsn'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Status Dosen</label>
                            <select class="form-control" name="status_bimbingan">
                                <option value="0" <?= ($ss['status_bimbingan'] == 0) ? "selected" : ""; ?>>Bimbingan</option>
                                <option value="1" <?= ($ss['status_bimbingan'] == 1) ? "selected" : ""; ?>>Sidang</option>
                                <option value="2" <?= ($ss['status_bimbingan'] == 2) ? "selected" : ""; ?>>Belum Siap</option>
                                <option value="3" <?= ($ss['status_bimbingan'] == 3) ? "selected" : ""; ?>>Penangguhan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea class="form-control" name="catatan"><?= $ss['catatan'] ?></textarea>
                            <input type="hidden" name="id_dim" value="<?= $ss['id_bim'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tidak</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal koordinator -->
<?php foreach ($subSidang as $ss) {?>
    <div class="modal fade" id="actionKOOR<?= $ss['id_bim'] ?>" tabindex="-1" role="dialog" aria-labelledby="actionKOORLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actionKOORLabel">Apakah anda yakin mahasiswa ini telah siap untuk sidang ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dosen/approveKoor'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Status Koor</label>
                            <select class="form-control" name="status_koor">
                                <option value="0" <?= ($ss['status_koor'] == 0) ? "selected" : ""; ?>>Bimbingan</option>
                                <option value="1" <?= ($ss['status_koor'] == 1) ? "selected" : ""; ?>>Sidang</option>
                                <option value="2" <?= ($ss['status_koor'] == 2) ? "selected" : ""; ?>>Belum Siap</option>
                                <option value="3" <?= ($ss['status_koor'] == 3) ? "selected" : ""; ?>>Penangguhan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea class="form-control" name="catatan_koor"><?= $ss['catatan_koor'] ?></textarea>
                            <input type="hidden" name="id_dim" value="<?= $ss['id_bim'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tidak</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal List Laporan -->
<?php foreach ($fileLprn as $fl) {?>
    <div class="modal fade" id="listLaporan<?= $fl['npm_mhs'] ?>" tabindex="-1" role="dialog" aria-labelledby="listLaporanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="listLaporanLabel">Apakah anda yakin mahasiswa ini telah siap untuk sidang ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Bimbingan Ke</th>
                                    <th>File Mahasiswa</th>
                                    <th>File Revisi</th>
                                    <th>Nilai</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($fileLprn as $ff) {?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $ff['npm_mhs']; ?></td>
                                        <td><?= $ff['bimbingan_ke']; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" style="font-size: 65%;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-gear"></i>&nbsp;Opsi
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('mahasiswa/downloadLaporan/') . $ff['file_mhs']; ?>"><i class="fas fa-file-pdf"></i>&nbsp;Download</a>
                                                    <a class="dropdown-item" href="<?= base_url('./assets/file/laporan/bimbingan/') . $ff['file_mhs']; ?>" target="_blank"><i class="fas fa-search"></i>&nbsp;Review</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                        <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" style="font-size: 65%;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-gear"></i>&nbsp;Opsi
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('mahasiswa/downloadLaporanRevisi/') . $ff['file_revisi']; ?>"><i class="fas fa-file-pdf"></i>&nbsp;Download</a>
                                                    <a class="dropdown-item" href="<?= base_url('./assets/file/laporan/revisi/') . $ff['file_revisi']; ?>" target="_blank"><i class="fas fa-search"></i>&nbsp;Review</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $ff['nilai_mhs']; ?></td>
                                        <td><?= $ff['catatan']; ?></td>
                                    </tr>
                                    <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>