<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Taskly\User;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @description: user_model_has_fillable_property
     * @test
     */
    public function user_model_has_fillable_property() {
    	$user = new User;
    	$this->assertObjectHasAttribute('fillable', $user);
    }

    /**
     * @description: user_model_fillable_property_has_name_key
     * @test
     */
    public function user_model_fillable_property_has_name_key() {
    	$user = new User;
    	$this->assertAttributeContains('name', 'fillable', $user);
    }

    /**
     * @description: user_model_fillable_property_has_email_key
     * @test
     */
    public function user_model_fillable_property_has_email_key() {
    	$user = new User;
    	$this->assertAttributeContains('email', 'fillable', $user);
    }

    /**
     * @description: user_model_fillable_property_has_password_key
     * @test
     */
    public function user_model_fillable_property_has_password_key() {
    	$user = new User;
    	$this->assertAttributeContains('password', 'fillable', $user);
    }

    /**
     * @description: user_model_has_hidden_property
     * @test
     */
    public function user_model_has_hidden_property() {
    	$user = new User;
    	$this->assertObjectHasAttribute('hidden', $user);
    }

    /**
     * @description: user_model_hidden_property_has_password_key
     * @test
     */
    public function user_model_hidden_property_has_password_key() {
    	$user = new User;
    	$this->assertAttributeContains('password', 'hidden', $user);
    }

    /**
     * @description: user_model_hidden_property_has_remember_token_key
     * @test
     */
    public function user_model_hidden_property_has_remember_token_key() {
    	$user = new User;
    	$this->assertAttributeContains('remember_token', 'hidden', $user);
    }

    /**
     * @description: user_model_casts_property_exists
     * @todo test the casts property is set
     * @test
     */
    public function user_model_casts_property_exists() {
        $this->withoutExceptionHandling();
        $user = new User;

        $this->assertObjectHasAttribute('casts', $user);
    }

    /**
     * @description: user_model_has_many_tasklists_relationship
     * @test
     */
    public function user_model_has_many_tasks_relationship() {
    	$user = new User;
    	$userHasManyTasksRelationship = $user->tasks();
    	$this->assertInstanceOf(HasMany::class, $userHasManyTasksRelationship);
    }
}
