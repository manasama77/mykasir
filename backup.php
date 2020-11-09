<?php
date_default_timezone_set('asia/jakarta');
$current_date = date("F_j_Y-g_i_a");
exec('D:/XAMPP/mysql/bin/mysqldump.exe --user=root --password=secret ananda_db > DB/bck_Ananda_DB_'.$current_date.'.sql');

echo "Berhasil";
?>