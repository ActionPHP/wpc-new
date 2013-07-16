<?php
require_once '../vendor/autoload.php';
require_once '../class/Account.php';

/**
* 
*/
class AccountTest extends PHPUnit_Framework_TestCase
{	
	function setUp()
	{
		$table = $this->_table();
		$this->Account = new Account($table);

		$this->user = new stdClass();

		$this->user->username = 'username';
		$this->user->password = 'password';
		$this->user->email = 'projects@actionphp.com';
	}

	public function testCreatingNewAccountReturnsUserID()
	{	
		$user = $this->user;
		$user_id = $this->Account->create($user);
		$this->assertEquals(1, $user_id );
	}

	public function testUsernameExistsReturnsTrue()
	{
		$username = 'username';
		$exists = $this->Account->usernameExists($username);
		$this->assertTrue($exists);
	}

	public function testUpdateReturnsUpdatedUser()
	{
		$user_id = 1;
		$user = $this->user;
		$user->id = 1;
		$user->password = 'newpassword';
		$updatedUser = $this->Account->update($user);

		$this->assertEquals($user, $updatedUser);

	}

	public function testEmailExistsReturnsTrue()
	{
		$email = 'projects@actionphp.com';
		$emailExists = $this->Account->emailExists($email);
		$this->assertTrue($emailExists);
	}

	public function testGetUserWithIdReturnsSingleUser()
	{
		$user_id = 1;
		$user = $this->Account->get($user_id);

		//Let's makes sure we're not getting an Array
		$isArray = true;
		$isArray = is_array($user);
		$this->assertFalse($isArray);
	}

	public function testGetUsersWithoutProvidingIdReturnsAnArrayOfUsers()
	{
		$users = $this->Account->get();
		$isArray = false;
		$isArray = is_array($users);
		$this->assertTrue($isArray);
	}

	public function _table()
	{
		$table = \Mockery::mock('AccountTable');

		$_user = new stdClass();
		$_user->id = 1;
		$_user->username = 'username';
		$_user->password = 'password';

		$table->shouldReceive('insert')->andReturn(1);
		$table->shouldReceive('setId');
		$table->shouldReceive('update');
		$table->shouldReceive('getBy')->andReturn($_user);
		$table->shouldReceive('get')->with(null)->andReturn(array($_user));
		$table->shouldReceive('get')->with(1)->andReturn($_user);


		return $table;
	}
}
?>