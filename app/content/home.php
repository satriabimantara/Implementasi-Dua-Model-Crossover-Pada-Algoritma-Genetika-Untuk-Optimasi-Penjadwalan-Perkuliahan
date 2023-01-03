<div class="row">
	<div class="col-12">
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">
					Sistem Optimasi Ruangan Perkuliahan
				</h1>
				<p class="lead">
					Program Studi Teknik Informatika, Fakultas Matematika dan Ilmu Pengetahuan Alam
				</p>
				<p class="lead">
					Universitas Udayana
				</p>
				<p class="lead">
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-toggle="modal" data-target="#modal_proses_genetika" id="btn-generateJadwal">
						Generate Jadwal
					</button>
				</p>
			</div>
		</div>
	</div>
</div>
<!-- Modal For Navbar Home -->

<form method="post" action="index.php">
	<div class="modal fade" id="modal_navbar_home" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_title_navbar_home" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_title_navbar_home">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!-- Modal Body Profile -->
				<div class="modal-body" id="modal-body-profile">
					<input type="hidden" name="id_user_modal" id="id_user_modal" value="">
					<input type="hidden" name="username_user_lama" id="username_user_lama" value="">
					<input type="hidden" name="hp_user_lama" id="hp_user_lama" value="">
					<input type="hidden" name="password_user_lama" id="password_user_lama" value="">
					<input type="hidden" name="email_user_lama" id="email_user_lama" value="">
					<div class="form-row">
						<div class="form-group col-8">
							<label for="nama_user_baru">Nama</label>
							<input type="text" class="form-control" name="nama_user_baru" id="nama_user_baru" required="true" value="">
						</div>
						<div class="form-group col-4">
							<label for="status_user">Status</label>
							<input type="text" class="form-control" name="status_user" id="status_user" readonly="true" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="email_user_baru">Email</label>
						<input type="email" class="form-control" name="email_user_baru" id="email_user_baru" required="true" value="">
					</div>
					<div class="form-group">
						<label for="hp_user_baru">Nomor Handphone</label>
						<input type="text" class="form-control" name="hp_user_baru" id="hp_user_baru" required="true" value="" minlength="12" maxlength="12">
					</div>
					<div class="form-group">
						<label for="username_user_baru">Username</label>
						<input type="text" class="form-control" name="username_user_baru" id="username_user_baru" required="true" value="" aria-describedby="username_user_help">
						<small id="username_user_help" class="form-text text-muted">Hanya diisi jika ingin mengganti username</small>
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label for="password_user_baru">Password Baru</label>
							<input type="password" class="form-control" name="password_user_baru" id="password_user_baru" required="true" value="">
						</div>
						<div class="form-group col-6">
							<label for="repeat_password_user_baru">Ulangi Password Baru</label>
							<input type="password" class="form-control" name="repeat_password_user_baru" id="repeat_password_user_baru" required="true" value="">
						</div>
					</div>
				</div>
				<!-- Akhir Modal Body Profile -->
				<!-- Modal Body Logout -->
				<div class="modal-body" id="modal-body-logout">
					<div class="alert alert-danger" role="alert">
						Anda yakin ingin keluar dari Sistem Penjadwalan? <br>
						Tekan tombol "<strong>Logout</strong>" untuk mengonfirmasinya!
					</div>
				</div>
				<!-- AKhir Modal Body Logout -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="btn-submit-modal-navbar-home" name="btn-submit-modal-navbar-home">Edit</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- End Modal Navbar Home -->
<?php
if (isset($_POST['btn-submit-modal-navbar-home'])) {
	if ($_POST['btn-submit-modal-navbar-home'] == "edit_profile") {
		$data_user = array();
		$id_user_modal = $_POST['id_user_modal'];
		$username_user_lama = $_POST['username_user_lama'];
		$password_user_lama = $_POST['password_user_lama'];
		$hp_user_lama = $_POST['hp_user_lama'];
		$email_user_lama = $_POST['email_user_lama'];
		$nama_user_baru = $_POST['nama_user_baru'];
		$username_user_baru = $_POST['username_user_baru'];
		$password_user_baru = $_POST['password_user_baru'];
		$repeat_password_user_baru = $_POST['repeat_password_user_baru'];
		$hp_user_baru = $_POST['hp_user_baru'];
		$email_user_baru = $_POST['email_user_baru'];
		$data_user['id_user'] = $id_user_modal;
		$data_user['nama_user'] = $nama_user_baru;
		$data_user['email_user'] = $email_user_baru;
		$data_user['username_user'] = $username_user_baru;
		$data_user['hp_user'] = $hp_user_baru;
		//cek apakah user mencoba mengganti akun email, username, password dan hp
		if (($username_user_baru != "" && $password_user_baru != "" && $repeat_password_user_baru != "") || ($email_user_lama != $email_user_baru) || ($hp_user_lama != $hp_user_baru)) {
			//verifikasi di db apakah sudah ada akun yang sama
			$runQueryCheckIsSameUser = $objUser->checkIsSameUser($data_user, "spesific");
			if ($runQueryCheckIsSameUser->num_rows != 0) {
				$objFlash->showSimpleFlash("AKUN SUDAH TERDAFTAR", "error", "Periksa email, username, dan nomor HP. Akun tersebut sudah ada!", "index.php", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Kembali");
				exit();
			}
		}
		if ($password_user_baru != $repeat_password_user_baru) {
			//alert password tidak sama
			$objFlash->showSimpleFlash("PASSWORD TIDAK SAMA", "warning", "Masukkan password yang sama dua kali!", "index.php", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Kembali");
		} else {
			if (password_verify($password_user_baru, $password_user_lama) && ($username_user_lama == $username_user_baru)) {
				$objFlash->showSimpleFlash("PASSWORD BARU", "warning", "Masukkan password yang berbeda dari password yang sebelumnya!", "index.php", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Kembali");
			} else {
				$data_user['password_user'] = password_hash($password_user_baru, PASSWORD_DEFAULT);
				//update data user
				$runQueryUpdateSpesificDataUser = $objUser->updateSpesificDataUser($data_user);
				if ($runQueryUpdateSpesificDataUser == true) {
					$objFlash->showSimpleFlash("BERHASIL UPDATE", "success", "Profile user berhasil diperbarui", "index.php", $confirmButtonColor = "#4BB543", $cancelButtonColor = "#d33", "Kembali");
				} else {
					$objFlash->showSimpleFlash("GAGAL UPDATE", "error", "Profile user gagal diperbarui", "index.php", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Kembali");
				}
			}
		}
	} elseif ($_POST['btn-submit-modal-navbar-home'] == "logout") {
		session_destroy();
		$objFlash->showSimpleFlash("BERHASIL LOGOUT", "success", "Anda telah berhasil keluar dari Sistem Penjadwalan!", "login.php", $confirmButtonColor = "#4BB543", $cancelButtonColor = "#d33", "Logout");
	}
}

?>