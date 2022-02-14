    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="card shadow">
            <!-- <div class="card-header py-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tmbhLaporan"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
            </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Topik</th>
                                <th>Bimbingan</th>
                                <th>Laporan</th>
                                <th>Revisi</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($jrnLaporan as $jl) { ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $jl['topik']; ?></td>
                                    <td><?= $jl['bimbingan_ke']; ?></td>
                                    <td>
                                        <?php
                                        if ($jl['file_mhs']) { ?>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('mahasiswa/downloadLaporan/') . $jl['file_mhs']; ?>"><i class="fas fa-file-pdf"></i>&nbsp;Download</a>
                                                    <a class="dropdown-item" href="<?= base_url('./assets/file/laporan/bimbingan/') . $jl['file_mhs']; ?>" target="_blank"><i class="fas fa-search"></i>&nbsp;Review</a>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <span class="badge badge-info">Belum ada file</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($jl['file_revisi']) { ?>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?= base_url('mahasiswa/downloadLaporanRevisi/') . $jl['file_revisi']; ?>"><i class="fas fa-file-pdf"></i>&nbsp;Download</a>
                                                    <a class="dropdown-item" href="<?= base_url('./assets/file/laporan/revisi/') . $jl['file_revisi']; ?>" target="_blank"><i class="fas fa-search"></i>&nbsp;Review</a>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <span class="badge badge-info">Belum ada file</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= $jl['catatan']; ?></td>
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