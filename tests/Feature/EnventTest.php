<?php


use App\Models\Event;
use App\Models\Place;
use App\Models\Type;

it('create event',
    function () {
        \Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/event', [
            "name" => "event1",
            "description" => "dldlmddmememf rmrmrmrmrrmmrmree",
            "nb_places" => 12000,
            "place_id" => Place::factory()->create()->id,
            "type_id" => Type::factory()->create(["name"=>"dlelel"])->id,
        ])
            ->assertStatus(201)
        ;

        $data = $response->json("data");

        expect($data)->not()->toBeNull('A type must be persisted');

    });


it('wrong data of Name and Desc in create event',
    function () {
        //\Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/event', [
            "name" => 12,
            "description" => 1123,
            "nb_places" => 1233,
            "place_id" => Place::factory()->create()->id,
            "type_id" => Type::factory()->create(["name"=>"dkdddklkd"])->id,
        ])
            ->assertValid(["name","description"],'field must be a string.',422)
        ;
    });

it('wrong data of nb_places,place_id,type_id in create event',
    function () {
        //\Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/event', [
            "name" => "event",
            "description" => "dddlelleldldldl",
            "nb_places" => "dkdldld",
            "place_id" => Place::factory()->create()->country,
            "type_id" => Type::factory()->create(["name"=>"dlldldldld"])->name,
        ])
            ->assertValid(["nb_places","place_id","type_id"],'field must be a integer.',422)
        ;
    });


it('get events',
    function () {
        \Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();

        Event::factory()->create([
            "name"=> "event1",
            "description"=>"dlelelellele",
            "nb_places"=>122303,
            "type_id"=>Type::factory()->create(["name"=>"llepmeeme"])->id,
        ]);
        Event::factory()->create([
            "name"=> "event2",
            "description"=>"dlelelellele",
            "nb_places"=>122303,
            "type_id"=>Type::factory()->create(["name"=>"eekeedoe"])->id,
        ]);
        Event::factory()->create(
            [
                "name"=> "event1",
                "description"=>"dlelelellele",
                "nb_places"=>122303,
                "type_id"=>Type::factory()->create(["name"=>"zetede"])->id,
            ]
        );


        $response = $this->actingAs($user)->getJson('/api/events')
            ->assertStatus(200)
        ;
        expect($response->json("data"))->toHaveCount(3);
    });


it('get event by id',
    function () {
        // \Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();
        $event = Event::factory()->create();

        $response = $this->actingAs($user)->getJson("/api/event/{$event->id}")
            ->assertStatus(200)
        ;

        $data = $response->json("data");

        expect($data)->toEqual($event->toArray());
    });

it('delete event',
    function () {
        // \Pest\Laravel\withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();
        $event = Event::factory()->create();

        $response = $this->actingAs($user)->deleteJson("/api/event/{$event->id}")
            ->assertStatus(200)
        ;

        $data = $response->json("success");

        expect($data)->toBe(true);
    });



//"date"=>"12/05/2024",
//"date_time" =>"10:14:43",
