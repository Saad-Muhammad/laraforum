<?php

use App\Reply;
use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1 = [
            'user_id' => 1,
            'discussion_id' => 1,
            'reply' => 'Do Something'
        ];

        $r2 = [
            'user_id' => 2,
            'discussion_id' => 2,
            'reply' => 'Do Something'
        ];

        $r3 = [
            'user_id' => 1,
            'discussion_id' => 3,
            'reply' => 'Do Something'
        ];

        $r4 = [
            'user_id' => 2,
            'discussion_id' => 4,
            'reply' => 'Do Something'
        ];

        Reply::create($r1);
        Reply::create($r2);
        Reply::create($r3);
        Reply::create($r4);
    }
}
