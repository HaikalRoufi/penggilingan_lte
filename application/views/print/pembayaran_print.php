<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nota Pembayaran <?= $kode_pembayaran; ?></title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td valign="top"><img src="<?= base_url('assets/images/logo.png'); ?>" alt="" width="130" /></td>
            <td align="right">
                <h3>Karangbendo Rice Mill</h3>
                <pre>
                CV. Maju Jaya
                Jl. Raya Karangbendo, Lumajang
                0334-455679
                081234567890
            </pre>
            </td>
        </tr>

    </table>

    <table width="100%">
        <tr>
            <td><strong>Nomor Nota :</strong> <?= $kode_pembayaran; ?></td>
            <td><strong>Kode Pelanggan :</strong> <?= $kode_pelanggan; ?></td>
            <td><strong>Nama Pelanggan :</strong> <?= $nama_pelanggan; ?></td>
        </tr>

    </table>

    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>Nama Barang</th>
                <th>Berat Kotor</th>
                <th>Berat Bersih</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($isi as $i):?>
            <tr>
                <td><?= $i->nama_jenis; ?></td>
                <td align="right"><?= $i->berat_kotor . " kg"; ?></td>
                <td align="right"><?= $i->berat_bersih . " kg"; ?></td>
                <td align="right"><?= number_format($i->harga, 0, ",", "."); ?></td>
                <td align="right"><?= number_format($i->total, 0, ",", "."); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <!-- <tr>
            <td colspan="3"></td>
            <td align="right">Subtotal Rp</td>
            <td align="right">1635.00</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Tax $</td>
            <td align="right">294.3</td>
        </tr> -->
            <tr>
                <td colspan="3"></td>
                <td align="right">Total Rp</td>
                <td align="right" class="gray">Rp <?= number_format($total_all, 0, ",", "."); ?></td>
            </tr>
        </tfoot>
    </table>
    <hr>
    <footer>
        Dicetak Oleh : <?= $this->session->userdata('username'); ?> - Tanggal Cetak : <?= date('d/m/Y H:i:s'); ?>
    </footer>

</body>

</html>