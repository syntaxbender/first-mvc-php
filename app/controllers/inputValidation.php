<?php

class inputValidation
{
	public static function validate($inputs,$regex=[]){
		$checkArr=[];
		//print_r($inputs);
		if(array_keys($regex) === range(0, count($regex) - 1)){
			//echo "ops";
			foreach ($regex as $value) {
				if(isset($inputs[$value]) === false || empty($inputs[$value])){
					$checkArr[$value] = false;
				}else $checkArr[$value] = true;
			}
		}else{
			//echo "bops";
			foreach ($regex as $key => $value) {
				if(isset($inputs[$key]) === false || empty($inputs[$key]) || !preg_match($value, $inputs[$key])){
					//echo "ola";
					$checkArr[$key] = false;
				}else $checkArr[$key] = true;
			}
		}
		//print_r($checkArr);
		return $checkArr;
	}
}
?>