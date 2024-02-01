<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 

        Image::create([
            "name" => "sun",
            "url" => "https//image/sun",
            "reference" => "jpeg",
            "presentation_id" => 1 
        ]);

        Image::create([
            "name" => "earth",
            "url" => "https//image/earth",
            "reference" => "png",
            "presentation_id" => 2
        ]);

        Image::create([
            "name" => "beach",
            "url" => "https//image/beach",
            "reference" => "jpg",
            "presentation_id" => 3
        ]);

        Image::create([
            "name" => "sand",
            "url" => "https//image/sand",
            "reference" => "moo",
            "presentation_id" => 4
        ]);
      
    }
}
