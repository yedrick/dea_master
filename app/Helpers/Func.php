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

    public static function upload($file,$folder,$options=[]) {
        $filename = str_replace('-', '', Str::uuid()->toString());
        $configs=[
            [
                'code' => 'original',
                'type' => 'original',
            ],[
                'code' => 'resize',
                'type' => 'resize'
            ],[
                'code' => 'scale',
                'type' => 'scale'
            ],[
                'code'=>'text',
                'type'=>'text'
            ]
        ];
        foreach ($configs as $key => $value) {
            self::processAndStore($file,$folder,$value,$filename,$options);
        }
        return $filename;
    }

    public static function processAndStore($file,$folder,$size,$filename,$options) {
        $extension = $options['extension'] ?? 'jpg';
        $newFilename = public_path('tmp/' . $filename . '.' . $extension);
        $path=public_path('tmp/');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        try {
            $img = self::manipulateImage($file, $size, $extension);
            $img->save($newFilename, 90);
            $handle = fopen($newFilename, 'r+');
            Storage::put($folder . '/' . $size['code'] . '/' . $filename . '.' . $extension, $handle);
            fclose($handle);
            unlink($newFilename);
        } catch (\Throwable $e) {
            throw new \Exception("Error al procesar imagen: " . $e->getMessage());
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->imagick()->read($file);
        $image->text('Hello World!', 100, 100, function($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(24);
            $font->color('#ff0000');
            $font->align('center');
            $font->valign('top');
            $font->angle(45);
        });

        $image->save(public_path('images/imagen.jpg'));
    }

    public static function manipulateImage($file, $size, $extension) {
        $type = $size['type'] ?? 'fit';
        if($type=='original'){
            $manager = new ImageManager(new Driver());
            return  $manager->read($file);
        }
        if($type=='text'){
            $manager = new ImageManager(new Driver());
            $image = $manager->imagick()->read($file);
            $image->text('Hello World!', 100, 100, function($font) {
                $font->file(public_path('fonts/arial.ttf'));
                $font->size(24);
                $font->color('#ff0000');
                $font->align('center');
                $font->valign('top');
                $font->angle(45);
            });
            return $image;
        }
        $manager = new ImageManager(new Driver());
        if($type=='resize'){
            return  $manager->read($file)->$type($size['width'], $size['height'], function ($constraint) {
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
}
