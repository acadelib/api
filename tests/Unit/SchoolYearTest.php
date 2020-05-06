<?php

namespace Tests\Unit;

use App\Models\School;
use App\Models\SchoolYear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolYearTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->schoolYear = factory(SchoolYear::class)->create();
    }

    public function testSchoolYearBelongsToASchool()
    {
        $this->assertInstanceOf(School::class, $this->schoolYear->school);
    }

    public function testSchoolYearMustBeSoftDeleted()
    {
        $this->schoolYear->delete();

        $this->assertSoftDeleted($this->schoolYear);
    }
}
