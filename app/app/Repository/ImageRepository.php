<?php

namespace App\Repository;

use App\Models\Image;
use App\Repository\BaseRepository;




class ImageRepository extends BaseRepository {
 
 
    public function __construct(Image $image){
    parent::__construct($image);
 }
 

 public function getAllImages($query)
 {
     return $this->model->where(function($queryBuilder) use ($query) {
         $queryBuilder->where('name', 'like', '%' . $query . '%');
     })->paginate(2);
 }

 
 
 public function updateImages($id, array $data)
 {
     $images = $this->model->find($id);

     if (!$images) {
         return false; 
     }

     $images->update($data);

     return $images;
 }





public function editImages($id)
{
    $images = $this->model->findOrFail($id);
    return $images; // Adjust this line based on what you want to do with the retrieved images
}



}