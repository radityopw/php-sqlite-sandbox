<?php 
class User{
	
	public String $username;
	public String $password;
	public String $role;
	public int $is_deleted = 0;
	public int $is_loaded = 0;
	
	function save(){
		$config = new Config();
		
		if(isset($this->username)){
		
			$file = $config->filePath()."/user/".$this->username;
			
			$data['username'] = $this->username;
			$data['password'] = $this->password;
			$data['role'] = $this->role;
			$data['is_deleted'] = $this->is_deleted;
			$data['is_loaded'] = $this->is_loaded;
			
			file_put_contents($file,json_encode($data));
			
		}
		
	}
	
	function load(String $username){
		$config = new Config();
		$file = $config->filePath()."/user/".$username;
		$json = @json_decode(@file_get_contents($file),TRUE);
		
		if($json['username']){
			$this->username = $json['username'];
			$this->password = $json['password'];
			$this->role = $json['role'];
			$this->is_loaded = 1;
		}
		
	}
	
	function del(){
		$this->is_deleted = 1;
		$this->save();
	}
}

class DaftarUser{
	
	function listUser(){
		
	}
	
	function listNilai(){
		
	}
	
	function checkAuth(String $session){
		$config = new Config();

		$key = $config->keyAuth();

		$plaintext = decrypt($session,$key);
		$a_plaintext = explode(":::",$plaintext);

		$session = array('username' => $a_plaintext[0], 'passkey' => $a_plaintext[1], 'time' => $a_plaintext[2] );
		
		$now = time();
		
		if($now > $session['time']) {
			return false;
		}
		
		$u = new User();
		$u->load($session['username']);
		
		if($u->password != $session['passkey']){
			return false;
		}
		
		return $this->generateSession($session['username'],$session['passkey']);
	}
	
	function login(String $username,String $password){
		$u = new User();
		$u->load($username);
		if($u->is_loaded == 1){
			if($u->password == $password){
				return $this->generateSession($username,$password);
			}
		}
		
		return false;
	}
	
	function encrypt($str,$key){
		$result='';
		for($i=0; $i<strlen($str); $i++) {
			$char = substr($str, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return urlencode($result);
	}
	
	function decrypt($str,$key){
		$str = urldecode($str);
		$result = '';
		for($i=0; $i<strlen($str); $i++) {
			$char = substr($str, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}
	
	function generateSession($email,$passkey,$sec = 300){
		$config = new Config();

		$key = $config->keyAuth();

		$time = time() + $sec;

		$plaintext = $email.':::'.$passkey.':::'.$time;
		
		return $this->encrypt($plaintext,$key);
	}	
}