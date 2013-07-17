<?php

/**
* 
*/
class Account
{	
	private $table;

	function __construct($table)
	{
		$this->setTable($table);
	}

	public function create($user)
	{
		$table = $this->getTable();

		$username = $user->username;
		$password = $this->hashPassword($user->password); // We will hash the password with md5
		$email = $user->email;

		$id = $table->insert($username, 'username');
		$table->setId($id);
		$table->update('password', $password);
		$table->update('email', $email);

		return $id;

	}

	public function update($user)
	{
		$id = $user->id;
		$username = $user->username;
		$password = $this->hashPassword($user->password);
		$email = $user->email;

		$table = $this->table;

		$table->setId($id);

		//$table->update('username', $username);
		$table->update('password', $password);
		$table->update('email', $email);

		return $user;
	}

	public function hashPassword($password)
	{
		return md5($password);
	}

	public function usernameExists($username)
	{
		$user = $this->getUserByUsername($username);
		if(!empty($user)){

			return true;
		} 

		return false;
	}

	public function emailExists($email)
	{
		$user = $this->getByEmail($email);

		if(!empty($user)){

			return true;
		}

		return false;
	}

	public function getByEmail($email)
	{
		$table = $this->getTable();
		$user = $table->getBy('email', $email);
		return $user;
	}

	public function get($id=null)
	{	
		$table = $this->getTable();
		$user = $table->get($id);
		return $user;
	}

	public function delete($id)
	{
		if(empty($id)) return;

		$table = $this->getTable();
		$table->delete($id);
	}

	public function getUserByUsername($username)
	{
		$table = $this->table;

		$user = $table->getBy('username', $username);

		return $user;

	}

	public function setTable($table)
	{
		$this->table = $table;
	}

	public function getTable()
	{
		return	$this->table;
	}
}