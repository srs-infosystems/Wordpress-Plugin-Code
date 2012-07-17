<?php
/**
 * 	Controll all ajax and other requests
 *  
 */
include_once('class.php');

$ls_obj = new microinv();
$ls_root = $ls_obj -> get_blog_root_dir();

/**
 * 	Must include to run all wordpress functions
 *  
 */
include_once($ls_root.'wp-load.php');

/**
 * 	Security check
 *  
 */
if(!function_exists('current_user_can') OR !current_user_can('administrator'))
{
	die("Unauthorized Access!");
}

//if(isset($_REQUEST['action']))
//{	
	//error_reporting(0);
	//ini_set('display_errors',0);
//}

$action = trim($_REQUEST['action']);
switch($action)
{
	case 'ls_get_microinv_page':
	  	$type = $_REQUEST['operation'];
		$ls_content = $ls_obj -> ls_do_get_microinv_page($type);
	break;
	
	case 'ls_get_microinv_page_data':
		$type = $_REQUEST['operation'];
		$ls_content = $ls_obj -> ls_do_get_microinv_page($type);
	break;
	
	case 'ls_create_microdata':
		$ls_content = $ls_obj -> ls_do_create_microdata();
	break;
	
	case 'ls_save_microdata':
		$ls_content = $ls_obj -> ls_do_save_microdata();
	break;
	
}

if($ls_content)
{
	echo $ls_content;
}
?>