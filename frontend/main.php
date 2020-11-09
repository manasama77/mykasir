<?php
$current_date = date('Y-m-d');
$q_event_list = mysqli_query($con, "SELECT
tbl_event.id_event,
tbl_event.nama,
tbl_produk.nama_produk,
tbl_satuan_produk.nama AS satuan,
tbl_event.tipe,
tbl_event.start_date,
tbl_event.end_date,
tbl_event.discount,
tbl_event.potongan_harga,
tbl_event.qty_minimal_pembelian,
tbl_event.id_produk_gratis,
tbl_event.qty_gratis,
tbl_event.akumulasi
FROM tbl_event
LEFT JOIN tbl_produk ON tbl_produk.id_produk = tbl_event.id_produk
LEFT JOIN tbl_satuan_produk ON tbl_satuan_produk.id_satuan_produk = tbl_produk.id_satuan_produk
WHERE tbl_event.`end_date` >= '$current_date'");
$row_event_list = mysqli_num_rows($q_event_list);
?>
<div class="row" style="margin-top:-25px;">
	<div class="col-lg-12">
		<div class="row">
			<marquee direction="left" scrollamount="5" behavior="loop">
				<h5><strong>
				<?php
				if($row_event_list == 0){
					echo "";
				}else{
					while($data_event_list = mysqli_fetch_assoc($q_event_list)){
						$nama_produk = $data_event_list['nama_produk'];
						$satuan = $data_event_list['satuan'];
						$nama_event = $data_event_list['nama'];
						$tipe = $data_event_list['tipe'];
						$start_date = $data_event_list['start_date'];
						$end_date = $data_event_list['start_date'];
						$discount = $data_event_list['discount'];
						$potongan_harga = $data_event_list['potongan_harga'];
						$qty_minimal_pembelian = $data_event_list['qty_minimal_pembelian'];
						$id_produk_gratis = $data_event_list['id_produk_gratis'];
						$qty_gratis = $data_event_list['qty_gratis'];
						$akumulasi = $data_event_list['akumulasi'];
						
						$q_produk_gratis = mysqli_query($con, "SELECT tbl_produk.nama_produk, tbl_satuan_produk.nama AS satuan FROM tbl_produk LEFT JOIN tbl_satuan_produk ON tbl_satuan_produk.id_satuan_produk = tbl_produk.id_satuan_produk WHERE tbl_produk.id_produk = '$id_produk_gratis'");
						
						$data_produk_gratis = mysqli_fetch_assoc($q_produk_gratis);
						$nama_produk_gratis = $data_produk_gratis['nama_produk'];
						$satuan_gratis = $data_produk_gratis['satuan'];
						
						if($akumulasi == "yes"){
							$terakumulasi = "Terakumulasi";
						}elseif($akumulasi == "no"){
							$terakumulasi = "Tidak Terakumulasi";
						}else{
							$terakumulasi = "";
						}
						
						echo "|";
						
						if($tipe == 1){
							echo " ~~ ".$nama_event." Discount ".$discount."% ~~ ";
							echo "|";
						}elseif($tipe == 2){
							echo " ~~ ".$nama_event." Potongan Rp. ".$potongan_harga." ~~ ";
							echo "|";
						}
						elseif($tipe == 3){
							echo " ~~ ".$nama_event." Beli ".$nama_produk." Minimal ".$qty_minimal_pembelian." ".$satuan." Gratis ".$nama_produk_gratis." ".$qty_gratis." ".$satuan_gratis." ".$terakumulasi." ~~ ";
							echo "|";
						}
					}
				}
				?>
				</strong></h5>
			</marquee>
		</div>
	</div>
</div>


	<div class="col-lg-4" style="text-align:right;">
		<div class="row">
			<div class="form-group">
				<label class="col-sm-4">Jenis Pelanggan</label>
				<div class="col-sm-3">
					<select id="jenis_pelanggan" name="jenis_pelanggan" class="form-control input-xs" onChange="jenispelanggan();">
						<option value="umum">Umum</option>
						<option value="member">Member</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 member">No Kartu Member</label>
				<div class="col-sm-4">
					<input type="text" class="form-control input-xs member" id="kode_member" name="kode_member" placeholder="Kode Member" maxlength="5" onChange="checkMember();">
				</div>
			</div>
			<div id="vnamamember" class="form-group">
				<label class="col-sm-4 member">Nama Member</label>
				<div class="col-sm-4">
					<input type="text" class="form-control input-xs member" id="nama_member" name="nama_member" readonly>
					<div id="vhelpnamamember" class="help-block hidden member" style="font-size:10px;">Member Tidak Ditemukan</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 member">Jenis Pembayaran</label>
				<div class="col-sm-4">
					<select id="tipe_pembayaran" name="tipe_pembayaran" class="form-control input-xs member" onChange="tipePembayaran()" title="Apabila melakukan pembayaran transaksi hutang, ganti jenis pembayaran menjadi Kontan" data-toggle="tooltip" data-placement="right">
						<option value="kontan">Kontan</option>
						<option value="hutang">Hutang</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-8">		
		<div class="col-lg-6" style="text-align:right;">
			<div class="row">
				<div class="form-group">
					<label class="col-sm-4">Kode Salesman</label>
					<div class="col-sm-4">
						<input type="text" class="form-control input-xs" id="kode_salesman" name="kode_salesman" placeholder="Kode Salesman" onChange="checkSalesmanbykode();" onKeyUp="checkSalesmanbykode();" maxlength="5">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label class="col-sm-4">Salesman</label>
					<div class="col-sm-4">
						<input type="text" class="form-control input-xs" id="nama_salesman" name="nama_salesman" placeholder="Nama Salesman" maxlength="50" onChange="checkSalesmanbynama();" onKeyUp="checkSalesmanbynama();">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6" style="text-align:right;">
			<div class="row">
				<div class="form-group">
					<label class="col-sm-4">No Transaksi</label>
					<div class="col-sm-5">
						<div class="input-group">
							<input type="text" class="form-control input-sm" id="kode_penjualan" name="kode_penjualan" placeholder="No Transaksi" readonly>
							<span class="input-group-addon input-xs">
								<button type="button" class="btn btn-xs btn-primary" onClick="searchKode()"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label class="col-sm-4">Tanggal</label>
					<div class="col-sm-4">
						<input type="text" class="form-control input-xs" id="tanggal_transaksi" name="tanggal_transaksi" value="<?=date('Y-m-d');?>" readonly>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<h1>
			<label class="control-label col-lg-4" style="margin-top:-10px;">Grand Total</label>
			<div class="col-lg-7">
				<input type="text" class="form-control input-lg digital" style="border:2px solid red; font-size:45px;" id="grand_total" name="grand_total" value="0.00" readonly>
				<div class="help-block"><h5 id="terbilang" style="text-align:right;"> </h5></div>
			</div>
			</h1>
		</div>
	</div>
	<div class="col-lg-12"><hr style="margin-top:0px; border:1px dashed;"></div>

<div class="col-lg-4">
	<div class="row">
		<div id="cbarcode" class="form-group" style="text-align:right;">
			<label class="contol-label col-sm-3">Barcode</label>
			<div class="col-sm-8">
				<input type="text" class="form-control input-xs" id="barcode" name="barcode" placeholder="Barcode" maxlength="13" accesskey="b" title="Gunakan Alt + B untuk langsung memasukan barcode..." data-toggle="tooltip" data-placement="right" onChange="checkBarcode('bar');">
				<span id="cbarcodehelp" class="help-block hidden">Produk tidak ditemukan</span>
			</div>
		</div>
	</div>
</div>


<div class="col-lg-12">
	<div class="row form-vertical">
		<table class="table table-hover table-condensed" style="font-size:12px;">
		<thead>
			<tr>
				<th style="text-align:center;">Kode Produk</th>
				<th style="text-align:center;">Nama Produk</th>
				<th style="text-align:center;">Satuan</th>
				<th style="text-align:center;">Qty</th>
				<th style="text-align:center;">Harga Jual</th>
				<th style="text-align:center;">Total Harga</th>
				<th style="text-align:center;"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<input type="text" class="form-control input-xs" id="kode_produk" name="kode_produk" placeholder="Kode Produk" maxlength="5" readonly>
				</td>
				<td style="text-align:center;">
					<select class="form-control input-xs" id="nama_produk" name="nama_produk" onKeyUp="checkBarcode('nama');" onChange="checkBarcode('nama');">
						<option value="">-</option>
					<?php
					$q_nama_produk = mysqli_query($con, "SELECT id_produk, nama_produk FROM tbl_produk");
					while($data_nama_produk = mysqli_fetch_assoc($q_nama_produk)){
					?>
						<option value="<?=$data_nama_produk['id_produk'];?>"><?=$data_nama_produk['nama_produk'];?></option>
					<?php
					}
					?>
					</select>
				</td>
				<td><input type="text" class="form-control input-xs" id="satuan" name="satuan" placeholder="Satuan" maxlength="25" readonly></td>
				<td>
					<div class="input-group">
						<input type="number" class="form-control input-xs" style="width:60px;" id="qty" name="qty" placeholder="Qty" min="1" max="99999" step="1" onKeyUp="checkTotal();" onChange="checkTotal();">
						<span id="cstock" class="input-group-addon input-xs" style="font-size:10px;width:100%;" data-toggle="tooltip" data-placement="top" title="Laporkan jika Qty Stock akan atau sudah habis..."> </span>
					</div>
				</td>
				<td>
					<input type="text" class="form-control input-xs" id="harga_jual" name="harga_jual" placeholder="Harga Jual" maxlength="12" onChange="checkTotal();">
				</td>
				<td>
					<input type="text" class="form-control input-xs" id="total" name="total" placeholder="Total" maxlength="12" readonly>
				</td>
				<td>
					<div class="checkbox">
						<label><input id="special_event" type="checkbox" style="margin-top:1px;"> Special Price</label>
					</div>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2">
					<button id="tambah" type="button" class="btn btn-info btn-block btn-sm" accesskey="l" data-toggle="tooltip" data-placement="bottom" title="Gunakan Alt + L untuk langsung memasukan kedalam daftar belanja..." onClick="tambahListPenjualan();">
						<i class="fa fa-level-down"></i> Tambah ke Daftar Belanja
					</button>
				</th>
				<th colspan="7">
					<mark id="pesannya">
						Pada saat memulai transaksi pastikan untuk klik <u>Tombol Transaksi Baru</u><br>
						Pastikan Selalu melakukan cek sebelum menambahkan produk kedalam daftar Belanja<br>
						Selalu Periksa Uang yang diterima dari pembeli dan juga memastikan jumlah kembalian telah sesuai
					</mark>
				</th>
			</tr>
		</tfoot>
		</table>
	</div>
	<hr style="margin-top:0px; border:1px dashed;">
</div>


<div id="vlistpenjualan" class="col-lg-12">
	<table class="table table-bordered table-hover table-condensed table-striped small">
	<thead>
		<tr>
			<th style="text-align:center;" width="10px"><i class="fa fa-gear"></th>
			<th style="text-align:center;">Kode Produk</th>
			<th style="text-align:center;">Nama Produk</th>
			<th style="text-align:center;">Satuan</th>
			<th style="text-align:center;">Qty</th>
			<th style="text-align:right;">Harga Jual</th>
			<th style="text-align:center;">Disc (%)</th>
			<th style="text-align:right;">Disc (Rp)</th>
			<th style="text-align:right;">Harga Jual (Nett)</th>
			<th style="text-align:right;">Total Harga</th>
		</tr>
	</thead>
	</table>
</div>

<div class="col-lg-7">
	<div class="row">
		<div class="col-lg-6">
			<label class="contol-label">Catatan</label>
			<textarea id="catatan" name="catatan" class="form-control"></textarea>
		</div>
		<div class="col-lg-6">
			<div class="row form-inline">
				<label class="col-lg-6" style="text-align:right;">Tanggal Pelunasan</label>
				<div class="col-lg-6">
					<input type="text" id="tanggal_pelunasan" name="tanggal_pelunasan" class="form-control input-xs" maxlength="10" value="<?=date('Y-m-d');?>">
				</div>
			</div>
			<div class="row form-inline">
				<label class="col-lg-6" style="text-align:right;">Tanggal Jth Tempo</label>
				<div class="col-lg-6">
					<input type="text" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" class="form-control input-xs" maxlength="10" value="<?=date('Y-m-d');?>">
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row form-inline">
		<div class="col-lg-12">
			<button type="button" id="data_baru" class="btn btn-primary btn-block" accesskey="n" title="Gunakan Alt + N Membuat Transaksi Baru..." data-toggle="tooltip" 	data-placement="right">
				<i class="fa fa-file"></i> Transaksi Baru
			</button>
		</div>
	</div>
	<!--div class="row form-inline">
		<div class="col-lg-12">
			<button type="button" id="clear_form" class="btn btn-warning btn-block" accesskey="c" title="Gunakan Alt + C Membersihkan Form..." data-toggle="tooltip" data-placement="right" onClick="ClearForm();">
				<i class="fa fa-eraser"></i> Bersihkan Form
			</button>
		</div>
	</div-->
	<hr>
</div>
<div class="col-lg-5" align="right">
	<div class="row form-inline">
		<label class="control-label col-lg-5" style="text-align:right;">Sub Total</label>
		<div class="col-lg-offset-1 col-lg-6">
			<input type="text" id="sub_total" name="sub_total" class="form-control input-sm" style="text-align:right;width:150px;" min="0.01" max="999999999.99" step="0.01" placeholder="Sub Total" readonly>
		</div>
	</div>
	<div class="row form-inline">
		<label class="control-label col-lg-5" style="text-align:right;">Discount</label>
		<div class="col-lg-7">
			<div class="input-group">
				<input type="text" id="discount_persen_total" name="discount_persen_total" class="form-control input-sm" style="width:50px;" placeholder="%" maxlength="5" onChange="checkDiscountTotal('persen');">
				<span class="input-group-addon" style="font-size:10px;">%</span>
				<input type="text" id="discount_rp_total" name="discount_rp_total" class="form-control input-sm" style="text-align:right;width:150px;" placeholder="Discount" maxlength="12" onChange="checkDiscountTotal('rp');">
			</div>
		</div>
	</div>
	<div class="row form-inline">
		<label class="control-label col-lg-5" style="text-align:right;">PPN 10%</label>
		<div class="col-lg-offset-1 col-lg-6">
			<div class="checkbox">
				<label><input id="ppn" type="checkbox" onChange="checkPPN();"></label>
			</div>
			<input type="text" id="harga_ppn" name="harga_ppn" class="form-control input-sm" style="text-align:right;width:150px;" maxlength="12" placeholder="PPN" readonly>
		</div>
	</div>
	<div class="row form-inline">
		<label class="control-label col-lg-5" style="text-align:right;">Pembayaran</label>
		<div class="col-lg-offset-1 col-lg-6">
			<input type="text" id="pembayaran" name="pembayaran" class="form-control input-sm pembayaran" style="text-align:right;width:150px;" placeholder="Pembayaran" onChange="bayar();" onKeyUp="bayar();" maxlength="17" accesskey="m" title="Gunakan Alt + M untuk langsung memasukan Pembayaran..." data-toggle="tooltip" data-placement="left">
		</div>
	</div>
	<!--div class="row form-inline">
		<label class="control-label col-lg-5" style="text-align:right;">Kembalian / Piutang</label>
		<div class="col-lg-offset-1 col-lg-6">
			<input type="text" id="kembalian" name="kembalian" class="form-control input-sm" style="text-align:right;width:150px;" placeholder="Kembalian" readonly>
		</div>
	</div-->
	<div class="row form-inline">
		<div class="col-lg-12">
			<button type="button" id="process" class="btn btn-success btn-block" accesskey="s" title="Gunakan Alt + S menyelesaikan Proses Transaksi..." onClick="prosessimpan();">
				<i class="fa fa-floppy-o"></i> Process
			</button>
			</div>
	</div>
	<div class="row form-inline">
		<div class="col-lg-12">
			<button type="button" id="print" class="btn btn-default btn-block" accesskey="p" title="Gunakan Alt + P untuk Print Transaksi..." data-toggle="tooltip" data-placement="left" onClick="printstruk();"><i class="fa fa-print"></i> Print</button>
		</div>
	</div>
	
</div>

<div class="col-lg-12">
	<br>
	<hr style="margin-top:0px; border:1px dashed;">
</div>