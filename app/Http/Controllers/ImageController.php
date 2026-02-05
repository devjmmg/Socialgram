<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        $serverImage->cover(1000,1000); // Redimensionar la imagen
        
        //Ruta donde se va a guardar la imagen
        $pathImage = public_path('uploads/'.$imageName);
        
        // Asegurarse de que el directorio exista
        if (!file_exists(public_path('uploads'))) {
            mkdir(public_path('uploads'), 0755, true);
        }
        
        //Guardar la imagen modificada
        $serverImage->toAvif()->save($pathImage);
        
        return response()->json(['image' => $imageName]);
        
    }
    
}
