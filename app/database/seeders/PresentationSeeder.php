<?php

namespace Database\Seeders;

use App\Models\Presentation;
use Illuminate\Database\Seeder;

class PresentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        Presentation::create([
            "title" => "lab-github",
            "content" => "# lab-gitub presentation",
            "reference" => "dev-web", 
        ]);

        Presentation::create([
            "title" => "lab-basic",
            "content" => "#lab-basic presentation",
            "reference" => "dev-mobile", 
        ]);

        Presentation::create([
            "title" => "lab-standar",
            "content" => "#lab-standar presentation",
            "reference" => "linux",
        ]);

        Presentation::create([
            "title" => "prototype",
            "content" => "#prototype presentation",
            "reference" => "design", 
        ]);
    }
}
