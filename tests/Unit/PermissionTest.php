<?php

namespace Tests\Unit;

use App\Exceptions\PermissionNotFoundException;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->permission = Permission::factory()->create();
    }

    public function testPermissionCanBeFoundByItsName()
    {
        $this->assertInstanceOf(Permission::class, Permission::findByName($this->permission->name));
    }

    public function testExceptionIsThrownWhenAPermissionCannotBeFoundByItsName()
    {
        $this->expectException(PermissionNotFoundException::class);
        $this->assertNull(Permission::findByName('missing-permission'));
    }

    public function testPermissionCanBeGivenToManyRoles()
    {
        $this->assertInstanceOf(Collection::class, $this->permission->roles);
    }

    public function testPermissionCanBeGivenToManyProfiles()
    {
        $this->assertInstanceOf(Collection::class, $this->permission->profiles);
    }
}
