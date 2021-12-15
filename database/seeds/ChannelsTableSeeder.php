<?php

use App\Channel;
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
        $channel0  = ['title' => 'Laravel' , 'slug' => str_slug('Laravel')];
        $channel1 = ['title' => 'WordPress' , 'slug' => str_slug('WordPress')];
        $channel2 = ['title' => 'HTML' ,'slug' => str_slug('HTML')];
        $channel3 = ['title' => 'Vue.JS' , 'slug' => str_slug('Vue.JS')];
        $channel4 = ['title' => 'React.JS' , 'slug' => str_slug('React>JS')];
        $channel5 = ['title' => 'CSS3' , 'slug' => str_slug('CSS3')];
        $channel6 = ['title' => 'Javascript' , 'slug' => str_slug('Javascript')];
        $channel7 = ['title' => 'PHP' , 'slug' => str_slug('PHP')];

        Channel::create($channel0);
        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
        Channel::create($channel6);
        Channel::create($channel7);


    }
}
