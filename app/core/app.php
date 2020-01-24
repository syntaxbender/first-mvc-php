<?php
class App{
	public static function parse_my_url(){
		$scriptname = $_SERVER['SCRIPT_NAME'];
		$dirname = dirname($scriptname);
		$basename = basename($scriptname);
		$request_uri = parse_url($_SERVER['REQUEST_URI']);
		//$request_query = $request_uri['query'];
		$request_uri = preg_replace('/^('.preg_quote($scriptname,'/').')|^('.preg_quote($dirname."/",'/').')/', '/', preg_replace('/\/+/','/',$request_uri['path']));
		return $request_uri;
	}
	public static function isLoggedIn($isloggedin){
		if($isloggedin['isloggedin'] === true && (isset($_SESSION['userid']) === false || isset($_SESSION['logged']) === false || isset($_SESSION['username']) === false || isset($_SESSION['logged']) === false || $_SESSION['logged'] != 1)){
			if ($isloggedin['format'] == 'json'){
				view::jsonRender([false, 'Bu işlemi yapabilmek için öncelikle giriş yapmalısınız.']);
			}else if($isloggedin['format'] == 'render'){
				view::render('error', ['Giriş Yapılmalı','Bu sayfayı görüntülemek için öncelikle giriş yapmalısınız.']);
			}else if($isloggedin['format'] == 'redirect'){
				view::redirect($isloggedin['redirect']);
			} 
		}else if($isloggedin['isloggedin'] === false && (isset($_SESSION['userid']) && isset($_SESSION['logged']) && isset($_SESSION['username']) && isset($_SESSION['logged']) && $_SESSION['logged'] == 1)){

			if ($isloggedin['format'] == 'json'){
				view::jsonRender([false, $isloggedin['jsonmessage']]);
			}else if($isloggedin['format'] == 'render'){
				view::render('error', [$isloggedin['rendertitle'],$isloggedin['rendermessage']]);
			}else if($isloggedin['format'] == 'redirect'){
				view::redirect($isloggedin['redirect']);
			}
		}
	}
	public static function err404(){
		 view::redirect(URL."/");
		//view::render('error', ['Böyle bir sayfa mevcut değil!','Aradığınız sayfa bulunamadı yönlendiriliyorsunuz...']);
	}
	public static function run($url,$callback,$method=['get'],$parameter_keys=[],$isloggedin=['isloggedin'=>'notrequire']){
		$request_uri = self::parse_my_url();
		if(preg_match('#^'.$url.'$#', $request_uri, $parameters) && in_array($_SERVER['REQUEST_METHOD'], $method)){
			if ($callback == 'redirect') view::redirect($isloggedin['redirect']);
			unset($parameters[0]);
			self::isloggedin($isloggedin);
			$controller = explode('@',$callback);
			$controllerFile = CDIR.'/'.strtolower($controller[0]).'.php';
			if(!file_exists($controllerFile)) die("controller yok!");
			require $controllerFile;
			if(count($parameter_keys) > 0 && count($parameters) != count($parameter_keys)) die('parametre hatası');
			$parameters = array_combine($parameter_keys,$parameters);
			call_user_func([new $controller[0], $controller[1]],$parameters);
			exit();
		}
	}
}