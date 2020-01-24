<?php
session_start();
define('DB_DSN', 'mysql:host=localhost;dbname=uni4society;charset=utf8');
define('DB_USR', 'root');
define('DB_PWD', '12345678');
define('APP_NAME','Uni4Society List CMS');
define('ROOT_DIR', __DIR__); // Kök dizin
define('APP_DIR', ROOT_DIR.'/app'); // Uygulama dizini
define('CORE_DIR', APP_DIR.'/core'); // Çekirdek dizini
define('MDIR', APP_DIR.'/models'); // Model dizini
define('VDIR', APP_DIR.'/views'); // View dizini
define('CDIR', APP_DIR.'/controllers'); // Controller dizini
define('TDIR', APP_DIR.'/template'); // Controller dizini
define('URL', '/mvc2'); // Sistemin çalışacağı URL
define('TEMPLATE_DIR', URL.'/template/'); // Sistemin çalışacağı URL

require CORE_DIR.'/view.php';
require CORE_DIR.'/controller.php';
require CORE_DIR.'/app.php';
require CORE_DIR.'/model.php';

App::run('/','redirect',['GET','POST'],[],['redirect' => URL.'/login']);
App::run('/template/min/js/([0-9a-zA-Z-_]+)\.js','minifier@easyPathJS',['GET'],["filename"],['isloggedin'=>'notrequire']);
App::run('/template/min/css/([0-9a-zA-Z-_]+)\.css','minifier@easyPathCSS',['GET'],["filename"],['isloggedin'=>'notrequire']);
App::run('/login','login@index',['GET'],[],['isloggedin'=>false, 'format'=>'redirect', 'redirect'=>URL.'/lists']);
App::run('/login','login@post',['POST'],[],['isloggedin'=>false, 'format'=>'json', 'jsonmessage'=>'Zaten giriş yaptınız!']);
App::run('/logout','login@logout',['GET'],[],['isloggedin'=>true, 'format'=>'redirect', 'redirect'=>URL.'/login']);
App::run('/lists','lists@index',['GET'],[],['isloggedin'=>true, 'format'=>'redirect', 'redirect'=>URL.'/login']);
App::run('/lists/get','lists@getAction',['GET'],[],['isloggedin'=>true, 'format'=>'json']);
App::run('/lists/read','lists@readAction',['POST'],[],['isloggedin'=>true, 'format'=>'json']);
App::run('/lists/create','lists@addAction',['POST'],[],['isloggedin'=>true, 'format'=>'json']);
App::run('/lists/delete','lists@deleteAction',['POST'],[],['isloggedin'=>true, 'format'=>'json']);
App::run('/register','register@index',['GET'],[],['isloggedin'=>false, 'format'=>'redirect', 'redirect'=>URL.'/lists']);
App::run('/register','register@post',['POST'],[],['isloggedin'=>false, 'format'=>'json', 'jsonmessage'=>'Zaten giriş yaptınız!']);
App::err404();
?>