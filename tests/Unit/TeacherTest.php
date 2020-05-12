<?php

namespace Tests\Unit;

use App\Models\School;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->teacher = factory(Teacher::class)->create();
    }

    public function testTeacherMustBeLinkedToASchool()
    {
        $this->assertInstanceOf(School::class, $this->teacher->school);
    }

    public function testTeacherMustBeSoftDeleted()
    {
        $this->teacher->delete();

        $this->assertSoftDeleted($this->teacher);
    }
}
