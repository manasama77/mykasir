<?php
function get_browser_name($user_agent)
{
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
    elseif (strpos($user_agent, 'Edge')) return 'Edge';
    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
    elseif (strpos($user_agent, 'Safari')) return 'Safari';
    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
    
    return 'Other';
}

function generate_session_id($unique_id)
{
	$unique_id = strip_tags($unique_id);
	$unique_id = stripslashes($unique_id);
	
	return $unique_id = $unique_id.session_id();
}

function check_username($username)
{
	include("config.php");
	$q_check_user_available = mysqli_query($con, "SELECT user.username FROM tbl_user AS user WHERE user.username = '".$username."'");
	return $result = mysqli_num_rows($q_check_user_available);
}

function check_login($username, $password)
{
	include("config.php");
	$q_check_password = mysqli_query($con, "SELECT usernya.id_user, usernya.id_role, usernya.nama FROM tbl_user AS usernya WHERE usernya.username = '$username' AND usernya.password = '$password'");
	return $result = mysqli_num_rows($q_check_password);
}
?>