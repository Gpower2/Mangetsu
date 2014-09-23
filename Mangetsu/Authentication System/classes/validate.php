<?php
	class Validate {
		private $_passed = false, $_errors = array(), $_db = null;
		
		public function __construct() {
			$this -> _db = Database::getInstance();
		}
		
		public function check($source, $items = array()) {
			foreach($items as $item => $rules) {
				foreach($rules as $rule => $rule_value) {
					$value = trim($source[$item]);
					$item = escape($item);
					if($rule === 'required' && empty($value)) {
						$this -> addError("{$rules["name"]} is required");
					}else if(!empty($value)) {
						switch($rule) {
							case 'min';
								if(strlen($value) < $rule_value) {
									$this -> addError("{$rules["name"]} must be a minimum of {$rule_value} characters");
								}
							break;
							case 'max';
								if(strlen($value) > $rule_value) {
									$this -> addError("{$rules["name"]} must be a maximum of {$rule_value} characters");
								}
							break;
							case 'matches';
								if($value != $source[$rule_value]) {
									if($rules["name"] == 'Password Repeat') {
										$this -> addError("Passwords don't match");
									}
									if($rules["name"] == 'Email Repeat') {
										$this -> addError("Emails don't match");
									}
								}
							break;
							case 'unique';
								$check = $this -> _db -> get($rule_value, array($item, '=', $value));
								if($check -> count()) {
									$this -> addError("{$rules["name"]} already exists");
								}
							break;
						}
					}
				}
			}
			if(empty($this -> _errors)) {
				$this -> _passed = true;
			}
			return $this;
		}
		
		private function addError($error) {
			$this -> _errors[] = $error;
		}
		
		public function errors() {
			return $this -> _errors;
		}
		
		public function passed() {
			return $this -> _passed;
		}
	}
?>