<?php
include "../../config/class.php";
if (isset($_GET['page'])) {
	$title_page = $_GET['page'];
} else {
	$title_page = "Home";
}
?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= URL; ?>assets/css/bootstrap.css">
	<!-- Connect to our style css -->
	<link rel="stylesheet" href="<?= URL; ?>assets/css/style.css">
	<!-- Data Tabel -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">

	<!-- FontAwesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Connect to SweetAlert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!-- Ajax -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


	<title><?= $title_page; ?></title>

</head>

<body>