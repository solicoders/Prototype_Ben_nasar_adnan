<?php

namespace App\Models;

use App\Models\Presentation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

   
    protected $fillable = ["name", "url", "reference", "presentation_id"];

    public static $rules = [
        'name' => 'required|unique:images,name',
        'url' => 'nullable|string|max:1000',
        'reference' => 'required|unique:images,reference',
        'presentation_id' => 'required|integer',

    ];
    public function presentation()
    {
        return $this->belongsTo(Presentation::class, 'presentation_id');
    }



}
