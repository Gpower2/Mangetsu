<?php
	class Token {
		public $_tokenName;
		public static function generate() {
			$tok = new Token;
			$tok -> _tokenName = 'token';
			return Session::put($tok -> _tokenName, md5(uniqid()));
		}
		
		public static function check($token) {
			$tok = new Token;
			$tok -> _tokenName = 'token';
			$tokenName = $tok -> _tokenName;
			if(Session::exists($tokenName) && $token === Session::get($tokenName)) {
				Session::delete($tokenName);
				return true;
			}
			return false;
		}
	}
?>