<?php
class Controller{
	public function render($file,$data=[]){
		return view::render($file, $data);
	}
	public function jsonRender($array){
		return view::jsonRender($array);
	}
	public function redirect($array){
		return view::redirect($array);
	}
	public function model($model){
		if (file_exists($file = MDIR."/".$model."model.php")) {
			require_once $file;
			$model = $model."Model";
			if (class_exists($model)){
				return new $model;
			} else {
				exit("Model dosyasında sınıf tanımlı değil: $model");
			}
		} else {
			exit("Model dosyası bulunamadı: {$model}.php");
		}
	}
}
?>