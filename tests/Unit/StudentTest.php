<?php

namespace Tests\Unit;

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

        $this->student = factory(Student::class)->create();
    }

    public function testStudentMustBeLinkedToASchool()
    {
        $this->assertInstanceOf(School::class, $this->student->school);
    }

    public function testStudentMustBeSoftDeleted()
    {
        $this->student->delete();

        $this->assertSoftDeleted($this->student);
    }
}
