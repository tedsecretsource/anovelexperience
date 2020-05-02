<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;

trait Fonts
{
    public function get_fonts()
    {
        return [
            'sans'                      => ['name' => 'Inter', 'url' => 'https://fonts.googleapis.com/css2?family=Inter:wght@200;500;800&display=swap'],
            'serif'                     => ['name' => 'Playfair Display', 'url' => 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;800&display=swap'],
            'mono'                      => ['name' => 'Courier', 'url' => ''],
            'serif-one'                 => ['name' => 'Foustina', 'url' => 'https://fonts.googleapis.com/css2?family=Faustina:wght@400;700&display=swap'],
            'serif-two'                 => ['name' => 'Josefin Slab', 'url' => 'https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@600;700&display=swap'],
            'serif-three'               => ['name' => 'Rokkitt', 'url' => 'https://fonts.googleapis.com/css2?family=Rokkitt:wght@400;700&display=swap'],
            'gothic-intense'            => ['name' => 'UnifrakturMaguntia', 'url' => 'https://fonts.googleapis.com/css2?family=UnifrakturMaguntia&display=swap'],
            'gothic-mild'               => ['name' => 'Pirata One', 'url' => 'https://fonts.googleapis.com/css2?family=Pirata+One&display=swap'],
            'gothic-modern'             => ['name' => 'Astloch', 'url' => 'https://fonts.googleapis.com/css2?family=Astloch:wght@400;700&display=swap'],
            'gothic-modern-thick'       => ['name' => 'Berkshire Swash', 'url' => 'https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap'],
            'gothic-extra-mild'         => ['name' => 'New Rocker', 'url' => 'https://fonts.googleapis.com/css2?family=New+Rocker&display=swap'],
            'typewriter-heavy'          => ['name' => 'Special Elite', 'url' => 'https://fonts.googleapis.com/css2?family=Special+Elite&display=swap'],
            'cursive-rough'             => ['name' => 'Homemade Apple', 'url' => 'https://fonts.googleapis.com/css2?family=Homemade+Apple&display=swap'],
            'cursive-soft'              => ['name' => 'Cedarville Cursive', 'url' => 'https://fonts.googleapis.com/css2?family=Cedarville+Cursive&display=swap'],
            'handwriting-block-letters' => ['name' => 'Nothing You Could Do', 'url' => 'https://fonts.googleapis.com/css2?family=Nothing+You+Could+Do&display=swap'],
            'handwriting-caligraphic'   => ['name' => 'Monsieur La Doulaise', 'url' => 'https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&display=swap'],
            'handwriting-cursive'       => ['name' => 'Herr Von Muellerhoff', 'url' => 'https://fonts.googleapis.com/css2?family=Herr+Von+Muellerhoff&display=swap'],
            'bleeding-caps'             => ['name' => 'Nosifer', 'url' => 'https://fonts.googleapis.com/css2?family=Nosifer&display=swap']
        ];
    }

    public function get_fonts_for_select()
    {
        foreach ($this->get_fonts() as $key => $font) {
            $fonts[$key] = $font['name'] . " ($key)";
        }
        return $fonts;
    }

    public function get_font($key)
    {
        return $this->get_fonts()[$key];
    }

    public function get_font_url($key)
    {
        return $this->get_font($key)['url'];
    }
}
