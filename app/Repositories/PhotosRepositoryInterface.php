<?php
 
namespace App\Repositories;
 
use Illuminate\Http\UploadedFile;
 
interface PhotosRepositoryInterface
{
  public function save(UploadedFile $image);
}