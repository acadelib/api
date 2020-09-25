<?php

namespace Tests\Unit;

use App\Exceptions\RoleNotFoundException;
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
}
