<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tmbhLokasiPKL"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
        </div>
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Mahasiswa</th>
                            <th>Nama Perusahaan</th>
                            <th>Alamat Perusahaan</th>
                            <th>Pembimbing Eksternal</th>
                            <th>No.Telpon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($lksPkl as $lp) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $lp['npm_mhs']; ?></td>
                                <td><?= $lp['nama_mhs']; ?></td>
                                <td><?= $lp['nama_perusahaan']; ?></td>
                                <td><?= $lp['alamat_lks']; ?></td>
                                <td><?= $lp['dsn_eksternal']; ?></td>
                                <td><?= $lp['no_tlp_dsn_eksternal']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editLokasiPKL<?= $lp['id_lks'] ?>"><i class="far fa-edit"></i>&nbsp;Edit</button>
                                    <a href="<?= base_url('koordinator/deleteLksPkl/') . $lp['id_lks']; ?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i>&nbsp;Delete</a>
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

<!-- Modal Add -->
<div class="modal fade" id="tmbhLokasiPKL" tabindex="-1" role="dialog" aria-labelledby="tmbhLokasiPKLLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tmbhLokasiPKLLabel">Tambah Lokasi PKL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('koordinator/addLksPkl'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>NPM</label>
                        <input type="text" class="form-control" name="npm_mhs">
                    </div>
                    <div class="form-group">
                        <label>Nama Perusahaan</label>
                        <input type="text" class="form-control" name="nama_perusahaan">
                    </div>
                    <div class="form-group">
                        <label>Alamat Perusahaan</label>
                        <input type="text" class="form-control" name="alamat_lks">
                    </div>
                    <div class="form-group">
                        <label>Nama Pembimbing Eksternal</label>
                        <input type="text" class="form-control" name="dsn_eksternal">
                    </div>
                    <div class="form-group">
                        <label>No Telepon Pembimbing Eksternal</label>
                        <input type="text" class="form-control" name="no_tlp_dsn_eksternal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($lksPkl as $lp) { ?>
    <div class="modal fade" id="editLokasiPKL<?= $lp['id_lks'] ?>" tabindex="-1" role="dialog" aria-labelledby="editLokasiPKLLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLokasiPKLLabel">Ubah Lokasi PKL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('koordinator/editLksPkl'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>NPM</label>
                            <input type="text" class="form-control" name="npm_mhs" value="<?= $lp['npm_mhs'] ?>">
                            <input type="hidden" name="id_lks" value="<?= $lp['id_lks'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Perusahaan</label>
                            <input type="text" class="form-control" name="nama_perusahaan" value="<?= $lp['nama_perusahaan'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat_lks" value="<?= $lp['alamat_lks'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Pembimbing Eksternal</label>
                            <input type="text" class="form-control" name="dsn_eksternal" value="<?= $lp['dsn_eksternal'] ?>">
                        </div>
                        <div class="form-group">
                            <label>No Telepon Pembimbing Eksternal</label>
                            <input type="text" class="form-control" name="no_tlp_dsn_eksternal" value="<?= $lp['no_tlp_dsn_eksternal'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>