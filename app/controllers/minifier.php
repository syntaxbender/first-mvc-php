<?php
require CDIR.'/inputValidation.php';
class minifier extends Controller{
	public function easyPathJS($parameters){
		if(file_exists(TDIR.'/js/'.$parameters['filename'].".js") && is_readable(TDIR.'/js/'.$parameters['filename'].".js")){
			header("Content-Type: application/javascript");
			$file=file_get_contents(TDIR."/js/".$parameters['filename'].".js");
			$file=preg_replace('/([\s]+)/', ' ', $file);
			$file='var ROOT_DIR="'.URL.'"; var TEMPLATE_DIR="'.URL.'/app/template/"; '.$file;
			print($file);
		}
	}
	public function easyPathCSS($parameters){
		header("Content-Type: text/css");
		$file=file_get_contents(TDIR."/css/".$parameters['filename'].".css");
		$file=preg_replace('/TEMPLATE_DIR/', URL.'/app/template', $file);
		$file=preg_replace('/([\s]+)/', ' ', $file);
		print($file);
	}
}
?>