<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pembayaran</h1>
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
                            <button class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#add_data_pembayaran"><i class="fas fa-plus fa-sm"></i> Tambah
                                Pembayaran</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="tbl_pembayaran" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Pembayaran</th>
                                        <th>Pelanggan</th>
                                        <th>Total All</th>
                                        <th>Bayar</th>
                                        <th>Kembali</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($pelanggan as $plg):
                                        $no++; ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $plg->kode_pembayaran ?></td>
                                            <td><?php echo $plg->nama_pelanggan ?></td>
                                            <td><?php echo 'Rp ' . number_format($plg->total_all, 0, ",", "."); ?></td>
                                            <td><?php echo 'Rp ' . number_format($plg->bayar, 0, ",", "."); ?></td>
                                            <td><?php echo 'Rp ' . number_format($plg->kembali, 0, ",", "."); ?></td>
                                            <td>
                                                <?php echo $plg->tgl_bayar != '0000-00-00 00:00:00' ? date('l, j F Y H:i:s', strtotime($plg->tgl_bayar)) : "-"; ?>
                                            </td>
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
                                                            data-target="#detail_data_pembayaran<?= $plg->id_pembayaran; ?>"
                                                            class="dropdown-item" title="Detail"><i class="fa fa-bars">
                                                                Detail</i></a>
                                                        <a href="<?php echo site_url('c_pembayaran/Render_Print/' . $plg->kode_pembayaran); ?>"
                                                            target="_blank" class="dropdown-item" title="Print"><i
                                                                class="fa fa-print"> 
                                                                Print</i></a>
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
<div class="modal fade" id="add_data_pembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Tambah Pembayaran</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('c_pembayaran/add_pembayaran'); ?>" method="post">
                <div class="modal-body">
                    <!-- Form untuk menambah barang -->
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <div class="row g-3">
                            <div class="col-11">
                                <input onfocus="this.value=''" type="text" class="form-control" name="kode_barang_bayar"
                                    id="kode_barang_bayar">
                                <input type="hidden" class="form-control" name="id_barang" id="id_barang">
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-primary" id="btn_cari_bayar">Cari</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <input type="text" name="pelanggan" class="form-control" readonly id="pelanggan">
                        <input type="hidden" name="id_pelanggan_bayar" class="form-control" id="id_pelanggan_bayar"
                            value="0">
                    </div>
                    <div class="detail_barang">
                        <label>Detail Barang</label>
                        <table class="table table-bordered" id="tbl_detail_barang">
                            <thead>
                                <tr>
                                    <td width="35%">Nama Jenis</td>
                                    <td width="15%">Berat Kotor</td>
                                    <td width="15%">Berat Bersih</td>
                                    <td width="10%">Harga</td>
                                    <td width="10%">Total</td>
                                    <td width="15%">Aksi</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <label>Total All</label>
                        <input type="text" name="total" class="form-control" readonly id="total">
                    </div>
                    <div class="form-group">
                        <label>Bayar</label>
                        <input type="text" name="bayar" class="form-control" id="bayar" readonly required>
                    </div>
                    <div class="form-group">
                        <label>Kembali</label>
                        <input type="text" name="kembali" class="form-control" readonly id="kembali">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" id="simpan_bayar" name="simpan_bayar" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($pelanggan as $plg): ?>
    <!-- Modal Detail Pembayaran -->
    <div class="modal fade" id="detail_data_pembayaran<?= $plg->id_pembayaran; ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5" id="exampleModalLabel">Detail Data Barang Nota</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Jenis Padi</th>
                                <th scope="col">Berat Kotor</th>
                                <th scope="col">Berat Bersih</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($detail as $brg):
                                if ($brg->id_pembayaran == $plg->id_pembayaran) {
                                    $no++;
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $no; ?></th>
                                        <td><?php echo $brg->nama_jenis; ?></td>
                                        <td><?php echo $brg->berat_kotor . " kg"; ?></td>
                                        <td><?php echo $brg->berat_bersih . " kg"; ?></td>
                                        <td><?php echo 'Rp ' . number_format($brg->harga, 0, ",", "."); ?></td>
                                        <td><?php echo 'Rp ' . number_format($brg->total, 0, ",", "."); ?></td>
                                    </tr>
                                <?php }endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>