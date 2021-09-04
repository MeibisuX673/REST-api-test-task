<?php

namespace App\Controller;

use App\Controller\BaseController;
use App\Services\File\FilesService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\FileManagerServiceInterface;
use App\Services\Image\ImageService;

class DeleteImageAllController extends BaseController
{

    private $fileManagerService;
    private $imageService;
    private $fileService;

    public function __construct(
        FileManagerServiceInterface $fileManagerService,
        ImageService $imageService,
        FilesService $fileService
        ){
        $this->fileManagerService = $fileManagerService;
        $this->imageService = $imageService;
        $this->fileService = $fileService;
    }

    /**
     * @Route("/images/all", methods={"DELETE"}, name="delete_image_all")
     */
    public function deleteAllUserImages(): Response{

        $user = $this->getUser();
        if(count($images = $user->getImages())==0){
            return $this->json(['message'=>'deleted'],200);
        }
        
        foreach($images as $image){
            $this->fileManagerService->removeImage($image->getFile()->getName());
            $this->imageService->handleDelete($image);
            $this->fileService->handleDelete($image->getFile());
        }
        
        return $this->json(['message'=>'deleted',200]);
    }
}
