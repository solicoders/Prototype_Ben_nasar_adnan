<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ImageRepository;
use App\Http\Requests\CreateImageRequest;
use App\Models\Presentation;

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
        $presentations = Presentation::all(); 
        if ($request->ajax()) {
            return view('images.imagesTable', compact('images'));
        } else {
            return view('images.index', compact('images', 'presentations'));
        }
    }
    



    public function create()
    {
        $presentations = Presentation::all();   
        return view('images.create', compact('presentations'));
    }




    public function store(CreateImageRequest $request)
    {
        // dd($request);
        $input = $request->all();
        $addedImage = $this->imageRepository->create($input);
        return redirect()->route('images.index')->with('success', 'image ajouté avec succès');
    }



    public function edit($id)
    {
        $image = $this->imageRepository->editImages($id);
        $presentations = Presentation::all(); 
        $selectedPresentation = $image->presentation->name;
        return view('images.edit', compact('image', 'presentations', 'selectedPresentation'));
    }



public function update(Request $request, $id)
{
    // dd($id);
    // dd($request);


    $request->validate([
        'name' => 'required|unique:images,name,' . $id,
        'url' => 'nullable|string|max:1000',
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
