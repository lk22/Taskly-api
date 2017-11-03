<?php

namespace Tests\Feature\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class PlacementsTableTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @description: database_has_placements_table
     * @test
     */
    public function database_has_placements_table() {
    	$databaseHasPlacementsTable = Schema::hasTable('placements');
    	$this->assertTrue($databaseHasPlacementsTable);
    }

    /**
     * @description: placements_table_has_incremental_id
     * @test
     */
    public function placements_table_has_incremental_id() {
    	$placementsTableHasIncrementalId = Schema::hasColumn('placements', 'id');
    	$this->assertTrue($placementsTableHasIncrementalId);
    }

    /**
     * @description: placements_table_has_task_id
     * @test
     */
    public function placements_table_has_task_id() {
    	$placementsTableHasTaskId = Schema::hasColumn('placements', 'task_id');
    	$this->assertTrue($placementsTableHasTaskId);
    }

    /**
     * @description: placements_table_has_name
     * @test
     */
    public function placements_table_has_name() {
    	$placementsTableHasName = Schema::hasColumn('placements', 'name');
    	$this->assertTrue($placementsTableHasName);
    }

    /**
     * @description: placements_table_has_slug
     * @todo 
     * @test
     */
    public function placements_table_has_slug() {
        $this->withoutExceptionHandling();
        $placementsTableHasSlug = Schema::hasColumn('placements', 'slug');
        $this->assertTrue($placementsTableHasSlug);
    }

    /**
     * @description: placements_table_has_streetname
     * @test
     */
    public function placements_table_has_streetname() {
    	$placementsTableHasStreetName = Schema::hasColumn('placements', 'streetname');
    	$this->assertTrue($placementsTableHasStreetName);
    }

    /**
     * @description: placements_table_has_city_code
     * @test
     */
    public function placements_table_has_city_code() {
    	$placementsTableHasCityCode = Schema::hasColumn('placements', 'city_code');
    	$this->assertTrue($placementsTableHasCityCode);
    }

    /**
     * @description: placements_table_has_city
     * @test
     */
    public function placements_table_has_city() {
    	$placementsTableHasCity = Schema::hasColumn('placements', 'city');
    	$this->assertTrue($placementsTableHasCity);
    }

    /**
     * @description: placements_table_has_timestamps
     * @test
     */
    public function placements_table_has_timestamps() {
    	$placementsTableHasTimestamps = Schema::hasColumns('placements', [
    		'created_at',
    		'updated_at',
    		'deleted_at'
    	]);
    	$this->assertTrue($placementsTableHasTimestamps);
    }
}
