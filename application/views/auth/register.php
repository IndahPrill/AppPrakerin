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
                        <form class="user" method="post" action="<?=base_url('auth/register'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name');?>">
                                <?= form_error('name', '<small class="text-danger pl-3">' ,'</small>'); ?>
                            </div>
                            <?php 
                            $hakAkses = $this->session->userdata('hakAkses');
                            if ($hakAkses == 2 && $hakAkses == 4) {?>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" id="nik" name="nik" placeholder="Nik Dosen" value="<?= set_value('nik');?>">
                                    <?= form_error('nik', '<small class="text-danger pl-3">' ,'</small>'); ?>
                                </div> 
                            <?php
                            } else if ($hakAkses == 3) {?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="prodi" name="prodi" placeholder="Kelas dan Prodi" value="<?= set_value('prodi');?>">
                                    <?= form_error('prodi', '<small class="text-danger pl-3">' ,'</small>'); ?> 
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" id="npm" name="npm" placeholder="NPM Mahasiswa" value="<?= set_value('npm');?>">
                                    <?= form_error('npm', '<small class="text-danger pl-3">' ,'</small>'); ?> 
                                </div>
                            <?php
                            } ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email');?>">
                                <?= form_error('email', '<small class="text-danger pl-3">' ,'</small>'); ?> 
                            </div>
                            <input type="hidden" name="hak_akses" value="<?= $hakAkses ?>">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                        id="password1" name="password1" placeholder="Password">
                                        <?= form_error('password1', '<small class="text-danger 
                                    pl-3">' ,'</small>');  ?> 
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                        id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
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

