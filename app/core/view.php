<?php
class view{
	public static function jsonRender($array){
		ob_start();
		header('Content-Type: application/json');
		echo json_encode($array);
		echo ob_get_clean();
		exit();
	}
	public static function render($file,$data=[]){
		extract($data);
		ob_start();
		require VDIR.'/'.strtolower($file).'.php';
		echo ob_get_clean();
		exit();
	}
	public static function redirect($url){
		header('Location: '.$url);
		exit();
	}
}
?>