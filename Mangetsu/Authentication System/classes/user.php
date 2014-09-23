<?php
	class User {
		private $_db, $_data, $_sessionName, $_cookieName, $_cookieExpiry, $_isLoggedIn;
		
		public function __construct($user = null) {
			$this -> _db = Database::getInstance();
			$this -> _sessionName = 'user';
			$this -> _cookieName = 'hash';
			if(!$user) {
				if(Session::exists($this -> _sessionName)) {
					$user = Session::get($this -> _sessionName);
					if($this -> find($user)) {
						$this -> _isLoggedIn = true;
					}else {
						// process logout
					}
				}
			}else {
				$this -> find($user);
			}
		}
		
		public function create($fields = array()) {
			if(!$this -> _db -> insert('users', $fields)) {
				throw new Exception('There was a problem creating an account.');
			}
		}
		
		public function update($fields = array(), $id = null) {
			if(!$id && $this -> isLoggedIn()) {
				$id = $this -> data() -> ID;
			}
			if(!$this -> _db -> update('users', $id, $fields)) {
				throw new Exception('There was a problem updating.');
			}
		}
		
		public function find($user = null) {
			if($user) {
				$field = (is_numeric($user)) ? 'ID' : 'Username';
				$data = $this -> _db -> get('users', array($field, '=', $user));
				if($data -> count()) {
					$this -> _data = $data -> first();
					return true;
				}
			}
			return false;
		}
		
		public function login($username = null, $password = null, $remember = false) {
			if(!$username && !$password && $this -> exists()) {
				Session::put($this -> _sessionName, $this -> data() -> ID);
			}else {
				$user = $this -> find($username);
				if($user) {
					if($this -> data() -> Password === Hash::make($password, $this -> data() -> Salt)) {
						Session::put($this -> _sessionName, $this -> data() -> ID);
						if($remember) {
							$hash = Hash::unique();
							$hashCheck = $this -> _db -> get('users_session', array('UserID', '=', $this -> data() -> ID));
							if(!$hashCheck -> count()) {
								$this -> _db -> insert('users_session', array(
									'UserID' => $this -> data() -> ID,
									'Hash' => $hash
								));
							}else {
								$hash = $hashCheck -> first() -> Hash;
							}
							$this -> _cookieExpiry = 31536000;
							Cookie::put($this -> _cookieName, $hash, $this -> _cookieExpiry);
						}
						return true;
					}
				}
			}
			return false;
		}
		
		public function exists() {
			return (!empty($this -> _data)) ? true : false;
		}
		
		public function logout() {
			$this -> _db -> delete('users_session', array('UserID', '=', $this -> data() -> ID));
			Session::delete($this -> _sessionName);
			Cookie::delete($this -> _cookieName);
		}
		
		public function data() {
			return $this -> _data;
		}
		
		public function isLoggedIn() {
			return $this -> _isLoggedIn;
		}
	}
?>