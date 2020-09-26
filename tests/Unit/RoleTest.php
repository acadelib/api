<?php

namespace Tests\Unit;

use App\Exceptions\RoleNotFoundException;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->role = Role::factory()->create();
        $this->permission = Permission::factory()->create();
    }

    public function testRoleCanBeFoundByItsName()
    {
        $this->assertInstanceOf(Role::class, Role::findByName($this->role->name));
    }

    public function testExceptionIsThrownWhenARoleCannotBeFoundByItsName()
    {
        $this->expectException(RoleNotFoundException::class);
        $this->assertNull(Role::findByName('missing-role'));
    }

    public function testRoleCanBeGivenToManyProfiles()
    {
        $this->assertInstanceOf(Collection::class, $this->role->profiles);
    }

    public function testRoleCanBeGivenManyPermissions()
    {
        $this->assertInstanceOf(Collection::class, $this->role->permissions);
    }

    public function testRoleCanBeGivenAPermission()
    {
        $this->role->givePermissionTo($this->permission);
        $this->assertTrue($this->role->hasPermissionTo($this->permission));
    }

    public function testRoleCanBeGivenAPermissionUsingStrings()
    {
        $this->role->givePermissionTo($this->permission->name);
        $this->assertTrue($this->role->hasPermissionTo($this->permission->name));
    }

    public function testRoleCanRevokeAPermission()
    {
        $this->testRoleCanBeGivenAPermission();

        $this->role->revokePermissionTo($this->permission);
        $this->assertFalse($this->role->fresh()->hasPermissionTo($this->permission));
    }

    public function testRoleCanRevokeAPermissionUsingStrings()
    {
        $this->testRoleCanBeGivenAPermissionUsingStrings();

        $this->role->revokePermissionTo($this->permission->name);
        $this->assertFalse($this->role->fresh()->hasPermissionTo($this->permission->name));
    }
}
