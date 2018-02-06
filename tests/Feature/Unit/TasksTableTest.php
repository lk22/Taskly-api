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
     * @description: tasks_table_has_work_hours_column
     * @todo 
     * @test
     */
    public function tasks_table_has_work_hours_column() {
        $this->withoutExceptionHandling();
        $tasksTableHasWorkHoursColumn = Schema::hasColumn('tasks', 'work_hours');
        $this->assertTrue($tasksTableHasWorkHoursColumn);
    }

    /**
     * @description: tasks_table_has_supplier_column
     * @todo 
     * @test
     */
    public function tasks_table_has_supplier_column() {
        $this->withoutExceptionHandling();
        $tasksTableHasSupplierColumn = Schema::hasColumn('tasks', 'supplier');
        $this->assertTrue($tasksTableHasSupplierColumn);
    }

    /**
     * @description: tasks_table_has_start_at_column
     * @todo 
     * @test
     */
    public function tasks_table_has_start_at_column() {
        $this->withoutExceptionHandling();
        $tasksTableHasStartAtColumn = Schema::hasColumn('tasks', 'start_at');
        $this->assertTrue($tasksTableHasStartAtColumn);
    }

    /**
     * @description: tasks_table_has_end_at_column
     * @todo 
     * @test
     */
    public function tasks_table_has_end_at_column() {
        $this->withoutExceptionHandling();
        $tasksTableHasEndAtColumn = Schema::hasColumn('tasks', 'end_at');
        $this->assertTrue($tasksTableHasEndAtColumn);
    }

    /**
     * @description: tasks_table_has_priority_column
     * @todo 
     * @test
     */
    public function tasks_table_has_priority_column() {
        $this->withoutExceptionHandling();
        $tasksTableHasPriorityColumn = Schema::hasColumn('tasks', 'priority');
        $this->assertTrue($tasksTableHasPriorityColumn);
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
