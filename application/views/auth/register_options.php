<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="post" action="<?=base_url('auth/register_options'); ?>">
                            <div class="form-group">
                                <select class="form-control" name="hak_akses" id="hak_akses" placeholder="-- PILIH --">
                                    <option value="">-- PILIH --</option>
                                    <option value="1">Admin</option>
                                    <option value="4">Koordinator</option>
                                    <option value="2">Dosen</option>
                                    <option value="3">Mahasiswa</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Selanjutnya</button>
                        </form>
                        <hr>
                        <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/forgotpassword');?>">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?=base_url('auth'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

