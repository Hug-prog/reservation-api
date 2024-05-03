<?php

use App\Models\Type;

it('create type',
    function () {
        \Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/type', [
            "name" => "concert",
        ])
            ->assertStatus(201)
        ;

        $type = Type::where(["name" => "concert"])->first();

        expect($type)->not()->toBeNull('A type must be persisted');

    });


it('wrong data of name in create type',
    function () {
        //\Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/type', [
            "name" => 102,
        ])
            ->assertValid(["name"],'field must be a string.',422)
        ;
    });


it('if no type return a empty array',
    function () {
        //\Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/types')
            ->assertStatus(200)
        ;
        expect($response->json())->toBeArray();
    });


it('get types',
    function () {
        //\Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();
        Type::factory()->create(['name' => 'concert']);
        Type::factory()->create(['name' => 'stand-up']);
        Type::factory()->create(['name' => 'théâtre']);


        $response = $this->actingAs($user)->getJson('/api/types')
            ->assertStatus(200)
        ;
        expect($response->json("data"))->toHaveCount(3);
    });



it('get type by id',
    function () {
        \Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();
        $type = Type::factory()->create(['name' => 'concert']);

        $response = $this->actingAs($user)->getJson("/api/type/{$type->id}")
            ->assertStatus(200)
        ;

        $data = $response->json("data");

        expect($data)->toEqual($type->toArray());
    });


it('delete type',
    function () {
        // \Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();
        $type = Type::factory()->create(["name"=>"concert"]);

        $response = $this->actingAs($user)->deleteJson("/api/type/{$type->id}")
            ->assertStatus(200)
        ;

        $data = $response->json("success");

        expect($data)->toBe(true);
    });
