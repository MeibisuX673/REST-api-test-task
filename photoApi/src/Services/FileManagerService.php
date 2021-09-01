<?php


namespace App\Services;


use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Vich\UploaderBundle\Storage\StorageInterface;

class FileManagerService implements FileManagerServiceInterface{

    private $imageDirectory;

    /**
     * FileManagerService constructor.
     * @param $imageDirectory
     */
    public function __construct($imageDirectory)
    {
        $this->imageDirectory = $imageDirectory;
    }

    /**
     * @return mixed
     */
    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function imageUpload(UploadedFile $file): array
    {

        $filename = uniqid().'.'. $file->guessExtension();
        try{
            $file->move($this->getImageDirectory(),$filename);
        }catch (FileException $e){
            return $e;
        }
        $path = $this->getImageDirectory().'/'.$filename;

        $image = ['fileName'=>$filename,'path'=>$path];
        return $image;
    }

    /**
     * @param $fileName
     * @return void
     */
    public function removeImage($fileName)
    {
        $fileSystem = new Filesystem();
        $fileImage = $this->getImageDirectory().'/'.$fileName;
        try {
            $fileSystem->remove($fileImage);
        } catch (IOExceptionInterface $exception){
            echo $exception->getMessage();
        }
    }
}