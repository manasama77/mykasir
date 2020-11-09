<?php
session_start();
$id_session = $_SESSION['id_user'];
include("../../config.php");

$q_list = mysqli_query($con, "SELECT
tbl_list_pembelian.id_list_pembelian,
tbl_list_pembelian.id_produk,
tbl_list_pembelian.qty,
tbl_list_pembelian.hpp,
tbl_list_pembelian.hpj,
tbl_list_pembelian.hpg,
tbl_list_pembelian.discount_persen,
tbl_list_pembelian.discount_rp,
tbl_list_pembelian.harga_beli_nett,
tbl_list_pembelian.total_harga_beli,
tbl_list_pembelian.tanggal_kadarluarsa,
tbl_produk.barcode,
tbl_produk.kode_produk,
tbl_produk.nama_produk,
tbl_satuan_produk.nama AS satuan
FROM tbl_list_pembelian
LEFT JOIN tbl_produk ON tbl_produk.id_produk = tbl_list_pembelian.id_produk
LEFT JOIN tbl_satuan_produk ON tbl_satuan_produk.id_satuan_produk = tbl_produk.id_satuan_produk
WHERE tbl_list_pembelian.status = '0' AND
tbl_list_pembelian.id_create = '$id_session'");

$nm_q_list = mysqli_num_rows($q_list);

$q_sub = mysqli_query($con, "SELECT
SUM(tbl_list_pembelian.total_harga_beli) AS sub_total
FROM tbl_list_pembelian
WHERE tbl_list_pembelian.status = '0' AND
tbl_list_pembelian.id_create = '$id_session'");

$fa_q_sub = mysqli_fetch_array($q_sub);
$sub_total = $fa_q_sub['sub_total'];

$q_ppn = mysqli_query($con, "SELECT
ppn,
harga_ppn
FROM tbl_temp_pembelian
WHERE id_user = '$id_session'");

$fa_q_ppn = mysqli_fetch_array($q_ppn);
$ppn = $fa_q_ppn['ppn'];
$harga_ppn = $fa_q_ppn['harga_ppn'];

if($ppn == 0){
	$harga_ppn = "0";
}else{
	$harga_ppn = $fa_q_ppn['harga_ppn'];
}
?>

<?php
function kekata($x) {
$x = abs($x);
$angka = array("", "satu", "dua", "tiga", "empat", "lima","enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
$temp = "";
if ($x <12) {
	$temp = " ". $angka[$x];
} else if ($x <20) {
	$temp = kekata($x - 10). " belas";
} else if ($x <100) {
	$temp = kekata($x/10)." puluh". kekata($x % 10);
} else if ($x <200) {
	$temp = " seratus" . kekata($x - 100);
} else if ($x <1000) {
	$temp = kekata($x/100) . " ratus" . kekata($x % 100);
} else if ($x <2000) {
	$temp = " seribu" . kekata($x - 1000);
} else if ($x <1000000) {
	$temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
} else if ($x <1000000000) {
	$temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
} else if ($x <1000000000000) {
	$temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
} else if ($x <1000000000000000) {
	$temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
}
	return $temp;
}

function terbilang($x, $style=4) {
	if($x<0) {
		$hasil = "minus ". trim(kekata($x));
	} else {
		$hasil = trim(kekata($x));
	}
	
	switch ($style) {
	case 1:
		$hasil = strtoupper($hasil);
	break;
	case 2:
		$hasil = strtolower($hasil);
	break;
	case 3:
		$hasil = ucwords($hasil);
	break;
	default:
	$hasil = ucfirst($hasil);
	break;
	}
	
	return $hasil;
}
?>
<table class="table table-bordered table-responsive table-hover">
	<tr>
		<th style="text-align:center;"><i class="fa fa-gear fa-fw"></i></th>
		<th style="text-align:left;">Barcode</th>
		<th style="text-align:left;">Nama Produk</th>
		<th style="text-align:center;">Tanggal Kadarluarsa</th>
		<th style="text-align:center;">Qty</th>
		<th style="text-align:right;">Harga Beli</th>
		<th style="text-align:right;">Harga Jual</th>
		<th style="text-align:right;">Harga Grosir</th>
		<th style="text-align:right;">Discount %</th>
		<th style="text-align:right;">Discount (Rp)</th>
		<th style="text-align:right;">Harga Beli (Nett)</th>
		<th style="text-align:right;">Total Harga</th>
	</tr>
	<?php
	while($data = mysqli_fetch_array($q_list)){
		$id_list_pembelian = $data['id_list_pembelian'];
		$barcode = $data['barcode'];
		$kode_produk = $data['kode_produk'];
		$nama_produk = $data['nama_produk'];
		$satuan = $data['satuan'];
		$qty = $data['qty'];
		$hpp = $data['hpp'];
		$hpj = $data['hpj'];
		$hpg = $data['hpg'];
		$discount_persen = $data['discount_persen'];
		$discount_rp = $data['discount_rp'];
		$harga_beli_nett = $data['harga_beli_nett'];
		$total_harga_beli = $data['total_harga_beli'];
		$tanggal_kadarluarsa = $data['tanggal_kadarluarsa'];
	?>
	<tr>
		<td style="text-align:center;">
			<button type="button" class="btn btn-danger btn-xs" onClick="hapus(<?=$id_list_pembelian;?>)"><i class="fa fa-trash fa-fw"></i> </button>
		</td>
		<td style="text-align:left;"><?=$barcode;?></td>
		<td style="text-align:left;"><?=$kode_produk;?> - <?=$nama_produk;?></td>
		<td style="text-align:center;"><?=$tanggal_kadarluarsa;?></td>
		<td style="text-align:center;"><?=number_format($qty,1);?> <?=$satuan;?></td>
		<td style="text-align:right;"><?=number_format($hpp,2);?></td>
		<td style="text-align:right;"><?=number_format($hpj,2);?></td>
		<td style="text-align:right;"><?=number_format($hpg,2);?></td>
		<td style="text-align:right;"><?=number_format($discount_persen,0);?></td>
		<td style="text-align:right;"><?=number_format($discount_rp,2);?></td>
		<td style="text-align:right;"><?=number_format($harga_beli_nett,2);?></td>
		<td style="text-align:right;"><?=number_format($total_harga_beli,2);?></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<th colspan="11" style="text-align:right;">Sub Total</th>
		<th id="sub_total" style="text-align:right;"><?=number_format($sub_total,2);?></th>
	</tr>
	<tr>
		<th colspan="11" style="text-align:right;">PPN 10%</th>
		<th id="harga_ppn" style="text-align:right;"><?=number_format($harga_ppn,2);?></th>
	</tr>
	<?php
	$grand_total = $sub_total + $harga_ppn;
	//$grand_total = "1.2";
	
	$check_titik = stripos($grand_total, ".");
	
	if($check_titik > 0){
		$explode_grand_total = explode('.', $grand_total);
		$gt1 = $explode_grand_total[0];
		$gt2 = $explode_grand_total[1];
		$terbilang_rupiah = terbilang($gt1,3);
		$terbilang_koma = terbilang($gt2,3);
		$terbilang_grand_total = "$terbilang_rupiah Koma $terbilang_koma Rupiah";
	}else{
		$terbilang_rupiah = terbilang($grand_total,3);
		$terbilang_grand_total = "$terbilang_rupiah Rupiah";
	}
	?>
	<tr>
		<th colspan="11" style="text-align:right;">Grand Total</th>
		<th style="text-align:right;"><?=number_format($grand_total,2);?></th>
	</tr>
	<tr>
		<th colspan="12" style="text-align:right;"><?=$terbilang_grand_total;?></th>
	</tr>
</table>
<input type="hidden" id="count_pembelian" name="count_pembelian" value="<?=$nm_q_list;?>">

<script>
function hapus(id){
	$.ajax({
		type:'POST',
		//data:id,
		url:'hapus_produk_entry.php?id='+id,
		success:function(data) {
			//alert("Data Berhasil Terhapus");
		},
		error: function(data)
		{
			alert("Proses hapus data gagal, silahkan hubungi Rimsmedia");
		}
	});
}


</script>