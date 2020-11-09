<?php
//header("Content-Type: application/json; charset=UTF-8");
include("../../../config.php");
$result = $con->query("
(SELECT
penjualan.kode_penjualan,
penjualan.jenis_pelanggan,
penjualan.create_date,
penjualan.grand_total,
penjualan.catatan
FROM tbl_penjualan AS penjualan)
UNION
(SELECT
penjualan2.kode_penjualan,
penjualan2.jenis_pelanggan,
penjualan2.create_date,
penjualan2.grand_total,
penjualan2.catatan
FROM tbl_penjualan_hutang AS penjualan2
WHERE penjualan2.status = 'lunas')
ORDER BY `create_date` DESC
");
$outp = array();
//$outp = $result->fetch_all(MYSQLI_ASSOC);
while($row = $result->fetch_assoc()){
	$outp[] = $row;
}

echo json_encode($outp);
?>