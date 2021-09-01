<?php


namespace App\Services\File;


use App\Entity\File;
use App\Entity\Image;
use App\Repository\FileRepositoryInterface;
use App\Services\FileManagerServiceInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FilesService
{
    /**
     * @var
     */
    private $fileRepositiry;
    /**
     * @var
     */
    private $fileManagerService;

    /**
     * FilesService constructor.
     * @param FileRepositoryInterface $fileRepositiry
     * @param FileManagerServiceInterface $fileManagerService
     */
    public function __construct(FileRepositoryInterface $fileRepositiry, FileManagerServiceInterface $fileManagerService)
    {
        $this->fileRepositiry = $fileRepositiry;
        $this->fileManagerService = $fileManagerService;
    }

    public function handleCreate(UploadedFile $uploadedFile): File{
        $file = new File();
        $descriptionFile = $this->fileManagerService->imageUpload($uploadedFile);
        $file->setName($descriptionFile['fileName']);
        $file->setPath($descriptionFile['path']);
        $this->fileRepositiry->setCreate($file);

        return $file;

    }

    public function handleDelete(File $file){
        $this->fileRepositiry->setDelete($file);
    }
}