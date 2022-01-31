<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tmbhLokasiPKL"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-stripped table-hover datatabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM </th>
                            <th>Nama Perusahaan</th>
                            <th>Alamat</th>
                            <th>Pembimbing Eksternal</th>
                            <th>No.Telpon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>12346</td>
                            <td>CIFO</td>
                            <td>Jl.Gunung Batu</td>
                            <td>Robert</td>
                            <td>088768090</td>
                            <td>
                                <a href="" class="badge badge-success" data-toggle="modal" data-target="#editMenuModal">Edit</a>
                                <a href="" class="badge badge-danger">Delete</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->