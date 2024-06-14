<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>Copyright &copy; <?= date('Y') ?> <a href="#">Sistem Penggilingan Padi</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>

</html>

<!-- jQuery -->
<script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets') ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Moment.js -->
<script src="<?= base_url('assets') ?>/plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
  var base_url = "<?php echo base_url(); ?>";
  var arr_barang = [];
  $(function () {

    // The Calender
    $('#calendar').datetimepicker({
      format: 'L',
      inline: true
    })

    $('#tbl_barang').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });

    $('#tbl_jenis_padi').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });

    $('#tbl_pelanggan').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });

    $('#tbl_user').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });

    $('#tbl_proses').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });

    $('#tbl_pembayaran').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });

    $("#tbl_lap").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#tbl_lap_wrapper .col-md-6:eq(0)');

    $('.db_jenis_padi').select2({
      theme: 'bootstrap4'
    });

    $('.db_pelanggan').select2({
      theme: 'bootstrap4'
    });

    $('.tgl_diterima').datetimepicker({ format: 'DD-MM-YYYY HH:mm', icons: { time: 'far fa-clock' } });

    $('.tgl_proses').datetimepicker({ format: 'DD-MM-YYYY HH:mm', icons: { time: 'far fa-clock' } });

    $('.tgl_selesai').datetimepicker({ format: 'DD-MM-YYYY HH:mm', icons: { time: 'far fa-clock' } });

    $("#harga_jenis").keyup(function () {
      $(this).val($(this).val().replace(/\D/g, ''))
      var harga
      var inp = $(this).val().replace(/\./g, '');
      harga = new Number(inp);
      $(this).val(formatAngka(inp));

    });

    $('.edj').on('shown.bs.modal', function () {
      // alert($(this).closest('div.medj').find('.harga_jenis').val())
      // $('.berat_bersih').val("");
      // $('.berat_bersih').focus();
    });

    $(".simpan_proses").click(function () {
      var berat_bersih = parseInt($(this).closest('div.ep').find('.berat_bersih').val());
      var berat_kotor = parseInt($(this).closest('div.ep').find('.berat_kotor').val());
      if (berat_bersih > berat_kotor) {
        alert("Berat Bersih tidak sesuai");
        return false;
      }
    });

    $('#add_data_proses').on('shown.bs.modal', function () {
      $('#kode_barang').focus();
    });

    $('#kode_barang').keypress(function (e) {
      var key = e.which;
      if (key == 13)  // the enter key code
      {
        $('#btn_cari').click();
        return false;
      }
    });

    $("#btn_cari").click(function () {
      $.ajax({
        type: "POST",
        url: base_url + "c_proses/cari",
        data: { kode_barang: $("#kode_barang").val().toUpperCase() },
        dataType: "text",
        cache: false,
        success:
          function (data) {
            if (data == '0') {
              alert('Data tidak ditemukan!');
            } else {
              var result = JSON.parse(data);
              $("#id_barang").val(result.id_barang);
              $("#nama_jenis").val(result.nama_jenis);
              $("#id_pelanggan").val(result.id_pelanggan);
              $("#pelanggan").val(result.nama_pelanggan);
              $("#berat_kotor").val(result.berat_kotor);
              $("#tgl_proses").focus();
            }
          }
      });
      return false;
    });

    $('.end_proses').on('shown.bs.modal', function () {
      $('.berat_bersih').val("");
      $('.berat_bersih').focus();
    });

    $(".simpan_proses").click(function () {
      var berat_bersih = parseInt($(this).closest('div.ep').find('.berat_bersih').val());
      var berat_kotor = parseInt($(this).closest('div.ep').find('.berat_kotor').val());
      if (berat_bersih > berat_kotor) {
        alert("Berat Bersih tidak sesuai");
        return false;
      }
    });

    $('#add_data_pembayaran').on('shown.bs.modal', function () {
      $('#kode_barang_bayar').focus();
    });

    $('#kode_barang_bayar').keypress(function (e) {
      var key = e.which;
      if (key == 13)  // the enter key code
      {
        $('#btn_cari_bayar').click();
        return false;
      }
    });

    $("#btn_cari_bayar").click(function () {
      $.ajax({
        type: "POST",
        url: base_url + "c_pembayaran/cari",
        data: { kode_barang: $("#kode_barang_bayar").val().toUpperCase(), id_pelanggan: $("#id_pelanggan_bayar").val() },
        dataType: "text",
        cache: false,
        success:
          function (data) {
            // alert(data);
            if (data == '0') {
              alert('Data tidak ditemukan!');
            } else {
              var result = JSON.parse(data);

              $("#id_pelanggan_bayar").val(result.id_pelanggan);
              $("#pelanggan").val(result.nama_pelanggan);
              $("#kembali").val(0);
              $("#kode_barang_bayar").focus()
              $("#bayar").attr("readonly", false); 

              const data_detail_barang = {
                nama_jenis: result.nama_jenis,
                id_barang: result.id_barang,
                kode_barang: result.kode_barang,
                berat_kotor: result.berat_kotor,
                berat_bersih: result.berat_bersih,
                harga: result.harga,
                total: result.berat_bersih * result.harga,
              }

              $.ajax({
                url: base_url + "c_pembayaran/tambah_detail_barang",
                type: 'POST',
                data: data_detail_barang,
                success: function (data) {
                  if (arr_barang.indexOf(data_detail_barang.kode_barang) !== -1) {
                    alert('Barang Sudah Ada');
                    return false;
                  } else {
                    // alert('Tidak Ada')
                    var rowcount = $('table#tbl_detail_barang tbody tr').length + 1;
                    arr_barang[rowcount] = data_detail_barang.kode_barang;
                  }
                  $('table#tbl_detail_barang tbody').append(data)
                  $('#total').val(formatAngka(hitung_total()))
                }
              })
            }
          }
      });
      return false;
    });

    $("#bayar").keyup(function () {
      $(this).val($(this).val().replace(/\D/g, ''))
      var total = 0, bayar = 0, kembali = 0;

      var inp = $(this).val().replace(/\./g, '');
      bayar = new Number(inp);
      $(this).val(formatAngka(inp));

      total = $("#total").val().replace(/\./g, '');

      if (bayar > total) {
        $("#kembali").val(formatAngka(bayar - total));
      }

      if (total > bayar) {
        $("#kembali").val(0);
      }
    });

    $(document).on('click', '#tombol-hapus', function () {
      $(this).closest('.row-detail_barang').remove()

      $('#total').val(formatAngka(hitung_min_total()))
      arr_barang.splice(arr_barang.indexOf($(this).data('kode_barang')), 1);
    })

    $("#simpan_bayar").click(function () {
      if ($('table#tbl_detail_barang tbody tr').length == 0) {
        alert("Data Masih Kosong");
        $("#kode_barang_bayar").focus();
        return false;
      }

      if (parseInt($("#bayar").val().replace(/\./g, '')) < parseInt($("#total").val().replace(/\./g, ''))) {
        alert("Uang Kurang");
        $("#bayar").focus();
        return false;
      }
    })
  });

  function formatAngka(num) {
    var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if (str.indexOf(".") > 0) {
      parts = str.split(".");
      str = parts[0];
    }
    str = str.split("").reverse();
    for (var j = 0, len = str.length; j < len; j++) {
      if (str[j] != ".") {
        output.push(str[j]);
        if (i % 3 == 0 && j < (len - 1)) {
          output.push(".");
        }
        i++;
      }
    }
    formatted = output.reverse().join("");
    return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
  };

  function hitung_total() {
    let total = 0;
    $('.total').each(function () {
      total += parseInt($(this).val())
    })

    return total;
  }

  function hitung_min_total() {
    let total = 0;
    $('.total').each(function () {
      total -= parseInt($(this).val())
    })

    return Math.abs(total);
  }
</script>