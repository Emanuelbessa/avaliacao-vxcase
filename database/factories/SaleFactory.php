<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Sale;
use Faker\Generator as Faker;

$factory->define(App\Models\Sale::class, function (Faker $faker) {
    return [
        'purchase_at'=> Carbon\Carbon::now()
    ];
});
