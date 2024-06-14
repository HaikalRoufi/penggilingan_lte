<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Barang</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <table id="tbl_lap" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Jenis Padi</th>
                                <th>Pelanggan</th>
                                <th>Berat Kotor</th>
                                <th>Tanggal Diterima</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($nama_barang as $brg):
                                $no++; ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $brg->kode_barang ?></td>
                                    <td><?php echo $brg->nama_jenis ?></td>
                                    <td><?php echo $brg->nama_pelanggan ?></td>
                                    <td><?php echo $brg->berat_kotor ?> kg</td>
                                    <td><?php echo date('l, j F Y H:i:s', strtotime($brg->tgl_diterima)) ?></td>
                                    <td>
                                        <?php echo ($brg->status == 0) ? "Barang Diterima" : (($brg->status == 1) ? "Barang Diproses" : (($brg->status == 2) ? "Barang Selesai Diproses" : (($brg->status == 3) ? "Barang Sudah Dibayar" : ""))); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>