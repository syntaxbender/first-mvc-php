<?php
require CDIR.'/inputValidation.php';
class register extends Controller{
	public function index($parameters){
		$this->render('register',['title'=>'Kayıt Ol']);
	}
	public function post(){
		$errmess=[];
		$check = inputValidation::validate($_POST,['username'=>'/^([0-9a-zA-Z.]{6,15})$/', 'password'=>'/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9.-_]{8,30}$/']);
		if($check['username']===false) $errmess[]='Kullanıcı adınız, büyük harf, küçük harf, rakam ve nokta içerebilir. Minimum 6 en çok 15 karakter uzunluğunda olmalıdır.';
	
		if($check['password']===false) $errmess[]='Şifreniz en az bir küçük harf, büyük harf ve rakam içermelidir. \'.-_\' karakterlerini içerebilir. Minimum 8 en çok 30 karakter uzunluğunda olmalıdır.';
		
		if($_POST['password']!=$_POST['repassword']) $errmess[]='Girdiğiniz şifreler birbiri ile uyuşmuyor!';
		
		if(count($errmess)>0) $this->jsonRender([false,$errmess]);
		$users = $this->model('users');
		$user=$users->getbyUsername('username',mb_strtolower($_POST['username']));
		if(empty($user['username']) === false) $this->jsonRender([false,'Bu kullanici adi daha önceden birisi tarafından alınmış.']);
		$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
		if ($users->createUser(mb_strtolower($_POST['username']),$password)){
			$this->jsonRender([true,'Başarıyla kayıt oldunuz.']);
		}else{
			$this->jsonRender([false,'Kayıt olurken bir hata oldu. Lütfen tekrar deneyiniz.']);
		}
	}
}
?>