<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testUserCanHaveManyTeacherProfiles()
    {
        $this->assertInstanceOf(Collection::class, $this->user->teachers);
    }

    public function testUserCanHaveManyStudentProfiles()
    {
        $this->assertInstanceOf(Collection::class, $this->user->students);
    }

    public function testUserMustBeSoftDeleted()
    {
        $this->user->delete();

        $this->assertSoftDeleted($this->user);
    }
}
