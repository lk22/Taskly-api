<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Taskly\Task;

class TaskModelTest extends TestCase
{
   	use RefreshDatabase;

   	/**
   	 * @description: task_model_has_fillable_property
   	 * @test
   	 */
   	public function task_model_has_fillable_property() {
   		$task = new Task;
   		$this->assertObjectHasAttribute('fillable', $task);
   	}

   	/**
   	 * @description: task_model_fillable_property_has_name_key
   	 * @test
   	 */
   	public function task_model_fillable_property_has_name_key() {
   		$task = new Task;
   		$this->assertAttributeContains('name', 'fillable', $task);
   	}

   	/**
   	 * @description: task_model_fillable_property_has_list_id
   	 * @test
   	 */
   	public function task_model_fillable_property_has_list_id() {
   		$task = new Task;
   		$this->assertAttributeContains('task_list_id', 'fillable', $task);
   	}

   	/**
   	 * @description: task_model_fillable_property_has_user_list
   	 * @test
   	 */
   	public function task_model_fillable_property_has_user_list() {
   		$task = new Task;
   		$this->assertAttributeContains('user_id', 'fillable', $task);
   	}

      /**
       * @description: task_model_fillable_property_has_is_checked
       * @todo 
       * @test
       */
      public function task_model_fillable_property_has_is_checked() {
         $this->withoutExceptionHandling();
         $task = new Task;
         $this->assertAttributeContains('is_checked', 'fillable', $task);
      }

   	/**
   	 * @description: task_model_hidden_property_has_user_id
   	 * @test
   	 */
   	public function task_model_hidden_property_has_user_id() {
   		$task = new Task;
   		$this->assertAttributeContains('user_id', 'hidden', $task);
   	}

   	/**
   	 * @description: task_model_hidden_property_has_list_id
   	 * @test
   	 */
   	public function task_model_hidden_property_has_list_id() {
   		$task = new Task;
   		$this->assertAttributeContains('task_list_id', 'hidden', $task);
   	}

   	/**
   	 * @description: task_model_has_belongs_to_tasklist_relationship
   	 * @test
   	 */
   	public function task_model_has_belongs_to_tasklist_relationship() {
   		$task = new Task;
   		$taskBelongsToTasklistRelation = $task->tasklist();
   		$this->assertInstanceOf(BelongsTo::class, $taskBelongsToTasklistRelation);
   	}

   	/**
   	 * @description: task_model_has_belongs_to_user_relationship
   	 * @test
   	 */
   	public function task_model_has_belongs_to_user_relationship() {
   		$task = new Task;
   		$taskBelongsToUserRelation = $task->user();
   		$this->assertInstanceOf(BelongsTo::class, $taskBelongsToUserRelation);
   	}


}
