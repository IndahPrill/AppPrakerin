    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Topik Bimbingan</th>
                                <th>File Laporan</th>
                                <th>Komentar</th>
                                <th>Nilai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($lprnMhs as $lm ) {?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $lm['npm_mhs']; ?></td>
                                    <td><?= $lm['nama_mhs']; ?></td>
                                    <td><?= $lm['kelas_mhs']; ?></td>
                                    <td><?= $lm['topik']; ?></td>
                                    <td>
                                        <?php
                                        if ($lm['file_mhs']) { ?>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" style="font-size: 65%;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-gear"></i>&nbsp;Opsi
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('mahasiswa/downloadLaporan/') . $lm['file_mhs']; ?>"><i class="fas fa-file-pdf"></i>&nbsp;Download</a>
                                                    <a class="dropdown-item" href="<?= base_url('./assets/file/laporan/bimbingan/') . $lm['file_mhs']; ?>" target="_blank"><i class="fas fa-search"></i>&nbsp;Review</a>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <span class="badge badge-info">Belum ada file</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($lm['catatan'] == "") { ?>
                                            <span class="badge badge-danger">Belum ada komentar</span>
                                            <?php } else { ?>
                                                <?= $lm['catatan']; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($lm['nilai_mhs'] == 0) { ?>
                                            <span class="badge badge-danger">Belum dinilai</span>
                                        <?php } else { ?>
                                            <?= $lm['nilai_mhs']; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($lm['nilai_mhs'] == 0) { ?>
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editNilaiMHS<?= $lm['id_nilai'] ?>"><i class="far fa-edit"></i>&nbsp;Nilai</button>
                                        <?php } else { 
                                            if ($this->session->userdata('role_id') == '1') { ?>
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editNilaiMHS<?= $lm['id_nilai'] ?>"><i class="far fa-edit"></i>&nbsp;Nilai</button>
                                            <?php } else { ?>
                                                <span class="badge badge-success">Sudah dinilai</span>
                                        <?php }
                                        } ?>
                                    </td>
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

    <?php foreach ($lprnMhs as $lm) {?>
        <div class="modal fade" id="editNilaiMHS<?= $lm['id_nilai'] ?>" tabindex="-1" role="dialog" aria-labelledby="editNilaiMHSLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNilaiMHSLabel">Komentar dan Revisi Laporan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open_multipart('dosen/uploadFileDsn') ?>
                    <form action="<?= base_url('dosen/uploadFileDsn'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Topik Bimbingan : <?= $lm['topik'] ?></label>
                            </div>
                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea name="catatan" class="form-control"><?= $lm['catatan'] ?></textarea>
                                <input type="hidden" name="id_nilai" value="<?= $lm['id_nilai'] ?>">
                                <input type="hidden" name="npm_mhs" value="<?= $lm['npm_mhs'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Nilai</label>
                                <input type="number" class="form-control" name="nilai_mhs" min="10" max="100" value="<?= $lm['nilai_mhs'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Upload Revisi Laporan PKL</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="revisiLprnPKL" accept=".pdf">
                                    <label class="custom-file-label">Pilih File</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                        </div>
                    </form>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    <?php } ?>