<?php

namespace Tests\Unit;

use App\Models\Client;
use Tests\TestCase;

class ClientTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_create_client()
    {
        $data = [
            'client_name' => $this->faker->name,
            "address1" => "rock heven way",
            "address2" => "15",
            "country" => "us",
            "state" => "VA",
            "city" => "sterling",
            "zip" => "20166",
            'phone_no1' => $this->faker->phoneNumber,
            'user' => [
                "first_name" => $this->faker->firstName,
                "last_name" => $this->faker->lastName,
                "email" => $this->faker->email,
                "password" => "1",
                "password_confirmation" => "1",
                "phone_no1" => $this->faker->phoneNumber
            ]
        ];
        $this->post(route('client.store'), $data)
            ->assertStatus(204);

    }

    public function test_show_all_clients()
    {
        Client::factory()->count(3)->create();
        $this->get('http://127.0.0.1:8000/api/client?column=client_name&query=&sortBy[]=id&sortBy[]=desc')
            ->assertStatus(200);

    }
}
