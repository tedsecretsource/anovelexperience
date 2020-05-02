<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy

class NovelTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Novel::class, 8)->create();
        // $dracula = App\Novel::create([
        //     'title'     => 'Sample Novel',
        //     'amount'    => 490,
        //     'author' => 'Sample Author',
        //     'published' => '1964-10-07',
        //     'first_entry_date' => '1964-10-08 12:00:00',
        //     'last_entry_date' => '1965-10-08 12:00:00',
        //     'summary' => ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed risus sed turpis lobortis consectetur et malesuada dui. Integer tincidunt sodales sem sed blandit. Etiam porta sit amet felis vel iaculis. Integer euismod placerat sapien, quis vehicula tellus vehicula sit amet. Nam ac metus velit. Phasellus aliquet nulla et tortor finibus, at varius quam ultrices. Fusce rutrum ut arcu eu faucibus. Duis commodo, nisl eget sodales ornare, erat sem eleifend eros, at tempor lectus lacus a justo. Aenean et ullamcorper nisi, sit amet rutrum velit. Curabitur vitae elit enim. Nam ultrices consequat blandit. Integer sit amet venenatis lacus. Nullam venenatis venenatis ligula, sed rhoncus augue suscipit non. Cras vel leo ut sem aliquam gravida non non purus. ',
        //     'subscriptions' => 0,
        //     'novel_emoji' => '🤦‍♂️'
        // ]);
    }
}
