<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;

class RepliesTableSeeder extends Seeder
{
    public function run()
    {
        $replies = factory(Reply::class)->times(1000)->make()->each(function ($reply, $index) {
            if ($index == 0) {
                 $reply->content = '第一条回复';
            }
        });

        Reply::insert($replies->toArray());
    }

}

