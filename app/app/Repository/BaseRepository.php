<?php


namespace App\Repository;
use Illuminate\Database\Eloquent\Model;


abstract class BaseRepository {
    protected $model;

    public function __construct(Model $Model){
        $this->model = $Model;
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