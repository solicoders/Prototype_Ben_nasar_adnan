<?php

namespace App\Repository;

use App\Models\Image;
use App\Repository\BaseRepository;




class ImageRepository extends BaseRepository {
 
 
    public function __construct(Image $image){
    parent::__construct($image);
 }
 


}