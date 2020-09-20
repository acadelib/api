<?php

namespace Tests\Unit;

use App\Models\Profile;
use App\Models\School;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = Student::factory()->hasProfile()->create();
    }

    public function testStudentMustBeLinkedToASchool()
    {
        $this->assertInstanceOf(School::class, $this->student->school);
    }

    public function testStudentCanBeAttachedToAUserAccount()
    {
        $this->assertInstanceOf(Profile::class, $this->student->profile);
    }

    public function testStudentMustBeSoftDeleted()
    {
        $this->student->delete();

        $this->assertSoftDeleted($this->student);
    }
}
