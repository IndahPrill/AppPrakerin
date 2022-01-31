    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- <a href="" class="btn btn-primary" title="Tambah data dosen pengajar"><span class="glyphicon glyphicon-pencil"></span> Tambah Data</a> -->
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
                                <th>Action</th>             
                            </tr>
                        </thead> 
                    </table>          
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->