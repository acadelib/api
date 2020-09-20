<?php

namespace Tests\Unit;

use App\Models\Profile;
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

        $this->user = User::factory()->for(Profile::factory()->state([
            'profileable_id' => Teacher::factory(),
            'profileable_type' => Teacher::class,
        ]))->create();
    }

    public function testUserCanHaveManyProfiles()
    {
        $this->assertInstanceOf(Collection::class, $this->user->profiles);
    }

    public function testUserCanRetrieveTheCurrentProfile()
    {
        $this->assertInstanceOf(Profile::class, $this->user->profile);
    }

    public function testUserMustBeSoftDeleted()
    {
        $this->user->delete();

        $this->assertSoftDeleted($this->user);
    }
}
