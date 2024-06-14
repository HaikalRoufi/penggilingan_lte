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
              <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add_data_barang"><i
                  class="fas fa-plus fa-sm"></i> Tambah Barang</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="tbl_barang" class="table table-bordered table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Barcode</th>
                    <th>Jenis Padi</th>
                    <th>Pelanggan</th>
                    <th>Berat Kotor</th>
                    <th>Tanggal Diterima</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;
                  foreach ($nama_barang as $brg):
                    $no++; ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $brg->kode_barang ?></td>
                      <td><img src="<?php echo site_url(); ?>/c_barang/Barcode/<?php echo $brg->kode_barang; ?>" />
                      </td>
                      <td><?php echo $brg->nama_jenis ?></td>
                      <td><?php echo $brg->nama_pelanggan ?></td>
                      <td><?php echo $brg->berat_kotor ?> kg</td>
                      <td><?php echo date('l, j F Y H:i:s', strtotime($brg->tgl_diterima)) ?></td>
                      <td>
                        <?php echo ($brg->status == 0) ? "Barang Diterima" : (($brg->status == 1) ? "Barang Diproses" : (($brg->status == 2) ? "Barang Selesai Diproses" : (($brg->status == 3) ? "Barang Sudah Dibayar" : ""))); ?>
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-default" data-toggle="dropdown">Action</button>
                          <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                            data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            <a data-toggle="modal" data-target="#edit_data_barang<?= $brg->id_barang; ?>"
                              class="dropdown-item" title="Edit Data"><i class="fa fa-edit"> Edit</i> </a>
                            <a href="<?php echo site_url('c_barang/hapus/' . $brg->id_barang); ?>"
                              onclick="return confirm('Apakah Anda Ingin Menghapus Data ini ?');" class="dropdown-item"
                              data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash">
                                Hapus</i>
                            </a>
                            <a href="<?php echo site_url('c_barang/render_print/' . $brg->kode_barang); ?>"
                              target="_blank" class="dropdown-item" title="Print"><i class="fa fa-print"> Cetak</i></a>
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
<div class="modal fade" id="add_data_barang" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('c_barang/add_barang'); ?>" method="post">
        <div class="modal-body">
          <!-- Form untuk menambah barang -->
          <div class="form-group">
            <label>Jenis Padi</label>
            <select name="jenis" class="form-control db_jenis_padi">
              <?php foreach ($nama_jenis as $option) { ?>
                <option value="<?php echo $option->id_jenis; ?>"><?php echo $option->nama_jenis; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Pelanggan</label>
            <select name="pelanggan" class="form-control db_pelanggan">
              <?php foreach ($nama_pelanggan as $option) { ?>
                <option value="<?php echo $option->id_pelanggan; ?>"><?php echo $option->nama_pelanggan; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Berat Kotor</label>
            <input type="number" name="berat_kotor" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Tanggal Diterima</label>
            <div class="input-group date tgl_diterima" data-target-input="nearest">
              <input type="text" name="tgl_diterima" class="form-control datetimepicker-input"
                data-target=".tgl_diterima" data-toggle="datetimepicker" value="<?= date('d-m-y H:i') ?>" required />
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

<?php foreach ($nama_barang as $brg): ?>
  <!-- Modal Edit -->
  <div class="modal fade" id="edit_data_barang<?= $brg->id_barang; ?>" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title fs-5" id="exampleModalLabel">Edit Barang</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('c_barang/update'); ?>" method="post">
          <input type="hidden" readonly value="<?= $brg->id_barang; ?>" name="id_barang" class="form-control">
          <div class="modal-body">
            <!-- Form untuk menambah barang -->
            <div class="form-group">
              <label>Jenis Padi</label>
              <select name="jenis" class="form-control db_jenis_padi">
                <?php foreach ($nama_jenis as $option) { ?>
                  <option <?= $option->id_jenis == $brg->id_jenis ? 'selected="selected"' : ''; ?>
                    value="<?php echo $option->id_jenis; ?>"><?php echo $option->nama_jenis; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Pelanggan</label>
              <select name="pelanggan" class="form-control db_pelanggan">
                <?php foreach ($nama_pelanggan as $option) { ?>
                  <option <?= $option->id_pelanggan == $brg->id_pelanggan ? 'selected="selected"' : ''; ?>
                    value="<?php echo $option->id_pelanggan; ?>"><?php echo $option->nama_pelanggan; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Berat Kotor</label>
              <input type="text" id="berat_kotor" name="berat_kotor" value="<?= $brg->berat_kotor; ?>"
                class="form-control" required>
            </div>
            <div class="form-group">
              <label>Tanggal Diterima</label>
              <div class="input-group date tgl_diterima" data-target-input="nearest">
                <input type="text" name="tgl_diterima" class="form-control datetimepicker-input"
                  data-target=".tgl_diterima" data-toggle="datetimepicker"
                  value="<?= date('d/m/y H:i', strtotime($brg->tgl_diterima)) ?>" required />
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
<?php endforeach; ?>