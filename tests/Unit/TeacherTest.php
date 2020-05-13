<?php

namespace Tests\Unit;

use App\Models\School;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->teacher = factory(Teacher::class)->state('account')->create();
    }

    public function testTeacherMustBeLinkedToASchool()
    {
        $this->assertInstanceOf(School::class, $this->teacher->school);
    }

    public function testTeacherCanBeAttachedToAUserAccount()
    {
        $this->assertInstanceOf(User::class, $this->teacher->user);
    }

    public function testTeacherMustBeSoftDeleted()
    {
        $this->teacher->delete();

        $this->assertSoftDeleted($this->teacher);
    }
}
