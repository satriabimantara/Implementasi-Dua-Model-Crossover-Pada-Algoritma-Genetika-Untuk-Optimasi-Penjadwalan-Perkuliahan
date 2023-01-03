<?php
include "../../config/class.php";

/* Input Data Page*/
//1. Edit Matkul
if (isset($_POST['btn_edit_matkul'])) {
	$id_matkul = $_POST['id_matkul'];
	$runQueryGetAllDataMatkul = $objMatkul->getSpesificDataMatkul($id_matkul);
	$data = array();
	while ($matkul = $runQueryGetAllDataMatkul->fetch_assoc()) {
		$data = $matkul;
	}
	echo json_encode($data);
}elseif (isset($_POST['btn_edit_hari'])) {
	$id_hari = $_POST['id_hari'];
	$runqueryGetSpesificDataHari = $objWaktu->getSpesificDataHari($id_hari);
	$data = array();
	while ($hari = $runqueryGetSpesificDataHari->fetch_assoc()) {
		$data=$hari;
	}
	echo json_encode($data);
}elseif (isset($_POST['btn_edit_dosen'])) {
	$id_dosen = $_POST['id_dosen'];
	$runQueryGetSpesificDataDosen = $objDosen->getSpesificDataDosen($id_dosen);
	$data_dosen = array();
	while ($dosen = $runQueryGetSpesificDataDosen->fetch_assoc()) {
		$data_dosen=$dosen;
	}
	echo json_encode($data_dosen);
}elseif (isset($_POST['btn_edit_ruangan'])) {
	$id_ruangan = $_POST['id_ruangan'];
	$runQueryGetSpesificDataRuangan = $objRuangan->getSpesificDataRuangan($id_ruangan);
	$data_ruangan = array();
	while ($ruangan = $runQueryGetSpesificDataRuangan->fetch_assoc()) {
		$data_ruangan=$ruangan;
	}
	echo json_encode($data_ruangan);
}elseif (isset($_POST['btn_edit_jam'])) {
	$id_jam = $_POST['id_jam'];
	$runQueryGetSpesificDataJam = $objWaktu->getSpesificDataJam($id_jam);
	$data_jam = array();
	while ($jam = $runQueryGetSpesificDataJam->fetch_assoc()) {
		$data_jam=$jam;
	}
	echo json_encode($data_jam);
}elseif (isset($_POST['btn_edit_angkatan'])) {
	$id_angkatan = $_POST['id_angkatan'];
	$runQueryGetSpesificDataAngkatan = $objAngkatan->getSpesificDataAngkatan($id_angkatan);
	$data_angkatan = array();
	while ($angkatan = $runQueryGetSpesificDataAngkatan->fetch_assoc()) {
		$data_angkatan=$angkatan;
	}
	echo json_encode($data_angkatan);
}elseif (isset($_POST['btn_edit_detailmatkul'])) {
	$id_detailmatkul = $_POST['id_detailmatkul'];
	$runQueryGetSpesificDataDetailMatkul = $objMatkul->getSpesificDataDetailMatkul($id_detailmatkul);
	$data_matkul = array();
	while ($matkul = $runQueryGetSpesificDataDetailMatkul->fetch_assoc()) {
		$data_matkul = $matkul;
	}
	echo json_encode($data_matkul);
}elseif (isset($_POST['btn_search_matkul'])) {
	$search_matkul = $_POST['search_matkul'];
	$runQueryGetSpesificMatkulByName = $objMatkul->getSpesificMatkulByName($search_matkul);
	$data_matkul = array();
	while ($matkul = $runQueryGetSpesificMatkulByName->fetch_assoc()) {
		array_push($data_matkul, $matkul);
	}
	echo json_encode($data_matkul);
}elseif (isset($_POST['btn_search_dosen'])) {
	$search_dosen = $_POST['search_dosen'];
	$runQueryGetSpesificDosenByName = $objDosen->getSpesificDosenByName($search_dosen);
	$data_dosen = array();
	while ($dosen = $runQueryGetSpesificDosenByName->fetch_assoc()) {
		$data_dosen = $dosen;
	}
	echo json_encode($data_dosen);
}elseif (isset($_POST['btn_hapus_kelas'])) {
	$id_kelas = $_POST['id_kelas'];
	$runQueryGetSpesificDataKelas = $objKelas->getSpesificDataKelas($id_kelas);
	$data_kelas = array();
	while ($kelas = $runQueryGetSpesificDataKelas->fetch_assoc()) {
		$data_kelas=$kelas;
	}
	echo json_encode($data_kelas);
}elseif (isset($_POST['btn_hapus_detailangkatan']) || isset($_POST['btn_edit_detailangkatan'])) {
	$id_detailangkatan = $_POST['id_detailangkatan'];
	$runQueryGetSpesificDataDetailAngkatan = $objAngkatan->getSpesificDataDetailAngkatan($id_detailangkatan);
	$data_angkatan = array();
	while ($angkatan = $runQueryGetSpesificDataDetailAngkatan->fetch_assoc()) {
		$data_angkatan=$angkatan;
	}
	echo json_encode($data_angkatan);
}elseif (isset($_POST['btn_edit_user'])) {
	$id_user = $_POST['id_user'];
	$runQueryGetSpesificDataUser = $objUser->getSpesificDataUser($id_user);
	$data_user = array();
	while ($user = $runQueryGetSpesificDataUser->fetch_assoc()) {
		$data_user = $user;
	}
	echo json_encode($data_user);
}

?>