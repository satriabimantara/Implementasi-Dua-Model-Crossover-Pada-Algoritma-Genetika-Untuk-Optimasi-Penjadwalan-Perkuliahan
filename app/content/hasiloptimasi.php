<?php
function searchmatkul($hari, $jam, $ruangan, $arr_matkul)
{
	foreach ($arr_matkul as $indeks_gen => $matkul) {
		if ($matkul[0]['nama_hari'] == $hari && $matkul[1]['rentang_jam'] == $jam && $matkul[2]['nama_ruangan'] == $ruangan) {
			return $indeks_gen;
		}
	}
	return null;
}


//Fungsi untuk menentukan apakah interval jam 2 sks berada di dalam interval jam 3 sks
function cekIntervalJam($rentang_jam_pembanding, $rentang_jam_dibandingkan)
{
	$returnValue = 0;
	//explode pembanding
	$rentang_jam_pembanding = explode('-', $rentang_jam_pembanding);
	//explode dibandingkan
	$rentang_jam_dibandingkan = explode('-', $rentang_jam_dibandingkan);
	if ((($rentang_jam_dibandingkan[0] >= $rentang_jam_pembanding[0]) && ($rentang_jam_dibandingkan[0] <= $rentang_jam_pembanding[1])) || (($rentang_jam_dibandingkan[1] >= $rentang_jam_pembanding[0]) && ($rentang_jam_dibandingkan[1] <= $rentang_jam_pembanding[1]))) {
		$returnValue = 1;
	}
	return $returnValue;
}

