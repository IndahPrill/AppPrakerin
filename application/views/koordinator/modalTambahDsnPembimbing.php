<!-- Modal -->
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
                        <label for="NIK">NIK</label>
                        <input type="text" class="form-control" id="NIK" name="nik">
                    </div>
                    <div class="form-group">
                        <label for="nm_dsn">Nama Dosen</label>
                        <input type="text" class="form-control" id="nm_dsn" name="nm_dosen">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="npm">NPM</label>
                            <input type="text" class="form-control" id="npm" name="NPM">
                        </div>
                        <div class="form-group col-md-9">
                            <label for="nm_mhs">Nama Mahasiswa</label>
                            <input type="password" class="form-control" id="nm_mhs" name="nm_mahasiswa">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>