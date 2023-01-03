<?php
require_once '../templates/headermain.php';
if (!isset($_SESSION['user'])) {
	$objFlash->showSimpleFlash("LOGIN", "error", "Silahkan login untuk dapat melanjutkan!", "login.php", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Login");
	exit();
}
$user = $_SESSION['user'];
?>

<!-- Wrapper Sidebar -->
<div id="wrapper">
	<!-- Sidebar -->
	<div id="sidebar-wrapper">
		<ul class="sidebar-nav">
			<li class="logo-brand">
				<img src="<?= URL; ?>assets/img/logounud.png" alt="Logo Unud" class="">
			</li>
			<li class="logo-brand">
				<h4>
					Universitas Udayana
				</h4>
			</li>
			<p style="margin-top: 3.5rem;"></p>
			<li>
				<a href="index.php">
					<i class="fa fa-home " aria-hidden="true"></i>&nbsp;
					Home
				</a>
			</li>
			<li>
				<a id="btn-inputdata" role="button" href="index.php?page=Input Data">
					<i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;Input Data
				</a>
			</li>
			<li>
				<a id="btn-prosesgenetika" role="button">
					<i class="fa fa-spinner" aria-hidden="true"></i>&nbsp;Proses Genetika
				</a>
				<div class="container">
					<div id="prosesgenetika-subitem" class="collapse  list-group">
						<a href="index.php?page=Proses Genetika#susunan_kromosom" class="list-group-item">
							Susunan Kromosom
						</a>
						<a href="index.php?page=Proses Genetika#proses_crossover" class="list-group-item">
							Proses Cross Over
						</a>
						<a href="index.php?page=Proses Genetika#mutasi_kromosom" class="list-group-item">
							Mutasi
						</a>
						<a href="index.php?page=Proses Genetika#seleksi_kromosom" class="list-group-item">
							Seleksi Kromosom
						</a>
					</div>
				</div>
			</li>
			<li>
				<a href="index.php?page=Grafik Perbandingan">
					<i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;Grafik Perbandingan
				</a>
			</li>
			<li>
				<a href="index.php?page=Hasil Optimasi">
					<i class="fa fa-table" aria-hidden="true"></i>&nbsp;
					Hasil Optimasi
				</a>
			</li>
		</ul>
	</div>
	<!-- End Sidebar -->

	<!-- Page Content -->
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
					<button class="btn" id="sidebar-toggle">
						<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-layout-sidebar-inset" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M14 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zM2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2z" />
							<path d="M3 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z" />
						</svg>
					</button>
					<a class="navbar-brand" href="#">
						Teknik Informatika
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<?php
						if (isset($_GET['page'])) {
							if ($_GET['page'] == "Input Data") {
								require_once 'navbarinputdata.php';
							} elseif ($_GET['page'] == "Proses Genetika" || $_GET['page'] == "Hasil Optimasi" || $_GET['page'] == "Grafik Perbandingan") {
								require_once 'navbarprosesgenetika.php';
							}
						} else {
							$id_user = $user['id_user'];
							//for ajax profile user
							echo "<input type='hidden' name='id_user' id='id_user' value='$id_user'>";
							require_once 'navbarhome.php';
						}
						?>
					</div>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<?php
				if (isset($_GET['page'])) {
					if ($_GET['page'] == "Input Data") {
						require_once 'inputdata.php';
					} elseif ($_GET['page'] == "Proses Genetika") {
						require_once 'prosesgenetika.php';
					} elseif ($_GET['page'] == "Hasil Optimasi") {
						require_once 'hasiloptimasi.php';
					} elseif ($_GET['page'] == "Grafik Perbandingan") {
						require_once 'grafikperbandingan.php';
					} elseif ($_GET['page'] == "Test") {
						require_once 'test.php';
					}
				} else {
					require_once 'home.php';
				}
				?>
			</div>
		</div>
	</div>
	<!-- End Page Content -->
</div>
<!-- End Wrapper Sidebar -->

<!-- Modal Proses Genetika Generate Jadwal-->
<form method="post" action="index.php?page=Hasil Optimasi">
	<div class="modal fade" id="modal_proses_genetika" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_proses_genetikaLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_proses_genetika_title">Course Generate using Genetic Algorithm</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="modal-body-generateJadwal">
					<div class="form-group">
						<label for="tambah_maximum_generasi">
							Maximum Generations
						</label>
						<input type="number" class="form-control" id="tambah_maximum_generasi" placeholder="100" aria-describedby="tambah_maximum_generasi_help" required="true" name="tambah_maximum_generasi">
						<small id="tambah_maximum_generasi_help" class="form-text text-muted">Enter a minimum of 200 or a maximum of 800 generations</small>
					</div>
					<div class="form-group">
						<label for="tambah_jumlah_kromosom">
							Number of Chromosomes
						</label>
						<input type="number" class="form-control" id="tambah_jumlah_kromosom" placeholder="1000" aria-describedby="tambah_jumlah_kromosom_help" required="true" name="tambah_jumlah_kromosom">
						<small id="tambah_jumlah_kromosom_help" class="form-text text-muted">Enter a minimum of 200 or a maximum of 1500 generations</small>
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label for="tambah_probabilitas_cross_over">
								Crossover Rate
							</label>
							<input type="number" step="0.01" class="form-control" id="tambah_probabilitas_cross_over" min="0.5" max="1" placeholder="0.5" aria-describedby="tambah_probabilitas_cross_over_help" required="true" name="tambah_probabilitas_cross_over">
							<small id="tambah_probabilitas_cross_over_help" class="form-text text-muted">
								Enter a minimum of 0.5 or a maximum of 1
							</small>
						</div>
						<div class="form-group col-6">
							<label for="tambah_probabilitas_mutasi">Mutation Rate</label>
							<input type="number" step="0.01" class="form-control" id="tambah_probabilitas_mutasi" min="0.1" max="0.3" placeholder="0.1" aria-describedby="tambah_probabilitas_mutasi_help" required="true" name="tambah_probabilitas_mutasi">
							<small id="tambah_probabilitas_mutasi_help" class="form-text text-muted">Enter minimum 0.1 or maximum 0.3</small>
						</div>
					</div>
					<div class="form-group">
						<label for="tambah_semester">Semester Schedule</label>
						<select class="form-control" id="tambah_semester" required="true" name="tambah_semester">
							<option value="">- Semester -</option>
							<option value="ganjil">Odd Semester</option>
							<option value="genap">Even Semester</option>
						</select>
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<input type="radio" name="tambah_metode_cross_over" value="npoint" checked="">
									</div>
								</div>
								<input type="text" class="form-control" value="N Point Cross Over" readonly="true">
							</div>
						</div>
						<div class="form-group col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<input type="radio" name="tambah_metode_cross_over" value="cycle">
									</div>
								</div>
								<input type="text" class="form-control" value="Cycle Cross Over" readonly="true">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name="btn-submit-modal-proses-genetika" id="btn-submit-modal-proses-genetika" value="">
						Generate
					</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- End Modal -->
<?php require_once '../templates/footermain.php' ?>