<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN KUISIONER SKP</title>
	<style type="text/css">
		.penilaian{
 			 page-break-after: always;
 			 margin-top: 50px;
		}

		.hasil{
 			 page-break-after: always;
 			 margin-top: 50px;
		}

		.footer{
			 margin-top: 50px;
		}
	</style>
</head>
<body>

<div class="penilaian">

	<h3><center><b><u>HASIL PENILAIAN</u><br/><?php echo base64_decode($nama_upi) ?></b></center></h3>
		<table border="1" width="100%" style="font-size: 16px;line-height: 30px;">
			<thead>
				<tr>
					<td colspan="2"><b>1. KETIDAKSESUAIAN</b></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp; a. Minor</td>
					<td style="text-align: center;"><?php  echo $jum_minor ?></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp; b. Mayor</td>
					<td style="text-align: center;"><?php  echo $jum_major ?></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp; c. Serius</td>
					<td style="text-align: center;"><?php  echo $jum_serius ?></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp; d. Kritis</td>
					<td style="text-align: center;"><?php  echo $jum_kritis ?></td>
				</tr>
				<tr>
					<td><b>2. TINGKAT (GRADE) KEPATUHAN</b></td>
					<td style="text-align: center;"><?php  echo $grade ?></td>
				</tr>
				<tr>
					<td>
						<center><b>
							<br/>Mengetahui<br/>Penaggung Jawab UPI(UMKM)<br/><br/><br/><br/>
							.............................................<br/><br/>
						</b></center>
				    </td>
					<td>
						<center><b>
							<br/>........................., ..................<br/>Ketua Tim<br/><br/><br/><br/>
							.............................................<br/><br/>
						</b></center>
				    </td>
				</tr>
			</thead>
		</table>
</div>
<div class="hasil">
	<h3><center><b><u>SARAN PERBAIKAN DAN RENCANA TINDAK LANJUT</u><br/><?php echo base64_decode($nama_upi) ?></b></center></h3>
	<table border="1" width="100%" style="font-size: 16px; text-align: center;line-height: 30px;">
		<thead>
			<tr>
				<th rowspan="2">NO</th>
				<th rowspan="2">KLAUSUL</th>
				<th rowspan="2">ASPEK</th>
				<th rowspan="2">SARAN PERBAIKAN</th>
				<th colspan="4">HASIL</th>
				<th rowspan="2">RENCANA TINDAK LANJUT<br/>(Tanggal)</th>
			</tr>
			<tr>

				<th>MINOR</th>
				<th>MAJOR</th>
				<th>SERIUS</th>
				<th>KRITIS</th>
			</tr>
		</thead>
		<tbody>	
				<?php 
					$no =1;
					foreach ($data_laporan->result() as $row) {
						echo '<tr>';
						echo '<td>'.$no.'</td>';
						echo '<td>'.$row->nama_klausul.'</td>';
						echo '<td>'.$row->nama_aspek.'</td>';
						echo '<td>'.$row->keterangan.'</td>';
						echo '<td>'.$row->mn.'</td>';
						echo '<td>'.$row->mj.'</td>';
						echo '<td>'.$row->sr.'</td>';
						echo '<td>'.$row->kr.'</td>';
						echo '<td>'.date('d F Y', strtotime($row->tgl_tindak_lanjut)).'</td>';
						echo '</tr>';

						$no++;
					}
				?>
		</tbody>
	</table>
</div>
<div class="footer">
	<div style="float: left;">
		<table border="1" width="40%" style="text-align: center;line-height: 30px;">
			<thead>
				<tr>
					<th style="width: 40px;">NO</th>
					<th style="width: 300px;">TIM PEMBINA MUTU</th>
					<th style="width: 200px;">TANDA TANGAN</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>&nbsp;</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div style="float: right;">
		<table border="1" width="40%" style="text-align: center;line-height: 30px; font-size: 17px;">
			<thead>
				<tr>
					<td style="width: 100px;">Email :</td>
					<td style="width: 300px;">skp.pdspkp@gmail.com</td>		
				</tr>
				<tr>
					<td style="width: 100px;">CC :</td>
					<td style="width: 300px;">
						Telp: (021) 3513326<br/>
						Fax: (021) 3500187
					</td>		
				</tr>
			</thead>
		</table>
	</div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<div style="text-align: right; font-size: 17px;">
		..........., ............................. <?php echo date('Y') ?><br/><br/><br/><br/><br/><br/><br/>
		...............................................................
		
	</div>
	
</div>
</body>
</html>