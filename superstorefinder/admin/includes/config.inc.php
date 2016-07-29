<?php session_start();

// define the root path to the admin folder
define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/superstorefinder/admin/');
// define the root URL to the admin section
define('ROOT_URL', 'http://YOURWEBSITE.COM/superstorefinder/admin/');
// Authentication SALT
define('SALT', 'Ku23ao+(f%bxh|k?4ee4<+?%B$-<2_#%IpwU4]+o2l+xmXGHL0_h}+1m$QnL.pIu');
// define default language. Note: session will have to be deleted before it will reflect the site upon refresh
$default_language = "en_US";

if(isset($_REQUEST['langset'])){
   $_SESSION['language']=$_REQUEST['langset'];
}

// default language file
if(isset($_SESSION['language'])){
	include_once '../language/'.$_SESSION['language'].'.php';
} else {
	include_once '../language/'.$default_language.'.php';
	$_SESSION['language'] = $default_language;
}

// include common file
include_once ROOT.'includes/library.php';
// include database class
include_once ROOT.'includes/class.database.php';
// include image class
include_once ROOT.'includes/class.img.php';



// define database settings
define('HOSTNAME','localhost');
define('DB_USERNAME','your_database_username');
define('DB_PASSWORD','your_database_password');
define('DB_NAME','store_finder');
// admin email address
define('ADMINISTRATOR_EMAIL','your@email.com');

