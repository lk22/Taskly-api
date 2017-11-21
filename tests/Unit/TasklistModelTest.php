<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Taskly\TaskList;

class TasklistModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @description: tasklist_model_has_fillable_property
     * @test
     */
    public function tasklist_model_has_fillable_property() {
    	$tasklist = new TaskList;
    	$this->assertObjectHasAttribute('fillable', $tasklist);
    }

    /**
     * @description: tasklist_model_fillable_has_name_key
     * @test
     */
    public function tasklist_model_fillable_has_name_key() {
    	$tasklist = new Tasklist;
    	$this->assertAttributeContains('name', 'fillable', $tasklist);
    }

    /**
     * @description: tasklist_model_fillable_has_user_id_key
     * @test
     */
    public function tasklist_model_fillable_has_user_id_key() {
    	$tasklist = new Tasklist;
    	$this->assertAttributeContains('user_id', 'fillable', $tasklist);
    }

    /**
     * @description: tasklist_model_hidden_property_has_user_id_key
     * @test
     */
    public function tasklist_model_hidden_property_has_user_id_key() {
    	$tasklist = new Tasklist;
    	$this->assertAttributeContains('user_id', 'hidden', $tasklist);
    }

    /**
     * @description: tasklist_model_has_belongs_to_user_model_relationship
     * @test
     */
    public function tasklist_model_has_belongs_to_user_model_relationship() {
    	$tasklist = new TaskList;
    	$tasklistBelongsToUser = $tasklist->user();
    	$this->assertInstanceOf(BelongsTo::class, $tasklistBelongsToUser);
    }

    /**
     * @description: tasklist_model_has_many_tasks_relationship
     * @test
     */
    public function tasklist_model_has_many_tasks_relationship() {
    	$tasklist = new TaskList;
    	$tasklistHasManyTasks = $tasklist->tasks();
    	$this->assertInstanceOf(HasMany::class, $tasklistHasManyTasks);
    }
}
