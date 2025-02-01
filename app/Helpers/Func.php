<?php

namespace App\Helpers;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Encoders\JpegEncoder;
class Func {
    // funcion para guardar un archivo pdf
    public static function saveFile($image, $node) {

    }

    public static function upload($file,$folder,$code=null,$options=[]) {
        $filename = str_replace('-', '', Str::uuid()->toString());
        $configs=[
            [
                'code' => 'original',
                'type' => 'original',
            ],[
                'code'=>'text',
                'type'=>'text'
            ]
        ];
        foreach ($configs as $key => $value) {
            self::processAndStore($file,$folder,$value,$filename,$code,$options);
        }
        return $filename;
    }

    public static function processAndStore($file,$folder,$size,$filename,$code=null,$options) {
        $extension = $options['extension'] ?? 'jpg';
        // $newFilename = public_path('tmp/' . $filename . '.' . $extension);
        // $path=public_path('tmp/');
        // if (!File::exists($path)) {
        //     File::makeDirectory($path, 0755, true);
        // }
        $newFilename = public_path('img/'.$folder . '/' . $size['code'] . '/' . $filename . '.' . $extension); // Guardar directamente en public
        $path = public_path('img/'.$folder . '/' . $size['code']); // Crear la ruta de la carpeta dentro de public
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true); // Crear la carpeta si no existe
        }

        try {
            $img = self::manipulateImage($file, $size, $extension,$code);
            $img->save($newFilename, 90);
            // $handle = fopen($newFilename, 'r+');
            // Storage::put($folder . '/' . $size['code'] . '/' . $filename . '.' . $extension, $handle);
            // fclose($handle);
            // unlink($newFilename);
        } catch (\Throwable $e) {
            throw new \Exception("Error al procesar imagen: " . $e->getMessage());
        }
    }

    public static function manipulateImage($file, $size, $extension,$code=null) {
        $type = $size['type'] ?? 'fit';
        if($type=='original'){
            $manager = new ImageManager(new Driver());
            return  $manager->read($file);
        }
        if($type=='text'){
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $image->text($code, $image->width() / 2, ($image->height() / 2) + 95, function($font) {
                $font->file(public_path('fonts/Arial.ttf'));
                $font->size(60); // Tamaño grande
                $font->color('#FFFFFF');
                $font->stroke('000000', 3);
                $font->align('center'); // Centrado horizontal
                $font->valign('middle'); // Centrado vertical
                $font->angle(0); // Sin rotación
                $font->wrap(400);
            });
            return $image;
        }
        $manager = new ImageManager(new Driver());
        if($type=='resize'){
            return  $manager->read($file)->resize($size['width'], $size['height'], function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new JpegEncoder());
        }else if($type=='crop'){
            return  $manager->read($file)->crop($size['width'], $size['height'], 45, 90);
        }else if($type=='cover'){
            return  $manager->read($file)->coverDown($size['width'], $size['height']);
        }else if($type=='scale'){
            return  $manager->read($file)->scaleDown($size['width'], $size['height']);
        }else{
            return  $manager->read($file)->resizeDown($size['width'], $size['height']);
        }
    }
    
    // public static function getImageUrl(string $folder,string $code,string $file):string {
    //     $path = $folder.'/'.$code.'/'.$file.'.jpg';
    //      \Log::info('path: '.$path);
    //     $final_path = Storage::url($path);
    //     return $final_path;
    // }
    
    public static function getImageUrl(string $folder,string $code,string $file):string {
        $path = 'img/'.$folder.'/'.$code.'/'.$file.'.jpg';
         \Log::info('path: '.$path);
         
        return asset($path);
    }


    // public static function getImagePath(string $folder,string $size,string $file) {
    //     $path = $folder.'/'.$size.'/'.$file.'.jpg';
    //     $fileContent = Storage::get($path);
    //     return $fileContent;
    // }
}
