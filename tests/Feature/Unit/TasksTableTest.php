<?php

namespace Tests\Feature\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Schema;

class TasksTableTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @description: database_has_tasks_table
     * @test
     */
    public function database_has_tasks_table() {
    	$databaseHasTasksTable = Schema::hasTable('tasks');
    	$this->assertTrue($databaseHasTasksTable);
    }

    /**
     * @description: tasks_table_has_incremental_id
     * @test
     */
    public function tasks_table_has_incremental_id() {
    	$tasksTableHasIncrementalId = Schema::hasColumn('tasks', 'id');
    	$this->assertTrue($tasksTableHasIncrementalId);
    }

    /**
     * @description: tasks_table_has_list_id
     * @test
     */
    public function tasks_table_has_list_id() {
    	$tasksTableHasListId = Schema::hasColumn('tasks', 'task_list_id');
    	$this->assertTrue($tasksTableHasListId);
    }

    /**
     * @description: tasks_table_has_user_id
     * @test
     */
    public function tasks_table_has_user_id() {
    	$tasksTableHasUserId = Schema::hasColumn('tasks', 'user_id');
    	$this->assertTrue($tasksTableHasUserId);
    }

    /**
     * @description: tasks_table_has_name
     * @test
     */
    public function tasks_table_has_name() {
    	$tasksTableHasNamecolumn = Schema::hasColumn('tasks', 'name');
    	$this->assertTrue($tasksTableHasNamecolumn);
    }

    /**
     * @description: tasks_tasble_has_slug
     * @todo test the tasks table has the slug column in schema
     * @test
     */
    public function tasks_tasble_has_slug() {
        $this->withoutExceptionHandling();
        $tasksTableHasSlugColumn = Schema::hasColumn('tasks', 'slug');
        $this->assertTrue($tasksTableHasSlugColumn);
    }

    /**
     * @description: tasks_table_has_is_checked_column
     * @todo test the schema for the tasks table has the is_checked column
     * @test
     */
    public function tasks_table_has_is_checked_column() {
        $this->withoutExceptionHandling();
        $tasksTableHasIsCheckedColumn = Schema::hasColumn('tasks', 'is_checked');
        $this->assertTrue($tasksTableHasIsCheckedColumn);
    }

    /**
     * @description: tasks_table_has_timestamps
     * @test
     */
    public function tasks_table_has_timestamps() {
    	$tasksTableHasTimestamps = Schema::hasColumns('tasks', [
    		'created_at',
    		'updated_at',
    		'deleted_at'
    	]);
    	$this->assertTrue($tasksTableHasTimestamps);
    }
}
