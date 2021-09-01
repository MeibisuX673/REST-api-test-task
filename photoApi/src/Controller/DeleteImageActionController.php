<?php


namespace App\Controller;


use App\Services\File\FilesService;
use App\Services\FileManagerServiceInterface;
use App\Services\Image\ImageService;


final class DeleteImageActionController extends BaseController
{
    private $fileService;

    private $fileManagerService;
    private $imageService;

    /**
     * DeleteImageActionController constructor.
     * @param FilesService $fileService
     * @param ImageService $imageService
     * @param FileManagerServiceInterface $fileManagerService
     */
    public function __construct(FilesService $fileService, ImageService $imageService, FileManagerServiceInterface $fileManagerService)
    {
        $this->fileService = $fileService;
        $this->fileManagerService = $fileManagerService;
        $this->imageService = $imageService;
    }

    public function __invoke(int $id)
    {
        $image = $this->imageService->handleGetOne($id);
        $file = $image->getFile();
        $this->fileManagerService->removeImage($file->getName());
        $this->imageService->handleDelete($image);
        $this->fileService->handleDelete($file);
    }
}