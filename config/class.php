<?php
include 'init.php';

class Dosen
{
	public $conn;
	function __construct()
	{
		global $conn;
		$this->conn = $conn;
	}
	public function getAllDataDosen()
	{
		$queryGetAllDataDosen = "SELECT * FROM dosen";
		$runQueryGetAllDataDosen = $this->conn->query($queryGetAllDataDosen);
		return $runQueryGetAllDataDosen;
	}
	public function checkIsSameDosen($nip_dosen, $nama_dosen)
	{
		$queryCheckIsSameDosen = "SELECT * FROM dosen WHERE nip_dosen = '$nip_dosen' OR nama_dosen = '$nama_dosen' ";
		$runQueryCheckIsSameDosen = $this->conn->query($queryCheckIsSameDosen);
		return $runQueryCheckIsSameDosen;
	}
	public function insertDosen($attrDosen)
	{
		$nip_dosen = $attrDosen['nip_dosen'];
		$nama_dosen = $attrDosen['nama_dosen'];
		$queryInsertDosen = "INSERT INTO dosen (nip_dosen,nama_dosen) VALUES ('$nip_dosen','$nama_dosen')";
		$runQueryInsertDosen = $this->conn->query($queryInsertDosen);
		return $runQueryInsertDosen;
	}
	public function updateSpesificDataDosen($attrDosen)
	{
		$id_dosen = $attrDosen['id_dosen'];
		$nip_dosen = $attrDosen['nip_dosen'];
		$nama_dosen = $attrDosen['nama_dosen'];
		$queryUpdateSpesificDataDosen = "UPDATE dosen SET nip_dosen = '$nip_dosen',nama_dosen = '$nama_dosen' WHERE id_dosen = '$id_dosen'";
		$runQueryUpdateSpesificDataDosen = $this->conn->query($queryUpdateSpesificDataDosen);
		return $runQueryUpdateSpesificDataDosen;
	}
	public function verifyBeforeUpdateSpesificDataDosen($attrDosen)
	{
		$id_dosen = $attrDosen['id_dosen'];
		$nip_dosen = $attrDosen['nip_dosen'];
		$nama_dosen = $attrDosen['nama_dosen'];
		$queryVerifyBeforeUpdateSpesificDataDosen = "SELECT * FROM dosen WHERE id_dosen <> '$id_dosen' AND (nip_dosen='$nip_dosen' OR nama_dosen = '$nama_dosen')";
		$runqueryVerifyBeforeUpdateSpesificDataDosen = $this->conn->query($queryVerifyBeforeUpdateSpesificDataDosen);
		return $runqueryVerifyBeforeUpdateSpesificDataDosen;
	}
	public function getSpesificDataDosen($id_dosen)
	{
		$queryGetSpesificDataDosen = "SELECT * FROM dosen WHERE id_dosen = '$id_dosen'";
		$runQueryGetSpesificDataDosen = $this->conn->query($queryGetSpesificDataDosen);
		return $runQueryGetSpesificDataDosen;
	}
	public function getSpesificDosenByName($search_dosen)
	{
		$queryGetSpesificDosenByName = "SELECT * FROM dosen WHERE nama_dosen LIKE '%$search_dosen%'";
		$runqueryGetSpesificDosenByName = $this->conn->query($queryGetSpesificDosenByName);
		return $runqueryGetSpesificDosenByName;
	}
	public function deleteSpesificDosen($id_dosen)
	{
		$queryDeleteSpesificDosen = "DELETE FROM dosen WHERE id_dosen = '$id_dosen'";
		$runqueryDeleteSpesificDosen = $this->conn->query($queryDeleteSpesificDosen);
		return $runqueryDeleteSpesificDosen;
	}
}
class Matkul
{
	public $conn;
	function __construct()
	{
		global $conn;
		$this->conn = $conn;
	}
	public function getAllDataMatkul()
	{
		$queryGetAllDataMatkul = "SELECT * FROM matkul LEFT JOIN kategorimatkul USING (id_kategorimatkul)";
		$runqueryGetAllDataMatkul = $this->conn->query($queryGetAllDataMatkul);
		return $runqueryGetAllDataMatkul;
	}
	public function getSpesificDataMatkul($id_matkul)
	{
		$queryGetSpesificDataMatkul = "SELECT * FROM matkul LEFT JOIN kategorimatkul USING (id_kategorimatkul) WHERE id_matkul = '$id_matkul'";
		$runqueryGetSpesificDataMatkul = $this->conn->query($queryGetSpesificDataMatkul);
		return $runqueryGetSpesificDataMatkul;
	}
	public function getAllDataMatkulSemesterGanjil()
	{
		$queryGetAllDataMatkulSemesterGanjil = "SELECT * FROM matkul WHERE semester_matkul % 2 <> 0";
		$runqueryGetAllDataMatkulSemesterGanjil = $this->conn->query($queryGetAllDataMatkulSemesterGanjil);
		return $runqueryGetAllDataMatkulSemesterGanjil;
	}
	public function getAllDataDetailMatkul()
	{
		$queryGetAllDataDetailMatkul = "SELECT * FROM detailmatkul INNER JOIN matkul USING(id_matkul) INNER JOIN dosen USING(id_dosen) INNER JOIN detailangkatan USING(id_detailangkatan) INNER JOIN kelas USING(id_kelas) INNER JOIN angkatan USING(id_angkatan) INNER JOIN kategorimatkul USING(id_kategorimatkul) ORDER BY matkul.sks_matkul DESC ,matkul.semester_matkul ASC, matkul.nama_matkul ASC, kelas.nama_kelas ASC";
		$runQueryGetAllDataDetailMatkul = $this->conn->query($queryGetAllDataDetailMatkul);
		return $runQueryGetAllDataDetailMatkul;
	}
	public function getAllDataDetailMatkulSemesterGanjil()
	{
		$queryGetAllDataDetailMatkulSemesterGanjil = "SELECT * FROM detailmatkul INNER JOIN matkul USING(id_matkul) INNER JOIN dosen USING(id_dosen) INNER JOIN detailangkatan USING(id_detailangkatan) INNER JOIN kelas USING(id_kelas) INNER JOIN angkatan USING(id_angkatan) INNER JOIN kategorimatkul USING(id_kategorimatkul) WHERE matkul.semester_matkul % 2 <>0 ORDER BY matkul.sks_matkul DESC ,matkul.semester_matkul ASC, matkul.nama_matkul ASC, kelas.nama_kelas ASC";
		$runqueryGetAllDataDetailMatkulSemesterGanjil = $this->conn->query($queryGetAllDataDetailMatkulSemesterGanjil);
		return $runqueryGetAllDataDetailMatkulSemesterGanjil;
	}
	public function getAllDataDetailMatkulSemesterGenap()
	{
		$queryGetAllDataDetailMatkulSemesterGenap = "SELECT * FROM detailmatkul INNER JOIN matkul USING(id_matkul) INNER JOIN dosen USING(id_dosen) INNER JOIN detailangkatan USING(id_detailangkatan) INNER JOIN kelas USING(id_kelas) INNER JOIN angkatan USING(id_angkatan) INNER JOIN kategorimatkul USING(id_kategorimatkul) WHERE matkul.semester_matkul % 2 = 0 ORDER BY matkul.sks_matkul DESC ,matkul.semester_matkul ASC, matkul.nama_matkul ASC, kelas.nama_kelas ASC";
		$runqueryGetAllDataDetailMatkulSemesterGenap = $this->conn->query($queryGetAllDataDetailMatkulSemesterGenap);
		return $runqueryGetAllDataDetailMatkulSemesterGenap;
	}
	public function getSpesificDataDetailMatkul($id_detailmatkul)
	{
		$queryGetSpesificDataDetailMatkul = "SELECT * FROM detailmatkul INNER JOIN matkul USING(id_matkul) INNER JOIN dosen USING(id_dosen) INNER JOIN detailangkatan USING(id_detailangkatan) INNER JOIN kelas USING(id_kelas) INNER JOIN angkatan USING(id_angkatan) INNER JOIN kategorimatkul USING(id_kategorimatkul) WHERE id_detailmatkul = '$id_detailmatkul'";
		$runqueryGetSpesificDataDetailMatkul = $this->conn->query($queryGetSpesificDataDetailMatkul);
		return $runqueryGetSpesificDataDetailMatkul;
	}
	public function verifyBeforeUpdateSpesificDataDetailMatkul($attrMatkul)
	{
		$id_detailmatkul = $attrMatkul['id_detailmatkul'];
		$id_matkul = $attrMatkul['id_matkul'];
		$id_dosen = $attrMatkul['id_dosen'];
		$id_detailangkatan = $attrMatkul['id_detailangkatan'];
		$queryVerifyBeforeUpdateSpesificDataDetailMatkul = "SELECT * FROM detailmatkul WHERE id_detailmatkul<>'$id_detailmatkul' AND (id_matkul = '$id_matkul' AND id_detailangkatan = '$id_detailangkatan')";
		$runQueryVerifyBeforeUpdateSpesificDataDetailMatkul = $this->conn->query($queryVerifyBeforeUpdateSpesificDataDetailMatkul);
		return $runQueryVerifyBeforeUpdateSpesificDataDetailMatkul;
	}
	public function checkIsSameMatkul($kode_matkul, $nama_matkul)
	{
		$queryCheckIsSameMatkul = "SELECT * FROM matkul WHERE kode_matkul = '$kode_matkul' OR nama_matkul = '$nama_matkul'";
		$runqueryCheckIsSameMatkul = $this->conn->query($queryCheckIsSameMatkul);
		return $runqueryCheckIsSameMatkul;
	}
	public function checkIsSameStatusMatkulAndStatusAngkatan($id_matkul, $id_detailangkatan)
	{
		$isSame = false;
		$queryGetIdKategoriMatkul = "SELECT id_kategorimatkul FROM matkul WHERE id_matkul = '$id_matkul'";
		$runQueryGetIdKategoriMatkul = $this->conn->query($queryGetIdKategoriMatkul);
		$get_data = $runQueryGetIdKategoriMatkul->fetch_assoc();
		$id_kategorimatkul = $get_data['id_kategorimatkul'];

		$queryGetIdStatusKelas = "SELECT id_statuskelas FROM detailangkatan WHERE id_detailangkatan = '$id_detailangkatan'";
		$runqueryGetIdStatusKelas = $this->conn->query($queryGetIdStatusKelas);
		$get_data = $runqueryGetIdStatusKelas->fetch_assoc();
		$id_statuskelas = $get_data['id_statuskelas'];
		if ($id_statuskelas == $id_kategorimatkul) {
			$isSame = true;
		}
		return $isSame;
	}
	public function checkIsSameDetailMatkul($id_matkul, $id_detailangkatan)
	{
		$queryCheckIsSameDetailMatkul = "SELECT * FROM detailmatkul WHERE id_matkul = '$id_matkul' AND id_detailangkatan = '$id_detailangkatan'";
		$runqueryCheckIsSameDetailMatkul = $this->conn->query($queryCheckIsSameDetailMatkul);
		return $runqueryCheckIsSameDetailMatkul;
	}

