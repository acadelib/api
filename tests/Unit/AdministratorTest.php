<?php

namespace Tests\Unit;

use App\Models\Administrator;
use App\Models\Profile;
use App\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdministratorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->administrator = Administrator::factory()->hasProfile()->create();
    }

    public function testAdministratorMustBeLinkedToASchool()
    {
        $this->assertInstanceOf(School::class, $this->administrator->school);
    }

    public function testAdministratorCanBeAttachedToAUserAccount()
    {
        $this->assertInstanceOf(Profile::class, $this->administrator->profile);
    }

    public function testAdministratorMustBeSoftDeleted()
    {
        $this->administrator->delete();

        $this->assertSoftDeleted($this->administrator);
    }
}
