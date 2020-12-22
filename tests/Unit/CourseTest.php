<?php

namespace Tests\Unit;

use App\Models\Classroom;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->course = Course::factory()->create();
    }

    public function testCourseBelongsToAClassroom()
    {
        $this->assertInstanceOf(Classroom::class, $this->course->classroom);
    }

    public function testCourseMustBeSoftDeleted()
    {
        $this->course->delete();

        $this->assertSoftDeleted($this->course);
    }
}
