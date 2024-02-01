<?php

namespace App\Repository;
use Illuminate\Database\Eloquent\Model;


abstract class BaseRepository {
    protected $model;

    public function __construct(Model $Model){
        $this->model = $Model;
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



public function create(array $input): Model
{  
    $model = $this->model->newInstance($input);
    $model->save();
    return $model;
}





public function delete_images($id){

    $this->model->find($id)->delete();
   
}


}