$(document).ready(function(){
	// Index Page
	var state_ico_user = 0;
	$('#btn-user').click(function(){
		$('#sub-user').toggle(500);
		if (state_ico_user%2==0) {
			$('#top-ico-user').toggle(500);
			$('#down-ico-user').fadeOut("slow");
		}else{
			$('#top-ico-user').fadeOut("slow");
			$('#down-ico-user').toggle(500);
			
		}
		state_ico_user++;
	});
	
	$("#sidebar-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	$('#btn-prosesgenetika').click(function(){
		$('#prosesgenetika-subitem').toggle(500);
	});

	// Input data page
	var state_ico_angkatan=0;
	$('#btn-angkatan').click(function(){
		$('#sub-angkatan').toggle(500);
		if (state_ico_angkatan%2==0) {
			$('#top-ico-angkatan').toggle(500);
			$('#down-ico-angkatan').fadeOut("slow");
		}else{
			$('#top-ico-angkatan').fadeOut("slow");
			$('#down-ico-angkatan').toggle(500);
			
		}
		state_ico_angkatan++;
	});

	var state_ico_kelas=0;
	$('#btn-kelas').click(function(){
		$('#sub-kelas').toggle(500);
		if (state_ico_kelas%2==0) {
			$('#top-ico-kelas').toggle(500);
			$('#down-ico-kelas').fadeOut("slow");
		}else{
			$('#top-ico-kelas').fadeOut("slow");
			$('#down-ico-kelas').toggle(500);
			
		}
		state_ico_kelas++;
	});

	var state_ico_matkul = 0;
	$('#btn-matkul').click(function(){
		$('#sub-matkul').toggle(500);
		if (state_ico_matkul%2==0) {
			$('#top-ico-matkul').toggle(500);
			$('#down-ico-matkul').fadeOut("slow");
		}else{
			$('#top-ico-matkul').fadeOut("slow");
			$('#down-ico-matkul').toggle(500);
			
		}
		state_ico_matkul++;
	});
	
});