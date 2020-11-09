<?php
date_default_timezone_set('asia/jakarta');
$current_date = date("F_j_Y-g_i_a");
exec('C:/XAMPP/mysql/bin/mysqldump.exe --user=root --password= matrial_db > ../../DB/matrial'.$current_date.'.sql');

echo "Berhasil";
?>