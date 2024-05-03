<?php


use App\Models\User;

it('create user',
    function () {
    \Pest\Laravel\withoutExceptionHandling();
        $response = $this->postJson('/api/register', [
            "name" => "testAuth",
            "email" => "email@test.com",
            "password" => "19092skksks",
        ])
            ->assertStatus(201)
        ;

        $user = User::where([
            "name" => "testAuth",
                "email" => "email@test.com",]
        )->first();

        expect($user)->not()->toBeNull('A user must be persisted');
    });
