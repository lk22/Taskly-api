<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Taskly\Placement;

class PlacementModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @description: placement_model_fillable_has_name_key
     * @test
     */
    public function placement_model_fillable_has_name_key() {
    	$placement = new Placement;	
    	$this->assertAttributeContains('name', 'fillable', $placement);
    }

    /**
     * @description: placement_model_fillable_has_task_id
     * @test
     */
    public function placement_model_fillable_has_task_id() {
    	$placement = new Placement;
    	$this->assertAttributeContains('task_id', 'fillable', $placement);
    }

    /**
     * @description: placement_model_fillable_has_streetname
     * @test
     */
    public function placement_model_fillable_property_has_streetname() {
    	$placement = new Placement;
    	$this->assertAttributeContains('streetname', 'fillable', $placement);
    }

    /**
     * @description: placement_model_fillable_has_city_code
     * @test
     */
    public function placement_model_fillable_property_has_city_code() {
    	$placement = new Placement;
    	$this->assertAttributeContains('city_code', 'fillable', $placement);
    }

    /**
     * @description: placement_model_fillable_property_has_city
     * @test
     */
    public function placement_model_fillable_property_has_city() {
    	$placement = new Placement;
    	$this->assertAttributeContains('city', 'fillable', $placement);
    }

    /**
     * @description: placement_model_has_hidden_property
     * @test
     */
    public function placement_model_has_hidden_property() {
    	$placement = new Placement;
    	$this->assertAttributeContains('task_id', 'hidden', $placement);
    }

    /**
     * @description: placement_model_belongs_to_a_task
     * @test
     */
    public function placement_model_belongs_to_a_task() {
    	$placement = new Placement;
    	$placementBelongsToATask = $placement->task();
    	$this->assertInstanceOf(BelongsTo::class, $placementBelongsToATask);
    }
}
