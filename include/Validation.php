<?php
class Validation
{

	protected $data;
	protected $errors; //Should be empty intialize
	//protected $allowedExtension;

	//Adding Error if any
	public function addError($key, $val)
	{
		$this->errors[$key] = $val;
	}
	//Validation for empty fields
	public function validateEmpty($value, $fields)
	{
		$val = trim($this->data[$value]);
		if (empty($val)) {
			$this->addError($value, $fields . ' fields cannot be empty');
		}
	}
	//validation for Name
	protected function firstname()
	{
		$val = trim($this->data['firstname']);
		if (!preg_match('/^[a-zA-Z]{3,12}$/', $val)) {
			$this->addError('firstname', 'should contain at least 3 characters');
		}
	}
	//validation for Name
	protected function lastname()
	{
		$val = trim($this->data['lastname']);
		if (!preg_match('/^[a-zA-Z]{3,12}$/', $val)) {
			$this->addError('lastname', 'should contain at least 3 characters');
		}
	}
	//Validation for userName
	protected function validateUserName()
	{
		$val = trim($this->data['userName']);
		if (!preg_match('/^[a-zA-Z0-9]{4,12}$/', $val)) {
			$this->addError('userName', 'username must contain 4-12 chars and alphanumeric');
		}
	}

	//Validation for Email
	protected function validateEmail()
	{
		$val = trim($this->data['email']);
		if (!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $val)) {
			$this->addError('email', 'email is invalid');
		}
	}

	//Validation for password
	protected function validatePassword()
	{
		$val = trim($this->data['password']);
		// $cval=trim($this->data['[cpassword]']); 		
		if (!preg_match('/^(?i)^(?=.*[a-z])(?=.*\d).{8,20}$/', $val)) {
			$this->addError('password', 'password should contain at least 1 letter, 1 digit and min 8 characters');
		}

		return $val;
	}
	//validation for confirm password
	protected function validateCpassword()
	{
		$val = $this->validatePassword();
		$cval = trim($this->data['cpassword']);
		if ($val != $cval) {
			$this->addError('cpassword', 'password and confirm passowrd or not same');
		}
	}
	
}
//validation for phone number
//validation for modal function
class ModalVal extends Validation
{
	function __construct($post_data)
	{
		$this->data = $post_data;
	}

	public function validateForm()
	{
		$this->validateEmpty('question', 'question');
		$this->validateEmpty('question', 'question');
		$this->checkStringLength();
		return $this->errors;
	}
	protected function checkStringLength()
	{
		$val = $this->data['question'];
		if (strlen($val) > 120) {
			$this->addError("exceed", "You exceed the limit of characters");
		}
	}
	//function for checking if string contain "?" mark or not
	protected function checkingQuestionMarks()
	{
		$val = $this->data['question'];
		$question = substr($val, -1) or substr($val, -2) or substr($val, -3);
		if ($question != '?') {
			return "false";
		}
	}
	//function for adding question mark at the end;
	public function addingQuestionMark()
	{
		$val = $this->data['question'];
		if ($this->checkingQuestionMarks() == "false") {
			$lastval = $val . "?";
			return $lastval;
		} else {
			return $val;
		}
	}
}
//Validation for login
class Loginval extends Validation
{
	function __construct($post_data)
	{
		$this->data = $post_data;
	}
	public function validateForm()
	{
		$this->validateEmpty('userName', 'username');
		$this->validateEmpty('password', 'password');

		return $this->errors;
	}
}
//Validation for signup
class Signup extends Validation
{
	function __construct($post_data)
	{
		$this->data = $post_data;
	}
	public function validateForm()
	{
		//Calling the function
		$this->validateUserName();
		$this->validateEmail();
		$this->validateCpassword();
		$this->validatePassword();
		$this->firstname();
		$this->lastname();
		

		//Validation for empty fields
		$this->validateEmpty('userName', 'username');
		$this->validateEmpty('firstname', 'firstname');
		$this->validateEmpty('lastname', 'lastname');
		$this->validateEmpty('email', 'email');
		$this->validateEmpty('password', 'password');
		$this->validateEmpty('cpassword', 'confirm password');


		return $this->errors;
	}
}
class AnswerEditor extends Validation
{


	function __construct($post_data)
	{
		$this->data = $post_data;
	}

	public function validateForm()
	{
		$this->validateEmpty('answerText', 'answerBox');
		$this->checkStringLength();
		return $this->errors;
	}
	// protected function alloweExtension(){

	// }
	protected function checkStringLength()
	{
		$val = $this->data['answerText'];
		if (strlen($val) > 1800) {
			$this->addError("answerText", "You exceed the limit of characters");
		}
	}
}
//Validation for signup
class editProfile extends Validation
{
	function __construct($post_data)
	{
		$this->data = $post_data;
	}
	public function validateForm()
	{
		//Calling the function
		$this->validateUserName();
		$this->validateEmail();
		$this->firstname();
		$this->lastname();

		//Validation for empty fields
		$this->validateEmpty('userName', 'username');
		$this->validateEmpty('firstname', 'firstname');
		$this->validateEmpty('lastname', 'lastname');
		$this->validateEmpty('email', 'email');
		
		return $this->errors;
	}
}