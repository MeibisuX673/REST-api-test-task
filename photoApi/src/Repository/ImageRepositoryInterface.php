<?php


namespace App\Repository;


use App\Entity\Image;

interface ImageRepositoryInterface
{
    /**
     * @param Image $image
     * @return object
     */
    public function setCreate(Image $image): object;

    /**
     * @param int $idFile
     * @return object
     */
    public function getOne(int $idImage): object;

    /**
     * @param Image $image
     * @return mixed
     */
    public function setDelete(Image $image);

}