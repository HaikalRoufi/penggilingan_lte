<tr class="row-detail_barang">
	<td class="nama_jenis">
		<?= $this->input->post('nama_jenis') ?>
		<input type="hidden" name="nama_jenis_hidden[]" value="<?= $this->input->post('nama_jenis') ?>">
        <input type="hidden" name="id_barang_hidden[]" value="<?= $this->input->post('id_barang') ?>">
	</td>
	<td class="berat_kotor">
		<?= $this->input->post('berat_kotor')." kg" ?>
		<input type="hidden" name="berat_kotor_hidden[]" value="<?= $this->input->post('berat_kotor') ?>">
	</td>
	<td>
		<?= $this->input->post('berat_bersih')." kg" ?>
		<input class="berat_bersih" type="hidden" name="berat_bersih_hidden[]" value="<?= $this->input->post('berat_bersih') ?>">
	</td>
	<td class="harga">
		<?= 'Rp ' . number_format($this->input->post('harga'), 0, ",", "."); ?>
		<input class="harga" type="hidden" name="harga_hidden[]" value="<?= $this->input->post('harga') ?>">
	</td>
	<td>
		<?= 'Rp ' . number_format($this->input->post('total'), 0, ",", "."); ?>
		<input class="total" type="hidden" name="total_hidden[]" value="<?= $this->input->post('total') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-kode_barang="<?= $this->input->post('kode_barang') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>

<!-- <br>
<label>Daftar Barang</label>
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
        
        <?php //$total_all=0; $no=0; foreach($barang as $brg): $no++; ?>
        <tr>
            <th scope="row"><?php //echo $no; ?></th>
            <td><?php //echo $brg->nama_jenis; ?></td>
            <td><?php //echo $brg->berat_kotor . " kg"; ?></td>
            <td><?php //echo $brg->berat_bersih . " kg"; ?></td>
            <td><?php //echo 'Rp ' . number_format($brg->harga, 0, ",", "."); ?></td>
            <td><?php //echo 'Rp ' . number_format(($brg->harga * $brg->berat_bersih), 0, ",", "."); ?></td>
            <?php //$total = $brg->harga * $brg->berat_bersih; ?>
            <?php //$total_all = $total_all + $total; ?>
        </tr>
        <?php //endforeach; ?>
        <div id="total_all"><?php //$total_all; ?></div>
    </tbody>
</table>
<br> -->