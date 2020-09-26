<?php

namespace Tests\Unit;

use App\Models\Permission;
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
        $this->permission = Permission::factory()->create();
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

    public function testProfileCanBeGivenManyPermissions()
    {
        $this->assertInstanceOf(Collection::class, $this->profile->permissions);
    }

    public function testProfileCanBeGivenAPermission()
    {
        $this->profile->givePermissionTo($this->permission);
        $this->assertTrue($this->profile->hasPermissionTo($this->permission));
    }

    public function testProfileCanBeGivenAPermissionUsingStrings()
    {
        $this->profile->givePermissionTo($this->permission->name);
        $this->assertTrue($this->profile->hasPermissionTo($this->permission->name));
    }

    public function testProfileCanBeGivenAPermissionViaRole()
    {
        $this->role->givePermissionTo($this->permission);
        $this->profile->assignRole($this->role);

        $this->assertTrue($this->profile->hasPermissionTo($this->permission));
    }

    public function testProfileCanBeGivenAPermissionViaRoleUsingStrings()
    {
        $this->role->givePermissionTo($this->permission->name);
        $this->profile->assignRole($this->role->name);

        $this->assertTrue($this->profile->hasPermissionTo($this->permission->name));
    }

    public function testProfileCanRevokeAPermission()
    {
        $this->testProfileCanBeGivenAPermission();

        $this->profile->revokePermissionTo($this->permission);
        $this->assertFalse($this->profile->fresh()->hasPermissionTo($this->permission));
    }

    public function testProfileCanRevokeAPermissionUsingStrings()
    {
        $this->testProfileCanBeGivenAPermissionUsingStrings();

        $this->profile->revokePermissionTo($this->permission->name);
        $this->assertFalse($this->profile->fresh()->hasPermissionTo($this->permission->name));
    }
}
