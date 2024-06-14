<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Proses</h1>
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
                    <th>Kode Proses</th>
                    <th>Jenis</th>
                    <th>Pelanggan</th>
                    <th>Berat Kotor</th>
                    <th>Berat Bersih</th>
                    <th>Tanggal Proses</th>
                    <th>Tanggal Selesai</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;
                  foreach ($proses as $prs):
                    $no++; ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $prs->kode_proses ?></td>
                      <td><?php echo $prs->nama_jenis ?></td>
                      <td><?php echo $prs->nama_pelanggan ?></td>
                      <td><?php echo $prs->berat_kotor ?> kg</td>
                      <td><?php echo $prs->berat_bersih ?> kg</td>
                      <td><?php echo date('l, j F Y H:i:s', strtotime($prs->tgl_proses)) ?></td>
                      <td>
                        <?php echo $prs->tgl_selesai != '0000-00-00 00:00:00' ? date('l, j F Y H:i:s', strtotime($prs->tgl_selesai)) : "-"; ?>
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