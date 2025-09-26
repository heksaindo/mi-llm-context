<div id="data" class="table-overflow">
	<table id="list-duk" class="table table-striped table-bordered table-checks media-table">
		<thead>
			<tr>
				<th rowspan="2">No</th>
				<th rowspan="2">NIP</th>
				<th rowspan="2">Nama</th>
				<th colspan="2">Pangkat</th>
				<th colspan="2">Jabatan</th>
				<th colspan="2">Masa Kerja Jabatan</th>
				<th rowspan="2">Eselon</th>
				<th rowspan="2">Tmt Cpns</th>
			</tr>
			<tr>
				<th>Gol</th>
				<th>Tmt</th>
				<th>Nama</th>
				<th>Tmt</th>
				<th>Thn</th>
				<th>Bln</th>
			</tr>                                
		</thead>
		<tbody>
			<?php 
			$nomor_urut = 1;
			foreach ($data_pegawai as $pegawai){
				$pegawai_id = $pegawai['nip_baru'];
			?>
				<tr>
					<td><?php echo $nomor_urut; ?></td>
					<td><?php echo $pegawai['nip_baru']; ?></td>
					<td><?php echo $pegawai['nama']; ?></td>
					<td><?php echo $pegawai['gol_terakhir']; ?></td>
					<td><?php echo $pegawai['tmt_gol_terakhir']; ?></td>
					<td><?php echo $pegawai['nama_jabatan']; ?></td>
					<td><?php echo $pegawai['tmt_jabatan']; ?></td>
					<td><?php echo $pegawai['masa_kerja_tahun']; ?></td>
					<td><?php echo $pegawai['masa_kerja_tahun']; ?></td>										
					<td><?php echo $pegawai['eselon']; ?></td>
					<td><?php echo $pegawai['tmt_cpns']; ?></td>
				</tr>
			<?php
			$nomor_urut = $nomor_urut + 1;
			}
			?>
		</tbody>
	</table>
</div>
<div id="ajax_paging">
	<?php echo $pagination; ?>
</div>