<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    // para que no se haga commit a la base de datos
    use DatabaseTransactions;
    public function testCanSeeUserPage(){
        $user = factory(User::class)->create();
        $response = $this->get($user->username);

        $response->assertSee($user->name);
    }

}
