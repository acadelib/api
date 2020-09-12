<?php

namespace Tests\Unit;

use App\Models\Classroom;
use App\Models\School;
use App\Models\SchoolYear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClassroomTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->classroom = Classroom::factory()->create();
    }

    public function testClassroomBelongsToASchoolYear()
    {
        $this->assertInstanceOf(SchoolYear::class, $this->classroom->schoolYear);
    }

    public function testClassroomBelongsToASchool()
    {
        $this->assertInstanceOf(School::class, $this->classroom->school);
    }

    public function testClassroomMustBeSoftDeleted()
    {
        $this->classroom->delete();

        $this->assertSoftDeleted($this->classroom);
    }
}
