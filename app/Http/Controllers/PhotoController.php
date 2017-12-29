<?php
namespace App\Http\Controllers;

use App\Http\Requests\ImagesRequest;
use App\Repositories\PhotosRepositoryInterface;

class PhotoController extends Controller
{
    public function create()
    {
        return view('photo');
    }
 
    public function store(ImagesRequest $request, PhotosRepositoryInterface $photosRepository)
    {
        $photosRepository->save($request->image);
         
        return view('photo_ok');
    }
}
