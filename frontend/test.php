<?php
$beli = "2.5";
$minimal = "1";

if($beli >= $minimal){
	$qty_terkena_event = floor($beli / $minimal);
	if($qty_terkena_event >= 1){
		echo $qty_terkena_event;
	}else{
		echo "tidak terkena potongan";
	}
}else{
	echo "tidak terkena potongan";
}

?>
<br>
minimal pembelian 2 gratis 1
beli 4 gratis 2