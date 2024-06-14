<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <center>
        <h1>LABEL IDENTITAS BARANG</h1>
    </center>
    <table border="1" width="100%">
        <tr>
            <td colspan="2">
                <center><span style="font-size:20pt;font-weight:bold;">Kode Barang :
                        <?= $isi->kode_barang; ?></span></center>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <center><img width="50%"
                        src="<?php echo site_url(); ?>c_barang/Barcode/<?php echo $isi->kode_barang; ?>" />
                </center>
            </td>
        </tr>
        <tr>
            <td>Jenis Padi : <br><span style="font-size:16pt;font-weight:bold;"><?= $isi->nama_jenis; ?></span></td>
            <td>Nama Pelanggan :<br><span style="font-size:16pt;font-weight:bold;"><?= $isi->nama_pelanggan; ?></td>
        </tr>
        <tr>
            <td>Berat Kotor : <br><span style="font-size:16pt;font-weight:bold;"><?= $isi->berat_kotor . " kg"; ?>
            </td>
            <td>Berat Bersih : <br><span style="font-size:16pt;font-weight:bold;">................. kg</td>
        </tr>
        <tr>
            <td colspan="2">
                <center>Tanggal Diterima :<br> <span
                        style="font-size:20pt;font-weight:bold;"><?= date('d-m-Y H:i:s', strtotime($isi->tgl_diterima)); ?></span>
                </center>
            </td>
        </tr>
    </table>
    <footer>
        Dicetak Oleh : <?= $this->session->userdata('username'); ?> - Tanggal Cetak : <?= date('d/m/Y H:i:s'); ?>
    </footer>
</body>

</html>