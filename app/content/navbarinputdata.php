<ul class="navbar-nav ml-auto">
	<?php if ($user['status_user'] == "Admin") : ?>
		<li class="nav-item ">
			<!-- Button trigger modal -->
			<div class="row">
				<div class="col">
					<a class="nav-link" role="button" id="btn-matkul">
						<i class="fa fa-caret-up collapse" aria-hidden="true" id="top-ico-matkul"></i>&nbsp;
						Mata Kuliah &nbsp;
						<i class="fa fa-caret-down" aria-hidden="true" id="down-ico-matkul"></i>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div id="sub-matkul" class="collapse">
						<a type="button" class="nav-link" data-toggle="modal" data-target="#modal_input_data" id="btn-tambahMatkul">
							Tambah Mata Kuliah
						</a>
						<a type="button" class="nav-link" data-toggle="modal" data-target="#modal_input_data" id="btn-informasiMatkul">
							Lengkapi Informasi Mata Kuliah
						</a>
					</div>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<a type="button" class="nav-link" data-toggle="modal" data-target="#modal_input_data" id="btn-tambahDosen">
				Dosen
			</a>
		</li>
		<li class="nav-item ">
			<a type="button" class="nav-link" data-toggle="modal" data-target="#modal_input_data" id="btn-tambahRuangan">
				Ruangan
			</a>
		</li>
		<li class="nav-item">
			<a type="button" class="nav-link" data-toggle="modal" data-target="#modal_input_data" id="btn-tambahJam">
				Jam
			</a>
		</li>
		<li class="nav-item ">
			<div class="row ">
				<div class="col">
					<a class="nav-link" role="button" id="btn-angkatan">
						<i class="fa fa-caret-up collapse" aria-hidden="true" id="top-ico-angkatan"></i>&nbsp;
						Angkatan &nbsp;
						<i class="fa fa-caret-down" aria-hidden="true" id="down-ico-angkatan"></i>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div id="sub-angkatan" class="collapse">
						<a type="button" class="nav-link" data-toggle="modal" data-target="#modal_input_data" id="btn-tambahAngkatan">
							Tambah Angkatan
						</a>
						<a type="button" class="nav-link" data-toggle="modal" data-target="#modal_input_data" id="btn-tambahKelas">
							Tambah Kelas
						</a>
						<a type="button" class="nav-link" data-toggle="modal" data-target="#modal_input_data" id="btn-informasiAngkatan">
							Lengkapi Informasi Angkatan
						</a>
					</div>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<a type="button" class="nav-link" data-toggle="modal" data-target="#modal_input_data" id="btn-informasiMatkul">
				Lengkapi Informasi Mata Kuliah
			</a>
		</li>
	<?php endif ?>
</ul>