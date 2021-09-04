<?php


namespace App\Services\Image;


use App\Entity\File;
use App\Entity\Image;
use App\Entity\User;
use App\Repository\ImageRepositoryInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class ImageService
{

    private $imageRepository;

    /**
     * ImageService constructor.
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * @param File $file
     * @param array $descriptionImage
     * @return Image
     */
    public function handleCreate(User $user,File $file, array $descriptionImage): Image{
        $image = new Image();
        $image->setName($descriptionImage['name']);
        $image->setDescription($descriptionImage['description']);
        $image->setFile($file);
        $image->setUser($user);
        $this->imageRepository->setCreate($image);

        return $image;

    }
    public function handleDelete(Image $image){
        $this->imageRepository->setDelete($image);
    }

    public  function handleGetOne(int $idImage): object{
        return $this->imageRepository->getOne($idImage);
    }

}