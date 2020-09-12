<?php

namespace Tests\Unit;

use App\Models\Teacher;
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

        $this->user = User::factory()->create();
    }

    public function testUserCanHaveManyTeacherProfiles()
    {
        $this->assertInstanceOf(Collection::class, $this->user->teachers);
    }

    public function testUserCanHaveManyStudentProfiles()
    {
        $this->assertInstanceOf(Collection::class, $this->user->students);
    }

    public function testUserCanRetrieveTheCurrentProfile()
    {
        $this->user->teachers()->save(Teacher::factory()->make());
        $this->user->profile_identifier = $this->user->teachers->first()->identifier;
        $this->user->save();

        $this->assertTrue($this->user->teachers->first()->is($this->user->profile));
    }

    public function testUserMustBeSoftDeleted()
    {
        $this->user->delete();

        $this->assertSoftDeleted($this->user);
    }
}
