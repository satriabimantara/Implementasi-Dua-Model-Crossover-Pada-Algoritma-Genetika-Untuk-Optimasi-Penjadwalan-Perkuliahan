$(document).ready(function(){
	/*INPUT DATA PAGE*/
	function inputDataTable(object){
		for (const keys in object) {
			$(object[keys].id).DataTable({
				scrollX: 550,
				scrollY: 550,
				"processing": true,
				autoWidth :false,
				buttons: [
				{
					extend :'pdfHtml5',
					className : 'btn-success',
					orientation :'landscape',
					text: '<i class="fa fa-file-pdf-o"></i> PDF',
					title: object[keys].title,
					extension: ".pdf",
					filename: object[keys].filename
				}
				],
				"dom": `
				<'d-flex justify-content-between mb-3 btn-sm' fB> +
				<'mb-3' t> +
				<'d-flex justify-content-between mb-5 mt-3'lp>
				`
			});
		}
	}
	let table = {
		table1 : {
			id : "#table_mata_kuliah",
			title : "Daftar Mata Kuliah",
			filename : "Daftar Mata Kuliah"
		},
		table2 : {
			id : "#table_detail_mata_kuliah",
			title : "Detail Mata Kuliah",
			filename : "Detail Mata Kuliah"
		},
		table3 : {
			id : "#table_dosen",
			title : "Daftar Dosen",
			filename : "Daftar Dosen"
		},
		table4 : {
			id : "#table_ruangan",
			title : "Informasi Ruangan",
			filename : "Informasi Ruangan"
		},
		table5 :{
			id : "#table_hari",
			title : "Informasi Hari",
			filename : "Informasi Hari"
		},
		table6 :{
			id : "#table_jam",
			title : "Informasi Jam",
			filename : "Informasi Jam"
		},
		table7 :{
			id : "#table_angkatan",
			title : "Informasi Angkatan",
			filename : "Informasi Angkatan"
		},
		table8 :{
			id : "#table_detail_angkatan",
			title : "Detail Angkatan",
			filename : "Detail Angkatan"
		},
		table9 :{
			id : "#table_kelas",
			title : "Informasi Kelas",
			filename : "Informasi Kelas"
		}
	};
	inputDataTable(table);

	/*PROSES GENETIKA PAGE*/
	$('#table_susunan_kromosom').DataTable( {
		scrollX: 450,
		scrollY: 450,
		"processing": true,
		buttons: [
		{
			extend :'pdfHtml5',
			className : 'btn-danger',
			orientation :'landscape',
			text: '<i class="fa fa-file-pdf-o"></i> PDF',
			title: 'Model Kromosom',
			extension: ".pdf",
			filename: "Model Kromosom",
			pageSize : 'A0'
		},
		{
			extend: 'print',
			className : 'btn-info',
			text: '<i class="fa fa-print"></i> Print',
			title:'Model Kromosom',
			exportOptions: {
				columns: ':visible',
			}
		},
		{
			extend : 'excelHtml5',
			className :'btn-info',
			text: '<i class="fa fa-file-excel-o"></i> Excel',
			title : 'Model Kromosom',
			customize : function( xlsx ) {
				var sheet = xlsx.xl.worksheets['sheet1.xml'];
				$('row:first t', sheet).text('Model Susunan Kromosom');
				$('row c',sheet).each(function(){
					$(this).attr('s','25');
				});
				$('row c[r^="B"]', sheet).each( function () {
                    // Get the value
                    if ( $('is t', this).text() == 'Mata Kuliah' ) {
                    	$(this).attr( 's', '20' );
                    }else if ($('is t', this).text() == 'Dosen') {
                    	$(this).attr( 's', '15' );
                    }else if ($('is t', this).text() == 'Kelas') {
                    	$(this).attr( 's', '5' );
                    }
                });
			}
		}
		],
		"dom": `
		<'d-flex justify-content-between mb-3' fB> +
		<'mb-3' t> +
		<'d-flex justify-content-between mb-5'ip>
		`,
		"order": [[0, 'asc']]
	});

	$('#table_proses_crossover').DataTable( {
		scrollX: 450,
		scrollY: 450,
		"processing": true,
		autoWidth :false,
		buttons: [
		{
			extend :'pdfHtml5',
			className : 'btn-danger',
			orientation :'landscape',
			text: '<i class="fa fa-file-pdf-o"></i> PDF',
			title: 'Proses Cross Over',
			extension: ".pdf",
			filename: "Proses Cross Over"
		},
		{
			extend: 'print',
			className : 'btn-info',
			text: '<i class="fa fa-print"></i> Print',
			title:'Proses Cross Over',
			exportOptions: {
				columns: ':visible',
			}
		},
		{
			extend : 'excelHtml5',
			className :'btn-info',
			text: '<i class="fa fa-file-excel-o"></i> Excel',
			title : 'Proses Cross Over',
			filename :"Proses Cross Over"
		}
		],
		"dom": `
		<'d-flex justify-content-between mb-3' fB> +
		<'mb-3' t> +
		<'d-flex justify-content-between mb-5'ip>
		`,
		"order": [[0, 'asc']]
	});

	$('#table_mutasi_kromosom').DataTable( {
		scrollX: 475,
		scrollY: 475,
		"processing": true,
		buttons: [
		{
			extend :'pdfHtml5',
			className : 'btn-danger',
			orientation :'landscape',
			text: '<i class="fa fa-file-pdf-o"></i> PDF',
			title: 'Mutasi Kromosom',
			extension: ".pdf",
			filename: "Tabel Hasil Mutasi",
			pageSize : 'A0'
		},
		{
			extend: 'print',
			className : 'btn-info',
			text: '<i class="fa fa-print"></i> Print',
			title:'Mutasi Kromosom',
			exportOptions: {
				columns: ':visible',
			}
		},
		{
			extend : 'excelHtml5',
			className :'btn-info',
			text: '<i class="fa fa-file-excel-o"></i> Excel',
			title : 'Mutasi Kromosom',
			filename :"Mutasi Kromosom"
		}
		],
		
		"dom": `
		<'d-flex justify-content-between mb-3' fB> +
		<'mb-3' t> +
		<'d-flex justify-content-between mb-5'ip>
		`,
		"order": [[0, 'asc']]
	});

	$('#table_seleksi_kromosom').DataTable( {
		scrollX: 450,
		scrollY: 450,
		"processing": true,
		buttons: [
		{
			extend :'pdfHtml5',
			className : 'btn-danger',
			orientation :'landscape',
			text: '<i class="fa fa-file-pdf-o"></i> PDF',
			title: 'Seleksi Kromosom',
			extension: ".pdf",
			filename: "Tabel Seleksi Kromosom",
			pageSize : 'A0'
		},
		{
			extend: 'print',
			className : 'btn-info',
			text: '<i class="fa fa-print"></i> Print',
			title:'Seleksi Kromosom',
			exportOptions: {
				columns: ':visible',
			}
		},
		{
			extend : 'excelHtml5',
			className :'btn-info',
			text: '<i class="fa fa-file-excel-o"></i> Excel',
			title : 'Seleksi Kromosom',
			filename :"Seleksi Kromosom"
		}
		],
		
		"dom": `
		<'d-flex justify-content-between mb-3' fB> +
		<'mb-3' t> +
		<'d-flex justify-content-between mb-5'ip>
		`,
		"order": [[0, 'asc']]
	});

	$('#table_jadwal_final').DataTable( {
		scrollX: 450,
		scrollY: 450,
		"processing": true,
		"searching": true,
		paging : false,
		buttons: [
		{
			extend :'pdfHtml5',
			className : 'btn-danger',
			orientation :'landscape',
			text: '<i class="fa fa-file-pdf-o"></i> PDF',
			title: $('#filename').val(),
			extension: ".pdf",
			filename: $('#filename').val(),
			pageSize: 'A3',
			customize: function (doc) {
				var tblBody = doc.content[1].table.body;
				var now = new Date();
				var jsDate = now.toGMTString();
				doc['footer']=(function(page, pages) {
					return [
					{canvas: [ { type: 'line', x1: 30, y1: 15, x2: 595-30, y2: 15, lineWidth: 1,color:'black' } ]},
					{
						columns: [

						{
							alignment: 'left',
							fontSize:'7',
							text: ['Version: 1.0'],
						},
						{
							alignment: 'center',
							fontSize:'7',
							text: ['page ', { text: page.toString() }]
						},
						{
							alignment: 'right',
							fontSize:'7',
							text: ['Dibuat tanggal: ', { text: jsDate}]
						},

						],
						margin: [5,5,5,5]
					},
					]
				});
				//Untuk memberikan border di dalam tabel ketika diexport menjadi pdf
				var objLayout = {};
				objLayout['hLineWidth'] = function(i) { return .5; };
				objLayout['vLineWidth'] = function(i) { return .5; };
				objLayout['hLineColor'] = function(i) { return '#aaa'; };
				objLayout['vLineColor'] = function(i) { return '#aaa'; };
				objLayout['paddingLeft'] = function(i) { return 4; };
				objLayout['paddingRight'] = function(i) { return 4; };
				doc.content[1].layout = objLayout;
				doc.pageMargins = [30, 30, 30,30 ];
			}
		},
		{
			extend : 'excelHtml5',
			className :'btn-info',
			text: '<i class="fa fa-file-excel-o"></i> Excel',
			title : $('#filename').val(),
			customize : function( xlsx ) {
				var sheet = xlsx.xl.worksheets['sheet1.xml'];
				$('row:first t', sheet).text($('#filename').val());
				$('row c',sheet).each(function(){
					$(this).attr('s','25');
				});
				$('row c[r^="B"]', sheet).each( function () {
                    // Get the value
                    if ( $('is t', this).text() == 'Senin' ) {
                    	$(this).attr( 's', '5' );
                    }else if ($('is t', this).text() == 'Selasa') {
                    	$(this).attr( 's', '10' );
                    }else if ($('is t', this).text() == 'Rabu') {
                    	$(this).attr( 's', '15' );
                    }else if ($('is t', this).text() == 'Kamis') {
                    	$(this).attr( 's', '20' );
                    }
                });
			}
		}
		],
		dom: `
		" <'d-flex justify-content-between mb-3'fB>"+
		<'row'<'col't>>"+
		"<'mb-lg-4'>"+
		"<'mb-3'>"
		`,
	});
});