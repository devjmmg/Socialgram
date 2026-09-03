<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ImageController extends Controller
{
    
    public function store(Request $request) {
        
        //Obtener el archivo subido
        $image = $request->file('file');
        
        //Generar un nombre único para la imagen
        // $imageName = Str::uuid() . '.' .  $image->extension();
        $imageName = Str::uuid() . '.avif';
        
        $serverImage = Image::read($image); // Crear una instacia de Intervention Image
        $serverImage->cover(1080,1080); // Redimensionar la imagen
        
        Storage::disk('public')->put(
            'uploads/' . $imageName,
            $serverImage->toAvif()
        );
        
        return response()->json(['image' => $imageName]);
        
    }
    
}
