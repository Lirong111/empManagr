<!-- model层 -->

<?php
//这个类的一个对象实例表示一条雇员记录
class emp{
	private $id;
	private $name;
	private $grade;
	private $email;
	private $salary;

	public function getEmail(){
		return $this->email;
	}

	public function getGrade(){
		return $this->grade;
	}

	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function getSalary(){
		return $this->salary;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setGrade($grade){
		$this->grade=$grade;
	}
	public function setEmail($email){
		$this->email=$email;
	}
	public function setSalary($salary){
		$this->salary=$salary;
	}
}