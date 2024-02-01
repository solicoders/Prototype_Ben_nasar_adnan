<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ImageRepository;
use App\Http\Requests\CreateImageRequest;

class ImageController extends Controller
{

    protected $imageRepository;

    public function __construct(ImageRepository $ImageRepository){

        $this->imageRepository = $ImageRepository;
    }


    public function index(Request $request)
    {
        $query = $request->input('query');
        $images = $this->imageRepository->getAllImages($query);
        
        if ($request->ajax()) {
            return view('images.imagesTable', compact('images'));
        } else {
            return view('images.index', compact('images'));
        }
    }
    



    public function create()
    {
        return view('images.create');
    }



    public function store(CreateImageRequest $request)
    {
        $input = $request->all();
        $this->imageRepository->create($input);
        return redirect()->route('images.index')->with('success', 'image ajouté avec succès');
    }



    public function edit($id)
    {
        $images = $this->imageRepository->editImages($id);
        return view('images.edit', compact('images'));
    }



public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|unique:tasks,title' . $id,
        'url' => 'nullable|string|max:1000',
        'reference' => 'required|integer|unique:Image,reference',
        'presentation_id' => 'required|integer',
    ]);

    $input = $request->all();

    $updateImage = $this->imageRepository->updateImages($id, $input);

    if (!$updateImage) {
        return redirect()->route('images.index')->with('error', 'image introuvable');
    }

    return redirect()->route('images.index')->with('success', 'image mis à jour avec succès');
}





public function destroy($id){

    $this->imageRepository->delete_images($id);
    return redirect()->route('images.index')->with('success', 'image supprimé avec succès');

}

}