	public function insertMatkul($attrMatkul)
	{
		$kode_matkul = $attrMatkul['kode_matkul'];
		$nama_matkul = $attrMatkul['nama_matkul'];
		$sks_matkul = $attrMatkul['sks_matkul'];
		$semester_matkul = $attrMatkul['semester_matkul'];
		$id_kategorimatkul = $attrMatkul['id_kategorimatkul'];
		$queryInsertMatkul = "INSERT INTO matkul (kode_matkul,nama_matkul,sks_matkul,semester_matkul,id_kategorimatkul) VALUES('$kode_matkul','$nama_matkul','$sks_matkul','$semester_matkul','$id_kategorimatkul')";
		$runqueryInsertMatkul = $this->conn->query($queryInsertMatkul);
		return $runqueryInsertMatkul;
	}
	public function insertDetailMatkul($attrMatkul)
	{
		$id_matkul = $attrMatkul['id_matkul'];
		$id_dosen = $attrMatkul['id_dosen'];
		$id_detailangkatan = $attrMatkul['id_detailangkatan'];
		$queryInsertDetailMatkul = "INSERT INTO detailmatkul (id_matkul,id_dosen,id_detailangkatan) VALUES('$id_matkul','$id_dosen','$id_detailangkatan') ";
		$runQueryInsertDetailMatkul = $this->conn->query($queryInsertDetailMatkul);
		return $runQueryInsertDetailMatkul;
	}
	public function updateSpesificDataMatkul($attrMatkul)
	{
		$id_matkul = $attrMatkul['id_matkul'];
		$kode_matkul = $attrMatkul['kode_matkul'];
		$nama_matkul = $attrMatkul['nama_matkul'];
		$sks_matkul = $attrMatkul['sks_matkul'];
		$semester_matkul = $attrMatkul['semester_matkul'];
		$id_kategorimatkul = $attrMatkul['id_kategorimatkul'];
		$queryUpdateSpesificDataMatkul = "UPDATE matkul SET kode_matkul = '$kode_matkul',nama_matkul = '$nama_matkul',sks_matkul = '$sks_matkul',semester_matkul = '$semester_matkul',id_kategorimatkul = '$id_kategorimatkul' WHERE id_matkul = '$id_matkul'";
		$runQueryUpdateSpesificDataMatkul = $this->conn->query($queryUpdateSpesificDataMatkul);
		return $runQueryUpdateSpesificDataMatkul;
	}
	public function updateSpesificDataDetailMatkul($attrMatkul)
	{
		$id_detailmatkul = $attrMatkul['id_detailmatkul'];
		$id_matkul = $attrMatkul['id_matkul'];
		$id_dosen = $attrMatkul['id_dosen'];
		$id_detailangkatan = $attrMatkul['id_detailangkatan'];
		$queryUpdateSpesificDataDetailMatkul = "UPDATE detailmatkul SET id_matkul = '$id_matkul',id_dosen = '$id_dosen',id_detailangkatan = '$id_detailangkatan' WHERE id_detailmatkul = '$id_detailmatkul'";
		$runqueryUpdateSpesificDataDetailMatkul = $this->conn->query($queryUpdateSpesificDataDetailMatkul);
		return $runqueryUpdateSpesificDataDetailMatkul;
	}
	public function deleteSpesificMatkul($id_matkul)
	{
		$queryDeleteSpesificMatkul = "DELETE FROM matkul WHERE id_matkul = '$id_matkul'";
		$runqueryDeleteSpesificMatkul = $this->conn->query($queryDeleteSpesificMatkul);
		return $runqueryDeleteSpesificMatkul;
	}
	public function deleteSpesificDetailMatkul($id_detailmatkul)
	{
		$queryDeleteSpesificDetailMatkul = "DELETE FROM detailmatkul WHERE id_detailmatkul = '$id_detailmatkul'";
		$runQueryDeleteSpesificDetailMatkul = $this->conn->query($queryDeleteSpesificDetailMatkul);
		return $runQueryDeleteSpesificDetailMatkul;
	}
	public function verifyBeforeUpdateSpesificDataMatkul($attrMatkul)
	{
		$id_matkul = $attrMatkul['id_matkul'];
		$kode_matkul = $attrMatkul['kode_matkul'];
		$nama_matkul = $attrMatkul['nama_matkul'];
		$queryVerifyBeforeUpdateSpesificDataMatkul = "SELECT * FROM matkul WHERE id_matkul <> '$id_matkul' AND (kode_matkul='$kode_matkul' OR nama_matkul = '$nama_matkul')";
		$runQueryVerifyBeforeUpdateSpesificDataMatkul = $this->conn->query($queryVerifyBeforeUpdateSpesificDataMatkul);
		return $runQueryVerifyBeforeUpdateSpesificDataMatkul;
	}
	public function getAllDataKategoriMatkul()
	{
		$queryGetAllDataKategoriMatkul = "SELECT * FROM kategorimatkul";
		$runqueryGetAllDataKategoriMatkul = $this->conn->query($queryGetAllDataKategoriMatkul);
		return $runqueryGetAllDataKategoriMatkul;
	}
	public function getAmountDataMatkulPerKategori($semester)
	{
		$amount_data_matkul = array();
		$arr_nama_kategori = array('Wajib', 'Pilihan', 'Wajib', 'Praktikum');
		$arr_sks_matkul = array(3, 3, 2, 1);
		if ($semester == "ganjil") {
			for ($i = 0; $i < count($arr_nama_kategori); $i++) {
				$nama_kategori = $arr_nama_kategori[$i];
				$sks_matkul = $arr_sks_matkul[$i];
				$queryGetAmountMatkul = "SELECT COUNT(detailmatkul.id_detailmatkul) AS amountdatamatkul FROM detailmatkul INNER JOIN matkul USING(id_matkul) INNER JOIN dosen USING(id_dosen) INNER JOIN detailangkatan USING(id_detailangkatan) INNER JOIN kelas USING(id_kelas) INNER JOIN angkatan USING(id_angkatan) INNER JOIN kategorimatkul USING(id_kategorimatkul) WHERE matkul.semester_matkul % 2 <> 0 AND kategorimatkul.nama_kategori = '$nama_kategori' AND matkul.sks_matkul = '$sks_matkul'  ORDER BY matkul.sks_matkul DESC ,matkul.semester_matkul ASC, matkul.nama_matkul ASC, kelas.nama_kelas ASC";
				$runQueryGetAmountMatkul = $this->conn->query($queryGetAmountMatkul);
				$get = $runQueryGetAmountMatkul->fetch_assoc();
				array_push($amount_data_matkul, $get['amountdatamatkul']);
			}
		} elseif ($semester == "genap") {
			for ($i = 0; $i < count($arr_nama_kategori); $i++) {
				$nama_kategori = $arr_nama_kategori[$i];
				$sks_matkul = $arr_sks_matkul[$i];
				$queryGetAmountMatkul = "SELECT COUNT(detailmatkul.id_detailmatkul) AS amountdatamatkul FROM detailmatkul INNER JOIN matkul USING(id_matkul) INNER JOIN dosen USING(id_dosen) INNER JOIN detailangkatan USING(id_detailangkatan) INNER JOIN kelas USING(id_kelas) INNER JOIN angkatan USING(id_angkatan) INNER JOIN kategorimatkul USING(id_kategorimatkul) WHERE matkul.semester_matkul % 2 = 0 AND kategorimatkul.nama_kategori = '$nama_kategori' AND matkul.sks_matkul = '$sks_matkul'  ORDER BY matkul.sks_matkul DESC ,matkul.semester_matkul ASC, matkul.nama_matkul ASC, kelas.nama_kelas ASC";
				$runQueryGetAmountMatkul = $this->conn->query($queryGetAmountMatkul);
				$get = $runQueryGetAmountMatkul->fetch_assoc();
				array_push($amount_data_matkul, $get['amountdatamatkul']);
			}
		}
		return $amount_data_matkul;
	}
	public function getSpesificMatkulByName($name_matkul)
	{
		$queryGetSpesificMatkulByName = "SELECT * FROM matkul WHERE nama_matkul LIKE '%$name_matkul%'";
		$runqueryGetSpesificMatkulByName = $this->conn->query($queryGetSpesificMatkulByName);
		return $runqueryGetSpesificMatkulByName;
	}
}
class Angkatan
{
	public $conn;
	function __construct()
	{
		global $conn;
		$this->conn = $conn;
	}
	public function getAllDataAngkatan()
	{
		$queryGetAllDataAngkatan = "SELECT * FROM angkatan LEFT JOIN statusangkatan USING(id_statusangkatan) ORDER BY tahun_angkatan ASC";
		$runqueryGetAllDataAngkatan = $this->conn->query($queryGetAllDataAngkatan);
		return $runqueryGetAllDataAngkatan;
	}
	public function getAllDataAngkatanWhereStatusAngkatan($nama_statusangkatan)
	{
		$queryGetAllDataAngkatanWhereLulus = "SELECT * FROM angkatan INNER JOIN statusangkatan USING(id_statusangkatan) WHERE nama_statusangkatan = '$nama_statusangkatan'";
		$runqueryGetAllDataAngkatanWhereLulus = $this->conn->query($queryGetAllDataAngkatanWhereLulus);
		return $runqueryGetAllDataAngkatanWhereLulus;
	}
	public function getAllDataStatusAngkatan()
	{
		$queryGetAllDataStatusAngkatan = "SELECT * FROM statusangkatan";
		$runqueryGetAllDataStatusAngkatan = $this->conn->query($queryGetAllDataStatusAngkatan);
		return $runqueryGetAllDataStatusAngkatan;
	}
	public function checkIsSameAngkatan($tahun_angkatan)
	{
		$queryCheckIsSameAngkatan = "SELECT * FROM angkatan WHERE tahun_angkatan = '$tahun_angkatan'";
		$runqueryCheckIsSameAngkatan = $this->conn->query($queryCheckIsSameAngkatan);
		return $runqueryCheckIsSameAngkatan;
	}
	public function checkIsSameDetailAngkatan($attrAngkatan)
	{
		$id_angkatan = $attrAngkatan['id_angkatan'];
		$id_kelas = $attrAngkatan['id_kelas'];
		$id_statuskelas = $attrAngkatan['id_statuskelas'];
		$queryCheckIsSameDetailAngkatan = "SELECT * FROM detailangkatan WHERE id_angkatan = '$id_angkatan' AND id_kelas = '$id_kelas' AND id_statuskelas = '$id_statuskelas'";
		$runqueryCheckIsSameDetailAngkatan = $this->conn->query($queryCheckIsSameDetailAngkatan);
		return $runqueryCheckIsSameDetailAngkatan;
	}
	public function insertAngkatan($attrAngkatan)
	{
		$tahun_angkatan = $attrAngkatan['tahun_angkatan'];
		$id_statusangkatan = $attrAngkatan['id_statusangkatan'];
		$queryInsertAngkatan = "INSERT INTO angkatan (tahun_angkatan,id_statusangkatan) VALUES ('$tahun_angkatan','$id_statusangkatan')";
		$runQueryInsertAngkatan = $this->conn->query($queryInsertAngkatan);
		return $runQueryInsertAngkatan;
	}
	public function getSpesificDataAngkatan($id_angkatan)
	{
		$queryGetSpesificDataAngkatan = "SELECT * FROM angkatan INNER JOIN statusangkatan USING (id_statusangkatan) WHERE id_angkatan = '$id_angkatan'";
		$runQueryGetSpesificDataAngkatan = $this->conn->query($queryGetSpesificDataAngkatan);
		return $runQueryGetSpesificDataAngkatan;
	}
	public function updateSpesificDataAngkatan($attrAngkatan)
	{
		$id_angkatan = $attrAngkatan['id_angkatan'];
		$id_statusangkatan = $attrAngkatan['id_statusangkatan'];
		$queryUpdateSpesificDataAngkatan = "UPDATE angkatan SET id_statusangkatan = '$id_statusangkatan' WHERE id_angkatan = '$id_angkatan'";
		$runQueryUpdateSpesificDataAngkatan = $this->conn->query($queryUpdateSpesificDataAngkatan);
		return $runQueryUpdateSpesificDataAngkatan;
	}
	public function getAllDataDetailAngkatan()
	{
		$queryGetAllDataDetailAngkatan = "SELECT * FROM detailangkatan INNER JOIN angkatan USING(id_angkatan) INNER JOIN kelas USING(id_kelas) INNER JOIN statusangkatan USING (id_statusangkatan) INNER JOIN kategorimatkul ON detailangkatan.id_statuskelas = kategorimatkul.id_kategorimatkul ORDER BY angkatan.tahun_angkatan ASC,kelas.nama_kelas ASC";
		$runqueryGetAllDataDetailAngkatan = $this->conn->query($queryGetAllDataDetailAngkatan);
		return $runqueryGetAllDataDetailAngkatan;
	}
	public function getAllDataDetailAngkatanWhereStatusAngkatan($nama_statusangkatan)
	{
		$queryGetAllDataDetailAngkatanWhereStatusAngkatan = "SELECT * FROM detailangkatan INNER JOIN angkatan USING(id_angkatan) INNER JOIN kelas USING(id_kelas) INNER JOIN statusangkatan USING (id_statusangkatan) INNER JOIN kategorimatkul ON detailangkatan.id_statuskelas = kategorimatkul.id_kategorimatkul WHERE nama_statusangkatan = '$nama_statusangkatan' ORDER BY angkatan.tahun_angkatan ASC,kelas.nama_kelas ASC";
		$runqueryGetAllDataDetailAngkatanWhereStatusAngkatan = $this->conn->query($queryGetAllDataDetailAngkatanWhereStatusAngkatan);
		return $runqueryGetAllDataDetailAngkatanWhereStatusAngkatan;
	}
	public function getSpesificDataDetailAngkatan($id_detailangkatan)
	{
		$queryGetSpesificDataDetailAngkatan = "SELECT * FROM detailangkatan INNER JOIN angkatan USING(id_angkatan) INNER JOIN kelas USING(id_kelas) INNER JOIN kategorimatkul ON detailangkatan.id_statuskelas = kategorimatkul.id_kategorimatkul WHERE id_detailangkatan = '$id_detailangkatan'";
		$runqueryGetSpesificDataDetailAngkatan = $this->conn->query($queryGetSpesificDataDetailAngkatan);
		return $runqueryGetSpesificDataDetailAngkatan;
	}
	public function insertDetailAngkatan($attrAngkatan)
	{
		$id_angkatan = $attrAngkatan['id_angkatan'];
		$id_kelas = $attrAngkatan['id_kelas'];
		$peserta_kelas = $attrAngkatan['peserta_kelas'];
		$id_statuskelas = $attrAngkatan['id_statuskelas'];
		$queryInsertDetailAngkatan = "INSERT INTO detailangkatan (id_angkatan,id_kelas,peserta_kelas,id_statuskelas) VALUES ('$id_angkatan','$id_kelas','$peserta_kelas','$id_statuskelas')";
		$runQueryInsertDetailAngkatan = $this->conn->query($queryInsertDetailAngkatan);
		return $runQueryInsertDetailAngkatan;
	}
	public function updateSpesificDetailAngkatan($angkatan)
	{
		$id_detailangkatan = $angkatan['id_detailangkatan'];
		$peserta_kelas = $angkatan['peserta_kelas'];
		$queryUpdateSpesificDetailAngkatan = "UPDATE detailangkatan SET peserta_kelas = '$peserta_kelas' WHERE id_detailangkatan = '$id_detailangkatan'";
		$runQueryUpdateSpesificDetailAngkatan = $this->conn->query($queryUpdateSpesificDetailAngkatan);
		return $runQueryUpdateSpesificDetailAngkatan;
	}
	public function deleteSpesificAngkatan($id_angkatan)
	{
		$queryDeleteSpesificAngkatan = "DELETE FROM angkatan WHERE id_angkatan = '$id_angkatan'";
		$runqueryDeleteSpesificAngkatan = $this->conn->query($queryDeleteSpesificAngkatan);
		return $runqueryDeleteSpesificAngkatan;
	}
	public function deleteSpesificDetailAngkatan($id_detailangkatan)
	{
		$queryDeleteSpesificDetailAngkatan = "DELETE FROM detailangkatan WHERE id_detailangkatan = '$id_detailangkatan'";
		$runQueryDeleteSpesificDetailAngkatan = $this->conn->query($queryDeleteSpesificDetailAngkatan);
		return $runQueryDeleteSpesificDetailAngkatan;
	}
}
class Kelas
{
	public $conn;
	function __construct()
	{
		global $conn;
		$this->conn = $conn;
	}
	public function getAllDataKelas()
	{
		$queryGetAllDataKelas = "SELECT * FROM kelas ORDER BY nama_kelas ASC";
		$runqueryGetAllDataKelas = $this->conn->query($queryGetAllDataKelas);
		return $runqueryGetAllDataKelas;
	}
	public function getAllDataAlfabetKelas()
	{
		$queryGetAllDataAlfabetKelas = "SELECT * FROM alfabetkelas";
		$runqueryGetAllDataAlfabetKelas = $this->conn->query($queryGetAllDataAlfabetKelas);
		return $runqueryGetAllDataAlfabetKelas;
	}
	public function getSpesificDataKelas($id_kelas)
	{
		$queryGetSpesificDataKelas = "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'";
		$runqueryGetSpesificDataKelas = $this->conn->query($queryGetSpesificDataKelas);
		return $runqueryGetSpesificDataKelas;
	}
	public function checkIsSameKelas($nama_kelas)
	{
		$queryCheckIsSameKelas = "SELECT * FROM kelas WHERE nama_kelas ='$nama_kelas'";
		$runQueryCheckIsSameKelas = $this->conn->query($queryCheckIsSameKelas);
		return $runQueryCheckIsSameKelas;
	}
	public function insertKelas($attrKelas)
	{
		$nama_kelas = $attrKelas['nama_kelas'];
		$queryInsertKelas = "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')";
		$runQueryInsertKelas = $this->conn->query($queryInsertKelas);
		return $runQueryInsertKelas;
	}
	public function deleteSpesificKelas($id_kelas)
	{
		$queryDeleteSpesificKelas = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";
		$runQueryDeleteSpesificKelas = $this->conn->query($queryDeleteSpesificKelas);
		return $runQueryDeleteSpesificKelas;
	}
	public function insertDetailKelas($attrKelas)
	{
		$id_detailangkatan = $attrKelas['id_detailangkatan'];
		$id_kategorimatkul = $attrKelas['id_kategorimatkul'];
		$peserta_kelas = $attrKelas['peserta_kelas'];
		$queryInsertDetailKelas = "INSERT INTO detailkelas (id_detailangkatan,id_kategorimatkul,peserta_kelas) VALUES ('$id_detailangkatan','$id_kategorimatkul','$peserta_kelas')";
		$runQueryInsertDetailKelas = $this->conn->query($queryInsertDetailKelas);
		return $runQueryInsertDetailKelas;
	}
	public function updateDetailKelas($attrKelas)
	{
		$id_detailkelas = $attrKelas['id_detailkelas'];
		$id_angkatan = $attrKelas['id_angkatan'];
		$id_kelas = $attrKelas['id_kelas'];
		$peserta_kelas = $attrKelas['peserta_kelas'];
		$queryUpdateDetailKelas = "UPDATE detailkelas SET id_angkatan = '$id_angkatan', id_kelas = '$id_kelas', peserta_kelas ='$peserta_kelas' WHERE id_detailkelas = $id_detailkelas";
		$runQueryUpdateDetailKelas = $this->conn->query($queryUpdateDetailKelas);
		return $runQueryUpdateDetailKelas;
	}
	public function getAllDataDetailKelas()
	{
		$queryGetAllDataDetailKelas = "SELECT * FROM detailkelas INNER JOIN detailangkatan USING(id_detailangkatan) INNER JOIN kelas USING(id_kelas) INNER JOIN angkatan USING(id_angkatan) INNER JOIN kategorimatkul USING(id_kategorimatkul) ORDER BY angkatan.tahun_angkatan ASC, kelas.nama_kelas ASC";
		$runqueryGetAllDataDetailKelas = $this->conn->query($queryGetAllDataDetailKelas);
		return $runqueryGetAllDataDetailKelas;
	}
}
class User
{
	public $conn;
	function __construct()
	{
		global $conn;
		$this->conn = $conn;
	}
	public function checkIsSameUser($data, $target)
	{
		$email_user = $data['email_user'];
		$hp_user = $data['hp_user'];
		$username_user = $data['username_user'];
		if ($target == "all") {
			$queryCheckIsSameUser = "SELECT id_user FROM user WHERE email_user = '$email_user' OR hp_user = '$hp_user' OR username_user = '$username_user'";
		} elseif ($target == "spesific") {
			$id_user = $data['id_user'];
			$queryCheckIsSameUser = "SELECT id_user FROM user WHERE id_user <> '$id_user' AND (email_user = '$email_user' OR hp_user = '$hp_user' OR username_user = '$username_user') ";
		}
		$runQueryCheckIsSameUser = $this->conn->query($queryCheckIsSameUser);
		return $runQueryCheckIsSameUser;
	}
	public function verifyBeforeLoginUser($username_user)
	{
		$queryVerifyBeforeLoginUser = "SELECT * FROM user WHERE username_user = '$username_user'";
		$runQueryVerifyBeforeLoginUser = $this->conn->query($queryVerifyBeforeLoginUser);
		$user = $runQueryVerifyBeforeLoginUser->fetch_assoc();
		return $user;
	}
	public function insertNewUser($data)
	{
		$nama_user = $data['nama_user'];
		$email_user = $data['email_user'];
		$hp_user = $data['hp_user'];
		$username_user = $data['username_user'];
		$password_user = $data['password_user'];
		$status_user = $data['status_user'];
		$queryInsertNewUser = "INSERT INTO user (nama_user,email_user,hp_user,username_user,password_user,status_user) VALUES ('$nama_user','$email_user','$hp_user','$username_user','$password_user','$status_user')";
		$runqueryInsertNewUser = $this->conn->query($queryInsertNewUser);
		return $runqueryInsertNewUser;
	}
	public function updateSpesificDataUser($data)
	{
		$id_user = $data['id_user'];
		$email_user = $data['email_user'];
		$nama_user = $data['nama_user'];
		$hp_user = $data['hp_user'];
		$username_user = $data['username_user'];
		$password_user = $data['password_user'];
		$queryUpdateSpesificDataUser = "UPDATE user SET nama_user = '$nama_user',email_user = '$email_user',hp_user = '$hp_user', username_user = '$username_user',password_user = '$password_user' WHERE id_user = '$id_user'";
		$runQueryUpdateSpesificDataUser = $this->conn->query($queryUpdateSpesificDataUser);
		return $runQueryUpdateSpesificDataUser;
	}
	public function getSpesificDataUser($id_user)
	{
		$queryGetSpesificDataUser = "SELECT * FROM user WHERE id_user = '$id_user'";
		$runQueryGetSpesificDataUser = $this->conn->query($queryGetSpesificDataUser);
		return $runQueryGetSpesificDataUser;
	}
}
class Waktu
{
	public $conn;
	function __construct()
	{
		global $conn;
		$this->conn = $conn;
	}
	public function getAllDataHari()
	{
		$queryGetAllDataHari = "SELECT * FROM hari LEFT JOIN status USING(id_status)";
		$runqueryGetAllDataHari = $this->conn->query($queryGetAllDataHari);
		return $runqueryGetAllDataHari;
	}
	public function getAllDataHariAktif()
	{
		$nama_status = "Aktif";
		$queryGetAllDataHariAktif = "SELECT * FROM hari INNER JOIN status USING(id_status) WHERE status.nama_status = '$nama_status'";
		$runqueryGetAllDataHariAktif = $this->conn->query($queryGetAllDataHariAktif);
		return $runqueryGetAllDataHariAktif;
	}
	public function getSpesificDataHari($id_hari)
	{
		$queryGetSpesificDataHari = "SELECT * FROM hari LEFT JOIN status USING(id_status) WHERE id_hari = '$id_hari'";
		$runqueryGetSpesificDataHari = $this->conn->query($queryGetSpesificDataHari);
		return $runqueryGetSpesificDataHari;
	}
	public function getAmountDataHari($status_hari)
	{
		// statushari = 1 --> aktif, statushari =2 -->tidak aktif
		$queryGetAmountDataHari = "SELECT COUNT(*) AS amount_hari FROM hari WHERE id_status = '$status_hari'";
		$runQueryGetAmountDataHari = $this->conn->query($queryGetAmountDataHari);
		$get = $runQueryGetAmountDataHari->fetch_assoc();
		$amount_data_hari = $get['amount_hari'];
		return $amount_data_hari;
	}
	public function updateSpesificDataHari($attrHari)
	{
		$id_hari = $attrHari['id_hari'];
		$id_status = $attrHari['id_status'];
		$queryUpdateSpesificDataHari = "UPDATE hari SET id_status = '$id_status' WHERE id_hari = '$id_hari'";
		$runqueryUpdateSpesificDataHari = $this->conn->query($queryUpdateSpesificDataHari);
		return $runqueryUpdateSpesificDataHari;
	}
	public function getAllDataJam()
	{
		$queryGetAllDataJam = "SELECT * FROM jam ORDER BY sks_jam DESC";
		$runqueryGetAllDataJam = $this->conn->query($queryGetAllDataJam);
		return $runqueryGetAllDataJam;
	}
	public function getSpesificDataJam($id_jam)
	{
		$queryGetSpesificDataJam = "SELECT * FROM jam WHERE id_jam = '$id_jam'";
		$runQueryGetSpesificDataJam = $this->conn->query($queryGetSpesificDataJam);
		return $runQueryGetSpesificDataJam;
	}
	public function getAmountDataJamPerSks()
	{
		$amount_data_jam = array();
		//0 -> 3 sks, 1 -> 2 sks
		$jam_sks = array(3, 2);
		for ($indeks_jam_sks = 0; $indeks_jam_sks < count($jam_sks); $indeks_jam_sks++) {
			$queryGetAmountDataJamPerKategori = "SELECT COUNT(*) AS amount_jam FROM jam WHERE sks_jam = '$jam_sks[$indeks_jam_sks]'";
			$runqueryGetAmountDataJamPerKategori = $this->conn->query($queryGetAmountDataJamPerKategori);
			$get = $runqueryGetAmountDataJamPerKategori->fetch_assoc();
			array_push($amount_data_jam, $get['amount_jam']);
		}
		return $amount_data_jam;
	}
	public function verifyBeforeUpdateSpesificDataJam($attrJam)
	{
		$id_jam = $attrJam['id_jam'];
		$kode_jam = $attrJam['kode_jam'];
		$rentang_jam = $attrJam['rentang_jam'];
		$queryVerifyBeforeUpdateSpesificDataJam = "SELECT * FROM jam WHERE id_jam <> '$id_jam' AND (rentang_jam = '$rentang_jam' OR kode_jam = '$kode_jam')";
		$runQueryVerifyBeforeUpdateSpesificDataJam = $this->conn->query($queryVerifyBeforeUpdateSpesificDataJam);
		return $runQueryVerifyBeforeUpdateSpesificDataJam;
	}
	public function updateSpesificDataJam($attrJam)
	{
		$id_jam = $attrJam['id_jam'];
		$rentang_jam = $attrJam['rentang_jam'];
		$sks_jam = $attrJam['sks_jam'];
		$queryUpdateSpesificDataJam = "UPDATE jam SET rentang_jam = '$rentang_jam',sks_jam='$sks_jam' WHERE id_jam = '$id_jam'";
		$runQueryUpdateSpesificDataJam = $this->conn->query($queryUpdateSpesificDataJam);
		return $runQueryUpdateSpesificDataJam;
	}

