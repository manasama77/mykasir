//////////////////////////////////////////
// Konfigurasi Plugin Jquery Datepicker
// Untuk Aplikasi Kasir UD Mandiri Cahaya Abadi
////////////////////////////////////////
$.datepicker.setDefaults({
  dateFormat: 'yy-mm-dd',
  autoSize: true,
  changeMonth: true,
  changeYear: true,
  duration: "medium",
  showAnim: "drop"
});

$(function() {
	$( "#tanggal_pelunasan" ).datepicker().val();
	$( "#tanggal_jatuh_tempo" ).datepicker().val();
});