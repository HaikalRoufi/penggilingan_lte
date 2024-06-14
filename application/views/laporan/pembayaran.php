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
                    <table id="tbl_lap" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Pembayaran</th>
                                <th>Pelanggan</th>
                                <th>Total All</th>
                                <th>Bayar</th>
                                <th>Kembali</th>
                                <th>Tanggal Bayar</th>
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