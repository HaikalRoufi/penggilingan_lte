<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data User</h1>
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
              <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add_data_user"><i
                  class="fas fa-plus fa-sm"></i> Tambah Data User</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="tbl_user" class="table table-bordered table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;
                  foreach ($nama_user as $us):
                    $no++; ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $us->nama ?></td>
                      <td><?php echo $us->username ?></td>
                      <td><?php echo $us->akses ?></td>
                      <?php if ($this->session->userdata('nama') == $us->nama) { ?>
                        <td>&nbsp;</td>
                      <?php } else { ?>

                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-default" data-toggle="dropdown">Action</button>
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                              data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a data-toggle="modal" data-target="#edit_data_user<?= $us->id; ?>" class="dropdown-item"
                                title="Edit Data"><i class="fa fa-edit"> Edit</i></a>
                              <a href="<?php echo site_url('c_user/hapus/' . $us->id); ?>"
                                onclick="return confirm('Apakah Anda Ingin Menghapus Data ini ?');" class="dropdown-item"
                                data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash">
                                  Hapus</i></a>
                              </a>

                            </div>
                          </div>
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
<div class="modal fade" id="add_data_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('c_user/add_user'); ?>" method="post">
        <div class="modal-body">
          <!-- Form untuk menambah barang -->
          <div class="form-group">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
                <label>Role</label>
                <select name="akses" class="form-control">
                  <?php foreach ($akses as $option) { ?>
                    <option value="<?php echo $option->role_id; ?>"><?php echo $option->akses; ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php foreach ($nama_user as $us): ?>
  <!-- Modal Edit -->
  <div class="modal fade" id="edit_data_user<?= $us->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title fs-5" id="exampleModalLabel">Edit User</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('c_user/update'); ?>" method="post">
          <input type="hidden" readonly value="<?= $us->id; ?>" name="id" class="form-control">
          <div class="modal-body">
            <!-- Form untuk menambah barang -->
            <div class="form-group">
              <label>Nama</label>
              <input type="text" id="nama" name="nama" value="<?= $us->nama; ?>" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" id="username" name="username" value="<?= $us->username; ?>" class="form-control" required>
              <input type="hidden" id="username_lama" name="username_lama" value="<?= $us->username; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label>Password (Isi jika ingin diubah)</label>
              <input type="password" id="password" name="password" value="" class="form-control">
            </div>

            <div class="form-group">
              <label>Role</label>
              <select name="akses" class="form-control">
                <?php foreach ($akses as $option) { ?>
                  <option <?= $option->role_id == $us->role_id ? 'selected="selected"' : ''; ?>
                    value="<?php echo $option->role_id; ?>"><?php echo $option->akses; ?></option>
                <?php } ?>
              </select>
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
<?php endforeach; ?>
