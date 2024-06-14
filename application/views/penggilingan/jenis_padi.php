<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Jenis Padi</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php
                    $data = $this->session->flashdata('sukses');
                    if ($data != "") { ?>
                        <div id="notifikasi" class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                            <?= $data; ?>
                        </div>

                    <?php } ?>

                    <?php
                    $data2 = $this->session->flashdata('error');
                    if ($data2 != "") { ?>
                        <div id="notifikasi" class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            <?= $data2; ?>
                        </div>

                    <?php } ?>
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add_data_jenis"><i
                                    class="fas fa-plus fa-sm"></i> Tambah Jenis Padi</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="tbl_jenis_padi" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jenis</th>
                                        <th>Harga</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($nama_jenis as $jns):
                                        $no++; ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $jns->nama_jenis ?></td>
                                            <td><?php echo 'Rp ' . number_format($jns->harga, 0, ",", "."); ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default"
                                                        data-toggle="dropdown">Action</button>
                                                    <button type="button"
                                                        class="btn btn-default dropdown-toggle dropdown-icon"
                                                        data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a data-toggle="modal"
                                                            data-target="#edit_data_jenis<?= $jns->id_jenis; ?>"
                                                            class="dropdown-item" title="Edit Data"><i class="fa fa-edit">
                                                                Edit</i></a>
                                                        <a href="<?php echo site_url('c_jenis_padi/hapus/' . $jns->id_jenis); ?>"
                                                            onclick="return confirm('Apakah Anda Ingin Menghapus Data <?= $jns->nama_jenis; ?> ?');"
                                                            class="dropdown-item" data-popup="tooltip" data-placement="top"
                                                            title="Hapus Data"><i class="fa fa-trash"> Hapus</i></a>
                                                        </a>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="add_data_jenis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Tambah Jenis</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('c_jenis_padi/add_jenis'); ?>" method="post">
                <div class="modal-body">
                    <!-- Form untuk menambah barang -->
                    <div class="form-group">
                        <label>Nama Jenis</label>
                        <input type="text" name="nama_jenis" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga" id="harga_jenis" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($nama_jenis as $jns): ?>
    <!-- Modal Edit -->
    <div class="modal fade edj" id="edit_data_jenis<?= $jns->id_jenis; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content medj">
                <div class="modal-header">
                    <h6 class="modal-title fs-5" id="exampleModalLabel">Edit Jenis</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('c_jenis_padi/update'); ?>" method="post">
                    <input type="hidden" readonly value="<?= $jns->id_jenis; ?>" name="id_jenis" class="form-control">
                    <div class="modal-body">
                        <!-- Form untuk menambah barang -->
                        <div class="form-group">
                            <label>Nama Jenis</label>
                            <input type="text" id="nama_jenis" name="nama_jenis" value="<?= $jns->nama_jenis; ?>"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" value="<?= $jns->harga; ?>" class="form-control harga_jenis" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>