<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        foreach (range(1, 20) as $tag) {
            Tag::updateOrCreate(
                [
                    'name'   => "tag{$tag}",
                ],
                [
                    'name'   => "tag{$tag}",
                    'slug'   => "tag{$tag}",
                ]
            );
        }
    }
}
