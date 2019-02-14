<?php

use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Channel::create([
            'title' => 'The first channel',
            'slug' => str_slug('The first Channel'),
        ]);

        App\Channel::create([
            'title' => 'The second channel',
            'slug' => str_slug('The second Channel'),
        ]);

        App\Channel::create([
            'title' => 'The third channel',
            'slug' => str_slug('The third Channel'),
        ]);

        App\Channel::create([
            'title' => 'The fourth channel',
            'slug' => str_slug('The fourth Channel'),
        ]);

        App\Channel::create([
            'title' => 'The fifth channel',
            'slug' => str_slug('The fifth Channel'),
        ]);
    }
}
