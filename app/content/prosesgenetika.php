<?php
if (isset($_SESSION['btn-submit-modal-proses-genetika'])) {
	//session akan dihancurkan setelah 1 jam
	if (isset($_SESSION['time_stamp']) && time()-$_SESSION['time_stamp']>3600) {
		session_destroy();
		session_start();
		$objFlash->showSimpleFlash("EXPIRED","warning","Waktu telah kadaluarsa. Silahkan generate ulang jadwal","index.php",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
	}else{
		//Fungsi untuk menentukan apakah interval jam 2 sks berada di dalam interval jam 3 sks
		function cekIntervalJam($rentang_jam_pembanding,$rentang_jam_dibandingkan){
			$returnValue = 0; 
		//explode pembanding
			$rentang_jam_pembanding = explode('-', $rentang_jam_pembanding);
		//explode dibandingkan
			$rentang_jam_dibandingkan = explode('-', $rentang_jam_dibandingkan);
			if ( (($rentang_jam_dibandingkan[0] >= $rentang_jam_pembanding[0]) && ($rentang_jam_dibandingkan[0] <= $rentang_jam_pembanding[1])) || (($rentang_jam_dibandingkan[1] >= $rentang_jam_pembanding[0]) && ($rentang_jam_dibandingkan[1] <= $rentang_jam_pembanding[1])) ) {
				$returnValue=1;
			}
			return $returnValue;
		}
		$kromosom = array();
		$kromosom = $_SESSION['kromosom_awal'];
		$jumlah_kromosom = $_SESSION['parameter']['jumlah_kromosom'];
		$maximum_generasi = $_SESSION['parameter']['maximum_generasi'];
		$probabilitas_cross_over = $_SESSION['parameter']['probabilitas_cross_over'];
		$probabilitas_mutasi = $_SESSION['parameter']['probabilitas_mutasi'];
		$metode_cross_over = $_SESSION['parameter']['metode_cross_over'];
		$semester = $_SESSION['parameter']['semester'];
		$banyakGen = $_SESSION['parameter']['banyakGen'];
		$indeks_awal_3_wajib = $_SESSION['indeks_matkul']['indeks_awal_3_wajib'];
		$indeks_akhir_3_wajib = $_SESSION['indeks_matkul']['indeks_akhir_3_wajib'];
		$indeks_awal_3_pilihan = $_SESSION['indeks_matkul']['indeks_awal_3_pilihan'];
		$indeks_akhir_3_pilihan = $_SESSION['indeks_matkul']['indeks_akhir_3_pilihan'];
		$indeks_awal_2_wajib = $_SESSION['indeks_matkul']['indeks_awal_2_wajib'];
		$indeks_akhir_2_wajib = $_SESSION['indeks_matkul']['indeks_akhir_2_wajib'];
		$indeks_awal_1_praktikum = $_SESSION['indeks_matkul']['indeks_awal_1_praktikum'];
		$indeks_akhir_1_praktikum = $_SESSION['indeks_matkul']['indeks_akhir_1_praktikum'];

		$data_matkul = $_SESSION['data_matkul']; 
		$data_hari = $_SESSION['data_hari']; 
		$data_jam = $_SESSION['data_jam']; 
		$data_ruangan = $_SESSION['data_ruangan']; 
	}
}else{
	//pesan jadwal belum ada yang digenerate
	$objFlash->showSimpleFlash("JADWAL BELUM DIGENERATE!","error","Belum ada informasi jadwal hasil optimasi! Silahkan generate jadwal terlebih dahulu","index.php",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
	exit();
}
?>
<!-- Susunan Kromosom -->
<div class="row mb-2">
	<div class="col">
		<h4 class="display-4" id="susunan_kromosom">
			Susunan Kromosom
		</h4>
		<div class="table-responsive">
			<table class="table table-bordered cell-border" id="table_susunan_kromosom">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Index</th>
						<?php
						$batas_tampil_gen_max = 115;
						for ($indeks_gen=0; $indeks_gen < $batas_tampil_gen_max; $indeks_gen++) { 
							if ($indeks_gen == $batas_tampil_gen_max-1) {
								echo "<th scope='col'>...</th>";
							}else{
								echo "<th scope='col'>Gen-$indeks_gen</th>";
							}
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($indeks_baris=0; $indeks_baris < count($kromosom) + 3; $indeks_baris++) { 
						echo "<tr>";
						echo "<th scope='row' >".($indeks_baris+1)."</th>";
						for ($indeks_kolom=0; $indeks_kolom < $batas_tampil_gen_max+1; $indeks_kolom++) { 
							if ($indeks_baris==0) {
								if ($indeks_kolom==0) {
									echo "<th scope='row'> Mata Kuliah</th>";
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max-1) {
									echo "<td>";
									echo $data_matkul[$indeks_kolom-1]['nama_matkul'];
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max) {
									echo "<td >...</td>";
								}
							}elseif ($indeks_baris==1) {
								if ($indeks_kolom==0) {
									echo "<th scope='row'> Dosen</th>";
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max-1) {
									echo "<td>";
									echo $data_matkul[$indeks_kolom-1]['nama_dosen'];
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max) {
									echo "<td >...</td>";
								}
							}elseif ($indeks_baris==2) {
								if ($indeks_kolom==0) {
									echo "<th scope='row'> Kelas</th>";
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max-1) {
									echo "<td>";
									echo $data_matkul[$indeks_kolom-1]['tahun_angkatan']."-".$data_matkul[$indeks_kolom-1]['nama_kelas']."-".$data_matkul[$indeks_kolom-1]['nama_kategori'];
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max) {
									echo "<td >...</td>";
								}
							}else{
								if ($indeks_kolom==0) {
									echo "<th scope='row'> Kromosom ke-".($indeks_baris-2)."</th>";
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max-1) {
									echo "<td>";
									echo "[".$kromosom[$indeks_baris-3][$indeks_kolom-1][0]['nama_hari']."]"."<br>";
									echo "[".$kromosom[$indeks_baris-3][$indeks_kolom-1][1]['rentang_jam']."]"."<br>";
									echo "[".$kromosom[$indeks_baris-3][$indeks_kolom-1][2]['nama_ruangan']."]"."<br>";
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max) {
									echo "<td >...</td>";
								}
							}
						}
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Akhir susunan kromosom -->

<!-- Proses Cross Over -->
<?php
/* 2. Cross Over*/
//- 2.1 Memilih Induk yang akan kawin
$induk_kromosom_terpilih = array(); 
$indeks_induk_kromosom_terpilih = 0;
$bilangan_random_setiap_kromosom = array();
$banyak_crossOver = $probabilitas_cross_over * $jumlah_kromosom;
$banyak_crossOver = round($banyak_crossOver);
if ($banyak_crossOver%2==1) {
	$banyak_crossOver--;
}
$count_banyak_crossOver = 0;
while ($count_banyak_crossOver!=$banyak_crossOver) {
	$random_indeks_kromosom = rand(0,$jumlah_kromosom-1);
	if (!in_array($random_indeks_kromosom, $induk_kromosom_terpilih)) {
		$bilangan_random_setiap_kromosom[$random_indeks_kromosom] = mt_rand() / mt_getrandmax(); 
		if ($bilangan_random_setiap_kromosom[$random_indeks_kromosom] < $probabilitas_cross_over) {
			$induk_kromosom_terpilih[$indeks_induk_kromosom_terpilih] = $random_indeks_kromosom;
			$indeks_induk_kromosom_terpilih++;
			$count_banyak_crossOver++;
		}
	}
}
//- Akhir 2.1 memilih induk yang akan kawin
$nomor_table_cross_over = 0;


//- 2.2 Menentukan kromosom anak hasil persilangan metode N POINT
$kromosom_anak_hasil_cross_over = array();
for ($indeks_induk=0; $indeks_induk < count($induk_kromosom_terpilih); $indeks_induk+=2){
	$posisi_gen_1 = rand(1,$banyakGen-2);
	$posisi_gen_2 = rand(1,$banyakGen-2);
	if ($posisi_gen_2 < $posisi_gen_1) {
		$temp = $posisi_gen_2;
		$posisi_gen_2 = $posisi_gen_1;
		$posisi_gen_1 = $temp;
	}
	// KETURUNAN KE - 1
	$indeks_kromosom_anak = 0;
	$kromosom_anak_hasil_cross_over[$indeks_kromosom_anak] = array();
	//masukkan data-data gen pada indeks sebelum posisi_gen_1 ke dalam kromosom_anak ke-1
	for ($indeksGen=0; $indeksGen < $posisi_gen_1; $indeksGen++) { 
		array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk]][$indeksGen]);
	}
	//masukkan data-data gen diantara posisi_gen_1 dan posisi_gen_2 induk setelahnya ke dalam kromosom_anak ke-1
	for ($indeksGen=$posisi_gen_1; $indeksGen < $posisi_gen_2; $indeksGen++) { 
		array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk+1]][$indeksGen]);
	}
	//masukkan data-data gen dari posisi_gen_2 sampai akhir panjang gen ke dalam kromosom_anak ke-1
	for ($indeksGen=$posisi_gen_2; $indeksGen < $banyakGen; $indeksGen++) { 
		array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk]][$indeksGen]);
	}
	//push kromosom anak ke dalam array kromosom
	array_push($kromosom, $kromosom_anak_hasil_cross_over[$indeks_kromosom_anak]);

	// KETURUNAN KE - 2
	$indeks_kromosom_anak++;
	$kromosom_anak_hasil_cross_over[$indeks_kromosom_anak] = array();
	//masukkan data-data gen pada indeks sebelum posisi_gen_1 ke dalam kromosom_anak ke-2
	for ($indeksGen=0; $indeksGen < $posisi_gen_1; $indeksGen++) { 
		array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk+1]][$indeksGen]);
	}
	//masukkan data-data gen diantara posisi_gen_1 dan posisi_gen_2 induk sebelumnya ke dalam kromosom_anak ke-i
	for ($indeksGen=$posisi_gen_1; $indeksGen < $posisi_gen_2; $indeksGen++) { 
		array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk]][$indeksGen]);
	}
	//masukkan data-data gen dari posisi_gen_2 sampai akhir panjang gen ke dalam kromosom_anak ke-2
	for ($indeksGen=$posisi_gen_2; $indeksGen < $banyakGen; $indeksGen++) { 
		array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk+1]][$indeksGen]);
	}
	//push kromosom anak ke dalam array kromosom_baru
	array_push($kromosom, $kromosom_anak_hasil_cross_over[$indeks_kromosom_anak]);
}
//- Akhir 2.2 Menentukan kromosom anak hasil cross over

