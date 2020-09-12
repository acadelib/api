<?php

namespace Tests\Unit;

use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = Student::factory()->withAccount()->create();
    }

    public function testStudentMustBeLinkedToASchool()
    {
        $this->assertInstanceOf(School::class, $this->student->school);
    }

    public function testStudentCanBeAttachedToAUserAccount()
    {
        $this->assertInstanceOf(User::class, $this->student->user);
    }

    public function testStudentMustHaveAUniqueIdentifier()
    {
        $this->assertEquals(decrypt($this->student->identifier), get_class($this->student).':'.$this->student->id);
    }

    public function testStudentMustBeSoftDeleted()
    {
        $this->student->delete();

        $this->assertSoftDeleted($this->student);
    }
}
