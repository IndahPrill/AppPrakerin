s

     
     
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                   
                   <div class="row">
                       <div class="col-lg-6">

                            <?= $this->session->flashdata('message');  ?>

                           <form action="<?= base_url('user/changepassword');?>" method="post">
                           <div class="form-group">
                               <label for="current_password">Judul Laporan</label>
                               <input type="password" class="form-control" id="current_password" name="current_password">
                               <?=form_error('current_password', '<small class="text-danger pl-3">','</small>'); ?>
                           </div>
                           <div class="form-group">
                               <label for="new_password1">Revisi Ke ....</label>
                               <input type="password" class="form-control" id="new_password1" name="new_password1">
                               <?=form_error('new_password1', '<small class="text-danger pl-3">','</small>'); ?>
                           </div>
                            <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Laporan Prakerin</label>
                            <input class="form-control" type="file" id="formFile">
                            </div>
                           <div class="form-group">
                               <button type="submit" class="btn btn-primary">Change Password</button>
                           </div>
                           </form>
                       </div>
                   </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            