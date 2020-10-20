<?php

namespace Tests\Feature\Feauture\Users;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    //use WithoutMiddleware;

    /** @test */
    public function aNotAuthenticatedCannotStoreAUser()
    {
        $this->get(route('users.store'))
            ->assertRedirect('login');
    }

    /**
     * @test
     */
    public function aAuthenticatedCanStoreAUser()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post(route('users.store'), [
                'name' => 'Isabel Cristina',
                'last_name' => 'Palacio Bran',
                'email' => 'isabel@gmail.com',
                'phone' => '3104418741',
                'password' => '123456789',
                'password_confirmation' => '123456789'
            ]);

        $response->assertRedirect('home/userList');

        $this->assertCredentials([
            'name' => 'Isabel Cristina',
            'last_name' => 'Palacio Bran',
            'email' => 'isabel@gmail.com',
            'phone' => '3104418741',
            'password' => '123456789',
        ]);
    }

    /**
     * @test
     */
    public function itCanNotSaveUserWithNotUniqueEmail()
    {
        $user = factory(User::class)->create([
            'email' => 'isabel@xample.com'
        ]);
        $data = [
            'name' => 'Isabel',
            'last_name' => 'Palacio Bran',
            'email' => 'isabel@xample.com',
            'phone' => '3104418741',
            'password' => '123456789',
            'password_confirmation' => '123456789'
        ];
        $response = $this->actingAs($user)
            ->from(route('users.create'))
            ->post(route('users.store'), $data);

        $response->assertRedirect(route('users.create'));
        $response->assertSessionHasErrors('email');

    }

    /**
     * @test
     * @param string $field
     * @param null $value
     * @dataProvider
     */
    public function aUserCanNotBeRegisteredIfTheFieldsAreInvalid(string $field, $value = null)
    {
        $user = factory(User::class)->create();
            $data = [
                'name' => 'Isabel Cristina',
                'last_name' => 'Palacio Bran',
                'email' => 'isabel@example.com',
                'phone' => '3122104498',
                'password' => '123456789',
                'password_confirmation' => '123456789'
            ];
            $data[$field] = $value;

        $response = $this->actingAs($user)
            ->from(route('users.create'))
            ->post(route('users.store'), $data);

        $response->assertSessionHasErrors($field);
        $response->assertRedirect(route('users.create'));

        $this->assertDatabaseMissing('users', ['email' => 'isabel@example.com']);
    }



    public function userDataProvider()
    {
        return[
            'name field can not be null ' => ['name', null],
            'name field can not contain numbers or special characters' => ['name', 'd22[]·$%'],
            'name field can not be less than three characters' => ['name', 'sd'],
            'name field can not have more than forty characters' => ['name', Str::random(41)],
            'last name field can not be null' => ['last_name', null],
            'last name field can not contain numbers or special characters' => ['last_name', 'd22[]·$%'],
            'last name field can not be less than three characters' => ['last_name', 'sd'],
            'last name field can not have more than forty characters' => ['last_name', Str::random(41)],
            'email field can not be null' => ['email', null],
            'email field, can not contain an invalid email' => ['email', 'isabelPalacio'],
            'email field can not have more than forty characters' => ['email', Str::random(101)],  'name field can not be null ' => ['name', null],
            'phone field can not be null ' => ['phone', null],
            'phone field can not be less than three characters' => ['phone', 'sd'],
            'phone field can not have more than forty characters' => ['phone', Str::random(41)],
            'password field can not be null ' => ['password', null],
            'password field can not be less than eight characters' => ['password', 'sdg51@Sd']
        ];
    }

}
