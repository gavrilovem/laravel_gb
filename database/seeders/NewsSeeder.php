<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    private function getData(): array {
        $faker = \Faker\Factory::create('ru_RU');

        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'title' => $faker->sentence(rand(1, 3)),
                'description' => $faker->realText('100'),
                'text' => $faker->realText(rand(100, 300)),
                'category_id' => $faker->numberBetween(1, 10),
                'is_private' => $faker->randomElement(['0', '1']),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
        }
        return $data;
    }
}
