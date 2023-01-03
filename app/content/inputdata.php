<div class="container-fluid">
	<div class="row mb-3">
		<!-- Tabel Informasi Mata Kuliah -->
		<div class="col-lg-6">
			<h4 class="mt-3 mb-3">Informasi Mata Kuliah</h4>
			<div class="table-responsive">
				<table class="table" id="table_mata_kuliah">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Kode</th>
							<th scope="col">Nama</th>
							<th scope="col">Semester</th>
							<th scope="col">SKS</th>
							<th scope="col">Kategori</th>
							<?php
							if ($user['status_user']=="Admin") {
								echo "<th scope='col'>Aksi</th>";
							}
							?>
							
						</tr>
					</thead>
					<tbody>
						<?php
						$nomor_matkul = 1;
						$runqueryGetAllDataMatkul = $objMatkul->getAllDataMatkul();
						while ( $matkul = $runqueryGetAllDataMatkul->fetch_assoc()) :?>
							<tr>
								<th scope="row"><?= $nomor_matkul; ?></th>
								<td><?= $matkul['kode_matkul']; ?></td>
								<td><?= $matkul['nama_matkul']; ?></td>
								<td><?= $matkul['semester_matkul']; ?></td>
								<td><?= $matkul['sks_matkul']; ?></td>
								<td><?= $matkul['nama_kategori']; ?></td>
								<?php if ($user['status_user']=="Admin"): ?>
									<td>
										<a type="button" class="btn btn-warning btn-sm btn-editMatkul" data-toggle="modal" data-target="#modal_input_data" name="btn-editMatkul" data-id_matkul="<?= $matkul['id_matkul']; ?>">
											Edit
										</a>
									</td>
								<?php endif ?>
							</tr>
							<?php $nomor_matkul++;
						endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- Akhir tabel informasi mata kuliah -->
		<!-- Tabel informasi detail matkul -->
		<div class="col-lg-6">
			<h4 class="mt-3 mb-3">Detail Informasi Mata Kuliah</h4>
			<div class="table-responsive">
				<table class="table" id="table_detail_mata_kuliah">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Mata Kuliah</th>
							<th scope="col">Semester</th>
							<th scope="col">Angkatan</th>
							<th scope="col">Kelas</th>
							<th scope="col">Dosen</th>
							<?php
							if ($user['status_user']=="Admin") {
								echo "<th scope='col'>Aksi</th>";
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						$nomor_matkul = 1;
						$runQueryGetAllDataDetailMatkul = $objMatkul->getAllDataDetailMatkul();
						while ($matkul = $runQueryGetAllDataDetailMatkul->fetch_assoc()):
							?>
							<tr>
								<th scope="row"><?= $nomor_matkul; ?></th>
								<td><?= $matkul['nama_matkul']; ?></td>
								<td><?= $matkul['semester_matkul']; ?></td>
								<td><?= $matkul['tahun_angkatan']; ?></td>
								<td>
									<?= $matkul['nama_kelas']; ?>
								</td>
								<td><?= $matkul['nama_dosen']; ?></td>
								<?php if ($user['status_user']=="Admin"): ?>
									<td>
										<a type="button" class="btn btn-warning btn-sm btn-editInformasiMatkul" data-toggle="modal" data-target="#modal_input_data" name="btn-editInformasiMatkul" data-id_detailmatkul="<?= $matkul['id_detailmatkul']; ?>">
											Edit
										</a>
									</td>
								<?php endif ?>
							</tr>
							<?php $nomor_matkul++;
						endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- Akhir tabel informasi detail matkul -->
	</div>
	<div class="row mb-3">
		<!-- Tabel Informasi Dosen -->
		<div class="col-lg-6">
			<h4 class="mt-3 mb-3">Informasi Dosen</h4>
			<div class="table-responsive">
				<table class="table" id="table_dosen">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">NIP</th>
							<th scope="col">Nama Dosen</th>
							<?php
							if ($user['status_user']=="Admin") {
								echo "<th scope='col'>Aksi</th>";
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						$nomor_dosen = 1;
						$runQueryGetAllDataDosen = $objDosen->getAllDataDosen();
						while ($dosen = $runQueryGetAllDataDosen->fetch_assoc()):
							?>
							<tr>
								<th scope="row"><?= $nomor_dosen; ?></th>
								<td><?= $dosen['nip_dosen']; ?></td>
								<td><?= $dosen['nama_dosen']; ?></td>
								<?php if ($user['status_user']=="Admin"): ?>
									<td>
										<a type="button" class="btn btn-warning btn-sm btn-editDosen" data-toggle="modal" data-target="#modal_input_data" name="btn-editDosen" data-id_dosen="<?= $dosen['id_dosen']; ?>">
											Edit
										</a>
									</td>
								<?php endif ?>
							</tr>
							<?php $nomor_dosen++;
						endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- Akhir tabel informasi dosen -->
		<!-- Tabel informasi ruangan -->
		<div class="col-lg-6">
			<h4 class="mt-3 mb-3">Informasi Ruangan</h4>
			<div class="table-responsive">
				<table class="table" id="table_ruangan">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama Ruangan</th>
							<th scope="col">Kapasitas</th>
							<th scope="col">Lokasi</th>
							<?php
							if ($user['status_user']=="Admin") {
								echo "<th scope='col'>Aksi</th>";
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						$nomor_ruangan = 1;
						$runQueryGetAllDataRuangan = $objRuangan->getAllDataRuangan();
						while ($ruangan = $runQueryGetAllDataRuangan->fetch_assoc()):
							?>
							<tr>
								<th scope="row"><?= $nomor_ruangan; ?></th>
								<td><?= $ruangan['nama_ruangan']; ?></td>
								<td><?= $ruangan['kapasitas_ruangan']; ?></td>
								<td><?= $ruangan['lokasi_ruangan']; ?></td>
								<?php if ($user['status_user']=="Admin"): ?>
									<td>
										<a type="button" class="btn btn-warning btn-sm btn-editRuangan" data-toggle="modal" data-target="#modal_input_data" name="btn-editRuangan" data-id_ruangan="<?= $ruangan['id_ruangan']; ?>">
											Edit
										</a>
									</td>
								<?php endif ?>
							</tr>
							<?php
							$nomor_ruangan++; 
						endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- Akhir tabel informasi ruangan -->
	</div>
	<div class="row mb-3">
		<!-- Tabel informasi hari -->
		<div class="col-lg-6">
			<h4 class="mt-3 mb-3">Informasi Hari</h4>
			<div class="table-responsive">
				<table class="table" id="table_hari">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama Hari</th>
							<th scope="col">Status</th>
							<?php
							if ($user['status_user']=="Admin") {
								echo "<th scope='col'>Aksi</th>";
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						$nomor_hari = 1;
						$runQueryGetAllDataHari = $objWaktu->getAllDataHari();
						while ($hari = $runQueryGetAllDataHari->fetch_assoc()):
							?>
							<tr>
								<th scope="row"><?= $nomor_hari; ?></th>
								<td><?= $hari['nama_hari']; ?></td>
								<td><?= $hari['nama_status']; ?></td>
								<?php if ($user['status_user']=="Admin"): ?>
									<td>
										<a type="button" class="btn btn-warning btn-sm btn-editHari" data-toggle="modal" data-target="#modal_input_data" name="btn-editHari" data-id_hari="<?= $hari['id_hari']; ?>">
											Edit
										</a>
									</td>
								<?php endif ?>
							</tr>
							<?php $nomor_hari++; ?>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- Akhir tabel informasi hari -->
		<!-- Tabel informasi jam -->
		<div class="col-lg-6">
			<h4 class="mt-3 mb-3">Informasi Jam Perkuliahan</h4>
			<div class="table-responsive">
				<table class="table" id="table_jam">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Kode Jam</th>
							<th scope="col">Rentang Jam</th>
							<th scope="col">SKS</th>
							<?php
							if ($user['status_user']=="Admin") {
								echo "<th scope='col'>Aksi</th>";
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						$nomor_jam = 1;
						$runQueryGetAllDataJam = $objWaktu->getAllDataJam();
						while ($jam = $runQueryGetAllDataJam->fetch_assoc()) :
							?>
							<tr>
								<th scope="row"><?= $nomor_jam; ?></th>
								<td><?= $jam['kode_jam']; ?></td>
								<td><?= $jam['rentang_jam']; ?></td>
								<td><?= $jam['sks_jam']; ?></td>
								<?php if ($user['status_user']=="Admin"): ?>
									<td>
										<a type="button" class="btn btn-warning btn-sm btn-editJam" data-toggle="modal" data-target="#modal_input_data" name="btn-editJam" data-id_jam="<?= $jam['id_jam']; ?>">
											Edit
										</a>
									</td>
								<?php endif ?>
							</tr>
							<?php $nomor_jam++; ?>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- Akhir tabel informasi jam -->
	</div>
	<div class="row mb-3">
		<!-- Tabel informasi angkatan -->
		<div class="col-lg-6">
			<h4 class="mt-3 mb-3">Informasi Angkatan</h4>
			<div class="table-responsive">
				<table class="table" id="table_angkatan">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Tahun</th>
							<th scope="col">Kelulusan</th>
							<?php
							if ($user['status_user']=="Admin") {
								echo "<th scope='col'>Aksi</th>";
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						$nomor_angkatan = 1;
						$runQueryGetAllDataAngkatan = $objAngkatan->getAllDataAngkatan();
						while ($angkatan = $runQueryGetAllDataAngkatan->fetch_assoc()) :
							?>
							<tr>
								<th scope="row"><?= $nomor_angkatan; ?></th>
								<td><?= $angkatan['tahun_angkatan']; ?></td>
								<td><?= $angkatan['nama_statusangkatan']; ?></td>
								<?php if ($user['status_user']=="Admin"): ?>
									<td>
										<a type="button" class="btn btn-warning btn-sm btn-editAngkatan" data-toggle="modal" data-target="#modal_input_data" name="btn-editAngkatan" data-id_angkatan="<?= $angkatan['id_angkatan']; ?>">
											Edit
										</a>
									</td>
								<?php endif ?>
							</tr>
							<?php $nomor_angkatan++; ?>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- Akhir tabel informasi angkatan -->
		<!-- Tabel informasi kelas -->
		<div class="col-lg-6">
			<h4 class="mt-3 mb-3">Informasi Kelas</h4>
			<div class="table-responsive">
				<table class="table" id="table_kelas">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama</th>
							<?php
							if ($user['status_user']=="Admin") {
								echo "<th scope='col'>Aksi</th>";
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						$nomor_kelas = 1;
						$runQueryGetAllDataKelas = $objKelas->getAllDataKelas();
						while ($kelas = $runQueryGetAllDataKelas->fetch_assoc()) :
							?>
							<tr>
								<th scope="row"><?= $nomor_kelas; ?></th>
								<td><?= $kelas['nama_kelas']; ?></td>
								<?php if ($user['status_user']=="Admin"): ?>
									<td>
										<a type="button" class="btn btn-warning btn-sm btn-hapusKelas" data-toggle="modal" data-target="#modal_input_data" name="btn-hapusKelas" data-id_kelas="<?= $kelas['id_kelas']; ?>">
											Hapus
										</a>
									</td>
								<?php endif ?>
							</tr>
							<?php $nomor_kelas++; ?>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- Akhir tabel informasi kelas -->
	</div>
	<div class="row mb-3">
		<!-- Tabel informasi detail angkatan -->
		<div class="col">
			<h4 class="mt-3 mb-3">Informasi Detail Angkatan</h4>
			<div class="table-responsive">
				<table class="table" id="table_detail_angkatan">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Tahun</th>
							<th scope="col">Kelas</th>
							<th scope="col">Kategori</th>
							<th scope="col">Peserta</th>
							<th scope="col">Kelulusan</th>
							<?php
							if ($user['status_user']=="Admin") {
								echo "<th scope='col'>Aksi</th>";
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						$nomor_detailangkatan = 1;
						$runQueryGetAllDataDetailAngkatan = $objAngkatan->getAllDataDetailAngkatan();
						while ($angkatan = $runQueryGetAllDataDetailAngkatan->fetch_assoc()) :
							?>
							<tr>
								<th scope="row"><?= $nomor_detailangkatan; ?></th>
								<td>
									<?= $angkatan['tahun_angkatan']; ?>
								</td>
								<td>
									<?= $angkatan['nama_kelas']; ?>
								</td>
								<td>
									<?= $angkatan['nama_kategori']; ?>
								</td>
								<td>
									<?= $angkatan['peserta_kelas']; ?> mahasiswa
								</td>
								<td>
									<?= $angkatan['nama_statusangkatan']; ?>
								</td>
								<?php if ($user['status_user']=="Admin"): ?>
									<td>
										<a type="button" class="btn btn-warning btn-sm btn-editInformasiAngkatan" data-toggle="modal" data-target="#modal_input_data" name="btn-editInformasiAngkatan" data-id_detailangkatan="<?= $angkatan['id_detailangkatan']; ?>">
											Edit
										</a>
									</td>
								<?php endif ?>
							</tr>
							<?php $nomor_detailangkatan++; ?>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- AKhir tabel informasi detail angkatan -->
	</div>
</div>

<!-- Modal -->
<form method="post" action="index.php?page=Input Data">
	<div class="modal fade" id="modal_input_data" tabindex="-1" role="dialog" aria-labelledby="modalInputDataKuliah" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_title_input_data">
						Modal Title
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!-- Mata Kuliah -->
				<div class="modal-body" id="modal-body-tambahMatkul">
					<input type="hidden" name="tambah_id_matkul" value="" id="tambah_id_matkul">
					<div class="form-group">
						<label for="tambah_kode_matkul">Kode Mata Kuliah</label>
						<input type="text" class="form-control" name="tambah_kode_matkul" placeholder="IF160879" id="tambah_kode_matkul" required="true" value="">
					</div>
					<div class="form-group">
						<label for="tambah_nama_matkul">Nama Mata Kuliah</label>
						<input type="text" class="form-control" name="tambah_nama_matkul" placeholder="Algoritma dan Pemrograman" id="tambah_nama_matkul" required="true" value="">
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label for="tambah_sks_matkul">SKS</label>
							<input type="number" class="form-control" name="tambah_sks_matkul"  id="tambah_sks_matkul" min="1" max="6" required="true" placeholder="3" value="">
						</div>
						<div class="form-group col-6">
							<label for="tambah_semester_matkul">Semester</label>
							<input type="number" class="form-control" name="tambah_semester_matkul"  id="tambah_semester_matkul" min="1" max="8" required="true" placeholder="5" value="">
						</div>
					</div>
					<div class="form-group ">
						<label for="tambah_id_kategorimatkul">Kategori</label>
						<select  class="form-control" id="tambah_id_kategorimatkul" name="tambah_id_kategorimatkul" required="true">
							<option value="">- Kategori Mata Kuliah -</option>
							<?php
							$nomor_kategorimatkul = 1;
							$runQueryGetAllDataKategoriMatkul = $objMatkul->getAllDataKategoriMatkul();
							while ($kategorimatkul = $runQueryGetAllDataKategoriMatkul->fetch_assoc()) :
								?>
								<option value="<?= $kategorimatkul['id_kategorimatkul']; ?>"><?= $nomor_kategorimatkul; ?>). <?= $kategorimatkul['nama_kategori']; ?></option>
								<?php $nomor_kategorimatkul++; ?>
							<?php endwhile; ?>
						</select>
					</div>
				</div>
				<!-- Akhir mata kuliah -->
				<!-- Lengkapi informasi matkul -->
				<div class="modal-body" id="modal-body-informasiMatkul">
					<input type="hidden" name="tambah_id_detailmatkul" id="tambah_id_detailmatkul" value="">
					<div id="tab_search_informasi_matkul">
						<div class="form-row ">
							<div class="form-group col-6">
								<label for="search_matkul">
									Cari Mata Kuliah
								</label>
								<input class="form-control mr-sm-2" type="search" placeholder="Sistem Digital" id="search_matkul">
							</div>
							<div class="form-group col-6">
								<label for="search_dosen">
									Cari Dosen
								</label>
								<input class="form-control mr-sm-2" type="search" placeholder="I Gede Santi Astawa, ST., M.Cs" id="search_dosen">
							</div>
						</div>
					</div>
					<div class="form-group ">
						<label for="tambah_detail_id_matkul">
							Pilih Mata Kuliah
						</label>
						<select  class="form-control" id="tambah_detail_id_matkul" name="tambah_detail_id_matkul" required="true" aria-describedby="tambah_detail_id_matkul_help">
							<option value="">- Matkul -</option>
							<?php
							$nomor_matkul = 1;
							$runQueryGetAllDataMatkul = $objMatkul->getAllDataMatkul();
							while ($matkul = $runQueryGetAllDataMatkul->fetch_assoc()):
								?>
								<option value="<?= $matkul['id_matkul']; ?>">
									<?= $nomor_matkul; ?>). <?= $matkul['nama_matkul']; ?>
								</option>
								<?php $nomor_matkul++; ?>
							<?php endwhile; ?>
						</select>
						<small id="tambah_detail_id_matkul_help" class="form-text text-muted">
							Mata kuliah sudah diurutkan dari semester 1 hingga semester 8
						</small>
					</div>
					<div class="form-group ">
						<label for="tambah_detail_id_dosen">
							Dosen Pengampu
						</label>
						<select  class="form-control" id="tambah_detail_id_dosen" name="tambah_detail_id_dosen" required="true" >
							<option value="">- Dosen -</option>
							<?php
							$nomor_dosen = 1;
							$runQueryGetAllDataDosen = $objDosen->getAllDataDosen();
							while ($dosen = $runQueryGetAllDataDosen->fetch_assoc()):
								?>
								<option value="<?= $dosen['id_dosen']; ?>">
									<?= $nomor_dosen; ?>). <?= $dosen['nama_dosen']; ?>
								</option>
								<?= $nomor_dosen++; ?>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="tambah_detail_id_detailangkatan">
							Kelas
						</label>
						<select  class="form-control" id="tambah_detail_id_detailangkatan" name="tambah_detail_id_detailangkatan" required="true" aria-describedby="tambah_detail_id_detailangkatan_help">
							<option value="">- Kelas -</option>
							<?php
							$nomor_kelas = 1;
							$runQueryGetAllDataDetailAngkatanWhereStatusAngkatan = $objAngkatan->getAllDataDetailAngkatanWhereStatusAngkatan("Belum Lulus");
							while ($angkatan = $runQueryGetAllDataDetailAngkatanWhereStatusAngkatan->fetch_assoc()):
								?>
								<option value="<?= $angkatan['id_detailangkatan']; ?>">
									<?= $nomor_kelas; ?>). &nbsp;
									<?= $angkatan['tahun_angkatan']; ?> [Kelas : <?= $angkatan['nama_kelas']; ?> | <?= $angkatan['nama_kategori']; ?>] 
								</option>
								<?php $nomor_kelas++; ?>
							<?php endwhile; ?>
						</select>
						<small id="tambah_detail_id_detailangkatan_help" class="form-text text-muted">
							Angkatan yang ditampilkan hanya yang <strong>Belum Lulus</strong><br>
							-Kelas <strong>K</strong> untuk <strong>Penambangan Data Tekstual</strong><br>
							-Kelas <strong>L</strong> untuk <strong>Penemuan dan Manajemen Pengetahuan</strong><br>
							-Kelas <strong>M</strong> untuk <strong>Temu Kembali Informasi Musik</strong><br>
							-Kelas <strong>N</strong> untuk <strong>Sistem Multimedia</strong><br>
							-Kelas <strong>O</strong> untuk <strong>Keamanan Digital</strong><br>
							-Kelas <strong>P</strong> untuk <strong>Jaringan Sensor Nirkabel</strong><br>
							-Kelas <strong>Q</strong> untuk <strong>Komputasi Cerdas</strong><br>
							-Kelas <strong>R</strong> untuk <strong>Pemrosesan Data Besar dan Manajemen Bisnis</strong><br>
							-Kelas <strong>S</strong> untuk <strong>Pengembangan Aplikasi Multimedia</strong><br>
						</small>
					</div>

				</div>
				<!-- Akhir lengkapi informasi matkul -->
				<!-- Dosen -->
				<div class="modal-body" id="modal-body-tambahDosen">
					<input type="hidden" name="tambah_id_dosen" id="tambah_id_dosen" value="">
					<div class="form-group">
						<label for="tambah_nip_dosen">NIP</label>
						<input type="text" class="form-control" name="tambah_nip_dosen" placeholder="19083 540543 321" id="tambah_nip_dosen" required="true">
					</div>
					<div class="form-group">
						<label for="tambah_nama_dosen">Nama Dosen</label>
						<input type="text" class="form-control" name="tambah_nama_dosen" id="tambah_nama_dosen" required="true" placeholder="Dr. Ir. I Ketut Gede Suhartana, S.Kom., M.Kom">
					</div>
				</div>
				<!-- Akhir Dosen -->
				<!-- Hari -->
				<div class="modal-body" id="modal-body-tambahHari">
					<div class="form-group ">
						<input type="hidden" name="enabled_id_hari" id="enabled_id_hari" value="">
						<label for="tambah_id_hari">Hari</label>
						<select  class="form-control" id="tambah_id_hari" name="tambah_id_hari" required="true">
							<option value="">- Hari -</option>
							<?php
							$runQueryGetAllDataHari = $objWaktu->getAllDataHari();
							while ($hari = $runQueryGetAllDataHari->fetch_assoc()):
								?>
								<option value="<?= $hari['id_hari']; ?>"><?= $hari['nama_hari']; ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group ">
						<label for="tambah_id_status">Status Hari</label>
						<select  class="form-control" id="tambah_id_status" name="tambah_id_status" required="true" aria-describedby="tambah_id_status_help">
							<option value="">- Status Hari -</option>
							<?php
							$runQuerygetAllDataStatus = $objStatus->getAllDataStatus();
							while ($status = $runQuerygetAllDataStatus->fetch_assoc()) :
								?>
								<option value="<?= $status['id_status']; ?>"><?= $status['nama_status']; ?></option>
							<?php endwhile; ?>
						</select>
						<small id="tambah_id_status_help" class="form-text text-muted">
							Pilih <strong>Aktif</strong> jika hari tersebut diadakan perkuliahan
						</small>
					</div>
				</div>
				<!-- Akhir Hari -->
				<!-- Ruangan -->
				<div class="modal-body" id="modal-body-tambahRuangan">
					<input type="hidden" name="tambah_id_ruangan" id="tambah_id_ruangan" value="">
					<div class="form-group">
						<label for="tambah_nama_ruangan">Nama Ruangan</label>
						<input type="text" class="form-control" name="tambah_nama_ruangan" placeholder="Laboratorium Net Centric" id="tambah_nama_ruangan" required="true">
					</div>
					<div class="form-group">
						<label for="tambah_kapasitas_ruangan">Kapasitas</label>
						<input type="number" class="form-control" name="tambah_kapasitas_ruangan" id="tambah_kapasitas_ruangan" required="true" placeholder="30" min="1">
					</div>
					<div class="form-group">
						<label for="tambah_lokasi_ruangan">Lokasi</label>
						<input type="text" class="form-control" name="tambah_lokasi_ruangan" id="tambah_lokasi_ruangan" required="true" placeholder="Kampus Bukit Jimbaran">
					</div>
				</div>
				<!-- Akhir Ruangan -->

				<!-- Interval Jam -->
				<div class="modal-body" id="modal-body-tambahJam">
					<input type="hidden" name="tambah_id_jam" id="tambah_id_jam" value="">
					<div class="form-group ">
						<label for="tambah_kode_jam">Kode Jam</label>
						<input type="text" class="form-control" name="tambah_kode_jam" placeholder="J1,J2,J3,..." id="tambah_kode_jam" required="true">
					</div>
					<div class="form-row">
						<div class="form-group col-4">
							<label for="tambah_jam_mulai">Jam Mulai</label>
							<input type="text" class="form-control" name="tambah_jam_mulai" placeholder="08.30" id="tambah_jam_mulai" required="true">
						</div>
						<div class="form-group col-2">
							<br>
							<h5 class="text-center mt-3">
								-
							</h5>
						</div>
						<div class="form-group col-4">
							<label for="tambah_jam_selesai">Jam Selesai</label>
							<input type="text" class="form-control" name="tambah_jam_selesai" id="tambah_jam_selesai" required="true" placeholder="10.30">
						</div>
						<div class="form-group col-2">
							<label for="tambah_sks_jam">SKS</label>
							<input type="number" class="form-control" name="tambah_sks_jam" id="tambah_sks_jam" required="true" placeholder="3" min="1" max="6">
						</div>
					</div>
					<div id="alert-jam-false" >
						<div class="alert alert-danger" role="alert">
							Inputan jam <strong>tidak valid</strong>. Perhatikan penulisan seperti di contoh dan jangan berikan spasi!
						</div>
					</div>
				</div>
				<!-- Akhir Jam -->

				<!-- Angkatan -->
				<div class="modal-body" id="modal-body-tambahAngkatan">
					<input type="hidden" name="tambah_id_angkatan" id="tambah_id_angkatan" value="">
					<div class="form-group">
						<label for="tambah_tahun_angkatan">Tahun Angkatan</label>
						<input type="number" class="form-control" name="tambah_tahun_angkatan" placeholder="2019" id="tambah_tahun_angkatan" required="true" min="2000" max="2100">
					</div>
					<div class="form-group">
						<label for="tambah_id_statusangkatan">Kelulusan</label>
						<select  class="form-control" id="tambah_id_statusangkatan" name="tambah_id_statusangkatan" required="true" >
							<option value="">- Keterangan -</option>
							<?php
							$runQueryGetAllDataStatusAngkatan = $objAngkatan->getAllDataStatusAngkatan();
							while ( $statusangkatan = $runQueryGetAllDataStatusAngkatan->fetch_assoc()) :
								?>
								<option value="<?= $statusangkatan['id_statusangkatan']; ?>"><?= $statusangkatan['nama_statusangkatan']; ?></option>
							<?php endwhile; ?>
						</select>
					</div>
				</div>
				<!-- Akhir Angkatan -->
				<!-- Lengkapi Informasi Angkatan -->
				<div class="modal-body" id="modal-body-informasiAngkatan">
					<input type="hidden" name="tambah_id_detailangkatan" id="tambah_id_detailangkatan" value="">
					<div class="form-group ">
						<label for="tambah_detail_id_angkatan">Tahun Angkatan</label>
						<select  class="form-control" id="tambah_detail_id_angkatan" name="tambah_detail_id_angkatan" required="true" aria-describedby="tambah_detail_id_angkatan_help">
							<option value="">- Angkatan -</option>
							<?php
							$runQueryGetAllDataAngkatan = $objAngkatan->getAllDataAngkatan();
							while ($angkatan = $runQueryGetAllDataAngkatan->fetch_assoc()):
								?>
								<option value="<?= $angkatan['id_angkatan']; ?>">
									<?= $angkatan['tahun_angkatan']; ?>
									[<?= $angkatan['nama_statusangkatan']; ?>]
								</option>
							<?php endwhile; ?>
						</select>
						<small id="tambah_detail_id_angkatan_help" class="form-text text-muted">
							Pilih tahun angkatan yang <strong>belum lulus</strong>
						</small>
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label for="tambah_detail_id_kelas">Kelas</label>
							<select  class="form-control" id="tambah_detail_id_kelas" name="tambah_detail_id_kelas" required="true" aria-describedby="tambah_detail_id_kelas_help">
								<option value="">- Kelas -</option>
								<?php
								$runQueryGetAllDataKelas = $objKelas->getAllDataKelas();
								while ($kelas = $runQueryGetAllDataKelas->fetch_assoc()):
									?>
									<option value="<?= $kelas['id_kelas']; ?>"><?= $kelas['nama_kelas']; ?></option>
								<?php endwhile; ?>
							</select>
							<small id="tambah_detail_id_kelas_help" class="form-text text-muted">
								Pilih <strong>kelas K,L,M,N,O,P,Q,R,S</strong> untuk angkatan yang mengambil kelas pilihan penjaluran
							</small>
						</div>
						<div class="form-group col-6">
							<label for="tambah_id_statuskelas">Kategori Kelas</label>
							<select  class="form-control" id="tambah_id_statuskelas" name="tambah_id_statuskelas" required="true" aria-describedby="tambah_id_statuskelas_help">
								<option value="">- Status -</option>
								<?php
								$runQueryGetAllDataKategoriKelas = $objMatkul->getAllDataKategoriMatkul();
								while ($status = $runQueryGetAllDataKategoriKelas->fetch_assoc()):
									?>
									<option value="<?= $status['id_kategorimatkul']; ?>">
										<?= $status['nama_kategori']; ?>
									</option>
								<?php endwhile; ?>
							</select>
							<small id="tambah_id_status_help" class="form-text text-muted">
								Sesuaikan kategori kelas masing-masing
							</small>
						</div>
					</div>
					
					<div class="form-group">
						<label for="tambah_peserta_kelas">Peserta Kelas</label>
						<input type="number" class="form-control" name="tambah_peserta_kelas" placeholder="misal : 35" id="tambah_peserta_kelas" required="true" min="10" max="40">
					</div>
				</div>
				<!-- Akhir Lengkapi Informasi Angkatan -->
				<!-- Kelas -->
				<div class="modal-body" id="modal-body-tambahKelas">
					<input type="hidden" name="tambah_id_kelas" id="tambah_id_kelas" value="">
					<div class="form-group ">
						<label for="tambah_nama_kelas">Nama Kelas</label>
						<select  class="form-control" id="tambah_nama_kelas" name="tambah_nama_kelas" required="true">
							<option value="">- Kelas -</option>
							<?php
							$runqueryGetAllDataAlfabetKelas = $objKelas->getAllDataAlfabetKelas();
							while ($alfabet = $runqueryGetAllDataAlfabetKelas->fetch_assoc()) :
								?>
								<option value="<?= $alfabet['nama_kelas']; ?>"><?= $alfabet['nama_kelas']; ?></option>
							<?php endwhile; ?>
						</select>
					</div>
				</div>
				<!-- Akhir Kelas -->
				<!-- Alert for hapus data -->
				<div class="modal-body" id="modal-body-alertHapus">
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<p id="alert-hapus-body">
							Tekan tombol <strong>hapus</strong> untuk menghapus data! Anda tidak bisa mengembalikannya semula. <br>
							<strong>Data-data yang terkait juga akan dihapus</strong>. Perhatikan dengan seksama sebelum menghapus!
						</p>
					</div>
				</div>
				<!-- Akhir alert for hapus data -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-danger" name="alert-hapus-btn-footer"  id="alert-hapus-btn-footer" value="">
						Hapus
					</button>
					<button type="button" class="btn btn-primary" id="btn-submit-modal-input-data" name="btn-submit-modal-input-data" value="">
						Save Change
					</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- End Modal -->

<?php
if (isset($_POST['btn-submit-modal-input-data'])) {
	$isValidInsert = false;
	$msg_error = "";
	if ($_POST['btn-submit-modal-input-data'] == "edit_matkul") {
		$matkul = array();
		$data_matkul = array();
		$matkul['id_matkul'] = $_POST['tambah_id_matkul'];
		$matkul['kode_matkul'] = $_POST['tambah_kode_matkul'];
		$matkul['nama_matkul'] = $_POST['tambah_nama_matkul'];
		$matkul['sks_matkul'] = $_POST['tambah_sks_matkul'];
		$matkul['semester_matkul'] = $_POST['tambah_semester_matkul'];
		$matkul['id_kategorimatkul'] = $_POST['tambah_id_kategorimatkul'];
		//validasi sbelum update matkul untuk mencari nama matkul ataupun kode matkul yang sama
		$runQueryVerifyBeforeUpdateSpesificDataMatkul = $objMatkul->verifyBeforeUpdateSpesificDataMatkul($matkul);
		if ($runQueryVerifyBeforeUpdateSpesificDataMatkul->num_rows != 0) {
			//alert kode matkul atau nama matkul sudah ada
			while ($d_matkul = $runQueryVerifyBeforeUpdateSpesificDataMatkul->fetch_assoc()) {
				$data_matkul = $d_matkul;
			}
			if ($data_matkul['kode_matkul']==$matkul['kode_matkul']) {
				$msg_error = "Kode";
			}
			if ($data_matkul['nama_matkul']==$matkul['nama_matkul']) {
				if (!empty($msg_error)) {
					$msg_error .= " dan ";
				}
				$msg_error .= "Nama";
			}
			$msg_error .= " mata kuliah sudah ada!";
			$objFlash->showSimpleFlash("GAGAL UPDATE MATA KULIAH","error","$msg_error","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			$runQueryUpdateSpesificMatkul = $objMatkul->updateSpesificDataMatkul($matkul);
			if ($runQueryUpdateSpesificMatkul == true) {
				$objFlash->showSimpleFlash("BERHASIL UPDATE","success","Data Mata Kuliah berhasil diupdate!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			}else{
				$objFlash->showSimpleFlash("GAGAL UPDATE MATA KULIAH","error","Data Mata Kuliah gagal diperbarui!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}
		}
		
	}elseif ($_POST['btn-submit-modal-input-data'] == "edit_hari") {
		$hari = array();
		$hari['id_hari'] = $_POST['enabled_id_hari'];
		$hari['id_status'] = $_POST['tambah_id_status'];
		$runQueryUpdateSpesificDataHari = $objWaktu->updateSpesificDataHari($hari);
		if ($runQueryUpdateSpesificDataHari == true) {
			$objFlash->showSimpleFlash("BERHASIL UPDATE","success","Data Hari berhasil diupdate!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
		}else{
			$objFlash->showSimpleFlash("GAGAL UPDATE HARI","error","Data Hari gagal diperbarui!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}
	}elseif ($_POST['btn-submit-modal-input-data'] == "edit_dosen") {
		$dosen = array();
		$data_dosen = array();
		$dosen['id_dosen'] = $_POST['tambah_id_dosen'];
		$dosen['nip_dosen'] = $_POST['tambah_nip_dosen'];
		$dosen['nama_dosen'] = $_POST['tambah_nama_dosen'];
		//validasi data dosen sebelum update jika ada nip dan dosen yang sama
		$runQueryVerifyBeforeUpdateSpesificDataDosen = $objDosen->verifyBeforeUpdateSpesificDataDosen($dosen);
		if ($runQueryVerifyBeforeUpdateSpesificDataDosen->num_rows != 0) {
			//alert kode matkul atau nama matkul sudah ada
			while ($d_dosen = $runQueryVerifyBeforeUpdateSpesificDataDosen->fetch_assoc()) {
				$data_dosen = $d_dosen;
			}
			if ($data_dosen['nip_dosen']==$dosen['nip_dosen']) {
				$msg_error = "NIP";
			}
			if ($data_dosen['nama_dosen']==$dosen['nama_dosen']) {
				if (!empty($msg_error)) {
					$msg_error .= " dan ";
				}
				$msg_error .= "Nama";
			}
			$msg_error .= " dosen sudah ada!";
			$objFlash->showSimpleFlash("GAGAL UPDATE DOSEN","error","$msg_error","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			$runQueryUpdateSpesificDosen = $objDosen->updateSpesificDataDosen($dosen);
			if ($runQueryUpdateSpesificDosen == true) {
				$objFlash->showSimpleFlash("BERHASIL UPDATE","success","Data Dosen berhasil diupdate!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			}else{
				$objFlash->showSimpleFlash("GAGAL UPDATE DOSEN","error","Data Dosen gagal diperbarui!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}
		}
		
	}elseif ($_POST['btn-submit-modal-input-data'] == "edit_ruangan") {
		$ruangan = array();
		$data_ruangan = array();
		$ruangan['id_ruangan'] = $_POST['tambah_id_ruangan'];
		$ruangan['nama_ruangan'] = $_POST['tambah_nama_ruangan'];
		$ruangan['kapasitas_ruangan'] = $_POST['tambah_kapasitas_ruangan'];
		$ruangan['lokasi_ruangan'] = $_POST['tambah_lokasi_ruangan'];
		//validasi sebelum mengupdate ruangan jika ada nama ruangan yang sama
		$runQueryVerifyBeforeUpdateSpesificDataRuangan = $objRuangan->verifyBeforeUpdateSpesificDataRuangan($ruangan);
		if ($runQueryVerifyBeforeUpdateSpesificDataRuangan->num_rows != 0) {
			//alert kode matkul atau nama matkul sudah ada
			while ($d_ruangan = $runQueryVerifyBeforeUpdateSpesificDataRuangan->fetch_assoc()) {
				$data_ruangan = $d_ruangan;
			}
			if ($data_ruangan['nama_ruangan']==$ruangan['nama_ruangan']) {
				$msg_error = "Nama Ruangan sudah ada";
			}
			$objFlash->showSimpleFlash("GAGAL UPDATE RUANGAN","error","$msg_error","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			$runQueryUpdateSpesificRuangan = $objRuangan->updateSpesificDataRuangan($ruangan);
			if ($runQueryUpdateSpesificRuangan == true) {
				$objFlash->showSimpleFlash("BERHASIL UPDATE","success","Data Ruangan berhasil diupdate!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			}else{
				$objFlash->showSimpleFlash("GAGAL UPDATE RUANGAN","error","Data Ruangan gagal diperbarui!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}
		}
	}elseif ($_POST['btn-submit-modal-input-data'] == "edit_jam") {
		$jam = array();
		$data_jam = array();
		$jam_mulai = $_POST['tambah_jam_mulai'];
		$jam_selesai = $_POST['tambah_jam_selesai'];
		$rentang_jam = $jam_mulai."-".$jam_selesai;
		$jam['rentang_jam'] = $rentang_jam;
		$jam['kode_jam'] = $_POST['tambah_kode_jam'];
		$jam['id_jam'] = $_POST['tambah_id_jam'];
		$jam['sks_jam'] = $_POST['tambah_sks_jam'];
		//validasi sebelum melakukan update data jam
		$runQueryVerifyBeforeUpdateSpesificDataJam = $objWaktu->verifyBeforeUpdateSpesificDataJam($jam);
		if ($runQueryVerifyBeforeUpdateSpesificDataJam->num_rows !=0) {
			while ($d_jam = $runQueryVerifyBeforeUpdateSpesificDataJam->fetch_assoc()) {
				$data_jam = $d_jam;
			}
			if ($data_jam['kode_jam'] == $jam['kode_jam']) {
				$msg_error = 'Kode';
			}
			if ($data_jam['rentang_jam'] == $jam['rentang_jam']) {
				if (!empty($msg_error)) {
					$msg_error.= " dan ";
				}
				$msg_error.= "Rentang";
			}
			$msg_error.= " Jam sudah ada!";
			$objFlash->showSimpleFlash("GAGAL UPDATE JAM","error","Rentang jam perkuliahan sudah ada!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			$runQueryUpdateSpesificDataJam = $objWaktu->updateSpesificDataJam($jam);
			if ($runQueryUpdateSpesificDataJam == true) {
				$objFlash->showSimpleFlash("BERHASIL UPDATE","success","Data Jam berhasil diupdate!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			}else{
				$objFlash->showSimpleFlash("GAGAL UPDATE JAM","error","Data Jam gagal diperbarui!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}
		}


	}elseif ($_POST['btn-submit-modal-input-data'] == "edit_angkatan") {
		$angkatan = array();
		$angkatan['id_angkatan'] = $_POST['tambah_id_angkatan'];
		$angkatan['tahun_angkatan'] = $_POST['tambah_tahun_angkatan'];
		$angkatan['id_statusangkatan'] = $_POST['tambah_id_statusangkatan'];
		$runQueryUpdateSpesificAngkatan = $objAngkatan->updateSpesificDataAngkatan($angkatan);
		if ($runQueryUpdateSpesificAngkatan == true) {
			$objFlash->showSimpleFlash("BERHASIL UPDATE","success","Data Angkatan berhasil diupdate!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
		}else{
			$objFlash->showSimpleFlash("GAGAL UPDATE ANGKATAN","error","Data Angkatan gagal diperbarui!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}

	}elseif ($_POST['btn-submit-modal-input-data'] == "edit_informasiangkatan") {
		$angkatan = array();
		$angkatan['id_detailangkatan'] = $_POST['tambah_id_detailangkatan'];
		$angkatan['peserta_kelas'] = $_POST['tambah_peserta_kelas'];
		$runQueryUpdateSpesificDetailAngkatan = $objAngkatan->updateSpesificDetailAngkatan($angkatan);
		if ($runQueryUpdateSpesificDetailAngkatan == true) {
			$objFlash->showSimpleFlash("BERHASIL UPDATE","success","Informasi angkatan berhasil diupdate!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
		}else{
			$objFlash->showSimpleFlash("GAGAL UPDATE ANGKATAN","error","Informasi angkatan gagal diperbarui!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}
	}elseif ($_POST['btn-submit-modal-input-data'] == "edit_informasimatkul") {
		$matkul = array();
		$data_matkul = array();
		$matkul['id_detailmatkul'] = $_POST['tambah_id_detailmatkul'];
		$matkul['id_matkul'] = $_POST['tambah_detail_id_matkul'];
		$matkul['id_dosen'] = $_POST['tambah_detail_id_dosen'];
		$matkul['id_detailangkatan'] = $_POST['tambah_detail_id_detailangkatan'];
		//validasi sebelum mengupdate, untuk id_matkul dan id_detailangkatan jika ada yang sama berarti sudah terdaftar di dalam db
		$runQueryVerifyBeforeUpdateSpesificDataDetailMatkul = $objMatkul->verifyBeforeUpdateSpesificDataDetailMatkul($matkul);
		if ($runQueryVerifyBeforeUpdateSpesificDataDetailMatkul->num_rows !=0) {
			while ($d_matkul = $runQueryVerifyBeforeUpdateSpesificDataDetailMatkul->fetch_assoc()) {
				$data_matkul = $d_matkul;
			}
			$objFlash->showSimpleFlash("GAGAL UPDATE INFORMASI","error","Informasi mata kuliah tersebut sudah ada!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			//cek apakah kategori_matkul sesuai dengan status_kelas yang mengambilnya. Matkul pilihan harus diambil oleh angkatan dengan status_kelas piihan
			$isSameStatusMatkulAndStatusAngkatan = $objMatkul->checkIsSameStatusMatkulAndStatusAngkatan($matkul['id_matkul'],$matkul['id_detailangkatan']);
			if ($isSameStatusMatkulAndStatusAngkatan == false) {
				$objFlash->showSimpleFlash("GAGAL UPDATE INFORMASI","error","Pilih kelas sesuai kategori mata kuliah!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}else{
				$runQueryUpdateSpesificDataDetailMatkul = $objMatkul->updateSpesificDataDetailMatkul($matkul);
				if ($runQueryUpdateSpesificDataDetailMatkul == true) {
					$objFlash->showSimpleFlash("BERHASIL UPDATE","success","Informasi detail mata kuliah berhasil diupdate!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
				}else{
					$objFlash->showSimpleFlash("GAGAL UPDATE INFORMASI","error","Informasi detail mata kuliah gagal diperbarui!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
				}
			}
		}
	}elseif ($_POST['btn-submit-modal-input-data'] == "tambah_jam") {
		$jam = array();
		$jam_mulai = $_POST['tambah_jam_mulai'];
		$jam_selesai = $_POST['tambah_jam_selesai'];
		$rentang_jam = $jam_mulai."-".$jam_selesai;
		$jam['rentang_jam'] = $rentang_jam;
		$jam['kode_jam'] = $_POST['tambah_kode_jam'];
		$jam['sks_jam'] = $_POST['tambah_sks_jam'];
		//cek dulu data dari database jika rentang jam ataupun kode jam sudah ada
		$runqueryCheckIsSameJam = $objWaktu->checkIsSameJam($jam['kode_jam'],$jam['rentang_jam']);
		$data_jam = array();
		if ($runqueryCheckIsSameJam->num_rows != 0) {
			while ($d_jam = $runqueryCheckIsSameJam->fetch_assoc()) {
				$data_jam = $d_jam;
			}
			if ($data_jam['kode_jam']==$jam['kode_jam']) {
				$msg_error = "Kode";
			}
			if ($data_jam['rentang_jam']==$jam['rentang_jam']) {
				if (!empty($msg_error)) {
					$msg_error .= " dan ";
				}
				$msg_error .= "Interval ";
			}
			$msg_error .= " Jam sudah ada!";
			$objFlash->showSimpleFlash("GAGAL INPUT JAM","error","$msg_error","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			//boleh insert new jam
			$runQueryInsertJam = $objWaktu->insertJam($jam);
			if ($runQueryInsertJam==true) {
				$objFlash->showSimpleFlash("BERHASIL INPUT","success","Data Jam berhasil ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			}else{
				$objFlash->showSimpleFlash("GAGAL INPUT JAM","error","Data Jam gagal ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}
		}
	}elseif ($_POST['btn-submit-modal-input-data'] == "tambah_matkul") {
		$matkul = array();
		$matkul['kode_matkul'] = $_POST['tambah_kode_matkul'];
		$matkul['nama_matkul'] = $_POST['tambah_nama_matkul'];
		//validasi sebelum input data baru. Cek jika kode matkul ataupun nama matkul sudah ada di db sebelumnya
		$runqueryCheckIsSameMatkul = $objMatkul->checkIsSameMatkul($matkul['kode_matkul'],$matkul['nama_matkul']);
		$data_matkul = array();
		if ($runqueryCheckIsSameMatkul->num_rows != 0) {
			while ($d_matkul = $runqueryCheckIsSameMatkul->fetch_assoc()) {
				$data_matkul = $d_matkul;
			}
			if ($data_matkul['kode_matkul']==$matkul['kode_matkul']) {
				$msg_error = "Kode";
			}
			if ($data_matkul['nama_matkul']==$matkul['nama_matkul']) {
				if (empty($msg_error)) {
					$msg_error = "Nama";
				}else{
					$msg_error .= " dan nama";
				}
			}
			$msg_error .= " mata kuliah sudah terdaftar!";
			$objFlash->showSimpleFlash("GAGAL INPUT MATA KULIAH","error","$msg_error","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			$matkul['sks_matkul'] = $_POST['tambah_sks_matkul'];
			$matkul['semester_matkul'] = $_POST['tambah_semester_matkul'];
			$matkul['id_kategorimatkul'] = $_POST['tambah_id_kategorimatkul'];
			$runQueryInsertMatkul = $objMatkul->insertMatkul($matkul);
			if ($runQueryInsertMatkul==true) {
				$objFlash->showSimpleFlash("BERHASIL INPUT","success","Data Mata Kuliah berhasil ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			}else{
				$objFlash->showSimpleFlash("GAGAL INPUT MATA KULIAH","error","Data Mata Kuliah gagal ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}
		}
	}elseif ($_POST['btn-submit-modal-input-data'] == "tambah_dosen") {
		$dosen = array();
		$dosen['nip_dosen'] = $_POST['tambah_nip_dosen'];
		$dosen['nama_dosen'] = $_POST['tambah_nama_dosen'];
		//verify data dosen sebelum insert data baru
		$runQueryCheckIsSameDosen = $objDosen->checkIsSameDosen($dosen['nip_dosen'],$dosen['nama_dosen']);
		$data_dosen = array();
		if ($runQueryCheckIsSameDosen->num_rows!=0) {
			while ($d_dosen = $runQueryCheckIsSameDosen->fetch_assoc()) {
				$data_dosen = $d_dosen;
			}
			if ($data_dosen['nip_dosen']==$dosen['nip_dosen']) {
				$msg_error = "NIP";
			}
			if ($data_dosen['nama_dosen']==$dosen['nama_dosen']) {
				if (!empty($msg_error)) {
					$msg_error .= " dan Nama";
				}else{
					$msg_error .= "Nama ";
				}
			}
			$msg_error .= " dosen sudah terdaftar!";
			$objFlash->showSimpleFlash("GAGAL INPUT DOSEN","warning","$msg_error","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			$runQueryInsertDosen = $objDosen->insertDosen($dosen);
			if ($runQueryInsertDosen==true) {
				$objFlash->showSimpleFlash("BERHASIL INPUT","success","Data Dosen berhasil ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			}else{
				$objFlash->showSimpleFlash("GAGAL INPUT DOSEN","error","Data Dosen gagal ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}
		}
	}elseif ($_POST['btn-submit-modal-input-data'] == "tambah_ruangan") {
		$ruangan = array();
		$ruangan['nama_ruangan'] = $_POST['tambah_nama_ruangan'];
		$ruangan['kapasitas_ruangan'] = $_POST['tambah_kapasitas_ruangan'];
		$ruangan['lokasi_ruangan'] = $_POST['tambah_lokasi_ruangan'];
		//verify data ruangan sebelum insert data baru
		$runQueryCheckIsSameRuangan = $objRuangan->checkIsSameRuangan($ruangan['nama_ruangan']);
		$data_ruangan = array();
		if ($runQueryCheckIsSameRuangan->num_rows!=0) {
			while ($d_ruangan = $runQueryCheckIsSameRuangan->fetch_assoc()) {
				$data_ruangan = $d_ruangan;
			}
			if ($data_ruangan['nama_ruangan']==$ruangan['nama_ruangan']) {
				$msg_error = "Nama ruangan tersebut sudah ada!";
			}
			$objFlash->showSimpleFlash("GAGAL INPUT RUANGAN","error","$msg_error","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			$runQueryInsertRuangan = $objRuangan->insertRuangan($ruangan);
			if ($runQueryInsertRuangan==true) {
				$objFlash->showSimpleFlash("BERHASIL INPUT","success","Data Ruangan berhasil ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			}else{
				$objFlash->showSimpleFlash("GAGAL INPUT RUANGAN","error","Data Ruangan gagal ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}
		}
	}elseif ($_POST['btn-submit-modal-input-data'] == "tambah_angkatan") {
		$angkatan = array();
		$angkatan['tahun_angkatan'] = $_POST['tambah_tahun_angkatan'];
		$angkatan['id_statusangkatan'] = $_POST['tambah_id_statusangkatan'];
		//validasi sebelum insert angkatan baru apakah tahun angkatan yang diinputkan sudah ada di dalam db sebelumnya
		$runQueryCheckIsSameAngkatan = $objAngkatan->checkIsSameAngkatan($angkatan['tahun_angkatan']);
		if ($runQueryCheckIsSameAngkatan->num_rows!=0) {
			//alert angkatn tersebut sudah ada
			$objFlash->showSimpleFlash("GAGAL INPUT ANGKATAN","error","Tahun Angkatan tersebut sudah terdaftar!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			//boleh insert new angkatan
			$runQueryInsertAngkatan = $objAngkatan->insertAngkatan($angkatan);
			if ($runQueryInsertAngkatan==true) {
				$objFlash->showSimpleFlash("BERHASIL INPUT","success","Data Angkatan berhasil ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			}else{
				$objFlash->showSimpleFlash("GAGAL INPUT ANGKATAN","error","Data Angkatan gagal ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}
		}
	}elseif ($_POST['btn-submit-modal-input-data'] == "tambah_kelas") {
		$kelas = array();
		$kelas['nama_kelas'] = $_POST['tambah_nama_kelas'];
		//validasi apakah nama kelas sudah ada di dalam db sebelumnya
		$runQueryCheckIsSameKelas = $objKelas->checkIsSameKelas($kelas['nama_kelas']);
		if ($runQueryCheckIsSameKelas->num_rows != 0) {
			$objFlash->showSimpleFlash("GAGAL INPUT KELAS","error","Kelas tersebut sudah terdaftar!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			$runQueryInsertKelas = $objKelas->insertKelas($kelas);
			if ($runQueryInsertKelas==true) {
				$objFlash->showSimpleFlash("BERHASIL INPUT","success","Data Kelas berhasil ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			}else{
				$objFlash->showSimpleFlash("GAGAL INPUT KELAS","error","Data Angkatan gagal ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}
		}
	}elseif ($_POST['btn-submit-modal-input-data'] == "tambah_informasi_angkatan") {
		$angkatan = array();
		$angkatan['id_angkatan']  = $_POST['tambah_detail_id_angkatan']; 
		$angkatan['id_kelas']  = $_POST['tambah_detail_id_kelas']; 
		$angkatan['peserta_kelas'] = $_POST['tambah_peserta_kelas'];
		$angkatan['id_statuskelas'] = $_POST['tambah_id_statuskelas'];
		
		//validasi dulu apakah di dalam db sudah ada data yang sama
		$runQueryCheckIsSameDetailAngkatan = $objAngkatan->checkIsSameDetailAngkatan($angkatan);
		if ($runQueryCheckIsSameDetailAngkatan->num_rows !=0) {
			//alert sudah ada angkatan dan kelas yang sama
			$objFlash->showSimpleFlash("GAGAL MENAMBAHKAN INFORMASI","error","Informasi angkatan dan kelas sudah ada!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			//boleh insert data baru
			$runQueryInsertDetailAngkatan = $objAngkatan->insertDetailAngkatan($angkatan);
			if ($runQueryInsertDetailAngkatan==true) {
				$objFlash->showSimpleFlash("BERHASIL MENAMBAHKAN INFORMASI","success","Informasi angkatan berhasil ditambahkan","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			}else{
				$objFlash->showSimpleFlash("GAGAL MENAMBAHKAN INFORMASI","error","Informasi angkatan gagal ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}
		}
	}elseif ($_POST['btn-submit-modal-input-data'] == "tambah_informasi_matkul") {
		$matkul = array();
		$data_matkul = array();
		$matkul['id_matkul'] = $_POST['tambah_detail_id_matkul'];
		$matkul['id_dosen'] = $_POST['tambah_detail_id_dosen'];
		$matkul['id_detailangkatan'] = $_POST['tambah_detail_id_detailangkatan'];
		//validasi terlebih dahulu apakah matkul dan kelas yang bersangkutan sudah terdaftar di tabel detailmatkul di db
		$runQueryCheckIsSameDetailMatkul = $objMatkul->checkIsSameDetailMatkul($matkul['id_matkul'],$matkul['id_detailangkatan']);
		if ($runQueryCheckIsSameDetailMatkul->num_rows!=0) {
			while ($d_matkul = $runQueryCheckIsSameDetailMatkul->fetch_assoc()) {
				$data_matkul = $d_matkul;
			}
			$objFlash->showSimpleFlash("GAGAL MENAMBAHKAN INFORMASI","error","Informasi mata kuliah dan kelas sudah ada!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}else{
			//cek apakah kategori_matkul sesuai dengan status_kelas yang mengambilnya. Matkul pilihan harus diambil oleh angkatan dengan status_kelas piihan
			$isSameStatusMatkulAndStatusAngkatan = $objMatkul->checkIsSameStatusMatkulAndStatusAngkatan($matkul['id_matkul'],$matkul['id_detailangkatan']);
			if ($isSameStatusMatkulAndStatusAngkatan == false) {
				$objFlash->showSimpleFlash("GAGAL MENAMBAHKAN INFORMASI","error","Pilih kelas sesuai kategori mata kuliah!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
			}else{
				//boleh insert data detailmatkul baru
				$runQueryInsertDetailMatkul = $objMatkul->insertDetailMatkul($matkul);
				if ($runQueryInsertDetailMatkul==true) {
					$objFlash->showSimpleFlash("BERHASIL MENAMBAHKAN INFORMASI","success","Informasi detail mata kuliah berhasil ditambahkan","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
				}else{
					$objFlash->showSimpleFlash("GAGAL MENAMBAHKAN INFORMASI","error","Informasi detail mata kuliah gagal ditambahkan!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
				}
			}
		}
	}
}elseif (isset($_POST['alert-hapus-btn-footer'])) {
	if ($_POST['alert-hapus-btn-footer'] == "hapus_matkul") {
		$id_matkul = $_POST['tambah_id_matkul'];
		$runQueryDeleteSpesificMatkul = $objMatkul->deleteSpesificMatkul($id_matkul);
		if ($runQueryDeleteSpesificMatkul==true) {
			$objFlash->showSimpleFlash("BERHASIL DIHAPUS","success","Data Mata Kuliah berhasil dihapus!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			//setelah didelete trigger after delete akan dijalankan di phpMyAdmin
		}else{
			$objFlash->showSimpleFlash("GAGAL DIHAPUS","error","Data Mata Kuliah gagal dihapus!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}
	}elseif ($_POST['alert-hapus-btn-footer']=="hapus_dosen") {
		$id_dosen = $_POST['tambah_id_dosen'];
		$runQueryDeleteSpesificDosen = $objDosen->deleteSpesificDosen($id_dosen);
		if ($runQueryDeleteSpesificDosen==true) {
			$objFlash->showSimpleFlash("BERHASIL DIHAPUS","success","Data Dosen berhasil dihapus!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			//setelah didelete trigger after delete akan dijalankan di phpMyAdmin
		}else{
			$objFlash->showSimpleFlash("GAGAL DIHAPUS","error","Data Dosen gagal dihapus!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}
	}elseif ($_POST['alert-hapus-btn-footer']=="hapus_ruangan") {
		$id_ruangan = $_POST['tambah_id_ruangan'];
		$runQueryDeleteSpesificRuangan = $objRuangan->deleteSpesificRuangan($id_ruangan);
		if ($runQueryDeleteSpesificRuangan==true) {
			$objFlash->showSimpleFlash("BERHASIL DIHAPUS","success","Data Ruangan berhasil dihapus!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
		}else{
			$objFlash->showSimpleFlash("GAGAL DIHAPUS","error","Data Ruangan gagal dihapus!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}
	}elseif ($_POST['alert-hapus-btn-footer'] == "hapus_jam") {
		$id_jam = $_POST['tambah_id_jam'];
		$runQueryDeleteSpesificJam = $objWaktu->deleteSpesificJam($id_jam);
		if ($runQueryDeleteSpesificJam==true) {
			$objFlash->showSimpleFlash("BERHASIL DIHAPUS","success","Data Jam berhasil dihapus!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
		}else{
			$objFlash->showSimpleFlash("GAGAL DIHAPUS","error","Data Jam gagal dihapus!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}
	}elseif ($_POST['alert-hapus-btn-footer'] == "hapus_angkatan") {
		$id_angkatan = $_POST['tambah_id_angkatan'];
		$runQueryDeleteSpesificAngkatan = $objAngkatan->deleteSpesificAngkatan($id_angkatan);
		if ($runQueryDeleteSpesificAngkatan==true) {
			$objFlash->showSimpleFlash("BERHASIL DIHAPUS","success","Data Angkatan berhasil dihapus!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			//buat trigger after delete angkatan maka hapus tabel detail angkatan selanjutnya after delete tabel detail angkatan maka hapus tabel detailmatkul
		}else{
			$objFlash->showSimpleFlash("GAGAL DIHAPUS","error","Data Angkatan gagal dihapus!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}
	}elseif ($_POST['alert-hapus-btn-footer'] == "hapus_informasiangkatan") {
		$id_detailangkatan = $_POST['tambah_id_detailangkatan'];
		//deleting table detail angkatan
		$runQueryDeleteSpesificDetailAngkatan = $objAngkatan->deleteSpesificDetailAngkatan($id_detailangkatan);
		if ($runQueryDeleteSpesificDetailAngkatan==true) {
			$objFlash->showSimpleFlash("BERHASIL DIHAPUS","success","Informasi angkatan berhasil dihapus!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			//trigger after delete table detailangkatan akan dijalankan dari phpMyAdmin. Setelah table detailangkatan dihapus maka hapus tabel detailmatkul
		}else{
			$objFlash->showSimpleFlash("GAGAL HAPUS INFORMASI ANGKATAN","error","Informasi angkatan gagal dihapus!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}
	}elseif ($_POST['alert-hapus-btn-footer'] == "hapus_kelas") {
		$id_kelas = $_POST['tambah_id_kelas'];
		$runQueryDeleteSpesificKelas = $objKelas->deleteSpesificKelas($id_kelas);
		if ($runQueryDeleteSpesificKelas==true) {
			$objFlash->showSimpleFlash("BERHASIL DIHAPUS","success","Data Kelas berhasil dihapus!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
			//buat trigger after delete kelas di phpMyAdmin after delete tabel kelas maka delete table detailangkatan
		}else{
			$objFlash->showSimpleFlash("GAGAL DELETE KELAS","error","Data Kelas gagal dihapus!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}
	}elseif ($_POST['alert-hapus-btn-footer'] == "hapus_informasimatkul") {
		$id_detailmatkul = $_POST['tambah_id_detailmatkul'];
		$runQueryDeleteSpesificDetailMatkul = $objMatkul->deleteSpesificDetailMatkul($id_detailmatkul);
		if ($runQueryDeleteSpesificDetailMatkul==true) {
			$objFlash->showSimpleFlash("BERHASIL DIHAPUS","success","Informasi mata kuliah berhasil dihapus!","index.php?page=Input Data",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Kembali");
		}else{
			$objFlash->showSimpleFlash("GAGAL DIHAPUS","error","Informasi mata kuliah gagal dihapus!","index.php?page=Input Data",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
		}
	}
}


?>