	public function checkIsSameJam($kode_jam, $rentang_jam)
	{
		$queryCheckIsSameJam = "SELECT * FROM jam WHERE kode_jam = '$kode_jam' OR rentang_jam = '$rentang_jam'";
		$runqueryCheckIsSameJam = $this->conn->query($queryCheckIsSameJam);
		return $runqueryCheckIsSameJam;
	}
	public function insertJam($attrJam)
	{
		$kode_jam = $attrJam['kode_jam'];
		$rentang_jam = $attrJam['rentang_jam'];
		$sks_jam = $attrJam['sks_jam'];
		$queryInsertJam = "INSERT INTO jam (kode_jam,rentang_jam,sks_jam) VALUES('$kode_jam','$rentang_jam','$sks_jam')";
		$runQueryInsertJam = $this->conn->query($queryInsertJam);
		return $runQueryInsertJam;
	}
	public function getAllDataDetailWaktu()
	{
		$queryGetAllDataDetailWaktu = "SELECT * FROM detailwaktu dw INNER JOIN hari h USING(id_hari) INNER JOIN jam j USING(id_jam) ORDER BY j.sks_jam DESC";
		$runQueryGetAllDataDetailWaktu = $this->conn->query($queryGetAllDataDetailWaktu);
		return $runQueryGetAllDataDetailWaktu;
	}

