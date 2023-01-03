$(document).ready(function(){
	/*Declare global variabel*/
	var btn_footer_remove_class = ["btn-primary","btn-warning","btn-danger"];
	/*All Usage*/
	function callAjaxErrorMessage(){
		console.log('Error Retrieve Data From Ajax');
	}
	function showModalBody(modal_body_id){
		$(modal_body_id).show();
	}
	function changeModalBtnFooterType(btn_footer_id,type_to_change){
		var btn_footer_id = "#"+btn_footer_id;
		$(btn_footer_id).attr('type',type_to_change);
	}
	function setBtnDeleteModalInputData(to_show,btnObject){
		if (to_show=="show") {
			$(btnObject.btn_footer_id).show();
			$(btnObject.btn_footer_id).html(btnObject.btn_footer_text);
			$(btnObject.btn_footer_id).val(btnObject.btn_footer_value);
		}else if (to_show=="hide") {
			$(btnObject.btn_footer_id).hide();
		}
		
	}
	function setModalProperties(modal_title_id,modal_title_text,btn_footer_id,btn_footer_text,btn_footer_value,btn_footer_new_class,btn_footer_remove_class){
		//Ganti Properti Modal
		$(modal_title_id).html(modal_title_text);
		$(btn_footer_id).html(btn_footer_text);
		$(btn_footer_id).val(btn_footer_value);
		btn_footer_remove_class.forEach(function(class_remove){
			$(btn_footer_id).removeClass(class_remove);
		});
		$(btn_footer_id).addClass(btn_footer_new_class);
	}
	/*HOME PAGE*/
	function hideModalBodyExceptProfile(){
		$('#modal-body-logout').hide();
	}
	$('#btn-editProfile').click(function(){
		var id_user = $("#id_user").val();
		var btn_edit_user = true;
		showModalBody("#modal-body-profile");
		hideModalBodyExceptProfile();
		setModalProperties("#modal_title_navbar_home","Edit Profile User","#btn-submit-modal-navbar-home","Edit","edit_profile","btn-warning",btn_footer_remove_class);
		//panggil ajax untuk meload matkul yang diklik isi semua field dengan matkul yang dklik
		$.ajax({
			url: 'http://localhost/penjadwalan/app/content/data.php',
			data: {btn_edit_user:btn_edit_user,id_user : id_user},
			method: 'post',
			datatype : 'json',
			success: function(data){
				var user = jQuery.parseJSON(data);
				$("#id_user_modal").val(id_user);
				$("#username_user_lama").val(user['username_user']);
				$("#password_user_lama").val(user['password_user']);
				$("#hp_user_lama").val(user['hp_user']);
				$("#email_user_lama").val(user['email_user']);
				$("#status_user").val(user['status_user']);
				$("#nama_user_baru").val(user['nama_user']);
				$("#email_user_baru").val(user['email_user']);
				$("#hp_user_baru").val(user['hp_user']);
			},
			error: function(data){
				callAjaxErrorMessage();
			}
		});
		$("#btn-submit-modal-navbar-home").click(function(){
			var username_user_baru = $('#username_user_baru').val();
			var password_user_baru = $('#password_user_baru').val();
			var repeat_password_user_baru = $('#repeat_password_user_baru').val();
			if (username_user_baru=="" && password_user_baru=="" && repeat_password_user_baru == "") {
				$('#username_user_baru').removeAttr("required");
				$('#password_user_baru').removeAttr("required");
				$('#repeat_password_user_baru').removeAttr("required");
			}
			changeModalBtnFooterType("btn-submit-modal-navbar-home","submit");
		});
	});
	function hideModalBodyExceptLogout(){
		$('#modal-body-profile').hide();
	}
	function removeRequiredInputExceptLogout(){
		$('#nama_user_baru').removeAttr('required');
		$('#email_user_baru').removeAttr('required');
		$('#hp_user_baru').removeAttr('required');
		$('#username_user_baru').removeAttr('required');
		$('#password_user_baru').removeAttr('required');
		$('#repeat_password_user_baru').removeAttr('required');
	}
	$("#btn-logout").click(function(){
		showModalBody("#modal-body-logout");
		hideModalBodyExceptLogout();
		setModalProperties("#modal_title_navbar_home","Logout SISTEM","#btn-submit-modal-navbar-home","Logout","logout","btn-danger",btn_footer_remove_class);
		removeRequiredInputExceptLogout();
		changeModalBtnFooterType("btn-submit-modal-navbar-home","submit");
	});
	
	/*INPUT DATA PAGE*/
	/*Declare global variabel*/
	var btn_footer_remove_class = ["btn-primary","btn-warning","btn-danger"];
	function resetAllInputValueWithNull(){
		//set value input dengan null setelah user misalnya mengklik tombol edit matkul
		//matkul
		$('#tambah_id_matkul').val('');
		$('#tambah_nama_matkul').val('');
		$('#tambah_kode_matkul').val('');
		$('#tambah_sks_matkul').val('');
		$('#tambah_semester_matkul').val('');
		$('#tambah_id_kategorimatkul').val('');
		//informasi matkul
		$('#tambah_id_detailmatkul').val('');
		$('#tambah_detail_id_matkul').val('');
		$('#tambah_detail_id_dosen').val('');
		$('#tambah_detail_id_detailangkatan').val('');
		//dosen
		$('#tambah_id_dosen').val('');
		$('#tambah_nip_dosen').val('');
		$('#tambah_nama_dosen').val('');
		//ruangan
		$('#tambah_id_ruangan').val('');
		$('#tambah_nama_ruangan').val('');
		$('#tambah_kapasitas_ruangan').val('');
		$('#tambah_lokasi_ruangan').val('');
		//jam
		$('#tambah_kode_jam').val('');
		$('#tambah_jam_mulai').val('');
		$('#tambah_jam_selesai').val('');
		$('#tambah_sks_jam').val('');
		//angkatan
		$('#tambah_id_angkatan').val('');
		$('#tambah_tahun_angkatan').val('');
		$('#tambah_id_statusangkatan').val('');
		$('#tambah_tahun_angkatan').removeAttr('readonly');
		//kelas
		$('#tambah_id_kelas').val('');
		$('#tambah_nama_kelas').val('');
		$('#tambah_nama_kelas').removeAttr('disabled');
		//hari
		$('#tambah_id_hari').val('');
		$('#tambah_id_hari').removeAttr('disabled');
		$('#tambah_id_status').val('');
		//detailangkatan
		$('#tambah_detail_id_kelas').val('');
		$('#tambah_detail_id_kelas').removeAttr('disabled');
		$('#tambah_detail_id_angkatan').val('');
		$('#tambah_detail_id_angkatan').removeAttr('disabled');
		$('#tambah_peserta_kelas').val('');
		$('#tambah_id_statuskelas').val('');
		$('#tambah_id_statuskelas').removeAttr('disabled');
		//detailmatkul
		$('#tambah_detail_id_matkul').val('');
		$('#tambah_detail_id_matkul').removeAttr('disabled');
		$('#tambah_detail_id_dosen').val('');
		$('#tambah_detail_id_dosen').removeAttr('disabled');
		$('#tambah_detail_id_kelas').val('');
		$('#tambah_detail_id_kelas').removeAttr('disabled');
	}
	
	
	/*1. Tambah Matkul dan Edit Matkul*/
	function hideModalBodyExceptMatkul(){
		// hide semua modal body yang ada
		$('#modal-body-informasiMatkul').hide();
		$('#modal-body-tambahDosen').hide();
		$('#modal-body-tambahHari').hide();
		$('#modal-body-tambahRuangan').hide();
		$('#modal-body-tambahJam').hide();
		$('#modal-body-tambahAngkatan').hide();
		$('#modal-body-informasiAngkatan').hide();
		$('#modal-body-tambahKelas').hide();
		$('#modal-body-informasiKelas').hide();
		$('#modal-body-alertHapus').hide();
	}
	function removeRequiredInputExceptMatkul(){
		//Hilangkan semua required field kecuali required matkul
		$('#tambah_nip_dosen').removeAttr('required');
		$('#tambah_nama_dosen').removeAttr('required');
		$('#tambah_id_hari').removeAttr('required');
		$('#tambah_id_status').removeAttr('required');
		$('#tambah_nama_ruangan').removeAttr('required');
		$('#tambah_kapasitas_ruangan').removeAttr('required');
		$('#tambah_lokasi_ruangan').removeAttr('required');
		$('#tambah_kode_jam').removeAttr('required');
		$('#tambah_jam_mulai').removeAttr('required');
		$('#tambah_jam_selesai').removeAttr('required');
		$('#tambah_sks_jam').removeAttr('required');
		$('#tambah_id_angkatan').removeAttr('required');
		$('#tambah_tahun_angkatan').removeAttr('required');
		$('#tambah_id_statusangkatan').removeAttr('required');
		$('#tambah_id_kelas').removeAttr('required');
		$('#tambah_nama_kelas').removeAttr('required');
		$('#tambah_detail_id_angkatan').removeAttr('required');
		$('#tambah_detail_id_kelas').removeAttr('required');
		$('#tambah_peserta_kelas').removeAttr('required');
		$('#tambah_id_statuskelas').removeAttr('required');
		$('#tambah_id_detailmatkul').removeAttr('required');
		$('#tambah_detail_id_matkul').removeAttr('required');
		$('#tambah_detail_id_dosen').removeAttr('required');
		$('#tambah_detail_id_detailangkatan').removeAttr('required');
	}

	$('#btn-tambahMatkul').click(function(){
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer"
		}
		setBtnDeleteModalInputData("hide",btnDeleteObject);
		showModalBody("#modal-body-tambahMatkul");
		hideModalBodyExceptMatkul();
		resetAllInputValueWithNull();
		removeRequiredInputExceptMatkul();
		setModalProperties("#modal_title_input_data","Tambah Mata Kuliah","#btn-submit-modal-input-data","Tambah","tambah_matkul","btn-primary",btn_footer_remove_class);
		//ganti type button menjadi submit
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
	});

	$('.btn-editMatkul').click(function(){
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer",
			btn_footer_text : "Hapus",
			btn_footer_value : "hapus_matkul"
		}
		setBtnDeleteModalInputData("show",btnDeleteObject);
		//tangkap id_matkul yang diklik
		var id_matkul = $(this).data('id_matkul');
		var btn_edit_matkul = true;
		showModalBody("#modal-body-tambahMatkul");
		hideModalBodyExceptMatkul();
		$("#modal-body-alertHapus").fadeIn(3000);
		removeRequiredInputExceptMatkul();
		setModalProperties("#modal_title_input_data","Edit Mata Kuliah","#btn-submit-modal-input-data","Edit","edit_matkul","btn-warning",btn_footer_remove_class);
		//panggil ajax untuk meload matkul yang diklik isi semua field dengan matkul yang dklik
		$.ajax({
			url: 'http://localhost/penjadwalan/app/content/data.php',
			data: {btn_edit_matkul:btn_edit_matkul,id_matkul : id_matkul},
			method: 'post',
			datatype : 'json',
			success: function(data){
				//mengembalikan dalam bentuk objek
				var matkul = jQuery.parseJSON(data);
				$('#tambah_id_matkul').val(matkul['id_matkul']);
				$('#tambah_kode_matkul').val(matkul['kode_matkul']);
				$('#tambah_nama_matkul').val(matkul['nama_matkul']);
				$('#tambah_sks_matkul').val(matkul['sks_matkul']);
				$('#tambah_semester_matkul').val(matkul['semester_matkul']);
				$('#tambah_id_kategorimatkul').val(matkul['id_kategorimatkul']);
			},
			error: function(data){
				callAjaxErrorMessage();
			}
		});
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
		changeModalBtnFooterType("alert-hapus-btn-footer","submit");
	});
	/*Informasi Mata Kuliah*/
	function hideModalBodyExceptInformasiMatkul(){
		// hide semua modal body yang ada
		$('#modal-body-tambahMatkul').hide();
		$('#modal-body-tambahDosen').hide();
		$('#modal-body-tambahHari').hide();
		$('#modal-body-tambahRuangan').hide();
		$('#modal-body-tambahJam').hide();
		$('#modal-body-tambahAngkatan').hide();
		$('#modal-body-informasiAngkatan').hide();
		$('#modal-body-tambahKelas').hide();
		$('#modal-body-informasiKelas').hide();
		$('#modal-body-alertHapus').hide();
	}
	function removeRequiredInputExceptInformasiMatkul(){
		//Hilangkan semua required field kecuali required matkul
		$('#tambah_kode_matkul').removeAttr('required');
		$('#tambah_nama_matkul').removeAttr('required');
		$('#tambah_sks_matkul').removeAttr('required');
		$('#tambah_semester_matkul').removeAttr('required');
		$('#tambah_id_kategorimatkul').removeAttr('required');
		$('#tambah_id_hari').removeAttr('required');
		$('#tambah_id_status').removeAttr('required');
		$('#tambah_nip_dosen').removeAttr('required');
		$('#tambah_nama_dosen').removeAttr('required');
		$('#tambah_nama_ruangan').removeAttr('required');
		$('#tambah_kapasitas_ruangan').removeAttr('required');
		$('#tambah_lokasi_ruangan').removeAttr('required');
		$('#tambah_kode_jam').removeAttr('required');
		$('#tambah_jam_mulai').removeAttr('required');
		$('#tambah_jam_selesai').removeAttr('required');
		$('#tambah_sks_jam').removeAttr('required');
		$('#tambah_id_angkatan').removeAttr('required');
		$('#tambah_tahun_angkatan').removeAttr('required');
		$('#tambah_id_statusangkatan').removeAttr('required');
		$('#tambah_id_kelas').removeAttr('required');
		$('#tambah_nama_kelas').removeAttr('required');
		$('#tambah_detail_id_angkatan').removeAttr('required');
		$('#tambah_detail_id_kelas').removeAttr('required');
		$('#tambah_peserta_kelas').removeAttr('required');
		$('#tambah_id_statuskelas').removeAttr('required');
	}

	$('#btn-informasiMatkul').click(function(){
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer"
		}
		setBtnDeleteModalInputData("hide",btnDeleteObject);
		showModalBody("#modal-body-informasiMatkul");
		hideModalBodyExceptInformasiMatkul();
		resetAllInputValueWithNull();
		removeRequiredInputExceptInformasiMatkul();
		setModalProperties("#modal_title_input_data","Lengkapi Informasi Mata Kuliah","#btn-submit-modal-input-data","Lengkapi","tambah_informasi_matkul","btn-primary",btn_footer_remove_class);
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
	});

	$('#search_matkul').keyup(function(){
		//call ajax to retrieve data and set the select form
		var search_matkul = $(this).val();
		if (search_matkul===''){
			$("#tambah_detail_id_matkul").val('');
		}else{
			var btn_search_matkul = true;
			$.ajax({
				url: 'http://localhost/penjadwalan/app/content/data.php',
				data: {
					btn_search_matkul:btn_search_matkul,
					search_matkul : search_matkul
				},
				method: 'post',
				datatype : 'json',
				success : function(data){
					var matkul = jQuery.parseJSON(data);
					if (matkul[0]!=null) {
						$("#tambah_detail_id_matkul").val(matkul[0].id_matkul);
					}else{
						$("#tambah_detail_id_matkul").val('');
					}
				},
				error : function (data){
					callAjaxErrorMessage();
				}
			});
		}
	});

	$('.btn-editInformasiMatkul').click(function(){
		//ambil data id_detailmatkul yang diklik
		var id_detailmatkul = $(this).data('id_detailmatkul');
		$('#tambah_id_detailmatkul').val(id_detailmatkul);
		var btn_edit_detailmatkul = true;
		showModalBody("#modal-body-informasiMatkul");
		hideModalBodyExceptInformasiMatkul();
		resetAllInputValueWithNull();
		removeRequiredInputExceptInformasiMatkul();
		setModalProperties("#modal_title_input_data","Edit Informasi Mata Kuliah","#btn-submit-modal-input-data","Edit","edit_informasimatkul","btn-warning",btn_footer_remove_class);
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer",
			btn_footer_text : "Hapus",
			btn_footer_value : "hapus_informasimatkul"
		}
		setBtnDeleteModalInputData("show",btnDeleteObject);
		$('#modal-body-alertHapus').fadeIn(3000);
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
		changeModalBtnFooterType("alert-hapus-btn-footer","submit");
		$.ajax({
			url: 'http://localhost/penjadwalan/app/content/data.php',
			data: {btn_edit_detailmatkul:btn_edit_detailmatkul,id_detailmatkul : id_detailmatkul},
			method: 'post',
			datatype : 'json',
			success: function(data){
				//mengembalikan dalam bentuk objek
				var matkul = jQuery.parseJSON(data);
				$('#tambah_id_detailmatkul').val(matkul['id_detailmatkul']);
				$('#tambah_detail_id_matkul').val(matkul['id_matkul']);
				$('#tambah_detail_id_detailangkatan').val(matkul['id_detailangkatan']);
				$('#tambah_detail_id_dosen').val(matkul['id_dosen']);
			},
			error: function(data){
				callAjaxErrorMessage();
			}
		});
		
	});


	/*2. Dosen*/
	function hideModalBodyExceptDosen(){
		// hide semua modal body yang ada
		$('#modal-body-tambahMatkul').hide();
		$('#modal-body-informasiMatkul').hide();
		$('#modal-body-tambahHari').hide();
		$('#modal-body-tambahRuangan').hide();
		$('#modal-body-tambahJam').hide();
		$('#modal-body-tambahAngkatan').hide();
		$('#modal-body-informasiAngkatan').hide();
		$('#modal-body-tambahKelas').hide();
		$('#modal-body-informasiKelas').hide();
		$('#modal-body-alertHapus').hide();
	}
	function removeRequiredInputExceptDosen(){
		//Hilangkan semua required field 
		$('#tambah_kode_matkul').removeAttr('required');
		$('#tambah_nama_matkul').removeAttr('required');
		$('#tambah_sks_matkul').removeAttr('required');
		$('#tambah_semester_matkul').removeAttr('required');
		$('#tambah_id_kategorimatkul').removeAttr('required');
		$('#tambah_id_hari').removeAttr('required');
		$('#tambah_id_status').removeAttr('required');
		$('#tambah_nama_ruangan').removeAttr('required');
		$('#tambah_kapasitas_ruangan').removeAttr('required');
		$('#tambah_lokasi_ruangan').removeAttr('required');
		$('#tambah_kode_jam').removeAttr('required');
		$('#tambah_jam_mulai').removeAttr('required');
		$('#tambah_jam_selesai').removeAttr('required');
		$('#tambah_sks_jam').removeAttr('required');
		$('#tambah_id_angkatan').removeAttr('required');
		$('#tambah_tahun_angkatan').removeAttr('required');
		$('#tambah_id_statusangkatan').removeAttr('required');
		$('#tambah_id_kelas').removeAttr('required');
		$('#tambah_nama_kelas').removeAttr('required');
		$('#tambah_detail_id_angkatan').removeAttr('required');
		$('#tambah_detail_id_kelas').removeAttr('required');
		$('#tambah_peserta_kelas').removeAttr('required');
		$('#tambah_id_statuskelas').removeAttr('required');
		$('#tambah_id_detailmatkul').removeAttr('required');
		$('#tambah_detail_id_matkul').removeAttr('required');
		$('#tambah_detail_id_dosen').removeAttr('required');
		$('#tambah_detail_id_detailangkatan').removeAttr('required');
	}

	$('#btn-tambahDosen').click(function(){
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer"
		}
		setBtnDeleteModalInputData("hide",btnDeleteObject);
		showModalBody("#modal-body-tambahDosen");
		hideModalBodyExceptDosen();
		resetAllInputValueWithNull();
		removeRequiredInputExceptDosen();
		setModalProperties("#modal_title_input_data","Tambah Dosen","#btn-submit-modal-input-data","Tambah","tambah_dosen","btn-primary",btn_footer_remove_class);
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
	});

	$('.btn-editDosen').click(function(){
		//tangkap id dosen yang diklik
		var id_dosen = $(this).data('id_dosen');
		var btn_edit_dosen = true;

		showModalBody("#modal-body-tambahDosen");
		hideModalBodyExceptDosen();
		removeRequiredInputExceptDosen();
		setModalProperties("#modal_title_input_data","Edit Dosen","#btn-submit-modal-input-data","Edit","edit_dosen","btn-warning",btn_footer_remove_class);
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer",
			btn_footer_text : "Hapus",
			btn_footer_value : "hapus_dosen"
		}
		setBtnDeleteModalInputData("show",btnDeleteObject);
		$('#modal-body-alertHapus').fadeIn(3000);
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
		changeModalBtnFooterType("alert-hapus-btn-footer","submit");
		$.ajax({
			url: 'http://localhost/penjadwalan/app/content/data.php',
			data: {btn_edit_dosen:btn_edit_dosen,id_dosen : id_dosen},
			method: 'post',
			datatype : 'json',
			success: function(data){
				//mengembalikan dalam bentuk objek
				var dosen = jQuery.parseJSON(data);
				$('#tambah_id_dosen').val(dosen['id_dosen']);
				$('#tambah_nip_dosen').val(dosen['nip_dosen']);
				$('#tambah_nama_dosen').val(dosen['nama_dosen']);
			},
			error: function(data){
				callAjaxErrorMessage();
			}
		});
	});
	$('#search_dosen').keyup(function(){
		//call ajax to retrieve data and set the select form
		var search_dosen = $(this).val();
		if (search_dosen==='') {
			$("#tambah_detail_id_dosen").val('');
		}else{
			var btn_search_dosen = true;
			$.ajax({
				url: 'http://localhost/penjadwalan/app/content/data.php',
				data: {
					btn_search_dosen:btn_search_dosen,
					search_dosen : search_dosen
				},
				method: 'post',
				datatype : 'json',
				success : function(data){
					var dosen = jQuery.parseJSON(data);
					$("#tambah_detail_id_dosen").val(dosen.id_dosen);
				},
				error : function (data){
					callAjaxErrorMessage();
				}
			});
		}
	});
	/*3. Hari*/
	function hideModalBodyExceptHari(){
		// hide semua modal body yang ada
		$('#modal-body-tambahDosen').hide();
		$('#modal-body-informasiMatkul').hide();
		$('#modal-body-tambahMatkul').hide();
		$('#modal-body-tambahRuangan').hide();
		$('#modal-body-tambahJam').hide();
		$('#modal-body-tambahAngkatan').hide();
		$('#modal-body-informasiAngkatan').hide();
		$('#modal-body-tambahKelas').hide();
		$('#modal-body-informasiKelas').hide();
		$('#modal-body-alertHapus').hide();
	}
	function removeRequiredInputExceptHari(){
		//Hilangkan semua required field 
		$('#tambah_kode_matkul').removeAttr('required');
		$('#tambah_nama_matkul').removeAttr('required');
		$('#tambah_sks_matkul').removeAttr('required');
		$('#tambah_semester_matkul').removeAttr('required');
		$('#tambah_id_kategorimatkul').removeAttr('required');
		$('#tambah_nip_dosen').removeAttr('required');
		$('#tambah_nama_dosen').removeAttr('required');
		$('#tambah_nama_ruangan').removeAttr('required');
		$('#tambah_kapasitas_ruangan').removeAttr('required');
		$('#tambah_lokasi_ruangan').removeAttr('required');
		$('#tambah_kode_jam').removeAttr('required');
		$('#tambah_jam_mulai').removeAttr('required');
		$('#tambah_jam_selesai').removeAttr('required');
		$('#tambah_sks_jam').removeAttr('required');
		$('#tambah_id_angkatan').removeAttr('required');
		$('#tambah_tahun_angkatan').removeAttr('required');
		$('#tambah_id_statusangkatan').removeAttr('required');
		$('#tambah_id_kelas').removeAttr('required');
		$('#tambah_nama_kelas').removeAttr('required');
		$('#tambah_detail_id_angkatan').removeAttr('required');
		$('#tambah_detail_id_kelas').removeAttr('required');
		$('#tambah_peserta_kelas').removeAttr('required');
		$('#tambah_id_statuskelas').removeAttr('required');
		$('#tambah_id_detailmatkul').removeAttr('required');
		$('#tambah_detail_id_matkul').removeAttr('required');
		$('#tambah_detail_id_dosen').removeAttr('required');
		$('#tambah_detail_id_detailangkatan').removeAttr('required');
	}

	$('.btn-editHari').click(function(){
		//tangkap id_matkul yang diklik
		var id_hari = $(this).data('id_hari');
		var btn_edit_hari = true;
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer"
		}
		setBtnDeleteModalInputData("hide",btnDeleteObject);
		showModalBody("#modal-body-tambahHari");
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
		hideModalBodyExceptHari();
		removeRequiredInputExceptHari();
		$("#tambah_id_hari").attr("disabled","false");
		$("#enabled_id_hari").val(id_hari);
		setModalProperties("#modal_title_input_data","Edit Hari","#btn-submit-modal-input-data","Edit","edit_hari","btn-warning",btn_footer_remove_class);
		$.ajax({
			url: 'http://localhost/penjadwalan/app/content/data.php',
			data: {btn_edit_hari:btn_edit_hari,id_hari : id_hari},
			method: 'post',
			datatype : 'json',
			success: function(data){
				//mengembalikan dalam bentuk objek
				var hari = jQuery.parseJSON(data);
				$('#tambah_id_hari').val(hari['id_hari']);
				$('#tambah_id_status').val(hari['id_status']);
			},
			error: function(data){
				callAjaxErrorMessage();
			}
		});
	});

	/*4. Ruangan*/
	function hideModalBodyExceptRuangan(){
		// hide semua modal body yang ada
		$('#modal-body-tambahMatkul').hide();
		$('#modal-body-informasiMatkul').hide();
		$('#modal-body-tambahDosen').hide();
		$('#modal-body-tambahHari').hide();
		$('#modal-body-tambahJam').hide();
		$('#modal-body-tambahAngkatan').hide();
		$('#modal-body-informasiAngkatan').hide();
		$('#modal-body-tambahKelas').hide();
		$('#modal-body-informasiKelas').hide();
		$('#modal-body-alertHapus').hide();
	}
	function removeRequiredInputExceptRuangan(){
		//Hilangkan semua required field 
		$('#tambah_kode_matkul').removeAttr('required');
		$('#tambah_nama_matkul').removeAttr('required');
		$('#tambah_sks_matkul').removeAttr('required');
		$('#tambah_semester_matkul').removeAttr('required');
		$('#tambah_id_kategorimatkul').removeAttr('required');
		$('#tambah_nip_dosen').removeAttr('required');
		$('#tambah_nama_dosen').removeAttr('required');
		$('#tambah_id_hari').removeAttr('required');
		$('#tambah_id_status').removeAttr('required');
		$('#tambah_kode_jam').removeAttr('required');
		$('#tambah_jam_mulai').removeAttr('required');
		$('#tambah_jam_selesai').removeAttr('required');
		$('#tambah_sks_jam').removeAttr('required');
		$('#tambah_id_angkatan').removeAttr('required');
		$('#tambah_tahun_angkatan').removeAttr('required');
		$('#tambah_id_statusangkatan').removeAttr('required');
		$('#tambah_id_kelas').removeAttr('required');
		$('#tambah_nama_kelas').removeAttr('required');
		$('#tambah_detail_id_angkatan').removeAttr('required');
		$('#tambah_detail_id_kelas').removeAttr('required');
		$('#tambah_peserta_kelas').removeAttr('required');
		$('#tambah_id_statuskelas').removeAttr('required');
		$('#tambah_id_detailmatkul').removeAttr('required');
		$('#tambah_detail_id_matkul').removeAttr('required');
		$('#tambah_detail_id_dosen').removeAttr('required');
		$('#tambah_detail_id_detailangkatan').removeAttr('required');
	}

	$('#btn-tambahRuangan').click(function(){
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer"
		}
		setBtnDeleteModalInputData("hide",btnDeleteObject);
		showModalBody("#modal-body-tambahRuangan");
		hideModalBodyExceptRuangan();
		resetAllInputValueWithNull();
		removeRequiredInputExceptRuangan();
		setModalProperties("#modal_title_input_data","Tambah Ruangan","#btn-submit-modal-input-data","Tambah","tambah_ruangan","btn-primary",btn_footer_remove_class);
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
	});

	$('.btn-editRuangan').click(function(){
		//tangkap id_ruangan yang diklik
		var id_ruangan = $(this).data('id_ruangan');
		var btn_edit_ruangan = true;

		showModalBody("#modal-body-tambahRuangan");
		hideModalBodyExceptRuangan();
		removeRequiredInputExceptRuangan();
		setModalProperties("#modal_title_input_data","Edit Ruangan","#btn-submit-modal-input-data","Edit","edit_ruangan","btn-warning",btn_footer_remove_class);
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer",
			btn_footer_text : "Hapus",
			btn_footer_value : "hapus_ruangan"
		}
		setBtnDeleteModalInputData("show",btnDeleteObject);
		$('#modal-body-alertHapus').fadeIn(3000);
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
		changeModalBtnFooterType("alert-hapus-btn-footer","submit");

		$.ajax({
			url: 'http://localhost/penjadwalan/app/content/data.php',
			data: {btn_edit_ruangan:btn_edit_ruangan,id_ruangan : id_ruangan},
			method: 'post',
			datatype : 'json',
			success: function(data){
				//mengembalikan dalam bentuk objek
				var ruangan = jQuery.parseJSON(data);
				$('#tambah_id_ruangan').val(ruangan['id_ruangan']);
				$('#tambah_nama_ruangan').val(ruangan['nama_ruangan']);
				$('#tambah_kapasitas_ruangan').val(ruangan['kapasitas_ruangan']);
				$('#tambah_lokasi_ruangan').val(ruangan['lokasi_ruangan']);
			},
			error: function(data){
				callAjaxErrorMessage();
			}
		});
	});
	/*5. Jam*/
	function hideModalBodyExceptJam(){
		// hide semua modal body yang ada
		$('#modal-body-tambahMatkul').hide();
		$('#modal-body-informasiMatkul').hide();
		$('#modal-body-tambahDosen').hide();
		$('#modal-body-tambahHari').hide();
		$('#modal-body-tambahRuangan').hide();
		$('#modal-body-tambahAngkatan').hide();
		$('#modal-body-informasiAngkatan').hide();
		$('#modal-body-tambahKelas').hide();
		$('#modal-body-informasiKelas').hide();
		$('#modal-body-alertHapus').hide();
	}
	function removeRequiredInputExceptJam(){
		//Hilangkan semua required field 
		$('#tambah_kode_matkul').removeAttr('required');
		$('#tambah_nama_matkul').removeAttr('required');
		$('#tambah_sks_matkul').removeAttr('required');
		$('#tambah_semester_matkul').removeAttr('required');
		$('#tambah_id_kategorimatkul').removeAttr('required');
		$('#tambah_nip_dosen').removeAttr('required');
		$('#tambah_nama_dosen').removeAttr('required');
		$('#tambah_nama_ruangan').removeAttr('required');
		$('#tambah_kapasitas_ruangan').removeAttr('required');
		$('#tambah_lokasi_ruangan').removeAttr('required');
		$('#tambah_id_hari').removeAttr('required');
		$('#tambah_id_status').removeAttr('required');
		$('#tambah_id_angkatan').removeAttr('required');
		$('#tambah_tahun_angkatan').removeAttr('required');
		$('#tambah_id_statusangkatan').removeAttr('required');
		$('#tambah_id_kelas').removeAttr('required');
		$('#tambah_nama_kelas').removeAttr('required');
		$('#tambah_detail_id_angkatan').removeAttr('required');
		$('#tambah_detail_id_kelas').removeAttr('required');
		$('#tambah_peserta_kelas').removeAttr('required');
		$('#tambah_id_statuskelas').removeAttr('required');
		$('#tambah_id_detailmatkul').removeAttr('required');
		$('#tambah_detail_id_matkul').removeAttr('required');
		$('#tambah_detail_id_dosen').removeAttr('required');
		$('#tambah_detail_id_detailangkatan').removeAttr('required');
	}
	function validasiJamPerkuliahan(jam_mulai,jam_selesai){
		var isValidJamMulai = false;
		var isValidJamSelesai = false;
		//str valid 08.30, panjangya pasti 5 dan dicari index tengahnya
		var index_tengah_str = Math.floor(jam_mulai.length/2);
		var ascii_index_tengah_str = 46; //ascii untuk '. (titik)'
		if (jam_mulai.length  == 5) {
			for(var i = 0 ; i < jam_mulai.length ; i++ ){
				if (i == index_tengah_str) {
					if (jam_mulai.charCodeAt(i)==ascii_index_tengah_str) {
						isValidJamMulai=true;
					}else{
						isValidJamMulai=false;
						break;
					}
				}else{
					if (jam_mulai.charCodeAt(i)>=48 && jam_mulai.charCodeAt(i)<=57) {
						isValidJamMulai=true;
					}else{
						isValidJamMulai=false;
						break;
					}
				}
			}
		}
		if (jam_selesai.length==5) {
			for(var i = 0 ; i < jam_selesai.length ; i++ ){
				if (i == index_tengah_str) {
					if (jam_selesai.charCodeAt(i)==ascii_index_tengah_str) {
						isValidJamSelesai=true;
					}else{
						isValidJamSelesai=false;
						break;
					}
				}else{
					if (jam_selesai.charCodeAt(i)>=48 && jam_selesai.charCodeAt(i)<=57) {
						isValidJamSelesai=true;
					}else{
						isValidJamSelesai=false;
						break;
					}
				}
			}
		}
		if (jam_mulai>jam_selesai) {
			isValidJamMulai = false;
			isValidJamSelesai = false;
		}
		if (isValidJamMulai == false || isValidJamSelesai==false) {
			$('#alert-jam-false').fadeIn("slow");
		}else if (isValidJamMulai == true && isValidJamSelesai == true) {
			$('#alert-jam-false').fadeOut("slow");
			changeModalBtnFooterType("btn-submit-modal-input-data","submit");
		}
	}

	$('#btn-tambahJam').click(function(){
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer"
		}
		setBtnDeleteModalInputData("hide",btnDeleteObject);
		$('#alert-jam-false').hide();
		$('#tambah_kode_jam').removeAttr("readonly");
		showModalBody("#modal-body-tambahJam");
		hideModalBodyExceptJam();
		resetAllInputValueWithNull();
		removeRequiredInputExceptJam();
		setModalProperties("#modal_title_input_data","Tambah Jam","#btn-submit-modal-input-data","Tambah","tambah_jam","btn-primary",btn_footer_remove_class);
		//ganti type submit menjadi button untuk melakukan validasi terlebih dahulu
		changeModalBtnFooterType("btn-submit-modal-input-data","button");
		//validasi inputan string jam mulai dan jam selesai dari user
		$('#btn-submit-modal-input-data').click(function(){
			var jam_mulai = $('#tambah_jam_mulai').val();
			var jam_selesai = $('#tambah_jam_selesai').val();
			validasiJamPerkuliahan(jam_mulai,jam_selesai);
		});
	});

	$('.btn-editJam').click(function(){
		//tangkap id_jam yang diklik
		var id_jam = $(this).data('id_jam');
		var btn_edit_jam = true;

		$('#alert-jam-false').hide();
		showModalBody("#modal-body-tambahJam");
		hideModalBodyExceptJam();
		resetAllInputValueWithNull();
		removeRequiredInputExceptJam();
		setModalProperties("#modal_title_input_data","Edit Jam","#btn-submit-modal-input-data","Edit","edit_jam","btn-warning",btn_footer_remove_class);
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer",
			btn_footer_text : "Hapus",
			btn_footer_value : "hapus_jam"
		}
		setBtnDeleteModalInputData("show",btnDeleteObject);
		$('#modal-body-alertHapus').fadeIn(3000);
		changeModalBtnFooterType("alert-hapus-btn-footer","submit");
		//ganti type submit menjadi button untuk melakukan validasi terlebih dahulu
		changeModalBtnFooterType("btn-submit-modal-input-data","button");
		//panggil ajax untuk memasukkan data jam ke field-field bersesuaian
		$.ajax({
			url: 'http://localhost/penjadwalan/app/content/data.php',
			data: {btn_edit_jam:btn_edit_jam,id_jam : id_jam},
			method: 'post',
			datatype : 'json',
			success: function(data){
				//mengembalikan dalam bentuk objek
				var jam = jQuery.parseJSON(data);
				var rentang_jam = jam['rentang_jam'];
				var split_jam = rentang_jam.split("-");

				$('#tambah_id_jam').val(jam['id_jam']);
				$('#tambah_kode_jam').val(jam['kode_jam']);
				$('#tambah_kode_jam').attr("readonly","true");
				$('#tambah_jam_mulai').val(split_jam[0]);
				$('#tambah_jam_selesai').val(split_jam[1]);
				$('#tambah_sks_jam').val(jam['sks_jam']);
			},
			error: function(data){
				callAjaxErrorMessage();
			}
		});
		//validasi inputan string jam mulai dan jam selesai dari user
		$('#btn-submit-modal-input-data').click(function(){
			var jam_mulai = $('#tambah_jam_mulai').val();
			var jam_selesai = $('#tambah_jam_selesai').val();
			validasiJamPerkuliahan(jam_mulai,jam_selesai);
		});
	});


	/*6. Angkatan*/
	function hideModalBodyExceptAngkatan(){
		// hide semua modal body yang ada
		$('#modal-body-tambahMatkul').hide();
		$('#modal-body-informasiMatkul').hide();
		$('#modal-body-tambahDosen').hide();
		$('#modal-body-tambahHari').hide();
		$('#modal-body-tambahRuangan').hide();
		$('#modal-body-tambahJam').hide();
		$('#modal-body-informasiAngkatan').hide();
		$('#modal-body-tambahKelas').hide();
		$('#modal-body-informasiKelas').hide();
		$("#modal-body-alertHapus").hide();
	}
	function removeRequiredInputExceptAngkatan(){
		//Hilangkan semua required field 
		$('#tambah_kode_matkul').removeAttr('required');
		$('#tambah_nama_matkul').removeAttr('required');
		$('#tambah_sks_matkul').removeAttr('required');
		$('#tambah_semester_matkul').removeAttr('required');
		$('#tambah_id_kategorimatkul').removeAttr('required');
		$('#tambah_nip_dosen').removeAttr('required');
		$('#tambah_nama_dosen').removeAttr('required');
		$('#tambah_nama_ruangan').removeAttr('required');
		$('#tambah_kapasitas_ruangan').removeAttr('required');
		$('#tambah_lokasi_ruangan').removeAttr('required');
		$('#tambah_id_hari').removeAttr('required');
		$('#tambah_id_status').removeAttr('required');
		$('#tambah_kode_jam').removeAttr('required');
		$('#tambah_jam_mulai').removeAttr('required');
		$('#tambah_jam_selesai').removeAttr('required');
		$('#tambah_sks_jam').removeAttr('required');
		$('#tambah_id_kelas').removeAttr('required');
		$('#tambah_nama_kelas').removeAttr('required');
		$('#tambah_detail_id_angkatan').removeAttr('required');
		$('#tambah_detail_id_kelas').removeAttr('required');
		$('#tambah_peserta_kelas').removeAttr('required');
		$('#tambah_id_statuskelas').removeAttr('required');
		$('#tambah_id_detailmatkul').removeAttr('required');
		$('#tambah_detail_id_matkul').removeAttr('required');
		$('#tambah_detail_id_dosen').removeAttr('required');
		$('#tambah_detail_id_detailangkatan').removeAttr('required');
	}

	$('#btn-tambahAngkatan').click(function(){
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer"
		}
		setBtnDeleteModalInputData("hide",btnDeleteObject);
		showModalBody("#modal-body-tambahAngkatan");
		hideModalBodyExceptAngkatan();
		resetAllInputValueWithNull();
		removeRequiredInputExceptAngkatan();
		setModalProperties("#modal_title_input_data","Tambah Angkatan","#btn-submit-modal-input-data","Tambah","tambah_angkatan","btn-primary",btn_footer_remove_class);
		
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
	});

	$('.btn-editAngkatan').click(function(){
		//tangkap id_angkatan yang bersangkutan 
		var id_angkatan = $(this).data('id_angkatan');
		var btn_edit_angkatan = true;

		showModalBody("#modal-body-tambahAngkatan");
		hideModalBodyExceptAngkatan();
		resetAllInputValueWithNull();
		removeRequiredInputExceptAngkatan();
		setModalProperties("#modal_title_input_data","Edit Angkatan","#btn-submit-modal-input-data","Edit","edit_angkatan","btn-warning",btn_footer_remove_class);
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer",
			btn_footer_text : "Hapus",
			btn_footer_value : "hapus_angkatan"
		}
		setBtnDeleteModalInputData("show",btnDeleteObject);
		$('#modal-body-alertHapus').fadeIn(3000);
		changeModalBtnFooterType("alert-hapus-btn-footer","submit");
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
		$.ajax({
			url: 'http://localhost/penjadwalan/app/content/data.php',
			data: {btn_edit_angkatan:btn_edit_angkatan,id_angkatan : id_angkatan},
			method: 'post',
			datatype : 'json',
			success: function(data){
				//mengembalikan dalam bentuk objek
				var angkatan = jQuery.parseJSON(data);
				$('#tambah_id_angkatan').val(angkatan['id_angkatan']);
				$('#tambah_tahun_angkatan').val(angkatan['tahun_angkatan']);
				$('#tambah_tahun_angkatan').attr("readonly","true");
				$('#tambah_id_statusangkatan').val(angkatan['id_statusangkatan']);
			},
			error: function(data){
				callAjaxErrorMessage();
			}
		});
	});

	/*7. Kelas*/
	function hideModalBodyExceptKelas(){
		// hide semua modal body yang ada
		$('#modal-body-tambahMatkul').hide();
		$('#modal-body-informasiMatkul').hide();
		$('#modal-body-tambahDosen').hide();
		$('#modal-body-tambahHari').hide();
		$('#modal-body-hapusKelas').hide();
		$('#modal-body-tambahRuangan').hide();
		$('#modal-body-tambahJam').hide();
		$('#modal-body-informasiAngkatan').hide();
		$('#modal-body-tambahAngkatan').hide();
		$('#modal-body-informasiKelas').hide();
		$('#modal-body-alertHapus').hide();
	}
	function removeRequiredInputExceptKelas(){
		//Hilangkan semua required field 
		$('#tambah_kode_matkul').removeAttr('required');
		$('#tambah_nama_matkul').removeAttr('required');
		$('#tambah_sks_matkul').removeAttr('required');
		$('#tambah_semester_matkul').removeAttr('required');
		$('#tambah_id_kategorimatkul').removeAttr('required');
		$('#tambah_nip_dosen').removeAttr('required');
		$('#tambah_nama_dosen').removeAttr('required');
		$('#tambah_nama_ruangan').removeAttr('required');
		$('#tambah_kapasitas_ruangan').removeAttr('required');
		$('#tambah_lokasi_ruangan').removeAttr('required');
		$('#tambah_id_hari').removeAttr('required');
		$('#tambah_id_status').removeAttr('required');
		$('#tambah_kode_jam').removeAttr('required');
		$('#tambah_jam_mulai').removeAttr('required');
		$('#tambah_jam_selesai').removeAttr('required');
		$('#tambah_sks_jam').removeAttr('required');
		$('#tambah_tahun_angkatan').removeAttr('required');
		$('#tambah_id_statusangkatan').removeAttr('required');
		$('#tambah_detail_id_angkatan').removeAttr('required');
		$('#tambah_detail_id_kelas').removeAttr('required');
		$('#tambah_peserta_kelas').removeAttr('required');
		$('#tambah_id_statuskelas').removeAttr('required');
		$('#tambah_id_detailmatkul').removeAttr('required');
		$('#tambah_detail_id_matkul').removeAttr('required');
		$('#tambah_detail_id_dosen').removeAttr('required');
		$('#tambah_detail_id_detailangkatan').removeAttr('required');
	}

	$('#btn-tambahKelas').click(function(){
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer"
		}
		setBtnDeleteModalInputData("hide",btnDeleteObject);
		showModalBody("#modal-body-tambahKelas");
		hideModalBodyExceptKelas();
		resetAllInputValueWithNull();
		removeRequiredInputExceptKelas();
		setModalProperties("#modal_title_input_data","Tambah Kelas Baru","#btn-submit-modal-input-data","Tambah","tambah_kelas","btn-primary",btn_footer_remove_class);
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
	});

	$('.btn-hapusKelas').click(function(){
		//tangkap id_kelas yang di klik untuk dihapus
		var id_kelas = $(this).data('id_kelas');
		var btn_hapus_kelas = true;
		showModalBody("#modal-body-tambahKelas");
		hideModalBodyExceptKelas();
		resetAllInputValueWithNull();
		removeRequiredInputExceptKelas();
		setModalProperties("#modal_title_input_data","Hapus Kelas","#btn-submit-modal-input-data","","","",btn_footer_remove_class);
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer",
			btn_footer_text : "Hapus",
			btn_footer_value : "hapus_kelas"
		}
		setBtnDeleteModalInputData("show",btnDeleteObject);
		$('#modal-body-alertHapus').fadeIn(3000);
		changeModalBtnFooterType("alert-hapus-btn-footer","submit");
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");

		$.ajax({
			url: 'http://localhost/penjadwalan/app/content/data.php',
			data: {btn_hapus_kelas:btn_hapus_kelas,id_kelas : id_kelas},
			method: 'post',
			datatype : 'json',
			success: function(data){
				//mengembalikan dalam bentuk objek
				var kelas = jQuery.parseJSON(data);
				$('#tambah_id_kelas').val(kelas['id_kelas']);
				$('#tambah_nama_kelas').val(kelas['nama_kelas']);
				$('#tambah_nama_kelas').attr("disabled","true");
			},
			error: function(data){
				callAjaxErrorMessage();
			}
		});
	});

	/*8. Detail Angkatan*/
	function hideModalBodyExceptInformasiAngkatan(){
		// hide semua modal body yang ada
		$('#modal-body-tambahMatkul').hide();
		$('#modal-body-informasiMatkul').hide();
		$('#modal-body-tambahDosen').hide();
		$('#modal-body-tambahHari').hide();
		$('#modal-body-tambahRuangan').hide();
		$('#modal-body-tambahJam').hide();
		$('#modal-body-tambahAngkatan').hide();
		$('#modal-body-tambahKelas').hide();
		$('#modal-body-informasiKelas').hide();
		$('#modal-body-alertHapus').hide();
	}
	function removeRequiredInputExceptInformasiAngkatan(){
		//Hilangkan semua required field 
		$('#tambah_kode_matkul').removeAttr('required');
		$('#tambah_nama_matkul').removeAttr('required');
		$('#tambah_sks_matkul').removeAttr('required');
		$('#tambah_semester_matkul').removeAttr('required');
		$('#tambah_id_kategorimatkul').removeAttr('required');
		$('#tambah_nip_dosen').removeAttr('required');
		$('#tambah_nama_dosen').removeAttr('required');
		$('#tambah_nama_ruangan').removeAttr('required');
		$('#tambah_kapasitas_ruangan').removeAttr('required');
		$('#tambah_lokasi_ruangan').removeAttr('required');
		$('#tambah_id_hari').removeAttr('required');
		$('#tambah_id_status').removeAttr('required');
		$('#tambah_kode_jam').removeAttr('required');
		$('#tambah_jam_mulai').removeAttr('required');
		$('#tambah_jam_selesai').removeAttr('required');
		$('#tambah_sks_jam').removeAttr('required');
		$('#tambah_nama_kelas').removeAttr('required');
		$('#tambah_tahun_angkatan').removeAttr('required');
		$('#tambah_id_statusangkatan').removeAttr('required');
		$('#tambah_id_detailmatkul').removeAttr('required');
		$('#tambah_detail_id_matkul').removeAttr('required');
		$('#tambah_detail_id_dosen').removeAttr('required');
		$('#tambah_detail_id_detailangkatan').removeAttr('required');
	}

	$('#btn-informasiAngkatan').click(function(){
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer"
		}
		setBtnDeleteModalInputData("hide",btnDeleteObject);
		showModalBody("#modal-body-informasiAngkatan");
		hideModalBodyExceptInformasiAngkatan();
		resetAllInputValueWithNull();
		removeRequiredInputExceptInformasiAngkatan();
		setModalProperties("#modal_title_input_data","Lengkapi Informasi Angkatan","#btn-submit-modal-input-data","Lengkapi","tambah_informasi_angkatan","btn-primary",btn_footer_remove_class);
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");
	});

	$('.btn-editInformasiAngkatan').click(function(){
		//tangkap id_detailangkatan yang di klik untuk dihapus
		var id_detailangkatan = $(this).data('id_detailangkatan');
		var btn_edit_detailangkatan = true;

		showModalBody("#modal-body-informasiAngkatan");
		hideModalBodyExceptInformasiAngkatan();
		//show alert
		$('#modal-body-alertHapus').show();
		resetAllInputValueWithNull();
		removeRequiredInputExceptInformasiAngkatan();
		setModalProperties("#modal_title_input_data","Edit Informasi Angkatan","#btn-submit-modal-input-data","Edit","edit_informasiangkatan","btn-warning",btn_footer_remove_class);
		var btnDeleteObject = {
			btn_footer_id : "#alert-hapus-btn-footer",
			btn_footer_text : "Hapus",
			btn_footer_value : "hapus_informasiangkatan"
		}
		setBtnDeleteModalInputData("show",btnDeleteObject);
		$('#modal-body-alertHapus').fadeIn(3000);
		changeModalBtnFooterType("alert-hapus-btn-footer","submit");
		changeModalBtnFooterType("btn-submit-modal-input-data","submit");

		$.ajax({
			url: 'http://localhost/penjadwalan/app/content/data.php',
			data: {btn_edit_detailangkatan:btn_edit_detailangkatan,id_detailangkatan : id_detailangkatan},
			method: 'post',
			datatype : 'json',
			success: function(data){
				//mengembalikan dalam bentuk objek
				var angkatan = jQuery.parseJSON(data);
				$('#tambah_id_detailangkatan').val(angkatan['id_detailangkatan']);
				$('#tambah_detail_id_kelas').val(angkatan['id_kelas']);
				$('#tambah_detail_id_kelas').attr("disabled","true");
				$('#tambah_detail_id_angkatan').val(angkatan['id_angkatan']);
				$('#tambah_detail_id_angkatan').attr("disabled","true");
				$('#tambah_peserta_kelas').val(angkatan['peserta_kelas']);
				$('#tambah_id_statuskelas').val(angkatan['id_statuskelas']);
				$('#tambah_id_statuskelas').attr("disabled","true");
			},
			error: function(data){
				callAjaxErrorMessage();
			}
		});
	});

});