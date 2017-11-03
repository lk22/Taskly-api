<?php

namespace Tests\Feature\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Schema;


class UsersTableTest extends TestCase
{
	use RefreshDatabase;

	/**
	* @description: database_has_users_table
	* @test
	*/
	public function database_has_users_table() {
		$databaseHasUsersTable = Schema::hasTable('users');
		$this->assertTrue($databaseHasUsersTable);
	}

	/**
	* @description: users_table_has_incremental_id
	* @test
	*/
	public function users_table_has_incremental_id() {
		$usersTableHasId = Schema::hasColumn('users', 'id');
		$this->assertTrue($usersTableHasId);
	}

	/**
	* @description: users_table_has_name_column
	* @test
	*/
	public function users_table_has_firstname_column() {
		$usersTableHasFirstnameColumn = Schema::hasColumn('users', 'firstname');
		$this->assertTrue($usersTableHasFirstnameColumn);
	}

	/**
	 * @description: users_table_has_lastname_column
	 * @test
	 */
	public function users_table_has_lastname_column() {
		$usersTableHasLastnameColumn = Schema::hasColumn('users', 'lastname');
		$this->assertTrue($usersTableHasLastnameColumn);
	}

	/**
	 * @description: users_table_has_name_column
	 * @test
	 */
	public function users_table_has_name_column() {
		$usersTableHasNameColumn = Schema::hasColumn('users', 'name');
		$this->assertTrue($usersTableHasNameColumn);
	}

	/**
	 * @description: users_table_has_slug_column
	 * @test
	 */
	public function users_table_has_slug_column() {
		$usersTableHasSlugColumn = Schema::hasColumn('users', 'slug');
		$this->assertTrue($usersTableHasSlugColumn);
	}

	/**
	* @description: users_table_has_email_column
	* @test
	*/
	public function users_table_has_email_column() {
		$usersTableHasEmailColumn = Schema::hasColumn('users', 'email');
		$this->assertTrue($usersTableHasEmailColumn);
	}

	/**
	* @description: users_table_has_password_column
	* @test
	*/
	public function users_table_has_password_column() {
		$usersHasPasswordColumn = Schema::hasColumn('users', 'password');
		$this->assertTrue($usersHasPasswordColumn);
	}

	/**
	* @description: users_table_has_is_admin_column
	* @test
	*/
	public function users_table_has_is_admin_column() {
		$usersTableHasIsAdminColumn = Schema::hasColumn('users', 'is_admin');
		$this->assertTrue($usersTableHasIsAdminColumn);
	}

	/**
	* @description: users_table_has_remember_token
	* @test
	*/
	public function users_table_has_remember_token() {
		$usersTableHasRemebmerTokenColumn = Schema::hasColumn('users', 'remember_token');
		$this->assertTrue($usersTableHasRemebmerTokenColumn);
	}

	/**
	* @description: users_table_has_timestamps
	* @test
	*/
	public function users_table_has_timestamps() {
		$usersTableHasTimestamps = Schema::hasColumns('users', [
			'created_at',
			'updated_at',
			'deleted_at'
		]);

		$this->assertTrue($usersTableHasTimestamps);
	}
}