	public function insertDetailWaktu($attrWaktu)
	{
		$id_jam = $attrWaktu['id_jam'];
		$id_hari = $attrWaktu['id_hari'];
		$queryInsertDetailWaktu = "INSERT INTO detailwaktu (id_hari,id_jam) VALUES('$id_hari','$id_jam')";
		$runqueryInsertDetailWaktu = $this->conn->query($queryInsertDetailWaktu);
		return $runqueryInsertDetailWaktu;
	}
	public function deleteSpesificJam($id_jam)
	{
		$queryDeleteSpesificJam = "DELETE FROM jam WHERE id_jam = '$id_jam'";
		$runqueryDeleteSpesificJam = $this->conn->query($queryDeleteSpesificJam);
		return $runqueryDeleteSpesificJam;
	}
}
class Ruangan
{
	public $conn;
	function __construct()
	{
		global $conn;
		$this->conn = $conn;
	}
	public function getAllDataRuangan()
	{
		$queryGetAllDataRuangan = "SELECT * FROM ruangan ORDER BY kapasitas_ruangan DESC";
		$runQueryGetAllDataRuangan = $this->conn->query($queryGetAllDataRuangan);
		return $runQueryGetAllDataRuangan;
	}
	public function checkIsSameRuangan($nama_ruangan)
	{
		$queryCheckIsSameRuangan = "SELECT * FROM ruangan WHERE nama_ruangan = '$nama_ruangan'";
		$runqueryCheckIsSameRuangan = $this->conn->query($queryCheckIsSameRuangan);
		return $runqueryCheckIsSameRuangan;
	}
	public function insertRuangan($attrRuangan)
	{
		$nama_ruangan = $attrRuangan['nama_ruangan'];
		$kapasitas_ruangan = $attrRuangan['kapasitas_ruangan'];
		$lokasi_ruangan = $attrRuangan['lokasi_ruangan'];
		$queryInsertRuangan = "INSERT INTO ruangan (nama_ruangan,kapasitas_ruangan,lokasi_ruangan) VALUES('$nama_ruangan','$kapasitas_ruangan','$lokasi_ruangan')";
		$runqueryInsertRuangan = $this->conn->query($queryInsertRuangan);
		return $runqueryInsertRuangan;
	}
	public function verifyBeforeUpdateSpesificDataRuangan($attrRuangan)
	{
		$id_ruangan = $attrRuangan['id_ruangan'];
		$nama_ruangan = $attrRuangan['nama_ruangan'];
		$queryVerifyBeforeUpdateSpesificDataRuangan = "SELECT * FROM ruangan WHERE id_ruangan <> '$id_ruangan' AND nama_ruangan = '$nama_ruangan'";
		$runqueryVerifyBeforeUpdateSpesificDataRuangan = $this->conn->query($queryVerifyBeforeUpdateSpesificDataRuangan);
		return $runqueryVerifyBeforeUpdateSpesificDataRuangan;
	}
	public function updateSpesificDataRuangan($attrRuangan)
	{
		$id_ruangan = $attrRuangan['id_ruangan'];
		$nama_ruangan = $attrRuangan['nama_ruangan'];
		$kapasitas_ruangan = $attrRuangan['kapasitas_ruangan'];
		$lokasi_ruangan = $attrRuangan['lokasi_ruangan'];
		$queryUpdateSpesificDataRuangan = "UPDATE ruangan SET nama_ruangan = '$nama_ruangan',kapasitas_ruangan = '$kapasitas_ruangan',lokasi_ruangan = '$lokasi_ruangan' WHERE id_ruangan = '$id_ruangan'";
		$runQueryUpdateSpesificDataRuangan = $this->conn->query($queryUpdateSpesificDataRuangan);
		return $runQueryUpdateSpesificDataRuangan;
	}
	public function getSpesificDataRuangan($id_ruangan)
	{
		$queryGetSpesificDataRuangan = "SELECT * FROM ruangan WHERE id_ruangan = '$id_ruangan'";
		$runqueryGetSpesificDataRuangan = $this->conn->query($queryGetSpesificDataRuangan);
		return $runqueryGetSpesificDataRuangan;
	}
	public function getSpesificNamaRuangan($nama_ruangan)
	{
		$queryGetSpesificNamaRuangan = "SELECT nama_ruangan FROM ruangan WHERE nama_ruangan = '$nama_ruangan'";
		$runQueryGetSpesificNamaRuangan = $this->conn->query($queryGetSpesificNamaRuangan);
		return $runQueryGetSpesificNamaRuangan;
	}
	public function getAmountDataRuanganPerKategori()
	{
		$amount_data_ruangan = array();
		//0 -> wajib, 1 -> praktikum, 2->pilihan
		$ruangan_matkul = array();
		array_push($ruangan_matkul, array('indeks_min' => 25, 'indeks_max' => 40));
		array_push($ruangan_matkul, array('indeks_min' => 10, 'indeks_max' => 25));
		array_push($ruangan_matkul, array('indeks_min' => 0, 'indeks_max' => 10));
		foreach ($ruangan_matkul as $indeks_kategori_ruangan => $ruangan) {
			$indeks_min = $ruangan_matkul[$indeks_kategori_ruangan]['indeks_min'];
			$indeks_max = $ruangan_matkul[$indeks_kategori_ruangan]['indeks_max'];
			$queryGetAmountDataRuanganPerKategori = "SELECT COUNT(*) AS amount_ruangan FROM ruangan WHERE kapasitas_ruangan > '$indeks_min' AND kapasitas_ruangan <= '$indeks_max'";
			$runQueryGetAmountDataRuanganPerKategori = $this->conn->query($queryGetAmountDataRuanganPerKategori);
			$get = $runQueryGetAmountDataRuanganPerKategori->fetch_assoc();
			array_push($amount_data_ruangan, $get['amount_ruangan']);
		}
		return $amount_data_ruangan;
	}
	public function deleteSpesificRuangan($id_ruangan)
	{
		$queryDeleteSpesificRuangan = "DELETE FROM ruangan WHERE id_ruangan = '$id_ruangan'";
		$runqueryDeleteSpesificRuangan = $this->conn->query($queryDeleteSpesificRuangan);
		return $runqueryDeleteSpesificRuangan;
	}
}
class Status
{
	public $conn;
	function __construct()
	{
		global $conn;
		$this->conn = $conn;
	}
	public function getAllDataStatus()
	{
		$querygetAllDataStatus = "SELECT * FROM status ";
		$runQuerygetAllDataStatus = $this->conn->query($querygetAllDataStatus);
		return $runQuerygetAllDataStatus;
	}
}
class Flasher
{
	function showSimpleFlash($title, $icon, $text, $url, $confirmButtonColor = "#22bb33", $cancelButtonColor = "#d33", $confirmButtonText)
	{
		echo "<script>
		Swal.fire({
			title: '$title',
			icon:'$icon',
			text: '$text',
			showCancelButton: false,
			confirmButtonColor: '$confirmButtonColor',
			cancelButtonColor: '$cancelButtonColor',
			confirmButtonText: '$confirmButtonText'
			}).then((result) => {
				document.location.href = '$url';
			})</script>";
	}
	function showIntervalTimeFlash()
	{
		echo "<script>
			let timerInterval
			Swal.fire({
				title: 'Lihat Keranjangmu!',
				timer: 1000,
				timerProgressBar: false,
				onBeforeOpen: () => {
					timerInterval = setInterval(() => {
						const content = Swal.getContent()
						if (content) {
							const b = content.querySelector('b')
							if (b) {
								b.textContent = Swal.getTimerLeft()
							}
						}
						}, 100)
						},
						onClose: () => {
							clearInterval(timerInterval)
						}
						}).then((result) => {
							document.location.href = 'index.php?page=Keranjang';
						})</script>";
	}
}

$objDosen = new Dosen();
$objMatkul = new Matkul();
$objWaktu = new Waktu();
$objFlash = new Flasher();
$objAngkatan = new Angkatan();
$objKelas = new Kelas();
$objRuangan = new Ruangan();
$objStatus = new Status();
$objUser = new User();
