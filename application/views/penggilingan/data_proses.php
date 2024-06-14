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
              <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add_data_proses"><i
                  class="fas fa-plus fa-sm"></i> Tambah Proses</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="tbl_proses" class="table table-bordered table-hover" style="width:100%">
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
                    <th>Opsi</th>
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
                      <?php if ($prs->status >= 2) { ?>
                        <td>
                          <a href="#" class="btn btn-success btn-sm"
                            title="Selesai"><i class="fa fa-check"></i></a>
                        </td>
                      <?php } else { ?>
                        <td>
                          <a data-toggle="modal" data-target="#end_proses<?= $prs->id_proses; ?>"
                            class="btn btn-primary btn-sm" title="Proses"><i class="fa fa-cog"></i></a>
                        </td>
                      <?php } ?>
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
<div class="modal fade" id="add_data_proses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title fs-5" id="exampleModalLabel">Tambah Proses</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('c_proses/add_proses'); ?>" method="post">
        <div class="modal-body">
          <!-- Form untuk menambah barang -->
          <div class="form-group">
            <label>Kode Barang</label>
            <div class="row g-3">
              <div class="col-sm-7">
                <input onfocus="this.value=''" type="text" class="form-control" name="kode_barang" id="kode_barang">
                <input type="hidden" class="form-control" name="id_barang" id="id_barang">
              </div>
              <div class="col-sm">
                <button type="button" class="btn btn-primary" id="btn_cari">Cari</button>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Jenis Padi</label>
            <input type="text" class="form-control" name="nama_jenis" readonly id="nama_jenis">
          </div>
          <div class="form-group">
            <label>Nama Pelanggan</label>
            <input type="text" class="form-control" name="pelanggan" readonly id="pelanggan">
            <input type="hidden" class="form-control" name="id_pelanggan" readonly id="id_pelanggan">
          </div>
          <div class="form-group">
            <label>Berat Kotor</label>
            <input type="text" name="berat_kotor" class="form-control" readonly id="berat_kotor">
          </div>
          <div class="form-group">
            <label>Tanggal Proses</label>
            <div class="input-group date tgl_proses" data-target-input="nearest">
              <input type="text" name="tgl_proses" class="form-control datetimepicker-input" data-target=".tgl_proses"
                data-toggle="datetimepicker" value="<?= date('d/m/y H:i') ?>" required />
            </div>
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

<?php foreach ($proses as $prs): ?>
    <!-- Modal Proses -->
  <div class="modal fade end_proses" id="end_proses<?= $prs->id_proses; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content ep">
        <div class="modal-header">
          <h6 class="modal-title fs-5" id="exampleModalLabel">End Proses</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('c_proses/update'); ?>" method="post">
          <input type="hidden" readonly value="<?= $prs->id_proses; ?>" name="id_proses" class="form-control">
          <input type="hidden" readonly value="<?= $prs->id_barang; ?>" name="id_barang" class="form-control">
          <div class="modal-body">
            <!-- Form untuk menambah barang -->
            <div class="form-group">
              <label>Jenis Padi</label>
              <input type="text" class="form-control" name="jenis" readonly value="<?php echo $prs->nama_jenis; ?>">
            </div>
            <div class="form-group">
              <label>Nama Pelanggan</label>
              <input type="text" class="form-control" name="pelanggan" readonly
                value="<?php echo $prs->nama_pelanggan; ?>">
            </div>
            <div class="form-group">
              <label>Berat Kotor</label>
              <input type="number" readonly name="berat_kotor" value="<?= $prs->berat_kotor; ?>" class="form-control berat_kotor">
            </div>
            <div class="form-group">
              <label>Berat Bersih</label>
              <input type="number" name="berat_bersih" value="<?= $prs->berat_bersih; ?>" class="form-control berat_bersih" required>
            </div>
            <div class="form-group">
              <label>Tanggal Proses</label>
              <div class="input-group date tgl_proses" data-target-input="nearest">
                <input type="text" name="tgl_proses" class="form-control datetimepicker-input" data-target=".tgl_proses"
                  data-toggle="datetimepicker" value="<?= date('d/m/y H:i', strtotime($prs->tgl_proses)) ?>" disabled />
              </div>
            </div>
            <div class="form-group">
              <label>Tanggal Selesai</label>
              <div class="input-group date tgl_selesai" data-target-input="nearest">
                <input type="text" name="tgl_selesai" class="form-control datetimepicker-input" data-target=".tgl_selesai"
                  data-toggle="datetimepicker" value="<?= date('d/m/y H:i') ?>" required />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary simpan_proses">Selesai</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>