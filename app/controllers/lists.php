<?php
require CDIR.'/inputValidation.php';
class lists extends Controller{
	public function index($parameters){
		$lists = $this->model('lists');
		$this->render('listindex',['title'=>'Notes', 'username'=>$_SESSION['username']]);
	}
	public function readAction(){
		if(intval($_POST['id']) > 0 && is_int(intval($_POST['id']))){
			$lists = $this->model('lists');
			$mylist=$lists->getById($_POST['id']);
			if ($mylist['userid'] == $_SESSION['userid']){
				if (count($mylist)>0){
					$this->jsonRender([true,$mylist]);
				}else{
					$this->jsonRender([false,'Bir hata oluştu lütfen tekrar deneyiniz.']);
				}
			}else{
				$this->jsonRender([false,'Bir hata oluştu lütfen tekrar deneyiniz.']);
			}
		}else{
			$this->jsonRender([false,'Bir hata oluştu lütfen tekrar deneyiniz.']);
		}
	}
	public function getAction(){
		$lists = $this->model('lists');
		$mylist=$lists->getAll($_SESSION['userid']);
		$this->jsonRender($mylist);
	}
	public function addAction(){
		$errmess=[];
		$lists = $this->model('lists');
		$check = inputValidation::validate($_POST,['title'=>'/^(.{1,60})$/', 'content'=>'/^(.{1,1000})$/']);
		if($check['title'] === false) $errmess[] = 'Başlık alanı boş olamaz en çok 60 karakterden oluşabilir.';
		if($check['content'] === false) $errmess[] = 'İçerik alanı boş olamaz en çok 1000 karakterden oluşabilir.';
		if(count($errmess)>0) $this->jsonRender([false,$errmess]);
		if($lists->listAdd(htmlspecialchars($_POST['title']),htmlspecialchars($_POST['content']),$_SESSION['userid'])){
			$this->jsonRender([true,'Veri girişi başarılı!']);
		}else{
			$this->jsonRender([false,'Veri girişi başarısız. Lütfen tekrar deneyiniz!']);
		}
	}
	public function deleteAction(){
		if(intval($_POST['id']) > 0 && is_int(intval($_POST['id']))) {
			$lists = $this->model('lists');
			$mylist=$lists->getById($_POST['id']);
			if ($mylist['userid'] == $_SESSION['userid']){
				if($lists->listDelete($_POST['id'])){
					$this->jsonRender([true,'Not silindi!']);
				}else{
					$this->jsonRender([false,'Not silinirken bir hata oluştu. Lütfen tekrar deneyiniz!']);
				}
			}else{
				$this->jsonRender([false,'Not silinirken bir hata oluştu. Lütfen tekrar deneyiniz!']);
			}

		}else{
			$this->jsonRender([false,'Veri silinirken bir hata oluştu. Lütfen tekrar deneyiniz!']);
		}
	}
}
?>