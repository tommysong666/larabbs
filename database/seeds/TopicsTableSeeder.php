<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        $topics = factory(Topic::class)->times(100)->make()->each(function ($topic, $index) {
            if ($index == 0) {
                 $topic->title = '第一篇话题';
            }
        });

        Topic::insert($topics->toArray());
    }

}

