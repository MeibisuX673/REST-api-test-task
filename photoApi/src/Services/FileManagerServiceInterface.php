<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileManagerServiceInterface{

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function imageUpload(UploadedFile $file);

    /**
     * @param $filename
     * @return mixed
     */
    public function removeImage($filename);

   /**
    *
    * @param string $name
    * @return void
    */
    public function getImageContent(string $fileName): ?array;
        
}