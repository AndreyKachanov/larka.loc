<?php

use App\Entity\CourtSession;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CourtSession::class, function (Faker $faker) {
    return [
        'date'       => $faker->dateTime('2008-04-25 08:37:17', 'UTC'),
        'number' => '991/792/20',
        'judges' => json_encode([
            'Галабала М.В.',
            'Кравчук О.О.',
            'Маслов В.В.'
        ]),
        'involved' => 'Потерпілий: Спеціалізована антикорупційна прокуратура Генеральна прокуратура України, обвинувачений: Нагалевський Аполлінарій Казимирович, захисник: Найдьонов Євгеній Вячеславович, захисник: Базько Тетяна Олександрівна, захисник: Рижук Маргарита Сергіївна, захисник: Посвистак Ігор Миколайович',
        'description' => 'Пропозиція, обіцянка або надання неправомірної вигоди службовій особі',
        'room' => rand(1, 10)
    ];
});
