<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Technology;
use App\Models\Type;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $type_ids = Type::pluck('id')->toArray();
        $technology_ids = Technology::pluck('id')->toArray();

        for ($i = 1; $i <= 5; $i++) {
            $post = new Post();
            $post->type_id = $type_ids[array_rand($type_ids)];
            $post->title = $faker->text(50);
            $post->content = $faker->paragraphs(15, true);
            $post->image = $faker->imageUrl(250, 250);
            $post->save();

            $technologies = [];
            foreach ($technology_ids as $t) {
                if ($faker->boolean()) $technologies[] = $t;
            }

            $post->technologies()->attach($technologies);
        }
    }
}
