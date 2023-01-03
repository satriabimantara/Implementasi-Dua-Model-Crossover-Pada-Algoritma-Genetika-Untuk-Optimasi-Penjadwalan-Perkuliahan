<?php
function getAngka(&$angka){
	return count($angka);
}
$angka = array(1,2,3,4,5,6);
echo getAngka($angka);

?>