<?php

namespace Tests\Unit;

use App\Models\Profile;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->profile = Profile::factory()->create();
        $this->role = Role::factory()->create();
    }

    public function testProfileCanHaveMultipleRoles()
    {
        $this->assertInstanceOf(Collection::class, $this->profile->roles);
    }

    public function testProfileCanBeAssignedToARole()
    {
        $this->profile->assignRole($this->role);
        $this->assertTrue($this->profile->hasRole($this->role));
    }

    public function testProfileCanBeAssignedToARoleUsingStrings()
    {
        $this->profile->assignRole($this->role->name);
        $this->assertTrue($this->profile->hasRole($this->role->name));
    }

    public function testProfileCanBeDetachedFromARole()
    {
        $this->testProfileCanBeAssignedToARole();

        $this->profile->removeRole($this->role);
        $this->assertFalse($this->profile->fresh()->hasRole($this->role));
    }

    public function testProfileCanBeDetachedFromARoleUsingStrings()
    {
        $this->testProfileCanBeAssignedToARoleUsingStrings();

        $this->profile->removeRole($this->role->name);
        $this->assertFalse($this->profile->fresh()->hasRole($this->role->name));
    }
}
