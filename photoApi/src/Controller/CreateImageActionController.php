<?php

namespace App\Controller;

use App\Events\ImagePublishedEvent;
use App\Repository\FileRepositoryInterface;
use App\Repository\ImageRepositoryInterface;
use App\Services\File\FilesService;
use App\Services\FileManagerServiceInterface;

use App\Services\Image\ImageService;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Entity\Image;


final class CreateImageActionController extends BaseController
{

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepositpry;

    /**
     * @var FilesService
     */
    private $fileService;

    /**
     * @var
     */
    private $imageService;


    /**
     * CreateImageActionController constructor.
     */

    public function __construct(ImageRepositoryInterface $imageRepository, FilesService $filesService, ImageService $imageService)
    {
        $this->imageRepositpry = $imageRepository;
        $this->fileService = $filesService;
        $this->imageService = $imageService;

    }


    public function __invoke(Request $request, EventDispatcherInterface $eventDispatcher){
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }
        $imageDescription = $request->request->all();

//        $user = $this->getUser();
//
//
//        return $this->json($user);

        $file =  $this->fileService->handleCreate($uploadedFile);

//        $event = new ImagePublishedEvent($file);
//        $eventDispatcher->dispatch($event);

        $image = $this->imageService->handleCreate($file, $imageDescription);

        return $image;
    }


}
