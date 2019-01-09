<?php

namespace App\Service;

use Illuminate\Support\Facades\File;
use Image;
/**
 * Class FileService
 * @package App\Service
 */
class FileService
{
    /**
     * 
     * @param string $dir
     * @param array $photos
     * @return array
     */
    public function store($dir, $photos): array
    {
        $names = [];
        foreach ($photos as $base64)
        {
            if( !File::isDirectory($dir) )
                File::makeDirectory($dir, 493, true);
            $extantion = 'jpg';
            $img = Image::make($base64);
            $imageName = uniqid().'.'.$extantion;
            $file = $dir.'/'.$imageName;
            $img->fit(200)->save($file);
            $names[] = $imageName;
        }
        return $names;
    }

    /**
     * Delete file
     * 
     * @param string $filename Full file path
     * @return boolean
     */
    public function delete($filename)
    {
        if(File::exists($filename))
            File::delete($filename);
        return !File::exists($filename);
    }

    /**
     * @param string $path
     * @return \Illuminate\Http\Response
     */
    public static function getResponse(string $path)
    {
        $content = File::get($path);
        $response = response($content);
        $response->header('Content-Type', File::mimeType($path));
        return $response;
    }
    
    /**
     * Check file existing
     * 
     * @param string $filename Full file path
     * @return boolean
     */
    public function fileExists($filename)
    {
        return File::exists($filename);
    }
}