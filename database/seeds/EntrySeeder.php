<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class EntryTableSeeder extends Seeder
{
    public function run()
    {
        $entry = App\Entry::create([
            'novel_id'     => 1,
            'entry_author_id'     => 1,
            'order'    => 1,
            'entry_date'    => '1964-10-08 15:33:12',
            'entry' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed risus sed turpis lobortis consectetur et malesuada dui. Integer tincidunt sodales sem sed blandit. Etiam porta sit amet felis vel iaculis. Integer euismod placerat sapien, quis vehicula tellus vehicula sit amet. Nam ac metus velit. Phasellus aliquet nulla et tortor finibus, at varius quam ultrices. Fusce rutrum ut arcu eu faucibus. Duis commodo, nisl eget sodales ornare, erat sem eleifend eros, at tempor lectus lacus a justo. Aenean et ullamcorper nisi, sit amet rutrum velit. Curabitur vitae elit enim. Nam ultrices consequat blandit. Integer sit amet venenatis lacus. Nullam venenatis venenatis ligula, sed rhoncus augue suscipit non. Cras vel leo ut sem aliquam gravida non non purus.'
        ]);
    }
}
