<?php

namespace Tests\Unit;

use App\Models\Profile;
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

        $this->teacher = Teacher::factory()->hasProfile()->create();
    }

    public function testTeacherMustBeLinkedToASchool()
    {
        $this->assertInstanceOf(School::class, $this->teacher->school);
    }

    public function testTeacherCanBeAttachedToAUserAccount()
    {
        $this->assertInstanceOf(Profile::class, $this->teacher->profile);
    }

    public function testTeacherMustBeSoftDeleted()
    {
        $this->teacher->delete();

        $this->assertSoftDeleted($this->teacher);
    }
}
