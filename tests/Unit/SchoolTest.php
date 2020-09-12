<?php

namespace Tests\Unit;

use App\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->school = School::factory()->create();
    }

    public function testSchoolMustBeSoftDeleted()
    {
        $this->school->delete();

        $this->assertSoftDeleted($this->school);
    }
}
