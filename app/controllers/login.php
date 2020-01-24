<?php
require CDIR.'/inputValidation.php';
class login extends Controller{
	public function index($parameters){
		$this->render('login',['title'=>'Giriş Yap']);
	}
	public function post(){
		$check = inputValidation::validate($_POST,['username', 'password']);

		if($check['username']===false || $check['password']===false){
			$this->jsonRender([false,'Kullanıcı adı ya da şifre yanlış!']);
		}
		$users = $this->model('users');
		$post_user = mb_strtolower($_POST['username']);
		$user=$users->getbyUsername('*',$post_user);
		if (isset($user['pwdhash']) && isset($user['username']) && empty($user['username']) === false && empty($user['pwdhash']) === false && password_verify($_POST['password'],$user['pwdhash'])) {
			$_SESSION['logged'] = 1;
			$_SESSION['username'] = $user['username'];
			$_SESSION['userid'] = $user['id'];
			$this->jsonRender([true,'Başarıyla giriş yaptınız. Yönlendiriliyorsunuz...']);
		}else{
			$this->jsonRender([false,'Kullanıcı adı ya da şifreniz yanlış.']);
		}
	}
	public function logout(){
		session_destroy();
		$this->redirect(URL."/");
	}
}
?>