?>
<!-- Proses Cross Over -->
<div class="row mb-2">
	<div class="col">
		<h4 class="display-4" id="proses_crossover">
			Proses Cross Over
		</h4>
		<div class="table-responsive">
			<table class="table table-bordered" id="table_proses_crossover" >
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Kromosom Anak</th>
						<th scope="col" style="width: 100%">Persilangan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($indeks_induk=0; $indeks_induk < count($induk_kromosom_terpilih); $indeks_induk+=2) { 
						$nomor_table_cross_over++;
						echo "<tr>";
						echo "<th scope='row'>$nomor_table_cross_over</th>";
						echo "<td>Kromosom Anak ke-".$nomor_table_cross_over."</td>";
						echo "<td>Kromosom Induk ke-".$induk_kromosom_terpilih[$indeks_induk]." >< Kromosom Induk ke-".$induk_kromosom_terpilih[$indeks_induk+1]."</td>";
						echo "</tr>";
						$nomor_table_cross_over++;
						echo "<tr>";
						echo "<th scope='row'>$nomor_table_cross_over</th>";
						echo "<td>Kromosom Anak ke-".$nomor_table_cross_over."</td>";
						echo "<td>Kromosom Induk ke-".$induk_kromosom_terpilih[$indeks_induk]." >< Kromosom Induk ke-".$induk_kromosom_terpilih[$indeks_induk+1]."</td>";
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Akhir proses Cross Over -->

<!-- Mutasi -->
<?php
/* 3. Mutasi Gen*/
$total_kromosom_setelah_cross_over = count($kromosom);
$loop_mutasi = $probabilitas_mutasi * $jumlah_kromosom;
$loop_mutasi = round($loop_mutasi);

$kromosom_mutasi = array(); 
$array_indeks_kromosom_dimutasi = array();
$array_indeks_gen_dimutasi = array();

for ($indeks_loop_mutasi=0; $indeks_loop_mutasi < $loop_mutasi; $indeks_loop_mutasi++) { 
	//Bangkitkan bilangan acak untuk menentukan kromosom dan gen mana yang akan kena mutasi
	$indeks_kromosom_dimutasi = rand(0,$total_kromosom_setelah_cross_over-1);
	array_push($array_indeks_kromosom_dimutasi, $indeks_kromosom_dimutasi);
	$indeks_gen_dimutasi = rand(0,$banyakGen-1);
	array_push($array_indeks_gen_dimutasi, $indeks_gen_dimutasi);
	//masukkan data kromosom yang akan dimutasi ke dalam array mutasi (copy data)
	array_push($kromosom_mutasi, $kromosom[$indeks_kromosom_dimutasi]);

	//1. Mutasi Hari
	$gen_random_hari = array();
	$gen_random_hari = $data_hari[rand(0,4)];
	//Ganti hari yang lama dengan hari yang baru hasil random
	$kromosom_mutasi[$indeks_loop_mutasi][$indeks_gen_dimutasi][0] = $gen_random_hari;
	//2. Mutasi Jam
	$gen_random_jam = array();
	if ($indeks_gen_dimutasi >= $indeks_awal_3_wajib && $indeks_gen_dimutasi <= $indeks_akhir_3_pilihan) {
		//waktu untuk matkul 3 sks (wajib dan pilihan)
		$gen_random_jam = $data_jam[rand(0,2)];
	}elseif ($indeks_gen_dimutasi>=$indeks_awal_2_wajib && $indeks_gen_dimutasi <= $indeks_akhir_1_praktikum) {
		//waktu untuk matkul 2 sks dan 1 sks
		$gen_random_jam = $data_jam[rand(3,6)];
	}
	//Ganti jam yang lama dengan jam yang baru hasil random
	$kromosom_mutasi[$indeks_loop_mutasi][$indeks_gen_dimutasi][1] = $gen_random_jam;

	//3. Mutasi Ruangan
	$gen_random_ruangan = array();
	if ( ($indeks_gen_dimutasi >= $indeks_awal_3_wajib && $indeks_gen_dimutasi <= $indeks_akhir_3_wajib) || ($indeks_gen_dimutasi >= $indeks_awal_2_wajib && $indeks_gen_dimutasi <= $indeks_akhir_2_wajib) ) {
	//matkul 3 sks wajib dan  2 sks kategori ruangan yang bisa ditempati sama
		$gen_random_ruangan = $data_ruangan[rand(0,5)];
	}elseif ( ($indeks_gen_dimutasi >= $indeks_awal_3_pilihan && $indeks_gen_dimutasi <= $indeks_akhir_3_pilihan) || ($indeks_gen_dimutasi >= $indeks_awal_1_praktikum && $indeks_gen_dimutasi <= $indeks_akhir_1_praktikum) ) {
	//matkul 3 sks pilihan dan  1 sks kategori ruangan yang bisa ditempati sama
		$gen_random_ruangan = $data_ruangan[rand(6,11)];
	}
	//Ganti ruangan yang lama dengan ruangan yang baru hasil random
	$kromosom_mutasi[$indeks_loop_mutasi][$indeks_gen_dimutasi][2] = $gen_random_ruangan;
	//Masukan data kromosom_mutasi ke dalam array kromosom
	array_push($kromosom, $kromosom_mutasi[$indeks_loop_mutasi]);
}
//- Akhir 3.Mutasi Gen

//penomoran indeks untuk digunakan dalam tabel mutasi kromosom
$indeks_kromosom_awal = 0;
$indeks_kromosom_akhir = $jumlah_kromosom-1;
$indeks_kromosom_anak_awal = $jumlah_kromosom;
$indeks_kromosom_anak_akhir = $jumlah_kromosom +  count($kromosom)-$jumlah_kromosom-count($kromosom_mutasi)-1;
$indeks_kromosom_mutasi_awal = $indeks_kromosom_anak_akhir+1;
$indeks_kromosom_mutasi_akhir = $indeks_kromosom_mutasi_awal +  count($kromosom_mutasi)-1;
//untuk menandai apakah dia kromosom generate awal, kromosom anak atau kromosom mutasi
$nama_kromosom = array(); 

/* 4. Seleksi Kromosom */
/*
(awal+crossover+mutasi) dengan menentukan kromosom-kromosom yang memiliki nilai fitness terbaik. Banyaknya kromosom terpilih hasil seleksi sejumlah 1 populasi yang dibangkitkan
*/
$solusi_ditemukan = false;
$nilai_fitness = array();
//- 4.1 Hitung Nilai Fitness Kromosom
for ($indeksKromosom=0; $indeksKromosom < count($kromosom); $indeksKromosom++) {
	$nilai_fitness[$indeksKromosom] = 0;
	for ($indeksGen=0; $indeksGen < $banyakGen-1; $indeksGen++) {
		//Inisialisasi data yang menjadi pembanding
		$nama_hari_pembanding = $kromosom[$indeksKromosom][$indeksGen][0]['nama_hari'];
		$rentang_jam_pembanding = $kromosom[$indeksKromosom][$indeksGen][1]['rentang_jam'];
		$id_ruangan_pembanding = $kromosom[$indeksKromosom][$indeksGen][2]['id_ruangan'];
		$id_dosen_pembanding = $data_matkul[$indeksGen]['id_dosen'];
		$tahun_angkatan_pembanding = $data_matkul[$indeksGen]['tahun_angkatan'];
		$nama_kelas_pembanding = $data_matkul[$indeksGen]['nama_kelas'];
		$nama_kategori_pembanding = $data_matkul[$indeksGen]['nama_kategori'];
		$indeks_pembanding = $indeksGen;
		// Membandingkan antar gen i dan gen i+1 pada kromosom yang sama
		for ($indeks_dibandingkan=$indeks_pembanding+1; $indeks_dibandingkan < $banyakGen; $indeks_dibandingkan++) { 
			//Inisialisasi data yang akan dibandingkan
			$nama_hari_dibandingkan = $kromosom[$indeksKromosom][$indeks_dibandingkan][0]['nama_hari'];
			$rentang_jam_dibandingkan = $kromosom[$indeksKromosom][$indeks_dibandingkan][1]['rentang_jam'];
			$id_ruangan_dibandingkan = $kromosom[$indeksKromosom][$indeks_dibandingkan][2]['id_ruangan'];
			$id_dosen_dibandingkan = $data_matkul[$indeks_dibandingkan]['id_dosen'];
			$tahun_angkatan_dibandingkan = $data_matkul[$indeks_dibandingkan]['tahun_angkatan'];
			$nama_kelas_dibandingkan = $data_matkul[$indeks_dibandingkan]['nama_kelas'];
			$nama_kategori_dibandingkan = $data_matkul[$indeks_dibandingkan]['nama_kategori'];
			if ( $indeks_pembanding >= $indeks_awal_3_wajib && $indeks_pembanding <= $indeks_akhir_3_wajib ) {
				//matkul 3 sks wajib x matkul 3 sks wajib
				if ( $indeks_dibandingkan >= $indeks_awal_3_wajib+1 && $indeks_dibandingkan <= $indeks_akhir_3_wajib) {
					if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
						if ($rentang_jam_pembanding==$rentang_jam_dibandingkan) {
							if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($nama_kategori_pembanding!="Pilihan" && $nama_kategori_dibandingkan!="Pilihan") {
								if ( ($tahun_angkatan_pembanding==$tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding==$nama_kelas_dibandingkan) ) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				}elseif ( $indeks_dibandingkan >= $indeks_awal_3_pilihan && $indeks_dibandingkan <= $indeks_akhir_3_pilihan) {
					//matkul 3 sks wajib x matkul 3 sks pilihan
					if ($nama_hari_pembanding==$nama_hari_dibandingkan) {
						if ($rentang_jam_pembanding==$rentang_jam_dibandingkan) {
							if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($nama_kategori_pembanding!="Pilihan" && $nama_kategori_dibandingkan!="Pilihan") {
								if ( ($tahun_angkatan_pembanding==$tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding==$nama_kelas_dibandingkan) ) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				}elseif ( $indeks_dibandingkan >= $indeks_awal_2_wajib && $indeks_dibandingkan <= $indeks_akhir_2_wajib) {
					//matkul 3 sks wajib x matkul 2 sks
					//1. cek apakah waktu yang interval 2 sks berada di dalam interval waktu 3sks
					if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
						$isDalamInterval = cekIntervalJam($rentang_jam_pembanding,$rentang_jam_dibandingkan);
						if ($isDalamInterval==1) {
							if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($nama_kategori_pembanding!="Pilihan" && $nama_kategori_dibandingkan!="Pilihan") {
								if ( ($tahun_angkatan_pembanding==$tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding==$nama_kelas_dibandingkan) ) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				}elseif ( $indeks_dibandingkan >= $indeks_awal_1_praktikum && $indeks_dibandingkan <= $indeks_akhir_1_praktikum) {
					//matkul 3 sks wajib x matkul 1 sks
					if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
						$isDalamInterval = cekIntervalJam($rentang_jam_pembanding,$rentang_jam_dibandingkan);
						if ($isDalamInterval==1) {
							if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($nama_kategori_pembanding!="Pilihan" && $nama_kategori_dibandingkan!="Pilihan") {
								if ( ($tahun_angkatan_pembanding==$tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding==$nama_kelas_dibandingkan) ) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				}
			}elseif ( $indeks_pembanding >= $indeks_awal_3_pilihan && $indeks_pembanding <= $indeks_akhir_3_pilihan ) {
				if ( $indeks_dibandingkan >= $indeks_awal_3_pilihan+1 && $indeks_dibandingkan <= $indeks_akhir_3_pilihan){
					//matkul 3 sks pilihan x matkul 3 sks pilihan
					if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
						if ($rentang_jam_pembanding==$rentang_jam_dibandingkan) {
							if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($nama_kategori_pembanding!="Pilihan" && $nama_kategori_dibandingkan!="Pilihan") {
								if ( ($tahun_angkatan_pembanding==$tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding==$nama_kelas_dibandingkan) ) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				}elseif ( $indeks_dibandingkan >= $indeks_awal_2_wajib && $indeks_dibandingkan <= $indeks_akhir_2_wajib) {
					//matkul 3 sks pilihan x matkul 2 sks
					//1. cek apakah waktu yang interval 2 sks berada di dalam waktu 3 sks 
					if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
						$isDalamInterval = cekIntervalJam($rentang_jam_pembanding,$rentang_jam_dibandingkan);
						if ($isDalamInterval==1) {
							if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($nama_kategori_pembanding!="Pilihan" && $nama_kategori_dibandingkan!="Pilihan") {
								if ( ($tahun_angkatan_pembanding==$tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding==$nama_kelas_dibandingkan) ) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				}elseif ( $indeks_dibandingkan >= $indeks_awal_1_praktikum && $indeks_dibandingkan <= $indeks_akhir_1_praktikum) {
					//matkul 3 sks pilihan x matkul 1 sks
					//1. cek apakah waktu yang interval 1 sks berada di dalam waktu 3 sks 
					if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
						$isDalamInterval = cekIntervalJam($rentang_jam_pembanding,$rentang_jam_dibandingkan);
						if ($isDalamInterval==1) {
							if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($nama_kategori_pembanding!="Pilihan" && $nama_kategori_dibandingkan!="Pilihan") {
								if ( ($tahun_angkatan_pembanding==$tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding==$nama_kelas_dibandingkan) ) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				}
			}elseif ( $indeks_pembanding >= $indeks_awal_2_wajib && $indeks_pembanding <= $indeks_akhir_2_wajib ) {
				if ( $indeks_dibandingkan >= $indeks_awal_2_wajib+1 && $indeks_dibandingkan <= $indeks_akhir_2_wajib) {
					//matkul 2 sks x matkul 2 sks
					if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
						if ($rentang_jam_pembanding==$rentang_jam_dibandingkan) {
							if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($nama_kategori_pembanding!="Pilihan" && $nama_kategori_dibandingkan!="Pilihan") {
								if ( ($tahun_angkatan_pembanding==$tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding==$nama_kelas_dibandingkan) ) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				}elseif ( $indeks_dibandingkan >= $indeks_awal_1_praktikum && $indeks_dibandingkan <= $indeks_akhir_1_praktikum) {
					//matkul 2 sks x matkul 1 sks
					if ($nama_hari_pembanding==$nama_hari_dibandingkan) {
						if ($rentang_jam_pembanding==$rentang_jam_dibandingkan) {
							if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($nama_kategori_pembanding!="Pilihan" && $nama_kategori_dibandingkan!="Pilihan") {
								if ( ($tahun_angkatan_pembanding==$tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding==$nama_kelas_dibandingkan) ) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				}
			}elseif ( $indeks_pembanding >= $indeks_awal_1_praktikum && $indeks_pembanding <= $indeks_akhir_1_praktikum) {
				if ( $indeks_dibandingkan >= $indeks_awal_1_praktikum+1 && $indeks_dibandingkan <= $indeks_akhir_1_praktikum) {
					//matkul 1 sks x matkul 1 sks
					if ($nama_hari_pembanding==$nama_hari_dibandingkan) {
						if ($rentang_jam_pembanding==$rentang_jam_dibandingkan) {
							if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
								$nilai_fitness[$indeksKromosom]++;
							}
							if ($nama_kategori_pembanding!="Pilihan" && $nama_kategori_dibandingkan!="Pilihan") {
								if ( ($tahun_angkatan_pembanding==$tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding==$nama_kelas_dibandingkan) ) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				}
			}
		}
		//akhir for dibandingkan
	}
	//akhir for pembanding
	$nilai_fitness[$indeksKromosom] = (1 / (1+$nilai_fitness[$indeksKromosom]));
	if ($nilai_fitness[$indeksKromosom]==1) {
		$solusi_ditemukan = true;
	}
}
//- Akhir 4.1 Hitung Nilai Fitness

?>
<!-- Proses Mutasi -->
<div class="row mb-2">
	<div class="col">
		<h4 class="display-4" id="mutasi_kromosom">
			Mutasi Kromosom
		</h4>
		<div class="table-responsive">
			<table class="table table-bordered cell-border " id="table_mutasi_kromosom">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Index</th>
						<?php
						$batas_tampil_gen_max = $banyakGen;
						for ($indeks_gen=0; $indeks_gen <= $batas_tampil_gen_max; $indeks_gen++) { 
							if ($indeks_gen == $batas_tampil_gen_max) {
								echo "<th scope='col'>Fitness</th>";
							}else{
								echo "<th scope='col'>Gen-$indeks_gen</th>";
							}
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($indeks_baris=0; $indeks_baris < count($kromosom) + 3; $indeks_baris++) { 
						echo "<tr>";
						echo "<th scope='row' >".($indeks_baris+1)."</th>";
						for ($indeks_kolom=0; $indeks_kolom <= $batas_tampil_gen_max+2; $indeks_kolom++) { 
							$key_indeks_kromosom = false;
							$key_indeks_gen = false;
							if ($indeks_baris==0) {
								if ($indeks_kolom==0) {
									echo "<th scope='row'> Mata Kuliah</th>";
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max) {
									echo "<td>";
									echo $data_matkul[$indeks_kolom-1]['nama_matkul'];
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max+1) {
									echo "<td>--</td>";
								}
							}elseif ($indeks_baris==1) {
								if ($indeks_kolom==0) {
									echo "<th scope='row'> Dosen</th>";
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max) {
									echo "<td>";
									echo $data_matkul[$indeks_kolom-1]['nama_dosen'];
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max+1) {
									echo "<td >--</td>";
								}
							}elseif ($indeks_baris==2) {
								if ($indeks_kolom==0) {
									echo "<th scope='row'> Kelas</th>";
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max) {
									echo "<td>";
									echo $data_matkul[$indeks_kolom-1]['tahun_angkatan']."-".$data_matkul[$indeks_kolom-1]['nama_kelas']."-".$data_matkul[$indeks_kolom-1]['nama_kategori'];
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max+1) {
									echo "<td >--</td>";
								}
							}elseif( $indeks_baris >= $indeks_kromosom_awal + 3 && $indeks_baris <= $indeks_kromosom_mutasi_akhir+3 ){

								$key_indeks_kromosom = array_search($indeks_baris-3, $array_indeks_kromosom_dimutasi);
								if ($indeks_kolom==0) {
									if ($indeks_baris>=$indeks_kromosom_awal+3 && $indeks_baris<= $indeks_kromosom_akhir+3) {
										//kromosom generate awal
										$tmp_name_kromosom = "Kromosom Awal ke-".($indeks_baris-3);
										array_push($nama_kromosom, $tmp_name_kromosom);
										echo "<th scope='row'> Kromosom ke-".($indeks_baris-3)."</th>";
									}elseif ($indeks_baris>=$indeks_kromosom_anak_awal+3 && $indeks_baris <= $indeks_kromosom_anak_akhir+3) {
										//kromosom anak
										$tmp_name_kromosom = "Kromosom Anak ke-".($indeks_baris-($jumlah_kromosom)-3);
										array_push($nama_kromosom, $tmp_name_kromosom);
										echo "<th scope='row'> Kromosom Anak ke-".($indeks_baris-($jumlah_kromosom)-3)."</th>";
									}elseif ($indeks_baris>=$indeks_kromosom_mutasi_awal+3) {
										//kromosom mutasi
										$tmp_name_kromosom = "Kromosom Mutasi ke-".($indeks_baris-$indeks_kromosom_mutasi_awal-3);
										array_push($nama_kromosom, $tmp_name_kromosom);
										echo "<th scope='row'> Kromosom Mutasi ke- ".($indeks_baris-$indeks_kromosom_mutasi_awal-3)."</th>";
									}
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max) {
									if ($key_indeks_kromosom!=false) {
										$key_indeks_gen = array_search($indeks_kolom-1, $array_indeks_gen_dimutasi);
										if ($key_indeks_gen!=false && ($key_indeks_gen == $key_indeks_kromosom)) {
											$array_indeks_kromosom_dimutasi[$key_indeks_kromosom] = -1;
											$array_indeks_gen_dimutasi[$key_indeks_gen] = -1;
											$style = "bg-danger";
										}else{
											$style = "";
										}
									}else{
										$style="";
									}

									echo "<td class='$style'>";
									echo "[".$kromosom[$indeks_baris-3][$indeks_kolom-1][0]['nama_hari']."]"."<br>";
									echo "[".$kromosom[$indeks_baris-3][$indeks_kolom-1][1]['rentang_jam']."]"."<br>";
									echo "[".$kromosom[$indeks_baris-3][$indeks_kolom-1][2]['nama_ruangan']."]"."<br>";
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max+1) {
									echo "<td>".$nilai_fitness[$indeks_baris-3]."</td>";
								}
							}
						}
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Akhir Proses Mutasi -->

<?php
//- 4.2 Sorting Nilai Fitness Terbaik
$banyak_kromosom_akhir_mutasi = count($kromosom);
for ($i=0; $i < $banyak_kromosom_akhir_mutasi-1; $i++) { 
	$temp_data_kromosom = array();
	for ($j=$i+1; $j < $banyak_kromosom_akhir_mutasi; $j++) { 
		if ($nilai_fitness[$i]<$nilai_fitness[$j]) {
			//tukar nilai fitness nya
			$temp = $nilai_fitness[$i];
			$nilai_fitness[$i] = $nilai_fitness[$j];
			$nilai_fitness[$j] = $temp;
			//tukar data kromosomnya
			$temp_data_kromosom = $kromosom[$i];
			$kromosom[$i] = $kromosom[$j];
			$kromosom[$j] = $kromosom[$i];
			//tukar nama kromosomnya
			$temp_nama_kromosom = $nama_kromosom[$i];
			$nama_kromosom[$i] = $nama_kromosom[$j];
			$nama_kromosom[$j] = $temp_nama_kromosom;
		}
	}
}
// Keluarkan kromosom ke-jumlah_kromosom sampai akhir kromosom karena sudah tidak diperlukan
for ($i=$banyak_kromosom_akhir_mutasi; $i > $jumlah_kromosom ; $i--) { 
	array_pop($kromosom);
	array_pop($nilai_fitness);
	array_pop($nama_kromosom);
}
unset($kromosom_mutasi);
?>

<!-- Proses Seleksi -->
<div class="row mb-2">
	<div class="col">
		<h4 class="display-4" id="seleksi_kromosom">
			Seleksi Kromosom
		</h4>
		<div class="table-responsive">
			<table class="table table-bordered cell-border " id="table_seleksi_kromosom">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Index</th>
						<?php
						$batas_tampil_gen_max = $banyakGen;
						for ($indeks_gen=0; $indeks_gen <= $batas_tampil_gen_max; $indeks_gen++) { 
							if ($indeks_gen == $batas_tampil_gen_max) {
								echo "<th scope='col'>Fitness</th>";
							}else{
								echo "<th scope='col'>Gen-$indeks_gen</th>";
							}
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($indeks_baris=0; $indeks_baris < $jumlah_kromosom + 3; $indeks_baris++) { 
						echo "<tr>";
						echo "<th scope='row' >".($indeks_baris+1)."</th>";
						for ($indeks_kolom=0; $indeks_kolom <= $batas_tampil_gen_max+2; $indeks_kolom++) { 
							if ($indeks_baris==0) {
								if ($indeks_kolom==0) {
									echo "<th scope='row'> Mata Kuliah</th>";
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max) {
									echo "<td>";
									echo $data_matkul[$indeks_kolom-1]['nama_matkul'];
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max+1) {
									echo "<td>--</td>";
								}
							}elseif ($indeks_baris==1) {
								if ($indeks_kolom==0) {
									echo "<th scope='row'> Dosen</th>";
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max) {
									echo "<td>";
									echo $data_matkul[$indeks_kolom-1]['nama_dosen'];
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max+1) {
									echo "<td >--</td>";
								}
							}elseif ($indeks_baris==2) {
								if ($indeks_kolom==0) {
									echo "<th scope='row'> Kelas</th>";
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max) {
									echo "<td>";
									echo $data_matkul[$indeks_kolom-1]['tahun_angkatan']."-".$data_matkul[$indeks_kolom-1]['nama_kelas']."-".$data_matkul[$indeks_kolom-1]['nama_kategori'];
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max+1) {
									echo "<td >--</td>";
								}
							}elseif( $indeks_baris >= $indeks_kromosom_awal + 3 && $indeks_baris <= $indeks_kromosom_mutasi_akhir+3 ){
								$key_indeks_kromosom = array_search($indeks_baris-3, $array_indeks_kromosom_dimutasi);
								if ($indeks_kolom==0) {
									echo "<th scope='row'>".$nama_kromosom[$indeks_baris-3]."</th>";
								}elseif ($indeks_kolom>=1 && $indeks_kolom<=$batas_tampil_gen_max) {
									echo "<td>";
									echo "[".$kromosom[$indeks_baris-3][$indeks_kolom-1][0]['nama_hari']."]"."<br>";
									echo "[".$kromosom[$indeks_baris-3][$indeks_kolom-1][1]['rentang_jam']."]"."<br>";
									echo "[".$kromosom[$indeks_baris-3][$indeks_kolom-1][2]['nama_ruangan']."]"."<br>";
									echo "</td>";
								}elseif ($indeks_kolom==$batas_tampil_gen_max+1) {
									echo "<td>".$nilai_fitness[$indeks_baris-3]."</td>";
								}
							}
						}
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Akhir proses seleksi -->