function getIndukCrossOver($probabilitas_cross_over, $jumlah_kromosom)
{
	$induk_kromosom_terpilih = array();
	$indeks_induk_kromosom_terpilih = 0;
	$bilangan_random_setiap_kromosom = array();
	$banyak_crossOver = $probabilitas_cross_over * $jumlah_kromosom;
	$banyak_crossOver = round($banyak_crossOver);
	if ($banyak_crossOver % 2 == 1) {
		//karena ganjil maka kurangi 1
		$banyak_crossOver--;
	}
	$count_banyak_crossOver = 0;
	while ($count_banyak_crossOver != $banyak_crossOver) {
		$random_indeks_kromosom = rand(0, $jumlah_kromosom - 1);
		//Jika indeks kromosom yang terpilih saat di random belum ada di dalam array
		if (!in_array($random_indeks_kromosom, $induk_kromosom_terpilih)) {
			$bilangan_random_setiap_kromosom[$random_indeks_kromosom] = mt_rand() / mt_getrandmax(); //rand float between 0,1 in php
			if ($bilangan_random_setiap_kromosom[$random_indeks_kromosom] < $probabilitas_cross_over) {
				$induk_kromosom_terpilih[$indeks_induk_kromosom_terpilih] = $random_indeks_kromosom;
				$indeks_induk_kromosom_terpilih++;
				$count_banyak_crossOver++;
			}
		}
	}
	return $induk_kromosom_terpilih;
}
function mutasiKromosom(&$kromosom, $probabilitas_mutasi, $jumlah_kromosom, $banyakGen, &$indeks_matkul, &$indeks_ruangan, &$indeks_jam, &$indeks_hari, &$data)
{
	//data
	$data_ruangan = $data['data_ruangan'];
	$data_hari = $data['data_hari'];
	$data_jam = $data['data_jam'];
	//indeks_matkul
	$indeks_awal_3_wajib = $indeks_matkul['indeks_awal_3_wajib'];
	$indeks_akhir_3_wajib = $indeks_matkul['indeks_akhir_3_wajib'];
	$indeks_awal_3_pilihan = $indeks_matkul['indeks_awal_3_pilihan'];
	$indeks_akhir_3_pilihan = $indeks_matkul['indeks_akhir_3_pilihan'];
	$indeks_awal_2_wajib = $indeks_matkul['indeks_awal_2_wajib'];
	$indeks_akhir_2_wajib = $indeks_matkul['indeks_akhir_2_wajib'];
	$indeks_awal_1_praktikum = $indeks_matkul['indeks_awal_1_praktikum'];
	$indeks_akhir_1_praktikum = $indeks_matkul['indeks_akhir_1_praktikum'];
	//indeks_ruangan
	$indeks_awal_ruangan_matkul_wajib = $indeks_ruangan['indeks_awal_ruangan_matkul_wajib'];
	$indeks_akhir_ruangan_matkul_wajib = $indeks_ruangan['indeks_akhir_ruangan_matkul_wajib'];
	$indeks_awal_ruangan_matkul_praktikum = $indeks_ruangan['indeks_awal_ruangan_matkul_praktikum'];
	$indeks_akhir_ruangan_matkul_praktikum = $indeks_ruangan['indeks_akhir_ruangan_matkul_praktikum'];
	$indeks_awal_ruangan_matkul_pilihan = $indeks_ruangan['indeks_awal_ruangan_matkul_pilihan'];
	$indeks_akhir_ruangan_matkul_pilihan = $indeks_ruangan['indeks_akhir_ruangan_matkul_pilihan'];
	//indeks jam
	$indeks_awal_jam_3sks = $indeks_jam['indeks_awal_jam_3sks'];
	$indeks_akhir_jam_3sks = $indeks_jam['indeks_akhir_jam_3sks'];
	$indeks_awal_jam_2sks = $indeks_jam['indeks_awal_jam_2sks'];
	$indeks_akhir_jam_2sks = $indeks_jam['indeks_akhir_jam_2sks'];
	//indeks hari
	$indeks_awal_hari = $indeks_hari['indeks_awal_hari'];
	$indeks_akhir_hari = $indeks_hari['indeks_akhir_hari'];

	$total_kromosom_setelah_cross_over = count($kromosom);
	$loop_mutasi = $probabilitas_mutasi * $jumlah_kromosom;
	$loop_mutasi = round($loop_mutasi);
	$kromosom_mutasi = array(); //menampung data-data kromosom hasil mutasi
	$array_indeks_kromosom_dimutasi = array();
	$array_indeks_gen_dimutasi = array();

	for ($indeks_loop_mutasi = 0; $indeks_loop_mutasi < $loop_mutasi; $indeks_loop_mutasi++) {
		//Bangkitkan bilangan acak untuk menentukan kromosom dan gen mana yang akan kena mutasi
		$indeks_kromosom_dimutasi = rand(0, $total_kromosom_setelah_cross_over - 1);
		array_push($array_indeks_kromosom_dimutasi, $indeks_kromosom_dimutasi);
		$indeks_gen_dimutasi = rand(0, $banyakGen - 1);
		array_push($array_indeks_gen_dimutasi, $indeks_gen_dimutasi);

		//masukkan data kromosom yang akan dimutasi ke dalam array mutasi (copy data)
		array_push($kromosom_mutasi, $kromosom[$indeks_kromosom_dimutasi]);

		//1. Mutasi Hari
		$gen_random_hari = array();
		$gen_random_hari = $data_hari[rand($indeks_awal_hari, $indeks_akhir_hari)];
		//Ganti hari yang lama dengan hari yang baru hasil random
		$kromosom_mutasi[$indeks_loop_mutasi][$indeks_gen_dimutasi][0] = $gen_random_hari;
		//2. Mutasi Jam
		$gen_random_jam = array();
		if ($indeks_gen_dimutasi >= $indeks_awal_3_wajib && $indeks_gen_dimutasi <= $indeks_akhir_3_pilihan) {
			//waktu untuk matkul 3 sks (wajib dan pilihan)
			$gen_random_jam = $data_jam[rand($indeks_awal_jam_3sks, $indeks_akhir_jam_3sks)];
		} elseif ($indeks_gen_dimutasi >= $indeks_awal_2_wajib && $indeks_gen_dimutasi <= $indeks_akhir_1_praktikum) {
			//waktu untuk matkul 2 sks dan 1 sks
			$gen_random_jam = $data_jam[rand($indeks_awal_jam_2sks, $indeks_akhir_jam_2sks)];
		}
		//Ganti jam yang lama dengan jam yang baru hasil random
		$kromosom_mutasi[$indeks_loop_mutasi][$indeks_gen_dimutasi][1] = $gen_random_jam;
		//3. Mutasi Ruangan
		$gen_random_ruangan = array();
		if (($indeks_gen_dimutasi >= $indeks_awal_3_wajib && $indeks_gen_dimutasi <= $indeks_akhir_3_wajib) || ($indeks_gen_dimutasi >= $indeks_awal_2_wajib && $indeks_gen_dimutasi <= $indeks_akhir_2_wajib)) {
			//matkul 3 sks wajib dan  2 sks kategori ruangan yang bisa ditempati sama
			$gen_random_ruangan = $data_ruangan[rand($indeks_awal_ruangan_matkul_wajib, $indeks_akhir_ruangan_matkul_wajib)];
		} elseif (($indeks_gen_dimutasi >= $indeks_awal_3_pilihan && $indeks_gen_dimutasi <= $indeks_akhir_3_pilihan)) {
			//matkul 3 sks pilihan 
			$gen_random_ruangan = $data_ruangan[rand($indeks_awal_ruangan_matkul_pilihan, $indeks_akhir_ruangan_matkul_pilihan)];
		} elseif (($indeks_gen_dimutasi >= $indeks_awal_1_praktikum && $indeks_gen_dimutasi <= $indeks_akhir_1_praktikum)) {
			//matkul 1 sks praktikum
			$gen_random_ruangan = $data_ruangan[rand($indeks_awal_ruangan_matkul_praktikum, $indeks_akhir_ruangan_matkul_praktikum)];
		}
		//Ganti ruangan yang lama dengan ruangan yang baru hasil random
		$kromosom_mutasi[$indeks_loop_mutasi][$indeks_gen_dimutasi][2] = $gen_random_ruangan;

		//Masukan data kromosom_mutasi ke dalam array kromosom
		array_push($kromosom, $kromosom_mutasi[$indeks_loop_mutasi]);
	}
}
function hitungFitness(&$kromosom, &$nilai_fitness, $banyakGen, $indeks_matkul, $data_matkul)
{
	$indeks_awal_3_wajib = $indeks_matkul['indeks_awal_3_wajib'];
	$indeks_akhir_3_wajib = $indeks_matkul['indeks_akhir_3_wajib'];
	$indeks_awal_3_pilihan = $indeks_matkul['indeks_awal_3_pilihan'];
	$indeks_akhir_3_pilihan = $indeks_matkul['indeks_akhir_3_pilihan'];
	$indeks_awal_2_wajib = $indeks_matkul['indeks_awal_2_wajib'];
	$indeks_akhir_2_wajib = $indeks_matkul['indeks_akhir_2_wajib'];
	$indeks_awal_1_praktikum = $indeks_matkul['indeks_awal_1_praktikum'];
	$indeks_akhir_1_praktikum = $indeks_matkul['indeks_akhir_1_praktikum'];

	$solusi_ditemukan = false;

	for ($indeksKromosom = 0; $indeksKromosom < count($kromosom); $indeksKromosom++) {
		$nilai_fitness[$indeksKromosom] = 0;
		for ($indeksGen = 0; $indeksGen < $banyakGen - 1; $indeksGen++) {
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
			for ($indeks_dibandingkan = $indeks_pembanding + 1; $indeks_dibandingkan < $banyakGen; $indeks_dibandingkan++) {
				//Inisialisasi data yang akan dibandingkan
				$nama_hari_dibandingkan = $kromosom[$indeksKromosom][$indeks_dibandingkan][0]['nama_hari'];
				$rentang_jam_dibandingkan = $kromosom[$indeksKromosom][$indeks_dibandingkan][1]['rentang_jam'];
				$id_ruangan_dibandingkan = $kromosom[$indeksKromosom][$indeks_dibandingkan][2]['id_ruangan'];
				$id_dosen_dibandingkan = $data_matkul[$indeks_dibandingkan]['id_dosen'];
				$tahun_angkatan_dibandingkan = $data_matkul[$indeks_dibandingkan]['tahun_angkatan'];
				$nama_kelas_dibandingkan = $data_matkul[$indeks_dibandingkan]['nama_kelas'];
				$nama_kategori_dibandingkan = $data_matkul[$indeks_dibandingkan]['nama_kategori'];
				if ($indeks_pembanding >= $indeks_awal_3_wajib && $indeks_pembanding <= $indeks_akhir_3_wajib) {
					//matkul 3 sks wajib x matkul 3 sks wajib
					if ($indeks_dibandingkan >= $indeks_awal_3_wajib + 1 && $indeks_dibandingkan <= $indeks_akhir_3_wajib) {
						if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
							if ($rentang_jam_pembanding == $rentang_jam_dibandingkan) {
								if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if (($tahun_angkatan_pembanding == $tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding == $nama_kelas_dibandingkan)) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					} elseif ($indeks_dibandingkan >= $indeks_awal_3_pilihan && $indeks_dibandingkan <= $indeks_akhir_3_pilihan) {
						//matkul 3 sks wajib x matkul 3 sks pilihan
						if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
							if ($rentang_jam_pembanding == $rentang_jam_dibandingkan) {
								if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if (($tahun_angkatan_pembanding == $tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding == $nama_kelas_dibandingkan)) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					} elseif ($indeks_dibandingkan >= $indeks_awal_2_wajib && $indeks_dibandingkan <= $indeks_akhir_2_wajib) {
						//matkul 3 sks wajib x matkul 2 sks
						//1. cek apakah waktu yang interval 2 sks berada di dalam interval waktu 3sks
						if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
							$isDalamInterval = cekIntervalJam($rentang_jam_pembanding, $rentang_jam_dibandingkan);
							if ($isDalamInterval == 1) {
								if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if (($tahun_angkatan_pembanding == $tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding == $nama_kelas_dibandingkan)) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					} elseif ($indeks_dibandingkan >= $indeks_awal_1_praktikum && $indeks_dibandingkan <= $indeks_akhir_1_praktikum) {
						//matkul 3 sks wajib x matkul 1 sks
						if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
							$isDalamInterval = cekIntervalJam($rentang_jam_pembanding, $rentang_jam_dibandingkan);
							if ($isDalamInterval == 1) {
								if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if (($tahun_angkatan_pembanding == $tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding == $nama_kelas_dibandingkan)) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				} elseif ($indeks_pembanding >= $indeks_awal_3_pilihan && $indeks_pembanding <= $indeks_akhir_3_pilihan) {
					if ($indeks_dibandingkan >= $indeks_awal_3_pilihan + 1 && $indeks_dibandingkan <= $indeks_akhir_3_pilihan) {
						//matkul 3 sks pilihan x matkul 3 sks pilihan
						if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
							if ($rentang_jam_pembanding == $rentang_jam_dibandingkan) {
								if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if (($tahun_angkatan_pembanding == $tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding == $nama_kelas_dibandingkan)) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					} elseif ($indeks_dibandingkan >= $indeks_awal_2_wajib && $indeks_dibandingkan <= $indeks_akhir_2_wajib) {
						//matkul 3 sks pilihan x matkul 2 sks
						//1. cek apakah waktu yang interval 2 sks berada di dalam waktu 3 sks 
						if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
							$isDalamInterval = cekIntervalJam($rentang_jam_pembanding, $rentang_jam_dibandingkan);
							if ($isDalamInterval == 1) {
								if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if (($tahun_angkatan_pembanding == $tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding == $nama_kelas_dibandingkan)) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					} elseif ($indeks_dibandingkan >= $indeks_awal_1_praktikum && $indeks_dibandingkan <= $indeks_akhir_1_praktikum) {
						//matkul 3 sks pilihan x matkul 1 sks
						//1. cek apakah waktu yang interval 1 sks berada di dalam waktu 3 sks 
						if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
							$isDalamInterval = cekIntervalJam($rentang_jam_pembanding, $rentang_jam_dibandingkan);
							if ($isDalamInterval == 1) {
								if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if (($tahun_angkatan_pembanding == $tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding == $nama_kelas_dibandingkan)) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				} elseif ($indeks_pembanding >= $indeks_awal_2_wajib && $indeks_pembanding <= $indeks_akhir_2_wajib) {
					if ($indeks_dibandingkan >= $indeks_awal_2_wajib + 1 && $indeks_dibandingkan <= $indeks_akhir_2_wajib) {
						//matkul 2 sks x matkul 2 sks
						if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
							if ($rentang_jam_pembanding == $rentang_jam_dibandingkan) {
								if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if (($tahun_angkatan_pembanding == $tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding == $nama_kelas_dibandingkan)) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					} elseif ($indeks_dibandingkan >= $indeks_awal_1_praktikum && $indeks_dibandingkan <= $indeks_akhir_1_praktikum) {
						//matkul 2 sks x matkul 1 sks
						if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
							if ($rentang_jam_pembanding == $rentang_jam_dibandingkan) {
								if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if (($tahun_angkatan_pembanding == $tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding == $nama_kelas_dibandingkan)) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				} elseif ($indeks_pembanding >= $indeks_awal_1_praktikum && $indeks_pembanding <= $indeks_akhir_1_praktikum) {
					if ($indeks_dibandingkan >= $indeks_awal_1_praktikum + 1 && $indeks_dibandingkan <= $indeks_akhir_1_praktikum) {
						//matkul 1 sks x matkul 1 sks
						if ($nama_hari_pembanding == $nama_hari_dibandingkan) {
							if ($rentang_jam_pembanding == $rentang_jam_dibandingkan) {
								if ($id_ruangan_pembanding == $id_ruangan_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if ($id_dosen_pembanding == $id_dosen_dibandingkan) {
									$nilai_fitness[$indeksKromosom]++;
								}
								if (($tahun_angkatan_pembanding == $tahun_angkatan_dibandingkan) && ($nama_kelas_pembanding == $nama_kelas_dibandingkan)) {
									$nilai_fitness[$indeksKromosom]++;
								}
							}
						}
					}
				}
			}
			//akhir for dibandingkan
		}
		//akhir for pembanding
		$nilai_fitness[$indeksKromosom] = (1 / (1 + $nilai_fitness[$indeksKromosom]));
		if ($nilai_fitness[$indeksKromosom] == 1) {
			$solusi_ditemukan = true;
		}
	}
	return $solusi_ditemukan;
}

function sortingFitness(&$kromosom, &$nilai_fitness)
{
	$banyak_kromosom_akhir_mutasi = count($kromosom);
	for ($i = 0; $i < $banyak_kromosom_akhir_mutasi - 1; $i++) {
		$temp_data_kromosom = array();
		for ($j = $i + 1; $j < $banyak_kromosom_akhir_mutasi; $j++) {
			if ($nilai_fitness[$i] < $nilai_fitness[$j]) {
				//tukar nilai fitness nya
				$temp = $nilai_fitness[$i];
				$nilai_fitness[$i] = $nilai_fitness[$j];
				$nilai_fitness[$j] = $temp;
				//tukar data kromosomnya
				$temp_data_kromosom = $kromosom[$i];
				$kromosom[$i] = $kromosom[$j];
				$kromosom[$j] = $kromosom[$i];
			}
		}
	}
}

function popTheRestKromosom(&$kromosom, &$nilai_fitness, $jumlah_kromosom)
{
	$banyak_kromosom_akhir_mutasi = count($kromosom);
	for ($i = $banyak_kromosom_akhir_mutasi; $i > $jumlah_kromosom; $i--) {
		array_pop($kromosom);
		array_pop($nilai_fitness);
	}
}



if (isset($_POST['btn-submit-modal-proses-genetika'])) {
	//Tangkap parameter input algoritma genetika oleh user
	$jumlah_kromosom = (int)$_POST['tambah_jumlah_kromosom'];
	$maximum_generasi = (int) $_POST['tambah_maximum_generasi'];
	$probabilitas_cross_over = (float) $_POST['tambah_probabilitas_cross_over'];
	$probabilitas_mutasi = (float) $_POST['tambah_probabilitas_mutasi'];
	$metode_cross_over = $_POST['tambah_metode_cross_over'];
	$semester = $_POST['tambah_semester'];
	/*Pre Algoritma*/
	//- Run query untuk mendapatkan semua data dari database
	//Retrieve data matkul sesuai semester
	if ($semester == "ganjil") {
		$runQueryGetAllDataDetailMatkul = $objMatkul->getAllDataDetailMatkulSemesterGanjil();
	} else {
		$runQueryGetAllDataDetailMatkul = $objMatkul->getAllDataDetailMatkulSemesterGenap();
	}

	$runQueryGetAllDataRuangan = $objRuangan->getAllDataRuangan();
	$runqueryGetAllDataHari = $objWaktu->getAllDataHariAktif();
	$runqueryGetAllDataJam = $objWaktu->getAllDataJam();

	//- Inisialisasi variabel untuk menampung data from db
	$data_matkul = array();
	$data_ruangan = array();
	$data_hari = array();
	$data_jam = array();

	// - Masukkan data yang diperoleh dari db ke masing-masing array
	/*
	1. Load data matkul
	- Banyak matkul menyesuaikan apakah semester ganjil atau genap
	$data_matkul[1] --> mata kuliah ke-1 dari daftar database
	$data_matkul[2] --> mata kuliah ke-2 dari daftar database

	2. Load data hari
	$data_hari[0] --> hari ke-1 dari daftar database
	$data_hari[1] --> hari ke-2 dari daftar database
	...
	$data_hari[6] --> hari ke-6 dari daftar database

	3. Load data jam
	$data_jam[0] --> jam ke-1 dari daftar database
	$data_jam[1] --> jam ke-2 dari daftar database
	...
	$data_jam[6] --> jam ke-6 dari daftar database

	4. Load data ruangan
	- Ada 12 ruangan
	$data_ruangan[0] --> ruangan ke-1 dari daftar database
	$data_ruangan[1] --> ruangan ke-2 dari daftar database
	...
	$data_ruangan[11] --> ruangan ke-11 dari daftar database

	---- INDEKS MATKUL SEMESTER GANJIL -----
	-indeks data_matkul 0-65 --> 3 sks wajib (66) --> harus menggunakan ruangan kapasitas 35-40 dan interval waktu 3 sks
	-indeks data_matkul 66-83 --> 3 sks pilihan (18) -->harus menggunakan ruangan kapasitas 10-25 dan interval waktu 3 sks
	-indeks data_matkul 84-101 --> 2sks (18) --> harus menggunakan ruangan kapasitas 35-40 dan interval waktu 2 sks
	-indeks data_matkul 102-114 --> 1 sks (13) --> menggunakan ruangan dengan kapasitas 10-25 dan interval waktu 2sks

	-indek data_ruangan 0-5 --> kapasitas 35 - 40
	-indeks data_ruangan 6-11 --> kapasitas 10-25

	Gambaran Representasi Kromosom
	-kromosom[indeksKromosom][indeksGen][0] --> untuk menunjukan hari
	-kromosom[indeksKromosom][indeksGen][1] --> untuk menunjukan jam
	-kromosom[indeksKromosom][indeksGen][2] --> untuk menunjukan ruangan
	*/
	while ($matkul = $runQueryGetAllDataDetailMatkul->fetch_assoc()) {
		array_push($data_matkul, $matkul);
	}
	while ($hari = $runqueryGetAllDataHari->fetch_assoc()) {
		array_push($data_hari, $hari);
	}
	while ($jam = $runqueryGetAllDataJam->fetch_assoc()) {
		array_push($data_jam, $jam);
	}
	while ($ruangan = $runQueryGetAllDataRuangan->fetch_assoc()) {
		array_push($data_ruangan, $ruangan);
	}
	if (empty($data_matkul) || empty($data_jam) || empty($data_hari) || empty($data_ruangan)) {
		if (empty($data_matkul)) {
			$msg_error = "Tidak ada mata kuliah yang didaftarkan!";
		} elseif (empty($data_jam)) {
			$msg_error = "Jam Perkuliahan masih kosong!";
		} elseif (empty($data_ruangan)) {
			$msg_error = "Tidak ada ruang kuliah yang didaftarkan!";
		}
		$objFlash->showSimpleFlash("GENERATE GAGAL", "error", $msg_error, "index.php?page=Input Data", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Lengkapi");
		exit();
	} else {
		if (count($data_hari) < 5 || count($data_jam) < 7 || count($data_ruangan) < 12) {
			if (count($data_hari) < 5) {
				$msg_error = "Jumlah hari perkuliahan kurang dari 5";
			} elseif (count($data_jam) < 7) {
				$msg_error = "Jumlah jam perkuliahan kurang dari 7";
			} elseif (count($data_ruangan) < 12) {
				$msg_error = "Jumlah ruang perkuliahan kurang dari 12";
			}
			$objFlash->showSimpleFlash("GENERATE GAGAL", "error", $msg_error, "index.php?page=Input Data", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Lengkapi");
			exit();
		}
	}
	//panjang kromosom terdiri dari banyak data matkul yang ada
	$banyakGen = count($data_matkul);
	$banyak_hari = count($data_hari);
	$banyak_jam = count($data_jam);
	$banyak_ruangan = count($data_ruangan);
	$data = array('data_hari' => $data_hari, 'data_jam' => $data_jam, 'data_ruangan' => $data_ruangan);

	//Mencari indeks matkul dan banyak matkul sesuai dengan sks dan kategori matkul
	$amount_data_matkul = $objMatkul->getAmountDataMatkulPerKategori($semester);
	$banyak_matkul_3_wajib = (int)$amount_data_matkul[0];
	$banyak_matkul_3_pilihan = (int)$amount_data_matkul[1];
	$banyak_matkul_2_wajib = (int)$amount_data_matkul[2];
	$banyak_matkul_1_praktikum = (int)$amount_data_matkul[3];

	$indeks_awal_3_wajib = array_search('Wajib', array_column($data_matkul, 'nama_kategori'));
	$indeks_akhir_3_wajib = $indeks_awal_3_wajib + ($banyak_matkul_3_wajib - 1);
	$indeks_awal_3_pilihan = array_search('Pilihan', array_column($data_matkul, 'nama_kategori'));
	$indeks_akhir_3_pilihan = $indeks_awal_3_pilihan + ($banyak_matkul_3_pilihan - 1);
	$indeks_awal_2_wajib = $indeks_akhir_3_pilihan + 1;
	$indeks_akhir_2_wajib = $indeks_awal_2_wajib + ($banyak_matkul_2_wajib - 1);
	$indeks_awal_1_praktikum = array_search('Praktikum', array_column($data_matkul, 'nama_kategori'));
	$indeks_akhir_1_praktikum = $indeks_awal_1_praktikum + ($banyak_matkul_1_praktikum - 1);

	$indeks_matkul = array('indeks_awal_3_wajib' => $indeks_awal_3_wajib, 'indeks_akhir_3_wajib' => $indeks_akhir_3_wajib, 'indeks_awal_3_pilihan' => $indeks_awal_3_pilihan, 'indeks_akhir_3_pilihan' => $indeks_akhir_3_pilihan, 'indeks_awal_2_wajib' => $indeks_awal_2_wajib, 'indeks_akhir_2_wajib' => $indeks_akhir_2_wajib, 'indeks_awal_1_praktikum' => $indeks_awal_1_praktikum, 'indeks_akhir_1_praktikum' => $indeks_akhir_1_praktikum);

	//Mencari indeks ruangan untuk matkul wajib, praktikum dan pilihan
	$amount_data_ruangan = $objRuangan->getAmountDataRuanganPerKategori();
	$banyak_ruangan_matkul_wajib = (int)$amount_data_ruangan[0];
	$banyak_ruangan_matkul_praktikum = (int)$amount_data_ruangan[1];
	$banyak_ruangan_matkul_pilihan = (int)$amount_data_ruangan[2];
	$indeks_awal_ruangan_matkul_wajib = 0;
	$indeks_akhir_ruangan_matkul_wajib = $indeks_awal_ruangan_matkul_wajib + ($banyak_ruangan_matkul_wajib - 1);
	$indeks_awal_ruangan_matkul_praktikum = $indeks_akhir_ruangan_matkul_wajib + 1;
	$indeks_akhir_ruangan_matkul_praktikum = $indeks_awal_ruangan_matkul_praktikum + ($banyak_ruangan_matkul_praktikum - 1);
	$indeks_awal_ruangan_matkul_pilihan = $indeks_akhir_ruangan_matkul_praktikum + 1;
	$indeks_akhir_ruangan_matkul_pilihan = $indeks_awal_ruangan_matkul_pilihan + ($banyak_ruangan_matkul_pilihan - 1);
	$indeks_ruangan = array('indeks_awal_ruangan_matkul_wajib' => $indeks_awal_ruangan_matkul_wajib, 'indeks_akhir_ruangan_matkul_wajib' => $indeks_akhir_ruangan_matkul_wajib, 'indeks_awal_ruangan_matkul_praktikum' => $indeks_awal_ruangan_matkul_praktikum, 'indeks_akhir_ruangan_matkul_praktikum' => $indeks_akhir_ruangan_matkul_praktikum, 'indeks_awal_ruangan_matkul_pilihan' => $indeks_awal_ruangan_matkul_pilihan, 'indeks_akhir_ruangan_matkul_pilihan' => $indeks_akhir_ruangan_matkul_pilihan);

	//mencari indeks jam untuk matkul 3 sks dan (2sks dan 1 sks)
	$amount_data_jam = $objWaktu->getAmountDataJamPerSks();
	$banyak_jam_matkul_3sks = (int)$amount_data_jam[0];
	$banyak_jam_matkul_2sks = (int)$amount_data_jam[1];

	$indeks_awal_jam_3sks = 0;
	$indeks_akhir_jam_3sks = $indeks_awal_jam_3sks + ($banyak_jam_matkul_3sks - 1);
	$indeks_awal_jam_2sks = $indeks_akhir_jam_3sks + 1;
	$indeks_akhir_jam_2sks = $indeks_awal_jam_2sks + ($banyak_jam_matkul_2sks - 1);
	$indeks_jam = array('indeks_awal_jam_3sks' => $indeks_awal_jam_3sks, 'indeks_akhir_jam_3sks' => $indeks_akhir_jam_3sks, 'indeks_awal_jam_2sks' => $indeks_awal_jam_2sks, 'indeks_akhir_jam_2sks' => $indeks_akhir_jam_2sks);

	//mencari indeks hari
	$status_hari = 1; //aktif
	$amount_data_hari = $objWaktu->getAmountDataHari($status_hari);
	$indeks_awal_hari = 0;
	$indeks_akhir_hari = $amount_data_hari - 1;
	$indeks_hari = array('indeks_awal_hari' => $indeks_awal_hari, 'indeks_akhir_hari' => $indeks_akhir_hari);

	//- 1. Generate populasi awal
	$kromosom = array();
	$nilai_fitness = array();
	for ($indeksKromosom = 0; $indeksKromosom < $jumlah_kromosom; $indeksKromosom++) {
		$kromosom[$indeksKromosom] = array();
		//untuk 3 sks wajib
		for ($indeksGen = 0; $indeksGen <= $indeks_akhir_3_wajib; $indeksGen++) {
			$kromosom[$indeksKromosom][$indeksGen] = array();
			//random hari 
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_hari[rand($indeks_awal_hari, $indeks_akhir_hari)]);
			//random jam 
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_jam[rand($indeks_awal_jam_3sks, $indeks_akhir_jam_3sks)]);
			//random ruangan 
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_ruangan[rand($indeks_awal_ruangan_matkul_wajib, $indeks_akhir_ruangan_matkul_wajib)]);
		}
		//untuk 3 sks pilihan
		for ($indeksGen = $indeks_awal_3_pilihan; $indeksGen <= $indeks_akhir_3_pilihan; $indeksGen++) {
			$kromosom[$indeksKromosom][$indeksGen] = array();
			//random hari 
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_hari[rand($indeks_awal_hari, $indeks_akhir_hari)]);
			//random jam 
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_jam[rand($indeks_awal_jam_3sks, $indeks_akhir_jam_3sks)]);
			//random ruangan 
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_ruangan[rand($indeks_awal_ruangan_matkul_pilihan, $indeks_akhir_ruangan_matkul_pilihan)]);
		}
		//untuk 2 sks
		for ($indeksGen = $indeks_awal_2_wajib; $indeksGen <= $indeks_akhir_2_wajib; $indeksGen++) {
			$kromosom[$indeksKromosom][$indeksGen] = array();
			//random hari 
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_hari[rand($indeks_awal_hari, $indeks_akhir_hari)]);
			//random jam 
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_jam[rand($indeks_awal_jam_2sks, $indeks_akhir_jam_2sks)]);
			//random ruangan 
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_ruangan[rand($indeks_awal_ruangan_matkul_wajib, $indeks_akhir_ruangan_matkul_wajib)]);
		}
		//untuk 1 sks
		for ($indeksGen = $indeks_awal_1_praktikum; $indeksGen <= $indeks_akhir_1_praktikum; $indeksGen++) {
			$kromosom[$indeksKromosom][$indeksGen] = array();
			//random hari
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_hari[rand($indeks_awal_hari, $indeks_akhir_hari)]);
			//random jam 
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_jam[rand($indeks_awal_jam_2sks, $indeks_akhir_jam_2sks)]);
			//random ruangan 
			array_push($kromosom[$indeksKromosom][$indeksGen], $data_ruangan[rand($indeks_awal_ruangan_matkul_praktikum, $indeks_akhir_ruangan_matkul_praktikum)]);
		}
	}
	//- Akhir 1. Generate Populasi Awal

	//set session agar data tidak hilang dan user tidak mengenerate ulang data untuk selang beberapa waktu, misal 1 jam session akan expire
	$_SESSION['kromosom_awal'] = array();
	$_SESSION['kromosom_awal'] = $kromosom;
	$_SESSION['time_stamp'] = time();
	$_SESSION['btn-submit-modal-proses-genetika'] = true;
	$_SESSION['parameter'] = array('jumlah_kromosom' => $jumlah_kromosom, 'maximum_generasi' => $maximum_generasi, 'probabilitas_cross_over' => $probabilitas_cross_over, 'probabilitas_mutasi' => $probabilitas_mutasi, 'metode_cross_over' => $metode_cross_over, 'semester' => $semester, 'banyakGen' => $banyakGen);
	$_SESSION['indeks_matkul'] = array();
	$_SESSION['indeks_matkul'] = $indeks_matkul;
	$_SESSION['indeks_ruangan'] = array();
	$_SESSION['indeks_ruangan'] = $indeks_ruangan;
	$_SESSION['indeks_jam'] = array();
	$_SESSION['indeks_jam'] = $indeks_jam;
	$_SESSION['indeks_hari'] = array();
	$_SESSION['indeks_hari'] = $indeks_hari;
	$_SESSION['data_matkul'] = array();
	$_SESSION['data_matkul'] = $data_matkul;
	$_SESSION['data_hari'] = array();
	$_SESSION['data_hari'] = $data_hari;
	$_SESSION['data_jam'] = array();
	$_SESSION['data_jam'] = $data_jam;
	$_SESSION['data_ruangan'] = array();
	$_SESSION['data_ruangan'] = $data_ruangan;

	//- 2.CrossOver, 3.Mutasi, 4. Seleksi dilakukan selama maximum generasi atau belum ditemukan
	if ($metode_cross_over == "cycle") {
		$_SESSION['waktu_komputasi_awal_cycle'] = time();
		$_SESSION['waktu_komputasi_awal'] = $_SESSION['waktu_komputasi_awal_cycle'];
		$_SESSION['jumlah_kromosom_cycle'] = $jumlah_kromosom;
		$_SESSION['max_generasi_cycle'] = $maximum_generasi;
		$_SESSION['crossover_rate_cycle'] = $probabilitas_cross_over;
		$_SESSION['mutation_rate_cycle'] = $probabilitas_mutasi;
		$_SESSION['optimal_cycle'] = 0;
		$_SESSION['fitness_cycle'] = array();
		// Awal Looping sebanyak max generasi
		for ($indeks_generasi = 0; $indeks_generasi < $maximum_generasi; $indeks_generasi++) {
			/* 2. Cross Over*/
			//- 2.1 Memilih Induk yang akan kawin
			$induk_kromosom_terpilih = getIndukCrossOver($probabilitas_cross_over, $jumlah_kromosom);
			//- Akhir 2.1 Memilih induk yang akan kawin

			//- 2.2 Menentukan kromosom anak hasil persilangan metode CYCLE
			$kromosom_anak_hasil_cross_over = array();
			for ($indeks_induk = 0; $indeks_induk < count($induk_kromosom_terpilih); $indeks_induk += 2) {
				//copy data induk kromosom ke-i ke kromosom anak ke-0 dan copy data induk kromosom ke-i+1 ke kromosom anak ke-1. Setiap perkawinan selalu dihasilkan 2 anak. Jadi indeks kromosom anak selalu 0 dan 1
				$kromosom_anak_hasil_cross_over[0] = array();
				$kromosom_anak_hasil_cross_over[0] = $kromosom[$induk_kromosom_terpilih[$indeks_induk]];
				$kromosom_anak_hasil_cross_over[1] = array();
				$kromosom_anak_hasil_cross_over[1] = $kromosom[$induk_kromosom_terpilih[$indeks_induk + 1]];
				/*
				CYCLE HARI, CYCLE JAM, CYCLE RUANGAN
				- menentukan indeks-indeks gen di dalam kromosom anak yang membentuk cycle. 
				- Selain indeks gen yang membentuk cycle, tukar data-data gen antara anak 0 dan gen-gen pada anak 1
				- Struktur array kromosom anak :
				kromosom_anak_hasil_cross_over[$indeks_kromosom_anak-ke][$indeks_gen][x]
				Jika x = 0 --> menunjukkan hari
				x = 1 --> menunjukkan jam
				x = 2 --> menunjukkan ruangan
				*/
				//Cycle Hari
				$awal_atas = $kromosom_anak_hasil_cross_over[0][0][0]['id_hari'];
				$awal_bawah = $kromosom_anak_hasil_cross_over[1][0][0]['id_hari'];
				$next_atas = $awal_atas;
				$next_bawah = $awal_bawah;
				$gen_cycle_hari = array();
				$indeks_gen_cycle_hari = 0;
				array_push($gen_cycle_hari, $indeks_gen_cycle_hari);
				$start_index_gen_cycle_hari = 1;
				if ($awal_atas != $next_bawah) {
					for ($indeks_gen = $start_index_gen_cycle_hari; $indeks_gen < $banyakGen; $indeks_gen++) {
						if ($kromosom_anak_hasil_cross_over[0][$indeks_gen][0]['id_hari'] == $next_bawah) {
							$next_atas = $kromosom_anak_hasil_cross_over[0][$indeks_gen][0]['id_hari'];
							$next_bawah = $kromosom_anak_hasil_cross_over[1][$indeks_gen][0]['id_hari'];
							//masukan indeks gen ke dalam array cycle
							array_push($gen_cycle_hari, $indeks_gen);
						}
						if ($awal_atas == $next_bawah) {
							break;
						}
					}
				}
				//Cycle Jam. Proses yang dilakukan 2x yaitu untuk 3 sks dan 2 sks
				//cycle jam untuk 3 sks (wajib dan pilihan)
				$gen_cycle_jam = array();
				$indeks_gen_cycle_jam = $indeks_awal_3_wajib; //posisi start indeks cycle untuk matkul-matkul 3 sks
				$awal_atas = $kromosom_anak_hasil_cross_over[0][$indeks_gen_cycle_jam][1]['kode_jam'];
				$awal_bawah = $kromosom_anak_hasil_cross_over[1][$indeks_gen_cycle_jam][1]['kode_jam'];
				$next_atas = $awal_atas;
				$next_bawah = $awal_bawah;
				array_push($gen_cycle_jam, $indeks_gen_cycle_jam);
				$start_index_gen_cycle_jam = $indeks_gen_cycle_jam + 1; //0 + 1 = 1
				if ($awal_atas != $next_bawah) {
					for ($indeks_gen = $start_index_gen_cycle_jam; $indeks_gen <= $indeks_akhir_3_pilihan; $indeks_gen++) {
						if ($kromosom_anak_hasil_cross_over[0][$indeks_gen][1]['kode_jam'] == $next_bawah) {
							$next_atas = $kromosom_anak_hasil_cross_over[0][$indeks_gen][1]['kode_jam'];
							$next_bawah = $kromosom_anak_hasil_cross_over[1][$indeks_gen][1]['kode_jam'];
							//masukan indeks gen ke dalam array cycle
							array_push($gen_cycle_jam, $indeks_gen);
						}
						if ($awal_atas == $next_bawah) {
							break;
						}
					}
				}

				//cycle jam untuk 2 sks dan 1 sks
				$indeks_gen_cycle_jam = $indeks_awal_2_wajib; //posisi start indeks cycle untuk  2 sks dan 1 sks
				$awal_atas = $kromosom_anak_hasil_cross_over[0][$indeks_gen_cycle_jam][1]['kode_jam'];
				$awal_bawah = $kromosom_anak_hasil_cross_over[1][$indeks_gen_cycle_jam][1]['kode_jam'];
				$next_atas = $awal_atas;
				$next_bawah = $awal_bawah;
				array_push($gen_cycle_jam, $indeks_gen_cycle_jam);
				$start_index_gen_cycle_jam = $indeks_gen_cycle_jam + 1; //84 + 1 = 85
				if ($awal_atas != $next_bawah) {
					for ($indeks_gen = $start_index_gen_cycle_jam; $indeks_gen <= $indeks_akhir_1_praktikum; $indeks_gen++) {
						if ($kromosom_anak_hasil_cross_over[0][$indeks_gen][1]['kode_jam'] == $next_bawah) {
							$next_atas = $kromosom_anak_hasil_cross_over[0][$indeks_gen][1]['kode_jam'];
							$next_bawah = $kromosom_anak_hasil_cross_over[1][$indeks_gen][1]['kode_jam'];
							//masukan indeks gen ke dalam array cycle
							array_push($gen_cycle_jam, $indeks_gen);
						}
						if ($awal_atas == $next_bawah) {
							break;
						}
					}
				}

				//Cycle ruangan. Proses yang dilakukan 2x yaitu ruangan untuk (3sks wajib + 2sks) dan (3sks pilihan + 1 sks)
				//cycle ruangan untuk (3sks wajib + 2 sks)
				$gen_cycle_ruangan = array();
				$indeks_gen_cycle_ruangan = $indeks_awal_3_wajib; //posisi start indeks cycle untuk matkul-matkul 3 sks wajib dan 2 sks
				$awal_atas = $kromosom_anak_hasil_cross_over[0][$indeks_gen_cycle_ruangan][2]['id_ruangan'];
				$awal_bawah = $kromosom_anak_hasil_cross_over[1][$indeks_gen_cycle_ruangan][2]['id_ruangan'];
				$next_atas = $awal_atas;
				$next_bawah = $awal_bawah;
				array_push($gen_cycle_ruangan, $indeks_gen_cycle_ruangan);
				$start_index_gen_cycle_ruangan = $indeks_gen_cycle_ruangan + 1; //0 + 1 = 1
				if ($awal_atas != $next_bawah) {
					//TAHAP 1 pencarian cycle pada rentang indeks untuk matkul 3 sks wajib
					//searching cycle dari indeks 1 - 65 untuk matkul-matkul 3 sks wajib
					for ($indeks_gen = $start_index_gen_cycle_ruangan; $indeks_gen <= $indeks_akhir_3_wajib; $indeks_gen++) {
						if ($kromosom_anak_hasil_cross_over[0][$indeks_gen][2]['id_ruangan'] == $next_bawah) {
							$next_atas = $kromosom_anak_hasil_cross_over[0][$indeks_gen][2]['id_ruangan'];
							$next_bawah = $kromosom_anak_hasil_cross_over[1][$indeks_gen][2]['id_ruangan'];
							//masukan indeks gen ke dalam array cycle
							array_push($gen_cycle_ruangan, $indeks_gen);
						}
						//cek jika sudah menemukan cycle, maka break perulangan for
						if ($awal_atas == $next_bawah) {
							break;
						}
					}
					//TAHAP 2 pencarian cycle pada rentang indeks untuk matkul-matkul 2sks. Tahap 2 dilakukan jika pada tahap 1 masih tidak menemukan cycle
					//searching cycle dari indeks 84 - 101 untuk matkul-matkul 2 sks

					//kondisi jika pada tahap 1 masih tidak menemukan cycle, maka pencarian cycle dilanjutkan pada tahap 2
					if ($awal_atas != $next_bawah) {
						$start_index_gen_cycle_ruangan = $indeks_awal_2_wajib;
						for ($indeks_gen = $start_index_gen_cycle_ruangan; $indeks_gen <= $indeks_akhir_2_wajib; $indeks_gen++) {
							if ($kromosom_anak_hasil_cross_over[0][$indeks_gen][2]['id_ruangan'] == $next_bawah) {
								$next_atas = $kromosom_anak_hasil_cross_over[0][$indeks_gen][2]['id_ruangan'];
								$next_bawah = $kromosom_anak_hasil_cross_over[1][$indeks_gen][2]['id_ruangan'];
								//masukan indeks gen ke dalam array cycle
								array_push($gen_cycle_ruangan, $indeks_gen);
							}
							if ($awal_atas == $next_bawah) {
								break;
							}
						}
					}
				}

				//cycle ruangan untuk (3sks pilihan + 1 sks)
				$indeks_gen_cycle_ruangan = $indeks_awal_3_pilihan; //posisi start indeks cycle untuk matkul-matkul 3 sks pilihan dan 1 sks
				$awal_atas = $kromosom_anak_hasil_cross_over[0][$indeks_gen_cycle_ruangan][2]['id_ruangan'];
				$awal_bawah = $kromosom_anak_hasil_cross_over[1][$indeks_gen_cycle_ruangan][2]['id_ruangan'];
				$next_atas = $awal_atas;
				$next_bawah = $awal_bawah;
				array_push($gen_cycle_ruangan, $indeks_gen_cycle_ruangan);
				$start_index_gen_cycle_ruangan = $indeks_gen_cycle_ruangan + 1; //66 + 1 = 67
				if ($awal_atas != $next_bawah) {
					//TAHAP 1 pencarian cycle pada rentang indeks untuk matkul 3 sks pilihan
					//searching cycle dari indeks 67 - 83 untuk matkul-matkul 3 sks pilihan
					for ($indeks_gen = $start_index_gen_cycle_ruangan; $indeks_gen <= $indeks_akhir_3_pilihan; $indeks_gen++) {
						if ($kromosom_anak_hasil_cross_over[0][$indeks_gen][2]['id_ruangan'] == $next_bawah) {
							$next_atas = $kromosom_anak_hasil_cross_over[0][$indeks_gen][2]['id_ruangan'];
							$next_bawah = $kromosom_anak_hasil_cross_over[1][$indeks_gen][2]['id_ruangan'];
							//masukan indeks gen ke dalam array cycle
							array_push($gen_cycle_ruangan, $indeks_gen);
						}
						if ($awal_atas == $next_bawah) {
							break;
						}
					}
					//TAHAP 2 pencarian cycle pada rentang indeks untuk matkul-matkul 1sks. Tahap 2 dilakukan jika pada tahap 1 masih tidak menemukan cycle
					//searching cycle dari indeks 102 - 114 untuk matkul-matkul 1 sks

					//kondisi jika pada tahap 1 masih tidak menemukan cycle, maka pencarian cycle dilanjutkan pada tahap 2
					if ($awal_atas != $next_bawah) {
						$start_index_gen_cycle_ruangan = $indeks_awal_1_praktikum;
						for ($indeks_gen = $start_index_gen_cycle_ruangan; $indeks_gen <= $indeks_akhir_1_praktikum; $indeks_gen++) {
							if ($kromosom_anak_hasil_cross_over[0][$indeks_gen][2]['id_ruangan'] == $next_bawah) {
								$next_atas = $kromosom_anak_hasil_cross_over[0][$indeks_gen][2]['id_ruangan'];
								$next_bawah = $kromosom_anak_hasil_cross_over[1][$indeks_gen][2]['id_ruangan'];
								//masukan indeks gen ke dalam array cycle
								array_push($gen_cycle_ruangan, $indeks_gen);
							}
							if ($awal_atas == $next_bawah) {
								break;
							}
						}
					}
				}

				/*
				Tukar data gen antara kromosom anak ke-0 dan kromosom anak ke-1 yang indeks gen nya tidak ada di dalam cycle. 
				Misal :
				Indeks gen = 0,1,2,3,4,...,15
				Indeks gen yang membentuk cycle = 0,4,5,6,7
				Maka gen-gen yang ditukar antara 2 kromosom anak tersebut adalah
				1,2,3,8,9,10,11,12,13,14,15
				*/
				for ($indeks_gen = 0; $indeks_gen < $banyakGen; $indeks_gen++) {
					//penukaran data gen untuk hari
					//jika indeks_gen tidak ada di dalam array cycle hari, maka tukar data gen
					if (!in_array($indeks_gen, $gen_cycle_hari)) {
						$temp_hari = array();
						$temp_hari = $kromosom_anak_hasil_cross_over[0][$indeks_gen][0];
						$kromosom_anak_hasil_cross_over[0][$indeks_gen][0] = $kromosom_anak_hasil_cross_over[1][$indeks_gen][0];
						$kromosom_anak_hasil_cross_over[1][$indeks_gen][0] = $temp_hari;
					}
					//penukaran data gen untuk jam
					//jika indeks_gen tidak ada di dalam array cycle jam, maka tukar data gen
					if (!in_array($indeks_gen, $gen_cycle_jam)) {
						$temp_jam = array();
						$temp_jam = $kromosom_anak_hasil_cross_over[0][$indeks_gen][1];
						$kromosom_anak_hasil_cross_over[0][$indeks_gen][1] = $kromosom_anak_hasil_cross_over[1][$indeks_gen][1];
						$kromosom_anak_hasil_cross_over[1][$indeks_gen][1] = $temp_jam;
					}
					//penukaran data gen untuk ruangan
					//jika indeks_gen tidak ada di dalam array cycle ruangan, maka tukar data gen
					if (!in_array($indeks_gen, $gen_cycle_ruangan)) {
						$temp_ruangan = array();
						$temp_ruangan = $kromosom_anak_hasil_cross_over[0][$indeks_gen][2];
						$kromosom_anak_hasil_cross_over[0][$indeks_gen][2] = $kromosom_anak_hasil_cross_over[1][$indeks_gen][2];
						$kromosom_anak_hasil_cross_over[1][$indeks_gen][2] = $temp_ruangan;
					}
				}
				//push 2 kromosom anak yang dihasilkan hasil cross over ke dalam array kromosom
				array_push($kromosom, $kromosom_anak_hasil_cross_over[0]);
				array_push($kromosom, $kromosom_anak_hasil_cross_over[1]);

				// unset($kromosom_anak_hasil_cross_over);
				// unset($temp_hari);
				// unset($temp_jam);
				// unset($temp_ruangan);
				// unset($gen_cycle_hari);
				// unset($gen_cycle_jam);
				// unset($gen_cycle_ruangan);
			}
			//- Akhir 2.2 Menentukan kromosom anak hasil cross over

			/* 3. Mutasi Gen*/
			mutasiKromosom($kromosom, $probabilitas_mutasi, $jumlah_kromosom, $banyakGen, $indeks_matkul, $indeks_ruangan, $indeks_jam, $indeks_hari, $data);
			//- Akhir 3.Mutasi Gen

			/* 4. Seleksi Kromosom */
			//- 4.1 Hitung Nilai Fitness Kromosom
			$solusi_ditemukan = hitungFitness($kromosom, $nilai_fitness, $banyakGen, $indeks_matkul, $data_matkul);
			//- Akhir 4.1 Hitung Nilai Fitness

			//- 4.2 Sorting Nilai Fitness Terbaik
			sortingFitness($kromosom, $nilai_fitness);
			//- Akhir 4.2 Sorting Nilai Fitness

			array_push($_SESSION['fitness_cycle'], $nilai_fitness[0]);
			//-4.3 Keluarkan kromosom ke-jumlah_kromosom sampai akhir kromosom karena sudah tidak diperlukan
			popTheRestKromosom($kromosom, $nilai_fitness, $jumlah_kromosom);
			//-Akhir 4.3 Keluarkan Kromosom dan Nilai Fitness Sisa

			/*5. unset  */
			//-5.1 Unset semua variabel
			$induk_kromosom_terpilih = null;
			//-Akhir 5.1 unset semua variabel
			if ($solusi_ditemukan != false) {
				$_SESSION['optimal_cycle'] = $indeks_generasi;
				break;
			}
		}
		//akhir looping sebanyak max generasi
		$_SESSION['waktu_komputasi_akhir_cycle'] = time();
		$_SESSION['waktu_komputasi_akhir'] = $_SESSION['waktu_komputasi_akhir_cycle'];
	} elseif ($metode_cross_over == "npoint") {
		$_SESSION['waktu_komputasi_awal_npoint'] = time();
		$_SESSION['waktu_komputasi_awal'] = $_SESSION['waktu_komputasi_awal_npoint'];
		$_SESSION['jumlah_kromosom_npoint'] = $jumlah_kromosom;
		$_SESSION['max_generasi_npoint'] = $maximum_generasi;
		$_SESSION['crossover_rate_npoint'] = $probabilitas_cross_over;
		$_SESSION['mutation_rate_npoint'] = $probabilitas_mutasi;
		$_SESSION['optimal_npoint'] = 0;
		$_SESSION['fitness_npoint'] = array();
		for ($indeks_generasi = 0; $indeks_generasi < $maximum_generasi; $indeks_generasi++) {
			/* 2. Cross Over*/
			//- 2.1 Memilih Induk yang akan kawin
			$induk_kromosom_terpilih = getIndukCrossOver($probabilitas_cross_over, $jumlah_kromosom);
			//- Akhir 2.1 Memilih induk yang akan kawin

			//- 2.2 Menentukan kromosom anak hasil persilangan metode N POINT
			$kromosom_anak_hasil_cross_over = array();
			for ($indeks_induk = 0; $indeks_induk < count($induk_kromosom_terpilih); $indeks_induk += 2) {
				//Random posisi 1, gen yang akan dicross over
				$posisi_gen_1 = rand(1, $banyakGen - 2);
				//Random posisi 2, gen yang akan dicross over
				$posisi_gen_2 = rand(1, $banyakGen - 2);
				if ($posisi_gen_2 < $posisi_gen_1) {
					//tukar posisi
					$temp = $posisi_gen_2;
					$posisi_gen_2 = $posisi_gen_1;
					$posisi_gen_1 = $temp;
				}
				// KETURUNAN KE - 1
				$indeks_kromosom_anak = 0;
				$kromosom_anak_hasil_cross_over[$indeks_kromosom_anak] = array();
				//masukkan data-data gen pada indeks sebelum posisi_gen_1 ke dalam kromosom_anak ke-1
				for ($indeksGen = 0; $indeksGen < $posisi_gen_1; $indeksGen++) {
					array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk]][$indeksGen]);
				}
				//masukkan data-data gen diantara posisi_gen_1 dan posisi_gen_2 induk setelahnya ke dalam kromosom_anak ke-1
				for ($indeksGen = $posisi_gen_1; $indeksGen < $posisi_gen_2; $indeksGen++) {
					array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk + 1]][$indeksGen]);
				}
				//masukkan data-data gen dari posisi_gen_2 sampai akhir panjang gen ke dalam kromosom_anak ke-1
				for ($indeksGen = $posisi_gen_2; $indeksGen < $banyakGen; $indeksGen++) {
					array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk]][$indeksGen]);
				}
				//push kromosom anak ke dalam array kromosom
				array_push($kromosom, $kromosom_anak_hasil_cross_over[$indeks_kromosom_anak]);

				// KETURUNAN KE - 2
				$indeks_kromosom_anak++;
				$kromosom_anak_hasil_cross_over[$indeks_kromosom_anak] = array();

				//masukkan data-data gen pada indeks sebelum posisi_gen_1 ke dalam kromosom_anak ke-2
				for ($indeksGen = 0; $indeksGen < $posisi_gen_1; $indeksGen++) {
					array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk + 1]][$indeksGen]);
				}
				//masukkan data-data gen diantara posisi_gen_1 dan posisi_gen_2 induk sebelumnya ke dalam kromosom_anak ke-i
				for ($indeksGen = $posisi_gen_1; $indeksGen < $posisi_gen_2; $indeksGen++) {
					array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk]][$indeksGen]);
				}
				//masukkan data-data gen dari posisi_gen_2 sampai akhir panjang gen ke dalam kromosom_anak ke-2
				for ($indeksGen = $posisi_gen_2; $indeksGen < $banyakGen; $indeksGen++) {
					array_push($kromosom_anak_hasil_cross_over[$indeks_kromosom_anak], $kromosom[$induk_kromosom_terpilih[$indeks_induk + 1]][$indeksGen]);
				}
				//push kromosom anak ke dalam array kromosom_baru
				array_push($kromosom, $kromosom_anak_hasil_cross_over[$indeks_kromosom_anak]);
				unset($kromosom_anak_hasil_cross_over);
			}
			//- Akhir 2.2 Menentukan kromosom anak hasil cross over

			/* 3. Mutasi Gen*/
			mutasiKromosom($kromosom, $probabilitas_mutasi, $jumlah_kromosom, $banyakGen, $indeks_matkul, $indeks_ruangan, $indeks_jam, $indeks_hari, $data);
			//- Akhir 3.Mutasi Gen

			/* 4. Seleksi Kromosom */
			//- 4.1 Hitung Nilai Fitness Kromosom
			$solusi_ditemukan = hitungFitness($kromosom, $nilai_fitness, $banyakGen, $indeks_matkul, $data_matkul);
			//- Akhir 4.1 Hitung Nilai Fitness

			//- 4.2 Sorting Nilai Fitness Terbaik
			sortingFitness($kromosom, $nilai_fitness);
			//- Akhir 4.2 Sorting Nilai Fitness
			array_push($_SESSION['fitness_npoint'], $nilai_fitness[0]);

			//-4.3 Keluarkan kromosom ke-jumlah_kromosom sampai akhir kromosom karena sudah tidak diperlukan
			popTheRestKromosom($kromosom, $nilai_fitness, $jumlah_kromosom);
			//-Akhir 4.3 Keluarkan Kromosom dan Nilai Fitness Sisa

			if ($solusi_ditemukan != false) {
				$_SESSION['optimal_npoint'] = $indeks_generasi;
				break;
			}
		}
		// Akhir Perulangan Sebanyak Generasi
		$_SESSION['waktu_komputasi_akhir_npoint'] = time();
		$_SESSION['waktu_komputasi_akhir'] = $_SESSION['waktu_komputasi_akhir_npoint'];
	}
	//- Akhir 2.CrossOver, 3.Mutasi, 4. Seleksi dilakukan selama maximum generasi atau belum ditemukan

	//masukan data kromosom yang sudah akhir generasi ke dalam session
	$_SESSION['kromosom'] = array();
	$_SESSION['nilai_fitness'] = array();
	$_SESSION['kromosom'] = $kromosom;
	$_SESSION['nilai_fitness'] = $nilai_fitness;
	$_SESSION['solusi_ditemukan'] = $solusi_ditemukan;
} elseif (isset($_SESSION['btn-submit-modal-proses-genetika'])) {
	//session akan expired setelah 1 jam
	if (isset($_SESSION['time_stamp']) && time() - $_SESSION['time_stamp'] > 3600) {
		session_destroy();
		session_start();
		//alert session expired
		$objFlash->showSimpleFlash("EXPIRED", "warning", "Waktu telah kadaluarsa. Silahkan generate ulang jadwal", "index.php", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Kembali");
		exit();
	} else {
		//data
		$kromosom = $_SESSION['kromosom'];
		$solusi_ditemukan = $_SESSION['solusi_ditemukan'];
		$nilai_fitness = $_SESSION['nilai_fitness'];
		$data_matkul = $_SESSION['data_matkul'];
		$data_hari = $_SESSION['data_hari'];
		$data_jam = $_SESSION['data_jam'];
		$data_ruangan = $_SESSION['data_ruangan'];
		$banyakGen = count($data_matkul);
		$banyak_hari = count($data_hari);
		$banyak_jam = count($data_jam);
		$banyak_ruangan = count($data_ruangan);
		//parameters
		$jumlah_kromosom = $_SESSION['parameter']['jumlah_kromosom'];
		$maximum_generasi = $_SESSION['parameter']['maximum_generasi'];
		$probabilitas_cross_over = $_SESSION['parameter']['probabilitas_cross_over'];
		$probabilitas_mutasi = $_SESSION['parameter']['probabilitas_mutasi'];
		$metode_cross_over = $_SESSION['parameter']['metode_cross_over'];
		$semester = $_SESSION['parameter']['semester'];
	}
} else {
	$objFlash->showSimpleFlash("JADWAL BELUM DIGENERATE!", "error", "Belum ada informasi jadwal hasil optimasi! Silahkan generate jadwal terlebih dahulu", "index.php", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Kembali");
	exit();
}

$arr_matkul = array();
foreach ($kromosom[0] as $indeks_gen => $gen) {
	$arr_matkul[$indeks_gen] = array();
	$arr_matkul[$indeks_gen][0] = array(); //data hari
	$arr_matkul[$indeks_gen][1] = array(); //data jam
	$arr_matkul[$indeks_gen][2] = array(); //data ruangan
	$arr_matkul[$indeks_gen][3] = array(); //data matkul

	$arr_matkul[$indeks_gen][0] = $gen[0];
	$arr_matkul[$indeks_gen][1] = $gen[1];
	$arr_matkul[$indeks_gen][2] = $gen[2];
	$arr_matkul[$indeks_gen][3] = $data_matkul[$indeks_gen];
}

?>
<?php
// Jika waktu komputasi lebih dari 30 menit maka tampilkan alert
if (round(($_SESSION['waktu_komputasi_akhir'] - $_SESSION['waktu_komputasi_awal']) / 60, 3) >= 30) {
	$objFlash->showSimpleFlash("MAXIMUM TIME COMPUTATION", "error", "Waktu komputasi telah melebihi batas maksimal 30 menit!", "index.php", $confirmButtonColor = "#d33", $cancelButtonColor = "#d33", "Kembali");
	exit();
}

?>
<div class="row">
	<div class="col-6">
		<?php
		if ($solusi_ditemukan == false) {
			$_SESSION['optimal'] = false;
			$filename = "Jadwal Kuliah Belum Optimal";
		} else {
			$_SESSION['optimal'] = true;
			$filename = "Jadwal Perkuliahan Optimal";
		}
		?>
		<table class="table table-bordered">
			<thead class="thead-dark">
				<tr>
					<th scope="col" colspan="2">
						<h3><?= $filename; ?></h3>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">Waktu Komputasi</th>
					<td><?= round(($_SESSION['waktu_komputasi_akhir'] - $_SESSION['waktu_komputasi_awal']) / 60, 3); ?> Menit</td>
				</tr>
				<tr>
					<th scope="row">Metode</th>
					<td><?= ucfirst($metode_cross_over); ?></td>
				</tr>
				<tr>
					<th scope="row">Generasi</th>
					<td><?= $maximum_generasi; ?></td>
				</tr>
				<tr>
					<th scope="row">Jumlah Kromosom</th>
					<td><?= $jumlah_kromosom; ?></td>
				</tr>
				<tr>
					<th scope="row">Probabilitas Cross Over</th>
					<td><?= $probabilitas_cross_over; ?></td>
				</tr>
				<tr>
					<th scope="row">Probabilitas Mutasi</th>
					<td><?= $probabilitas_mutasi; ?></td>
				</tr>
				<tr>
					<th scope="row">Semester</th>
					<td><?= ucfirst($semester); ?></td>
				</tr>
				<tr>
					<th scope="row">Generasi</th>
					<td>
						<?php
						$optimal = false;
						if (isset($_SESSION['optimal_npoint'])) {
							if ($_SESSION['optimal_npoint'] != 0) {
								echo $_SESSION['optimal_npoint'] . " (Generasi Optimal)";
								$optimal = true;
							}
						} elseif (isset($_SESSION['optimal_cycle'])) {
							if ($_SESSION['optimal_cycle'] != 0) {
								echo $_SESSION['optimal_cycle'] . "(Generasi Optimal)";
								$optimal = true;
							}
						}
						if ($optimal == false) {
							echo $_SESSION['parameter']['maximum_generasi'] . " (Belum Optimal)";
						}
						?>
					</td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="filename" id="filename" value="<?= $filename; ?>">
	</div>
</div>
<div class="row">
	<div class="col">
		<table class="table table-bordered mb-4 cell-border" id="table_jadwal_final">
			<thead>
				<tr>
					<th>No</th>
					<th>Hari</th>
					<th>Jam</th>
					<?php
					for ($indeks_ruangan = 0; $indeks_ruangan < count($data_ruangan); $indeks_ruangan++) {
						$ruangan = $data_ruangan[$indeks_ruangan]['nama_ruangan'];
						echo "<th>" . $ruangan . "</th>";
					}
					?>
					<th>SKS</th>
				</tr>
			</thead>
			<tbody>
				<?php
				/*
				indeks ke-0 --> hari
				indeks ke-1 -->jam
				indeks ke-2 ... indeks ke-13 -->ruangan
				*/
				$panjang_indeks_kolom = $banyak_ruangan + 3;
				$panjang_indeks_baris = $banyak_hari * $banyak_jam;
				$indeks_hari = 0;
				$counter_indeks_hari = 0;
				for ($indeks_baris = 0; $indeks_baris < $panjang_indeks_baris; $indeks_baris++) {
					echo "<tr>";
					for ($indeks_kolom = 0; $indeks_kolom <= $panjang_indeks_kolom; $indeks_kolom++) {
						if ($indeks_kolom == 0) {
							echo "<td scope='col'>" . ($indeks_baris + 1) . "</td>";
						} elseif ($indeks_kolom == 1) {
							echo "<td>" . $data_hari[$indeks_hari]['nama_hari'] . "</td>";
						} elseif ($indeks_kolom == 2) {
							echo "<td>" . $data_jam[$indeks_baris % $banyak_jam]['rentang_jam'] . "</td>";
						} elseif ($indeks_kolom > 2 && $indeks_kolom <= $panjang_indeks_kolom - 1) {
							$indeks_gen = searchmatkul($data_hari[$indeks_hari]['nama_hari'], $data_jam[$indeks_baris % $banyak_jam]['rentang_jam'], $data_ruangan[$indeks_kolom - 3]['nama_ruangan'], $arr_matkul);
							if ($indeks_gen != NULL) {
								echo "<td>" . $arr_matkul[$indeks_gen][3]['nama_matkul'] . "<br> [" . $arr_matkul[$indeks_gen][3]['tahun_angkatan'] . " | " . $arr_matkul[$indeks_gen][3]['nama_kelas'] . "] <br> [" . $arr_matkul[$indeks_gen][2]['nama_ruangan'] . "]  <br>" . $arr_matkul[$indeks_gen][3]['nama_dosen'] . "</td>";
							} else {
								echo "<td class='bg-light'></td>";
							}
						} elseif ($indeks_kolom == $panjang_indeks_kolom) {
							echo "<td>" . $data_jam[$indeks_baris % $banyak_jam]['sks_jam'] . "</td>";
						}
					}
					$counter_indeks_hari++;
					//reset counter_indeks_hari ke-0 sesuai banyak jam yang ada
					if ($counter_indeks_hari == $banyak_jam) {
						$counter_indeks_hari = 0;
						$indeks_hari++;
					}
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</div>
</div>