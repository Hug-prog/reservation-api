<?php

use App\Models\Place;
use App\Models\Type;

it('create place',
    function () {
        \Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/place', [
            "country" => "france",
            "city" => "Caen",
            "street_number" => 12234,
            "street" => "dopek ddel",
        ])
            ->assertStatus(201)
        ;

        $data = $response->json("data");

        expect($data)->not()->toBeNull('A type must be persisted');

    });



it('wrong data of country,city,street in create place',
    function () {
        //\Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/place', [
            "country" => 123,
            "city" => 2782,
            "street_number" => 12234,
            "street" => 2233,
        ])
            ->assertValid(["country","city","street"],'field must be a string.',422)
        ;
    });


it('wrong data of street_number in create place',
    function () {
        //\Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/place', [
            "country" => "France",
            "city" => "Caen",
            "street_number" => "dlkdlldld",
            "street" => "royehd kdkde",
        ])
            ->assertValid(["street_number"],'field must be a integer.',422)
        ;
    });

it('get places',
    function () {
        //\Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();
        Place::factory()->create();
        Place::factory()->create();
        Place::factory()->create();


        $response = $this->actingAs($user)->getJson('/api/places')
            ->assertStatus(200)
        ;
        expect($response->json("data"))->toHaveCount(3);
    });

it('get place by id',
    function () {
        // \Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();
        $place = Place::factory()->create();

        $response = $this->actingAs($user)->getJson("/api/place/{$place->id}")
            ->assertStatus(200)
        ;

        $data = $response->json("data");

        expect($data)->toEqual($place->toArray());
    });

it('delete place',
    function () {
        // \Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();
        $place = Place::factory()->create();

        $response = $this->actingAs($user)->deleteJson("/api/place/{$place->id}")
            ->assertStatus(200)
        ;

        $data = $response->json("success");

        expect($data)->toBe(true);
    });
