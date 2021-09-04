<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\FileManagerServiceInterface;

class GetFileContentController extends AbstractController
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $fileManagerService;

    public function __construct(FileManagerServiceInterface $fileManagerService)
    {
        $this->fileManagerService = $fileManagerService;
    }

    /**
     * @Route("/file/{fileName}", methods={"GET"}, name="get_file_content")
     */
    public function getFileContent($fileName): Response
    {
        $file = $this->fileManagerService->getImageContent($fileName);
        if(is_null($file)){
            return $this->json(["error"=>true,"message"=>"Not Found"]);
        };
        return $this->json($file,200);
    }
}
