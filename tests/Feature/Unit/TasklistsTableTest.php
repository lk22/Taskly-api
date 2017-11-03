<?php

namespace Tests\Feature\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Schema;

class TasklistsTableTest extends TestCase
{
   	use RefreshDatabase;

   	/**
   	 * @description: database_has_tasklists_table
   	 * @test
   	 */
   	public function database_has_tasklists_table() {
   		$databaseHasTasklistsTable = Schema::hasTable('task_lists');
   		$this->assertTrue($databaseHasTasklistsTable);
   	}

   	/**
   	 * @description: tasklists_table_has_incremental_id
   	 * @test
   	 */
   	public function tasklists_table_has_incremental_id() {
   		$tasklistsHasIncrementalId = Schema::hasColumn('task_lists', 'id');
   		$this->assertTrue($tasklistsHasIncrementalId);
   	}

      /**
       * @description: tasklists_table_has_name_column
       * @test
       */
      public function tasklists_table_has_name_column() {
         $tasklistsTableHasNameColumn = Schema::hasColumn('task_lists', 'name');
         $this->assertTrue($tasklistsTableHasNameColumn);
      }

      /**
       * @description: tasklists_table_has_slug_column
       * @test
       */
      public function tasklists_table_has_slug_column() {
         $tasklistsTableHasSlugColumn = Schema::hasColumn('task_lists', 'slug');
         $this->assertTrue($tasklistsTableHasSlugColumn);
      }

      /**
       * @description: tasklists_table_has_user_id
       * @test
       */
      public function tasklists_table_has_user_id() {
         $tasklistsTableHasUserId = Schema::hasColumn('task_lists', 'user_id');
         $this->assertTrue($tasklistsTableHasUserId);
      }

      /**
       * @description: tasklists_table_has_timestamps
       * @test
       */
      public function tasklists_table_has_timestamps() {
         $tasklistsTableHastimestamps = Schema::hasColumns('task_lists', [
            'created_at', 
            'updated_at',
            'deleted_at'
         ]);

         $this->assertTrue($tasklistsTableHastimestamps);
      }
}
