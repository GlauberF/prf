<?php session_start();

// define the root path to the frontend folder
define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/superstorefinder/');
// define the root URL to the frontend section
define('ROOT_URL', 'http://YOURWEBSITE.COM/superstorefinder/');
// define default language. Note: session will have to be deleted before it will reflect the site upon refresh
define('DEFAULT_LANGUAGE', 'en_US');

if(isset($_REQUEST['langset'])){
   $_SESSION['language']=$_REQUEST['langset'];
}


// default language file
if(isset($_SESSION['language'])){
	include_once ROOT.'language/'.htmlspecialchars($_SESSION['language']).'.php';
} else {
	include_once ROOT.'language/'.DEFAULT_LANGUAGE.'.php';
	$_SESSION['language'] = DEFAULT_LANGUAGE;
}

// include library file
include_once ROOT.'includes/library.php';
// include database class
include_once ROOT.'includes/class.database.php';
// include image class
include_once ROOT.'includes/class.img.php';


// define database settings
define('HOSTNAME','localhost');
define('DB_USERNAME','your_database_username');
define('DB_PASSWORD','your_database_password');
define('DB_NAME','your_database_name');
// admin email address
define('ADMINISTRATOR_EMAIL','your@email.com');

// new db instance
$db = new DB(array(
	'hostname'=>HOSTNAME,
	'username'=>DB_USERNAME,
	'password'=>DB_PASSWORD,
	'db_name'=>DB_NAME
));

// stop on db fail
if($db===FALSE) {
	$db_errors = $db->errors;
}

?>


