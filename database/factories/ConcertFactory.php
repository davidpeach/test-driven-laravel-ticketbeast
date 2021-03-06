<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Concert;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Concert::class, function (Faker $faker) {
    return [
        'title' => 'Example Band',
        'subtitle' => 'The Fake Openers',
        'date' => Carbon::parse('+2 weeks'),
        'ticket_price' => 2000,
        'venue' => 'The Example Theatre',
        'venue_address' => '123 Fake Street',
        'city' => 'Fakeville',
        'state' => 'TS',
        'zip' => '90210',
        'additional_information' => 'Some sample additional information'
    ];
});

$factory->state(Concert::class, 'published', function ($faker) {
    return [
        'published_at' => Carbon::parse('-1 week'),
    ];
});

$factory->state(Concert::class, 'unpublished', function ($faker) {
    return [
        'published_at' => null,
    ];
});
