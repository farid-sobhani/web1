<?php

namespace Farid\Category\Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Farid\User\Database\Factories\UserFactory;
use Farid\User\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use WithFaker,RefreshDatabase;
    public function test_authenticated_user_can_see_category_panel()
    {

       //$this->actingAs(factory(User::class)->create());
    }
}
